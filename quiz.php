<?php
session_start();

include('db.php');

if (isset($_GET['categoryid'])) {
    $categoryid = $_GET['categoryid'];
    
    // Fetch random questions for the selected category
    $sql_questions = "SELECT * FROM questions WHERE categoryid=$categoryid ORDER BY RAND() LIMIT 15";
    $result_questions = $conn->query($sql_questions);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($result_questions) && $result_questions->num_rows > 0) {
            echo "<h2>Quiz Questions</h2>";
            echo "<form action='submit_quiz.php' method='post'>";
            while($row_question = $result_questions->fetch_assoc()) {
                $questionid = $row_question["questionid"];
                echo "<h3>" . $row_question["question_text"] . "</h3>";
                
                // Fetch options for each question
                $sql_options = "SELECT * FROM options WHERE questionid=$questionid";
                $result_options = $conn->query($sql_options);
                
                // Display options as radio buttons
                while($row_option = $result_options->fetch_assoc()) {
                    echo "<input type='radio' name='question_$questionid' value='" . $row_option["optionid"] . "'>";
                    echo "<label>" . $row_option["option_text"] . "</label><br>";
                }
            }
            echo "<br><button type='submit'>Submit Quiz</button>";
            echo "</form>";
        } else {
            echo "No questions available for this category.";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
