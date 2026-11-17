<?php
date_default_timezone_set('Asia/Kolkata');
session_start();

// Retrieve session data before destroying
$name = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$startTime = isset($_SESSION['start_time']) ? $_SESSION['start_time'] : null;
$startTimeFormatted = isset($_SESSION['start_time_formatted']) ? $_SESSION['start_time_formatted'] : null;

$endTime = time();
$endTimeFormatted = date('h:i:s A');

if ($startTime !== null) {
    $durationSeconds = max(0, $endTime - $startTime);

    if ($durationSeconds < 60) {
        $durationText = $durationSeconds . ' second' . ($durationSeconds === 1 ? '' : 's');
    } else {
        $mins = floor($durationSeconds / 60);
        $secs = $durationSeconds % 60;
        $durationText = "{$mins} min {$secs} sec ({$durationSeconds} total seconds)";
    }
} else {
    // Session had already expired or was not found
    $durationSeconds = 0;
    $durationText = "0 seconds (Session expired)";
    $startTimeFormatted = "N/A";
}

$displayName = $name ? htmlspecialchars($name) : 'User';

// Completely unset and destroy the session
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out | Thank You</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
            padding: 45px 35px;
            width: 100%;
            max-width: 480px;
            text-align: center;
        }
        .icon-circle {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #d1fae5;
            color: #059669;
            font-size: 2.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        h2 {
            font-size: 2rem;
            color: #065f46;
            margin-bottom: 8px;
        }
        p.subtitle {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 25px;
        }
        .summary-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: left;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 0.92rem;
        }
        .summary-row:last-child {
            border-bottom: none;
            padding-top: 12px;
            font-size: 1rem;
            font-weight: 700;
        }
        .summary-row .label {
            color: #64748b;
        }
        .summary-row .value {
            color: #0f172a;
            font-weight: 600;
        }
        .summary-row.duration-highlight {
            background: #ecfdf5;
            margin: 10px -10px -10px;
            padding: 12px 10px;
            border-radius: 8px;
            color: #047857;
        }
        .summary-row.duration-highlight .value {
            color: #047857;
            font-size: 1.1rem;
        }
        .btn-restart {
            display: inline-block;
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 8px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-restart:hover {
            box-shadow: 0 8px 18px rgba(16, 185, 129, 0.4);
            transform: translateY(-1px);
        }
        .nav-links {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
            font-size: 0.88rem;
        }
        .nav-links a {
            color: #64748b;
            text-decoration: none;
        }
        .nav-links a:hover {
            color: #0f172a;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="icon-circle">&#10003;</div>
    <h2>Thank You, <?php echo $displayName; ?>!</h2>
    <p class="subtitle">Your session has been securely closed.</p>

    <div class="summary-box">
        <div class="summary-row">
            <span class="label">Session User</span>
            <span class="value"><?php echo $displayName; ?></span>
        </div>
        <div class="summary-row">
            <span class="label">Start Time</span>
            <span class="value"><?php echo htmlspecialchars($startTimeFormatted); ?></span>
        </div>
        <div class="summary-row">
            <span class="label">Logout Time</span>
            <span class="value"><?php echo htmlspecialchars($endTimeFormatted); ?></span>
        </div>
        <div class="summary-row duration-highlight">
            <span class="label" style="color: #065f46; font-weight: 700;">Duration of Usage:</span>
            <span class="value"><?php echo htmlspecialchars($durationText); ?></span>
        </div>
    </div>

    <a href="index.php" class="btn-restart">Start New Session</a>

    <div class="nav-links">
        <a href="../index.php">&larr; Return to Main Portal</a>
    </div>
</div>

</body>
</html>
