

<?php
session_start();

include_once("connection.php");
$query = "SELECT text, date FROM entries WHERE user_id='" . $_SESSION['id'] . "' LIMIT 10";
$result = mysqli_query($dbConnection, $query);
$encode = array();
while ($row = mysqli_fetch_assoc($result)) {
    $encode[] = $row;
}

echo json_encode($encode);

?>



