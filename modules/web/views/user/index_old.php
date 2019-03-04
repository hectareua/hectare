<?php
use app\components\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AttributeValue;
$this->title = Yii::t('web', 'Личный кабинет');
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
?>
<div class="cabinet">
    <div class="wrapper">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>


            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item"><span itemprop="name"><?=Yii::t('web', 'Личный кабинет')?></span> <meta itemprop="position" content="2" /> </li>


        </ol>
        <div class="cabinet__title"><?=Yii::t('web', 'Личный кабинет')?></div>
        <div class="tabs cabinet-main">
            <ul class="tabs-control">
                <li class="tabs-control__item active"><a href="#" class="tabs-control__item_link"><?=Yii::t('web', 'Профиль')?></a> </li>
                <?php if ($user->ctype!=2) { ?><li class="tabs-control__item"><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Заказы')?></a> </li><?php } ?>
                <?php if ($user->ctype==2) { ?><li class="tabs-control__item"><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Остатки')?></a> </li><?php } ?>
                <?php if ($user->ctype!=2) { ?><li class="tabs-control__item"><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Архив заказов')?></a> </li><?php } ?>
                <?php if (!empty($manager)): ?>
                    <li class="tabs-control__item"><a href="" class="tabs-control__item_link"><?=Yii::t('web', 'Ваш менеджер')?></a> </li>
                <?php endif; ?>
            </ul>
            <ul class="tabs-list">
                <li class="tabs-list__item active cabinet-main-profile">
                    <div class="cabinet-main-profile__title"><?=$client->billingFullName?></div>
                    <ul class="cabinet-main-profile-list"><?=Yii::t('web', 'Контактные данные')?>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Страна')?>: <span><?=$client->billingCountry?$client->billingCountry->name:''?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Область')?>: <span><?=$client->billing_region?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Город')?>: <span><?=$client->billing_city?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Телефон')?>: <span><?=$client->billing_phone?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','E-mail')?>: <span><?=$user->email?></span></li>
                    </ul>
                    <ul class="cabinet-main-profile-list"><?=Yii::t('web','Данные по доставке')?>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Страна')?>: <span><?=$client->deliveryCountry?$client->deliveryCountry->name:''?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Область')?>: <span><?=$client->delivery_region?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Город')?>: <span><?=$client->delivery_city?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Почтовый индекс')?>: <span><?=$client->delivery_postcode?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Улица/Номер дома')?>: <span><?=$client->delivery_address?></span></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Телефон')?>: <span><?=$client->delivery_phone?></span></li>
                    </ul>
                    <?php /*
                    <ul class="cabinet-main-profile-list"><?=Yii::t('web','Ваши бонусы')?>

                        <li class="cabinet-main-profile-list__item bonuses-quantity"><?= \app\models\CartItem::getAllBonuses(); ?></li>
                        <li class="cabinet-main-profile-list__item"><?=Yii::t('web','Вы можете частично оплатить заказ бонусами')?></li>
                    </ul>
                    */ ?>
                    <a href="<?=Url::to(['edit'])?>" class="cabinet-main-profile__change"><?=Yii::t('web', 'Изменить мои данные')?></a>
                </li>
            <?php if ($user->ctype!=2) { ?>    
                <li class="tabs-list__item cabinet-main-orders">
                    <div class="cabinet-main-orders-all">
                        <div class="cabinet-main-orders-all__title"><?=Yii::t('web','Все заказы')?></div>
                        <div class="cabinet-main-orders-all-item">
                            <div class="cabinet-main-orders-all-item__quantity"><?=Yii::t('web','Количество заказов')?>: <span><?=$ordersTotalCount?></span></div>
                            <div class="cabinet-main-orders-all-item__price"><?=Yii::t('web','Сумма за все заказы')?>: <span><?=number_format($ordersTotalCost, 2)?> грн.</span></div>
                        </div>

                    </div>
                    <div class="cabinet-main-orders-stat">
                        <div class="cabinet-main-orders-stat__title"><?=Yii::t('web','Статистика заказов')?></div>
                        <?php foreach($orderStats as $orderStatsItem): ?>
                            <div class="cabinet-main-orders-stat-item">
                                <div class="cabinet-main-orders-stat-item__quantity"><?=$orderStatsItem['status']->name?>: <?=$orderStatsItem['amount']?></div>
                                <div class="cabinet-main-orders-stat-item__price"><?=Yii::t('web', 'Сумма')?>: <?=number_format($orderStatsItem['cost'], 2)?> грн</div>
                            </div>
                        <?php endforeach; ?>
                        <?= \app\models\CartItem::existsBonusRequest() ? '<font color="red">'.Yii::t('web', 'Выполняется запрос, списание бонусов приостановлено!').'</font>' : '' ?>

                    </div>
                    <div class="cabinet-main-itemList">
                        <div class="cabinet-main-itemList-header">
                            <div class="cabinet-main-itemList-header__id" ><?=Yii::t('web', '№ заказа')?> / <?=Yii::t('web', 'Дата')?></div><div
                                class="cabinet-main-itemList-header__name"><?=Yii::t('web', 'Товары')?></div>
                            <div class="cabinet-main-itemList-header__price"><?=Yii::t('web', 'Цена')?></div>
                            <div class="cabinet-main-itemList-header__bonus_minus"><?= \app\models\CartItem::existsBonusRequest() ? '<font color="red">'.Yii::t('web', 'Запрос бонус -').'</font>' : Yii::t('web', 'Бонус -');?></div>
                            <div class="cabinet-main-itemList-header__bonus_plus"><?=Yii::t('web', 'Бонус +')?></div>
                            <div
                                class="cabinet-main-itemList-header__delivery"><?=Yii::t('web', 'Оплата')?></div><div
                                class="cabinet-main-itemList-header__status"><?=Yii::t('web', 'Cтатус заказа')?></div>
                        </div>
                        <?php foreach ($orders as $order): ?>
                            <div class="cabinet-main-itemList-item">
                                <div class="cabinet-main-itemList-item__id"><span><?=str_pad($order->id, 8, "0", STR_PAD_LEFT)?> <br> <?=date('d.m.Y', strtotime($order->ordered_at))?></span></div><div
                                    class="cabinet-main-itemList-item__name"><span>
                                        <?php if(!$order->is_one_c_order): ?>
                                            <?php foreach($order->orderProducts as $orderProduct): ?>
                                                <?=$orderProduct->product->name?>
                                                <?php foreach ($orderProduct->attributeValues as $attributeValue): ?>
                                                    <?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
                                                <?php endforeach; ?>
                                                <br>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <?= $order->products_one_c;?>
                                        <?php endif; ?>
                                    </span></div>
                                <div
                                    class="cabinet-main-itemList-item__price"><?=number_format($order->price, 2)?> грн.</div>
                                <div
                                        class="cabinet-main-itemList-item__bonus_minus"><?php /* =(int)$order->bonusMinus */ ?></div>
                                <div
                                        class="cabinet-main-itemList-item__bonus_minus"><?=(int)$order->bonus_got?></div>
                                <div
                                    class="cabinet-main-itemList-item__delivery"><span><?=$order->paymentSystem->name?></span></div>
                                <div
                                    class="cabinet-main-itemList-item__status"><?=$order->status->name?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </li>
			<?php } ?>
               <?php if ($user->ctype==2) { ?>
                <li class="tabs-list__item cabinet-rests">
                    <div class="cabinet-main-orders-all">
                        <div class="cabinet-main-orders-all__title"><?=Yii::t('web','Все остатки')?></div>
                        <div class="cabinet-main-orders-all-item">
                            <div class="cabinet-main-orders-all-item__quantity"><?=Yii::t('web','Количество остатков')?>: <span></span></div>
                        </div>

                    </div>
                    <div>
						<?php $products = ArrayHelper::map($products, 'id', 'name_uk'); ?>
						<select class="form-control" style="width:300px" id="stocksselect">
							<option value="0">Всего</option>
							<?php foreach ($stocksi as $s) {?>
							<option value="<?=$s->id?>"><?=$s->name?>: <?=$s->fullname?></option>
							<?php } ?>
							
						</select>
					</div>
                    <div class="cabinet-main-itemList">
                        <div class="cabinet-main-itemList-header">
                            <div class="cabinet-main-itemList-header__name"><?=Yii::t('web', 'Товары')?></div>
                            <div class="cabinet-main-itemList-qtysell" style="width:25%;"><?=Yii::t('web', 'Отгружено')?></div>
							<div class="cabinet-main-itemList-header__qtyrest" style="width:25%;"><?=Yii::t('web', 'Остатки')?></div>
                        </div>

						<?php foreach ($stock[0] as $s)  { ?>
								<div class="cabinet-main-itemList-item" data-sid="0" style="display:block;">
									<div class="cabinet-main-itemList-item__name" data-rel="<?php echo $s["product_id"]; ?>">
										<?php echo $products[$s["product_id"]].' ('. AttributeValue::findOne([$s["avid"]])->option->{"name_uk"} .')'; ?>
									</div>
									<div class="cabinet-main-itemList-item__qtysell" style="width:25%;">
										
									</div>
									<div class="cabinet-main-itemList-item__qtyrest stockceil" style="width:25%;">
										<?php echo $s["quantity"]; ?>
									</div>
								</div>	
						<?php } ?>	                        
                        <?php foreach ($stocksi as $st)  { ?>
						
							<?php foreach ($stock[$st->id] as $s)  { ?>
								<div class="cabinet-main-itemList-item" data-sid="<?=$st->id?>" <?=($st->id==0)?' style="display:block;"':' style="display:none;"'?>>
									<div class="cabinet-main-itemList-item__name" data-rel="<?php echo $s["product_id"]; ?>">
										<?php echo $products[$s["product_id"]].' ('. AttributeValue::findOne([$s["avid"]])->option->{"name_uk"} .')'; ?>
									</div>
									<div class="cabinet-main-itemList-item__qtysell" style="width:25%;">
										
									</div>
									<div class="cabinet-main-itemList-item__qtyrest stockceil" style="width:25%;">
										<?php echo $s["quantity"]; ?>
									</div>
								</div>					
							<?php } ?>	

						<?php } ?>
						<?php 
						$this->registerJs("
						jQuery('#stocksselect').change(function(){ 
							jQuery('.cabinet-main-itemList-item').css('display','none');
							jQuery('.cabinet-main-itemList-item[data-sid=\"'+jQuery('#stocksselect').val()+'\"]').css('display','block');
						});
						"); ?>
						<?php /*
						$this->registerJs("
						jQuery('#stocksselect').change(function(){
							var sid = jQuery('#stocksselect').val();
							var ceils = jQuery('.stockceil');
							for (var c in ceils) {
								if (ceils.hasOwnProperty(c) &&
									/^0$|^[1-9]\d*$/.test(c) &&
									c <= 4294967294) {
									var ddd = jQuery(ceils[c]).data(sid);
									if (typeof ddd !== \"undefined\") {
										jQuery(ceils[c]).text(ddd);
									}
								}
							}
						});
						"); ?>
                        <?php /* foreach ($orders as $order): ?>
                            <div class="cabinet-main-itemList-item">
                                <div class="cabinet-main-itemList-item__id"><span><?=str_pad($order->id, 8, "0", STR_PAD_LEFT)?> <br> <?=date('d.m.Y', strtotime($order->ordered_at))?></span></div><div
                                    class="cabinet-main-itemList-item__name"><span>
                                        <?php if(!$order->is_one_c_order): ?>
                                            <?php foreach($order->orderProducts as $orderProduct): ?>
                                                <?=$orderProduct->product->name?>
                                                <?php foreach ($orderProduct->attributeValues as $attributeValue): ?>
                                                    <?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
                                                <?php endforeach; ?>
                                                <br>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <?= $order->products_one_c;?>
                                        <?php endif; ?>
                                    </span></div>
                                <div
                                    class="cabinet-main-itemList-item__price"><?=number_format($order->price, 2)?> грн.</div>
                                <div
                                        class="cabinet-main-itemList-item__bonus_minus"><?php /* =(int)$order->bonusMinus * / ?></div>
                                <div
                                        class="cabinet-main-itemList-item__bonus_minus"><?=(int)$order->bonus_got?></div>
                                <div
                                    class="cabinet-main-itemList-item__delivery"><span><?=$order->paymentSystem->name?></span></div>
                                <div
                                    class="cabinet-main-itemList-item__status"><?=$order->status->name?></div>
                            </div>
                        <?php endforeach; */ ?>
                    </div>
                </li>
            <?php } ?>
            
            <?php if ($user->ctype!=2) { ?>
                <li class="tabs-list__item">
                    <div class="cabinet-main-orders-all">
                        <div class="cabinet-main-orders-all__title"><?=Yii::t('web','Все заказы')?></div>
                        <div class="cabinet-main-orders-all-item">
                            <div class="cabinet-main-orders-all-item__quantity"><?=Yii::t('web','Количество заказов')?>: <span><?=$ordersTotalCount?></span></div>
                            <div class="cabinet-main-orders-all-item__price"><?=Yii::t('web','Сумма за все заказы')?>: <span><?=number_format($ordersTotalCost, 2)?> грн.</span></div>
                        </div>
                    </div>
                    <div class="cabinet-main-orders-stat">
                        <div class="cabinet-main-orders-stat__title"><?=Yii::t('web','Статистика заказов')?></div>
                        <?php foreach($orderStats as $orderStatsItem): ?>
                            <div class="cabinet-main-orders-stat-item">
                                <div class="cabinet-main-orders-stat-item__quantity"><?=$orderStatsItem['status']->name?>: <?=$orderStatsItem['amount']?></div>
                                <div class="cabinet-main-orders-stat-item__price"><?=Yii::t('web', 'Сумма')?>: <?=number_format($orderStatsItem['cost'], 2)?> грн</div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="cabinet-main-itemList">
                        <div class="cabinet-main-itemList-header">
                            <div class="cabinet-main-itemList-header__id" ><?=Yii::t('web', '№ заказа')?> / <?=Yii::t('web', 'Дата')?></div><div
                                class="cabinet-main-itemList-header__name"><?=Yii::t('web', 'Товары')?></div>
                            <div
                                class="cabinet-main-itemList-header__price"><?=Yii::t('web', 'Цена')?></div>
                            <div
                                    class="cabinet-main-itemList-header__bonus_minus"><?=Yii::t('web', 'Бонус -')?></div>
                            <div
                                    class="cabinet-main-itemList-header__bonus_plus"><?=Yii::t('web', 'Бонус +')?></div>
                            <div
                                class="cabinet-main-itemList-header__delivery"><?=Yii::t('web', 'Оплата')?></div><div
                                class="cabinet-main-itemList-header__status"><?=Yii::t('web', 'Cтатус заказа')?></div>
                        </div>
                        <?php foreach ($closedOrders as $order): ?>
                            <div class="cabinet-main-itemList-item">
                                <div class="cabinet-main-itemList-item__id"><span><?=str_pad($order->id, 8, "0", STR_PAD_LEFT)?> <br> <?=date('d.m.Y', strtotime($order->ordered_at))?></span></div><div
                                    class="cabinet-main-itemList-item__name"><span>
                                        <?php if(!$order->is_one_c_order): ?>
                                            <?php foreach($order->orderProducts as $orderProduct): ?>
                                                <?=$orderProduct->product->name?>
                                                <?php foreach ($orderProduct->attributeValues as $attributeValue): ?>
                                                    <?=$attributeValue->option->attr->name?>: <?=$attributeValue->option->name?>
                                                <?php endforeach; ?>
                                                <br>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <?= $order->products_one_c;?>
                                        <?php endif; ?>
                                    </span></div>
                                <div
                                    class="cabinet-main-itemList-item__price"><?=number_format($order->price, 2)?> грн.</div>
                                <div
                                        class="cabinet-main-itemList-item__bonus_minus"><?=$order->bonusMinus?> грн.</div>
                                <div
                                        class="cabinet-main-itemList-item__bonus_minus"><?=(int)$order->bonus_got?></div>
                                <div
                                    class="cabinet-main-itemList-item__delivery"><span><?=$order->paymentSystem->name?></span></div><div
                                    class="cabinet-main-itemList-item__status"><?=$order->status->name?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </li>
            <?php } ?>    
                <?php if (!empty($manager)): ?>
                    <li class="tabs-list__item cabinet-main-manager container">
						<div class="row">
							<div class="col-lg-3">
								<div class="cabinet-main-manager__img">
									<img src="<?=$manager->image->url?>" alt="" onmouseover="this.src= &#39;<?= $manager->imageTwo ? $manager->imageTwo->url : $manager->image->url ?>&#39;" onmouseout="this.src = &#39;<?=$manager->image->url?>&#39;">
								</div>
							</div>
							<div class="col-lg-4">		
								<div class="cabinet-main-manager-text">
									<ul class="persmaninfo">
										<li><label><?=Yii::t('web', 'Имя')?>:</label><?=$manager->name?></li>
										<li><label><?=Yii::t('web', 'Должность')?>:</label><?=$manager->job?></li>
										<li><label><?=Yii::t('web', 'Почта')?>:</label><?=$manager->email?></li>
										<li><label><?=Yii::t('web', 'День рождения')?>:</label><?=$manager->bd?></li>
										<li><label><?=Yii::t('web', 'Карма')?>:</label><?=$manager->carma?></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-6">
							</div>
                        </div>
                        <div class="row">
							<div class="col-lg-3">
							</div>
							<div class="col-lg-8">
								<div class="cabinet-main-manager-text__tel"><?=$manager->phone?></div>
							</div>
							<div class="col-lg-1">
							</div>							
						</div>	
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <?php if (!$userReview->validate()): ?>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'cabinet-interview']]); ?>
                <div class="cabinet-interview__title"><?=Yii::t('web', 'Оцените нашу работу')?></div>
                <div class="cabinet-interview__description"><?=Yii::t('web', 'Оставьте отзыв о нашей работе, ваше мнение очень важно!')?></div>
                <div class="cabinet-interview-wrapper">
                    <textarea name="UserReview[comment]" id="" cols="30" rows="10" class="cabinet-interview__textarea" placeholder="<?=Yii::t('web', 'Ваш комментарий')?>"></textarea>
                    <ul class="cabinet-interview-radiobuttonList">
                        <li class="cabinet-interview-radiobuttonList__title"><?=Yii::t('web', 'Доставка')?></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="5" id="d5" class="cabinet-interview-radiobuttonList-item__radio"><label for="d5" class="cabinet-interview-radiobuttonList-item__label">5</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="4" id="d4" class="cabinet-interview-radiobuttonList-item__radio"><label for="d4" class="cabinet-interview-radiobuttonList-item__label">4</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="3" id="d3" class="cabinet-interview-radiobuttonList-item__radio"><label for="d3" class="cabinet-interview-radiobuttonList-item__label">3</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="2" id="d2" class="cabinet-interview-radiobuttonList-item__radio"><label for="d2" class="cabinet-interview-radiobuttonList-item__label">2</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_delivery]" required value="1" id="d1" class="cabinet-interview-radiobuttonList-item__radio"><label for="d1" class="cabinet-interview-radiobuttonList-item__label">1</label></li>
                    </ul>
                    <ul class="cabinet-interview-radiobuttonList">
                        <li class="cabinet-interview-radiobuttonList__title"><?=Yii::t('web', 'Сервис')?></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="5" id="s5" class="cabinet-interview-radiobuttonList-item__radio"><label for="s5" class="cabinet-interview-radiobuttonList-item__label">5</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="4" id="s4" class="cabinet-interview-radiobuttonList-item__radio"><label for="s4" class="cabinet-interview-radiobuttonList-item__label">4</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="3" id="s3" class="cabinet-interview-radiobuttonList-item__radio"><label for="s3" class="cabinet-interview-radiobuttonList-item__label">3</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="2" id="s2" class="cabinet-interview-radiobuttonList-item__radio"><label for="s2" class="cabinet-interview-radiobuttonList-item__label">2</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_service]" required value="1" id="s1" class="cabinet-interview-radiobuttonList-item__radio"><label for="s1" class="cabinet-interview-radiobuttonList-item__label">1</label></li>
                    </ul>
                    <ul class="cabinet-interview-radiobuttonList">
                        <li class="cabinet-interview-radiobuttonList__title"><?=Yii::t('web', 'Работа')?></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="5" id="w5" class="cabinet-interview-radiobuttonList-item__radio"><label for="w5" class="cabinet-interview-radiobuttonList-item__label">5</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="4" id="w4" class="cabinet-interview-radiobuttonList-item__radio"><label for="w4" class="cabinet-interview-radiobuttonList-item__label">4</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="3" id="w3" class="cabinet-interview-radiobuttonList-item__radio"><label for="w3" class="cabinet-interview-radiobuttonList-item__label">3</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="2" id="w2" class="cabinet-interview-radiobuttonList-item__radio"><label for="w2" class="cabinet-interview-radiobuttonList-item__label">2</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_work]" required value="1" id="w1" class="cabinet-interview-radiobuttonList-item__radio"><label for="w1" class="cabinet-interview-radiobuttonList-item__label">1</label></li>
                    </ul>
                    <ul class="cabinet-interview-radiobuttonList">
                        <li class="cabinet-interview-radiobuttonList__title"><?=Yii::t('web', 'Менеджер')?></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="5" id="w5" class="cabinet-interview-radiobuttonList-item__radio"><label for="w5" class="cabinet-interview-radiobuttonList-item__label">5</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="4" id="w4" class="cabinet-interview-radiobuttonList-item__radio"><label for="w4" class="cabinet-interview-radiobuttonList-item__label">4</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="3" id="w3" class="cabinet-interview-radiobuttonList-item__radio"><label for="w3" class="cabinet-interview-radiobuttonList-item__label">3</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="2" id="w2" class="cabinet-interview-radiobuttonList-item__radio"><label for="w2" class="cabinet-interview-radiobuttonList-item__label">2</label></li>
                        <li class="cabinet-interview-radiobuttonList-item"><input type="radio" name="UserReview[rating_manager]" required value="1" id="w1" class="cabinet-interview-radiobuttonList-item__radio"><label for="w1" class="cabinet-interview-radiobuttonList-item__label">1</label></li>
                    </ul>
                </div>
                <input type="submit" class="cabinet-interview__submit" value="<?=Yii::t('web', 'Отправить')?>">
            <?php ActiveForm::end(); ?>
        <?php else: ?>
            <div class="cabinet-successMessage"><?=Yii::t('web', 'Спасибо за ваш отзыв! Нам важно ваше мнение.')?></div>
        <?php endif; ?>
    </div>
</div>
