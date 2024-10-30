var CleverTracking = (function () {
	window.cachebreak = 1;
	var myPName = "CleverTracking";
	let isScrollToBottom = false;

	function getStoreData() {
		return localStorage.hasOwnProperty(myPName) ? JSON.parse(localStorage.getItem(myPName)) : null;
	}

	function getReferrer() {
		const urlParams = new URLSearchParams(window.location.search);
		let ref = urlParams.get('ref');
		return ref == null || ref == undefined ? (isMobile() ? "" : document.referrer) : ref;
	}

	function getReferrerBase() {
		let url = getReferrer();
		return url != null && url.indexOf('?') != -1 ? url.split('?')[0] : url;

	}

	
	function isMobile() {
		return (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino|android|ipad|playbook|silk/i.test(navigator.userAgent || navigator.vendor || window.opera) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test((navigator.userAgent || navigator.vendor || window.opera).substr(0, 4)))
	}
	function getQueryString(url) {
		if (url == null || url == undefined) return '';

		let queryStr = url.split('?')[1];
		return (queryStr == undefined) ? '' : queryStr;
	}


	function setStoreData() {
		let _return = false;
		if (!localStorage.hasOwnProperty(myPName)) {
			//current TimeStamp, Returns the timestamp for 
			//the date – a number of milliseconds passed from the January 1st of 1970 UTC+0
			clevertrackingObject.firstLoadingTimeStamp = (new Date()).getTime();
			clevertrackingObject.pageLoadingTimeStamp = (new Date()).getTime();
			clevertrackingObject.PHPSESSID = clevertrackingObject.nonce || "";
			let dataStr = JSON.stringify(clevertrackingObject);
			localStorage.setItem(myPName, dataStr);

			_return = true;

		}
		else {

			//if custId is different than replace and set with new object.
			let _clevertrackingObject = getStoreData();
			_clevertrackingObject.pageLoadingTimeStamp = (new Date()).getTime();
			let custId = 0;

			if (_clevertrackingObject != undefined && _clevertrackingObject != null) {
				try {
					custId = _clevertrackingObject.custid;
				}
				catch (e) {
					console.log(e);
				}
			}

			if (clevertrackingObject != undefined &&
				(custId != clevertrackingObject.custid ||
					_clevertrackingObject.PHPSESSID != clevertrackingObject.nonce)) {

				_clevertrackingObject.custid = clevertrackingObject.custid ;
				_clevertrackingObject.PHPSESSID = clevertrackingObject.nonce || "";


				//_return = true;
			}
			_clevertrackingObject.CONNECTION_STRING_NAME =clevertrackingObject.CONNECTION_STRING_NAME;
			_clevertrackingObject.apiurl=clevertrackingObject.apiurl;
			_clevertrackingObject.idforcheck =clevertrackingObject.idforcheck;
			_clevertrackingObject.userip =clevertrackingObject.userip;
			_clevertrackingObject.ct_version =clevertrackingObject.ct_version;
			
			_clevertrackingObject.RELEVT_ID =clevertrackingObject.RELEVT_ID?clevertrackingObject.RELEVT_ID:"";
			let dataStr = JSON.stringify(_clevertrackingObject);
			localStorage.setItem(myPName, dataStr);

		}
		return _return;
	}


	function ctpostData(customData) {

		if (!navigator.sendBeacon) { return; }

		let _clevertrackingObject = getStoreData();
		if (_clevertrackingObject == null || _clevertrackingObject.apiurl == null) return "";

		customData.loading_timestamp = _clevertrackingObject.pageLoadingTimeStamp;
		customData.event_timestamp = (new Date()).getTime();

		customData.current_url_base = window.location.origin + window.location.pathname;
		customData.current_url_param = getQueryString(window.location.search);

		customData.referrer_url_base = getReferrerBase();
		customData.referrer_url_param = getQueryString(getReferrer());
		customData.prev_relevt = _clevertrackingObject.RELEVT_ID || "";
		let customDataStr = {};
		if (customData != null && customData != undefined) {
			customDataStr = JSON.stringify(customData); //stringfy object
		}
		else {
			customDataStr = JSON.stringify({}); //empty object
		}
		if (_clevertrackingObject.custid>0 && 
			_clevertrackingObject.idforcheck!=undefined &&
			_clevertrackingObject.idforcheck!=null &&
			(_clevertrackingObject.idforcheck).split(',').includes(_clevertrackingObject.custid)) {
			//alert(`Event name:"${customData.action}"`);
		}
		let dataTemp = {
			"CONNECTION_STRING_NAME":_clevertrackingObject.CONNECTION_STRING_NAME,
			"PURL": _clevertrackingObject.homeurl,
			"PTOKEN": _clevertrackingObject.apikey,
			"PPHPSESSID": clevertrackingObject.nonce || "",
			"PWP_ID": Number.isNaN(_clevertrackingObject.custid) ? 0 : _clevertrackingObject.custid,
			"PWP_USER_EMAIL": _clevertrackingObject.email,
			"PLOADING_TIMESTAMP": _clevertrackingObject.firstLoadingTimeStamp,
			"PEVENT_TIMESTAMP": (new Date()).getTime(),
			"PREV_RELEVT": _clevertrackingObject.RELEVT_ID || "",
			"PDATA": customDataStr

		};
		
		var url = _clevertrackingObject.apiurl;
		if (customData.action =="register" || customData.action =="pageload") {
			
			 jQuery.post(url,dataTemp, 
				function(data, status, xhr){
					if (Array.isArray(data)) {
						clevertrackingObject.RELEVT_ID= (data[0].RELEVT_ID|| 0).toString();
						setStoreData();
					}
				 });
		}
		else  {
			data = JSON.stringify(dataTemp);
			navigator.sendBeacon(url, data);
		}

		
	}

	function bindExternalLink(link) {
		var url = link.getAttribute('href');
		if (url == null || url == undefined) return ;
		
		var host = window.location.hostname.toLowerCase(),
			regex = new RegExp('^(?:(?:f|ht)tp(?:s)?\:)?//(?:[^\@]+\@)?([^:/]+)', 'im'),
			match = url.match(regex),
			domain = ((match ? match[1].toString() : ((url.indexOf(':') < 0) ? host : ''))).toLowerCase();
		// Same domain
		if (domain != host) {
			link.onclick = function (e) {
				let _clevertrackingObject = getStoreData();

				if (_clevertrackingObject == null || _clevertrackingObject.apiurl == null) return;

				var anchor = this.innerText;
				var imgurl = "";
				if (anchor.length == 0) {
					anchor = this.innerHTML.trim();
					if (typeof (this.children) !== 'undefined') {
						if (this.children.length > 0) {
							if (this.children[0].tagName == 'IMG') {
								imgurl = this.children[0].src;
							}
						}
					}
				}
				if (this.href.length > 0) {
					var dataTemp = {
						"action": "ext_click",
						"click_url": this.href,
						"post_id": _clevertrackingObject.postid,
						"inner_text": anchor,
						"imgurl": imgurl,
						"ct_session_id": clevertrackingObject.nonce || "",
						"ip_address": _clevertrackingObject.userip,
						"ct_version": _clevertrackingObject.ct_version || ""
					};
					ctpostData(dataTemp);

				}

			}
		}
	}
	function processClickBinding() {

		for (var l = 0, links = document.querySelectorAll('a'), ll = links.length; l < ll; ++l) {
			bindExternalLink(links[l]);
		}

		return;
	}

	function checkIfItRegistered() {
		if (setStoreData()) {

			//setStoreData(clevertrackingObject) ;
			let _clevertrackingObject = getStoreData();
			var dataTemp = {
				"action": "register",
				"ct_session_id":clevertrackingObject.nonce || "",
				"ip_address": _clevertrackingObject.userip,
				"ct_version": _clevertrackingObject.ct_version || ""
			};
			ctpostData(dataTemp);

		}



	}
	function loadPageRegistered() {

		let _clevertrackingObject = getStoreData();

		var dataTemp = {
			"action": "pageload",
			"ct_session_id": clevertrackingObject.nonce || "",
			"ip_address": _clevertrackingObject.userip,
			"ct_version": _clevertrackingObject.ct_version || ""
		};
		ctpostData(dataTemp);
	}
	function pageScrollRegistration() {

		//tested with major browser.
		var pageHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight, document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight);
		if (!isScrollToBottom && (window.innerHeight + Math.ceil(window.pageYOffset + 1)) >= pageHeight) {

			isScrollToBottom = true;
			let _clevertrackingObject = getStoreData();
			var dataTemp = {
				"action": "pagescroll",
				"ct_session_id": clevertrackingObject.nonce || "",
				"ip_address": _clevertrackingObject.userip,
				"ct_version": _clevertrackingObject.ct_version || ""
			};
			ctpostData(dataTemp);
		}


	}


	function itSeemsPageIsClosing() {
		if (document.visibilityState === 'hidden') {


			let _clevertrackingObject = getStoreData();
			var dataTemp = {
				"action": "close",
				"ct_session_id": clevertrackingObject.nonce || "",
				"ip_address": _clevertrackingObject.userip,
				"ct_version": _clevertrackingObject.ct_version || ""
			};
			ctpostData(dataTemp);
		}
	}
	function pageBeforeunload() {



		let _clevertrackingObject = getStoreData();
		var dataTemp = {
			"action": "beforeunload",
			"ct_session_id": clevertrackingObject.nonce || "",
			"ip_address": _clevertrackingObject.userip,
			"ct_version": _clevertrackingObject.ct_version || ""
		};
		ctpostData(dataTemp);

	}
	var _clevertrackingOnReadyFired  =false;
	function onReady() {
		if (_clevertrackingOnReadyFired)  return;
		
		_clevertrackingOnReadyFired =true;
		if (getStoreData()==null) {
			checkIfItRegistered();
		}
							
		loadPageRegistered();
		
		processClickBinding();
	}
	document.addEventListener("visibilitychange", itSeemsPageIsClosing);
	document.addEventListener("scroll", pageScrollRegistration);

	if (!isMobile()) document.addEventListener("beforeunload", pageBeforeunload);

	document.addEventListener("DOMContentLoaded", onReady);
	document.onreadystatechange = () => {
		switch (document.readyState) {
			case "complete": {
				onReady();
				break;
			}
		}


	};
})();
