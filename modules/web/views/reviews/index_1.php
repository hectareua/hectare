<?php
use app\components\Url;
use yii\widgets\ActiveForm;
//use yii\captcha\Captcha;
$this->title = Yii::t('web', 'Отзывы | Гектар');
if (Yii::$app->language == 'uk') {
    $this->registerMetaTag(['name' => 'description',  'content' => $this->title . ' . Корпорація Гектар: cредства захисту рослин, добрива, насіння, садово-городній інвентар.'], 'description');
} else {
    $this->registerMetaTag(['name' => 'description',  'content' => $this->title . ' . Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь.'], 'description');
}
// [Название страницы]. Корпорация Гектар: cредства защиты растений, удобрения, семена, садово-огородный инвентарь. в  Description

$this->registerCss("


span.like-span i.glyphicon-thumbs-up {
    color: #00733a;
    cursor:pointer
}

span.like-span i.glyphicon-thumbs-down {
    color: #f59f08;
    padding-left: 5px;
    cursor:pointer
}

div.like-value{
    width:15px;
    display:inline;
    font:300 normal 1.125em 'Roboto', Arial, Verdana, sans-serif; color: #34495e;
    text-align:center;
    background-color:transparent !important;
    border: none !important;
}

.reviews-list-item-header__from {cursor:pointer;}
.messagecomment {
    border: 1px solid lightgrey;
    margin: 15px 5px 5px;
    padding: 10px;
}
.message_cancel {
    padding: 10px 25px;
    background: #f59f08;
    color: #fff;
    width: 155px;
	height: 40px;
    text-transform: uppercase;
    cursor: pointer;
}
.message__submit {display:inline-block !important;}
.rewiewlabel {font-family: \"OpenSans-Bold\", sans-serif; font-size: 1rem; color: #66221f;margin-bottom:10px;}
");

$this->registerJs("

base_url_add_like = '".Url::to(['/add-like/'])."';

$(document).ready(function() {
    $('i.glyphicon-thumbs-up, i.glyphicon-thumbs-down').click(function(){
        var self = $(this),
        c = self.data('count');
        type = self.attr('data-type');
        review_id = self.attr('data-id');
        id = this.id;
        if (!c) c = 0;
        $.getJSON(base_url_add_like+'?id='+review_id+'&type='+type, function(results) {
          $('#like'+review_id+'-bs3').html(results.likes);
          $('#dislike'+review_id+'-bs3').html(results.dislikes);
          console.log(results);
         });
    });
});

");


?>


<div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


<!--            <li itemprop="itemListElement" itemscope-->
<!--         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name">--><?//=Yii::t('web', 'Отзывы')?><!--</span> <meta itemprop="position" content="2" /> </li>-->


        </ol>
    <div class="reviews">
        <div class="reviews__title"><?=Yii::t('web', 'Отзывы')?></div>
        <div class="message text-center" id="mainmessage">
            <?php $form = ActiveForm::begin() ?>
                <div class="message__title"><?=Yii::t('web', 'Оставить отзыв')?></div>
                <?=$form->field($model, 'name')->label(false)->error(false)->input('text', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя')]) ?>
                <?=$form->field($model, 'parent_id')->label(false)->error(false)->input('hidden', ['class' => 'message__input', 'required'=>'', 'style'=>'display:none']) ?>
               <!-- <?=$form->field($model, 'email')->label(false)->error(false)->input('email', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Электронная почта')]) ?>-->
                <?=$form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->label(false)->error(false)->input('text', ['class' => 'registration__input', 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
                <?=$form->field($model, 'text')->label(false)->error(false)->textArea(['class' => 'message__textarea', 'required'=>'', 'placeholder' => Yii::t('web', 'Сообщение')]) ?>
                <div id="recaptcha2"></div>
                <input type="submit" class="message__submit" value="<?=Yii::t('web', 'Отправить')?>">
            <?php ActiveForm::end() ?>

        </div>
        <ul class="reviews-list">
            <?php foreach ($reviews as $i=>$review): ?>
                <li class="reviews-list-item" data-uid="<?=$review->user  ?>">
                    <div class="reviews-list-item-header">
                        <!--<div class="reviews-list-item-header__id">#<?=$i+1?><?php var_dump($review);var_dump($review->user); ?></div>-->
                        <div class="reviews-list-item-header__from" data-id="<?=$review->id ?>">
							<?php /* if ((int)($review->user ) < 3) { ?>
								<?=Yii::t('web', 'Администрация Гектар')?>
							<?php } else { */ ?>                        
								<?=$review->name?>
							<?php /* } */ ?> 							
						</div>
                        <span class="like-span">
                            <i id="like<?=$review->id ?>" data-type="1" data-id="<?=$review->id ?>" class="glyphicon glyphicon-thumbs-up"></i>
                            <div class="like-value" id="like<?=$review->id ?>-bs3"><?=count($review->likes) ?></div>
                            <i id="dislike<?=$review->id ?>" data-type="0" data-id="<?=$review->id ?>" class="glyphicon glyphicon-thumbs-down"></i>
                            <div class="like-value" id="dislike<?=$review->id ?>-bs3"><?=count($review->dislikes) ?></div>
                        </span>
                       <!--<div class="reviews-list-item-header__date"><?= $review->posted_at ?></div>-->
                        <div class="reviews-list-item-header-like">
                            <div class="reviews-list-item-header-like-up">
                                <div class="reviews-list-item-header-like-up__img"><i class="glyphicon glyphicon-thumbs-up"></i></div>
                                <a href="#"><div class="reviews-list-item-header-like-up__text">2</div></a>
                            </div>
                            <div class="reviews-list-item-header-like-down">
                                <div class="reviews-list-item-header-like-down__img"><i class="glyphicon glyphicon-thumbs-dpwn"></i></div>
                                <a href="#"><div class="reviews-list-item-header-like-down__text">2</div></a>
                            </div>
                        </div>
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id != $review->user_id): ?>
							<div class="glyphicon glyphicon-comment" title="<?=Yii::t('web', 'Ответить на комментарий')?>" data-id="<?=$review->id ?>"></div>						
                        <?php endif; ?>
                    </div>
                    <div class="reviews-list-item__content">
                        <?=$review->text?>
                    </div>
        <div class="messagecomment hidden"  id="messagecomment<?=$review->id ?>">
            <?php $form = ActiveForm::begin() ?>
                <?=$form->field($model, 'name')->label(false)->error(false)->input('text', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Имя')]) ?>
                <?=$form->field($model, 'parent_id')->label(false)->error(false)->input('hidden', ['class' => 'message__input', 'required'=>'', 'style'=>'display:none']) ?>
               <!-- <?=$form->field($model, 'email')->label(false)->error(false)->input('email', ['class' => 'message__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Электронная почта')]) ?>-->
               <?=$form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+38(999)99-99-999', ])->label(false)->error(false)->input('text', ['class' => 'registration__input', 'pattern'=>'^[ 0-9,\(\)\+\-]+$', 'style'=>'display:none', 'value'=>'+38(111)11-11-111', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
                <?=$form->field($model, 'text')->label(false)->error(false)->textArea(['class' => 'message__textarea', 'required'=>'', 'placeholder' => Yii::t('web', 'Сообщение')]) ?>
                <input type="hidden" name="chk" id="chk" value="chk">
                <div class="text-center btnsblock">
					<input type="submit" class="message__submit" value="<?=Yii::t('web', 'Отправить')?>">
					<input type="button" class="message_cancel" value="<?=Yii::t('web', 'Отменить')?>">
				</div>
            <?php ActiveForm::end() ?>

        </div>	                    
                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id == $review->user_id): ?>
                        <form class="reviews-list-item__content_edit-form" action="<?=Url::to(['edit'])?>" method="POST" style="display:none;">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                            <input type="hidden" name="id" value="<?=$review->id?>">
                            <textarea name="text" class="reviews-list-item__content_edit-form__textarea"><?=$review->text?></textarea>
                            <div class="reviews-list-item__content_edit-form-buttons-group">
                                <input type="submit" class="reviews-list-item__content_edit-form-buttons-group__submit" value="<?=Yii::t('web', 'Сохранить')?>">
                                <input type="button" class="reviews-list-item__content_edit-form-buttons-group__cancel" value="<?=Yii::t('web', 'Отменить')?>">
                            </div>
                        </form>                        
                        <div class="reviews-list-item__edit"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAMAAADzN3VRAAAAQlBMVEX///9JfQTowlpOfQTc9v9OlaDi//9JjaBJjZnc+v/iuVpOjaD/8rh8jaD5znHXrTP//9+pjTprmXmpxsDX5u/5//+3lFikAAAAUUlEQVQokc3OOxKAIBAD0OyigPhBUe9/VXVsk560b5IJ0F18jhxKsMTJg1me6NRL48AKKToHMfWBmOJQFPwVAssq7mITd4HK7wL70c7rZtJnHiSvAdVwRp9nAAAAAElFTkSuQmCC"></div>
                    <?php endif; ?>
                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin): ?>
                        <form action="<?=Url::to(['reply'])?>" class="reviews-list-item__content_reply-form" method="POST" style="display:none;">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                            <input type="hidden" name="id" value="<?=$review->id?>">
                            <textarea name="text" class="reviews-list-item__content_reply-form__textarea"></textarea>
                            <div class="reviews-list-item__content_reply-form-buttons-group">
                                <input type="submit" class="reviews-list-item__content_reply-form-buttons-group__submit" value="<?=Yii::t('web', 'Сохранить')?>">
                                <input type="button" class="reviews-list-item__content_reply-form-buttons-group__cancel" value="<?=Yii::t('web', 'Отменить')?>">
                            </div>
                        </form>
                        <!-- <div class="reviews-list-item__reply"><img src="http://testhectare.prodevs.com.ua/img/re.png" alt=""></div> -->
                    <?php endif; ?>
                    <?php foreach ($review->replies as $reply): ?>
                        <div class="reviews-list-item__content_reply" data-uid="<?=$reply->user_id ?>">
							<?php if ($reply->user_id<3) { ?>
							<div class="rewiewlabel"><?=Yii::t('web', 'Гектар')?></div>
							<?php } ?>
                            <?=$reply->text?>
                        </div>
                    <?php endforeach; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php $this->registerJs("
            $(document).ready(function() {
            
                $('.reviews-list-item-header__from, .glyphicon.glyphicon-comment').on('click', function() {
                    $('#messagecomment'+$(this).attr('data-id')+' #reviewform-parent_id').val($(this).attr('data-id'));
                    $('#messagecomment'+$(this).attr('data-id')).toggleClass('hidden');
                });
                $('.message_cancel').on('click', function() {
					jQuery(this).parent().toggleClass('hidden');
                });
            
                $('.reviews-list-item__reply').on('click', function() {
                    $(this).hide();
                    $(this).siblings('.reviews-list-item__content_reply-form').show();
                });
                $('.reviews-list-item__content_reply-form-buttons-group__cancel').on('click', function() {
                    $(this).parents('.reviews-list-item').find('.reviews-list-item__reply').show();
                    $(this).parents('.reviews-list-item').find('.reviews-list-item__content_reply-form').hide();
                });
                $('.reviews-list-item__content_reply-form').on('submit', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    var form = $(this);
                    var text = form.find('[name=text]').val();
                    $.ajax({
                        url: form.attr('action'),
                        data: form.serialize(),
                        method: form.attr('method'),
                        success: function(){
                            form.hide();
                            form.parents('.reviews-list-item').find('.reviews-list-item__reply').show();
                            var newElem = $('<div>');
                            newElem.addClass('reviews-list-item__content_reply');
                            newElem.html(text);
                            form.parents('.reviews-list-item').append(newElem);
                            form.find('[name=text]').val('');
                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                    return false;
                });
                $('.reviews-list-item__edit').on('click', function() {
                    $(this).hide();
                    $(this).siblings('.reviews-list-item__content').hide();
                    $(this).siblings('.reviews-list-item__content_edit-form').show();
                });
                $('.reviews-list-item__content_edit-form-buttons-group__cancel').on('click', function(){
                    $(this).parents('.reviews-list-item').find('.reviews-list-item__edit').show();
                    $(this).parents('.reviews-list-item').find('.reviews-list-item__content').show();
                    $(this).parents('.reviews-list-item').find('.reviews-list-item__content_edit-form').hide();
                });
                $('.reviews-list-item__content_edit-form').on('submit', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    var form = $(this);
                    var text = form.find('[name=text]').val();
                    $.ajax({
                        url: form.attr('action'),
                        data: form.serialize(),
                        method: form.attr('method'),
                        success: function(){
                            form.hide();
                            form.parents('.reviews-list-item').find('.reviews-list-item__edit').show();
                            form.parents('.reviews-list-item').find('.reviews-list-item__content').show();
                            form.parents('.reviews-list-item').find('.reviews-list-item__content').html(text);
                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                    return false;
                });
            });
        "); ?>

    </div>
    <div class="space"></div>
</div>

