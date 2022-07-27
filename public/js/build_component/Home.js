(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["Home"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/backend/Admin/home_component.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/backend/Admin/home_component.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      home_text: "Welcome",
      activeVal: 'home'
    };
  },
  methods: {},
  mounted: function mounted() {
    if (localStorage.getItem("log_first") == 1) {
      localStorage.removeItem("log_first");
      var loaderrrsss = Vue.$loading.show();
      this.$router.go(0); // loaderrrsss
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/backend/Admin/home_component.vue?vue&type=template&id=35e94a3a&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/backend/Admin/home_component.vue?vue&type=template&id=35e94a3a& ***!
  \*******************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("section", { staticClass: "content mt-5" }, [
      _c("div", { staticClass: "container-fluid" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-lg-3 col-6" }, [
            _c("div", { staticClass: "small-box bg-info" }, [
              _c("div", { staticClass: "inner" }, [
                _c("h3", [_vm._v("150")]),
                _vm._v(" "),
                _c("p", [_vm._v("New Orders")])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "icon" }, [
                _c("i", { staticClass: "ion ion-bag" })
              ]),
              _vm._v(" "),
              _c(
                "a",
                { staticClass: "small-box-footer", attrs: { href: "#" } },
                [
                  _vm._v("More info "),
                  _c("i", { staticClass: "fas fa-arrow-circle-right" })
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3 col-6" }, [
            _c("div", { staticClass: "small-box bg-success" }, [
              _c("div", { staticClass: "inner" }, [
                _c("h3", [
                  _vm._v("53"),
                  _c("sup", { staticStyle: { "font-size": "20px" } }, [
                    _vm._v("%")
                  ])
                ]),
                _vm._v(" "),
                _c("p", [_vm._v("Bounce Rate")])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "icon" }, [
                _c("i", { staticClass: "ion ion-stats-bars" })
              ]),
              _vm._v(" "),
              _c(
                "a",
                { staticClass: "small-box-footer", attrs: { href: "#" } },
                [
                  _vm._v("More info "),
                  _c("i", { staticClass: "fas fa-arrow-circle-right" })
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3 col-6" }, [
            _c("div", { staticClass: "small-box bg-warning" }, [
              _c("div", { staticClass: "inner" }, [
                _c("h3", [_vm._v("44")]),
                _vm._v(" "),
                _c("p", [_vm._v("User Registrations")])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "icon" }, [
                _c("i", { staticClass: "ion ion-person-add" })
              ]),
              _vm._v(" "),
              _c(
                "a",
                { staticClass: "small-box-footer", attrs: { href: "#" } },
                [
                  _vm._v("More info "),
                  _c("i", { staticClass: "fas fa-arrow-circle-right" })
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-lg-3 col-6" }, [
            _c("div", { staticClass: "small-box bg-danger" }, [
              _c("div", { staticClass: "inner" }, [
                _c("h3", [_vm._v("65")]),
                _vm._v(" "),
                _c("p", [_vm._v("Unique Visitors")])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "icon" }, [
                _c("i", { staticClass: "ion ion-pie-graph" })
              ]),
              _vm._v(" "),
              _c(
                "a",
                { staticClass: "small-box-footer", attrs: { href: "#" } },
                [
                  _vm._v("More info "),
                  _c("i", { staticClass: "fas fa-arrow-circle-right" })
                ]
              )
            ])
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/backend/Admin/home_component.vue":
/*!******************************************************************!*\
  !*** ./resources/js/components/backend/Admin/home_component.vue ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _home_component_vue_vue_type_template_id_35e94a3a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./home_component.vue?vue&type=template&id=35e94a3a& */ "./resources/js/components/backend/Admin/home_component.vue?vue&type=template&id=35e94a3a&");
/* harmony import */ var _home_component_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./home_component.vue?vue&type=script&lang=js& */ "./resources/js/components/backend/Admin/home_component.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _home_component_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _home_component_vue_vue_type_template_id_35e94a3a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _home_component_vue_vue_type_template_id_35e94a3a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/backend/Admin/home_component.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/backend/Admin/home_component.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/backend/Admin/home_component.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_home_component_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./home_component.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/backend/Admin/home_component.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_home_component_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/backend/Admin/home_component.vue?vue&type=template&id=35e94a3a&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/backend/Admin/home_component.vue?vue&type=template&id=35e94a3a& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_home_component_vue_vue_type_template_id_35e94a3a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./home_component.vue?vue&type=template&id=35e94a3a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/backend/Admin/home_component.vue?vue&type=template&id=35e94a3a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_home_component_vue_vue_type_template_id_35e94a3a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_home_component_vue_vue_type_template_id_35e94a3a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);