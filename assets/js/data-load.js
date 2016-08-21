//*-----------
//* TEMPLATE *
//*-----------
var carouselTemplate = $.templates(
  '<div class="item">\
    <a href="{{:url}}">\
      <img src="{{:picUrl}}" class="carousel-image" />\
    </a>\
  </div>'
);

//*-------------
//* LOAD DATA *
//*-------------
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
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

function createSelectBox(el, data) {
  el.find('.start-loan .description .content > p').html(data.intro);
  el.find('.start-loan .last-description .content > p').html(data.lateIntro);
  var options = getOptions(data.maxMoney, 50, data.minMoney);
  el.find('select.cost-selector').html(options);
  options = getOptions(data.maxMonth, 1, data.minMonth);
  el.find('select.during-selector').html(options);
}

setCookie('auth_token', 'dd', 1);

// carousel section in home page
var data = {
  'uid': '4dba7e89fa0ffb27ecfd3ab0',
  'deviceId': '00000000000000008:00:27:44:04:bb323ec7466101f399',
  'deviceOs': 'Android',
  'deviceType': 'Google Nexus S - 4.1.1 - API 16 - 480x800',
  'deviceOp': '4.1.1',
  'version': '1.0.1',
  'deviceToken': 'dd'
}
/*
Api.post(ENDPOINT.ADDRESS_SYS_INIT, data).then(function (res) {
  if(res.error.errno == 200) {
    var html = carouselTemplate.render(res.ad.carousel);
    $('#banner_slider').html(html);
    $('#banner_slider').slick({
      dots: true,
      infinite: true,
      speed: 300,
      autoplay: true,
      arrows: false,
      mobileFirst: true
    });
  }  
})
*/
// calculator data
Api.post(ENDPOINT.ADDRESS_LN_CALCULATOR, data).then(function (res) {
  if(res.error.errno == 200) {
    createSelectBox($('#fuli'), res.lnProdList.prod[0]);
    createSelectBox($('#fuoli'), res.lnProdList.prod[1]);
    createSelectBox($('#yueli'), res.lnProdList.prod[2]);
  }  
})

