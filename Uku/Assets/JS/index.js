function addCartFailed() {
    alert("You must login");
}

function delivery() {
    // alert("sadsadasda");
    var checkBox = document.getElementById("myCheck");
    if (checkBox.checked == true) {
        document.getElementById("delivery").innerText = "Fast";
        document.getElementById("ship").innerText = 45000;
    } else {
        document.getElementById("delivery").innerText = "Normal";
        document.getElementById("ship").innerText = 35000;
    }

}