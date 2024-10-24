$(document).ready(function() {

    // Convert users data to JSON and assign it to a JavaScript variable
    // const users =  users|json_encode|raw ;


    // Check if users exist
    if (users.length > 0) {

        
    
        // Initialize DataTable
        const dataTable = $('#usersTable').DataTable({
            
            // dom: '<"top"p>rt<"bottom"p><"clear">',
            dom: '<"top"p>rt<"clear">',
            // Additional configuration for DataTables...
        });

        // Hide the DataTable wrapper (table + pagination) initially
        $('#usersTable_wrapper').hide();

        $('#loadUsers').on('click', function() {

            $('#usersTable').removeClass('d-block').addClass('d-none');
            $('#usersTable_wrapper').hide();

            if ($('#userList').hasClass('d-block')) {
                
                $('#userList').removeClass('d-block').addClass('d-none');
            } else {
                $('#userList').removeClass('d-none').addClass('d-block');

            }

    
            // Display users in the response paragraph
            const userInfo = users.map(user => `
                                <div>Name: ${user.name} - Email: ${user.email} 
                                    <button class="delete-button" data-id="${user.id}"> DELETE </button>
                                </div>
                                <br>
                            `).join('');


            $('#userList').html(userInfo );



            // Event delegation for delete buttons
            $('#userList').on('click', '.delete-button', function() {
                const userId = $(this).data('id'); // Get user ID from data attribute

                // Perform an AJAX DELETE request to delete the user
                $.ajax({
                    url: `/user/${userId}`, // Adjust the URL according to your routing
                    type: 'DELETE',
                    success: function(response) {
                                if (response.status === 'success') {

                                    console.log(response.message); // Log the success message
                                    // Remove the deleted user's element from the list
                                    $(this).closest('div').remove(); // Remove the user info from the list
                                } else {
                                    console.error('Error:', response.message); // Log any error messages
                                }
                        }.bind(this), // Ensure 'this' refers to the button clicked
                        error: function(xhr, status, error) {
                            console.error('Error deleting user:', error); // Handle error response
                        }
                });
            });

        });



        $('#loadUsersTable').on('click', function() {

            $('#userList').removeClass('d-block').addClass('d-none');

            // Show the DataTable wrapper on button click
            $('#usersTable_wrapper').show();

            // Clear the DataTable before populating it
            dataTable.clear();
    
            if ($('#usersTable').hasClass('d-block')) {
                dataTable.clear();
                $('#usersTable_wrapper').hide();
                $('#usersTable').removeClass('d-block').addClass('d-none');
            } else {
                $('#usersTable').removeClass('d-none').addClass('d-block');

            }

            // Populate the DataTable
            users.forEach(user => {
                dataTable.row.add([
                    user.name,
                    user.email,
                    user.born_date,
                    `<button class="delete-button" data-id="${user.id}"> DELETE </button>`
                ]);
            });


            // Event delegation for delete buttons in the DataTable
            $('#usersTable tbody').on('click', '.delete-button', function() {
                const userId = $(this).data('id'); // Get user ID from data attribute

                // Perform an AJAX DELETE request to delete the user
                $.ajax({
                    url: `/user/${userId}`,
                    type: 'DELETE',
                    success: function(response) {
                        if (response.status === 'success') {
                            console.log(response.message); // Log the success message
                            dataTable.row($(this).parents('tr')).remove().draw(); // Remove the user row from DataTable
                        } else {
                            console.error('Error:', response.message);
                        }
                    }.bind(this),
                    error: function(xhr, status, error) {
                        console.error('Error deleting user:', error);
                    }
                });
            });

     
            
            // Draw the DataTable after adding rows
            dataTable.draw();
        
        });


    } else {
        $('#response').text('No users found.');
        //dataTable.row.add(['No users found.', '']).draw(); // Add a row to indicate no users found
    }

});