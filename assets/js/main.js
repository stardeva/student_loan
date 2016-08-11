$(document).ready(function() {
  //
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

  // card page form validation
  $('#bank_card_form').bootstrapValidator({
    fields: {
      card: {
        validators: {
          notEmpty: {
            message: 'The card is required.'
          }
        }
      },
      bank: {
        validators: {
          callback: {
            message: 'The bank is required.',
            callback: function (value, validator, $field) {
              // Determine the numbers which are generated in captchaOperation                                
              if(value) {
                $('#bank_card_form .arrow').hide();
                  return true;
              }
              else {
                $('#bank_card_form .arrow').show();
                return false;
              }
            }
          }
        }
      },
      number: {
        validators: {
          notEmpty: {
            message: 'The number is required.'
          },
          stringLength: {
            min: 5,
            message: 'Your number must be at least 5 characters.'
          }
        }
      }
    }
  });


  $('#bank_card_form').on('status.field.bv', function(e, data) {
    formIsValid = true;

    $('.form-group',$(this)).each( function() {
      formIsValid = formIsValid && $(this).hasClass('has-success');
    });
    
    if(formIsValid) {
      $('.submit-button', $(this)).attr('disabled', false);
    } else {
      $('.submit-button', $(this)).attr('disabled', true);
    }
  });

  // request page validation
  $('#request_loan_form').bootstrapValidator({
    fields: {
      card: {
        validators: {
          notEmpty: {
            message: 'The card is required.'
          }
        }
      },
    number: {
      validators: {
        notEmpty: {
          message: 'The number is required.'
        },
        stringLength: {
          min: 5,
          message: 'Your number must be at least 5 characters.'
        }
      }
    },
    agree: {
      validators: {
        choice: {
          min: 1,
          max: 1,
          message: "Please accept the agreement."
        }
      }
    }
      }
  });

  $('#request_loan_form').on('status.field.bv', function(e, data) {
    formIsValid = true;

    $('.form-group',$(this)).each( function() {
      formIsValid = formIsValid && $(this).hasClass('has-success');
    });
      
    if(formIsValid) {
        $('.submit-button', $(this)).attr('disabled', false);                  
    } else {
        $('.submit-button', $(this)).attr('disabled', true);
    }
  });
  
  // if user decide to send loan request
  $('body').on('click', '.request-loan', function (e) {
    //$('#request_loan_form').submit();
    $('#request_modal').modal('hide');
    window.location ="request_success.html";
  });

  // check if the button is disabled when clicking the submit button
  $('#request_loan_form').on('click', '.submit-button', function (e) {
    if($(this).attr("disabled")) {
      e.stopPropagation()
    }
  });

});