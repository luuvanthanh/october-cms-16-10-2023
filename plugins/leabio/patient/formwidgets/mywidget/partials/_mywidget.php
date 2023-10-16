<select id="categorySelect" class="form-select">
    <?php foreach ($categories as $key => $value) : ?>
        <option class="sle" value="<?= $key ?>" <?= $selectedValues == $key ? 'selected="selected"' : '' ?>><?= $value ?></option>
    <?php endforeach; ?>
</select>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var categorySelect = $('#categorySelect');

    categorySelect.on('change', function() {
        // Lấy giá trị đã chọn
        var selectedValue = categorySelect.val();
        categorySelect.val(selectedValue);

        console.log(categorySelect.val());
        // // Thay đổi giá trị của option dựa vào lựa chọn
        // if (selectedValue === '1') {
        //     // Nếu lựa chọn là Category 1, thay đổi giá trị của option
        //     $('.sle').val('new_value_for_category_1');
        // } else if (selectedValue === '2') {
        //     // Nếu lựa chọn là Category 2, thay đổi giá trị của option
        //     $('#categorySelect option[value="2"]').val('new_value_for_category_2');
        // }
        // // Thêm logic cho các lựa chọn khác ở đây
    });
</script>