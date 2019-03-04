<div class="block_suggested_main">
	<input type="hidden" name="ProductForm[suggestionsData][]" value = "<?= $model->id ?>">
    <div class="block_suggested_name"><?= $model->name_uk ?></div>
    <div class="block_suggested_image">
            <img src="<?= $model->getImages()->one()->url ?>" class="suggested_image">
    </div>
    <div class="block_suggested_button"><input type="button" class="btn btn-small btn-success suggested_button" value="Видалити"></div>
</div>
