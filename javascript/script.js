// JavaScript function to show the receipt and darken the background
function showReceipt() {
    document.getElementById('receipt-container').style.display = 'block'; // Show the receipt
    document.getElementById('overlaylay').classList.add('show-overlaylay');
}