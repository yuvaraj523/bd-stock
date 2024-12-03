<?php
include('db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the hashed password from the database for the entered username
    $sql = "SELECT password FROM login WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct; log in the user
            $_SESSION['username'] = $username;
            header("Location: add-quotations.php"); // Redirect to the dashboard or another page
            exit();
        } else {
            // Set the error message in session
            $_SESSION['login_error'] = "Invalid username or password.";
        }
    } else {
        // Set the error message in session
        $_SESSION['login_error'] = "Invalid username or password.";
    }

    $stmt->close();
}


$con->close();
?>

<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <img class="img-fluid logo-dark mb-2 logo-color" src="assets/img/bd-logo.png" alt="Logo">
                <img class="img-fluid logo-light mb-2" src="assets/img/bd-logo.png" alt="Logo">
                <div class="loginbox mt-5">
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            <form method="POST" action="">
                                <div class="input-block mb-3">
                                    <label class="form-control-label">Email Address</label>
                                    <input type="email" class="form-control" name="username" required>
                                </div>
                                <div class="input-block mb-3">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" name="password" required>
                                        <span class="fas fa-eye toggle-password"></span>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-primary w-100" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="assets/js/jquery-3.7.1.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script src="assets/js/script.js"></script>

    <script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['login_error'])): ?>
            toastr.options = {
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };
            toastr.error("<?php echo htmlspecialchars($_SESSION['login_error']); ?>");
            <?php unset($_SESSION['login_error']); // Unset the session variable ?>
        <?php endif; ?>
    });
</script>
</body>
</html>


