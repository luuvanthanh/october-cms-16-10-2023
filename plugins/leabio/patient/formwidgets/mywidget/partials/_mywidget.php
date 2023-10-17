<select id="<?= $id ?>" name="<?= $name ?>"  class="form-select">
    <?php foreach ($categories as $key => $value) : ?>
        <option  value="<?= e($key) ?>" <?= $selectedValues == $key ? 'selected="selected"' : '' ?>><?= $value ?></option>
    <?php endforeach; ?>
</select>
