<?php
use app\components\Url;
$this->title = Yii::t('web', 'Сотрудничество с нами') . ' | Гектар';
$lang = Yii::$app->language;
?>
    <div class="wrapper">
        <div class="delivery__title"><?=Yii::t('web', 'Сотрудничество с нами')?></div>
        <?=$cooperation->{'text_'.$lang}?>
    </div>
<div class="space"></div>
