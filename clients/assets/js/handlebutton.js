$(document).ready(function() {
    // Lấy tất cả các trường input bạn muốn theo dõi
    const inputFields = $('.form-control');

    // Lấy trường giới tính radio buttons
    const genderRadios = $('input[name="CusGender"]');

    // Lấy nút "Lưu" và các giá trị ban đầu của các trường
    const saveButton = $('#saveButton');
    const initialFieldValues = inputFields.map(function() {
        return $(this).val();
    }).get();

    // Hàm kiểm tra sự thay đổi
    function checkChanges() {
        const currentFieldValues = inputFields.map(function() {
            return $(this).val();
        }).get();

        const changesDetected = !initialFieldValues.every(function(value, index) {
            return value === currentFieldValues[index];
        }) || genderChanged;

        saveButton.prop('disabled', !changesDetected);
    }

    // Sử dụng sự kiện 'input' để theo dõi việc nhập liệu cho các trường input
    inputFields.on('input', checkChanges);

    // Sử dụng sự kiện 'change' để theo dõi việc chọn giới tính
    genderRadios.on('change', function() {
        if (genderRadios.filter(':checked').val() === '1' || genderRadios.filter(':checked').val() === '0' ) {
            // Nếu giới tính được chọn là 'Nữ' hoặc 'Nam' , bật nút "Lưu"
            saveButton.prop('disabled', false);
        } else {
            // Ngược lại, tắt nút "Lưu"
            saveButton.prop('disabled', true);
        }
    });

    // Kiểm tra ban đầu
    checkChanges();
});