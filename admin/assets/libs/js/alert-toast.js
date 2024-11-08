const t_tbody = document.getElementById('temp_table');
var toastLiveExample = document.getElementById('liveToast');
var toastBackdrop = document.getElementById('toastBackdrop');

document.addEventListener("DOMContentLoaded", function() {
    if (typeof alertType !== 'undefined' && typeof alertMessage !== 'undefined') {
        show_alert(alertType, alertMessage);

        // Check if there is a redirect URL
        if (redirectUrl !== "") {
            setTimeout(function() {
                window.location.href = redirectUrl;
            }, 3000); // Redirect after 3 seconds
        } else {
            // Hide the toast after 3 seconds if there's no redirect URL
            setTimeout(function() {
                hide_alert();
            }, 3000);
        }
    }
});

// Alert Call Function
function show_alert(mode, msg) {
    document.getElementById("alert_msg").innerText = msg;
    switch (mode) {
        case 'error':
            toastLiveExample.classList.remove("bg-success");
            toastLiveExample.classList.add("bg-danger");
            break;
        case 'success':
            toastLiveExample.classList.remove("bg-danger");
            toastLiveExample.classList.add("bg-success");
            break;
    }

    // Add text color class
    toastLiveExample.classList.add("text-light");

    // Show the toast and backdrop
    toastLiveExample.style.display = 'block';
    toastBackdrop.style.display = 'block';
}

// Hide Alert Function
function hide_alert() {
    toastLiveExample.style.display = 'none';
    toastBackdrop.style.display = 'none';
}