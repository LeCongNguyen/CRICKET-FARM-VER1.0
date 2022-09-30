<?php
function showRoomParameters($dbservername, $dbname, $dbusername, $dbpassword)
{
    // $dbservername = "localhost";
    // $dbname = "cricket_farm_ver1.0";
    // $dbusername = "root@";
    // $dbpassword = "";
    //create connection to database
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //---------------------------------------
    $sql = "SELECT * FROM room_parameters ORDER BY id ASC";
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $row_id = $row["id"];
            $row_name = $row["name"];
            $row_temp = $row["temp"];
            $row_hum = $row["hum"];
            $row_barn_quantity = $row["barn_quantity"];
            echo
            "<div id='room-$row_id' class='col-lg-3'>
                <div class='card'>
                    <div class='card-body'>
                        <div class='row-name'>
                            <h4 class='card-title'><b>PHÒNG $row_id</b></h4>
                            <form action='../php_action/showDetailOfRoom.php' method='get'>
                                <button id='xem-btn-$row_id' class='btn btn-success head-btn'
                                type='submit' name='roomId' value='$row_id'>xem</button>
                                <input class='http-sent-data' name=dbservername value='$dbservername'></input>
                                <input class='http-sent-data' name=dbusername value='$dbusername'></input>
                                <input class='http-sent-data' name=dbpassword value='$dbpassword'></input>
                                <input class='http-sent-data' name=dbname value='$dbname'></input>
                            </form>
                        </div>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item'>Nhiệt độ: $row_temp&deg;C</li>
                            <li class='list-group-item'>Độ ẩm:  $row_hum%</li>
                            <li class='list-group-item'>Tổng số chuồng: $row_barn_quantity</li>
                        </ul>
                    </div>
                </div>
            </div>";
        }
    }
}

