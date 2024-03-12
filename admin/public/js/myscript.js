function deleteCategory() {
  return confirm("Are you sure to delete this category?");
}

function deleteMovie() {
  return confirm("Are you sure to delete this movie?");
}

function deleteTheater() {
  return confirm("Are you sure to delete this theater?");
}

function deleteShowTime() {
  return confirm("Are you sure to delete this show time?");
}

function deletePayment() {
  return confirm("Are you sure to delete this payment method?");
}

function deleteBooking() {
  return confirm("Are you sure to delete this booking?");
}

function deletebookingPayment() {
  return confirm("Are you sure to delete this payment?");
}

function deleteUser() {
  return confirm("Are you sure to delete this user?");
}

function deleteMovieTheater() {
  return confirm("Are you sure to delete this joined movie and theater?");
}

function deleteMovieShowtime() {
  return confirm("Are you sure to delete this joined movie and showtime?");
}

$(document).ready(function () {
  $("#catTable").DataTable({
    paging: true,
    searching: true,
  });
});

$(document).ready(function () {
  $("#bookTable").DataTable({
    paging: true,
    searching: true,
  });
});

$(document).ready(function () {
  $("#payBookTable").DataTable({
    paging: true,
    searching: true,
  });
});

$(document).ready(function () {
  $("#movieTable").DataTable({
    paging: true,
    searching: true,
  });
});

$(document).ready(function () {
  $("#payTable").DataTable({
    paging: true,
    searching: true,
  });
});

$(document).ready(function () {
  $("#showTable").DataTable({
    paging: true,
    searching: true,
  });
});

$(document).ready(function () {
  $("#theaterTable").DataTable({
    paging: true,
    searching: true,
  });
});

$(document).ready(function () {
  $("#userTable").DataTable({
    paging: true,
    searching: true,
  });
});
