<?php
use app\components\Url;
//print_r($categories);
?>


<?php foreach ($categories as $categoryParent): ?>
    <?php if(!isset($categoryParent->parent_id)):?>
        <div class="itemsSidebar-products">
            <div class="itemsSidebar-products__title"><?=$categoryParent->name?></div>
            <ul class="itemsSidebar-products-list">
            <?php foreach ($categories as $category): ?>
                <?php if((count($category->categories) > 0 || count($category->products) > 0) && $categoryParent->id==$category->parent_id) : ?>
                    <li class="itemsSidebar-products-list__item"><a href="<?=Url::toStock($category->id)?>" data-category-id="<?=$category->id?>"><?=$category->name?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif;?>
<?php endforeach;?>

