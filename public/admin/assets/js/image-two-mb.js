document.getElementById('imgInp').onchange = function(evt) {
    const file = imgInp.files[0];

    if (file) {
        // Check if the file is an image
        if (!file.type.match('image.*')) {
            alert("Please select a valid image file (.jpg, .jpeg, .png)!");
            imgInp.value = ""; // Clear the input

        }

        // Check if file size is less than 2MB
        if (file.size > 3 * 1024 * 1024) {
            alert("File size must be less than 3MB!");
            imgInp.value = ""; // Clear the input

        } else {
            // Show the image preview if valid
            document.getElementById('blah').src = URL.createObjectURL(file);
        }
    }
};
