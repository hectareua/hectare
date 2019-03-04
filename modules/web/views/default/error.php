<?php
use app\components\Url;
$this->title = Yii::t('web', 'Ошибка 404'); //xdebug_print_function_stack(); die;
?>
<div class="wrapper">
    <div class="error">
        <h1>Ошибка 404</h1>
        <p>Извините, запрашиваемая вами страница не найдена</p>
    </div>
    <?= $this->render('/partial/_sale', compact('saleProducts')) ?>
    <br><br><br>
</div>