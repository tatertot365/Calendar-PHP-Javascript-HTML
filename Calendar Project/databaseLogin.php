
<?php
    session_start();

    $username = $_POST["lusername"];
    $password = $_POST["lpassword"];
    
    $_SESSION["username"] = $_POST["lusername"];


    $conn = new mysqli('localhost', 'root', 'root', 'Project_5_Users', 8889);

    if ($conn->connect_error) {
        echo 'Errno: '.$conn->connect_errno;
        echo '<br>';
        echo 'Error: '.$conn->connect_error;
        exit();
    }

    $sql = "SELECT * FROM Users WHERE Username = '$username' AND Password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $sql_UserID = "SELECT User_ID FROM Users WHERE Username = '$username'";

        $result1 = mysqli_query($conn, $sql_UserID);

        if (mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $User_ID = (int)$row['User_ID'];
        }
    }

    $conn->close();
    echo "<script>window.open('calendar.html')</script>";
?>