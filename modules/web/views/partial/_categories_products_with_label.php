<?php
use app\components\Url;
?>
<div class="itemsSidebar-products">
	<div class="itemsSidebar-products__title"><?=Yii::t('web', 'Каталог товаров')?></div>
	<ul class="itemsSidebar-products-list">
		<?php if(isset($categories) && !empty($categories)):?>
			<?php foreach ($categories as $category):?>
				<li class="itemsSidebar-products-list__item"><a href="<?=Url::toCategory($category['category'])?>"><?=$category['category']->name;?></a></li>
			<?php endforeach;?>
		<?php endif;?>
	</ul>
</div>
