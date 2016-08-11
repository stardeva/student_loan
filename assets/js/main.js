$(document).ready(function() {
  $('.carousel').carousel({
    interval: 2000
  });

  //go to the back card page
  $(document).on('click', '#loan_modal .request-loan', function() {
  	window.location ="card.html";
  });

});