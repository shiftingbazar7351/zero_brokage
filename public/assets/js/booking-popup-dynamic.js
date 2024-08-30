$(document).ready(function() {
    // Handle mobile number submission
    $('#saveChanges-booking1').click(function(e) {
        e.preventDefault();
        let mobileNumber = $('#phoneNumberInput-booking').val();

        $.ajax({
            url: '/user/enquiry/store', // The route for storing the mobile number
            type: 'POST',
            data: {
                mobile_number: mobileNumber,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Mobile number saved successfully');
                // Open the next popup
                $('#myPopup-booking1').hide();
                $('#myPopup-booking').show();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors && errors.mobile_number) {
                    $('#res-booking1').text(errors.mobile_number[0]);
                }
            }
        });
    });

    // Handle details submission
    $('#saveChanges-booking').click(function(e) {
        e.preventDefault();
        let name = $('input[placeholder="Enter your name"]').val();
        let location = $('input[placeholder="Enter your Location"]').val();
        let email = $('input[placeholder="Enter your email"]').val();
        let date_time = $('input[type="date"]').val(); // Using date_time to match controller

        $.ajax({
            url: '/user/enquiry/update',
            type: 'POST',
            data: {
                mobile_number: $('#phoneNumberInput-booking')
            .val(), // Assuming mobile number is being used as identifier
                name: name,
                location: location,
                email: email,
                date_time: date_time,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Details updated successfully');
                $('#myPopup-booking').hide();
                $('#myPopup2-booking').show(); // Show the OTP verification popup
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                // Display the errors accordingly
                if (errors) {
                    if (errors.name) {
                        alert(errors.name[0]);
                    }
                    if (errors.email) {
                        alert(errors.email[0]);
                    }
                    if (errors.date_time) {
                        alert(errors.date_time[0]);
                    }
                }
            }
        });
    });
});
