/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

"use strict";
eval("'use strict';\n\nvar endAnimationSignal = 'animationend';\nvar animation = 'fadeOutRight';\nvar flashDiv = $('.alert');\nvar flash = function flash(msg, level) {\n\tlevel = level || 'info';\n\n\tflashDiv.html(msg);\n\tflashDiv.attr('class', 'alert alert-' + level);\n\n\tvar interval = setInterval(function () {\n\t\tflashDiv.addClass('animated  ' + animation);\n\t\tclearInterval(interval);\n\t}, 3000);\n\n\tflashDiv.one(endAnimationSignal, function () {\n\t\t// flashDiv.removeClass();\n\t\tconsole.log('animation end');\n\t});\n};\nwindow.flash = flash;//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2ZsYXNoLmpzPzdkNGYiXSwic291cmNlc0NvbnRlbnQiOlsiJ3VzZSBzdHJpY3QnO1xuXG52YXIgZW5kQW5pbWF0aW9uU2lnbmFsID0gJ2FuaW1hdGlvbmVuZCc7XG52YXIgYW5pbWF0aW9uID0gJ2ZhZGVPdXRSaWdodCc7XG52YXIgZmxhc2hEaXYgPSAkKCcuYWxlcnQnKTtcbnZhciBmbGFzaCA9IGZ1bmN0aW9uIGZsYXNoKG1zZywgbGV2ZWwpIHtcblx0bGV2ZWwgPSBsZXZlbCB8fCAnaW5mbyc7XG5cblx0Zmxhc2hEaXYuaHRtbChtc2cpO1xuXHRmbGFzaERpdi5hdHRyKCdjbGFzcycsICdhbGVydCBhbGVydC0nICsgbGV2ZWwpO1xuXG5cdHZhciBpbnRlcnZhbCA9IHNldEludGVydmFsKGZ1bmN0aW9uICgpIHtcblx0XHRmbGFzaERpdi5hZGRDbGFzcygnYW5pbWF0ZWQgICcgKyBhbmltYXRpb24pO1xuXHRcdGNsZWFySW50ZXJ2YWwoaW50ZXJ2YWwpO1xuXHR9LCAzMDAwKTtcblxuXHRmbGFzaERpdi5vbmUoZW5kQW5pbWF0aW9uU2lnbmFsLCBmdW5jdGlvbiAoKSB7XG5cdFx0Ly8gZmxhc2hEaXYucmVtb3ZlQ2xhc3MoKTtcblx0XHRjb25zb2xlLmxvZygnYW5pbWF0aW9uIGVuZCcpO1xuXHR9KTtcbn07XG53aW5kb3cuZmxhc2ggPSBmbGFzaDtcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9mbGFzaC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);