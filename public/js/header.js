$(document).ready(function() {
    console.log('header script');

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



    });


    $('#btnBitcoin').on('click', function() {

        if ($('#loadUsers').hasClass('d-block')) {        
            $('#loadUsers').removeClass('d-block').addClass('d-none');
            $('#userList').removeClass('d-block').addClass('d-none');
        } 


        if ($('#loadUsersTable').hasClass('d-block')) {        
            $('#loadUsersTable').removeClass('d-block').addClass('d-none');
            $('#usersTable_wrapper').hide();
            $('#usersTable').removeClass('d-block').addClass('d-none');
        } 


    });

});