<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>F1 Stats Hub</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
                    body { margin: 0; font-family: 'Figtree', sans-serif; color: #F4F4F5; background: #050505; }
                    * { box-sizing: border-box; }
                    html, body { min-height: 100%; }
                    a { color: #FF2D20; text-decoration: none; }
                    a:hover { text-decoration: underline; }
                    .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
                    .hero { display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; text-align: center; gap: 2rem; }
                    .hero h1 { font-size: clamp(2.75rem, 5vw, 5rem); margin: 0; letter-spacing: -0.05em; color: #FFFFFF; }
                    .hero p { max-width: 760px; margin: 0 auto; font-size: 1.125rem; line-height: 1.8; color: #CBD5E1; }
                    .cta-group { display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem; }
                    .btn { display: inline-flex; align-items: center; justify-content: center; padding: 1rem 1.75rem; border-radius: 999px; font-weight: 700; transition: transform 0.2s ease, box-shadow 0.2s ease; }
                    .btn-primary { background: linear-gradient(135deg, #FF2D20 0%, #FB7185 100%); color: #fff; box-shadow: 0 16px 40px rgba(255,45,32,0.28); }
                    .btn-secondary { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); color: #F8FAFC; }
                    .btn:hover { transform: translateY(-2px); }
                    .card-grid { display: grid; gap: 1.5rem; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); margin-top: 3rem; }
                    .card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1.25rem; padding: 1.75rem; backdrop-filter: blur(12px); transition: transform 0.2s ease, border-color 0.2s ease; }
                    .card:hover { transform: translateY(-4px); border-color: rgba(255,45,32,0.4); }
                    .card h2 { margin: 0 0 0.75rem; font-size: 1.25rem; color: #FFFFFF; }
                    .card p { margin: 0; color: #CBD5E1; line-height: 1.75; }
                    .footer { margin-top: 4rem; color: #94A3B8; font-size: 0.95rem; text-align: center; }
                    .badge { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.9rem; border-radius: 999px; background: rgba(255,45,32,0.12); color: #FFB3AB; font-size: 0.9rem; font-weight: 700; letter-spacing: 0.04em; }

                    /* Responsive styles */
                    @media (max-width: 767.98px) {
                        .container { padding: 1rem; }
                        .hero { min-height: auto; padding: 3rem 0; gap: 1.5rem; }
                        .hero h1 { font-size: clamp(1.8rem, 7vw, 2.75rem); }
                        .hero p { font-size: 0.95rem; padding: 0 0.5rem; }
                        .card-grid { gap: 1rem; grid-template-columns: 1fr; margin-top: 2rem; }
                        .card { padding: 1.25rem; }
                        .card h2 { font-size: 1.1rem; }
                        .card p { font-size: 0.9rem; }
                        .btn { padding: 0.75rem 1.25rem; font-size: 0.9rem; width: 100%; }
                        .cta-group { flex-direction: column; width: 100%; max-width: 300px; }
                        .footer { margin-top: 2rem; font-size: 0.85rem; padding: 0 1rem; }
                    }

                    @media (min-width: 768px) and (max-width: 991.98px) {
                        .container { padding: 1.5rem; }
                        .card-grid { grid-template-columns: repeat(2, 1fr); }
                    }
                </style>
    </head>
    <body>
        <div class="container">
            <main class="hero">
                <span class="badge">F1 Stats Hub</span>
                <h1>Track every circuit, team, driver, race result, and podium push in one place.</h1>
                <p>Welcome to F1 Stats Hub — a dark-themed control center built for precision motorsport data management. Manage seasons, circuits, teams, drivers, and race results with a bold black and red interface crafted for high-speed analytics.</p>
                <div class="cta-group">
                    <a href="{{ route('f1.dashboard') }}" class="btn btn-primary">Open Race Dashboard</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Admin Login</a>
                </div>
                <div class="card-grid">
                    <article class="card">
                        <h2>Race Results</h2>
                        <p>Record finishing order, points, statuses and championship standings from every event in the calendar.</p>
                    </article>
                    <article class="card">
                        <h2>Driver & Team Management</h2>
                        <p>Create and update driver profiles, car liveries, team entry lists and constructor affiliations with ease.</p>
                    </article>
                    <article class="card">
                        <h2>Season & Circuit Control</h2>
                        <p>Build race calendars, register circuits, and keep championship seasons aligned with current F1 regulations.</p>
                    </article>
                    <article class="card">
                        <h2>Admin Focused UI</h2>
                        <p>Access a secure admin section under /admin and keep your F1 dataset clean, up-to-date, and race-ready.</p>
                    </article>
                </div>
            </main>
            <footer class="footer">F1 Stats Hub · Built for race teams, data analysts, and championship administrators.</footer>
        </div>
    </body>
</html>
