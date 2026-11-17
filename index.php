<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Web Applications Suite</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
        }
        header {
            text-align: center;
            max-width: 700px;
            margin-bottom: 50px;
        }
        .header-badge {
            display: inline-block;
            background: rgba(56, 189, 248, 0.15);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        p.desc {
            color: #94a3b8;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* App Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            max-width: 1100px;
            width: 100%;
        }
        @media (max-width: 900px) {
            .cards-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
            }
        }
        .app-card {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 32px 26px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .app-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }
        .app-card.card-a::before { background: linear-gradient(90deg, #667eea, #764ba2); }
        .app-card.card-b::before { background: linear-gradient(90deg, #38bdf8, #0284c7); }
        .app-card.card-c::before { background: linear-gradient(90deg, #10b981, #6366f1); }

        .app-card:hover {
            transform: translateY(-6px);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.5);
        }
        .app-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
        }
        .card-a .app-icon { background: rgba(102, 126, 234, 0.2); color: #818cf8; }
        .card-b .app-icon { background: rgba(56, 189, 248, 0.2); color: #38bdf8; }
        .card-c .app-icon { background: rgba(99, 102, 241, 0.2); color: #a5b4fc; }

        .card-tag {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .card-a .card-tag { color: #818cf8; }
        .card-b .card-tag { color: #38bdf8; }
        .card-c .card-tag { color: #a5b4fc; }

        .app-title {
            font-size: 1.35rem;
            color: #f8fafc;
            margin-bottom: 12px;
            font-weight: 600;
        }
        .app-desc {
            color: #94a3b8;
            font-size: 0.92rem;
            line-height: 1.55;
            margin-bottom: 25px;
            flex-grow: 1;
        }
        .feature-list {
            list-style: none;
            margin-bottom: 25px;
            font-size: 0.85rem;
            color: #cbd5e1;
        }
        .feature-list li {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .feature-list li::before {
            content: "✓";
            color: #38bdf8;
            font-weight: bold;
        }
        .btn-launch {
            display: block;
            text-align: center;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .card-a .btn-launch {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
        }
        .card-b .btn-launch {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
        }
        .card-c .btn-launch {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            color: #ffffff;
        }
        .btn-launch:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }

        footer {
            margin-top: 60px;
            text-align: center;
            color: #64748b;
            font-size: 0.85rem;
        }
        footer code {
            color: #38bdf8;
            background: #1e293b;
            padding: 2px 6px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<header>
    <span class="header-badge">PHP Web Applications Suite</span>
    <h1>Practical Applications Hub</h1>
    <p class="desc">A collection of three interactive PHP applications covering session tracking, system time, and conditional authorization.</p>
</header>

<main class="cards-grid">
    <!-- Application A -->
    <div class="app-card card-a">
        <div>
            <div class="app-icon">&#9201;</div>
            <div class="card-tag">Application A</div>
            <h2 class="app-title">Session Usage Tracker</h2>
            <p class="app-desc">
                Takes a name as input, renders a welcome page displaying the start time fixed in the top-right corner, and on logout presents a Thank You screen with the total duration of usage.
            </p>
            <ul class="feature-list">
                <li><code>$_SESSION</code> persistence</li>
                <li>Fixed top-right timestamp</li>
                <li>Real-time duration calculation</li>
                <li>Secure session destroy on logout</li>
            </ul>
        </div>
        <a href="part_a/index.php" class="btn-launch">Launch Application A &rarr;</a>
    </div>

    <!-- Application B -->
    <div class="app-card card-b">
        <div>
            <div class="app-icon">&#128197;</div>
            <div class="card-tag">Application B</div>
            <h2 class="app-title">Date, Time &amp; Day Display</h2>
            <p class="app-desc">
                A server-side PHP script displaying the current Date, 12-hour / 24-hour Time with seconds, and Day of the week with standard PHP date format specifiers.
            </p>
            <ul class="feature-list">
                <li><code>date("d-m-Y")</code> standard date</li>
                <li><code>date("h:i:s A")</code> 12-hour clock</li>
                <li><code>date("l")</code> full day name</li>
                <li>Configured timezone support</li>
            </ul>
        </div>
        <a href="part_b/datetime.php" class="btn-launch">Launch Application B &rarr;</a>
    </div>

    <!-- Application C -->
    <div class="app-card card-c">
        <div>
            <div class="app-icon">&#128274;</div>
            <div class="card-tag">Application C</div>
            <h2 class="app-title">Age Verification &amp; Access</h2>
            <p class="app-desc">
                HTML form taking user's name and age. If age is less than 18, it restricts access with a personalized warning; otherwise, it welcomes the user to the site.
            </p>
            <ul class="feature-list">
                <li>HTML form input validation</li>
                <li>Personalized unauthorized alert (&lt; 18)</li>
                <li>Welcome banner (&ge; 18)</li>
                <li>XSS-safe string handling</li>
            </ul>
        </div>
        <a href="part_c/index.php" class="btn-launch">Launch Application C &rarr;</a>
    </div>
</main>

<footer>
    <p>Run locally using PHP built-in server: <code>php -S localhost:8000</code> or deploy in <code>xampp/htdocs</code></p>
</footer>

</body>
</html>
