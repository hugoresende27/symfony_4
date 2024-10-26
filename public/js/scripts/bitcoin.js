
$(document).ready(function() {

    $('#btnBitcoin').on('click', function() {

        if ($('#bitcoinHistoryList').hasClass('d-block')) {
            $('#bitcoinHistoryList').removeClass('d-block').addClass('d-none');
        } else {
            $('#bitcoinHistoryList').removeClass('d-none').addClass('d-block');
        }

        // // Toggle the bitcoin history list
        // $('#bitcoinHistoryList').toggleClass('d-none d-block');

        if ($('#loadUsers').hasClass('d-block')) {        
            $('#loadUsers').removeClass('d-block').addClass('d-none');
            $('#userList').removeClass('d-block').addClass('d-none');
        } 


        if ($('#loadUsersTable').hasClass('d-block')) {        
            $('#loadUsersTable').removeClass('d-block').addClass('d-none');
            $('#usersTable_wrapper').hide();
            $('#usersTable').removeClass('d-block').addClass('d-none');
        } 

        if ($('#callBitcoin').hasClass('d-none')) {
            $('#callBitcoin').removeClass('d-none').addClass('d-block');
        } else {
            $('#callBitcoin').removeClass('d-block').addClass('d-none');

        }

        // Toggle the callBitcoin button visibility
        // $('#callBitcoin').toggleClass('d-none d-block');

        populateTable();

    })


    $('#callBitcoin').on('click', function() {

              // Perform an AJAX 
              $.ajax({
                url: `/api/bitcoin/message`, 
                type: 'GET',
                success: function(response) {
                    console.log("Message sent successfully"); // Add logging for debugging
                    // populateTable();
                }
            });

  
    });


    function populateList()
    {
        $('#bitcoinHistoryList').html(''); // Clear all content
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
                                            <span class='bg-dark p-1 m-1 rounded'> ${item.created_at} </span> - 
                                            <span class='bg-success p-1 m-1 rounded'> EUR: ${eurFormatted} </span> - 
                                            <span class='bg-secondary p-1 m-1 rounded'> USD: ${usdFormatted} </span> - 
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
    }

    function populateTable()
    {
        let dataTable;
 
        if ($('#bitcoinHistoryTable').hasClass('d-block')) {
            $('#bitcoinHistoryTable').removeClass('d-block').addClass('d-none');
        } else {
            $('#bitcoinHistoryTable').removeClass('d-none').addClass('d-block');

        }

        if ($.fn.DataTable.isDataTable('#bitcoinHistoryTable')) {
            $('#bitcoinHistoryTable').DataTable().destroy(); // Destroy existing instance
        }
        
        dataTable = $('#bitcoinHistoryTable').DataTable({
            autoWidth: false,
            columnDefs: [
                { width: '30%', targets: 0 },
                { width: '20%', targets: 1 },
                { width: '20%', targets: 2 },
                { width: '20%', targets: 3 }
            ]
        });


        $.ajax({
            url: `/api/bitcoin/history`, 
            type: 'GET',
            success: function(response) {
                        
             
                    
                    // Loop through each item in the response array
                    response.forEach(function(item) {
                        // Format each currency
                        const eurFormatted = new Intl.NumberFormat('en-GB', { style: 'currency', currency: 'EUR' }).format(item.EUR);
                        const usdFormatted = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(item.USD);
                        const gbpFormatted = new Intl.NumberFormat('en-GB', { style: 'currency', currency: 'GBP' }).format(item.GBP);
                        console.log(eurFormatted)

                        dataTable.row.add([
                            `<span class='bg-info p-1 m-1 rounded'> ${item.created_at} </span>`,
                            `<span class='bg-primary p-1 m-1 rounded'> ${eurFormatted} </span>`,
                            `<span class='bg-secondary p-1 m-1 rounded'> ${usdFormatted} </span>`,
                            `<span class='bg-success p-1 m-1 rounded'> ${gbpFormatted} </span>`,
                    
                        ]);
                    });
        
                      
                    // Draw the DataTable after adding rows
                    dataTable.draw();
                    
                    
                }.bind(this), // Ensure 'this' refers to the button clicked
                error: function(xhr, status, error) {
                    console.error('Error ', error); 
                }
        });


     

    }
});