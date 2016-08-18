// go to card page in borrow index
function goCardPage() {
  bootbox.dialog({
    className: 'custom-dialog dialog-confirm',
    closeButton: false,
    message: "<h3>您还没有绑定银行卡</h3>",
    buttons: {
      danger: {
        label: "取消",
        callback: function() {

        }
      },
      success: {
        label: "去绑定",
        callback: function() {
          window.location ="card.html";
        }
      }                  
    }
  });
}

// decide to complete card page in card index
function completeCard() {
  bootbox.dialog({
    className: 'custom-dialog dialog-confirm',
    closeButton: false,
    message: "<h3>确认提交</h3>",
    buttons: {
      danger: {
        label: "取消",
        callback: function() {

        }
      },
      success: {
        label: "确定",
        callback: function() {
          window.location ="request.html";
        }
      }                  
    }
  });
}

// decide to send loan request in request page
function decideLoan() {
  bootbox.dialog({
    className: 'custom-dialog dialog-confirm',
    closeButton: false,
    message: "<h3>确认提交</h3>",
    buttons: {
      danger: {
        label: "取消",
        callback: function() {

        }
      },
      success: {
        label: "确定",
        callback: function(e) {          
          //$('#request_loan_form').submit();
          $('#request_modal').modal('hide');
          window.location ="request_success.html";
        }
      }                  
    }
  });
}

$(document).ready(function() {
  /* show modal when page load */
  /*if(typeof Cookies !== 'undefined' && Cookies.get('intro_dialog') === undefined) {
    if(typeof bootbox !== 'undefined') {
      bootbox.dialog({
        className: 'custom-dialog dialog-alert',
        closeButton: false,
        message: "<h3>免责申明</h3><div>本服条由学融宝提供, 相关服条和责任将由学融宝承担, 如有问题请资询学融宝公司客服。</div>",
        buttons: {
          success: {
            label: "我知道了",
            className: "btn-intro",
            callback: function() {
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  console.log(position);
                });
              }
              else {
                window.close();
              }
              //Cookies.set('intro_dialog', true);
              bootbox.dialog({
                className: 'custom-dialog dialog-confirm',
                closeButton: false,
                message: "<h3>允许“学融宝”在您使用该应用程序时访问您的位置吗?</h3><div>请选择允许以完成您在学融宝的注册</div>",
                buttons: {
                  danger: {
                    label: "不允许",
                    callback: function() {

                    }
                  },
                  success: {
                    label: "允许",
                    callback: function() {
                      
                    }
                  }                  
                }
              });
            }
          }
        }
      });
    }
  }*/

  // $.post("http://api.wazxb.com/sys/init",
  //   {
  //     uid: '4dba7e89fa0ffb27ecfd3ab0',
  //     deviceId: '00000000000000008:00:27:44:04:bb323ec7466101f399',
  //     deviceOs: 'Android',
  //     deviceType: 'Google Nexus S - 4.1.1 - API 16 - 480x800',
  //     deviceOp: '4.1.1',
  //     version: '1.0.1',
  //     deviceToken: 'dd'
  //   },
  //   function(data, status){
  //       alert("Data: " + data + "\nStatus: " + status);
  //   });


  /* credit base 1 page datepicker */
  if($.fn.datepicker !== undefined) {
    $.fn.datepicker.dates['zh-CN'] = {
      days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
      daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
      daysMin: ["日", "一", "二", "三", "四", "五", "六"],
      months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
      monthsShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
      today: "今日",
      clear: "清除",
      format: "yyyy年mm月dd日",
      titleFormat: "yyyy年mm月",
      weekStart: 1
    };

    $('.datepicker').datepicker({
      format: "yyyy-mm-dd",
      language: 'zh-CN',
      keyboardNavigation: false,
      autoclose: true,
      todayHighlight: true
    });
  }
  

  $('.file-upload').change(function() {
    if(this.files && this.files[0]) {
      var file = this.files[0];
      var container = $(this).closest('.file-input')
      var preview = container.find('.image-preview');
      var label = container.find('label');
      var imageType = /image.*/;
      if (!file.type.match(imageType)) {
        preview.hide();
        label.show();
        container.css('background-position', 'center');
        return;
      }
      preview.file = file;
      var reader = new FileReader();
      reader.onload = (function(img, l, c) {
        return function(e) {
          $(img).prop('src', e.target.result);
          $(img).show();
          $(l).hide();
          $(c).css('background-position', '-9999px');
        }
      })(preview, label, container);

      reader.readAsDataURL(file);
    }
  });

  /* sign up page */
  $(document).on('keyup', '#signup_student_id', function() {
    if($(this).val() != '')
      $('#signup_submit').addClass('success');
    else
      $('#signup_submit').removeClass('success');
  });

  /* my photo upload */
  $('#my_photo').change(function() {
    if(this.files && this.files[0]) {
      var file = this.files[0];
      var imageType = /image.*/;
      if (!file.type.match(imageType)) {
        return;
      }
      var preview = $(this).closest('.user-photo-upload').find('.user-photo-preview');
      preview.file = file;
      var reader = new FileReader();
      reader.onload = (function(img) {
        return function(e) {
          $(img).prop('src', e.target.result);
        }
      })(preview);
      reader.readAsDataURL(file);
    }
  });

  if($("#detail_slider").length) {
    $("#detail_slider").slider({});
  }  

  // set main form width as windows one in back card page
  function setMainDocumentHeight() {
    var footer_height = 0, 
      main_height = 0,
      window_height = $(window).height(),
      wrap_height = parseInt( $('.main-loan-area .main-wrap').height() ),
      header_height = 60;

    if($('.main-loan-area .footer').length > 0) {
      footer_height = parseInt( $('.main-loan-area .footer').height() );
    }

    var main_height = wrap_height + header_height + footer_height + 40;


    if(window_height >= main_height ) {console.log(window_height, header_height)
      $('.main-loan-area').height(window_height - header_height);
    } else {
      $('.main-loan-area').height(main_height);
    }
  }
  
  setMainDocumentHeight();

  $(window).resize(function() {
    setMainDocumentHeight();
  });

  // card page form validation
  if($('#bank_card_form').length) {
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
  }

  // request page validation
  if($('#request_loan_form').length) {
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

    // check if the button is disabled when clicking the submit button
    $('#request_loan_form').on('click', '.submit-button', function (e) {
      if($(this).attr("disabled")) {
        e.stopPropagation()
      }
    });
  }
});
