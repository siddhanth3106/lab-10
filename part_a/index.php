<?php
session_start();
// If already logged in, provide quick redirect or allow new login
$already_logged_in = isset($_SESSION['username']) && isset($_SESSION['start_time']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application A - Name Input & Session Tracker</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            width: 100%;
            max-width: 440px;
            text-align: center;
        }
        .badge {
            display: inline-block;
            background: #e0e7ff;
            color: #4338ca;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        h2 {
            color: #1e293b;
            margin-bottom: 10px;
            font-size: 1.6rem;
        }
        p.subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #334155;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: all 0.25s ease;
        }
        input[type="text"]:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(102, 126, 234, 0.4);
        }
        .btn-submit:active {
            transform: translateY(0);
        }
        .active-session-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-align: left;
        }
        .active-session-box a {
            color: #15803d;
            font-weight: bold;
            text-decoration: underline;
        }
        .back-nav {
            margin-top: 25px;
            display: block;
            color: #64748b;
            text-decoration: none;
            font-size: 0.88rem;
        }
        .back-nav:hover {
            color: #334155;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <span class="badge">Application A</span>
    <h2>Welcome</h2>
    <p class="subtitle">Enter your name to begin your tracked session</p>

    <?php if ($already_logged_in): ?>
        <div class="active-session-box">
            Currently active session for <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>.<br>
            <a href="hello.php">Return to Hello Page</a> or enter a new name below to overwrite.
        </div>
    <?php endif; ?>

    <form action="hello.php" method="POST">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="e.g. John Doe" required autofocus>
        </div>
        <button type="submit" class="btn-submit">Submit &amp; Enter</button>
    </form>

    <a href="../index.php" class="back-nav">&larr; Back to Main Portal</a>
</div>

</body>
</html>
