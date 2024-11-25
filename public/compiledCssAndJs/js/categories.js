/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/categories.js ***!
  \************************************/
var oldSubcategory = $("#old_sub_category_id").val();
var oldCategory = $("#old_category_id").val();
var fetchSubCat = function fetchSubCat(categoryId) {
  $.ajax({
    url: window.location.origin + "/system/get-sub-category",
    type: "GET",
    data: {
      categoryId: categoryId
    },
    success: function success(response) {
      var data = "<option value=''>-- Select Sub Category --</option>";
      $.each(response, function (index, value) {
        if (oldSubcategory && oldSubcategory == value.id) {
          data += "<option value=".concat(value.id, " selected>").concat(value.title, "</option>");
        } else {
          data += "<option value=\"".concat(value.id, "\"> ").concat(value.title, "\n            </option>");
        }
      });
      $("#sub_category_id").html(data);
    }
  });
};
$(document).on("change", "#category_id", function () {
  var categoryId = $(this).val();
  fetchSubCat(categoryId);
});
if (oldCategory) {
  $(document).ready(function () {
    fetchSubCat(oldCategory);
  });
}
/******/ })()
;