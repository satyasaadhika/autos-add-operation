<?php
session_start();

if (!isset($_SESSION['name'])) {
    die('Not logged in');
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

$autos = [];
$all_autos = $pdo->query("SELECT * FROM autos");
while ($row = $all_autos->fetch(PDO::FETCH_OBJ)) {
    $autos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Autos | Priyanshu Maurya</title>

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

    .view-container {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 40px 50px;
      width: 100%;
      max-width: 850px;
      animation: fadeIn 0.7s ease-in-out;
    }

    h1 {
      color: #0d6efd;
      font-weight: 700;
      text-align: center;
      margin-bottom: 25px;
    }

    .status-msg {
      text-align: center;
      font-weight: 500;
      margin-bottom: 15px;
    }

    .btn-custom {
      border-radius: 25px;
      padding: 10px 20px;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      transform: scale(1.05);
    }

    table {
      margin-top: 20px;
      border-radius: 10px;
      overflow: hidden;
    }

    table thead {
      background-color: #0d6efd;
      color: white;
    }

    table tbody tr:nth-child(even) {
      background-color: #f8f9fa;
    }

    .no-records {
      text-align: center;
      color: #555;
      font-style: italic;
      margin-top: 15px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="view-container">
    <h1>🚗 Tracking Autos for <?php echo $name; ?></h1>

    <?php
      if ($status !== false) {
          echo '<p class="status-msg" style="color: ' . htmlentities($status_color) . ';">' . htmlentities($status) . '</p>';
      }
    ?>

    <div class="d-flex justify-content-center mb-4 gap-3">
      <a href="add.php" class="btn btn-primary btn-custom">➕ Add New</a>
      <a href="logout.php" class="btn btn-outline-secondary btn-custom">🚪 Logout</a>
    </div>

    <?php if (!empty($autos)) : ?>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Make</th>
              <th scope="col">Year</th>
              <th scope="col">Mileage</th>
            </tr>
          </thead>
          <tbody>
            <?php $count = 1; foreach ($autos as $auto) : ?>
              <tr>
                <th scope="row"><?php echo $count++; ?></th>
                <td><?php echo htmlentities($auto->make); ?></td>
                <td><?php echo htmlentities($auto->year); ?></td>
                <td><?php echo htmlentities($auto->mileage); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else : ?>
      <p class="no-records">No automobile records found.</p>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
