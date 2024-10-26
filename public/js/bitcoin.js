
$(document).ready(function() {

    $('#btnBitcoin').on('click', function() {

        if ($('#bitcoinHistoryList').hasClass('d-block')) {
                
            $('#bitcoinHistoryList').removeClass('d-block').addClass('d-none');
        } else {
            $('#bitcoinHistoryList').removeClass('d-none').addClass('d-block');

        }

        if ($('#loadUsers').hasClass('d-block')) {        
            $('#loadUsers').removeClass('d-block').addClass('d-none');
            $('#userList').removeClass('d-block').addClass('d-none');
        } 


        if ($('#loadUsersTable').hasClass('d-block')) {        
            $('#loadUsersTable').removeClass('d-block').addClass('d-none');
            $('#usersTable_wrapper').hide();
            $('#usersTable').removeClass('d-block').addClass('d-none');
        } 

        // Perform an AJAX 
        $.ajax({
            url: `/api/bitcoin/history`, 
            type: 'GET',
            success: function(response) {
                        
                    let htmlContent = '<ul class="bg-dark rounded p-1">';
                    
                    // Loop through each item in the response array
                    response.forEach(function(item) {
                        // Format each currency
                        const eurFormatted = new Intl.NumberFormat('en-GB', { style: 'currency', currency: 'EUR' }).format(item.EUR);
                        const usdFormatted = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(item.USD);
                        const gbpFormatted = new Intl.NumberFormat('en-GB', { style: 'currency', currency: 'GBP' }).format(item.GBP);
                        
                        htmlContent += `<li style="list-style:none; color:white; font-weight:bolder" class="m-1">
                                            <span class='bg-warning p-1 m-1 rounded'> Date: ${item.created_at} </span> - 
                                            <span class='bg-success p-1 m-1 rounded'> EUR: ${eurFormatted} </span> - 
                                            <span class='bg-info p-1 m-1 rounded'> USD: ${usdFormatted} </span> - 
                                            <span class='bg-primary p-1 m-1 rounded'> GBP: ${gbpFormatted} </span>
                                        </li>`;


                    });
                    
                    htmlContent += '</ul>';
                    
                    // Inject the HTML content into the div
                    $('#bitcoinHistoryList').html(htmlContent);
                    
                    
                }.bind(this), // Ensure 'this' refers to the button clicked
                error: function(xhr, status, error) {
                    console.error('Error ', error); 
                }
        });

    })
});