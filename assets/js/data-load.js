//*-----------
//* TEMPLATE *
//*-----------
var carouselTemplate = $.templates(
  '{{if #index==0}}\
  <div class="item active">\
  {{else}}\
  <div class="item">\
  {{/if}}\
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

Api.post(ENDPOINT.ADDRESS_SYS_INIT, data).then(function (res) {console.log(res)
  if(res.error.errno == 200) {
    var html = carouselTemplate.render(res.ad.carousel);
    $('#banner_slider .carousel-inner').html(html);
    $('.carousel').carousel({
      interval: 2000
    });
  }  
})
