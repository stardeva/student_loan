$(document).ready(function() {
  $('.carousel').carousel({
    interval: 2000
  });

  // go to the back card page
  $(document).on('click', '#loan_modal .request-loan', function() {
  	window.location ="card.html";
  });

  // set form width as windows one in back card page
  function setCarFormHeight() {
  	$('.main-loan-area').height($(document).height() - $('.header').height());
  }
  
  setCarFormHeight();

  $(window).resize(function() {
    setCarFormHeight();
  });

});