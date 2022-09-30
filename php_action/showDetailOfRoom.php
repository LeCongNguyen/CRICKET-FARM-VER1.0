<!DOCTYPE html>
<html>

<head>
    <title>CricketFarm</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!--link boostrap 4.0 online-->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'>
    <link rel='stylesheet' href='../css/index.css'>
</head>

<body>
    <div class='container-fluid'>
        <div class='row'>
            <?php
            showDetailOfRoom();
            ?>
        </div>
    </div>

    <script src="../js_action/resetBtn.js"></script>
</body>

</html>


<!-- ============================================================= -->
<?php
function showDetailOfRoom()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $room_id = $_GET["roomId"];
        $dbservername = $_GET["dbservername"];
        $dbusername = $_GET["dbusername"];
        $dbpassword = $_GET["dbpassword"];
        $dbname = $_GET["dbname"];
        echo
        "<div id='database-info' style='display:none;'>dbservername=$dbservername, dbusername=$dbusername, dbpassword=$dbpassword, dbname=$dbname</div>";
    }
    //create connection to database
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //------------------------------------------------------
    $sql = "SELECT * FROM detail_of_room_$room_id ORDER BY id ASC";
    if ($result = $conn->query($sql)) {
        $barn_quantity = 0;
        while ($row = $result->fetch_assoc()) {
            $barn_id = $row["id"];
            $incubation_day = $row["incubation_day"];
            $hatching_day = $row["hatching_day"];
            $bran_consumed = $row["bran_consumed"];
            $veget_consumed = $row["veget_consumed"];
            //-----------------------------------------------------------------------
            //Xử lý hiển thị ngày tháng
            $days_of_age = "";
            $INCUBATION_DAY = "";
            $HATCHING_DAY = "";
            if ($incubation_day == "0000-00-00") {
                $days_of_age = "Chưa xuống giống";
            } elseif ($hatching_day == "0000-00-00") {
                $INCUBATION_DAY = date("d/m/Y", strtotime($incubation_day));
                $days_of_age = "Chưa nở";
            } else {
                $first_date = strtotime($hatching_day);
                $second_date = strtotime(date("y-m-d"));
                $datediff = abs($first_date - $second_date);
                $days_of_age = ($datediff / (60 * 60 * 24)) . " ngày tuổi";
                $INCUBATION_DAY = date("d/m/Y", strtotime($incubation_day));
                $HATCHING_DAY = date("d/m/Y", strtotime($hatching_day));
            }
            //-----------------------------------------------------------------------
            echo
            "<div class='col-lg-3'>
                <div class='card'>
                    <div class='card-body'>
                        <div class='row-name'>
                            <h4 class='card-title'><b>CHUỒNG $room_id.$barn_id</b></h4>
                            <button id='reset-btn-$room_id.$barn_id' class='btn btn-danger head-btn reset-btn'>reset</button>
                        </div>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item'>Ngày ấp: $INCUBATION_DAY</li>
                            <li class='list-group-item'>Ngày nở:  $HATCHING_DAY</li>
                            <li class='list-group-item'>Tiêu thụ cám:  $bran_consumed kg</li>
                            <li class='list-group-item'>Tiêu thụ rau:  $veget_consumed kg</li>
                            <li class='list-group-item list-group-final-item'><h5>$days_of_age</h5></li>
                            <button class='btn btn-primary'>cập nhật</button>
                        </ul>
                    </div>
                </div>
            </div>";
            ++$barn_quantity;
        }
        //update số lượng chuồng của phòng vào bảng room_parameters
        $sql = "UPDATE room_parameters SET barn_quantity=$barn_quantity WHERE id = $room_id";
        //Phải có lệnh if này mới update được
        if ($conn->query($sql) === TRUE) {
            // echo "The change updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
?>
