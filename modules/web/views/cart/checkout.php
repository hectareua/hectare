<?php
/**
 * @var \yii\web\View $this
 * @var app\models\Order $model
 * @var integer $totalPrice
 * @var boolean $enableInStock
 */

use yii\bootstrap\Modal;
use yii\helpers\Url;
use \app\models\Order;
use yii\widgets\ActiveForm;

$model->delivery_type = Order::DELIVERY_TYPE_TO_HOME;

$this->title = Yii::t('web', 'Оформление заказа');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
$this->registerJsFile('@web/js/jquery.maskedinput.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@web/js/bootstrap.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/bootstrap.min.css');
$this->registerCss("
a.orderForm-main__submit:hover {
color:#fff;
cursor:pointer;
}

.bank_image {
    height: 40px;
    width: 40px;
    border-radius: 5px;
    background-size: cover;
    background-position: 50%;
    top: 0;
    left: 0;
    margin-right: 5px;
    float:left;
}

table.table.table-bordered.table-credits td {
    border-left: 0;
    border-right: 0;
}
table.table.table-bordered.table-credits th {
    border-left: 0;
    border-right: 0;
}


.table-credits > thead > tr > th{
  border-bottom-width: 1px;
  text-align: center;
}
.table-credits > tbody > tr > td{
  vertical-align: middle;
  text-align: center;
}
.table-credits > thead > tr > th > i.fa{
  margin: 0 5px 0 0;
}
.table-credits > tbody > tr > td.credit-name{
  text-align: left;
    min-width: 185px;
}

.table-credits {
border:none;
border-collapse: collapse;
margin:0 auto;
}

.table-credits td {
border-left: 1px solid #000;
border-right: 1px solid #000;
}

.table-credits td:first-child {
border-left: none;
}

.table-responsive{
    overflow-y: hidden;
    overflow-x: hidden;
}

.table-credits td:last-child {
border-right: none;
}
#recaptcha5{
    float:left;
}


@media only screen and (min-width: 40em) {
  .modal-overlay {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 5;
    background-color: rgba(0, 0, 0, 0.6);
    opacity: 0;
    visibility: hidden;
    -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
    -webkit-transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), visibility 0.6s cubic-bezier(0.55, 0, 0.1, 1);
    transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), visibility 0.6s cubic-bezier(0.55, 0, 0.1, 1);
     z-index:999;
  }
  .modal-overlay.active {
    opacity: 1;
    visibility: visible;
  }
}
/**
 * Modal
 */
.modal-shops {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
       --align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  position: relative;
  margin: 0 auto;
  background-color: #fff;
  max-width: 70%;
  width: 70%;
  min-height: 40rem;
  padding: 1rem;
  border-radius: 3px;
  opacity: 0;
  overflow-y: auto;
  visibility: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transform: scale(1.2);
          transform: scale(1.2);
  -webkit-transition: all 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: all 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  z-index:1000;

}
.modal-shops .close-modal {
  position: absolute;
  cursor: pointer;
  top: 5px;
  right: 15px;
  opacity: 0;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), -webkit-transform 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), -webkit-transform 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), transform 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1), transform 0.6s cubic-bezier(0.55, 0, 0.1, 1), -webkit-transform 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  -webkit-transition-delay: 0.3s;
          transition-delay: 0.3s;
}
.modal-shops .close-modal svg {
  width: 1.75em;
  height: 1.75em;
}

.modal-shops p {
    position:absolute;
    top:10px;
    left:20px;
    font-size: 20px;
    font-weight: bold;
}

.modal-shops .submit-shop:hover {
    background-color: #00733a !important;
}

.modal-shops .modal-content {
  opacity: 0;
  max-height: 80%;
  width: 100%;
  text-align: center;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  transition: opacity 0.6s cubic-bezier(0.55, 0, 0.1, 1);
  -webkit-transition-delay: 0.3s;
          transition-delay: 0.3s;
            margin-top: 40px;
}
.modal-shops.active {
  visibility: visible;
  opacity: 1;
  -webkit-transform: scale(1);
          transform: scale(1);
}
.modal-shops.active .modal-content {
  opacity: 1;
}
.modal-shops.active .close-modal {
  -webkit-transform: translateY(10px);
          transform: translateY(10px);
  opacity: 1;
}

/**
 * Mobile styling
 */
@media only screen and (max-width: 39.9375em) {
  h1 {
    font-size: 1.5rem;
  }

  .modal-shops {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    -webkit-overflow-scrolling: touch;
    border-radius: 0;
    -webkit-transform: scale(1.1);
            transform: scale(1.1);
    padding: 0 !important;
    max-width: 100%;
  }

  .close-modal {
    right: 20px !important;
  }
}


");
$this->registerJs('

$("#order-delivery_phone").mask("+38(999) 999-9999");

$("#orderForm").on("submit",function( e ) {

if($(".makeOrder").attr("data-id")) {

   e.preventDefault();
};

});

$(".makeOrder").on("click", function() {

   var id = $(this).attr("data-id");
   $("#paymentMethod").val(id);
    console.log($("#orderForm"));
    var fullname = $.trim($("#order-delivery_fullname").val());
    var phone = $.trim($("#order-delivery_phone").val());
    var city = $.trim($("#order-delivery_city").val()); 
    var paySubm = $(this).parent().parent().find(".payments");
    if ((fullname != "" )&&(phone != "")&&(city != "")) {
        form = $("#orderForm");
        if(form.find(".has-error").length) {
            return false;
        }

        $.ajax({
            
            url: form.attr("action"),
            type: "post",
            data: form.serialize(),
            success: function(data) {
                console.log(data);

                //$("#pay_parts_form").submit();
                if ((fullname != "" )&&(phone != "")&&(city != "")) {
                    document.getElementById("payments"+id).submit();
                  //paySubm.submit();
                }
            },
            error:function (error){
            alert(form.attr("action"));
            }
        });

   }
   //return false;
});

//$("form#payments").attr("action", $("form#payments").attr("action") +"/"+ "pay-parts");

/*$("input[name=\"Order[payment_system_id]\"]").change(function() {
    if(this.checked) {
     var action = $("form#payments").attr("action");
     $("form#payments").attr("action", action +"/"+ $(this).attr("data-method"));
        console.log($(this).attr("data-method"));
    }
});*/

$("#payments").submit(function( event ) {
console.log("hello_3");
event.preventDefault();
});


');

$this->registerJsFile('/web/js/calculate-delivery.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="order" ng-app>
    <div class="wrapper">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
                itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
                itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Оформление заказа')?></span> <meta itemprop="position" content="1" /> </li>


        </ol>
        <div class="order__title"><?=Yii::t('web', 'Оформление заказа')?></div>
        <?php if (Yii::$app->user->isGuest): ?>
            <?php $form = ActiveForm::begin(['action' => ['user/login', 'returnUrl' => Url::current()], 'options' => ['class' => 'order-login']]) ?>
            <div class="order-login__text"><?=Yii::t('web', 'Вход')?></div>
            <?=$form->field($loginForm, 'username')->label(false)->error(false)->input('text', ['class' => 'order-login__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Логин')])?>
            <?=$form->field($loginForm, 'password')->label(false)->error(false)->input('password', ['class' => 'order-login__input', 'required'=>'', 'placeholder' => Yii::t('web', 'Пароль')])?>
            <input type="submit" class="order-login__submit" value="<?=Yii::t('web', 'Отправить')?>">
            <?php ActiveForm::end() ?>
        <?php endif; ?>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'orderForm', 'id' => 'orderForm']]); ?>
        <div class="orderForm-sidebar">
            <div class="orderForm-sidebar__title"><?=Yii::t('web', 'Данные по доставке')?></div>
            <div class="orderForm-sidebar__error">
                <?php if ($errors = $model->getErrors()): ?>
                    <?php foreach ($errors as $error): ?>
                        <?=$error[0]?><br>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if ($errors = $userForm->getErrors()): ?>
                    <?php foreach ($errors as $error): ?>
                        <?=$error[0]?><br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?=$form->field($model, 'delivery_fullname')->label(false)->error(false)->input('text', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'ФИО').'*', 'required' => ''])?>
            <?=$form->field($model, 'delivery_phone')->label(false)->error(false)->input('tel', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Телефон').'*', 'required' => ''])?>
            <?=$form->field($model, 'delivery_city')->label(false)->error(false)->input('text', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Город').'*', 'required' => ''])?>
            <?=$form->field($model, 'delivery_address')->label(false)->error(false)->input('text', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Адрес')])?>
            <?php if (Yii::$app->user->isGuest): ?>
                <div class="orderForm-sidebar-item">
                    <input ng-init="show_registration = !!<?=(int)$register?>" ng-model="show_registration" value="1" name="register" type="checkbox" class="orderForm-sidebar__checkbox" id="orderForm-sidebar__checkbox"><label for="orderForm-sidebar__checkbox" class="orderForm-sidebar__label">Зарегистрироваться</label>
                </div>
                <div class="orderForm-sidebar__additional" ng-if="show_registration">
                    <?=$form->field($userForm, 'login')->label(false)->error(false)->input('text', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Логин').'*', 'required' => ''])?>
                    <?=$form->field($userForm, 'passwordValue')->label(false)->error(false)->input('password', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Пароль').'*', 'required' => ''])?>
                    <?=$form->field($userForm, 'passwordConfirmation')->label(false)->error(false)->input('password', ['class' => 'orderForm-sidebar__input', 'placeholder' => Yii::t('web', 'Подтвердить пароль').'*', 'required' => ''])?>
                </div>
            <?php endif; ?>

            <?php if ($purchaseType == 0): ?>
                <div class="orderForm-sidebar__title"><?=Yii::t('web', 'Способ оплаты')?></div>
            <?php endif; ?>

            <ul class="orderForm-sidebar-radiobuttonList">
                <?php foreach ($paymentSystems as $paymentSystem): ?>
                    <?php if (($paymentSystem->type == 1 )&&(($purchaseType == 0) || ($purchaseType == 2))): ?>
                        <ul class="orderForm-sidebar-radiobuttonList">
                            <li class="orderForm-sidebar-radiobuttonList-item">
                                <input required type="radio" name="Order[payment_system_id]" id="payment_method_<?=$paymentSystem->id?>" value="<?=$paymentSystem->id?>" <?=($paymentSystem->id==$model->payment_system_id)?'checked':''?> class="orderForm-sidebar-radiobuttonList-item__radio">
                                <label for="payment_method_<?=$paymentSystem->id?>" class="orderForm-sidebar-radiobuttonList-item__label"><?=$paymentSystem->name?></label>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php if (($paymentSystem->type == 0 )&&($purchaseType == 1)&&($paymentSystem->id == 4)): ?>
                        <input type="hidden" name="Order[payment_system_id]" id="paymentMethod" value="">
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div><div
            class="orderForm-main">
            <div class="orderForm-main__title"><?=Yii::t('web', 'Информация о заказе')?></div>
            <div class="orderForm-main-itemList">
                <div class="orderForm-main-itemList-header">
                    <div class="orderForm-main-itemList-header__photo"><?=Yii::t('web', 'фото')?></div><div
                        class="orderForm-main-itemList-header__name"><?=Yii::t('web', 'наименование')?></div><div
                        class="orderForm-main-itemList-header__quantity"><?=Yii::t('web', 'количество')?></div><div
                        class="orderForm-main-itemList-header__price"><?=Yii::t('web', 'сумма')?></div>
                </div>
                <?php foreach ($cart as $cartItem): ?>
                    <div class="orderForm-main-itemList-item">
                        <div class="orderForm-main-itemList-item__photo" style="background-image: url(<?=$cartItem->product->image->url?>)"></div><div
                            class="orderForm-main-itemList-item__name">
                            <!-- Арт: <?=$cartItem->product_id?> <br> -->
                            <?=$cartItem->product->name?>
                            <?php foreach ($cartItem->attributeValues as $attributeValue): ?>
                                <br><?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
                            <?php endforeach; ?>
                        </div><div
                            class="orderForm-main-itemList-item__quantity"><?=$cartItem->amount?></div><div
                            class="orderForm-main-itemList-item__price"><?=number_format($cartItem->totalPrice, 2)?> грн.</div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="orderForm-main__totalPrice"><?=Yii::t('web', 'К оплате')?> <span id="total-order-price"><?=number_format($totalPrice, 2)?></span> грн</div>
            <?php if ($totalPrice > 0): ?>
                <div class="orderForm-main_delivery">
                    <p class="header-type_of_delivery">СПОСІБ ДОСТАВКИ</p>

                    <?= $form->field($model, 'delivery_type')->radioList(Order::$deliveryTypes, [
                        'item' => function($index, $label, $name, $checked, $value) use ($enableInStock) {
                            $enable = true;
                            if (!$enableInStock && in_array($value, [Order::DELIVERY_TYPE_TO_HOME, Order::DELIVERY_TYPE_MOMENT_TO_HOME])){
                                $enable = false;
                            }
                            $img = '';
                            $class = '';
                            if ($value == Order::DELIVERY_TYPE_TO_HOME){
                                $class = 'home';
                                $img = '<img class="img-home" src="/img/question.png" height="15" width="15" title="Термін доставки: наступного дня або замовте миттєву доставку та отримайте товар через 3 години">';
                            } elseif ($value == Order::DELIVERY_TYPE_MOMENT_TO_HOME){
                                $class = 'moment-home';
                                $img = '<img class="img-moment" src="/img/question.png" height="15" width="15" title="Термін доставки: 3 години">';
                            }
                            $return = '<div class="delivery-radio-container"><label>';
                            $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" ' . ($enable ? '' : 'disabled') . ' class="orderForm-sidebar-radiobuttonList-item__radio">';
                            $return .= $label;
                            $return .= $img;
                            $return .= '</label><div class="delivery_type-price ' . $class . '"></div><div class="delivery_type-message"></div></div>';

                            return $return;
                        }
                    ])->label(false) ?>
                    <?= \yii\helpers\Html::hiddenInput('totalPrice', null, ['id' => 'total-price']) ?>
                </div>
            <?php endif; ?>
            <div class="orderForm-main__title"><?=Yii::t('web', 'Комментарии')?></div>
            <?=$form->field($model, 'comment')->label(false)->error(false)->textArea(['class' => 'orderForm-main__textarea'])?>
            <div id="recaptcha5"></div>
            <?php if ($purchaseType == 0): ?>
                <input type="submit" class="orderForm-main__submit" value="<?=Yii::t('web', 'Оформить заказ')?>" onclick="yaCounter44862661.reachGoal('oformit_pokupku'); return true;">
            <?php endif; ?>
            <?php if ($purchaseType == 1): ?>
                <a  style="text-align:center; padding-top:20px; text-decoration:none;" class="orderForm-main__submit" data-toggle="modal" data-target="#myModal"><?= Yii::t('web','Выбрать банк') ?></a>
            <?php endif; ?>
            <?php if ($purchaseType == 2): ?>
<!--                <input style="text-align:center; text-decoration:none;" type="submit" class="orderForm-main__submit shops-form" value="--><?//= Yii::t('web','Выбрать магазин') ?><!--" onclick="yaCounter44862661.reachGoal('oformit_pokupku'); return true;">-->
                <a style="text-align:center; padding-top:20px; text-decoration:none;" class="orderForm-main__submit shops-form" data-toggle="modal" data-target="#shops"><?= Yii::t('web','Выбрать магазин') ?></a>
            <?php endif; ?>
        </div>
        <?php ActiveForm::end(); ?>

        <!-- Modal -->
        <div class="modal fade" style="position:fixed; overflow-y:hidden; width:53rem; height:24rem;" id="myModal" role="dialog">
            <div class="modal-dialog" style="margin-top: 0px; display:table; height: 100%; width: 100%;">

                <!-- Modal content-->
                <div class="modal-header">
                    <div class="modal__title">Оплата</div>
                    <div class="modal__close"></div>
                    <div class="modal__close" data-dismiss="modal"></div>
                </div>
                <div id="myModalNew" name="dialog"></div>
                <br>
                <div class="table-responsive">
                <table class="table table-bordered table-credits">
                    <thead>
                    <tr>
                        <th class="credit-name">
                            Банк
                        </th>
                        <th class="credit-term">
                            <i class="fa fa-clock-o" aria-hidden="true"></i><?= Yii::t('web','Виды кредита') ?>
                        </th>
                        <th class="credit-first-payment">
                            <?= Yii::t('web','Первый взнос') ?>
                        </th>
                        <th class="credit-grace-period">
                            <?= Yii::t('web','Льготный период') ?>
                        </th>
                        <th class="credit-monthly-payment">
                            <?= Yii::t('web','Ежемес. Платеж') ?>
                        </th>
                        <th class="credit-types-credit">
                            <div class="row" style="width:200px;" >
                            <div class="col-sm-6"><?= Yii::t('web','Срок, мес.') ?></div>
                            <div class="col-sm-6"></div>
                           </div>
                        </th>

                    </tr>
                    </thead><!-- /.thead -->
                    <tbody>
                    <?php foreach ($paymentSystems as $paymentSystem): ?>
                        <?php if (($paymentSystem->type == 0 )&&($purchaseType == 1)): ?>
                            <tr>

                                <td class="credit-name">
                                    <div class="bank_image" style="background-image: url('<?= $paymentSystem->logo; ?>')"></div>
                                    <div class="name dotdotdot" style="word-wrap: break-word;"><?= $paymentSystem->name; ?></div>
                                </td>

                                <td class="credit">
                                    <?= $paymentSystem->description; ?>
                                </td>
                                <td class="credit">
                                    <?php if (!$paymentSystem->down_payment): ?>
                                        <?=Yii::t('web', 'Нет')?>
                                    <?php else: ?>
                                        <?= $paymentSystem->down_payment; ?>
                                    <?php endif; ?>

                                </td>
                                <td class="credit">
                                    <?php if (!$paymentSystem->grace_period): ?>
                                        ---
                                    <?php else: ?>
                                        <?= $paymentSystem->grace_period; ?>
                                    <?php endif; ?>

                                </td>
                                <td class="credit">
                                   <output style="display: inline;" name="part" id="PartId<?=$paymentSystem->id?>"><?=round(($totalPrice*100)/2)/100?></output>&nbsp;грн
                                </td>

                                <td class="credit">
                                    <form id="payments<?=$paymentSystem->id?>" action="<?=Url::to(['cart/'.$paymentSystem->method])?>"  class = "payments" method="POST" accept-charset="UTF-8">
                                        <div class="col-sm-5">
                                            <input type="hidden" name="amount" id="AmountId<?=$paymentSystem->id?>" value="<?=$totalPrice?>">
                                            <?php if($paymentSystem->id == 4): ?>  <!-- 4 Оплата частями; 5 Мгновенная рассрочка-->
                                            <select name="PartsCountInput" id="PartsCountInputId"  onchange="$('#PartsCountOutputId').val($(this).val());  $('#PartId<?=$paymentSystem->id?>').val(Math.round(100*$('#AmountId<?=$paymentSystem->id?>').val()/$(this).val())/100);">
                                                <option value="2">2</option>
                                                <option value="3">3</option>
<!--                                                <option value="4">4</option>-->
<!--                                                <option value="5" selected="selected">5</option>-->
<!--                                                <option value="6">6</option>-->
<!--                                                <option value="8">8</option>-->
<!--                                                <option value="9">9</option>-->
<!--                                                <option value="10">10</option>-->
<!--                                                <option value="12">12</option>-->
<!--                                                <option value="14">14</option>-->
<!--                                                <option value="16">16</option>-->
<!--                                                <option value="18">18</option>-->
<!--                                                <option value="24">24</option>-->
                                            </select>
                                            <?php else: ?>
                                            <select name="PartsCountInput" id="PartsCountInputId"  onchange="$('#PartsCountOutputId').val($(this).val());  $('#PartId<?=$paymentSystem->id?>').val(Math.round(100*$('#AmountId<?=$paymentSystem->id?>').val()/$(this).val())/100);">
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                            </select>
                                            <?php endif;?>
                                        </div>
                                        <div class="col-sm-6">
                                            <button  id="makeOrder"  data-id=<?= $paymentSystem->id;?> form="orderForm" type="submit" class="makeOrder btn btn-default"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= Yii::t('web','Купить') ?></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody><!-- /.tbody -->
                </table><!-- /.table -->
            </div>

            </div>
        </div>
    </div>
</div>
</div>

<!--<div class="modal-overlay">-->
<!--    <div class="modal-shops">-->
<!---->
<!--        <a class="close-modal">-->
<!--            <svg viewBox="0 0 20 20">-->
<!--                <path fill="#000000" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>-->
<!--            </svg>-->
<!--        </a><!-- close modal -->-->
<!--        <p>--><?//= Yii::t('web', 'Забрать в магазине')?><!--</p>-->
<!--        <div class="modal-content">-->
<!--            <div class="shops-header">-->
<!--                <div class="shops-header-left">-->
<!---->
<!--                </div>-->
<!--                <div class="shops-header-right">-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="shops-content">-->
<!---->
<!--            </div>-->
<!--            <button form="orderForm" type="submit" class=" submit-shop btn btn-success" style="background-color:#f59f08; position:absolute; bottom:0;right:0;padding: 5px 50px;">--><?//=Yii::t('web','Сохранить')?><!--</button>-->
<!--        </div><!-- content -->-->
<!---->
<!--    </div><!-- modal -->-->
<!--</div><!-- overlay -->-->

<?php
//$this->registerJs("
//    $(document).ready(function(){
//        var elements = $('.modal-overlay, .modal-shops');
//
//        $('.shops-form').click(function(){
//            elements.addClass('active');
//        });
//
//        $('.close-modal').click(function(){
//            elements.removeClass('active');
//        });
//        $('.modal-overlay').click(function(e){
//           if($(e.target).closest(\".modal-shops\").length==0) elements.removeClass('active');
//        });
//    });
//");
//?>


<?php
	$count_id = '';
	foreach( $cart as $model )
	{
		$count_id .= $model -> 	product_id.',';
	}
?>
<?= (new \app\components\DimanycMarcetingScript\Marketing()) -> runScript(
	$count_id,
	'conversionintent',
	(number_format($totalPrice, 2)) ? number_format($totalPrice, 2) : 0 );
?>

