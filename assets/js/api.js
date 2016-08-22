var ENDPOINT = {
	HOST: 'http://api.wazxb.com/',
	ADDRESS_SYS_VCODE:   	'sys/vcode',
	ADDRESS_SYS_INIT:    	'sys/init',
	ADDRESS_U_REG:  	   	'u/reg',
	ADDRESS_U_LOGIN: 	   	'u/login',
	ADDRESS_U_BANK:      	'u/bank',
	ADDRESS_U_UNBANK:    	'u/unbank',
	ADDRESS_CD_UPHOME:   	'cd/uphome',
	ADDRESS_CD_LIFE: 	   	'cd/uplife',
	ADDRESS_CD_BASE: 	 	 	'cd/upbase',
	ADDRESS_CD_INFO:   	 	'cd/info',
	ADDRESS_CD_UPSCHOOL: 	'cd/upschool',
	ADDRESS_U_MSG: 			 	'u/msg',
	ADDRESS_U_FEEDBACK:   'u/feedback',
	ADDRESS_U_UPPORTRAIT: 'u/upportrait',
	ADDRESS_U_GESTURE: 		'u/gesture',
	ADDRESS_U_BOOK: 			'u/book',

	ADDRESS_LN_CALCULATOR: 'ln/calculator',
	ADDRESS_LN_APPLY: 		 'ln/apply',
	ADDRESS_LN_PROD: 			 'ln/prod',
	ADDRESS_LN_RETURN:     'ln/return',
	ADDRESS_LN_HISTORY: 	 'ln/history',
	ADDRESS_LN_EVALUATE:   'ln/evaluate',
	ADDRESS_LN_SEVALUATE:  'ln/sevaluate',

	ADDRESS_MALL_LIST: 'mall/list',
	ADDRESS_MALL_BUY:  'mall/buy',

	ADDRESS_SYS_SRED: 'app/sred',
	ADDRESS_SYS_RED:  'app/red',

	ADDRESS_SYS_SIGN:  'app/sign',
	ADDRESS_SYS_SSIGN: 'app/ssign',

	ADDRESS_PW_FIND: 	 'pw/find',
	ADDRESS_PW_MODIFY: 'pw/modify',
	ADDRESS_PW_VERIFY: 'pw/verify',
	ADDRESS_SE_SCHOOL: 'se/school',

  ADDRESS_UP_IMAGE: 'sys/uppic'
}

var Api = {
  getToken () {
    // http://www.the-art-of-web.com/javascript/getcookie/
    function getCookie(name) {
      var re = new RegExp(name + "=([^;]+)");
      var value = re.exec(document.cookie);
      return (value != null) ? unescape(value[1]) : null;
    }
    return getCookie("auth_token")
  },

  headers () {
    return {      
      'Accept': '*/*',
      'Content-Type': 'application/form-data',
      //'Authorization': this.getToken()
    }
  },
  request (url, options) {
    return new Promise( function (resolve, reject) {
      return fetch(url, options)
        .then( function (response) {
          if (!response.ok) {
            return response.json().then( function (json) {
              reject(errorMessage(json))
            } )
          }

          return response.json()
            .then( function (json) {
              return resolve(json)
            })
        })
    })
  },
  get (url) {
    var options = {
      headers: this.headers(),
      mode: 'cors'
    }

    return this.request(ENDPOINT.HOST + url, options)
  },
  post (url, data) {
  	var body = new FormData();
    for ( var key in data ) {
      body.append(key, data[key]);
    }

    var options = {
      header: this.headers(),
      method: 'post',
      body: body,
      mode: 'cors'
    }

    return this.request(ENDPOINT.HOST + url, options)
  },
  delete (url, data) {
    var options = {
      headers: this.headers(),
      method: 'delete',
      mode: 'cors'
    }

    if (data) {
      options.body = JSON.stringify(data)
    }

    return this.request(ENDPOINT.HOST + url, options)
  }
}
