$(document).ready(function() {
    $('.status-toggle').off('change').on('change', function() {
        const checkbox = $(this);
        const categoryId = checkbox.data('id');
        const status = checkbox.is(':checked') ? 1 : 0;

        $.ajax({
            url: statusRoute,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // Ensure CSRF token is correctly included
                id: categoryId,
                status: status
            },
            success: function(response) {
                if (response.success) {
                    console.log(response.message); // Replace with user-friendly message display
                } else {
                    console.log(response.message); // Replace with user-friendly message display
                    checkbox.prop('checked', !status);
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText); // Improved error logging
                alert('An error occurred while updating the status.');
                checkbox.prop('checked', !status);
            }
        });
    });
});
