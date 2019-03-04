<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use dosamigos\ckeditor\CKEditor;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Normy;
use app\models\Maincharact;
use yii\helpers\ArrayHelper;
use app\models\Plants;
use app\models\Product;
use app\models\Complects;
use app\models\AttributeValue;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss("

.disabled {
    pointer-events:none;
    opacity:0.4;
    display:none;
}
.norma,.maincharact,.complects  {
    margin-top:50px;
    width: 100%;
}
.normtitle i,.maincharacttitle i,.complectstitle i{
	color: white;
    float: right;
    margin-right: 15px;
    font-size: 1.5em;
}
.normtitle,.maincharacttitle,.complectstitle {
    background: #f59f08;
	width: 100%;
	color:white;
    padding: 10px;
}
.norma table,.maincharact table,.complects table { width: 100%;}
.norma table td,.maincharact table td,.complects table td {width:50%;padding:5px;border:1px solid lightgrey;text-align:center;}
");

$this->registerJs("
measure = \"".(!empty($measure->attr) ? $measure->attr->name_uk : '')."\";
 if (measure != '') {
 $('.attribute').find('optgroup').addClass('disabled');
 $('.attribute').find('optgroup[label=\"'+measure+'\" ]').removeClass('disabled');
 }

 $('#w3.multiple-input').on('afterAddRow', function(e, row) {
    var label = $('#productform-ykazatel').find('option:selected').attr('lab');
    if (label) {
        $(row).find('optgroup').addClass('disabled');
        $(row).find('optgroup[label=\"'+label+'\" ]').removeClass('disabled');
        $(row).find('optgroup[label=\"'+label+'\" ]  option:first-child').attr('selected','selected');
    } else {
        $(row).find('optgroup').removeClass('disabled');
    }

});

$( '#productform-ykazatel' ).change(function() {
    var opt = $(this).find('option:selected').attr('opt-status');
    var val = $(this).val();
    opt = (opt !== '0');
    var label = $('#productform-ykazatel').find('option:selected').attr('lab');
    if (label) {
    $('.attribute').find('optgroup').addClass('disabled');
    $('.attribute').find('optgroup[label=\"'+label+'\" ]').removeClass('disabled');
    $('.attribute').find('option:selected').removeAttr('selected');
    $('.attribute').find('optgroup[label=\"'+label+'\" ]  option:first-child').attr('selected','selected');} else {
       $('.attribute').find('optgroup').removeClass('disabled');
    }

    if (opt) {
        $('#opt').removeClass('disabled');
    } else {
        $('#opt').addClass('disabled');
    }

    val_null = (val === '0');

    if (val_null) {
        $('.price').text('Ціна за од.');
        $('.opt').text('Оптова ціна за од.');
        $('.opt_uk').text('Кільк. од. для опта');
        $('.opt1').text('Оптова ціна 1 за од.');
        $('.opt_uk1').text('Кільк. од. для опта 1');

    } else {
     $('.price').text('Ціна за ' + val);
     $('.opt').text('Оптова ціна за '+ val);
     $('.opt_uk').text('Кільк. '+val+' для опта');
     $('.opt1').text('Оптова ціна 1 за '+ val);
     $('.opt_uk1').text('Кільк. '+val+' для опта 1');
    }

    /*if (val_null) {
    console.log('rem');
        $('.opt').removeClass('disabled');
    } else {
    console.log('add');
        $('.opt').addClass('disabled');
    }*/

});
$('#normnewcreate').on('click',function(){
	$.post( '/admin/norm/create' , {'Normy[product_id]':$(this).data('pid'),'Normy[plant_id]':$('#normplantnew').val(),'Normy[norma]':$('#normnew').val(),'prod':1}, function(d){alert(d);}); 
});
$('#maincharactnewcreate').on('click',function(){
	$.post( '/admin/maincharact/create' , {'Maincharact[product_id]':$(this).data('pid'),'Maincharact[name_ru]':$('#maincharactnameru').val(),'Maincharact[name_uk]':$('#maincharactnameuk').val(),'Maincharact[val]':$('#maincharactnew').val(),'prod':1}, function(d){alert(d);}); 
});
$('.complectsnewcreate').on('click',function(){
	$.post( '/admin/complects-product/create' , {'ComplectsProduct[complectid]':$(this).data('cid'),'ComplectsProduct[productid]':$('.complectsnew'+$(this).data('cid')).val(),'ComplectsProduct[attributeid]':$('.attrsel'+$(this).data('cid')).val(),'ComplectsProduct[discount]':$('.complectsnewval'+$(this).data('cid')).val(),'prod':1}, function(d){alert(d);}); 
});

$(document).on('change','.complectsnew',function(){
		var cid = $(this).data('cid');
		$('.attrsel'+cid+' option').addClass('hidden');
		$('.attrsel'+cid+' option[data-pid=0]').removeClass('hidden');
		$('.attrsel'+cid+' option[data-pid='+$('.complectsnew'+$(this).data('cid')).val()+']').removeClass('hidden');
});
");

?>

<div class="product-form">

    <?php
        Modal::begin([
                'header'=>'<div><h4>Рекомендовані продукти</h4></div>',
                'id'=>'modal',
                'size'=>'modal-lg',
            ]);
    ?>
        <div id='modalContent'>
            <?= $this->context->actionSuggest(); ?>
        </div>
    <?php
        Modal::end();
    ?>

    <?php
        Modal::begin([
                'header'=>'<div><h4>Також покупають</h4></div>',
                'id'=>'modalAlso',
                'size'=>'modal-lg',
            ]);
    ?>
        <div id='modalContentAlso'>
            <?= $this->context->actionAlsobuy(); ?>
        </div>
    <?php
        Modal::end();
    ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'status')->checkbox(['label' => 'Заблокований']) ?>
    
    <?= $form->field($model, 'delivery')->checkbox(['label' => 'Безкоштовна доставка']) ?>
    
    <?= $form->field($model, 'super')->checkbox(['label' => 'Суперціна']) ?>
    
    <?= $form->field($model, 'topsale')->checkbox(['label' => 'Топ продаж']) ?>
    
    <?= $form->field($model, 'category_id')->dropDownList($categories) ?>

    <?= $form->field($model, 'manufacturer_id')->dropDownList($manufacturers) ?>

    <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'filters')->widget(Select2::classname(), [
    'data' => $model->allFilters,
    'language' => 'uk',
    'options' => ['placeholder' => 'Оберіть фільтри ...'],
    'toggleAllSettings' => [
        'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Обрати всі фільтри',
        'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Очистити всі фільтри',
        'selectOptions' => ['class' => 'text-success'],
        'unselectOptions' => ['class' => 'text-danger'],
    ],
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => true
    ],
]); ?>


    <?= $form->field($model, 'description_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'description_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'seo_title_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_header_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_header_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_keywords_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_keywords_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_description_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_description_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_id')->dropDownList($currencies) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true])->label('Head ціна') ?>
    <?= $form->field($model, 'bonus')->textInput(['maxlength' => true]) ?>

    <div class="attribute <?= /*$measuresListOptions[$model->ykazatel]['opt-status']? '':*/'disabled'?>" id="opt">
        <?= $form->field($model, 'opt_uk')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'opt')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'opt_uk1')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'opt1')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'ykazatel')->dropDownList($measuresList, ['options' => $measuresListOptions]); ?>


    <?= $form->field($model, 'dv')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'dv_uk')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'discount_till')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Оберіть день закінчення акції...'],
        'language' => 'ua',
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'is_on_sale')->checkbox() ?>
    <?= $form->field($model, 'imagesData')->widget(MultipleInput::className(), [
        'max'             => 10,
        'columns'           => [
            [
                'name'      =>  'imageUrl',
                'title'     =>  'Url зображеня',
                'type'      =>  'textInput',
            ],
            [
                'name'      =>  'imageFile',
                'title'     =>  'Файл зображеня',
                'type'      =>  'fileInput',
            ],
            [
                'name'      =>  'id',
                'type'      =>  'hiddenInput',
            ],
        ],
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        'min'               => 1,
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
    ])->label(false) ?>

        <div class="attribute" id="<?= $measure->attr ? $measure->attr->alias:'none'  ?>">
            <?= $form->field($model, 'attributeValuesData')->widget(MultipleInput::className(), [
                    'max' => 10,
                    'columns' => [
                        [
                            'name'  => 'id',
                            'type'  => 'hiddenInput',
                        ],
                        [
                            'name'  => 'option_id',
                            'type'  => 'dropDownList',
                            'title' => 'Атрибут',
                            'items' =>  $attributeOptions,
                            'options' => ['id' => 'attributes']
                        ],
                        [
                            'headerOptions' => ['class' => 'price' ],
                            'name'  => 'price',
                            'type'  => 'textInput',
                            'title' => 'Ціна'.($model->ykazatel ? ' за ' . $model->ykazatel: ''),
                            //'options' => ['class' => 'price']
                        ],
                        [
                            'headerOptions' => ['class' => 'opt_uk'],
                            'name'  => 'opt_uk',
                            'type'  => 'textInput',
                            'title' => 'Оптова ціна '.($model->ykazatel ? ' за ' . $model->ykazatel: ''),
                            'options' => ['type' => 'number', 'min' =>'0.00', 'step' => '0.01']
                        ],
                        [
                            'headerOptions' => ['class' => 'opt '],
                            'name'  => 'opt',
                            'type'  => 'textInput',
                            'title' => 'Кільк. '.($model->ykazatel ? $model->ykazatel: '') . ' для опта',
                            'options' => ['type' => 'number']
                        ],
                        [
                            'headerOptions' => ['class' => 'opt_uk1'],
                            'name'  => 'opt_uk1',
                            'type'  => 'textInput',
                            'title' => 'Оптова ціна 1 '.($model->ykazatel ? ' за ' . $model->ykazatel: ''),
                            'options' => ['type' => 'number', 'min' =>'0.00', 'step' => '0.01']
                        ],
                        [
                            'headerOptions' => ['class' => 'opt1'],
                            'name'  => 'opt1',
                            'type'  => 'textInput',
                            'title' => 'Кільк. '.($model->ykazatel ? $model->ykazatel: '') . ' для опта 1',
                            'options' => ['type' => 'number']
                        ]

                    ],
                    'allowEmptyList' => true,
                    'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
                ])->label(false); ?>
        </div>





    <?= $form->field($model, 'fieldValuesData')->widget(MultipleInput::className(), [
        'max' => 10,
        'columns' => [
            [
                'name'  => 'id',
                'type'  => 'hiddenInput',
            ],
            [
                'name'  => 'option_id',
                'type'  => 'dropDownList',
                'title' => 'Поле',
                'items' => $fieldOptions,
            ],
        ],
        'allowEmptyList' => true,
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
    ])->label(false); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'is_in_stock')->checkbox() ?>

            <?= $form->field($model, 'is_new')->checkbox() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'is_over')->checkbox() ?>
            <?= $form->field($model, 'price_specify')->checkbox() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'is_suspended')->checkbox() ?>
            <?= $form->field($model, 'under_the_order')->checkbox() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::Button('Додати рекомендації', ['class' => 'btn btn-primary', 'id'=>'modalButton']) ?>
    </div>
    <div id="suggestion_items">
        <?php if(!$model->isNewRecord):?>
            <?php foreach($model->suggestedProducts as $suggestedProduct): ?>
                <?= $this->render('suggestion_item', ['model'=>$suggestedProduct]); ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
  <?php /* 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
  ActiveForm::end(); */?>

<hr/>

    <div class="form-group">
        <?= Html::Button('Додати також покупають', ['class' => 'btn btn-primary', 'id'=>'modalButtonAlso']) ?>
    </div>
    <div id="alsobuy_items">
        <?php if(!$model->isNewRecord):?>
            <?php foreach($model->alsobuyProducts as $alsobuyProduct): ?>
                <?= $this->render('alsobuy_item', ['model'=>$alsobuyProduct]); ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>

	<div class="normy">
	<?php 
			$plants1 = Plants::find()->all();
			$plants = array();
			foreach($plants1 as $p) {
				$plants[$p['id']] = $p;
			}
	        $norm = Normy::find()->where(['product_id' => $model->id])->all();
               ?> 
			<div class="norma">
				<h3 class="normtitle">Нормы затрат препарата<i class="glyphicon glyphicon-hand-down"></i></h3>
				<table>
					<tr>
						<td>
							Культура
						</td>
						<td>
							Нормы затрат препарата
						</td>
						<td>
							<a href="/admin/norm/create" target="_blank" title="Додати норму" class="btn-default" data-pid="<?=$model->id?>" aria-label="Додати норму" ><i class="glyphicon glyphicon-plus"></i></a>
						</td>
					</tr>
					<tr>
						<td>
							<select id="normplantnew">
								<?php foreach ($plants as $p) { ?>
									<option value="<?=$p->id ?>"><?=$p->name_uk ?></option>
								<?php } ?>
							</select>	
						</td>
						<td>
							<input type="text" id="normnew" value="" />
						</td>
						<td>
							<div id="normnewcreate" target="_blank" title="Додати норму" class="btn-default" data-pid="<?=$model->id?>" aria-label="Додати норму" ><i class="glyphicon glyphicon-plus"></i></div>
						</td>
					</tr>
				<?php /* var_dump($plants); */ foreach($norm as $n) {?> 
					<tr>
						<td data-plid="<?=$n['plant_id']?>">
							<?php echo $plants[$n['plant_id']]->{'name_uk'} ?>
						</td>
						<td>
							<?php echo $n->norma; ?>
						</td>	
						<td>
							<a href="/admin/norm/view?id=<?php echo $n->id; ?>" target="_blank" title="Переглянути" aria-label="Переглянути" ><span class="glyphicon glyphicon-eye-open"></span></a>
							<a href="/admin/norm/update?id=<?php echo $n->id; ?>" target="_blank" title="Оновити" aria-label="Оновити"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="/admin/norm/delete?id=<?php echo $n->id; ?>" target="_blank" title="Видалити" aria-label="Видалити" data-confirm="Ви впевнені, що хочете видалити цей елемент?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>							
						</td>	
					</tr>					
				<?php } ?>	
				</table>
			</div>	
				
	</div>

	<div class="maincharacty">
	<?php 
	        $maincharact = Maincharact::find()->where(['product_id' => $model->id])->all();
               ?> 
			<div class="maincharact">
				<h3 class="maincharacttitle">Основні характеристики (для насіння!)<i class="glyphicon glyphicon-hand-down"></i></h3>
				<table>
					<tr>
						<td>
							Назва
						</td>
						<td>
							Название
						</td>
						<td>
							Значення
						</td>
						<td>
							<a href="/admin/maincharact/create" target="_blank" title="Додати характеристику" class="btn-default" data-pid="<?=$model->id?>" aria-label="Додати характеристику" ><i class="glyphicon glyphicon-plus"></i></a>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" id="maincharactnameuk" value="" />
						</td>
						<td>
							<input type="text" id="maincharactnameru" value="" />
						</td>
						<td>
							<input type="text" id="maincharactnew" value="" />
						</td>
						<td>
							<div id="maincharactnewcreate" target="_blank" title="Додати характеристику" class="btn-default" data-pid="<?=$model->id?>" aria-label="Додати характеристику" ><i class="glyphicon glyphicon-plus"></i></div>
						</td>
					</tr>
				<?php foreach($maincharact as $n) {?> 
					<tr>
						<td>
							<?php echo $n->name_uk; ?>
						</td>
						<td>
							<?php echo $n->name_ru; ?>
						</td>
						<td>
							<?php echo $n->val; ?>
						</td>	
						<td>
							<a href="/admin/maincharact/view?id=<?php echo $n->id; ?>" target="_blank" title="Переглянути" aria-label="Переглянути" ><span class="glyphicon glyphicon-eye-open"></span></a>
							<a href="/admin/maincharact/update?id=<?php echo $n->id; ?>" target="_blank" title="Оновити" aria-label="Оновити"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="/admin/maincharact/delete?id=<?php echo $n->id; ?>" target="_blank" title="Видалити" aria-label="Видалити" data-confirm="Ви впевнені, що хочете видалити цей елемент?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>							
						</td>	
					</tr>					
				<?php } ?>	
				</table>
			</div>	
				
	</div>

	<?php 
		$products = Product::find()->all();
		$productsa = ArrayHelper::map($products, 'id', 'name_uk');
		
		$attrsel = AttributeValue::find()->all();
	 ?>
	

	<div class="complectsy">
			<div class="complects">
				<h3 class="complectstitle">Комплекты&nbsp;<a href="/admin/complects/create" target="_blank" title="Додати комплект" class="btn-default" data-pid="<?=$model->id?>" aria-label="Додати комплект" ><i class="glyphicon glyphicon-plus"></i></a><i class="glyphicon glyphicon-hand-down"></i></h3>
				<?php if ($complects) { ?>
				<?php foreach ($complects as $c) { ?>
					<table>
						<tr>
							<td>
								Комплект #<?=$c['id'] ?> Товар
							</td>
							<td>
								Цена
							</td>
							<td>
								<a href="/admin/complects/create" target="_blank" title="Додати комплект" class="btn-default" data-pid="<?=$model->id?>" aria-label="Додати комплект" ><i class="glyphicon glyphicon-plus"></i></a>
							</td>
						</tr>
						<tr>
							<td>
								    <?= Select2::widget([
										'model' => $model,
										'attribute' => 'id',
										'options' => ['placeholder' => 'Выбрать товар ...' , 'data-cid'=>$c['id'],'id' => 'complectsnew'.$c['id'],'class' => 'complectsnew complectsnew'.$c['id']],
										'data' => $productsa
									  ]); ?>
									  
						<?php /*		<select id="complectsnew">
									<?php foreach ($products as $p) { ?>
										<option value="<?=$p->id ?>"><?=$p->name_uk ?></option>
									<?php } ?>
								</select>	 */ ?>
								<select class="attrsel<?=$c['id']?>">
									<option value="0" data-pid="0" >0</option>
									<?php foreach ($attrsel as $p) { ?>
										<option value="<?=$p->id ?>" data-pid="<?=$p['product_id']?>" ><?=$p->option->name_uk ?></option>
									<?php } ?>
								</select>	 
							</td>
							<td>
								<input type="text" id="complectsnewval" class="complectsnewval<?=$c['id']?>" value="" />
							</td>
							<td>
								<div id="complectsnewcreate" target="_blank" title="Додати товар" data-cid="<?=$c['id']?>" class="btn-default complectsnewcreate complectsnewcreate<?=$c['id']?>" data-pid="<?=$model->id?>" aria-label="Додати товар" ><i class="glyphicon glyphicon-plus"></i></div>
							</td>
						</tr>
					<?php if($c['products']) {?> 
						<?php foreach($c['products'] as $n) {?> 
							<tr>
								<td data-plid="<?=$n['product']['id']?>">
									<?php echo $n['product']->{'name_uk'} ?>
								</td>
								<td>
									<?php echo $n['discount']; ?>
								</td>	
								<td>
									<a href="/admin/complects-product/view?id=<?php echo $n['id']; ?>" target="_blank" title="Переглянути" aria-label="Переглянути" ><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="/admin/complects-product/update?id=<?php echo $n['id']; ?>" target="_blank" title="Оновити" aria-label="Оновити"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="/admin/complects-product/delete?id=<?php echo $n['id']; ?>" target="_blank" title="Видалити" aria-label="Видалити" data-confirm="Ви впевнені, що хочете видалити цей елемент?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>							
								</td>	
							</tr>					
						<?php } ?>	
					<?php } ?>	
					</table>
				<?php } ?>
				<?php } ?>
			</div>	
				
	</div>

	
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
