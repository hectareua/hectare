<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php Pjax::begin([ 'timeout' => false, 
'enablePushState' => false,]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            ['attribute'=>'category_id', 'value'=>'category.name_uk'],
            ['attribute'=>'manufacturer_id', 'value'=>'manufacturer.name'],
            'name_uk',
            // 'name_ru',
            // 'description_uk:ntext',
            // 'description_ru:ntext',
            // 'currency_id',
            // 'price',
            // 'old_price',
            // 'is_in_stock',
            // 'is_new',
            // 'is_on_sale',

            ['class' => 'yii\grid\ActionColumn',
            'contentOptions'=>['style'=>'width: 25px;'],
                'template' => '{select}',
                'buttons' => [
                    'select' => function ($url, $model) {

                        $url ='?r=product/select&id='.$model->id;
                        return Html::button(Html::img('@web/images/select.png', ['width'=>'20', 'margin'=>'0', 'pading'=>'0']), 
                            [
                                'title' => Yii::t('app', 'Select'),
                                'onclick' => 'new_suggestion('.$model->id.', "'.Url::to(['product/suggestion_item']).'"); return false;',
                            ]);
                    }
                ],   
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>