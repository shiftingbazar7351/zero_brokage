// .....................validate phone Number.EPSILON.................

function validateNum(elem) {
  document.getElementById("res").style.color = "red";
  if (isNaN(elem.value)) {
    document.getElementById("res").innerText = "please enter number only";
    document.getElementById("saveChanges").classList.add("unclickable");
  } else {
    document.getElementById("res").innerText = "";
    document.getElementById("saveChanges").classList.remove("unclickable");   
    if (elem.value.length<10) {
      document.getElementById("res").innerText = "Enter 10 digit number";
      document.getElementById("saveChanges").classList.add("unclickable");
    }
    if (elem.value[0]==0) {
      document.getElementById("res").innerText =
        "First character should not be zero";
      document.getElementById("saveChanges").classList.add("unclickable");
    }
  }
}

var popup = document.getElementById("myPopup");
var btn = document.getElementById("openPopup");
var closeSpan = document.getElementById("closePopup");
var saveChangesBtn = document.getElementById("saveChanges");

var popup2 = document.getElementById("myPopup2");
var closeSpan2 = document.getElementById("closePopup2");
var editnum = document.getElementById("editnumber");

btn.onclick = function () {
  popup.classList.add("show");
};

closeSpan.onclick = function () {
  popup.classList.remove("show");
};

window.onclick = function (event) {
  if (event.target == popup) {
    popup.classList.remove("show");
  }
};

saveChangesBtn.onclick = function () {
  popup.classList.remove("show");
  popup2.classList.add("show");
  startCountdown(60);
};

editnum.onclick = function () {
  popup2.classList.remove("show");
  popup.classList.add("show");
};

closeSpan2.onclick = function () {
  popup2.classList.remove("show");
  clearInterval(interval); // Clear interval when popup is closed
};

let interval; // Variable to hold the countdown interval

// Function to start the countdown
function startCountdown(seconds) {
  let counter = seconds;
  var countdownElement = document.getElementById("counter");
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

// Add event listener to "Resend OTP"
resendOtpText.onclick = function () {
  startCountdown(60); // Start a new countdown when "Resend OTP" is clicked
};

otpOnWhatsapp.onclick = function () {
  startCountdown(60); // Start a new countdown when "Get on Whatsapp" is clicked
};

document.getElementById("verify-otp").onclick = function () {
  alert("OTP verified successfully!");
};
