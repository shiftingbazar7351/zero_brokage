$(document).ready(function() {
    let searchTimeout;

    // Fetch users with AJAX on page load, search or pagination
    function fetchUsers(query = '', page = 1) {
        $.ajax({
            url: searchRoute, // Adjust the route as per your setup
            method: 'GET',
            data: {
                search: query,
                page: page
            },
            success: function(data) {
                $('#usersTable').html(data); // Replace the table content with AJAX response
            },
            error: function() {
                alert('Failed to fetch users.');
            }
        });
    }

    // Debounce function to limit the rate of function execution
    function debounce(func, delay) {
        return function(...args) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Trigger search on input change with debounce
    $('#search').on('keyup', debounce(function() {
        let query = $(this).val();
        fetchUsers(query);
    }, 300)); // Adjust the debounce delay as needed

    // Pagination link handling
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        fetchUsers(query, page);
    });

    // Prevent default form submission
    $('form').on('submit', function(e) {
        e.preventDefault();
    });
});
