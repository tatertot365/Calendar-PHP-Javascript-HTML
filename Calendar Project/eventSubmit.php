<?php
session_start();

//var_dump($_POST['data']);
$dataObj = json_decode($_POST['data']);

$date = $dataObj->eventDate;
$time = $dataObj->eventTime;
$notes = $dataObj->notes;
$username = $_SESSION['username'];


$conn = new mysqli('localhost', 'root', 'root', 'Project_5_Users', 8889);

$sql_UserID = "SELECT User_ID FROM Users WHERE Username = '$username'";

$result = mysqli_query($conn, $sql_UserID);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $User_ID = (int)$row['User_ID'];
}

$sql = "INSERT INTO Events (User_ID, Event_Date, Event_Time, Event_Notes) VALUES ($User_ID, '$date', '$time', '$notes')";

if ($conn->query($sql) === TRUE) {
    #echo "New record created successfully";
    #echo "<script> window.open('calendar.html')</script>";
} else {
    #echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>