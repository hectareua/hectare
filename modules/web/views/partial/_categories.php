<?php
use app\components\Url;
?>
<div class="itemsSidebar-products">
    <div class="itemsSidebar-products__title"><?=Yii::t('web', 'Каталог товаров')?></div>
    <ul class="itemsSidebar-products-list">
        <?php foreach ($categories as $category): ?>
            <?php if(count($category->categories) > 0 || count($category->products) > 0) : ?>
                <li class="itemsSidebar-products-list__item"><a href="<?=Url::toCategory($category)?>"><?=$category->name?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
