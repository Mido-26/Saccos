$(function () {
   
    // Function to handle delete icon click
    function handleDeleteClick(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to delete this Event?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it',
            customClass: {
                confirmButton: 'confirm-custom',
                cancelButton: 'cancel-custom'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../../includes/processing/processing.php?id='+ userId+'&del=del';
            }
        });
    }


    $(document).on('click', '.del-icon', function (e) {
        e.preventDefault();
        var userId = $(this).attr('id');
        console.log('User ID:', userId); // Debugging line
        handleDeleteClick(userId);
    });
    

    // Existing code...
});
