<?php
// Validate request method and inputs
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['name']) || !isset($_POST['age'])) {
    header('Location: index.php');
    exit;
}

$rawName = trim($_POST['name']);
$age     = intval($_POST['age']);

if ($rawName === '') {
    $rawName = 'Guest';
}

$name = htmlspecialchars($rawName);
$isAuthorized = ($age >= 18);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Result - <?php echo $isAuthorized ? 'Authorized' : 'Access Denied'; ?></title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: <?php echo $isAuthorized ? 'linear-gradient(135deg, #065f46 0%, #047857 50%, #10b981 100%)' : 'linear-gradient(135deg, #7f1d1d 0%, #991b1b 50%, #ef4444 100%)'; ?>;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.3);
            padding: 45px 35px;
            width: 100%;
            max-width: 520px;
            text-align: center;
        }
        .status-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 20px;
            background: <?php echo $isAuthorized ? '#d1fae5' : '#fee2e2'; ?>;
            color: <?php echo $isAuthorized ? '#059669' : '#dc2626'; ?>;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 15px;
            background: <?php echo $isAuthorized ? '#e0f2fe' : '#fee2e2'; ?>;
            color: <?php echo $isAuthorized ? '#0369a1' : '#991b1b'; ?>;
        }
        h1.message {
            font-size: 1.65rem;
            margin-bottom: 12px;
            color: <?php echo $isAuthorized ? '#065f46' : '#991b1b'; ?>;
            line-height: 1.4;
            word-break: break-word;
        }
        p.details {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .info-pill-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        .info-pill {
            background: #f1f5f9;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #334155;
        }
        .info-pill strong {
            color: #0f172a;
        }
        .btn-action {
            display: inline-block;
            padding: 13px 32px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            color: #ffffff;
            transition: all 0.2s ease;
            background: <?php echo $isAuthorized ? 'linear-gradient(135deg, #059669 0%, #10b981 100%)' : 'linear-gradient(135deg, #dc2626 0%, #ef4444 100%)'; ?>;
            box-shadow: 0 4px 14px <?php echo $isAuthorized ? 'rgba(16, 185, 129, 0.4)' : 'rgba(239, 68, 68, 0.4)'; ?>;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px <?php echo $isAuthorized ? 'rgba(16, 185, 129, 0.5)' : 'rgba(239, 68, 68, 0.5)'; ?>;
        }
        .nav-links {
            margin-top: 25px;
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
    <?php if ($isAuthorized): ?>
        <!-- Access Granted: Age >= 18 -->
        <div class="status-icon">&#10004;</div>
        <span class="status-badge">Access Granted</span>
        <h1 class="message">Welcome to this site</h1>
        <p class="details">
            Hello <strong><?php echo $name; ?></strong>, your age verification was successful and you are authorized to view full content on this site.
        </p>

        <div class="info-pill-container">
            <div class="info-pill">Name: <strong><?php echo $name; ?></strong></div>
            <div class="info-pill">Age: <strong><?php echo $age; ?></strong> (&ge; 18)</div>
        </div>

        <a href="index.php" class="btn-action">Verify Another User</a>

    <?php else: ?>
        <!-- Access Denied: Age < 18 -->
        <div class="status-icon">&#10006;</div>
        <span class="status-badge">Access Restricted</span>
        <h1 class="message">Hello <?php echo $name; ?>, you are not authorized to visit the site</h1>
        <p class="details">
            This website requires visitors to be at least 18 years old. As entered, your age is <strong><?php echo $age; ?></strong>.
        </p>

        <div class="info-pill-container">
            <div class="info-pill">Name: <strong><?php echo $name; ?></strong></div>
            <div class="info-pill">Age: <strong><?php echo $age; ?></strong> (&lt; 18)</div>
        </div>

        <a href="index.php" class="btn-action">Go Back &amp; Retry</a>
    <?php endif; ?>

    <div class="nav-links">
        <a href="../index.php">&larr; Return to Main Portal</a>
    </div>
</div>

</body>
</html>
