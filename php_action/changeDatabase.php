<?php
$key = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = $_POST["key"];
    //create connection to database
    $conn = new mysqli($_POST["dbservername"], $_POST["dbusername"], $_POST["dbpassword"], $_POST["dbname"]);
    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

//key = resetBarn
if ($key == "resetBarn") {
    $barn_id = $_POST["barnId"];
    $room_id = $_POST["roomId"];
    $sql = "UPDATE detail_of_room_$room_id SET incubation_day='', hatching_day='', bran_consumed=0, 
    veget_consumed=0 WHERE id = $barn_id";
    if ($conn->query($sql) === TRUE) {
        echo "The change updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
