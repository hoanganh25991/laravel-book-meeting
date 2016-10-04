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
eval("'use strict';\n\nvar endAnimationSignal = 'animationend';\nvar animation = 'fadeOutRight';\nvar flash = function flash(msg, level) {\n\tlevel = level || 'info';\n\tvar flashDiv = $('.alert');\n\n\tflashDiv.text(msg);\n\tflashDiv.removeClass();\n\tflashDiv.addClass('alert alert-' + level);\n\tvar interval = setInterval(function () {\n\t\tflashDiv.addClass('animated  ' + animation);\n\t\tclearInterval(interval);\n\t}, 3000);\n\n\tflashDiv.one(endAnimationSignal, function () {\n\t\tflashDiv.removeClass('' + animation);\n\t});\n};\nwindow.flash = flash;//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2ZsYXNoLmpzPzdkNGYiXSwic291cmNlc0NvbnRlbnQiOlsiJ3VzZSBzdHJpY3QnO1xuXG52YXIgZW5kQW5pbWF0aW9uU2lnbmFsID0gJ2FuaW1hdGlvbmVuZCc7XG52YXIgYW5pbWF0aW9uID0gJ2ZhZGVPdXRSaWdodCc7XG52YXIgZmxhc2ggPSBmdW5jdGlvbiBmbGFzaChtc2csIGxldmVsKSB7XG5cdGxldmVsID0gbGV2ZWwgfHwgJ2luZm8nO1xuXHR2YXIgZmxhc2hEaXYgPSAkKCcuYWxlcnQnKTtcblxuXHRmbGFzaERpdi50ZXh0KG1zZyk7XG5cdGZsYXNoRGl2LnJlbW92ZUNsYXNzKCk7XG5cdGZsYXNoRGl2LmFkZENsYXNzKCdhbGVydCBhbGVydC0nICsgbGV2ZWwpO1xuXHR2YXIgaW50ZXJ2YWwgPSBzZXRJbnRlcnZhbChmdW5jdGlvbiAoKSB7XG5cdFx0Zmxhc2hEaXYuYWRkQ2xhc3MoJ2FuaW1hdGVkICAnICsgYW5pbWF0aW9uKTtcblx0XHRjbGVhckludGVydmFsKGludGVydmFsKTtcblx0fSwgMzAwMCk7XG5cblx0Zmxhc2hEaXYub25lKGVuZEFuaW1hdGlvblNpZ25hbCwgZnVuY3Rpb24gKCkge1xuXHRcdGZsYXNoRGl2LnJlbW92ZUNsYXNzKCcnICsgYW5pbWF0aW9uKTtcblx0fSk7XG59O1xud2luZG93LmZsYXNoID0gZmxhc2g7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvZmxhc2guanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);