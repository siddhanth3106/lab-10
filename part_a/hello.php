<?php
date_default_timezone_set('Asia/Kolkata');
session_start();

// Handle name from request (POST or GET)
if (isset($_REQUEST['name']) && trim($_REQUEST['name']) !== '') {
    $name = trim($_REQUEST['name']);
    $_SESSION['username'] = $name;
    // Set start time when a new name is submitted
    $_SESSION['start_time'] = time();
    $_SESSION['start_time_formatted'] = date('h:i:s A');
    $_SESSION['start_date_formatted'] = date('d M Y');
} elseif (isset($_SESSION['username']) && isset($_SESSION['start_time'])) {
    // User refreshed or navigated back while session is still active
    $name = $_SESSION['username'];
} else {
    // No name provided and no active session - redirect back to input form
    header('Location: index.php');
    exit;
}

$startTime = $_SESSION['start_time_formatted'];
$startDate = $_SESSION['start_date_formatted'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello <?php echo htmlspecialchars($name); ?> | Session Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            color: #ffffff;
            position: relative;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Top-Right Corner Start Time Display */
        .top-right-bar {
            position: fixed;
            top: 20px;
            right: 25px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 10px 18px;
            border-radius: 50px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: #f8fafc;
            z-index: 100;
        }
        .top-right-bar .clock-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            background: #38bdf8;
            color: #0f172a;
            border-radius: 50%;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .top-right-bar .time-label {
            color: #cbd5e1;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .top-right-bar .time-value {
            font-weight: 700;
            color: #ffffff;
        }

        /* Main Greeting Card */
        .main-card {
            background: rgba(255, 255, 255, 0.98);
            color: #1e293b;
            border-radius: 16px;
            padding: 45px 35px;
            width: 100%;
            max-width: 520px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            margin-top: 40px;
        }
        .greeting-avatar {
            width: 72px;
            height: 72px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #38bdf8 0%, #2563eb 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.35);
        }
        h1 {
            font-size: 2.1rem;
            color: #0f172a;
            margin-bottom: 12px;
            word-break: break-word;
        }
        .welcome-text {
            color: #64748b;
            font-size: 1.05rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .session-info {
            background: #f1f5f9;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }
        .session-info-item .label {
            font-size: 0.78rem;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
        }
        .session-info-item .val {
            font-size: 1.05rem;
            color: #0f172a;
            font-weight: 700;
            margin-top: 4px;
        }
        .btn-logout {
            display: inline-block;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 14px 36px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.35);
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .btn-logout:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(239, 68, 68, 0.45);
        }
        .btn-logout:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <!-- Top Right Corner Start Time Display -->
    <div class="top-right-bar" id="startTimeBadge">
        <span class="clock-icon">&#9200;</span>
        <div>
            <div class="time-label">Session Started</div>
            <div class="time-value"><?php echo htmlspecialchars($startTime); ?></div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="main-card">
        <div class="greeting-avatar">&#128075;</div>
        <h1>Hello, <?php echo htmlspecialchars($name); ?>!</h1>
        <p class="welcome-text">
            Welcome to the secure session dashboard. Your session is currently active and the time spent on this application is being tracked.
        </p>

        <div class="session-info">
            <div class="session-info-item">
                <div class="label">User</div>
                <div class="val"><?php echo htmlspecialchars($name); ?></div>
            </div>
            <div class="session-info-item">
                <div class="label">Date</div>
                <div class="val"><?php echo htmlspecialchars($startDate); ?></div>
            </div>
            <div class="session-info-item">
                <div class="label">Start Time</div>
                <div class="val"><?php echo htmlspecialchars($startTime); ?></div>
            </div>
        </div>

        <form action="logout.php" method="POST">
            <button type="submit" class="btn-logout">Logout &amp; End Session</button>
        </form>
    </div>

</body>
</html>
