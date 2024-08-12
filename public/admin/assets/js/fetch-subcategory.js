$(document).ready(function() {
    $('#category').on('change', function() {
        var subcategoryId = $(this).val();
        if (subcategoryId) {
            $.ajax({
                url: '/fetch-subcategory/' + subcategoryId, // Adjusted URL based on route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                },
                success: function(response) {
                    if (response.status === 1) {
                        var subcategory = response.data;
                        console.log(subcategory);
                        $('#subcategory').find('option')
                            .remove(); // Clear existing options
                        var options =
                            '<option value="">Select subcategory</option>'; // Default option
                        $.each(subcategory, function(key, subcateg) {
                            options += "<option value='" + subcateg.id + "'>" +
                                subcateg
                                .name + "</option>";
                        });
                        $('#subcategory').append(options);
                    }
                }
            });
        } else {
            $('#subcategory').find('option').remove(); // Clear options if no state is selected
            $('#subcategory').append('<option value="">Select ddd</option>');
        }
    });
});
