<?php
/* @var $this yii\web\View */
/* @var $user common\models\User */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['web/user/reset-password', 'token' => $user->password_reset_token]);
?>
Вітаємо Вас, шановний користувач <?=$user->email?> !

Дякуємо за реєстрацію на Гектар. Ваш обліковий запис створено і очікує активації для його використання.
Для активації облікового запису натисніть на наступне посилання або скопіюйте і вставте його в ваш браузер:
<?=$resetLink?>

Після активації ви зможете зайти на <?=Yii::$app->urlManager->createAbsoluteUrl(['web/default/index'])?>, використовуючи ваші логін та пароль, введені під час реєстрації.

Логін: <?=$user->login?>
