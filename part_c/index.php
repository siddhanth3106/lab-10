<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application C - Age Verification &amp; Authorization</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
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
            padding: 40px 32px;
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        .badge {
            display: inline-block;
            background: #e0e7ff;
            color: #4338ca;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }
        h2 {
            color: #1e293b;
            font-size: 1.6rem;
            margin-bottom: 10px;
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
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: all 0.2s ease;
        }
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            border: none;
            border-radius: 8px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(79, 70, 229, 0.35);
        }
        .hint {
            margin-top: 15px;
            font-size: 0.82rem;
            color: #94a3b8;
            background: #f8fafc;
            padding: 10px;
            border-radius: 6px;
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
    <span class="badge">Application C</span>
    <h2>Site Verification Portal</h2>
    <p class="subtitle">Enter your name and age to check entry authorization</p>

    <form action="verify.php" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required autofocus>
        </div>

        <div class="form-group">
            <label for="age">Age (in years)</label>
            <input type="number" id="age" name="age" min="1" max="130" placeholder="e.g. 20" required>
        </div>

        <button type="submit" class="btn-submit">Verify Authorization</button>
    </form>

    <div class="hint">
        <strong>Rule:</strong> Visitors under 18 years old are restricted from entering the site.
    </div>

    <a href="../index.php" class="back-nav">&larr; Back to Main Portal</a>
</div>

</body>
</html>
