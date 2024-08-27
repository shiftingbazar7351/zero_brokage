
$(document).ready(function() {
    // Open the popup when .btn-book is clicked

    $('.book-Now-btn').click(function() {
        // alert();
             $('#myPopup-booking1-india').addClass('show');
             resetBookingDetails();
        });

   // close the popup

    $('#closePopup-booking1-india').click(function() {
        // alert("dfsaj");
        $('#myPopup-booking1-india').removeClass('show');
    });


    $('#saveChanges-booking1-india').click(function() {
        $('#myPopup-booking-india').addClass('show');
        $('#myPopup-booking1-india').removeClass('show');
        resetBookingDetails();
    });

    $('#saveChanges-booking-india').click(function() {
            $('#myPopup2-booking-india').addClass('show');
            $('#myPopup-booking-india').removeClass('show');
            $('#myPopup-booking1-india').removeClass('show');
            startCountdownBooking(60);
        });

    $('#closePopup-booking-india').click(function() {
        $('#myPopup-booking-india').removeClass('show');
        $('#myPopup-booking1-india').removeClass('show');
    });


    $('#closePopup2-booking-india').click(function() {
        $('#myPopup2-booking-india').removeClass('show');
        $('#myPopup-booking1-india').removeClass('show');

    });


    $('#editnumber-booking-india').click(function() {
        $('#myPopup2-booking-india').removeClass('show');
        $('#myPopup-booking-india').removeClass('show');
        $('#myPopup-booking1-india').addClass('show');
    });

    $('#verify-otp-booking').click(function() {
        alert("otp verified Succesfully");
    });



});


resendOtpTextBookingg.onclick = function() {
    startCountdownBooking(60);
}
otpOnWhatsappBookingg.onclick = function(){
    startCountdownBooking(60)
}



 let interval;
function startCountdownBooking(seconds) {
    let counter = seconds;
    var countdownElement = document.getElementById("counter-booking-india");
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






function resetBookingDetails(){
    // alert("dsaf")
    document.getElementById('res-booking1-india').innerHTML="";
    document.getElementById('checkbox-login-india').checked=false;
    // document.getElementById('checkbox-login-booking1').checked=false;

    // document.getElementById('res-booking').innerText='';
    const inputdetailss = document.querySelectorAll('.input-detailss');
    inputdetailss.forEach(inputdetails => {
        inputdetails.value ='';
        });

        // document.getElementById('res-booking1').innerHTML="";

   }


// Example of how to use the function
// Call resetInputFields() whenever you want to reset the fields



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


function validateNumBookingg(elemm){
    document.getElementById("res-booking1-india").style.color = "red";
    if (isNaN(elemm.value)) {
        document.getElementById("res-booking1-india").innerText = "please enter number only";
        document.getElementById("saveChanges-booking1-india").classList.add("unclickable");
    } else {
        document.getElementById("res-booking1-india").innerText = "";
        document.getElementById("saveChanges-booking1-india").classList.remove("unclickable");

        if (elemm.value.length < 10) {
            document.getElementById("res-booking1-india").innerText = "Enter 10 digit number";
            document.getElementById("saveChanges-booking1-india").classList.add("unclickable");
        }

        if (elemm.value[0] == 0) {
            document.getElementById("res-booking1-india").innerText =
                "First character should not be zero";
            document.getElementById("saveChanges-booking1-india").classList.add("unclickable");
        }
    }
}



function resetValue(){
    // alert();
    document.getElementById('input-keyword-india').value='';
    document.getElementById('mySelectIndia').value = 'AllSubCategory';
    $('#mySelect').val('AllSubCategory').trigger('change');

    const checkboxes = document.querySelectorAll('.toggleCheckboxIndia');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

   }
