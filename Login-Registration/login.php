<?php
session_start();
include 'db.php';

$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter email.";
        } else {
            $email = trim($_POST["email"]);
        }
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }
        if (empty($email_err) && empty($password_err)) {
            $sql = "SELECT id, username, email, password FROM users WHERE email = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("s", $param_email);
                $param_email = $email;
                if ($stmt->execute()) {
                    $stmt->store_result();
                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($id, $username, $email, $stored_password);
                        if ($stmt->fetch()) {
                            if ($password == $stored_password) {  // Compare plain text passwords
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                header("location: dashboard.php");
                                exit();
                            } else {
                                $password_err = "The password is incorrect.";
                            }
                        }
                    } else {
                        $email_err = "No account found with that email.";
                    }
                }
                $stmt->close();
            }
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #c0392b;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: white;
            color: black;
            padding: 2rem;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #c0392b;
        }
        .btn-primary {
            background-color: #c0392b;
            border: none;
        }
        .btn-primary:hover {
            background-color: #a83228;
        }
        .form-control:focus {
            border-color: #c0392b;
            box-shadow: none;
        }
        .btn-link {
            color: #c0392b;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Login</h2>
    <form name="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateLoginForm()">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <div class="invalid-feedback"><?php echo $email_err; ?></div>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?php echo $password_err; ?></div>
        </div>
        <div class="d-grid">
            <input type="submit" name="login" class="btn btn-primary" value="Login">
        </div>
        <div class="text-center mt-3">
            <a href="registration.php" class="btn-link">Don't have an account? Register</a>
        </div>
    </form>
</div>

<script>
    function validateLoginForm() {
        let email = document.forms["loginForm"]["email"].value.trim();
        let password = document.forms["loginForm"]["password"].value;
        if (email === "") {
            alert("Email is required.");
            return false;
        }
        if (password === "") {
            alert("Password is required.");
            return false;
        }
        return true;
    }
</script>
</body>
</html>
