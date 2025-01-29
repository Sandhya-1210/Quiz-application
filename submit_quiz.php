<?php
session_start();

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_questions = 15;
    $correct_answers = 0;

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question_') === 0) {
            $questionid = substr($key, 9);
            $selected_option = $value;
            
            $sql_correct_option = "SELECT * FROM options WHERE questionid=$questionid AND optionid=$selected_option AND is_correct=1";
            $result_correct_option = $conn->query($sql_correct_option);
            
            if ($result_correct_option->num_rows > 0) {
                $correct_answers++;
            }
        }
    }
    
    $score = ($correct_answers / $total_questions) * 100;
    
    echo "<h2>Quiz Results</h2>";
    echo "<p>You scored: $correct_answers / $total_questions</p>";
    
    echo "<h3>Correct Answers</h3>";
    echo "<ul>";
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question_') === 0) {
            $questionid = substr($key, 9);
            
            $sql_correct_option = "SELECT option_text FROM options WHERE questionid=$questionid AND is_correct=1";
            $result_correct_option = $conn->query($sql_correct_option);
            
            if ($result_correct_option->num_rows > 0) {
                $row_correct_option = $result_correct_option->fetch_assoc();
                echo "<li>" . $row_correct_option["option_text"] . "</li>";
            }
        }
    }
    echo "</ul>";
}