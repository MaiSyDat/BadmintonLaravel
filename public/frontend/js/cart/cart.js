const quantityInput = document.getElementById("quantityInput");
const hiddenQuantity = document.getElementById("hiddenQuantity");

function increaseQuantity() {
    quantityInput.value = parseInt(quantityInput.value) + 1;
    updateHiddenQuantity();
}

function decreaseQuantity() {
    if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
        updateHiddenQuantity();
    }
}

function updateHiddenQuantity() {
    hiddenQuantity.value = quantityInput.value;
}

// Đảm bảo hidden input luôn sync nếu người dùng nhập tay
quantityInput.addEventListener("input", updateHiddenQuantity);
