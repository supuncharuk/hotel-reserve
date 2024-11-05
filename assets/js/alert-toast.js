const t_tbody = document.getElementById('temp_table');
var toastLiveExample = document.getElementById('liveToast');
var toastBackdrop = document.getElementById('toastBackdrop');
const toast = new bootstrap.Toast(toastLiveExample);

document.addEventListener("DOMContentLoaded", function() {
    if (typeof alertType !== 'undefined' && typeof alertMessage !== 'undefined') {
        show_alert(alertType, alertMessage);

        // Check if redirect URL exists for success alerts
        // if (alertType === "success" && redirectUrl) {
        //     setTimeout(function() {
        //         window.location.href = redirectUrl;
        //     }, 3000); // Redirect after 3 seconds
        // }

        if (redirectUrl != "") {
            setTimeout(function() {
                window.location.href = redirectUrl;
            }, 3000); // Redirect after 3 seconds
        }
    }
});

//Alert Call Function
function show_alert(mode,msg){
    alert_msg.innerText = msg;
    switch (mode) {
        // case 'err':
        //     toastLiveExample.style.background = "#ff4a4a";
        //     toastLiveExample.style.color = "white";
        //     break;
        // case 'succ':
        //     toastLiveExample.style.background = "#32CD32";
        //     toastLiveExample.style.color = "white";
        //     break;
        case 'error':
            toastLiveExample.classList.remove("bg-success");
            toastLiveExample.classList.add("bg-danger");
            break;
        case 'success':
            toastLiveExample.classList.remove("bg-danger");
            toastLiveExample.classList.add("bg-success");
            break;
    }
    //Add text color class
    toastLiveExample.classList.add("text-light");

    toast.show();

    toastBackdrop.style.display = 'block';

    window.setTimeout(function(){
        toastBackdrop.style.display = 'none';
        // location.reload();    
    } ,3000);

                        
}