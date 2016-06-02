<?php

session_start();

include_once("connection.php");

$user_id = $_SESSION['id'];

$date = date('Y-m-d H:i:s');
$title = $_POST['title'];
$text = $_POST['text'];

$query = "INSERT INTO entries (`user_id`, `date`, `title`, `text`) VALUES('$user_id', '$date', '$title', '$text')";
if (mysqli_query($dbConnection, $query)) {
    //new entry inserted
    $newEntry = array(
        'title' => $title,
        'text' => $text,
        'date' => $date
        );
}

echo json_encode($newEntry);

mysqli_close($dbConnection);






