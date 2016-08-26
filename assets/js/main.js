// go to card page in borrow index
function goCardPage(id, limit_price, pro_id) {
  var price_element = '.borrow-page #', time_element, origin_element;

  if(id) {
    price_element += id;    
  }
  time_element = price_element;
  
  time_element = price_element + ' select.during-selector';
  origin_element = price_element + ' select.cost-selector';
  price_element += ' .loan-price';
  var borrow_price = parseFloat( $(price_element).html() );
  // if borrow price is bigger than quotaToal, redirect to the credits page
  if(borrow_price <= 0) {
    
  }else if(limit_price < borrow_price) {
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
            window.location ="../credits";
          }
        }
      }
    });
  } else {
    var $borrow_form = $('#borrow_hidden_form');
    $borrow_form.find('#origin_price').val(parseInt( $(origin_element).val() ));
    $borrow_form.find('#sum_price').val(borrow_price);
    $borrow_form.find('#time').val(parseInt( $(time_element).val() ));
    $borrow_form.find('#pro_id').val(pro_id);
    $borrow_form.submit();
  }
  
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
function decideLoan(e) {
  e.preventDefault();
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
          $('#request_modal').modal('hide');
          var $request_form = $('#request_loan_form');
          var pro_id = $request_form.find('#pro_id').val();
          var money = $request_form.find('#money').val();
          var time = $request_form.find('#time').val();
          var day = 0, month = 0;
          if(pro_id == 3) {
            month = time;
          } else {
            day = time;
          }

          var postdata = {'uId': $('#uid').val(), 
                        'page': 'request_loan_page',
                        'lnProdId': pro_id,
                        'money': money,
                        'day': day,
                        'month': month};
          $.ajax({
            url: '../api/actions.php',
            type: 'post',
            data: postdata,
            success: function(res) {
              res = JSON.parse(res);
              if(res.error.errno == 200) {
                window.location ="request_success.php";
              } else {
                console.log('error: ' +res);
              }
            }
          });
          
        }
      }
    }
  });
}

// generate pdf in more/contract.php
function generatePdf(url) {
  //var url = 'http://zxb-pic.img-cn-beijing.aliyuncs.com/1463534014_%E4%BD%BF%E7%94%A8%E5%B8%AE%E5%8A%A9.pdf';
  PDFJS.workerSrc = '../assets/js/pdf.worker.js';

  PDFJS.getDocument(url).then(function getPdfHelloWorld(pdf) {
    //
    // Fetch the first page
    //
    pdf.getPage(1).then(function getPageHelloWorld(page) {
      var scale = 2;
      var viewport = page.getViewport(scale);

      //
      // Prepare canvas using PDF page dimensions
      //
      var canvas = document.getElementById('pdf_canvas');
      var context = canvas.getContext('2d');
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      //
      // Render PDF page into canvas context
      //
      var renderContext = {
        canvasContext: context,
        viewport: viewport
      };
      page.render(renderContext);
    });
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

  if($('#banner_slider').length > 0) {
    $('#banner_slider').slick({
      dots: true,
      infinite: true,
      speed: 300,
      autoplay: true,
      arrows: false,
      mobileFirst: true
    });
  }

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
      var key = container.find('.file-key');
      if (!file.type.match(imageType)) {
        preview.addClass('hidden');
        label.removeClass('hidden');
        container.css('background-position', 'center');
        return;
      }

      // Image priview
      /*preview.file = file;
      var reader = new FileReader();
      reader.onload = (function(img, l, c) {
        return function(e) {
          $(img).prop('src', e.target.result);
          $(img).removeClass('hidden');
          $(l).addClass('hidden');
          $(c).css('background-position', '-9999px');
        }
      })(preview, label, container);

      reader.readAsDataURL(file);*/

      // Image upload
      var formdata = new FormData();
      formdata.append('file', file);
      formdata.append('page', 'upload_image');
      $.ajax({
        url: '../api/actions.php',
        async: false,
        type: 'post',
        data: formdata,
        contentType: false,
        cache: false,
        processData: false,
        mimeType: 'multipart/form-data',
        beforeSend: function() {

        },
        success: function(res) {
          res = JSON.parse(res);
          if(res.error.errno != 200) {
            preview.addClass('hidden');
            label.removeClass('hidden');
            container.css('background-position', 'center');
          } else {
            key.val(res.picKey);
            preview.attr('src', res.picUrl);
            preview.removeClass('hidden');
            label.addClass('hidden');
            container.css('background-position', '-9999px');
          }
        },
        error: function(xhr, status, error) {
          preview.addClass('hidden');
          label.removeClass('hidden');
          container.css('background-position', 'center');
        }
      });
    }
  });

  /* my photo upload */
  $('#my_photo').change(function() {
    if(this.files && this.files[0]) {
      var file = this.files[0];
      var imageType = /image.*/;
      if (!file.type.match(imageType)) {
        return;
      }
      var formdata = new FormData();
      formdata.append('file', file);
      formdata.append('page', 'upload_image');
      $.ajax({
        url: '../api/actions.php',
        async: false,
        type: 'post',
        data: formdata,
        contentType: false,
        cache: false,
        processData: false,
        mimeType: 'multipart/form-data',
        beforeSend: function() {

        },
        success: function(res) {
          res = JSON.parse(res);
          var postdata = {'uId': $('#uid').val(), picKey: res.picKey, 'page': 'personal_info'};
          if(res.error.errno == 200) {
            $.ajax({
              url: '../api/actions.php',
              type: 'post',
              data: postdata,
              success: function(res1) {
                res1 = JSON.parse(res1);
                if(res1['error']['errno'] == 200)
                  $('.user-photo-upload .user-photo-preview').attr('src', res1['user']['portrait']);
              }
            });
          }
        }
      });
    }
  });

  if($('.swiper-container').length) {
    var creditBaseSwiper = new Swiper('.swiper-container');
    creditBaseSwiper.on('onSlideChangeEnd', function(swiper) {
      if($('body').hasClass('credit-base-page')) {
        $('.header .topnav .title').html('基本信息 ( ' + (swiper.activeIndex + 1) + '/3 )');
        if(swiper.isEnd) $('.header .topnav .next').html('完成');
        else $('.header .topnav .next').html('下一步');
      }
      $("html, body").animate({ scrollTop: 0 }, 0);
    });

    if($('body').hasClass('credit-base-page')) {
      $('.header .topnav .next').on('click', function(e) {
        e.preventDefault();
        if(!creditBaseSwiper.isEnd) creditBaseSwiper.slideNext();
        else {
          $('#credit_base').submit();
        }
        $("html, body").animate({ scrollTop: 0 }, 0);
      });
    }
  }

  /* credit base 2 university */
  if($('#credit_base2_university').length) {
    (function() {
      if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd) var e = jQuery.fn.select2.amd;
      return e.define("select2/i18n/zh-CN", [], function() {
        return {
          errorLoading: function() {
            return "无法载入结果。"
          },
          inputTooLong: function(e) {
            var t = e.input.length - e.maximum,
              n = "请删除" + t + "个字符";
            return n
          },
          inputTooShort: function(e) {
            var t = e.minimum - e.input.length,
              n = "请再输入至少" + t + "个字符";
            return n
          },
          loadingMore: function() {
            return "载入更多结果…"
          },
          maximumSelected: function(e) {
            var t = "最多只能选择" + e.maximum + "个项目";
            return t
          },
          noResults: function() {
            return "未找到结果"
          },
          searching: function() {
            return "搜索中…"
          }
        }
      }), {
        define: e.define,
        require: e.require
      }
    })();
    var credit_base_university = $("#credit_base2_university").select2({
      language: 'zh-CN',
      placeholder: {id:'请输入就读学校名称', name:'请输入就读学校名称'},
      ajax: {
        url: "../api/actions.php",
        method: 'post',
        delay: 250,
        data: function (params) {
          return {
            school: params.term,
            page: 'search_university'
          };
        },
        processResults: function (data, params) {
          data = JSON.parse(data);
          if(data.error.errno !== 200) return {results: []};
          
          var schoolName = [];
          $.each(data.schoolList.schoolName, function(ind, school) {
            schoolName.push({id: school.name, name: school.name});
          });

          return {results: schoolName};
        }
      },
      escapeMarkup: function (markup) { return markup; },
      minimumInputLength: 1,
      templateResult: function(item) {
        if(item.loading) return item.text;
        return item.name;
      },
      templateSelection: function(item) {
        return item.name || item.text;
      }
    });
  }

  if($('body').hasClass('credit-family-page')) {
    $('.header .topnav .next').on('click', function(e) {
      e.preventDefault();
      $('#credit_family').submit();
    });
  }

  if($('body').hasClass('credit-contact-page')) {
    $('.header .topnav .next').on('click', function(e) {
      e.preventDefault();
      $('#credit_contact').submit();
    });
  }

  if($('body').hasClass('credit-other-page')) {
    $('.header .topnav .next').on('click', function(e) {
      e.preventDefault();
      $('#credit_other').submit();
    });
  }

  if($(".refund-page").length) {
    var slider = $(".slider-wrap #detail_slider").slider();
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


    if(window_height >= main_height ) {
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
        container: '#messages',
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
        $('.submit-btn', $(this)).attr('disabled', false);
      } else {
        $('.submit-btn', $(this)).attr('disabled', true);
      }
    });
  }

  // feedback page form validation in more/feedback.php
  if($('#feedback_form').length) {    

    $('#feedback_form').bootstrapValidator({
      message: '#messages',
      fields: {
        feedback: {
          validators: {
            notEmpty: {
              message: 'The feedback is required.'
            }
          }
        }
      }
    });

    $('#feedback_form').on('status.field.bv', function(e, data) {
      formIsValid = true;

      $('.form-group',$(this)).each( function() {
        formIsValid = formIsValid && $(this).hasClass('has-success');
      });
      
      if(formIsValid) {
        $('.submit-btn', $(this)).attr('disabled', false);

      } else {
        $('.submit-btn', $(this)).attr('disabled', true);
      }
    });

    // Validate the form manually
    $('#feedback_form .submit-btn').click(function() {
      var postdata = {'uId': $('#uid').val(), 'page': 'feedback_data'};
      $.ajax({
        url: '../api/actions.php',
        type: 'post',
        data: postdata,
        success: function(res) {
          res = JSON.parse(res);
          window.location ="index.php";
        }
      });
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
          $('.submit-btn', $(this)).attr('disabled', false);                  
      } else {
          $('.submit-btn', $(this)).attr('disabled', true);
      }
    });

  }

  //select event in calculate page for borrow and calculate page
  function setValue(ele) { console.log($(ele))
    var price = $(ele).find('select.cost-selector').val();
    var date = $(ele).find('select.during-selector').val();
    var rate = $(ele).find('select.cost-selector').attr('rate');
    id = $(ele).selector;
    price = calResult(id, price, rate, date);console.log(id, price, rate, date)
    $(ele).find('.loan-price').html(price + '元');
    if(getCalcType(id) != '#yueli')
      $(id).find('.loan-time .number').html(date);
  }

  function getDay(intPrincipal, floatRate, intLoanPeriod) {
    var result = intPrincipal * Math.pow(1 + (floatRate * 12 / 365), intLoanPeriod);
    return result;
  }

  function getMonth(intPrincipal, floatRate, intLoanPeriod) {
    var result = intPrincipal * (floatRate * Math.pow(1 + parseFloat(floatRate), intLoanPeriod)) / (Math.pow(1 + parseFloat(floatRate), intLoanPeriod) - 1);
    return result;
  }

  function getCalcType(str) {
    var array_element = ['#fuli', '#huoli', '#yueli'];
    for(var i = 0; i < array_element.length; i ++) {
      if ( str.includes(array_element[i]) )
        return array_element[i];
    }

    return null;
  }

  function calResult(mode, mAmount, mRate, mTime) {
    var value = 0;
    mode = getCalcType(mode);

    if (mode) {
      switch(mode) {
        case '#huoli':
            value = getDay(mAmount, mRate, mTime);
          break;
        case '#fuli':
            value = mAmount;
          break;
        case '#yueli':
            value = getMonth(mAmount, mRate, mTime);
          break;
      }
    }
console.log(value)

    return parseFloat(value).toFixed(2);

  }

  function initCalculator(page_element) {
    var array_element = ['#fuli', '#huoli', '#yueli'];
    for(var i = 0; i < array_element.length; i ++) {
      var element = page_element + ' ';
      element += array_element[i];
      var rate = $(element).find('select.cost-selector').attr('rate');
      setValue($(element));console.log($(element))
    }
  }

  // function watchCalcSelectBox(page_element) {
  //   var array_element = ['#fuli', '#huoli', '#yueli'];
  //   for(var i = 0; i < array_element.length; i ++) {
  //     var element = page_element + ' ';
  //     element += array_element[i];
  //     // watch if cost select box is changed
  //     $(element).find('select.cost-selector').change(function() {
  //       setValue(element, $(this).attr('rate'));
  //     });
  //     // watch if date select box is changed
  //     $(element).find('select.during-selector').change(function() {
  //       setValue(element, $(this).attr('rate'));
  //     });
  //   }
  // }

  $('#fuli').find('select.cost-selector').change(function() {
    setValue(this);
  });

  $('#fuli').find('select.during-selector').change(function() {
    setValue(this);
  });

  $('#fuoli').find('select.cost-selector').change(function() {
    setValue(this);
  });

  $('#fuoli').find('select.during-selector').change(function() {
    setValue(this);
  });

  $('#yueli').find('select.cost-selector').change(function() {
    setValue(this);
  });

  $('#yueli').find('select.during-selector').change(function() {
    setValue(this);
  });
 

  function getOptions(data, step, start_value) {
    var html = '', option = '';

    if(data > 1) {
      for(var i = start_value; i <= data; i += step) {
        option = '<option value="' + i + '">' + i + '</option>';
        html += option;
      }
    }  

    return html;
  }

  // init data in borrow page
  if($('body').hasClass('borrow-page')) {    
    initCalculator('.borrow-page');
    //watchCalcSelectBox('.borrow-page');
  }

  // init data in calculator page
  if($('body').hasClass('calculator-page')) {
    initCalculator('.calculator-page');
    //watchCalcSelectBox('.calculator-page');
  }  
});


/* sign up page */
function validateSignup() {
  if($('#signup_student_id').val() != '' && $('#signup_agree').is(':checked')) {
    $('#signup_submit').removeAttr('disabled');
    $('#signup_submit').addClass('success');
  }
  else{
    $('#signup_submit').removeClass('success');
    $('#signup_submit').attr('disabled', 'disabled');
  }
}
$(document).on('keyup', '#signup_student_id', function() {
  validateSignup();
});

$(document).on('click', '#signup_agree', function() {
  validateSignup();
});

/* bind bank card page */
function validateBankCard() {
  if($('#personal_bank_card').val() !== '' && 
      !!$('#personal_bank_name').val() && 
      $('#personal_bank_branch').val() !== '') {
    $('#bind_bank_submit').removeAttr('disabled');
    $('#bind_bank_submit').addClass('success');
  } else {
    $('#bind_bank_submit').removeClass('success');
    $('#bind_bank_submit').attr('disabled', 'disabled');
  }
}

$(document).on('keyup', '#personal_bank_card, #personal_bank_branch', function() {
  validateBankCard();
});

$(document).on('change', '#personal_bank_name', function() {
  validateBankCard();
});

$(document).on('click', '#bind_bank_submit', function(e) {
  e.preventDefault();
  if($('#personal_bank_card').val().length < 15) {
    $('.notification-popup').html("请输入银行卡号");
    $('.notification-popup').popup({
      autoopen: true,
      blur: false,
      onopen: function() {
        setTimeout(function() {
          $('.notification-popup').popup('hide');
        }, 1000);
      }
    });
    return;
  }

  var postdata = {
    'uId': $('#uid').val(),
    'page': 'personal_bind_card',
    'bankCard': $('#personal_bank_card').val(), 
    'bank': $('#personal_bank_name').val(), 
    'bankBranch': $('#personal_bank_branch').val()
  };

  $.ajax({
    url: '../api/actions.php',
    type: 'post',
    data: postdata,
    success: function(res1) {
      res1 = JSON.parse(res1);
      if(res1['error']['errno'] === 200) {
        $('.notification-popup').html("绑定成功");
        $('.notification-popup').popup({
          autoopen: true,
          blur: false,
          onopen: function() {
            setTimeout(function() {
              window.location = $('#backurl').val();
              $('.notification-popup').popup('hide');
            }, 1000);
          }
        });
      }
    }
  });
});

/* unbind bank card page */
$(document).on('click', '#bind_unbank_submit', function(e) {
  e.preventDefault();
  bootbox.dialog({
    className: 'custom-dialog dialog-confirm',
    closeButton: false,
    message: "<h3>确定解绑吗</h3><div>申请贷款需要绑定银行卡</div>",
    buttons: {
      danger: {
        label: "取消",
        callback: function() {
        }
      },
      success: {
        label: "确定",
        callback: function() {
          var postdata = {
            'uId': $('#uid').val(),
            'page': 'personal_unbind_card',
            'bankCard': $('#bankcard').val()
          };
          $.ajax({
            url: '../api/actions.php',
            type: 'post',
            data: postdata,
            success: function(res1) {
              res1 = JSON.parse(res1);
              if(res1['error']['errno'] === 200) {
                $('.notification-popup').html("解绑成功");
                $('.notification-popup').popup({
                  autoopen: true,
                  blur: false,
                  onopen: function() {
                    setTimeout(function() {
                      window.location = $('#backurl').val();
                      $('.notification-popup').popup('hide');
                    }, 1000);
                  }
                });
              }
            }
          });
        }
      }
    }
  });
});

/* unbind bank card page */
$(document).ready(function() {
  if($('body').hasClass('personal-coin-mall')) {
    var postdata = {'uId': $('#uid').val(), 'page': 'personal_coin_mall'};
    $.ajax({
      url: '../api/actions.php',
      type: 'post',
      data: postdata,
      success: function(res) {
        res = JSON.parse(res);
        var mall_item_template = $.templates(
          '<div class="mall-item" data-item-id="{{:itemId}}">\
            <div class="item-image">\
              <img src="{{:picUrl}}" />\
            </div>\
            <div class="item-detail">\
              <div class="top">\
                <div class="item-name">{{:name}}</div>\
                <div class="item-content">{{:content}}</div>\
              </div>\
              <div class="bottom">\
                <div class="item-coin-num"><span>{{:coinNum}}</span> 金币</div>\
                <a href="#" class="item-buy">立即兑换</a>\
              </div>\
            </div>\
          </div>');
        var mall_list_html = mall_item_template.render(res.itemList.item);
        $('.mall-item-list').html(mall_list_html);
      }
    });
  }
});

/* user logout */
$(document).ready(function() {
  $('#user_logout').on('click', function() {
    bootbox.dialog({
      className: 'custom-dialog dialog-confirm',
      closeButton: false,
      message: "<h3>确认退出当前账吗?</h3>",
      buttons: {
        danger: {
          label: "取消",
          callback: function() {

          }
        },
        success: {
          label: "确定",
          callback: function() {
          }
        }
      }
    });
  });
});
