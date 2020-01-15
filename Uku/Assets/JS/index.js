function addCartFailed() {
    alert("You must login");
}

function displayOrderForm() {
    document.getElementById("orderForm").style.display = 'grid';
    document.getElementById("btn-order").style.display = 'none';
}

function hideOrderForm() {
    document.getElementById("orderForm").style.display = 'none';
    document.getElementById("btn-order").style.display = 'flex';
}