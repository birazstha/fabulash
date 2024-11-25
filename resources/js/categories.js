const oldSubcategory = $("#old_sub_category_id").val();
const oldCategory = $("#old_category_id").val();

let fetchSubCat = (categoryId) => {
    $.ajax({
        url: window.location.origin + "/system/get-sub-category",
        type: "GET",
        data: {
            categoryId: categoryId,
        },
        success: function (response) {
            let data = "<option value=''>--Select Sub Category--</option>";
            $.each(response, function (index, value) {
                if (oldSubcategory && oldSubcategory == value.id) {
                    data += `<option value=${value.id} selected>${value.title}</option>`;
                } else {
                    data += `<option value="${value.id}"> ${value.title}
            </option>`;
                }
            });

            $("#sub_category_id").html(data);
        },
    });
};

$(document).on("change", "#category_id", function () {
    let categoryId = $(this).val();
    fetchSubCat(categoryId);
});



if (oldCategory) {
    $(document).ready(function () {
        fetchSubCat(oldCategory);
    });
}
