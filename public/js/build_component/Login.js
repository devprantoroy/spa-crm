(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["Login"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/backend/Login/login_body.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/backend/Login/login_body.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      email: null,
      password: null,
      logoSrc: '',
      has_error: false
    };
  },
  methods: {
    login: function login() {
      var _this = this;

      axios.post('auth/login', {
        email: this.email,
        password: this.password
      }).then(function (_ref) {
        var data = _ref.data;

        // this.setWithExpiry("token", data.access_token, this.myTTL) //3600 sec or 1 hour
        _this.setWithExpiry("token", data.access_token, data.expires_in); //3600 sec or 1 hour


        localStorage.setItem("user", JSON.stringify(data.user));
        localStorage.setItem("Permissions", JSON.stringify(data.permissions));
        localStorage.setItem("log_first", 1);
        axios.defaults.headers.common['Authorization'] = "Bearer ".concat(_this.getWithExpiry("token"));

        _this.$router.push({
          name: 'admin_home'
        });

        Fire.$emit('header_nav');
      })["catch"](function () {
        _this.alert_icon = 'error', _this.alert_title = 'Ohh!!', _this.alert_text = 'User name or password missmatch';

        _this.sweet_advance_alert();
      });
    }
  },
  mounted: function mounted() {//
  },
  created: function created() {
    this.logoSrc = '../public/dashboard/logo/cropped-Jacos-main.png';
    Fire.$emit('header_nav');
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/backend/Login/login_body.vue?vue&type=template&id=0adcb424&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/backend/Login/login_body.vue?vue&type=template&id=0adcb424& ***!
  \***************************************************************************************************************************************************************************************************************************/
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
    return _c("div", { staticClass: "login-box" }, [
      _c("div", { staticClass: "card card-outline card-primary" }, [
        _c("div", { staticClass: "card-header text-center" }, [
          _c("a", { staticClass: "h1", attrs: { href: "../../index2.html" } }, [
            _c("b", [_vm._v("Admin")]),
            _vm._v("LTE")
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "card-body" }, [
          _c("p", { staticClass: "login-box-msg" }, [
            _vm._v("Sign in to start your session")
          ]),
          _vm._v(" "),
          _c(
            "form",
            { attrs: { action: "../../index3.html", method: "post" } },
            [
              _c("div", { staticClass: "input-group mb-3" }, [
                _c("input", {
                  staticClass: "form-control",
                  attrs: { type: "email", placeholder: "Email" }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "input-group-append" }, [
                  _c("div", { staticClass: "input-group-text" }, [
                    _c("span", { staticClass: "fas fa-envelope" })
                  ])
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "input-group mb-3" }, [
                _c("input", {
                  staticClass: "form-control",
                  attrs: { type: "password", placeholder: "Password" }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "input-group-append" }, [
                  _c("div", { staticClass: "input-group-text" }, [
                    _c("span", { staticClass: "fas fa-lock" })
                  ])
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-8" }, [
                  _c("div", { staticClass: "icheck-primary" }, [
                    _c("input", {
                      attrs: { type: "checkbox", id: "remember" }
                    }),
                    _vm._v(" "),
                    _c("label", { attrs: { for: "remember" } }, [
                      _vm._v("\n                Remember Me\n              ")
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-4" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary btn-block",
                      attrs: { type: "submit" }
                    },
                    [_vm._v("Sign In")]
                  )
                ])
              ])
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "social-auth-links text-center mt-2 mb-3" },
            [
              _c(
                "a",
                {
                  staticClass: "btn btn-block btn-primary",
                  attrs: { href: "#" }
                },
                [
                  _c("i", { staticClass: "fab fa-facebook mr-2" }),
                  _vm._v(" Sign in using Facebook\n        ")
                ]
              ),
              _vm._v(" "),
              _c(
                "a",
                {
                  staticClass: "btn btn-block btn-danger",
                  attrs: { href: "#" }
                },
                [
                  _c("i", { staticClass: "fab fa-google-plus mr-2" }),
                  _vm._v(" Sign in using Google+\n        ")
                ]
              )
            ]
          ),
          _vm._v(" "),
          _c("p", { staticClass: "mb-1" }, [
            _c("a", { attrs: { href: "forgot-password.html" } }, [
              _vm._v("I forgot my password")
            ])
          ]),
          _vm._v(" "),
          _c("p", { staticClass: "mb-0" }, [
            _c(
              "a",
              { staticClass: "text-center", attrs: { href: "register.html" } },
              [_vm._v("Register a new membership")]
            )
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/backend/Login/login_body.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/backend/Login/login_body.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _login_body_vue_vue_type_template_id_0adcb424___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./login_body.vue?vue&type=template&id=0adcb424& */ "./resources/js/components/backend/Login/login_body.vue?vue&type=template&id=0adcb424&");
/* harmony import */ var _login_body_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./login_body.vue?vue&type=script&lang=js& */ "./resources/js/components/backend/Login/login_body.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _login_body_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _login_body_vue_vue_type_template_id_0adcb424___WEBPACK_IMPORTED_MODULE_0__["render"],
  _login_body_vue_vue_type_template_id_0adcb424___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/backend/Login/login_body.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/backend/Login/login_body.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/backend/Login/login_body.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_login_body_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./login_body.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/backend/Login/login_body.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_login_body_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/backend/Login/login_body.vue?vue&type=template&id=0adcb424&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/backend/Login/login_body.vue?vue&type=template&id=0adcb424& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_login_body_vue_vue_type_template_id_0adcb424___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./login_body.vue?vue&type=template&id=0adcb424& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/backend/Login/login_body.vue?vue&type=template&id=0adcb424&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_login_body_vue_vue_type_template_id_0adcb424___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_login_body_vue_vue_type_template_id_0adcb424___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);