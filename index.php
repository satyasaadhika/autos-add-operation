<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Priyanshu Maurya | Autos Database</title>

  <!-- Bootstrap 5 CSS -->
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >

  <!-- Custom CSS -->
  <style>
    body {
      background: linear-gradient(135deg, #007bff, #6610f2);
      color: #fff;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      background: #ffffff;
      color: #333;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 40px 50px;
      max-width: 600px;
      text-align: center;
    }

    h1 {
      font-weight: 700;
      margin-bottom: 20px;
      color: #0d6efd;
    }

    a {
      color: #0d6efd;
      text-decoration: none;
      transition: 0.3s;
    }

    a:hover {
      color: #6610f2;
      text-decoration: underline;
    }

    .btn-custom {
      background-color: #0d6efd;
      color: #fff;
      border: none;
      padding: 10px 25px;
      border-radius: 30px;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #6610f2;
      transform: scale(1.05);
    }

    .note {
      font-size: 14px;
      margin-top: 15px;
      color: #555;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Welcome to Autos Database 🚗</h1>
    <p class="lead">Manage your automobile records easily and securely.</p>
    <hr>
    <p>
      <a href="login.php" class="btn btn-custom">Please Log In</a>
    </p>

    <div class="note">
      <p>Attempt to go to <a href="view.php">view.php</a> without logging in — it should fail with an error message.</p>
      <p>Attempt to go to <a href="add.php">add.php</a> without logging in — it should fail with an error message.</p>
    </div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
