<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #c0392b;
            min-height: 100vh;
            color: white;
            font-family: Arial, sans-serif;
        }
        .dashboard-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            color: black;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            text-align: center;
        }
        h1 {
            color: #c0392b;
            margin-bottom: 1.5rem;
        }
        .btn-logout {
            background-color: #c0392b;
            border: none;
            color: white;
        }
        .btn-logout:hover {
            background-color: #a83228;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
    <p>You have successfully logged in.</p>
    <a href="logout.php" class="btn btn-logout">Logout</a>
</div>
</body>
</html>
