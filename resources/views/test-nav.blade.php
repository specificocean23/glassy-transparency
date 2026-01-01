<!DOCTYPE html>
<html>
<head>
    <title>Test Nav+Footer</title>
    <style>
        :root {
            --bg: #f8f8f8;
            --panel: #ffffff;
            --subtle: #666666;
            --ink: #1a1a1a;
            --border: #e0e0e0;
            --blur: blur(20px);
            --card: #ffffff;
            --shadow: 0 20px 60px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
    @include('components.navigation')
    <div style="padding: 100px 20px; text-align: center;">
        <h1>Welcome</h1>
        <p>Navigation should appear above, footer below.</p>
    </div>
    @include('components.footer-alt-1')
</body>
</html>
