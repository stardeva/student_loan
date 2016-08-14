$(document).ready(function() {
  $('.carousel').carousel({
    interval: 2000
  });

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
});