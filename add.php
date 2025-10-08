<?php
session_start();

if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

if (isset($_POST['logout'])) {
    header('Location: logout.php');
    return;
}

$status = false;

if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    $status_color = $_SESSION['color'];
    unset($_SESSION['status']);
    unset($_SESSION['color']);
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=autosdb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

$name = htmlentities($_SESSION['name']);
$_SESSION['color'] = 'red';

if (isset($_POST['mileage']) && isset($_POST['year']) && isset($_POST['make'])) {
    if (!is_numeric($_POST['mileage']) || !is_numeric($_POST['year'])) {
        $_SESSION['status'] = "Mileage and year must be numeric";
        header("Location: add.php");
        return;
    } elseif (strlen($_POST['make']) < 1) {
        $_SESSION['status'] = "Make is required";
        header("Location: add.php");
        return;
    } else {
        $make = htmlentities($_POST['make']);
        $year = htmlentities($_POST['year']);
        $mileage = htmlentities($_POST['mileage']);

        $stmt = $pdo->prepare("INSERT INTO autos (make, year, mileage) VALUES (:make, :year, :mileage)");
        $stmt->execute([
            ':make' => $make,
            ':year' => $year,
            ':mileage' => $mileage,
        ]);

        $_SESSION['status'] = 'Record inserted';
        $_SESSION['color'] = 'green';

        header('Location: view.php');
        return;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Autos | Priyanshu Maurya</title>

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

    .add-container {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 40px 50px;
      width: 100%;
      max-width: 480px;
      animation: fadeIn 0.7s ease-in-out;
    }

    h1 {
      color: #0d6efd;
      font-weight: 700;
      margin-bottom: 20px;
      text-align: center;
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

    .status-msg {
      font-weight: 500;
      text-align: center;
      margin-bottom: 20px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="add-container">
    <h1>🚘 Add New Auto</h1>
    <p class="text-center mb-4 text-muted">Tracking Autos for <strong><?php echo $name; ?></strong></p>

    <?php
      if ($status !== false) {
          echo '<p class="status-msg" style="color: ' . htmlentities($status_color) . ';">' . htmlentities($status) . '</p>';
      }
    ?>

    <form method="post">
      <div class="mb-3">
        <label for="make" class="form-label fw-semibold">Make</label>
        <input type="text" class="form-control" name="make" id="make" placeholder="Enter vehicle make">
      </div>

      <div class="mb-3">
        <label for="year" class="form-label fw-semibold">Year</label>
        <input type="text" class="form-control" name="year" id="year" placeholder="Enter vehicle year">
      </div>

      <div class="mb-4">
        <label for="mileage" class="form-label fw-semibold">Mileage</label>
        <input type="text" class="form-control" name="mileage" id="mileage" placeholder="Enter vehicle mileage">
      </div>

      <div class="d-grid gap-2">
        <input type="submit" class="btn btn-custom" value="Add Record">
        <input type="submit" name="logout" class="cancel-btn" value="Cancel">
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
