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
eval("'use strict';\n\n$(document).ready(function () {\n\tvar f_overlay = $('.f_overlay');\n\n\tvar flashDiv = void 0;\n\tif (f_overlay.find('.alert').length == 0) {\n\t\tflashDiv = $('<div class=\"alert alert-info\"></div>');\n\t\tflashDiv.appendTo(f_overlay);\n\t\tflashDiv.addClass('hidden');\n\t} else flashDiv = $('.alert');\n\n\tvar flashDivClass = flashDiv.attr('class');\n\t//only hide flashMsg when it NOT important\n\tvar isImportantMsg = flashDivClass.includes('alert-important');\n\n\tvar waitFor = 3000;\n\tvar interval = setInterval(function () {\n\t\tvar animation = 'animated fadeOutRight';\n\t\tif (isImportantMsg) {\n\t\t\tanimation = '';\n\t\t}\n\t\tflashDiv.addClass(animation);\n\n\t\tclearInterval(interval);\n\t}, waitFor);\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2xvYWQtZmxhc2guanM/MTkzYyJdLCJzb3VyY2VzQ29udGVudCI6WyIndXNlIHN0cmljdCc7XG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcblx0dmFyIGZfb3ZlcmxheSA9ICQoJy5mX292ZXJsYXknKTtcblxuXHR2YXIgZmxhc2hEaXYgPSB2b2lkIDA7XG5cdGlmIChmX292ZXJsYXkuZmluZCgnLmFsZXJ0JykubGVuZ3RoID09IDApIHtcblx0XHRmbGFzaERpdiA9ICQoJzxkaXYgY2xhc3M9XCJhbGVydCBhbGVydC1pbmZvXCI+PC9kaXY+Jyk7XG5cdFx0Zmxhc2hEaXYuYXBwZW5kVG8oZl9vdmVybGF5KTtcblx0XHRmbGFzaERpdi5hZGRDbGFzcygnaGlkZGVuJyk7XG5cdH0gZWxzZSBmbGFzaERpdiA9ICQoJy5hbGVydCcpO1xuXG5cdHZhciBmbGFzaERpdkNsYXNzID0gZmxhc2hEaXYuYXR0cignY2xhc3MnKTtcblx0Ly9vbmx5IGhpZGUgZmxhc2hNc2cgd2hlbiBpdCBOT1QgaW1wb3J0YW50XG5cdHZhciBpc0ltcG9ydGFudE1zZyA9IGZsYXNoRGl2Q2xhc3MuaW5jbHVkZXMoJ2FsZXJ0LWltcG9ydGFudCcpO1xuXG5cdHZhciB3YWl0Rm9yID0gMzAwMDtcblx0dmFyIGludGVydmFsID0gc2V0SW50ZXJ2YWwoZnVuY3Rpb24gKCkge1xuXHRcdHZhciBhbmltYXRpb24gPSAnYW5pbWF0ZWQgZmFkZU91dFJpZ2h0Jztcblx0XHRpZiAoaXNJbXBvcnRhbnRNc2cpIHtcblx0XHRcdGFuaW1hdGlvbiA9ICcnO1xuXHRcdH1cblx0XHRmbGFzaERpdi5hZGRDbGFzcyhhbmltYXRpb24pO1xuXG5cdFx0Y2xlYXJJbnRlcnZhbChpbnRlcnZhbCk7XG5cdH0sIHdhaXRGb3IpO1xufSk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvbG9hZC1mbGFzaC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);