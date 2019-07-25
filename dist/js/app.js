/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/css/app.scss":
/*!**************************!*\
  !*** ./src/css/app.scss ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvY3NzL2FwcC5zY3NzP2ZiMzIiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUEiLCJmaWxlIjoiLi9zcmMvY3NzL2FwcC5zY3NzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/css/app.scss\n");

/***/ }),

/***/ "./src/js/app.js":
/*!***********************!*\
  !*** ./src/js/app.js ***!
  \***********************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// Require Utils\n__webpack_require__(/*! ./utils/navbar */ \"./src/js/utils/navbar.js\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvYXBwLmpzPzkwZTkiXSwibmFtZXMiOlsicmVxdWlyZSJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQUEsbUJBQU8sQ0FBQyxnREFBRCxDQUFQIiwiZmlsZSI6Ii4vc3JjL2pzL2FwcC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIFJlcXVpcmUgVXRpbHNcclxucmVxdWlyZSgnLi91dGlscy9uYXZiYXInKTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/js/app.js\n");

/***/ }),

/***/ "./src/js/utils/navbar.js":
/*!********************************!*\
  !*** ./src/js/utils/navbar.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("$(document).ready(function () {\n  // Check for click events on the navbar burger icon\n  $(\".navbar-burger\").click(function () {\n    // Toggle the \"is-active\" class on both the \"navbar-burger\" and the \"navbar-menu\"\n    $(\".navbar-burger\").toggleClass(\"is-active\");\n    $(\".navbar-menu\").toggleClass(\"is-active\");\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvdXRpbHMvbmF2YmFyLmpzPzY2ZTUiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJjbGljayIsInRvZ2dsZUNsYXNzIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFZO0FBRTFCO0FBQ0FGLEdBQUMsQ0FBQyxnQkFBRCxDQUFELENBQW9CRyxLQUFwQixDQUEwQixZQUFZO0FBRWxDO0FBQ0FILEtBQUMsQ0FBQyxnQkFBRCxDQUFELENBQW9CSSxXQUFwQixDQUFnQyxXQUFoQztBQUNBSixLQUFDLENBQUMsY0FBRCxDQUFELENBQWtCSSxXQUFsQixDQUE4QixXQUE5QjtBQUVILEdBTkQ7QUFPSCxDQVZEIiwiZmlsZSI6Ii4vc3JjL2pzL3V0aWxzL25hdmJhci5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcclxuXHJcbiAgICAvLyBDaGVjayBmb3IgY2xpY2sgZXZlbnRzIG9uIHRoZSBuYXZiYXIgYnVyZ2VyIGljb25cclxuICAgICQoXCIubmF2YmFyLWJ1cmdlclwiKS5jbGljayhmdW5jdGlvbiAoKSB7XHJcblxyXG4gICAgICAgIC8vIFRvZ2dsZSB0aGUgXCJpcy1hY3RpdmVcIiBjbGFzcyBvbiBib3RoIHRoZSBcIm5hdmJhci1idXJnZXJcIiBhbmQgdGhlIFwibmF2YmFyLW1lbnVcIlxyXG4gICAgICAgICQoXCIubmF2YmFyLWJ1cmdlclwiKS50b2dnbGVDbGFzcyhcImlzLWFjdGl2ZVwiKTtcclxuICAgICAgICAkKFwiLm5hdmJhci1tZW51XCIpLnRvZ2dsZUNsYXNzKFwiaXMtYWN0aXZlXCIpO1xyXG5cclxuICAgIH0pO1xyXG59KTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/js/utils/navbar.js\n");

/***/ }),

/***/ 0:
/*!************************************************!*\
  !*** multi ./src/js/app.js ./src/css/app.scss ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\myWork\mix-code\mix-code\src\js\app.js */"./src/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\myWork\mix-code\mix-code\src\css\app.scss */"./src/css/app.scss");


/***/ })

/******/ });