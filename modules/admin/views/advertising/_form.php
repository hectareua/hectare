<?php


use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Advertising */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advertising-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <p>Для відкриття посилання в новому вікні, в тег &lt;a&gt; потрібно добавити: target="_blank"</p>
    <?= $form->field($model, 'text_uk')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full',
    ])  ?>

    <?= $form->field($model, 'text_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'full',
    ])  ?>
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
