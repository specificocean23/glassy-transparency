<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EnjoydeiseOAuthController extends Controller
{
    /**
     * Redirect to Enjoydeise OAuth authorization
     */
    public function redirectToProvider()
    {
        // Store redirect state in session for CSRF protection
        session(['oauth_state' => Str::random(40)]);
        
        $queryString = http_build_query([
            'client_id' => config('services.enjoydeise.client_id'),
            'redirect_uri' => route('auth.enjoydeise.callback'),
            'response_type' => 'code',
            'scope' => 'profile email',
            'state' => session('oauth_state'),
        ]);
        
        return redirect(config('services.enjoydeise.authorization_endpoint') . '?' . $queryString);
    }

    /**
     * Handle Enjoydeise OAuth callback
     */
    public function handleProviderCallback()
    {
        $state = request('state');
        
        // Validate state for CSRF protection
        if (!$state || $state !== session('oauth_state')) {
            return redirect('/login')->with('error', 'Invalid OAuth state');
        }
        
        if (request('error')) {
            return redirect('/login')->with('error', request('error_description', 'OAuth error'));
        }
        
        $code = request('code');
        if (!$code) {
            return redirect('/login')->with('error', 'No authorization code received');
        }
        
        try {
            // Exchange authorization code for access token
            $token = $this->getAccessToken($code);
            
            // Get user information from Enjoydeise
            $enjoydeiseUser = $this->getUserInfo($token);
            
            // Find or create user in database
            $user = User::firstOrCreate(
                ['email' => $enjoydeiseUser['email']],
                [
                    'name' => $enjoydeiseUser['name'] ?? $enjoydeiseUser['email'],
                    'password' => bcrypt(Str::random(32)),
                    'email_verified_at' => now(),
                    'oauth_provider' => 'enjoydeise',
                    'oauth_id' => $enjoydeiseUser['id'],
                ]
            );
            
            // Update OAuth credentials if user already exists
            if ($user->wasRecentlyCreated === false) {
                $user->update([
                    'oauth_provider' => 'enjoydeise',
                    'oauth_id' => $enjoydeiseUser['id'],
                ]);
            }
            
            // Authenticate user
            Auth::login($user, remember: true);
            
            return redirect('/dashboard')->with('success', 'Successfully logged in with Enjoydeise!');
        } catch (\Exception $e) {
            \Log::error('Enjoydeise OAuth error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Authentication failed. Please try again.');
        }
    }

    /**
     * Get access token from Enjoydeise using authorization code
     */
    private function getAccessToken($code)
    {
        $response = \Http::asForm()->post(config('services.enjoydeise.token_endpoint'), [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.enjoydeise.client_id'),
            'client_secret' => config('services.enjoydeise.client_secret'),
            'code' => $code,
            'redirect_uri' => route('auth.enjoydeise.callback'),
        ]);
        
        if ($response->failed()) {
            throw new \Exception('Failed to obtain access token: ' . $response->body());
        }
        
        return $response->json()['access_token'];
    }

    /**
     * Get user information from Enjoydeise API
     */
    private function getUserInfo($accessToken)
    {
        $response = \Http::withToken($accessToken)->get(
            config('services.enjoydeise.resource_endpoint')
        );
        
        if ($response->failed()) {
            throw new \Exception('Failed to retrieve user info: ' . $response->body());
        }
        
        return $response->json();
    }

    /**
     * Logout user and redirect
     */
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        \Session::flush();
        
        return redirect('/')->with('success', 'Logged out successfully');
    }
}
