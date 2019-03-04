<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $user common\models\User */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['web/user/reset-password', 'token' => $user->password_reset_token]);
?>
<p>
    Вітаємо Вас, шановний користувач <?=$user->email?> !
</p>
<p>
    Дякуємо за реєстрацію на Гектар. Ваш обліковий запис створено і очікує активації для його використання.
    Для активації облікового запису натисніть на наступне посилання або скопіюйте і вставте його в ваш браузер:
    <?= Html::a(Html::decode($resetLink), $resetLink) ?>
</p>
<p>
    Після активації ви зможете зайти на <?=Yii::$app->urlManager->createAbsoluteUrl(['web/default/index'])?>, використовуючи ваші логін та пароль, введені під час реєстрації.
</p>
<p>
    Логін: <?=$user->login?>
</p>
