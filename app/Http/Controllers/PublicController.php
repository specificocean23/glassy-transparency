<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Models\Event;
use App\Models\CaseStudy;
use App\Models\AdvocacyCampaign;
use App\Models\EnvironmentalMetric;

class PublicController extends Controller
{
    public function technologies()
    {
        $technologies = Technology::all();
        return view('public.technologies', compact('technologies'));
    }

    public function events()
    {
        $events = Event::where('status', 'published')->orWhere('status', 'active')->get();
        return view('public.events', compact('events'));
    }

    public function caseStudies()
    {
        $caseStudies = CaseStudy::all();
        return view('public.case-studies', compact('caseStudies'));
    }

    public function campaigns()
    {
        $campaigns = AdvocacyCampaign::all();
        return view('public.campaigns', compact('campaigns'));
    }

    public function metrics()
    {
        $metrics = EnvironmentalMetric::where('is_featured', true)->get();
        return view('public.metrics', compact('metrics'));
    }
}
