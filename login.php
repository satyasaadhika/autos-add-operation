<?php
// --- Do not put any HTML above this line ---
session_start();

if (isset($_POST['logout'])) {
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // Pw is php123
$failure = false;

if (isset($_SESSION['failure'])) {
    $failure = $_SESSION['failure'];
    unset($_SESSION['failure']);
}

if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['failure'] = "Email and password are required";
        header("Location: login.php");
        return;
    } else {
        $pass = htmlentities($_POST['pass']);
        $email = htmlentities($_POST['email']);

        if (strpos($email, '@') === false) {
            $_SESSION['failure'] = "Email must have an at-sign (@)";
            header("Location: login.php");
            return;
        } else {
            $check = hash('md5', $salt . $pass);
            if ($check == $stored_hash) {
                error_log("Login success " . $email);
                $_SESSION['name'] = $email;
                header("Location: view.php");
                return;
            } else {
                error_log("Login fail " . $pass . " $check");
                $_SESSION['failure'] = "Incorrect password";
                header("Location: login.php");
                return;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Priyanshu Maurya | Login</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #007bff, #6610f2);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
    }

    .login-container {
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 40px 50px;
      width: 100%;
      max-width: 420px;
      text-align: center;
      animation: fadeIn 0.7s ease-in-out;
    }

    h1 {
      font-weight: 700;
      color: #0d6efd;
      margin-bottom: 25px;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-custom {
      width: 100%;
      background-color: #0d6efd;
      border: none;
      border-radius: 25px;
      padding: 10px;
      color: white;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #6610f2;
      transform: scale(1.05);
    }

    .cancel-btn {
      width: 100%;
      background: #f8f9fa;
      border-radius: 25px;
      padding: 10px;
      border: 1px solid #ced4da;
      transition: 0.3s;
    }

    .cancel-btn:hover {
      background: #dee2e6;
    }

    .error-msg {
      color: #dc3545;
      margin-bottom: 15px;
      font-weight: 500;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    p.hint {
      font-size: 13px;
      color: #555;
      margin-top: 15px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h1>🔐 Please Log In</h1>

    <?php
      if ($failure !== false) {
          echo '<p class="error-msg">'.htmlentities($failure).'</p>';
      }
    ?>

    <form method="post">
      <div class="mb-3 text-start">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input class="form-control" type="text" name="email" id="email" placeholder="Enter your email">
      </div>

      <div class="mb-3 text-start">
        <label for="pass" class="form-label fw-semibold">Password</label>
        <input class="form-control" type="password" name="pass" id="pass" placeholder="Enter your password">
      </div>

      <div class="d-grid gap-2">
        <input class="btn btn-custom" type="submit" value="Log In">
        <input class="cancel-btn" type="submit" name="logout" value="Cancel">
      </div>
    </form>

    <p class="hint">
      For a password hint, view source and find a password hint in the HTML comments.
      <!-- Hint: The password is the four character sound a cat makes (all lower case) followed by 123. -->
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
