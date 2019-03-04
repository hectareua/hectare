<?php

use app\models\ClientType;
use app\models\Manufacturer;
use app\models\Product;
use dosamigos\ckeditor\CKEditor;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClientTypeBonus */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $this->registerCss("
    .field-clienttypebonus-ctype_bonus_av_id{
        height:90%;
    }
")?>

<div class="client-type-bonus-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name_bonus_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'name_bonus_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full'
    ]) ?>

    <div class="row" style="background-color: lightgrey;">
        <div class="col-md-12">
            <h2>Для партнерів</h2>
            <?= $form->field($model,'show_condition')->checkbox()?>
            <?= $form->field($model, 'condition_uk')->widget(CKEditor::className(), [
                'options' => ['rows' => 4],
                'preset' => 'full'
            ]) ?>

            <?= $form->field($model, 'condition_ru')->widget(CKEditor::className(), [
                'options' => ['rows' => 4],
                'preset' => 'full'
            ]) ?>
        </div>
    </div>


    <?= $form->field($model, 'client_type_id')->dropDownList(ArrayHelper::map(ClientType::find()->all(), 'id','name_uk'),['prompt' => 'Оберіть группу працівників...'])?>

    <?= $form->field($model, 'currency')->dropDownList($model->getCurrencyDropDownList(),['prompt' => 'Оберіть в чому нараховувати...']) ?>

    <div class="row">
        <div class="col-md-4">
            <input type="radio" name="bonus" class="radio-manufacturer bonus-radio" value="Бонус по виробнику">Бонус по виробнику
        </div>
        <div class="col-md-4">
            <input type="radio" name="bonus" class="one-product bonus-radio" value="Бонус по товару">Бонус по товару
        </div>
        <div class="col-md-4">
            <input type="radio" name="bonus" class="many-product bonus-radio" value="Бонус по декільком товарам">Бонус за декілька товарів
        </div>
    </div>

    <?= $form->field($model, 'manufacturer_id')->dropDownList(
            ArrayHelper::map(Manufacturer::find()->all(), 'id','name'),
            [
                'prompt' => 'Оберіть виробника...',
                'onchange' => '
                    $.post("product-list?id="+$(this).val(),function(data){
                        $("#clienttypebonus-attribute_value_id").html(data);
                    });
                    
                    $.post("product-list-checkbox?id="+$(this).val(),function(data){
                        $("#clienttypebonus-attrs").html(data);
                    });
                ',
                'class' => 'manufacturer form-control'
            ]);

    ?>
    <?php
    $products = Product::find()->select(['a.id', "concat(product.name_uk,' - (',o.name_uk, ')') as names", 'a.price'])->joinWith(['attributeValues a' => function($q) {
        $q->joinWith('option o');
    }])->orderBy('product.id')->asArray()->all();
    if($model->id){
        $products = Product::find()->select(['a.id', "concat(product.name_uk,' - (',o.name_uk, ')') as names", 'a.price'])->joinWith(['attributeValues a' => function($q) {
            $q->joinWith('option o');
        }])->where(['manufacturer_id' => $model->manufacturer_id])->orderBy('product.id')->asArray()->all();
    }
    $productsArray = ArrayHelper::map($products, 'id', 'names');
    ?>


    <div class="row ">
        <div class="col-md-8 one-attribute">
            <?=$form->field($model,'attribute_value_id')->dropDownList(
                    $productsArray,
                    ['prompt' => 'Оберіть товар...',
                    'class' => 'attribute form-control']
                )?>
        </div>
        <div class="col-md-8 many-attributes" style="height: 400px;overflow: scroll;">
            <?=$form->field($model,'attrs')->checkboxList(
                $productsArray,
                ['prompt' => 'Оберіть товар...',
                    'separator' => '<br>',
                    'class' => 'checkbox',
                    'style' => 'height:90%;']
            )?>
        </div>

        <div class="col-md-4">
            <?=$form->field($model, 'unit')->checkbox()?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'qty_sale')->textInput() ?>
        </div>
        <div class="col-md-2 text-center" style="padding-top: 5px;">
            <h3>або</h3>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'money_plan')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <input type="radio" name="bonus-value" class="bonus-value bonus-one">Бонус за штуку
        </div>
        <div class="col-md-3">
            <input type="radio" name="bonus-value" class="bonus-value bonus-all">Бонус за сумарну кулькість
        </div>
        <div class="col-md-3">
            <input type="radio" name="bonus-value" class="bonus-value bonus-stage">Бонус по етапах
        </div>
    </div>
    <br />

    <div class="row bonus-one-input">
        <div class="col-md-5">
            <?= $form->field($model, 'bonus_one')->textInput(['type' => 'number','step' => '0.01']) ?>
        </div>
    </div>
    <div class="row bonus-all-input">
        <div class="col-md-5">
            <?= $form->field($model, 'bonus_all')->textInput(['type' => 'number','step' => '0.01']) ?>
        </div>
    </div>

    <div class="row stage">
        <div class="col-md-5">
            <?= $form->field($model, 'stage')->textInput(['type' => 'number', 'max' => '10']) ?>
        </div>
        <div class="col-md-7">
            <?= $form->field($model, 'percent_stage')->textInput() ?>
        </div>
    </div>


    <?= $form->field($model, 'date_from')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Оберіть дату початку бонусу...'],
        'language' => 'uk',
        'removeButton' => false,
        'pickerButton' => ['icon' => 'calendar'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'date_to')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Оберіть дату закінчення бонусу ...'],
        'language' => 'uk',
        'removeButton' => false,
        'pickerButton' => ['icon' => 'calendar'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div id="attributesForJs" data-id="<?php echo json_encode($arrAttributes)?>"></div>


<?php $this->registerJs("
        function manufacturerShow(){
            $('.many-attributes').hide();
            $('.one-attribute').hide();
            $('.field-clienttypebonus-manufacturer_id').show();
        }
        
        function oneAttributeShow(){
            manufacturerShow();
            $('.many-attributes').hide();
            $('.one-attribute').show();
        }
        
        function manyAttributeShow(){
            manufacturerShow();
            $('.many-attributes').show();
            $('.one-attribute').hide();
        }
        
        function bonusStage(){
            $('.bonus-one-input').hide();
            $('.bonus-all-input').hide();
            $('.stage').show();
        }
        
        function bonusAll(){
             $('.bonus-one-input').hide();
             $('.stage').hide();
             $('.bonus-all-input').show();
        }
        
        function bonusOne(){
            $('.bonus-one-input').show();
            $('.bonus-all-input').hide();
            $('.stage').hide();
        }
        
        $('.field-clienttypebonus-manufacturer_id,.one-attribute, .stage,.bonus-one-input,.bonus-all-input,.many-attributes').hide();
        $('.bonus-radio').on('click', function(){
            if($('.radio-manufacturer').prop('checked')){
                manufacturerShow();
                $('.one-attribute').hide();
            }
            if($('.one-product').prop('checked')){
                oneAttributeShow();
            }
            
            if($('.many-product').prop('checked')){
                manyAttributeShow();
            }
        });
        
        $('.bonus-value').on('click', function(){
             if($('.bonus-one').prop('checked')){
                bonusOne();
             }
             if($('.bonus-all').prop('checked')){
                bonusAll();
            }
            
            if($('.bonus-stage').prop('checked')){
                bonusStage();
            }
            
        });
           
           $(document).ready(function(){
           const attributes = ".json_encode($arrAttributes)."; 
                if($('.one-attribute option:selected').val()){
                    $('.one-product').prop('checked',true);
                    oneAttributeShow();
                }
                
                if($('#clienttypebonus-manufacturer_id option:selected').val() && attributes == ''){
                    $('.radio-manufacturer').prop('checked',true);
                    manufacturerShow();
                }
                
                if($('#clienttypebonus-bonus_one').val()){
                    $('.bonus-one').prop('checked',true);
                    bonusOne();
                }
                
                if($('#clienttypebonus-bonus_all').val()){
                    $('.bonus-all').prop('checked',true);
                    bonusAll();
                }
                
                if($('#clienttypebonus-stage').val()){
                    $('.bonus-stage').prop('checked',true);
                    bonusStage();
                }
               
               
               if(attributes.length){
                    $('.many-product').prop('checked',true);
                    manyAttributeShow();
               }
               
               $('#clienttypebonus-attrs input').each(function(i){
                    const currentVal =  $(this).val();
                    if(attributes.filter(function(val){return currentVal == val}) > 0){
                        $(this).prop('checked', true);
                    }
               });
                          
           });
           
           
        
")?>
