<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sector_id')->dropDownList(array('0'=>'Промисловий','1'=>'Приватний')) ?>
	<?= $form->field($model, 'plant_id')->dropDownList($plants) ?>    
	<?= $form->field($model, 'phase_id')->dropDownList($phases) ?>    
	<?= $form->field($model, 'problem_id')->dropDownList($problems) ?>    
    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php /*
<script>
	window.onload = function(){
		if (jQuery('#touse-sector_id').val()==1) 
			{
				jQuery('.field-touse-phase_id').addClass('hidden');
				jQuery('.field-touse-problem_id').addClass('hidden');
			}
		else
			{
				jQuery('.field-touse-phase_id').removeClass('hidden');
				jQuery('.field-touse-problem_id').removeClass('hidden');
			}
				
		jQuery('#touse-sector_id').on('change', function(){
		if (jQuery(this).val()==1) 
			{
				jQuery('.field-touse-phase_id').addClass('hidden');
				jQuery('.field-touse-problem_id').addClass('hidden');
			}
		else
			{
				jQuery('.field-touse-phase_id').removeClass('hidden');
				jQuery('.field-touse-problem_id').removeClass('hidden');
			}
		});
	}
</script> */ ?>
</div>
