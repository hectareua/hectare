<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Complects;
use app\models\AttributeValue;
use app\models\Product;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">
	 <?php 
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk'); 
        $complect = ArrayHelper::map(Complects::find()->all(), 'id', 'name'); 
    //    $attributeValue = ArrayHelper::map(AttributeValue::find()->all(), 'id', 'id');
  //      $attributeValue = ArrayHelper::map(AttributeValue::find()->all(), 'id', 'id');
        $av = AttributeValue::find()->all();
    //    $options = ArrayHelper::map(AttributeValue::find()->leftJoin('attribute_option ao', 'ao.id = option_id')->all(), 'id', 'option_id');
        
        $param = [];  
        if ( Yii::$app->request->get('complectid')) {$param = ['options' =>[ Yii::$app->request->get('complectid') => ['Selected' => true]]];}
         ?>
    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'complectid')->dropDownList($complect,$param) ?>   
    <?= $form->field($model, 'productid')->dropDownList($product) ?>
<?php /*= $form->field($model, 'attributeid')->dropDownList($options) ?>
    <? $form->field($model, 'attributeid')->textInput(['maxlength' => true])  */ ?>
    <div class="form-group field-complectsproduct-attributeid">
		<label class="control-label" for="complectsproduct-attributeid">Attribute Id (<?php echo $attributeid; ?>)<?php /* var_dump($attributeValue); */ ?></label>
		<select class="form-control" name="ComplectsProduct[attributeid]" id="attributeid">
			<option value="0">---</option>			
		<?php foreach ($av as $a) { ?>
			<option value="<?=$a->id?>" <?php if (isset($attributeid) && ($attributeid==$a->id)) {echo '"selected=\"selected\""';} ?> class="hidden" data-pid="<?=$a->{'product_id'}?>"><?=$a->option->{'name_uk'}?></option>
		<?php } ?>
		</select>
	</div>
    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'is_slider')->checkbox(['label' => 'Слайдер']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("
    $(document).ready(function(){
        $('#complectsproduct-productid').on('change', function(){
            $('select#attributeid option').addClass('hidden');
            $('select#attributeid option[data-pid='+$('#complectsproduct-productid').val()+']').removeClass('hidden');
            $('select#attributeid option[value=0]').removeClass('hidden');
            $('select#attributeid').val(0);
        });	
	});	
");
