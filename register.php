<?php
session_start();
include "db.php";
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Insert user into database without email verification
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<p class='alert alert-success text-center'>Registration successful! <a href='login.php'>Login now</a></p>";
    } else {
        echo "<p class='alert alert-danger text-center'>Error: " . $stmt->error . "</p>";
    }
}
?>

<div class="container mt-5">
    <div class="card mx-auto shadow-lg" style="max-width: 400px;">
        <div class="card-body">
            <h3 class="text-center">Create an Account</h3>
            <form method="post">
                <input type="text" name="name" class="form-control mb-2" required placeholder="Full Name">
                <input type="email" name="email" class="form-control mb-2" required placeholder="Email">
                <input type="password" name="password" class="form-control mb-2" required placeholder="Password">
                <button type="submit" class="btn btn-primary w-100">Register</button>
                <p class="text-center mt-2">Already have an account? <a href="login.php">Login</a></p>
            </form>
            <hr>
            <a href="google_login.php" class="btn btn-danger w-100">Sign Up with Google</a>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
