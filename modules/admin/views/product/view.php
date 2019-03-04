<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div>
        <h3>Зображення продукту</h3>
        <?php foreach($model->images as $image):?>
            <div class="product_image_view_block"><img src="<?= $image->url?>" class="suggested_image"></div>
        <?php endforeach ?>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'order',
            'category.name_uk',
            'manufacturer.name',
            'name_uk',
            // 'name_ru',
            'description_uk:ntext',
            'description_ru:ntext',
            'seo_title_uk',
            'seo_title_ru',
            'seo_header_uk',
            'seo_header_ru',
            'seo_keywords_uk',
            'seo_keywords_ru',
            'seo_description_uk:ntext',
            'seo_description_ru:ntext',
            'slug',
            // 'currency_id',
            'price',
            'bonus',
            'old_price',
            'currency.name',
            'is_in_stock',
            'is_new',
            'is_over',
            'price_specify',
            'is_suspended',
            'under_the_order',
            'is_on_sale',
            'discount',
            'discount_till',
        ],
    ]) ?>

    <div>
        <h3>Рекомендації до продукту</h3>
        <?php foreach($model->suggestedProducts as $suggestedProduct):?>
            <div class="block_suggested_main" value="<?= $suggestedProduct->id ?>">
                <div class="block_suggested_name"><?= $suggestedProduct->name_uk ?></div>
                <div class="block_suggested_image">
                        <img src="<?= $suggestedProduct->getImages()->one()->url?>" class="suggested_image">
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <div>
        <h3>Також покупають разом з продуктом</h3>
        <?php foreach($model->alsobuyProducts as $alsobuyProduct):?>
            <div class="block_alsobuy_main" value="<?= $alsobuyProduct->id ?>">
                <div class="block_alsobuy_name"><?= $alsobuyProduct->name_uk ?></div>
                <div class="block_alsobuy_image">
                        <img src="<?= $alsobuyProduct->getImages()->one()->url?>" class="alsobuy_image">
                </div>
            </div>
        <?php endforeach ?>
    </div>

</div>
