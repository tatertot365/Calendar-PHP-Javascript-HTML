<?php
session_start();

$username = $_SESSION['username'];

$conn = new mysqli('localhost', 'root', 'root', 'Project_5_Users', 8889);

if ($conn->connect_error) {
    echo 'Errno: '.$conn->connect_errno;
    echo '<br>';
    echo 'Error: '.$conn->connect_error;
    exit();
}

$result = mysqli_query($conn, $sql);

$sql_UserID = "SELECT User_ID FROM Users WHERE Username = '$username'";

$result1 = mysqli_query($conn, $sql_UserID);

if (mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
    $User_ID = (int)$row['User_ID'];
}


$sql1 = "SELECT * FROM Events WHERE User_ID = '$User_ID'";

$result2 = mysqli_query($conn, $sql1);
$eventArray = array();

while ($row = mysqli_fetch_array($result2)) {
    $eventArray[] = array (
        'Event_Date' => $row['Event_Date'],
        'Event_Time' => $row['Event_Time'],
        'Event_Notes' => $row['Event_Notes']
    );
} 

echo json_encode($eventArray);

$conn->close();

?>