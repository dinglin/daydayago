/**
* ÒÀÀµ jquery.js
*
* ä¯ÀÀÆ÷ÀàĞÍÅĞ¶Ï×é¼ş
*
*/
var Browser = {
	// ¼ì²âÊÇ·ñÊÇIEä¯ÀÀÆ÷
	isIE: function() {
		var _uaMatch = $.uaMatch(navigator.userAgent);
		var _browser = _uaMatch.browser;
		if (_browser == 'msie') {
			return true;
		} else {
			return false;
		}
	},
	// ¼ì²âÊÇ·ñÊÇchromeä¯ÀÀÆ÷
	isChrome: function() {
		var _uaMatch = $.uaMatch(navigator.userAgent);
		var _browser = _uaMatch.browser;
		if (_browser == 'chrome') {
			return true;
		} else {
			return false;
		}
	},
	// ¼ì²âÊÇ·ñÊÇFirefoxä¯ÀÀÆ÷
	isMozila: function() {
		var _uaMatch = $.uaMatch(navigator.userAgent);
		var _browser = _uaMatch.browser;
		if (_browser == 'mozilla') {
			return true;
		} else {
			return false;
		}
	},
	// ¼ì²âÊÇ·ñÊÇFirefoxä¯ÀÀÆ÷
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