$(document).ready(function() {
  

    $('#btnUsers').on('click', function() {

       
        if ($('#loadUsers').hasClass('d-none')) {        
            $('#loadUsers').removeClass('d-none').addClass('d-block');
        } else {
            $('#loadUsers').removeClass('d-block').addClass('d-none');
            $('#userList').removeClass('d-block').addClass('d-none');
        }


        if ($('#loadUsersTable').hasClass('d-none')) {        
            $('#loadUsersTable').removeClass('d-none').addClass('d-block');
        } else {
            $('#loadUsersTable').removeClass('d-block').addClass('d-none');
            $('#usersTable_wrapper').hide();
            $('#usersTable').removeClass('d-block').addClass('d-none');
        }

        
        if ($('#bitcoinHistoryList').hasClass('d-block')) {        
            $('#bitcoinHistoryList').removeClass('d-block').addClass('d-none');
            $('#callBitcoin').removeClass('d-block').addClass('d-none');
        } 


    });


});