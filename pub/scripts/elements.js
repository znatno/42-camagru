function showAlert(message, status = "default") {
    // Get the snackbar DIV & clear classes
    const x = document.getElementById("snackbar");
    x.className = "";

    // Add the "show" class to DIV
    x.classList.toggle("show");
    // Apply text
    x.innerText = message;
    // Apply status
    switch (status.toLowerCase()) {
        case ("error"):
            x.classList.add("bg-danger");
            break;
        case ("success"):
            x.classList.add("bg-success");
            break;
        default:
            x.classList.add("bg-primary");
    }

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.classList.toggle("show"); }, 4000);
}

// Back to top in the footer
window.addEventListener("DOMContentLoaded", () => {
    let contentHeight = document.getElementsByTagName("body")[0].clientHeight;
    let contentRelativeHeight = contentHeight / window.innerHeight;

    if (contentRelativeHeight <= 1) {
        document.getElementById("to-top-btn").style.display = "none";
    }
});