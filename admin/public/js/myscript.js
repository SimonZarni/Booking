function deleteCategory(){
    return confirm("Are you sure to delete this category?");
}

function deleteMovie(){
    return confirm("Are you sure to delete this movie?");
}

function deleteTheater(){
    return confirm("Are you sure to delete this theater?");
}

function deleteShowTime(){
    return confirm("Are you sure to delete this show time?");
}

function deletePayment(){
    return confirm("Are you sure to delete this payment?");
}

function deleteBooking(){
    return confirm("Are you sure to delete this booking?");
}

function deletebookingPayment(){
    return confirm("Are you sure to delete this booking payment?");
}

$(document).ready(function () {
    $('#catTable').DataTable({
        "paging": true,
        "searching": true, 
    });
});