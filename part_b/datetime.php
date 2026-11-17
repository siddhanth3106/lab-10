<?php
// Set the default timezone (Asia/Kolkata or system setting)
$defaultTimezone = 'Asia/Kolkata';
date_default_timezone_set($defaultTimezone);

// Allow user to switch timezone via query param if desired
if (isset($_GET['tz']) && in_array($_GET['tz'], DateTimeZone::listIdentifiers())) {
    date_default_timezone_set($_GET['tz']);
}

// 1. Current Date
$currentDateStandard = date("d-m-Y");
$currentDateFull     = date("F j, Y"); // e.g. November 17, 2026

// 2. Current Time
$currentTime12Hour   = date("h:i:s A"); // 12-hour format with AM/PM
$currentTime24Hour   = date("H:i:s");   // 24-hour format

// 3. Current Day
$currentDay          = date("l");       // Full day name (e.g. Tuesday)
$dayOfYear           = date("z") + 1;   // Day number of the year

// Additional contextual data
$activeTimezone      = date_default_timezone_get();
$unixTimestamp       = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application B - Current Date, Time &amp; Day</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            min-height: 100vh;
            color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }
        .container {
            width: 100%;
            max-width: 650px;
        }
        .clock-card {
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
            text-align: center;
        }
        .badge {
            display: inline-block;
            background: #38bdf8;
            color: #0c4a6e;
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 1.8rem;
            color: #f1f5f9;
            margin-bottom: 25px;
            font-weight: 600;
        }
        .day-display {
            font-size: 2rem;
            color: #38bdf8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }
        .time-display {
            font-size: 3.2rem;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 800;
            color: #f8fafc;
            text-shadow: 0 0 25px rgba(56, 189, 248, 0.35);
            margin: 10px 0;
            letter-spacing: 2px;
        }
        .date-display {
            font-size: 1.3rem;
            color: #94a3b8;
            margin-bottom: 30px;
            font-weight: 400;
        }

        /* 3-Column Highlight Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .time-display {
                font-size: 2.3rem;
            }
        }
        .info-item {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 16px 12px;
        }
        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 700;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #e2e8f0;
        }
        .info-value.accent {
            color: #38bdf8;
        }

        /* Code inspection section */
        .spec-table {
            background: rgba(15, 23, 42, 0.8);
            border-radius: 10px;
            padding: 15px;
            text-align: left;
            font-size: 0.88rem;
            color: #cbd5e1;
            margin-bottom: 25px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .spec-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .spec-table th, .spec-table td {
            padding: 8px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }
        .spec-table th {
            color: #94a3b8;
            font-size: 0.75rem;
            text-transform: uppercase;
        }
        .spec-table code {
            color: #f472b6;
            font-family: 'Courier New', Courier, monospace;
        }

        .btn-reload {
            display: inline-block;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 11px 26px;
            border-radius: 8px;
            font-size: 0.92rem;
            font-weight: 600;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
        }
        .btn-reload:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.5);
        }
        .nav-links {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .nav-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.88rem;
        }
        .nav-links a:hover {
            color: #38bdf8;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="clock-card">
        <span class="badge">Application B</span>
        <h1>Current Date, Time &amp; Day (PHP)</h1>

        <!-- Primary Highlight -->
        <div class="day-display"><?php echo $currentDay; ?></div>
        <div class="time-display"><?php echo $currentTime12Hour; ?></div>
        <div class="date-display"><?php echo $currentDateFull; ?></div>

        <!-- 3-Column Detailed Metrics -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Current Day</div>
                <div class="info-value accent"><?php echo $currentDay; ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Standard Date</div>
                <div class="info-value"><?php echo $currentDateStandard; ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">24-Hr Time</div>
                <div class="info-value"><?php echo $currentTime24Hour; ?></div>
            </div>
        </div>

        <!-- PHP Functions & Formats Reference -->
        <div class="spec-table">
            <table>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>PHP Expression</th>
                        <th>Output</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Day</strong></td>
                        <td><code>date("l")</code></td>
                        <td><?php echo $currentDay; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date</strong></td>
                        <td><code>date("d-m-Y")</code></td>
                        <td><?php echo $currentDateStandard; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Time (12-hr)</strong></td>
                        <td><code>date("h:i:s A")</code></td>
                        <td><?php echo $currentTime12Hour; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Timezone</strong></td>
                        <td><code>date_default_timezone_get()</code></td>
                        <td><?php echo $activeTimezone; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <a href="datetime.php" class="btn-reload">&#8635; Refresh Server Timestamp</a>

        <div class="nav-links">
            <a href="../index.php">&larr; Back to Main Portal</a>
        </div>
    </div>
</div>

</body>
</html>
