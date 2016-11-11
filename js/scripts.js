$(function () {
  $('[data-toggle="tooltip"]').tooltip()

  // POST the data to the mySQL server and show the confirmation alert
  $('#send_message').submit(function(e){
    e.preventDefault();
    var post_data = $('#send_message').serialize();
    $.post('../project1/php/submission.php', post_data, function(data){
      $('#confirmation').show();
    });
});
})


