const alert = document.querySelector(".alert");

if (alert) {
    setTimeout(() => {
        alert.classList.add("fade-out");

        setTimeout(() => {
            alert.remove();
        }, 500);
    }, 3000);
}
