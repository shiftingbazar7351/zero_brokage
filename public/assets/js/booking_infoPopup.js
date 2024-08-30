$(document).ready(function () {
    // Open the popup when .btn-book is clicked

    $(".book-Now-btn").click(function () {
        $("#myPopup-booking1").addClass("show");
        resetBookingDetails();
    });

    // close the popup

    $("#closePopup-booking1").click(function () {
        // alert("dfsaj");
        $("#myPopup-booking1").removeClass("show");
    });

    $("#saveChanges-booking1").click(function () {
        if (document.getElementById("phoneNumberInput-booking").value == "") {

        } else {
            $("#myPopup-booking").addClass("show");
        resetBookingDetails();
        }
    });

    $("#saveChanges-booking").click(function () {
        $("#myPopup2-booking").addClass("show");
        $("#myPopup-booking").removeClass("show");
        $("#myPopup-booking1").removeClass("show");
        startCountdownBooking(60);
    });

    $("#closePopup-booking").click(function () {
        $("#myPopup-booking").removeClass("show");
        $("#myPopup-booking1").removeClass("show");
    });

    $("#closePopup2-booking").click(function () {
        $("#myPopup2-booking").removeClass("show");
        $("#myPopup-booking1").removeClass("show");
    });

    $("#editnumber-booking").click(function () {
        $("#myPopup2-booking").removeClass("show");
        $("#myPopup-booking").removeClass("show");
        $("#myPopup-booking1").addClass("show");
    });

    $("#verify-otp-booking").click(function () {
        alert("otp verified Succesfully");
    });
});

resendOtpTextBooking.onclick = function () {
    startCountdownBooking(60);
};
otpOnWhatsappBooking.onclick = function () {
    startCountdownBooking(60);
};

//  let interval;
function startCountdownBooking(seconds) {
    let counter = seconds;
    var countdownElement = document.getElementById("counter-booking");
    countdownElement.style.display = "block"; // Show the counter
    countdownElement.innerHTML = counter; // Initialize the counter display

    // Clear any existing interval before starting a new one
    clearInterval(interval);

    interval = setInterval(function () {
        counter--;
        countdownElement.innerHTML = " : " + counter;

        if (counter < 0) {
            clearInterval(interval);
            countdownElement.style.display = "none"; // Hide the counter when it reaches zero
        }
    }, 1000);
}

function resetBookingDetails() {
    document.getElementById("res-booking1").innerHTML = "";
    document.getElementById("checkbox-login-booking").checked = false;

    const inputdetails = document.querySelectorAll(".input-details");
    inputdetails.forEach((inputdetail) => {
        inputdetail.value = "";
    });
}

//    function validateNumBooking(elem){
//     document.getElementById("res-booking").style.color = "red";
//     document.getElementById("res-booking").style.marginTop = "-15px";
//      if(isNaN(elem.value)){
//         document.getElementById('res-booking').innerText="please enter a Number Only"
//      }

//     else {
//         document.getElementById("res-booking").innerText = "";

//         if (elem.value.length < 10) {
//             document.getElementById("res-booking").innerText = "Enter 10 digit number";
//         }

//         if (elem.value[0] == 0) {
//             document.getElementById("res-booking").innerText =
//                 "First character should not be zero";
//         }
//     }
// }

function validateNumBookingg(elemm) {
    document.getElementById("res-booking1").style.color = "red";
    if (isNaN(elemm.value)) {
        document.getElementById("res-booking1").innerText =
            "Please enter number only";
        document
            .getElementById("saveChanges-booking1")
            .classList.add("unclickable");
    } else {
        document.getElementById("res-booking1").innerText = "";
        document
            .getElementById("saveChanges-booking1")
            .classList.remove("unclickable");

        if (elemm.value.length < 10) {
            document.getElementById("res-booking1").innerText =
                "Enter 10 digit number";
            document
                .getElementById("saveChanges-booking1")
                .classList.add("unclickable");
        }

        if (elemm.value[0] == 0) {
            document.getElementById("res-booking1").innerText =
                "First character should not be zero";
            document
                .getElementById("saveChanges-booking1")
                .classList.add("unclickable");
        }
    }
}
