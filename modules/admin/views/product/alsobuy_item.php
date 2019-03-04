<div class="block_alsobuy_main">
	<input type="hidden" name="ProductForm[alsobuyData][]" value = "<?= $model->id ?>">
    <div class="block_alsobuy_name"><?= $model->name_uk ?></div>
    <div class="block_alsobuy_image">
            <img src="<?= $model->getImages()->one()->url ?>" class="alsobuy_image">
    </div>
    <div class="block_alsobuy_button"><input type="button" class="btn btn-small btn-success alsobuy_button" value="Видалити"></div>
</div>
