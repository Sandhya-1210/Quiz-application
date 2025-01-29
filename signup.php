<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $check_username = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($check_username);
    
    if ($result->num_rows > 0) {
        $error = "Username already exists. Please choose a different username.";
    } else {
        $insert_user = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
        if ($conn->query($insert_user) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $insert_user . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Signup</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Signup</h1>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <form action="signup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Signup</button>
        </form>
    </div>
</body>
</html>

