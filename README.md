# PHP Web Applications Suite

This project contains solutions for three PHP web applications and scripts:

1. **Application A**: A web application that takes a name as input, shows a hello page with the name from the request, displays the session start time at the top-right corner, provides a logout button, and calculates and displays the duration of usage on a Thank You logout page using PHP Sessions (`$_SESSION`).
2. **Application B**: A PHP program displaying the current Date, Time, and Day using standard PHP `date()` functions and timezone management.
3. **Application C**: A web application taking name and age from an HTML page. If the age is less than 18, it displays *"Hello &lt;name&gt;, you are not authorized to visit the site"*; otherwise, it displays *"Welcome to this site"*.

---

## Directory Structure

```text
siddanth/
├── index.php                 # Master navigation portal
├── README.md                 # Documentation and execution guide
├── part_a/                   # Application A: Session Tracker
│   ├── index.php             # Name input form
│   ├── hello.php             # Hello greeting with top-right start time & logout button
│   └── logout.php            # Thank You page with duration of usage and session destruction
├── part_b/                   # Application B: Date, Time & Day
│   └── datetime.php          # Date, Time & Day display script
└── part_c/                   # Application C: Age Verification
    ├── index.php             # Name & Age input form
    └── verify.php            # Age check (<18 unauthorized vs >=18 welcome)
```

---

## How to Run

### Method 1: Using PHP's Built-in Web Server (Recommended)
If PHP is installed on your system:
1. Open PowerShell or Command Prompt in this folder (`c:\Users\Sanchit\OneDrive\Desktop\siddanth`).
2. Run:
   ```bash
   php -S localhost:8000
   ```
3. Open your web browser and navigate to:
   - **Main Portal**: `http://localhost:8000/index.php`
   - **Application A**: `http://localhost:8000/part_a/index.php`
   - **Application B**: `http://localhost:8000/part_b/datetime.php`
   - **Application C**: `http://localhost:8000/part_c/index.php`

### Method 2: Using XAMPP / WAMP / Laragon
1. Copy or move the `siddanth` folder into your web server's root:
   - For XAMPP: `C:\xampp\htdocs\siddanth`
   - For WAMP: `C:\wamp64\www\siddanth`
2. Start the **Apache** server from the XAMPP / WAMP Control Panel.
3. Open your browser and visit:
   `http://localhost/siddanth/index.php`

---

## Implementation Details

### Application A (Session Usage Tracker)
- **Session initialization**: `session_start();` at the beginning of each page.
- **Recording Start Time**: On form submission in `part_a/hello.php`:
  ```php
  $_SESSION['username'] = trim($_REQUEST['name']);
  $_SESSION['start_time'] = time();
  $_SESSION['start_time_formatted'] = date('h:i:s A');
  ```
- **Top-Right Corner Time**: Fixed badge styled with CSS `position: fixed; top: 20px; right: 25px;`.
- **Calculating Duration**: On `part_a/logout.php`:
  ```php
  $durationSeconds = time() - $_SESSION['start_time'];
  ```
- **Session Termination**:
  ```php
  $_SESSION = array();
  session_destroy();
  ```

### Application B (Date, Time & Day)
- **Timezone setting**: `date_default_timezone_set('Asia/Kolkata');`
- **PHP Formats**:
  - Date: `date("d-m-Y")` and `date("F j, Y")`
  - Time: `date("h:i:s A")` (12-hour AM/PM) and `date("H:i:s")` (24-hour)
  - Day: `date("l")` (e.g. Tuesday)

### Application C (Age Verification)
- **Input Sanitization**: `htmlspecialchars(trim($_POST['name']))` and `intval($_POST['age'])`.
- **Conditional Check**:
  ```php
  if ($age < 18) {
      echo "Hello " . $name . ", you are not authorized to visit the site";
  } else {
      echo "Welcome to this site";
  }
  ```
