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
eval("'use strict';\n\nvar f_overlay = $('.f_overlay');\n\nvar flashDiv = void 0;\nvar isCreateNew = false;\nif (f_overlay.find('.alert').length == 0) {\n\tflashDiv = $('<div class=\"alert alert-info\"></div>');\n\tflashDiv.appendTo(f_overlay);\n\tflashDiv.addClass('hidden');\n\tisCreateNew = true;\n} else flashDiv = $('.alert');\n\nvar flashDivClass = flashDiv.attr('class');\n//only hide flashMsg when it NOT important\nvar isImportantMsg = flashDivClass.includes('alert-important');\n\nif (!isCreateNew) {\n\t(function () {\n\t\tvar waitFor = 3000;\n\t\tvar interval = setInterval(function () {\n\t\t\tvar animation = 'animated fadeOutRight';\n\t\t\tif (isImportantMsg) {\n\t\t\t\tanimation = '';\n\t\t\t}\n\t\t\tflashDiv.addClass(animation);\n\n\t\t\tclearInterval(interval);\n\t\t}, waitFor);\n\t})();\n}//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2xvYWQtZmxhc2guanM/MTkzYyJdLCJzb3VyY2VzQ29udGVudCI6WyIndXNlIHN0cmljdCc7XG5cbnZhciBmX292ZXJsYXkgPSAkKCcuZl9vdmVybGF5Jyk7XG5cbnZhciBmbGFzaERpdiA9IHZvaWQgMDtcbnZhciBpc0NyZWF0ZU5ldyA9IGZhbHNlO1xuaWYgKGZfb3ZlcmxheS5maW5kKCcuYWxlcnQnKS5sZW5ndGggPT0gMCkge1xuXHRmbGFzaERpdiA9ICQoJzxkaXYgY2xhc3M9XCJhbGVydCBhbGVydC1pbmZvXCI+PC9kaXY+Jyk7XG5cdGZsYXNoRGl2LmFwcGVuZFRvKGZfb3ZlcmxheSk7XG5cdGZsYXNoRGl2LmFkZENsYXNzKCdoaWRkZW4nKTtcblx0aXNDcmVhdGVOZXcgPSB0cnVlO1xufSBlbHNlIGZsYXNoRGl2ID0gJCgnLmFsZXJ0Jyk7XG5cbnZhciBmbGFzaERpdkNsYXNzID0gZmxhc2hEaXYuYXR0cignY2xhc3MnKTtcbi8vb25seSBoaWRlIGZsYXNoTXNnIHdoZW4gaXQgTk9UIGltcG9ydGFudFxudmFyIGlzSW1wb3J0YW50TXNnID0gZmxhc2hEaXZDbGFzcy5pbmNsdWRlcygnYWxlcnQtaW1wb3J0YW50Jyk7XG5cbmlmICghaXNDcmVhdGVOZXcpIHtcblx0KGZ1bmN0aW9uICgpIHtcblx0XHR2YXIgd2FpdEZvciA9IDMwMDA7XG5cdFx0dmFyIGludGVydmFsID0gc2V0SW50ZXJ2YWwoZnVuY3Rpb24gKCkge1xuXHRcdFx0dmFyIGFuaW1hdGlvbiA9ICdhbmltYXRlZCBmYWRlT3V0UmlnaHQnO1xuXHRcdFx0aWYgKGlzSW1wb3J0YW50TXNnKSB7XG5cdFx0XHRcdGFuaW1hdGlvbiA9ICcnO1xuXHRcdFx0fVxuXHRcdFx0Zmxhc2hEaXYuYWRkQ2xhc3MoYW5pbWF0aW9uKTtcblxuXHRcdFx0Y2xlYXJJbnRlcnZhbChpbnRlcnZhbCk7XG5cdFx0fSwgd2FpdEZvcik7XG5cdH0pKCk7XG59XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvbG9hZC1mbGFzaC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);