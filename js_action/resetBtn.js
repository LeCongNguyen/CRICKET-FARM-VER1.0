let resetBtns = document.querySelectorAll(".reset-btn");
console.log(resetBtns);

for (let i = 0; i < resetBtns.length; i++) {
    resetBtns[i].addEventListener("click", function (event) {
        let btnClicked = event.target.id.slice(10);
        resetAction(btnClicked);
    });
}

function resetAction(btnClicked) {
    let warnMessage = prompt(`Chuồng ${btnClicked} sẽ bị xoá hết thông tin. Nhập \"Y\" nếu bạn muốn tiếp tục!`);
    if(warnMessage == "y" | warnMessage == "Y") {
        let databaseInfo = document.getElementById("database-info").innerHTML.split(", ");
        let dbservername = databaseInfo[0].slice(databaseInfo[0].indexOf("=")+1);
        let dbusername = databaseInfo[1].slice(databaseInfo[1].indexOf("=")+1);
        let dbpassword = databaseInfo[2].slice(databaseInfo[2].indexOf("=")+1);
        let dbname = databaseInfo[3].slice(databaseInfo[3].indexOf("=")+1);
        let room_id = btnClicked.slice(0,1);
        let barn_id = btnClicked.slice(2);
        //http request
        let httpRequest = new XMLHttpRequest();
        httpRequest.open("POST", "../php_action/changeDatabase.php", false);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send("key=resetBarn&barnId=" + barn_id + "&roomId=" + room_id + "&dbservername=" + dbservername + 
        "&dbusername=" + dbusername + "&dbpassword=" + dbpassword + "&dbname=" + dbname);
        console.log(httpRequest.status);
        console.log(httpRequest.responseText);
        location.reload();
    }
}