<?php

session_start();

include_once("connection.php");

$query = "SELECT title, text, date FROM entries WHERE user_id=" . $_SESSION['id'];
$result = mysqli_query($dbConnection, $query);

$tempArray = array();

while ($row = $result->fetch_assoc()) {
    $tempArray[] = $row;
}
echo json_encode($tempArray);


mysqli_close($dbConnection);


?>