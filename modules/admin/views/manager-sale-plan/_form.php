<?php

use app\models\Manager;
use kartik\date\DatePicker;use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManagerSalePlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manager-sale-plan-form">

    <?php $form = ActiveForm::begin();
    $manager = Manager::find()->select(['id', "concat(name, ' ', ifnull(last_name,'')) as full_name"])->asArray()->all();
    ?>

    <?= $form->field($model, 'manager_id')->dropDownList(
            ArrayHelper::map($manager,'id', 'full_name')
    ) ?>

    <?= $form->field($model, 'sum_plan')->textInput(['type' => 'number', 'min' => '1']) ?>

    <?= $form->field($model, 'plan_year')->checkbox(['id' => 'check-year']) ?>

    <?= $form->field($model, 'plan_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Оберіть місяць дії плану ...', 'id' => 'month-plan', 'autocomplete' => 'off'],
        'language' => 'uk',
        'removeButton' => false,

        'pluginOptions' => [
            'autoclose' => true,
            'startView'=>'year',
            'minViewMode'=>'months',
            'format' => 'yyyy-mm-dd'
        ]
    ])->label(false);
    ?>

    <?= $form->field($model, 'plan_date_year')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Оберіть рік дії плану ...', 'id' => 'year-plan', 'autocomplete' => 'off'],
        'language' => 'uk',
        'removeButton' => false,

        'pluginOptions' => [
            'autoclose' => true,
            'startView'=>'year',
            'minViewMode'=>'years',
            'format' => 'yyyy-mm-dd'
        ]
    ])->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php $this->registerJs("
 $(document).ready(function() {    
    $('#check-year').click(function(){
        if($(this).prop('checked')){
            $('#month-plan').parent().parent().toggle();
            $('#year-plan').parent().parent().toggle();
        }else{
            $('#month-plan').parent().parent().toggle();
            $('#year-plan').parent().parent().toggle();
        }
        
    });

    if($('#check-year').prop('checked')){
            $('#month-plan').parent().parent().toggle();
    }else{
            $('#year-plan').parent().parent().toggle();
    }
 });
")?>