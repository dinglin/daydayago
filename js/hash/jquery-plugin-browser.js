/**
* ���� jquery.js
*
* ����������ж����
*
*/
var Browser = {
	// ����Ƿ���IE�����
	isIE: function() {
		var _uaMatch = $.uaMatch(navigator.userAgent);
		var _browser = _uaMatch.browser;
		if (_browser == 'msie') {
			return true;
		} else {
			return false;
		}
	},
	// ����Ƿ���chrome�����
	isChrome: function() {
		var _uaMatch = $.uaMatch(navigator.userAgent);
		var _browser = _uaMatch.browser;
		if (_browser == 'chrome') {
			return true;
		} else {
			return false;
		}
	},
	// ����Ƿ���Firefox�����
	isMozila: function() {
		var _uaMatch = $.uaMatch(navigator.userAgent);
		var _browser = _uaMatch.browser;
		if (_browser == 'mozilla') {
			return true;
		} else {
			return false;
		}
	},
	// ����Ƿ���Firefox�����
	isOpera: function() {
		var _uaMatch = $.uaMatch(navigator.userAgent);
		var _browser = _uaMatch.browser;
		if (_browser == 'opera') {
			return true;
		} else {
			return false;
		}
	}
}
window.Browser=Browser;