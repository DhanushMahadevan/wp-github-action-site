"use strict";

var _wp = wp,
    apiFetch = _wp.apiFetch;
jQuery(function ($) {
  var gutenify_baseRedirectToKitPage = function gutenify_baseRedirectToKitPage(res) {
    // if( res?.status && 'active' === res.status ) {
    window.location = "".concat(window.gutenify_base.gutenify_kit_gallery); // }
  }; // Activate Gutenify.


  $(document).on('click', '.gutenify-base-activate-gutenify', function () {
    $(this).html('<span class="dashicons dashicons-update"></span> Loading...').addClass('gutenify-base-importing-gutenify');
    apiFetch({
      path: '/wp/v2/plugins/gutenify/gutenify',
      method: 'POST',
      data: {
        "status": "active"
      }
    }).then(function (res) {
      gutenify_baseRedirectToKitPage(res);
    })["catch"](function () {
      gutenify_baseRedirectToKitPage({});
    });
  });
  $(document).on('click', '.gutenify-base-install-gutenify', function () {
    $(this).html('<span class="dashicons dashicons-update"></span> Loading...').addClass('gutenify-base-importing-gutenify');
    apiFetch({
      path: '/wp/v2/plugins',
      method: 'POST',
      data: {
        "slug": "gutenify",
        "status": "active"
      }
    }).then(function (res) {
      gutenify_baseRedirectToKitPage(res);
    })["catch"](function () {
      gutenify_baseRedirectToKitPage({});
    });
  });
  $(document).on('click', '.gutenify-base-admin-notice .notice-dismiss', function () {
    console.log(ajaxurl + "?action=gutenify_base_hide_theme_info_noticebar");
    apiFetch({
      url: ajaxurl + "?action=gutenify_base_hide_theme_info_noticebar&gutenify_base-nonce-name=".concat(window.gutenify_base.gutenify_base_nonce),
      method: 'POST'
    }).then(function (res) {
      console.log(res);
    })["catch"](function (res) {
      console.log(res);
    });
  });
});