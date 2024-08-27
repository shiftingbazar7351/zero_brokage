function validateField(input) {
    const value = input.value;
    const id = input.id;

    let pattern;
    let errorElement;
    let errorMessage;

    if (id === "whatsappNumVender") {
        pattern = /^\d{10}$/; // Pattern for 10-digit WhatsApp number
        errorElement = document.getElementById("whatsappError");
        errorMessage = "enter valid WhatsApp number";
    } else if (id === "pinnumber") {
        pattern = /^\d{6}$/; // Pattern for 10-digit pin number
        errorElement = document.getElementById("pinnumberError");
        errorMessage = "enter valid PIN number";
    } else if (id === "phoneNumVender") {
        pattern = /^\d{10}$/; // Pattern for 10-digit Phone number
        errorElement = document.getElementById("phoneError");
        errorMessage = "enter valid phone number";
    } else if (id === "emailAddressVender") {
        pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Pattern for a valid email address
        errorElement = document.getElementById("emailError");
        errorMessage = "enter valid email address";
    } else if (id === "adharvender") {
        pattern = /^\d{12}$/; // Pattern for a valid email address
        errorElement = document.getElementById("adharError");
        errorMessage = "enter valid adhar number";
    } else if (id === "panCard") {
        pattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/; // Pattern for a valid PAN card number
        errorElement = document.getElementById("panError");
        errorMessage = "Please enter a valid PAN card number";
    } else if (id === "gstNumber") {
        pattern = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{3}$/; // Pattern for a valid GST number
        errorElement = document.getElementById("gstError");
        errorMessage = "Please enter a valid GST number";
    }

    // Perform validation
    if (pattern.test(value) || value === "") {
        errorElement.textContent = ""; // Clear error message if input is valid
    } else {
        errorElement.textContent = errorMessage; // Display the specific error message
    }
}

document
    .getElementById("submitbutton")
    .addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        // Select the input fields and error message divs
        const companynameInput = document.getElementById("companyname");
        const pinnumberInput = document.getElementById("pinnumber");
        const phoneNumVenderInput = document.getElementById("phoneNumVender");
        const GstNumVenderInput = document.getElementById("gstNumber");
        const PanNumVenderInput = document.getElementById("panCard");
        const adharVenderInput = document.getElementById("adharvender");
        const adharImageInput = document.getElementById("adharImage");
        const panImageInput = document.getElementById("PanImage");
        const gstImageInput = document.getElementById("GSTimage");

        const companynameError = document.getElementById("companynameError");
        const pinnumberError = document.getElementById("pinnumberError");
        const phonenumError = document.getElementById("phoneError");
        const gstnumError = document.getElementById("gstError");
        const pannumError = document.getElementById("panError");
        const adharnumError = document.getElementById("adharError");
        const adharImageError = document.getElementById("adharImageError");
        const panImageError = document.getElementById("PanImageError");
        const gstImageError = document.getElementById("gstImageError");

        let valid = true;

        // Check if the Company Name field is empty
        if (companynameInput.value.trim() === "") {
            companynameError.textContent = "Please fill this field";
            valid = false;
        }

        // Check if the PIN Number field is empty
        if (pinnumberInput.value.trim() === "") {
            pinnumberError.textContent = "Please fill this field";
            valid = false;
        }

        // Check if the Phone Number is empty
        if (phoneNumVenderInput.value.trim() === "") {
            phonenumError.textContent = "Please fill this field";
            valid = false;
        }

        // Check if the GST Number is empty
        if (GstNumVenderInput.value.trim() === "") {
            gstnumError.textContent = "Please fill this field";
            valid = false;
        }

        // Check if the PAN number in empty
        if (PanNumVenderInput.value.trim() === "") {
            pannumError.textContent = "Please fill this field";
            valid = false;
        }

        //Check if the Adhar num is empty or not

        if (adharVenderInput.value.trim() === "") {
            adharnumError.textContent = "Please fill this field";
            valid = false;
        }

        //Check if the Adhar image in choosen
        if (adharImageInput.files.length === 0) {
            adharImageError.textContent = "Please choose a file";
            valid = false;
        }

        //Check if the Pan image is choosen or not

        if (panImageInput.files.length === 0) {
            panImageError.textContent = "Please choose a file";
            valid = false;
        }

        //Check if the GST image is choosen or not
        if (gstImageInput.files.length === 0) {
            gstImageError.textContent = "Please choose a file";
            valid = false;
        }
        // If any field is invalid, scroll to the top of the page
        if (!valid) {
            window.scrollTo({ top: 0, behavior: "smooth" });
        } else {
            // If all fields are valid, proceed with form submission or other action
            alert("Form submitted successfully!");
            // document.getElementById('yourFormId').submit(); // Uncomment if submitting a form
        }
    });

// Function to clear the error message when typing starts
function clearErrorOnInput(inputElement, errorElement) {
    inputElement.addEventListener("input", function () {
        if (inputElement.value.trim() !== "") {
            errorElement.textContent = "";
        }
    });
}

// Attach clearErrorOnInput to each input field
clearErrorOnInput(
    document.getElementById("companyname"),
    document.getElementById("companynameError")
);
clearErrorOnInput(
    document.getElementById("pinnumber"),
    document.getElementById("pinnumberError")
);
clearErrorOnInput(
    document.getElementById("GSTimage"),
    document.getElementById("gstImageError")
);
clearErrorOnInput(
    document.getElementById("PanImage"),
    document.getElementById("PanImageError")
);
