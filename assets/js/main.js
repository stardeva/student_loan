// notification function
var notifyTime = 2000;
function notificationPopup(ele, msg) {
  $ele = $(ele);
  $ele.html(msg);
  $ele.popup({
    autoopen: true,
    blur: false,
    onopen: function() {
      setTimeout(function() {
        $ele.popup('hide');
      }, notifyTime);
    }
  });
}

// make notifcation message icon
function makeNotificationIcon() {
  if( !$('.header .topnav .nav.notification').hasClass( 'unread' ) ) {
    $('.header .topnav .nav.notification').addClass('unread');
  }
}

function backNotificationIcon() {
  if( $('.header .topnav .nav.notification').hasClass( 'unread' ) ) {
    $('.header .topnav .nav.notification').removeClass('unread');
  }
}

if($('.topnav .text-right').hasClass('notification')) {
  // click message notification
  $( ".topnav .notification" ).on( "click", function() {
    Cookies.set('message_notification', false);
    backNotificationIcon();
  });

  // check if new notification occur
  if(Cookies.get('message_notification') == 'true') {
    makeNotificationIcon();
  }

  if (!!window.EventSource) {
    var index_page_directory_count = 2;
    var array_path = window.location.pathname.split('/');
    var current_directory_count = array_path.length;
    // remove empty and .php data
    var array_length = 0;
    for(var ap=0; ap< current_directory_count; ap ++) {
      if(array_path[ap] != '' && !array_path[ap].includes('.php')) {
        array_length ++;
      }
    }
    current_directory_count = array_length;
    var socket_php_path = '';

    for(var i = 0; i < ( current_directory_count - index_page_directory_count ); i ++ ) {
      socket_php_path += '../';
    }
    socket_php_path += 'api/socket_io.php';
    
    var source = new EventSource(socket_php_path);
    source.addEventListener('message', function(e) {
      if(e.data == 'changed') {
        // check if the current page is message one
        if($('body').hasClass('personal-my-message')) {
          location.reload();
        } else {
          Cookies.set('message_notification', true);
          makeNotificationIcon();
        }
      }
    }, false);

  } else {
    alert("Your browser does not support Server-sent events! Please upgrade it!");
  }
}

// red activity button
function redClick() {
  var $red_handler = $('.red-activity-page');

  var postdata = {'uId': $red_handler.find('#uid').val(), 
                'page': 'sred_activity_page'};

  $.ajax({
    url: '../api/actions.php',
    type: 'post',
    data: postdata,
    success: function(res) {
      res = JSON.parse(res);console.log(res)
      if(res.error.errno == 200) {
        if(res.grabed == 1) {
          $red_handler.find('.red-active-btn').css('display', 'inline-block');
          $red_handler.find('.red-unactive-btn').hide();
        } else {
          $red_handler.find('.red-active-btn').hide();
          $red_handler.find('.red-unactive-btn').show();
        }
        initialRedActivity();
        
      } else {
        notificationPopup($red_handler.find('.notification-popup'), res.error.usermsg);
      }
    }
  });
  
}

// initial red activity page
function initialRedActivity() {
  var $red_handler = $('.red-activity-page');
  var postdata = {'uId': $red_handler.find('#uid').val(), 
                'page': 'red_activity_page'};
  $.ajax({
    url: '../api/actions.php',
    type: 'post',
    data: postdata,
    success: function(res) {
      res = JSON.parse(res);console.log(res)
      if(res.error.errno == 200) {
        if(res.grabed == 1) {
          $red_handler.find('.main-loan-area').show();  
          $red_handler.find('.error-section').hide();  
          $red_handler.find('.red-process').show();          
          $red_handler.find('.red-check').hide();
          $red_handler.find('.grab-amount').html(res.grabMoney + '元');
          $red_handler.find('.red-section').hide();          
        } else {
          $red_handler.find('.red-process').hide();
          $red_handler.find('.red-check').show();
          $red_handler.find('.red-section').show();
          $red_handler.find('.red-section').height($(window).height() * 0.35 - 50);
        }
        
        $red_handler.find('.main-loan-area .wrap').height($(window).height() * 0.65);        
        
      } else {
        $red_handler.find('.main-loan-area').hide();  
        $red_handler.find('.error-section').show();  
      }
    }
  });
}

// go to card page in borrow index
function goCardPage(id, data, pro_id) {
  var price_element = '.borrow-page #', time_element, origin_element;

  if(id) {
    price_element += id;    
  }
  time_element = price_element;
  
  time_element = price_element + ' select.during-selector';
  origin_element = price_element + ' select.cost-selector';
  price_element += ' .loan-price';
  var original_price = parseInt( $(origin_element).val() );
  var borrow_price = parseFloat( $(price_element).html() );
  var error_msg = '';

  if(original_price <= 500) {
    if(data.cdBase != 1) {
      error_msg = '基本信息';
    }
  } else if (original_price > 500 && original_price <= 1000) {
    if (data.cdBase != 1 || data.cdHome != 1) {
        error_msg = "基本信息和家庭资料";
    }
  } else if (original_price > 1000 && original_price <= 3000) {
    if (data.cdBase != 1 || data.cdHome != 1 || data.cdSchool != 1) {
        error_msg = "基本信息、家庭资料和联系资料";
    }
  } else if (original_price > 3000 && original_price <= 5000) {
    if (data.cdBase != 1 || data.cdHome != 1 || data.cdSchool != 1 || data.cdLife != 1) {
        error_msg = "全部资料";
    }
  }

  if(error_msg != '') {
    var dialog_message = '<h3>完善资料</h3>';
    dialog_message += '<p class="dialog-error">需要点亮';
    dialog_message += error_msg;
    dialog_message += '才能申请贷款';
    dialog_message += '</p>';

    bootbox.dialog({
      className: 'custom-dialog dialog-confirm',
      closeButton: false,
      message: dialog_message,
      buttons: {
        danger: {
          label: "取消",
          callback: function() {

          }
        },
        success: {
          label: "确认",
          callback: function() {
            window.location ="../credits";
          }
        }
      }
    });
    return;
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

  $('#request_modal').modal('hide');
  var $request_form = $('#request_loan_form');
  var pro_id = $request_form.find('#pro_id').val();
  var money = $request_form.find('#money').val();
  var time = $request_form.find('#time').val();
  
  var picIdList = '';
  var boolPic = false;
  $request_form.find("input[name='conPics[]']").each(function() {
    if($(this).val()) {
      picIdList += $(this).val();
      picIdList += ',';
    }             
  });

  if($('.request-loan-page').find('.upload-picture').length > 0) {
    boolPic = true;
    if(picIdList == '') {
      notificationPopup('.request-loan-page .notification-popup', '请上传图片');
      return;
    }
  }
  
  if(picIdList.slice(-1) == ',') {
    picIdList = picIdList.slice(0,-1);
  }

  var day = 0, month = 0;
  if(pro_id == 3) {
    month = time;
  } else {
    day = time;
  }

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
          var postdata = {'uId': $('#uid').val(), 
                        'page': 'request_loan_page',
                        'lnProdId': pro_id,
                        'money': money,
                        'day': day,
                        'month': month};
          if(boolPic) {
            postdata.conPics = picIdList;
          }
          $.ajax({
            url: '../api/actions.php',
            type: 'post',
            data: postdata,
            success: function(res) {
              res = JSON.parse(res);
              if(res.error.errno == 200) {
                window.location ="request_success.php";
              } else {
                notificationPopup('.request-loan-page .notification-popup', res.error.usermsg);
              }
            }
          });
          
        }
      }
    }
  });
}

// receive feedback in estimate/feedback.php
function giveUserFeedback(e) {
  e.preventDefault();
  
  var $request_form = $('.set-estimate-page .estimate-form');
  var form_data = $request_form.serializeArray();
  var postdata = {};

  $.map(form_data, function(item, index){
      postdata[item.name] = item.value;   
  });

  if (!postdata.star || postdata.star == '') {
     postdata.star = 0;
  }

  if(postdata.agree == 'on') {
    postdata.hide = 1;
  } else {
    postdata.hide = 0;
  }
  delete postdata["agree"];

  $.ajax({
    url: '../api/actions.php',
    type: 'post',
    data: postdata,
    success: function(res) {
      res = JSON.parse(res);
      if(res.error.errno == 200) {
        window.location ="../estimate";
      } else {
        console.log('error: ');
        console.log(res);
        notificationPopup($('.set-estimate-page .notification-popup'), res.error.errmsg);
      }
    }
  });
}

// get pdf Document
function callGetPDFDocment (response, canvasContainer) {
  var scale = 1;
        
  function renderPage(page) {
      var viewport = page.getViewport($(window).width() / page.getViewport(1.0).width);
      var canvas = document.createElement('canvas');
      var ctx = canvas.getContext('2d');
      var renderContext = {
        canvasContext: ctx,
        viewport: viewport
      };      
      
      canvas.height = viewport.height;
      canvas.width = viewport.width;      
      canvasContainer.appendChild(canvas);
      
      page.render(renderContext);
  }

  function renderPages(pdfDoc) {
      for(var num = 1; num <= pdfDoc.numPages; num++)
          pdfDoc.getPage(num).then(renderPage);
  }
  PDFJS.disableWorker = true;
  PDFJS.getDocument(response).then(renderPages);
}

// display pdf to the canvas in more/help.php
function displayPDF (url, canvasContainer) {
  PDFJS.workerSrc = './assets/js/pdf.worker.js';
  var params = 'page=help_page&url=';
  params += url;
  var get_url = './api/actions.php';
  var xhr = new XMLHttpRequest();
  xhr.open('GET', get_url + '?' + params, true);
  xhr.responseType = 'arraybuffer';
  xhr.onload = function(e) {
    //binary form of ajax response,
    callGetPDFDocment(e.currentTarget.response, canvasContainer);
  };

  xhr.onerror = function  () {
      // body...
      alert("xhr error");
  }

  xhr.send();
}

// set main form width as windows one in back card page
function setMainDocumentHeight() {
  var footer_height = 0, 
    main_height = 0,
    window_height = $(window).height(),
    wrap_height = parseInt( $('.main-loan-area .main-wrap').height() ),
    header_height = 60;

  $('.one-loan-page').height(window_height);

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

$(window).resize(function() {
  setMainDocumentHeight();
});

$(document).ready(function() {
  /* show modal when page load */
  if($('body').hasClass('home-index-page')) {
    if(typeof Cookies !== 'undefined' && Cookies.get('intro_dialog') === undefined) {
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
    }
  }
  
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

      if(Cookies.get('back') == 1) {
        creditBaseSwiper.slideNext();
        Cookies.set('back', 0);
        Cookies.remove('back');
      }
    }
  }

  if($('body').hasClass('credits-index-page')) {
    $('.medal.disabled').on('click', function(e) {
      e.preventDefault();
      if($(this).hasClass('home'))
        notificationPopup('.notification-popup', 'You need to fill the base information.')
      else if($(this).hasClass('contacts'))
        notificationPopup('.notification-popup', 'You need to fill the base and home information.')
      else if($(this).hasClass('other'))
        notificationPopup('.notification-popup', 'You need to fill the base, home and school information.')
    });
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

    // set slider value label in refund page
    $( ".refund-detail .slider-wrap .slider-label-container .value-label" ).each(function() {
      var slider_value = $(this).attr('slider-value');
      $( this ).css( "left",  slider_value);
    });

  }  

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

  // calculator page 
  if($('body').hasClass('calculator-page')) {
    Hammer.plugins.fakeMultitouch();

    $("select.loan-selector").drum({
      onChange : function (elem) {
        var rate = $(elem).attr('rate');
        var pro_id = $(elem).attr('proId');
        var element_id = g_page_element + ' ';
        var array_tab = ['#fuli', '#huoli', '#yueli'];

        if(rate && pro_id) {
          element_id += array_tab[parseInt(pro_id)-1];
          setCalculatedValue(element_id);
        }
      },
      interactive: false
    });
  }

  // feedback page form validation in more/feedback.php
  /*if($('#feedback_form').length) {    

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
  }*/

  if($('body').hasClass('more-feedback-page')) {
      $(document).on('keyup', '.more-feedback #feedback', function() {
        if($(this).val() != '') {
          $('#feedback_submit').removeAttr('disabled');
          $('#feedback_submit').addClass('success');
        }
        else{
          $('#feedback_submit').removeClass('success');
          $('#feedback_submit').attr('disabled', 'disabled');
        }
      });

      $('.more-feedback #feedback_submit').on('click', function(e) {
        e.preventDefault();
        var postdata = {'uId': $('#uid').val(), 'page': 'more_feedback', 'feedback': $('.more-feedback #feedback').val()};
        $.ajax({
          url: '../api/actions.php',
          type: 'post',
          data: postdata,
          success: function(res) {
            res = JSON.parse(res);
            if(res.error.errno === 200) {
              $('.notification-popup').html("已提交");
              $('.notification-popup').popup({
                autoopen: true,
                blur: false,
                onopen: function() {
                  setTimeout(function() {
                    $('.notification-popup').popup('hide');
                    window.location = $('#backurl').val();
                  }, notifyTime);
                }
              });
            }
          }
        });
      });
    }

  // request page validation in borrow/request.php
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

  // estimate page validation in estimate/feedback.php
  if($('.set-estimate-page .estimate-form').length) {
    $('.set-estimate-page .estimate-form').bootstrapValidator({
      fields: {
        content: {
          validators: {
            notEmpty: {
              message: 'The feedback is required.'
            }
          }
        }
    }
    });

    $('.set-estimate-page .estimate-form').on('status.field.bv', function(e, data) {
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
  function setCalculatedValue(ele) { 
    var $ele = $(ele);
    var price = $ele.find('select.cost-selector').val();
    var date = $ele.find('select.during-selector').val();
    var rate = $ele.find('select.cost-selector').attr('rate');
    id = ele;
    price = calResult(id, price, rate, date);
    $ele.find('.loan-price').html(price + '元');
    if(getCalcType(id) != '#yueli')
      $ele.find('.loan-time .number').html(date);
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

    return parseFloat(value).toFixed(2);

  }

  var g_page_element;

  function initCalculator(page_element) {
    var array_element = ['#fuli', '#huoli', '#yueli'];
    for(var i = 0; i < array_element.length; i ++) {
      var element = page_element + ' ';
      element += array_element[i];
      var rate = $(element).find('select.cost-selector').attr('rate');
      setCalculatedValue(element);
    }

    g_page_element = page_element;
  }

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

  // borrow/loan_contact.php
  if($('body').hasClass('loan-contact-page')) {
    $('.loan-contact-page .header .back').click(function(){
      window.location.origin;
    });
  }

  // init data in borrow page
  if($('body').hasClass('borrow-page')) {    
    initCalculator('.borrow-page');
    var description_height = $(window).height() 
                          - parseInt($('.header').css('height'))
                          - parseInt($('.process .nav-tabs').css('height'))
                          - parseInt($('.process .loan-kind').css('height')) 
                          - parseInt($('.process .result').css('height'))
                          - parseInt($('.process .start-loan .loan-button').css('height'));
    $('.process .start-loan .description-group').height(description_height);
  }

  // init data in calculator page
  if($('body').hasClass('calculator-page')) {
    initCalculator('.calculator-page');
    var description_height = $(window).height() 
                          - parseInt($('.header').css('height'))
                          - parseInt($('.process .nav-tabs').css('height'))
                          - parseInt($('.process .loan-kind').css('height')) 
                          - parseInt($('.process .result').css('height'));

    $('.process .start-loan').height(description_height);
  }  

  /* red activity page */
  if($('body').hasClass('red-activity-page')) {
    initialRedActivity();  
  }

  setMainDocumentHeight();
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
        }, notifyTime);
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
            }, notifyTime);
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
                    }, notifyTime);
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
            var postdata = {page: 'logout'};
            $.ajax({
              url: '../api/actions.php',
              type: 'post',
              data: postdata,
              success: function(res) {
                window.location = '../index.php';
              }
            });
          }
        }
      }
    });
  });
});

/* share app */
$(document).ready(function() {
  $('.personal-index-page .personal-info-list .user-invite').on('click', function(e) {
    e.preventDefault();
    $('.personal-index-page .bg-overlay').removeClass('hidden');
    $('.personal-index-page .user-invite-apps').css('display', 'flex');
  });

  $('.personal-index-page .bg-overlay').on('click', function(e) {
    $('.personal-index-page .user-invite-apps').hide();
    $('.personal-index-page .bg-overlay').addClass('hidden');
  });

  $('.personal-index-page #close_invite').on('click', function(e) {
    $('.personal-index-page .user-invite-apps').hide();
    $('.personal-index-page .bg-overlay').addClass('hidden');
  });
});

/* Check in */
$(document).ready(function() {
  $('.home-checkin-page .main .button.btn-unsigned').on('click', function() {
    var postdata = {'uId': $('#uid').val(), 
                  'page': 'checkin_page'};
    $.ajax({
      url: 'api/actions.php',
      type: 'post',
      data: postdata,
      success: function(res) {
        res = JSON.parse(res);
        if(res.error.errno == 200) {
          $('.checkin-success-wrapper .checkin-success .days').html(res.coins);
          $('.checkin-success-wrapper .checkin-success .coins').html(res.totalCoins);
          $('.checkin-success-wrapper.hidden').removeClass('hidden');
          setTimeout(function() {
            $('.checkin-success-wrapper').addClass('hidden');
            window.location ="index.php";
          }, notifyTime);
        } else {
          notificationPopup('.home-checkin-page .notification-popup', res.error.usermsg);
        }
      }
    });
  });
});

/* Coin Gift Buy */
$(document).ready(function() {
  if($('body').hasClass('personal-coin-buy')) {

    $(document).on('keyup', '#personal_coin_buy #coin_buy_signee, #personal_coin_buy #coin_buy_phone, #personal_coin_buy #coin_buy_addr', function() {
      if(!!$('#personal_coin_buy #coin_buy_signee').val() && 
          !!$('#personal_coin_buy #coin_buy_phone').val() &&
          !!$('#personal_coin_buy #coin_buy_addr').val()) {
        $('#coin_buy_submit').removeAttr('disabled');
        $('#coin_buy_submit').addClass('success');
      }
      else{
        $('#coin_buy_submit').removeClass('success');
        $('#coin_buy_submit').attr('disabled', 'disabled');
      }
    });

    $('.personal-coin-buy #feedback_submit').on('click', function(e) {
      e.preventDefault();
      $('#personal_coin_buy').submit();
    });
  }
});
