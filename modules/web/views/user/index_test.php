<?php
use app\components\Url;
use kartik\date\DatePicker;
use kartik\grid\GridView;
use unclead\multipleinput\MultipleInput;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AttributeValue;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = Yii::t('web', 'Личный кабинет');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
$lang = Yii::$app->language;
$this->registerCssFile("@web/css/manager.css");
?>
<div class="cabinet">
    <div class="wrapper">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Личный кабинет')?></span> <meta itemprop="position" content="2" /> </li>


        </ol>
        <!--<div class="cabinet__title"><?php/*Yii::t('web', 'Личный кабинет')*/?></div> -->
		<?php if($user->ctype==4 || $user->ctype==8):?>
        <div class="row center-block">
                <?php foreach ($trophyRating as $trophy):?>
                    <div class="col-md-1 col-xs-1 center-block img-block">
                        <?php if($trophy->id==$trophyArr['trophyId']) {
                            echo '<div class="star-rating">';
                            for($i=0;$i<$trophyArr['stars']; $i++){
                                echo '<span class="fa fa-star" style="color:#ff7e19;font-size: 16px;"></span>';
                            }
                            echo '</div>';
                        }?>
                        <img id=<?=$trophy->id?> src="<?=$trophy->image->url?>" alt="Trophy" class="img-trophy-rating" <?php if($trophy->id==$trophyArr['trophyId']) echo 'style="opacity:1;"'?>>
                    </div>
                <?php endforeach;?>
        </div>
        <?php endif;?>
		<?php if( Yii::$app->session->hasFlash('success') ): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php endif;?>
        <div class="tabs cabinet-main">
            <ul class="tabs-control">
                <?php if ($user->ctype!=2 && $user->ctype!=4 && $user->ctype!=8) { ?><li class="tabs-control__item active"><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Заказы')?></a> </li><?php } ?>
                <?php if ($user->ctype==2) { ?><li class="tabs-control__item active"><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Остатки')?></a> </li><?php } ?>
                <?php if ($user->ctype!=2 && $user->ctype!=4 && $user->ctype!=8) { ?><li class="tabs-control__item"><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Архив заказов')?></a> </li><?php } ?>

                <?php if (!empty($manager)): ?>
                    <li class="tabs-control__item"><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Ваш менеджер')?></a> </li>
                <?php endif; ?>
                <li class="tabs-control__item"><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Профиль')?></a> </li>
				<?php if ($user->ctype==4 && $diffDays >= 14): ?>
                    <li class="tabs-control__item"><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Голосование')?></a> </li>
                <?php endif; ?>
				<?php if ($user->ctype==4): ?>
                    <li class="tabs-control__item"><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Сотрудники')?></a> </li>
                <?php endif; ?>
				<?php if ($user->ctype==4 || $user->ctype==8 || $user->ctype == 6): ?>
					<li class="tabs-control__item <?=$activeCategory ? 'active':''?>"><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Остатки')?></a> </li>
                <?php endif; ?>
				 <?php if ($user->ctype==4 || $user->ctype==8): ?>
                    <li class="tabs-control__item"><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Рейтинг')?></a> </li>
                    <li class="tabs-control__item"><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Магазин')?></a> </li>
                <?php endif; ?>
                <li class="tabs-control__item"><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Квесты (в разработке)')?></a> </li>
				<?php if ($user->ctype==2): ?>
                    <li class="tabs-control-image text-right"><img src="<?=$userPartnerImg->logo?>" alt="<?=$userPartnerImg->name?>"></li>
                <?php endif; ?>
            </ul>

            <ul class="tabs-list">

            <?php if ($user->ctype!=2 && $user->ctype!=4 && $user->ctype!=8) { ?>    
                <li class="tabs-list__item active cabinet-main-orders">
                    <?php if(Yii::$app->user->identity->ctype == 6):?>
                    <?php if( Yii::$app->session->hasFlash('success') ): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash('success'); ?>
                        </div>
                    <?php endif;?>
                    <button class="btn btn-success create-order" style="display: block; margin-bottom: 10px;"><?= Yii::t('web', 'Создать заказ')?></button>

                    <div class="order-form">
                        <?php $form = ActiveForm::begin([
                            'enableAjaxValidation'      => false,
                            'enableClientValidation'    => true,
                            'validateOnChange'          => true,
                            'validateOnSubmit'          => true,
                            'validateOnBlur'            => false,
                            'options' => ['enctype' => 'multipart/form-data', 'style'=>'width:60%; ']]); ?>
                        <?= $form->field($orderModel, 'data')->widget(MultipleInput::className(), [
                            'max' => 10,
                            'columns' => [
                                [
                                    'name'  => 'product_id',
                                    'type'  => \kartik\grid\GridView::FILTER_SELECT2,
                                    'options' => [
                                        'data'=> $productsArray,
                                        'options' => [
                                            'class' => 'product-list',
                                            'placeholder' => Yii::t('web','Выберите товар...'),
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],

                                    ],
                                    'title' => 'Товар',
                                    'enableError' => true,

                                ],

                                [
                                    'headerOptions' => ['class' => 'amount','style' => 'width: 100px;' ],
                                    'name'  => 'amount',
                                    'type'  => 'textInput',
                                    'defaultValue' => 1,
                                    'title' => Yii::t('web','Количество'),
                                    'options' => ['type' => 'number', 'min' =>'1', 'step' => '1']
                                ],

                                [
                                    'headerOptions' => ['class' => 'price','style' => 'width: 150px;' ],
                                    'name'  => 'price',
                                    'type'  => 'textInput',
                                    'title' => Yii::t('web','Цена за 1л/кг.'),
                                    'options' => ['class' => 'input-price','type' => 'number', 'min' =>'1.00', 'step' => '0.01','placeholder' => Yii::t('web', 'Цена')]

                                ],
                            ],
                            'allowEmptyList'    => false,
                            'enableGuessTitle'  => false,
                            'min' => 1,

                        ])->label(false);
                        ?>
                        <?= $form->field($orderModel, 'comment')->textarea(array('rows'=>2,'cols'=>5, 'placeholder' => Yii::t('web', 'Комментарий к заказу')))->label(false) ?>
                        <div class="form-group">
                            <?= Html::submitButton( Yii::t('web', 'Оформить'), ['class' => 'btn btn-success']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                <?php endif;?>
                    <div class="cabinet-main-orders-all">
                        <div class="cabinet-main-orders-all__title"><?=Yii::t('web','Все заказы')?></div>
                        <div class="cabinet-main-orders-all-item">
                            <div class="cabinet-main-orders-all-item__quantity"><?=Yii::t('web','Количество заказов')?>: <span><?=$ordersTotalCount?></span></div>
                            <div class="cabinet-main-orders-all-item__price"><?=Yii::t('web','Сумма за все заказы')?>: <span><?=number_format($ordersTotalCost, 2)?> грн.</span></div>
                        </div>

                    </div>
                    <div class="cabinet-main-orders-stat">
                        <div class="cabinet-main-orders-stat__title"><?=Yii::t('web','Статистика заказов')?></div>
                        <?php foreach($orderStats as $orderStatsItem): ?>
                            <div class="cabinet-main-orders-stat-item">
                                <div class="cabinet-main-orders-stat-item__quantity"><?=$orderStatsItem['status']->name?>: <?=$orderStatsItem['amount']?></div>
                                <div class="cabinet-main-orders-stat-item__price"><?=Yii::t('web', 'Сумма')?>: <?=number_format($orderStatsItem['cost'], 2)?> грн</div>
                            </div>
                        <?php endforeach; ?>
                        <?= \app\models\CartItem::existsBonusRequest() ? '<font color="red">'.Yii::t('web', 'Выполняется запрос, списание бонусов приостановлено!').'</font>' : '' ?>

                    </div>
                    <?php


                    $gridColumns = [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                            'contentOptions' => ['class' => 'kartik-sheet-style'],
                            'width' => '10px',
                            'header' => '',
                            'headerOptions' => ['class' => 'kartik-sheet-style']
                        ],

                        [
                            'label' => Yii::t('web', '№ заказа с 1с'),
                            'value'=>function ($model, $key, $index, $widget) {
                                if($model->order->one_c_order_id){
                                    return $model->order->one_c_order_id;
                                }else{
                                    return $model->order->id;
                                }

                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'pageSummary' => 'Итого',
                            'vAlign' => 'middle',
                             'width' => '70px',

                        ],

                        [
                            'label' => 'Дата',
                            'value'=>function ($model, $key, $index, $widget) {

                                    return $model->order->ordered_at;

                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'vAlign' => 'middle',
                            'hAlign' => 'center',
                            'width' => '85px',
                        ],
                        [
                            
                            'label' => Yii::t('web', 'Название товара'),
                            'value'=>function ($model, $key, $index, $widget) {
                                if($model->product->name){
                                    return $model->product->name;
                                }else{
                                    return //Yii::$app->db->createCommand("SELECT name_uk from product where id=".$model->product_id)->queryScalar();
                                        \app\models\Product::find()->orWhere(['status' =>1])->andWhere(['id' => $model->product_id])->one()->name;
                                }

                            },
                            //  'group'=>true,  // enable grouping
                            'vAlign' => 'middle',
                            'width' => '200px',

                        ],

                        [
                            'attribute' => 'amount',
                            'label' => Yii::t('web', 'Кол-во'),
                            'vAlign' => 'middle',
                            'hAlign' => 'right',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            
                            'width' => '80px',
                        ],

                        [
                            'label' => 'Тара',
                            'value'=>function ($model, $key, $index, $widget) {
                                $result = '';
                                foreach ($model->attributeValues as $option){
                                    if($option->option->name){
                                        $result =  $option->option->name;
                                    }
                                }
                                if (!$result){
                                    foreach ($model->product->attributeValues as $option){

                                        $result = $option->option->name;

                                    }
                                }

                                return $result;

                            },
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'vAlign' => 'middle',
                             'width' => '50px',
                        ],

//                            [
//                                'class' => 'kartik\grid\CheckboxColumn',
//                               // 'attribute' => 'status',
//                                'checkboxOptions' => function ($model, $key, $index, $column) {
//                                    return ($model->status == 1)?['checked'=>"checked"]:[];
//                                }
//                            ],

                        [

                            'label' => Yii::t('web', 'Комментарий'),
                            'value'=>function ($model, $key, $index, $widget) {
                                return $model->order->comment;
                            },
							'group' => true,
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                            'vAlign' => 'middle',
                            'width' => '220px',

                        ],

[
                            // 'class' => 'kartik\grid\DataColumn',
                            'label' => Yii::t('web', 'Цена за 1 л/кг'),
                            'value'=>function ($model, $key, $index, $widget) {
                                if($model->price){
                                    return $model->price;
                                }else {
                                    $result = '';
                                    $attr = $model->attributeValues;
                                    if(is_array($attr)){
                                        foreach ($attr as $priceAttr) {
                                            if ($priceAttr->currencyPrice) {
                                                $result = $priceAttr->currencyPrice;
                                            }
                                        }
                                    }

                                    if(!$result) {
                                        $attr = $model->product->attributeValues;
                                        if (is_array($attr)) {
                                            foreach ($attr as $priceAttr) {
                                                $result = $priceAttr->currencyPrice;
                                            }
                                        } else {
                                            $price = \app\models\Product::find()->orWhere(['status' => 1])->andWhere(['id' => $model->product_id])->one()->currencyPriceForAttribute;
                                            if ($price) {
                                                $result = $price;
                                            } else{
                                                $result = 'Нет данных';
                                            }
                                        }
                                    }
                                    return $result;
                                }
                            },
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'format' => ['decimal', 2],
                             'width' => '70px',

                        ],

                        [
                            // 'class' => 'kartik\grid\DataColumn',
                            'label' => Yii::t('web', 'Сумма'),
                            'value'=>function ($model, $key, $index, $widget) {

                                if($model->price){
                                    return $model->price * $model->amount * $model->multiplier;
                                }else {
                                    $result = '';
                                    $attr = $model->attributeValues;
                                    if(is_array($attr)) {
                                        foreach ($attr as $priceAttr) {
                                            if ($priceAttr->currencyPrice) {
                                                $result = $model->amount * $priceAttr->currencyPrice * $model->multiplier;
                                            }
                                        }
                                    }
                                    if(!$result) {
                                        $attr = $model->product->attributeValues;
                                        if (is_array($attr)) {
                                             foreach ($attr as $priceAttr) {
                                                    $result = $priceAttr->product->orderPrice($model->amount);

                                             }
                                        } else {
                                            $price = \app\models\Product::find()->orWhere(['status' => 1])->andWhere(['id' => $model->product_id])->one();
                                            if ($price) {
                                                $result = $price->orderPayPrice($model->amount,$price->currencyPriceForAttribute);
                                            } else{
                                                $result = 'Нет данных';
                                            }
                                        }
                                    }
                                    return $result;
                                }
                            },
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'format' => ['decimal', 2],

                            'width' => '80px',

                        ],

                        [
                            // 'attribute' => 'order_id',
                            'label' => Yii::t('web', 'Форма оплаты'),
                            'value'=>function ($model, $key, $index, $widget) {

                                return $model->order->paymentSystem->name;

                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                            //'pageSummary' => 'Итого',
                            'vAlign' => 'middle',
                            'width' => '100px',

                        ],

                        [
                            // 'class' => 'kartik\grid\DataColumn',
                            // 'attribute' => 'order_id',
                            'label' => 'Оплата',
                            'value'=>function ($model, $key, $index, $widget) {

                                return Yii::t('web', 'Нет');

                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                            //'pageSummary' => 'Итого',
                            'vAlign' => 'middle',
                             'width' => '100px',

                        ],

                        [
                            'label' => 'Статус',
                            'value'=>function ($model, $key, $index, $widget) {
                                return $model->order->status->name_ru;
                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                            //'pageSummary' => 'Итого',
                            'vAlign' => 'middle',
                            'hAlign' => 'center',
                            'width' => '100px',
                        ],
						
						[
                            'header' => '<i class="glyphicon glyphicon-remove-circle"></i>',
                            'format' => 'raw',
                            'value'=>function ($model, $key, $index, $widget) {
                                return Html::a(
                                    '<i class="glyphicon glyphicon-remove-circle"></i>',
                                    '',
                                    [
                                        'title' => Yii::t('web', 'Удалить заказ'),
                                        'data-order' => $model->order->id,
                                        'class' => 'delete-order',
                                    ]
                                );
                            },

                            'group'=>true,
                            'subGroupOf'=>1,
                            'pageSummary' => false,
                            'vAlign' => 'middle',
                            'hAlign' => 'center',
                            'width' => '40px',
                        ],


                    ];

                    echo GridView::widget([
                        //  'id' => 'kv-grid-demo',
                        'dataProvider' => $dataOrder,
                        // 'filterModel' => $searchOrder,
                        'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
                        // 'containerOptions' => ['style' => 'overflow: hidden'], // only set when $responsive = false
						'tableOptions' => [
                            'class' => 'order-table'
                        ],
                        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                        'pjax' => true, // pjax is set to always true for this demo
                        // set your toolbar
                        'toolbar' =>  [
                           ['content' => (Yii::$app->user->identity->ctype == 3 || Yii::$app->user->identity->ctype == 6) ?
                                Html::button('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('web', 'Выгрузить заказ'), ['type' => 'button', 'title' => Yii::t('web', 'Выгрузить заказ'), 'class' => 'btn btn-success export-orders']) : ''
                             //   Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                           ],

                            $fullExportMenu,
                            // '{export}',
                            '{toggleData}',
                        ],
                        // set export properties
                        'export' => [
                            'fontAwesome' => true,
                            'label' => 'Экспорт постранично',
                        ],
                        // parameters from the demo form
                        'bordered' => true,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
						'responsiveWrap' => false,
                        'hover' => true,
                        'showPageSummary' => true,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => $heading,
                        ],

                        'persistResize' => false,
                        'toggleDataOptions' => ['minCount' => 10],
                        'exportConfig' => $exportConfig,

                    ]);
                    ?>
                </li>
			<?php } ?>
               <?php if ($user->ctype==2) { ?>
                <li class="tabs-list__item active cabinet-rests">
                    <div class="cabinet-main-orders-all">
                        <div class="cabinet-main-orders-all__title"><?=Yii::t('web','Все остатки')?></div>
                        <div class="cabinet-main-orders-all-item">
                            <div class="cabinet-main-orders-all-item__quantity"><?=Yii::t('web','Количество остатков')?>: <span></span></div>
                        </div>
						 <?php
                        $gridColumns = [
                            ['class' => 'kartik\grid\SerialColumn'],
							
							[
                                'label' => 'Назва магазину',
                                'value' => function($data){
                                    return $data->stock1c->representative->address_uk;
                                },

                            ],
							
                            [
                                'label' => 'Назва товару',
                                'value' => function($data){
                                    return $data->product->name_uk . ' (' . $data->attributeValue->option->name_uk.')';
                                },
                                'pageSummary' => 'sfsfsfssfs',
                            ],

                            [

                                'label' => 'Кількість',
                                'value' => function($data){
                                    return $data->franch + $data->main;
                                },
                                'format'=>['decimal', 3],
                                'pageSummary' => true,
                             ],

                          // ['class' => 'yii\grid\ActionColumn'],
                        ];
                        $provider = new ActiveDataProvider([
                            'query' => $stockForExcel,
                        ]);
                        //$this->load($params);

//                        echo GridView::widget([
//                            'dataProvider' => $provider,
//                            'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
//                            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//                            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//                            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
//                            'pjax' => true, // pjax is set to always true for this demo
//                            // set your toolbar
//
//                            // set export properties
//                            'export' => [
//                                'fontAwesome' => true
//                            ],
//                            // parameters from the demo form
//
//                            'showPageSummary' => true,
//                            'panel' => [
//                                'type' => GridView::TYPE_PRIMARY,
//                                'heading' => $heading,
//                            ],
//
//                        ]);

                        echo ExportMenu::widget([
                            'showPageSummary' => true,
                            'dataProvider' => $provider,
                            'columns' => $gridColumns,
                            'fontAwesome' => true,
                            'showConfirmAlert'=>false,
                            'filename' => 'Product Stocks',
                            'target'=>ExportMenu::TARGET_BLANK,
                            'dropdownOptions' => [
                                'label' => 'Експорт',
                                'class' => 'btn btn-default',
                            ],
                            'exportConfig' => [
                                ExportMenu::FORMAT_CSV => false,
                            ],

                        ]);
                        ?>
                    </div>
                    <div>
						<?php $products = ArrayHelper::map($products, 'id', 'name_uk'); ?>
						<select class="form-control" style="width:300px" id="stocksselect">
							<option value="0">Всего</option>
							<?php foreach ($stocksi as $s) {?>
                                <?php if(!empty($s->representative->{'city'.$suff})):?>
<!--							<option value="--><?//=$s->id?><!--">--><?//=$s->name?><!--: --><?//=$s->fullname?><!--</option>-->
                                <option value="<?=$s->id?>">
                                    <?php  $suff = ''; if(Yii::$app->language == 'uk') { $suff = '_uk';} ?>

                                        <?=$s->representative->{'city'.$suff} ?>

                                </option>
                                <?php endif;?>
							<?php } ?>
							
						</select>
					</div>
                    <div class="cabinet-main-itemList">
                        <div class="cabinet-main-itemList-header">
                            <div class="cabinet-main-itemList-header__name"><?=Yii::t('web', 'Товары')?></div>
                            <div class="cabinet-main-itemList-qtysell" style="width:22%;"><?=Yii::t('web', 'Отгружено')?></div>
							<div class="cabinet-main-itemList-header__qtyrest" style="width:22%;"><?=Yii::t('web', 'Остатки')?></div>
                        </div>

						<?php foreach ($stock[0] as $s)  { ?>
								<div class="cabinet-main-itemList-item" data-sid="0" style="display:block;">
									<div class="cabinet-main-itemList-item__name" data-rel="<?php echo $s["product_id"]; ?>">
										<?php echo $products[$s["product_id"]].' ('. AttributeValue::findOne([$s["avid"]])->option->{"name_uk"} .')'; ?>
									</div>
									<div class="cabinet-main-itemList-item__qtysell" style="width:22%;">
										
									</div>
									<div class="cabinet-main-itemList-item__qtyrest stockceil" style="width:22%;">
										<?php echo number_format($s["quantity"], 2, ',', ' '); ?>
									</div>
								</div>	
						<?php } ?>	                        
                        <?php foreach ($stocksi as $st)  { ?>
						
							<?php foreach ($stock[$st->id] as $s)  { ?>
								<div class="cabinet-main-itemList-item" data-sid="<?=$st->id?>" <?=($st->id==0)?' style="display:block;"':' style="display:none;"'?>>
									<div class="cabinet-main-itemList-item__name" data-rel="<?php echo $s["product_id"]; ?>">
										<?php echo $products[$s["product_id"]].' ('. AttributeValue::findOne([$s["avid"]])->option->{"name_uk"} .')'; ?>
									</div>
									<div class="cabinet-main-itemList-item__qtysell" style="width:22%;">
										
									</div>
									<div class="cabinet-main-itemList-item__qtyrest stockceil" style="width:22%;">
										<?php echo number_format($s["quantity"], 2, ',', ' '); ?>
									</div>
								</div>					
							<?php } ?>	

						<?php } ?>
						<?php 
						$this->registerJs("
						jQuery('#stocksselect').change(function(){ 
							jQuery('.cabinet-main-itemList-item').css('display','none');
							jQuery('.cabinet-main-itemList-item[data-sid=\"'+jQuery('#stocksselect').val()+'\"]').css('display','block');
						});
						"); ?>
						<?php /*
						$this->registerJs("
						jQuery('#stocksselect').change(function(){
							var sid = jQuery('#stocksselect').val();
							var ceils = jQuery('.stockceil');
							for (var c in ceils) {
								if (ceils.hasOwnProperty(c) &&
									/^0$|^[1-9]\d*$/.test(c) &&
									c <= 4294967294) {
									var ddd = jQuery(ceils[c]).data(sid);
									if (typeof ddd !== \"undefined\") {
										jQuery(ceils[c]).text(ddd);
									}
								}
							}
						});
						"); ?>
                        <?php /* foreach ($orders as $order): ?>
                            <div class="cabinet-main-itemList-item">
                                <div class="cabinet-main-itemList-item__id"><span><?=str_pad($order->id, 8, "0", STR_PAD_LEFT)?> <br> <?=date('d.m.Y', strtotime($order->ordered_at))?></span></div><div
                                    class="cabinet-main-itemList-item__name"><span>
                                        <?php if(!$order->is_one_c_order): ?>
                                            <?php foreach($order->orderProducts as $orderProduct): ?>
                                                <?=$orderProduct->product->name?>
                                                <?php foreach ($orderProduct->attributeValues as $attributeValue): ?>
                                                    <?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
                                                <?php endforeach; ?>
                                                <br>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <?= $order->products_one_c;?>
                                        <?php endif; ?>
                                    </span></div>
                                <div
                                    class="cabinet-main-itemList-item__price"><?=number_format($order->price, 2)?> грн.</div>
                                <div
                                        class="cabinet-main-itemList-item__bonus_minus"><?php /* =(int)$order->bonusMinus * / ?></div>
                                <div
                                        class="cabinet-main-itemList-item__bonus_minus"><?=(int)$order->bonus_got?></div>
                                <div
                                    class="cabinet-main-itemList-item__delivery"><span><?=$order->paymentSystem->name?></span></div>
                                <div
                                    class="cabinet-main-itemList-item__status"><?=$order->status->name?></div>
                            </div>
                        <?php endforeach; */ ?>
                    </div>
                </li>
            <?php } ?>
            
            <?php if ($user->ctype!=2 && $user->ctype!=4 && $user->ctype!=8) { ?>
                <li class="tabs-list__item">
                    <div class="cabinet-main-orders-all">
                        <div class="cabinet-main-orders-all__title"><?=Yii::t('web','Все заказы')?></div>
                        <div class="cabinet-main-orders-all-item">
                            <div class="cabinet-main-orders-all-item__quantity"><?=Yii::t('web','Количество заказов')?>: <span><?=$ordersTotalCount?></span></div>
                            <div class="cabinet-main-orders-all-item__price"><?=Yii::t('web','Сумма за все заказы')?>: <span><?=number_format($ordersTotalCost, 2)?> грн.</span></div>
                        </div>
                    </div>
                    <div class="cabinet-main-orders-stat">
                        <div class="cabinet-main-orders-stat__title"><?=Yii::t('web','Статистика заказов')?></div>
                        <?php foreach($orderStats as $orderStatsItem): ?>
                            <div class="cabinet-main-orders-stat-item">
                                <div class="cabinet-main-orders-stat-item__quantity"><?=$orderStatsItem['status']->name?>: <?=$orderStatsItem['amount']?></div>
                                <div class="cabinet-main-orders-stat-item__price"><?=Yii::t('web', 'Сумма')?>: <?=number_format($orderStatsItem['cost'], 2)?> грн</div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
					Pjax::begin();
                    $gridColumnsArch = [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                            'contentOptions' => ['class' => 'kartik-sheet-style'],
                            'width' => '1%',
                            'header' => '',
                            'headerOptions' => ['class' => 'kartik-sheet-style']
                        ],

                        [
                            'label' => '№ заказа с 1с',
                            'value'=>function ($model, $key, $index, $widget) {
                                if($model->order->one_c_order_id){
                                    return $model->order->one_c_order_id;
                                }else{
                                    return $model->order->id;
                                }

                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'pageSummary' => 'Итого',
                            'vAlign' => 'middle',
                            'width' => '70px',

                        ],

                        [
                            'label' => 'Дата',
                            //'format' => ['date', 'php:d-m-Y H:m:s'],
                            'attribute' => 'date_from',
                            'filter' =>
                                            kartik\date\DatePicker::widget([
                                                'model' => $searchOrderArch,
                                                'attribute' => 'date_from',
                                                'type' => kartik\date\DatePicker::TYPE_INPUT,
                                                'pluginOptions' => [
                                                    'autoclose'=>true,
                                                    'todayHighlight' => true,
                                                    'format' => 'yyyy-mm-dd',
                                                ],
                                                'options' => [
                                                    'placeholder' => 'с',
                                                    'style' => 'width: 50%; display: inline-block;',
                                                ]

                                            ]).
                                            kartik\date\DatePicker::widget([
                                                'model' => $searchOrderArch,
                                                'attribute' => 'date_to',
                                                'type' => kartik\date\DatePicker::TYPE_INPUT,
                                                'pluginOptions' => [
                                                    'autoclose'=>true,
                                                    'todayHighlight' => true,
                                                    'format' => 'yyyy-mm-dd',
                                                ],
                                                'options' => [
                                                    'placeholder' => 'по',
                                                    'style' => 'width: 50%; display: inline-block;',
                                                ]

                                            ]),
                            'value'=>function ($model, $key, $index, $widget) {
                                return $model->order->ordered_at;
                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'vAlign' => 'middle',
                            'hAlign' => 'center',
                            'width' => '150px',
                        ],
                        [
                            
                            'label' => 'Название товара',
                            'value'=>function ($model, $key, $index, $widget) {
                                if($model->product->name){
                                    return $model->product->name;
                                }else{
                                    return \Yii::$app->db->createCommand("SELECT name_uk from product where id=".$model->product_id)->queryScalar();
                                }
                            },
                            //  'group'=>true,  // enable grouping
                            'vAlign' => 'middle',
                            'width' => '200px',

                        ],

                        [
                            //'attribute' => 'amount',
                            'label' => 'Кол-во',
                            'value' => function ($model, $key, $index, $widget) {
                                return $model->amount;
                            },
                            'vAlign' => 'middle',
                            'hAlign' => 'right',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            
                            'width' => '80px',
                        ],

                        [
                            'label' => 'Тара',
                            'value'=>function ($model, $key, $index, $widget) {
                                $result = '';
                                foreach ($model->attributeValues as $option){
                                    if($option->option->name){
                                        $result =  $option->option->name;
                                    }
                                }
                                if (!$result){
                                    foreach ($model->product->attributeValues as $option){

                                        $result = $option->option->name;

                                    }
                                }

                                return $result;

                            },
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'vAlign' => 'middle',
                            'width' => '50px',
                        ],

                        [

                            'label' => 'Комментарий',
                            'value'=>function ($model, $key, $index, $widget) {
                                return $model->order->comment;
                            },
                            'vAlign' => 'middle',
                            'width' => '220px',
                            'group' => true,
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                        ],

                        [
                            // 'class' => 'kartik\grid\DataColumn',
                            'label' => 'Цена за 1 л/кг',
                            'value'=>function ($model, $key, $index, $widget) {
                                if($model->price){
                                    return $model->price;
                                }else {
                                    $result = '';
                                    foreach ($model->attributeValues as $priceAttr) {
                                        if ($priceAttr->currencyPrice) {
                                            $result = $priceAttr->currencyPrice;
                                        }
                                    }
                                    if(!$result) {
                                        $price = \app\models\Product::find()->orWhere(['status' => 1])->andWhere(['id' => $model->product_id])->one()->currencyPriceForAttribute;
                                        if ($price) {
                                            $result = $price;
                                        } else {
                                            if (!$result) {
                                                foreach ($model->product->attributeValues as $priceAttr) {

                                                    $result = $priceAttr->currencyPrice;

                                                }
                                            }else{
                                                $result = 'Нет данных';
                                            }
                                        }
                                    }
                                    return $result;
                                }

                            },
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'format' => ['decimal', 2],
                            'width' => '70px',

                        ],

                        [
                            'label' => 'Сумма',
                            'value'=>function ($model, $key, $index, $widget) {
                                if($model->price){
                                    return $model->price * $model->amount * $model->multiplier;
                                }else {
                                    $result = '';
                                    foreach ($model->attributeValues as $priceAttr) {
                                        if ($priceAttr->currencyPrice) {
                                            $result = $model->amount * $priceAttr->currencyPrice * $model->multiplier;
                                        }
                                    }
                                    if(!$result) {
                                        $price = \app\models\Product::find()->orWhere(['status' => 1])->andWhere(['id' => $model->product_id])->one();
                                        if ($price) {
                                            $result = $price->orderPayPrice($model->amount,$price->currencyPriceForAttribute);
                                        } else {
                                            if (!$result) {
                                                foreach ($model->product->attributeValues as $priceAttr) {

                                                    $result = $priceAttr->product->orderPrice($model->amount);

                                                }
                                            }else{
                                                return ;
                                            }
                                        }
                                    }
                                }
                                return $result;

                            },
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'format' => ['decimal', 2],

                            'width' => '80px',
                        ],


                        [
                            // 'attribute' => 'order_id',
                            'label' => 'Форма оплаты',
                            'value'=>function ($model, $key, $index, $widget) {

                                return $model->order->paymentSystem->name;

                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                            //'pageSummary' => 'Итого',
                            'vAlign' => 'middle',
                            'width' => '100px',

                        ],

                        [
                            // 'class' => 'kartik\grid\DataColumn',
                            // 'attribute' => 'order_id',
                            'label' => 'Оплата',
                            'value'=>function ($model, $key, $index, $widget) {
								if($model->order->paid == 1){
									return 'Оплачено';
								}else if($model->order->paid == 3){
									$result = $model->getSumPay($model->order->id,$model->order->paid);

									return '-' . number_format($result, 2, ',', ' ');
								}else if($model->order->paid == 2){
									return '-'. number_format($model->getSumPay($model->order->id,$model->order->paid) - $model->order->sum_part_pay, 2, ',', ' ');
								}
                                

                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                            //'format' => ['decimal', 2],
                            'pageSummary' => function () {
                                $model = new \app\models\OrderProduct();
                                $total = $model->getTotalSumPay(Yii::$app->user->id);
                                return '-'.number_format($total, 2, ',', ' ');

                            },
                            'vAlign' => 'middle',
                            'width' => '100px',

                        ],
						
						[
                            'label' => 'ТТН',
                            'value'=>function ($model, $key, $index, $widget) {
                                return $model->order->ttn;
                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                            //'pageSummary' => 'Итого',
                            'vAlign' => 'middle',
                             'width' => '100px',
                        ],

                        [
                            'label' => 'Статус',
                            'value'=>function ($model, $key, $index, $widget) {
                                return $model->order->status->name_ru;
                            },
                            'group'=>true,  // enable grouping
							'contentOptions' => ['class' => 'hide-mobile'],
                            'headerOptions' => ['class' => 'hide-mobile'],
                            'subGroupOf'=>1,
                            //'pageSummary' => 'Итого',
                            'vAlign' => 'middle',
                            'hAlign' => 'center',
                            'width' => '100px',
                        ],


                    ];

                    echo GridView::widget([
                        //  'id' => 'kv-grid-demo',
                        'dataProvider' => $dataOrderArch,
						'filterModel' => $searchOrderArch,
                        'columns' => $gridColumnsArch, // check the configuration for grid columns by clicking button above
                        // 'containerOptions' => ['style' => 'overflow: hidden'], // only set when $responsive = false
						'tableOptions' => [
                            'class' => 'arch-order-table'
                        ],
                        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                        'pjax' => true, // pjax is set to always true for this demo
                        // set your toolbar
                        'toolbar' =>  [
                            ['content' =>
                            //    Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
                            ],

                            $fullExportMenu,
                            // '{export}',
                            '{toggleData}',
                        ],
                        // set export properties
                        'export' => [
                            'fontAwesome' => true,
                            'label' => 'Экспорт постранично',
                        ],
                        // parameters from the demo form
                        'bordered' => true,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
						'responsiveWrap' => false,
                        'hover' => true,
                        'showPageSummary' => true,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => $heading,
                        ],

                        'persistResize' => false,
                        'toggleDataOptions' => ['minCount' => 10],
                        'exportConfig' => $exportConfig,

                    ]);
					Pjax::end();
                    ?>
                </li>
            <?php } ?>    
                <?php if (!empty($manager)): ?>
                    <li class="tabs-list__item cabinet-main-manager container">
						<div class="row">
							<div class="col-lg-3">
								<div class="cabinet-main-manager__img">
									<img src="<?=$manager->image->url?>" alt="" onmouseover="this.src= &#39;<?= $manager->imageTwo ? $manager->imageTwo->url : $manager->image->url ?>&#39;" onmouseout="this.src = &#39;<?=$manager->image->url?>&#39;">
								</div>
							</div>
							<div class="col-lg-4">		
								<div class="cabinet-main-manager-text">
									<ul class="persmaninfo">
										<li><label><?=Yii::t('web', 'Имя')?>:</label><?=$manager->name?></li>
										<li><label><?=Yii::t('web', 'Должность')?>:</label><?=$manager->job?></li>
										<li><label><?=Yii::t('web', 'Почта')?>:</label><?=$manager->email?></li>
										<li><label><?=Yii::t('web', 'День рождения')?>:</label><?=$manager->bd?></li>
										<li><label><?=Yii::t('web', 'Карма')?>:</label><?=$manager->carma?></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-6">
							</div>
                        </div>
                        <div class="row">
							<div class="col-lg-3">
							</div>
							<div class="col-lg-8">
								<div class="cabinet-main-manager-text__tel"><?=$manager->phone?></div>
							</div>
							<div class="col-lg-1">
							</div>							
						</div>	
                    </li>
                <?php endif; ?>
                <li class="tabs-list__item cabinet-main-profile text-center">
                    <div class="cabinet-main-profile__title text-center"><?=$client->billingFullName?></div>
                    <ul class="cabinet-main-profile-list"><p class="text-center"><?=Yii::t('web', 'Контактные данные')?></p>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Страна')?>: <span><?=$client->billingCountry?$client->billingCountry->name:''?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Область')?>: <span><?=$client->billing_region?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Город')?>: <span><?=$client->billing_city?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Телефон')?>: <span><?=$client->billing_phone?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','E-mail')?>: <span><?=$user->email?></span></li>
                    </ul>
                    <ul class="cabinet-main-profile-list"><p class="text-center"><?=Yii::t('web','Данные по доставке')?></p>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Страна')?>: <span><?=$client->deliveryCountry?$client->deliveryCountry->name:''?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Область')?>: <span><?=$client->delivery_region?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Город')?>: <span><?=$client->delivery_city?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Почтовый индекс')?>: <span><?=$client->delivery_postcode?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Улица/Номер дома')?>: <span><?=$client->delivery_address?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Телефон')?>: <span><?=$client->delivery_phone?></span></li>
                    </ul>
                    <?php /*
                    <ul class="cabinet-main-profile-list"><?=Yii::t('web','Ваши бонусы')?>

                        <li class="cabinet-main-profile-list__item bonuses-quantity"><?= \app\models\CartItem::getAllBonuses(); ?></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Вы можете частично оплатить заказ бонусами')?></li>
                    </ul>
                    */ ?>
                    <a href="<?=Url::to(['edit'])?>" class="cabinet-main-profile__change"><?=Yii::t('web', 'Изменить мои данные')?></a>
                </li>
				<?php if ($user->ctype==4 && $diffDays >= 14): ?>
                    <li class="tabs-list__item cabinet-main-profile">

                        <?php $form = ActiveForm::begin(['options' => ['class' => 'cabinet-interview']]); ?>
                        <?php foreach ($departments as $department):?>
                            <div class="department">
                                <h2 class="department-name text-left col-md-3"><?= $department->{name_.$lang} ?></h2>
                                <div class="depart-mark">
                                <?php for ($i=1; $i <= 10; $i++):?>
                                    <input type="radio" name="DepartmentRating[<?=$department->id?>]" required value="<?=$i?>" id="d<?=$i.$department->id?>" class="cabinet-interview-radiobuttonList-item__radio"><label for="d<?=$i.$department->id?>" class="cabinet-interview-radiobuttonList-item__label department-label"><?=$i?></label>
                                <?php endfor;?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <input type="submit" class="cabinet-interview__submit" value="<?=Yii::t('web', 'Проголосовать')?>" name="rating">
                        <?php ActiveForm::end()?>

                    </li>
                <?php endif;?>
				
				<?php if ($user->ctype==4): ?>
                    <li class="tabs-list__item cabinet-main-profile">
                        <div class="row" style="width:100%;">
                            <div class="col-md-5">
                                <?php Pjax::begin(['id' => 'manager-add-form'])?>
                                <?php if( Yii::$app->session->hasFlash('warning-manager') ): ?>
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo Yii::$app->session->getFlash('warning-manager'); ?>
                                </div>
                                <?php endif;?>
                                <?php $formManager = ActiveForm::begin(['options' => ['class' => 'cabinet-interview', 'data-pjax' => true]]); ?>
                                <?= $formManager->field($managerForm, 'firstName')->textInput(['placeholder' => Yii::t('web', 'Имя').'*'])->label(false)?>
                                <?= $formManager->field($managerForm, 'lastName')->textInput(['placeholder' => Yii::t('web', 'Фамилия').'*'])->label(false)?>
                                <?= $formManager->field($managerForm, 'pass')->textInput(['placeholder' => Yii::t('web', 'Пароль')])->label(false)?>
                                <?= $formManager->field($managerForm, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->input('tel', [ 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required'=>''])->label(false) ?>
                                <?= $formManager->field($managerForm, 'email')->textInput(['placeholder' => Yii::t('web', 'E-mail')])->label(false)?>
                                <div class="row" style="width:100%">
                                    <?= $formManager->field($managerForm, 'imageUrl', ['options' => ['class' => 'col-md-6']])->textInput(['placeholder' => Yii::t('web', 'Cсылка на фото')])->label(false) ?>

                                    <div class="col-md-1">або</div>

                                    <?= $formManager->field($managerForm, 'imageFile', ['options' => ['class' => 'col-md-5']])->fileInput()->label(Yii::t('web', 'Выберите картинку')) ?>
                                </div>
                                <?= $formManager->field($managerForm, 'bd')->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => Yii::t('web', 'Дата рождения')],
                                    'language' => $lang,
                                    'removeButton' => false,
                                    'pickerButton' => ['icon' => 'calendar'],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                                ])->label(false); ?>
                                <input type="submit" class="cabinet-interview__submit" value="<?=Yii::t('web', 'Добавить')?>" name="add-manager">
                                <?php ActiveForm::end()?>
                                <?php Pjax::end()?>
                            </div>
                            <div class="col-md-7">

                                <?php \yii\widgets\Pjax::begin(['id' => 'managers'])?>
                                <?php if( Yii::$app->session->hasFlash('success-manager') ): ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo Yii::$app->session->getFlash('success-manager'); ?>
                                    </div>
                                <?php endif;?>
                                <?= \yii\grid\GridView::widget([
                                    'dataProvider' => $subordinates,

                                    'columns' => [


                                        ['class' => 'yii\grid\SerialColumn'],
                                        'name',
                                        'phone',
                                        'email',
                                        'job',
                                        'bd',
                                        // 'image.url',

                                        ['class' => 'yii\grid\ActionColumn',
                                        'header' => Yii::t('web','Удалить'),
                                        'headerOptions' => ['class' => 'text-center','style' => ['color:#337ab7']],
                                        'contentOptions' => ['class' => 'text-center','style' => ['color:#337ab7']],
                                        'template' => '{delete}',
                                            'buttons' => [
                                                'delete' => function ($url, $model, $key) {
                                                    return Html::a('<span class="glyphicon glyphicon glyphicon-remove-circle" style="font-size: 15px;"></span>', ['delete-manager','id'=>$model->id], [
                                                        'title' => Yii::t('app', 'Удалить'),
                                                        'data-pjax' => 'pjax-container',//pjax
                                                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                                        'data-method' => 'post',
                                                        'data-ajax' => 'managers'
                                                    ]);
                                                }
                                            ],
                                         ]
                                    ],
                                ]); ?>
                                <?php \yii\widgets\Pjax::end()?>
                            </div>
                        </div>

                    </li>
					<?php endif;?>
					<?php if ($user->ctype==4 || $user->ctype==8 || $user->ctype == 6): ?>
						                    <!-- Таб для остатков магазинов и сотрудников магазинов -->
                    <li class="tabs-list__item cabinet-main-profile text-center <?=$activeCategory ? 'active':''?>" style="padding: 0">
                        <div class="row">
                        <div class="itemsSidebar col-md-3">
                            <?= $this->render('/partial/_categories_with_parent', compact('categories')) ?>
                        </div>
                        <div class="col-md-6">
                            <h1 class="active-category"><?=$activeCategory->name?></h1>
                            <div class="stock-container">
                                <div class="table-stocks">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <?=Yii::t('web','Наименование товара')?>

                                                </th>
                                                <th class="text-center">
                                                    <?=Yii::t('web', 'Остаток')?>

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($stock as $val):?>
                                            <tr>
                                                <td class="text-left"><?=$val['name']?></td>
                                                <td><?=round($val['quantity'])?></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						<div class="itemsSidebar col-md-3">
                            <?php if (count($manufacturers) > 0) : ?>
                                <div class="itemsSidebar-producers dropdown ">
                                    <div class="itemsSidebar-producers__title" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=Yii::t('web', 'Производители')?>
                                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                                    </div>

                                    <ul class="itemsSidebar-producers-list dropdown-menu " style="background: #fff;width: 100%;position: relative;box-shadow: none;border: none;z-index: 2;position: inherit;margin: 20px 0px;" aria-labelledby="dLabel">
                                        <?php foreach ($manufacturers as $manufacturer): ?>
                                            <li class="itemsSidebar-producers-list-item">
                                                <a href="<?= Url::toStock($activeCategory->id, $_manufacturer_ids[$manufacturer['manufacturer']->id], $filter_ids); ?>">
                                                    <label class="itemsSidebar-producers-list-item__label <?=($manufacturer['checked']?' delete':'')?>" >
                                                        <input data-href="<?= Url::toStock($activeCategory->id, $_manufacturer_ids[$manufacturer['manufacturer']->id], $filter_ids); ?>" type="checkbox" <?=($manufacturer['checked']?'checked':'')?> class="manufacturer_select itemsSidebar-producers-list-item__input"><i> </i>
                                                        <?=$manufacturer['manufacturer']->name?>
                                                    </label>
                                                </a>

                                            </li>
                                        <?php endforeach; ?>
                                        <?php $this->registerJs("
                                            $(document).ready(function(){
                                                $('.manufacturer_select').change(function(){
                                                    location = $(this).data('href');
                                                });
                                            });
                                        "); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php if(count($pageFilters) > 0): ?>
                                <?php foreach ($pageFilters as $parentFilterName => $childFilters ) : ?>
                                    <div class="itemsSidebar-producers dropdown "  >



                                        <div class="itemsSidebar-producers__title  " id="dLabel2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$parentFilterName?>

                                            <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                                        </div>

                                        <ul class="itemsSidebar-producers-list dropdown-menu " style=" background: #fff;width: 100%;position: relative;box-shadow: none;border: none;position: inherit;margin: 20px 0px;" aria-labelledby="dLabel2">
                                            <?php foreach ($childFilters as $id => $childFilter): ?>
                                                <?php
                                                if($childFilter['count'] == 0)
                                                    continue;
                                                $filter_id = $id;
                                                $_filter_ids = $filter_ids;
                                                if (is_array($_filter_ids) && in_array($filter_id, $_filter_ids)){
                                                    $_filter_ids = array_filter($_filter_ids, function($i)use($filter_id){return $filter_id != $i;});
                                                } else {
                                                    $_filter_ids[] = $filter_id;
                                                }?>
                                                <li class="itemsSidebar-producers-list-item">
                                                    <a href="<?= Url::toStock($activeCategory->id, $manufacturer_ids, $_filter_ids); ?>">
                                                        <label class="itemsSidebar-producers-list-item__label <?=(in_array($id, $filter_ids)?'delete':'')?>">
                                                            <input data-href="<?= Url::toStock($activeCategory->id, $manufacturer_ids, $_filter_ids); ?>" type="checkbox" <?=
                                                            (in_array($id, $filter_ids)?'checked':'')
                                                            ?> class="filter_select itemsSidebar-producers-list-item__input"><i> </i>
                                                            <?= $childFilter['filter']->name;?>
                                                        </label>
                                                    </a>

                                                </li>
                                            <?php endforeach; ?>
                                            <?php $this->registerJs("
                                                $(document).ready(function(){
                                                    $('.filter_select').change(function(){
                                                        location = $(this).data('href');
                                                    });
                                                });
                                            "); ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </li>
					<?php endif;?>
					<?php if ($user->ctype==4 || $user->ctype==8): ?>
                    <li class="tabs-list__item cabinet-main-profile">
                        <div id="rating" class="tab-pane" style="position: relative;">
                            <ul class="nav navbar-nav col-md-12 col-xs-12 nav-tabs text-center" style="margin: unset;">
                                <li class="active"><a data-toggle="tab" href="#employees">Співробітники</a></li>
                                <li><a data-toggle="tab" href="#market">АГРО-МАРКЕТИ</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="employees" class="tab-pane fade in active">
                                    <div class="row" style="width: 100%;">
                                        <div class="img-finalist col-md-4 col-md-offset-4">
                                            <div class="places" style="top:-10px;"><?=$managerRating[0]['name']?></div>
                                            <div class="places" style="top:5px;"><?=$managerRating[1]['name']?></div>
                                            <div class="places" style="top:10px;"><?=$managerRating[2]['name']?></div>
                                        </div>
                                    </div>
									<div class="top-ten-header">
                                        <h2><?=Yii::t('web','ТОП 10 менеджеры по продажам Агромаркетов')?></h2>
                                    </div>
                                    <div class="progress-rating">
                                        <?php foreach ($managerRating as $manager):?>
                                            <div class="progress-label">
                                                <p><?=$manager['name']?></p>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $manager['summ']/$maxManagerRaiting * 100?>%" aria-valuenow="<?= $manager['summ']/$maxManagerRaiting * 100?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                </div>

                                <div id="market" class="tab-pane fade">
                                    <div class="row" style="width: 100%;">
                                        <div class="img-finalist col-md-4 col-md-offset-4">
                                            <div class="places"><?=$shopRating[0]['fullname']?></div>
                                            <div class="places"><?=$shopRating[1]['fullname']?></div>
                                            <div class="places"><?=$shopRating[2]['fullname']?></div>
                                        </div>
                                    </div>
									<div class="top-ten-header">
                                        <h2><?=Yii::t('web','ТОП 10 Агромаркетов')?></h2>
                                    </div>
                                    <div class="progress-rating">
                                        <?php foreach ($shopRating as $shop):?>
                                            <div class="progress-label">
                                                <p><?=$shop['fullname']?></p>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $shop['summ']/$maxShopRaiting * 100?>%" aria-valuenow="<?= $shop['summ']/$maxShopRaiting * 100?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>
					
					
					
					<li class="tabs-list__item cabinet-main-profile text-center" style="padding: 0">
                        <div id="shop" class="tab-pane">
                            <?php if(is_array($productBonus)):?>
                            <?php foreach ($productBonus as $product):?>
                            <div class="col-sm-6 col-md-3 wrap">
                                <div class="shop-block">
                                    <div class="product-img">
                                        <img src="<?=$product->image->url?>" alt="Футболка" />
                                    </div>
                                    <div class="product-desc text-center">
                                        <p class="product-name"><?=$product->{name.'_'.$lang}?></p>
                                        <div class="bonus">
                                            <img src="/img/manager/mission.png" alt="Балы" class="mission-img" /> <span class="cost"> <?=$product->price?></span>
                                        </div>
                                        <button class="buy" data-id="<?=$product->id?>"><?=Yii::t('web', 'Купить')?></button>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <?php else: ?>
                                <h2><?=Yii::t('web','Каталог товаров пустой')?></h2>
                            <?php endif;?>
                        </div>
                    </li>
                <?php endif;?>
				
                <li class="tabs-list__item cabinet-main-kvest text-center">
                    <h1><?= Yii::t('web', 'В разработке')?></h1>
                </li>
            </ul>
        </div>
        <?php if (!$userReview->validate()): ?>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'cabinet-interview']]); ?>
                <div class="cabinet-interview__title"><?=Yii::t('web', 'Оцените нашу работу')?></div>
                <div class="cabinet-interview__description"><?=Yii::t('web', 'Оставьте отзыв о нашей работе, ваше мнение очень важно!')?></div>
                <div class="cabinet-interview-wrapper">
                    <textarea name="UserReview[comment]" id="" cols="30" rows="10" class="cabinet-interview__textarea form-control" placeholder="<?=Yii::t('web', 'Ваш комментарий')?>"></textarea>
                    <ul class="cabinet-interview-radiobuttonList">
                        <li class="cabinet-interview-radiobuttonList__title"><?=Yii::t('web', 'Доставка')?></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="5" id="d5" class="cabinet-interview-radiobuttonList-item__radio"><label for="d5" class="cabinet-interview-radiobuttonList-item__label">5</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="4" id="d4" class="cabinet-interview-radiobuttonList-item__radio"><label for="d4" class="cabinet-interview-radiobuttonList-item__label">4</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="3" id="d3" class="cabinet-interview-radiobuttonList-item__radio"><label for="d3" class="cabinet-interview-radiobuttonList-item__label">3</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="2" id="d2" class="cabinet-interview-radiobuttonList-item__radio"><label for="d2" class="cabinet-interview-radiobuttonList-item__label">2</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="1" id="d1" class="cabinet-interview-radiobuttonList-item__radio"><label for="d1" class="cabinet-interview-radiobuttonList-item__label">1</label></li>
                    </ul>
                    <ul class="cabinet-interview-radiobuttonList">
                        <li class="cabinet-interview-radiobuttonList__title"><?=Yii::t('web', 'Сервис')?></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="5" id="s5" class="cabinet-interview-radiobuttonList-item__radio"><label for="s5" class="cabinet-interview-radiobuttonList-item__label">5</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="4" id="s4" class="cabinet-interview-radiobuttonList-item__radio"><label for="s4" class="cabinet-interview-radiobuttonList-item__label">4</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="3" id="s3" class="cabinet-interview-radiobuttonList-item__radio"><label for="s3" class="cabinet-interview-radiobuttonList-item__label">3</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="2" id="s2" class="cabinet-interview-radiobuttonList-item__radio"><label for="s2" class="cabinet-interview-radiobuttonList-item__label">2</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="1" id="s1" class="cabinet-interview-radiobuttonList-item__radio"><label for="s1" class="cabinet-interview-radiobuttonList-item__label">1</label></li>
                    </ul>
                    <ul class="cabinet-interview-radiobuttonList">
                        <li class="cabinet-interview-radiobuttonList__title"><?=Yii::t('web', 'Работа')?></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="5" id="w5" class="cabinet-interview-radiobuttonList-item__radio"><label for="w5" class="cabinet-interview-radiobuttonList-item__label">5</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="4" id="w4" class="cabinet-interview-radiobuttonList-item__radio"><label for="w4" class="cabinet-interview-radiobuttonList-item__label">4</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="3" id="w3" class="cabinet-interview-radiobuttonList-item__radio"><label for="w3" class="cabinet-interview-radiobuttonList-item__label">3</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="2" id="w2" class="cabinet-interview-radiobuttonList-item__radio"><label for="w2" class="cabinet-interview-radiobuttonList-item__label">2</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="1" id="w1" class="cabinet-interview-radiobuttonList-item__radio"><label for="w1" class="cabinet-interview-radiobuttonList-item__label">1</label></li>
                    </ul>
                    <ul class="cabinet-interview-radiobuttonList">
                        <li class="cabinet-interview-radiobuttonList__title"><?=Yii::t('web', 'Менеджер')?></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="5" id="w5" class="cabinet-interview-radiobuttonList-item__radio"><label for="w5" class="cabinet-interview-radiobuttonList-item__label">5</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="4" id="w4" class="cabinet-interview-radiobuttonList-item__radio"><label for="w4" class="cabinet-interview-radiobuttonList-item__label">4</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="3" id="w3" class="cabinet-interview-radiobuttonList-item__radio"><label for="w3" class="cabinet-interview-radiobuttonList-item__label">3</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="2" id="w2" class="cabinet-interview-radiobuttonList-item__radio"><label for="w2" class="cabinet-interview-radiobuttonList-item__label">2</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="1" id="w1" class="cabinet-interview-radiobuttonList-item__radio"><label for="w1" class="cabinet-interview-radiobuttonList-item__label">1</label></li>
                    </ul>
                </div>
                <input type="submit" class="cabinet-interview__submit" value="<?=Yii::t('web', 'Отправить')?>">
            <?php ActiveForm::end(); ?>
        <?php else: ?>
            <div class="cabinet-successMessage"><?=Yii::t('web', 'Спасибо за ваш отзыв! Нам важно ваше мнение.')?></div>
        <?php endif; ?>
    </div>
</div>
<div class="popup">
    <h1></h1>
    <span class="close">
    <i class="fa fa-close"></i>
  </span>
</div>

<?php $this->registerCss("

	.itemsSidebar-producers-list.dropdown-menu{
		z-index: 1;
	}

	.tabs-list__item .itemsSidebar {
		padding-left: 0;
		padding-right: 0;
		text-align: left;
		margin-top: 20px;
		width: 25%;
	}
	
	.tabs-list__item .itemsSidebar-products {
		padding-left: 0;
		padding-right: 0;
	}
	
	.glyphicon.glyphicon-menu-down{
		margin-left: 20px;
		color: #12733a;
		padding: 6px;
		cursor: pointer;
		border-radius: 50%;
		border: 1px solid transparent;
		transition: all ease 0.3s;
		float: right;
		margin-top: -10px;
		vertical-align: middle;
	}
	
	.itemsSidebar ul.itemsSidebar-products-list{
		margin-left:0;
	}

	.center-block {
        float: none !important;
        display: inline-block !important;
        text-align: center !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    
    .img-trophy-rating{
        width: 60%;  
        opacity:0.5; 
    }
    
    .img-block{
        position:relative;
    }

	.top-ten-header h2{
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom:10px;
		text-align:left;
    }
    .manager-rewards-wrap{
        border-bottom: 3px solid #4c9769;
        margin-bottom: 5px;
    }

    .reward .reward-desc {
        top:unset;
        margin-top: -40px;
    }

    #shop{
        display: inline-block;
    }
    #rating .progress-label {
        width: 13%;
    }
    
    #rating .tab-content {
    padding-bottom: 0;
	}

    .img-finalist {
        margin-top: 30px;
    }

    .progress-label p{
        margin-bottom: 0;
        margin-top: 5px;
    }

	.department{
        margin-bottom:10px;
    }
    
    .department-name{
        display: inline-block;
        vertical-align: middle;
    }
    
    .depart-mark{
        display: inline-block;
    }
    
    .department-label{
        padding-right:5px;
    }
    .cabinet .tabs-control__item.active{
        background-color: #4c9769;
        border-radius: 10px 10px 0 0;
        border:none;
    }
	
	table.table{
        width:100%;
    }
	
	.cabinet .wrapper{
        width: 100% !important;
        padding: 10px;
    }
    
    .table::before, .table::after{
        all: unset !important;
    }
	
	.panel-primary {
        border-color: #f59f08 !important;
    }
    
    .panel-primary>.panel-heading {
        background-color: #f59f08 !important;
        border-color: #f59f08 !important;
    }
	
	.cabinet-main-orders-all .btn-group li i{
      font-family: 'FontAwesome' !important;  
    }
    
    .cabinet .tabs-control__item.active a{

        color: #fff;
    }
    
    .cabinet .tabs-control__item{
        padding: 10px 15px;
    }
    .cabinet .tabs-control{
        border-bottom: 3px solid #4c9769;
        padding-bottom: 2px;
    }
    
    .cabinet .tabs-list__item.cabinet-main-profile {
        padding-top: 35px;
        margin-top: 0;
        background-color: rgba(255,255,255,0.7);
    }
    .cabinet .tabs-list, .cabinet-interview{
      --  background-color: #fff;
       -- opacity: 0.7;
    } 
    
    
    .cabinet .tabs-list__item.cabinet-main-profile .cabinet-main-profile-list{
        background-color: #f59f08;
        width: 32%;
    }
    
    .cabinet .tabs-list .cabinet-main-profile-list{
        list-style-image: none !important;
        border-radius: 10px;
        border: 1px solid #000;
        height: 220px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .3), -23px 0 20px -23px rgba(0, 0, 0, .8), 23px 0 20px -23px rgba(0, 0, 0, .8), 0 0 40px rgba(0, 0, 0, .1) inset;
    }
    .cabinet .tabs-list__item.cabinet-main-profile .cabinet-main-profile__title{
        margin-bottom: 40px !important;
    }
    .cabinet-main-profile-list p{
        background-color: #fff;
        width: 94%;
        margin: 0 auto 15px;
        font-family: \"OpenSans-Light\", sans-serif;
        font-size: 1em;
        font-weight: bold;
        margin-top: 7px;
        padding: 3px 0;
    }
    .cabinet .cabinet-main-profile-list__item{
        text-align: left;
        margin-left:30px;
        color: #fff !important;
    }
    .cabinet .cabinet-interview{
        background:none;
		overflow-x:hidden;
    }
    .cabinet .cabinet-interview-radiobuttonList__title{
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        padding: 5px;
    }
    
    .cabinet-interview__submit{
        outline: 2px solid rgba(255,255,255,0.8);
        outline-offset: -5px; /* Выводим рамку внутри элемента */
    }
    
    .cabinet .cabinet-interview{
        margin-top:0;
        padding-top: 10px;
        background-color: rgba(255,255,255,0.7);
        
    }
    
    /*.container.page{
        padding-left: 0;
    }*/
    
    .cabinet{
        background: url('../img/cabinet-fon.png') no-repeat 100% 100%;
        background-size: cover;
        margin-top: -20px;
        padding-top: 20px;
    }
    
    .cabinet .tabs-control-image{
        position: absolute;
        right: 0;
        bottom: 0;
    }
    
    .cabinet .tabs-control-image img{
        max-width: 300px;
        max-height: 100px;
    }
    
    .cabinet .tabs-control{
        position: relative;
    }
    
    .cabinet .cabinet-main-profile__change{
        left: 50%;
        width: 200px;
        text-align: center;
        margin-left: -100px;
        bottom: -25px !important;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        padding: 5px;
        border-radius:5px;
    }
    
    .cabinet .cabinet-main-profile__change:hover{ 
        box-shadow: 0 5px 10px rgba(0,0,0,0.5); 
        background-color: #f59f08;
        color: #fff;  
    }
    .cabinet .cabinet-main-profile__change:active{ 
        box-shadow: 0 0 10px rgba(0,0,0,0.5); 
        bottom: -30px !important;
    }
    
    .cabinet-interview__textarea{
        height: 230px !important;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .3), -23px 0 20px -23px rgba(0, 0, 0, .8), 23px 0 20px -23px rgba(0, 0, 0, .8), 0 0 40px rgba(0, 0, 0, .1) inset !important;

    }
	
	.popup{
      display:block;
      width:500px;
      height:200px;
      left:50%;
      top:0;
      margin-left: -250px;
      background:#fff;
      border-radius:5px;
      /*margin:80px auto;*/
      z-index:999;
      overflow:hidden;
      -webkit-transform:translateY(-100%);
      transform:translateY(-100%);
      -moz-box-shadow: 0px 0px 20px rgba(56,56,56,.2);
      -webkit-box-shadow: 0px 0px 20px rgba(56,56,56,.2);
      box-shadow: 0px 0px 20px rgba(56,56,56,.2);
      text-align:center;
      line-height:7em;
      font-size:2em;
      position:absolute;
      -webkit-transition: all 900ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
      transition: all 900ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .popup h1{
      color:#f59f08;
      font-weight:200;
      font-size:0.8em;
      position:relative;
      top: 50%;
      margin-top: -50px;
      left:-100%;
        -webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
      transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
      -webkit-transition-delay:900ms;
      transition-delay:900ms;
    }
    
    .popup .close{
      position:absolute;
      top:15px;
      right:15px;
      font-size:.9em;
      font-weight:lighter;
      cursor:pointer;
      color:#f59f08;
      -webkit-transition:.5s;
      transition:.5s;
      opacity: 0.8;
    }
    
    .overlay{
      overflow-x:hidden;
      overflow-y:hidden;
       -webkit-transition:all 3s ease-in-out;
       transition:all 3s ease-in-out;
    }
    
    .overlay::before{
        content: \" \";
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: 8;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, .5);
       -webkit-transition:3s;
       transition:3s ;
    }
    
    @media screen and (max-width:530px){
        .cabinet .tabs-list__item.cabinet-main-profile .cabinet-main-profile-list{
            width: 80%;
        }
        
        form#w0{
            width:100% !important;
        }
        
        .cabinet .tabs-control-image{   
            bottom: 115%;
            left:0;
           text-align:center !important;
        }
        
        .cabinet .tabs-control-image img{
            max-width: 200px;
			max-height: 80px;
        }
		
		.popup{
            width: 90%;
            margin-left: -45%;
        }
		
		.order-table .hide-mobile,
        .order-table .kv-page-summary-container,
        .arch-order-table .hide-mobile,
        .arch-order-table thead tr:nth-child(2),
        .arch-order-table .kv-page-summary-container{
            display: none;
        }
		
	.img-trophy-rating{
        width: 100%;  
    }
		
    }
");

$this->registerJs("

function showDialog(res){ 
        $('.popup').css({
            'transform':'translateY(80%)',
            'z-index':'999',
            'position': 'fixed'
        });
    
        $('body').addClass('overlay');
        $('.popup h1').html(res);
        $('.popup h1').animate({
            left:'0'
        },0);
    
        $(this).css({
            'z-index':'-1'
        });
        
    $('.popup > .close, .overlay').on('click',function(){
      $('.popup').css({
      'transform':'translateY(-900%)'
     });
     
      $('body').removeClass('overlay');
      $(this).parent().siblings('.btn').css({
        'z-index':'1'
      });
    });
}
 
 $(document).ready(function() {
 
$('.order-form').hide();
$('.create-order').click(function(){
    $(this).toggleClass('opened').next().slideToggle();
    if($(this).hasClass('opened')) {
        $(this).html('". Yii::t('web', 'Отменить оформление')."');
    }
    else {
        $(this).html('". Yii::t('web', 'Создать заказ')."');
    }
});

    $('.export-orders').click(function(e){
        //e.preventDefault();
        $.ajax({
            url: '/web/user/export-orders',
            //enctype: 'multipart/form-data',
            type: 'GET',
            success: function(res){
                if(!res) console.log('Ошибка');
                if(res == 0){
                    showDialog('". Yii::t('web', 'Заказов для выгрузки нет.')."');
                }else{
                    showDialog('". Yii::t('web', 'Ваш заказ успешно выгружен.')." <br />". Yii::t('web', 'Спасибо, что Вы с нами.')."');
                }
            },
            error: function(){
                console.log('ERROR AJAX!!!');
            }
        });
        return false;
    });
	
	$('.buy').click(function(e){
        showDialog(
        '<p style=\"font-weight: bold; font-size: 20px;\">".Yii::t('web', 'Вы подтверждаете покупку: ')."'+$(this).parent().find(\"p\").text()+'</p><button class=\"confirm-buy btn btn-success\" data-id='+$(this).data('id')+'>".Yii::t('web', 'Подтвердить покупку')."</button>');
        return false;
    });
    
    $('body').on('click','.confirm-buy',function(e){
        //e.preventDefault();
        var id = $(this).data('id');
        //confirmMessage
        $.ajax({
            url: '/web/user/add-product-to-order-bonus',
            data: {id:id},
            //enctype: 'multipart/form-data',
            type: 'POST',
            success: function(res){
                if(!res) console.log('Ошибка');
             
                if(!res){
                    showDialog('". Yii::t('web', 'У Вас недостаточно баллов для покупки')."');
                }else{
                    showDialog('". Yii::t('web', 'Вы успешно сделали покупку!')."');
                }
            },
            error: function(){
                console.log('ERROR AJAX!!!');
            }
        });
        return false;
    });
    
    $(document).on('change', '.product-list', function(e){
        e.preventDefault();
        var id = $(this).find('option:selected').val();
        var elementPrice = $(this).closest('.multiple-input-list__item').find('.input-price');
        $.ajax({
            url: '/web/user/get-product-price',
            data: {id: id},
            //enctype: 'multipart/form-data',
            type: 'GET',
            success: function(res){
                if(!res) console.log('Ошибка');
                elementPrice.val(res);
            },
            error: function(){
                console.log('ERROR AJAX!!!');
            }
        });
        return false;
    });
	
	$('.delete-order').click(function(e){
        e.preventDefault();
        var conf = confirm('".Yii::t('web', 'Вы точно хотите удалить заказ?')."')
        if(conf){
        var id = $(this).data('order');
        
        $.ajax({
            url: '/osobistij-kabinet/delete',
            data: {id: id},
            //enctype: 'multipart/form-data',
            type: 'GET',
            success: function(res){
                if(!res) console.log('Ошибка');
                $.pjax.reload('#w2-pjax' , {timeout : false});
            },
            error: function(){
                console.log('ERROR AJAX!!!');
            }
        });
        return false;
        }
    });
	
	function checkDateVote(){
        if(".$diffDays." >= 14){
            setTimeout(function(){showDialog('".Yii::t('web', 'Для оценки ефективности работы отделов, просим Вас пройти голосование.')."')}, 2000);     
        }
    }
	
   if(".$diffDays."){
        checkDateVote();
    }
	
	 $('#manager-add-form').on('pjax:end', function() {
        $.pjax.reload({container:'#managers'});  //Reload GridView
    });
	
});
 
");
 ?>