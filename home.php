<?php
session_start();

include('db.php');

// Fetch categories from database
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
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
        <h1>Select a Quiz Category</h1>
        <table>
            <tr>
                <th>Category</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result_categories->num_rows > 0) {
                while($row_category = $result_categories->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_category["category_name"] . "</td>";
                    echo "<td><a href='quiz.php?categoryid=" . $row_category["categoryid"] . "'>Start Quiz</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No categories found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
