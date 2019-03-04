<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="forum_message">
	<?= 'Користувач: '.$model->user->login ?></br>
	<?= 'Дата повідомлення: '.$model->created_at ?></br>
    <?= 'Повідомлення: '.$model->text?>    
</div>