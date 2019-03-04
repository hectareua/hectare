<?php
use app\components\Url;
use yii\widgets\LinkPager;

//if page 2 - last-1
    if($page < $numberPages && $page>1) {
        $this->registerLinkTag(['rel' => 'next', 'href' => Url::current(['page' => $page + 1], true)], 'next');
        $this->registerLinkTag(['rel' => 'prev', 'href' => Url::current(['page' => $page - 1], true)], 'prev');
        $this->registerMetaTag(['name' => 'yandex', 'content' => 'noindex, follow']);
        //title
        if((count($manufacturer_ids) + count($filter_ids)) > 0) {
            if($seotitle) {
                $this->title = Yii::t('web','Страница ') . $page . '. ' . $manufacturerTitle . ' ' . $filterTitle;
            } else {
                $this->title = Yii::t('web','Страница ') . $page . '. ' . $category->name . ' ' . $manufacturerTitle . $filterTitle ;
            }   
        } else {
            $this->title = $category->seoTitle? Yii::t('web','Страница ') . $page . '. ' . $category->seoTitle : Yii::t('web','Страница ') . $page . '. ' . $category->name;
        }
        //description
        if((count($manufacturer_ids) + count($filter_ids)) > 0) {
                if($seodesc) {
                $this->registerMetaTag(['name' => 'description', 'content' =>  Yii::t('web','Страница ') . $page . '. ' . $manufacturerDesc . ' ' . $filterDesc], 'description');
                } else {
                    $this->registerMetaTag(['name' => 'description', 'content' =>  Yii::t('web','Страница ') . $page . '. ' . $category->name . ' ' . $manufacturerDesc . ' ' . $filterDesc], 'description');
                }
            } else {
                $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription ? Yii::t('web','Страница ') . $page . '. ' . $category->seoDescription: Yii::t('web','Страница ') . $page . '. ' . $category->name], 'description');
            }
        //keywords
        if (!empty($manufacturerKeywords) || !empty($filterKeywords)) {
            $this->registerMetaTag(['name' => 'keywords', 'content' => $manufacturerKeywords . ' ' . $filterKeywords ], 'keywords');
        } else {
            if ($category->seoKeywords) {
                $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seoKeywords], 'keywords');
            }
        }
//last page    
    } else if($page == $numberPages) {
        if($numberPages > 1) {
            $this->registerLinkTag(['rel' => 'prev', 'href' => Url::current(['page' => $page - 1], true)], 'prev');
            $this->registerMetaTag(['name' => 'yandex', 'content' => 'noindex, follow']);
            //title
            if((count($manufacturer_ids) + count($filter_ids)) > 0) {
                if($seotitle) {
                    $this->title = Yii::t('web','Страница ') . $page . '. ' . $manufacturerTitle . ' ' . $filterTitle;
                } else {
                    $this->title = Yii::t('web','Страница ') . $page . '. ' . $category->name . ' ' . $manufacturerTitle . $filterTitle ;
                }
                    
            } else {
                $this->title = $category->seoTitle? Yii::t('web','Страница ') . $page . '. ' . $category->seoTitle : Yii::t('web','Страница ') . $page . '. ' . $category->name;
            }
            
            //description 
            if((count($manufacturer_ids) + count($filter_ids)) > 0) {
                if($seodesc) {
                $this->registerMetaTag(['name' => 'description', 'content' =>  Yii::t('web','Страница ') . $page . '. ' . $manufacturerDesc . ' ' . $filterDesc], 'description');
                } else {
                    $this->registerMetaTag(['name' => 'description', 'content' =>  Yii::t('web','Страница ') . $page . '. ' . $category->name . ' ' . $manufacturerDesc . ' ' . $filterDesc], 'description');
                }
            } else {
                $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription ? Yii::t('web','Страница ') . $page . '. ' . $category->seoDescription: Yii::t('web','Страница ') . $page . '. ' . $category->name], 'description');
            }
        } else {
            
            if((count($manufacturer_ids) + count($filter_ids)) > 0) {
                if($seotitle) {
                    $this->title = $manufacturerTitle . ' ' . $filterTitle;
                } else {
                    $this->title = $category->name . ' ' . $manufacturerTitle . $filterTitle . Yii::t('web',' купить в Николаеве, Киеве, Одессе, Украине | Гектар');
                } 
            } else {
                $this->title = $category->seoTitle? $category->seoTitle : $category->name . Yii::t('web',' купить в Николаеве, Киеве, Одессе, Украине | Гектар');
            }
            //description
            if((count($manufacturer_ids) + count($filter_ids)) > 0) {
                if($seodesc) {
                $this->registerMetaTag(['name' => 'description', 'content' =>  $manufacturerDesc . ' ' . $filterDesc], 'description');
                } else {
                    $this->registerMetaTag(['name' => 'description', 'content' =>  $category->name . ' ' . $manufacturerDesc . ' ' . $filterDesc . Yii::t('web',' купить в Николаеве, Киеве, Одессе, Украине | Гектар')], 'description');
                }
            } else {
                $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription ? $category->seoDescription: $category->name . Yii::t('web',' ✔ Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
            }
        }
         //keywords
        if (!empty($manufacturerKeywords) || !empty($filterKeywords)) {
            $this->registerMetaTag(['name' => 'keywords', 'content' => $manufacturerKeywords . ' ' . $filterKeywords ], 'keywords');
        } else {
            if ($category->seoKeywords) {
                $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seoKeywords], 'keywords');
            }
        }
//first page        
    } else {
        $this->registerLinkTag(['rel' => 'next', 'href' => Url::current(['page' => $page + 1], true)], 'next');
        //title
        if((count($manufacturer_ids) + count($filter_ids)) > 0) {
            if($seotitle) {
                $this->title = $manufacturerTitle . ' ' . $filterTitle;
            } else {
                $this->title = $category->name . ' ' . $manufacturerTitle . $filterTitle . Yii::t('web',' купить в Николаеве, Киеве, Одессе, Украине | Гектар');
            }
        } else {
            $this->title = $category->seoTitle? $category->seoTitle : $category->name . Yii::t('web',' купить в Николаеве, Киеве, Одессе, Украине | Гектар');
        }
        //description
        if((count($manufacturer_ids) + count($filter_ids)) > 0) {
            if($seodesc) {
                $this->registerMetaTag(['name' => 'description', 'content' =>  $manufacturerDesc . ' ' . $filterDesc], 'description');
            } else {
                $this->registerMetaTag(['name' => 'description', 'content' =>  $category->name . ' ' . $manufacturerDesc . ' ' . $filterDesc . Yii::t('web',' купить в Николаеве, Киеве, Одессе, Украине | Гектар')], 'description');
            }
        } else {
            $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription ? $category->seoDescription: $category->name . Yii::t('web',' ✔ Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
        }
        /*if(!empty($manufacturerDesc) || !empty($filterDesc)) {
            $this->registerMetaTag(['name' => 'description', 'content' => (!empty($manufacturerDesc) || !empty($filterDesc)) ? $manufacturerDesc . ' ' . $filterDesc . Yii::t('web',' ✔ Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93'): $category->name . Yii::t('web',' ✔ Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
        } else {
            $this->registerMetaTag(['name' => 'description', 'content' => $category->seoDescription ? $category->seoDescription: $category->name . Yii::t('web',' ✔ Большой выбор ✔ Гарантия качества ✔ Лучшая цена ✔ Быстрая доставка по Украине ☎ (067) 559-84-93')], 'description');
        }*/
        //keywords
        if (!empty($manufacturerKeywords) || !empty($filterKeywords)) {
            $this->registerMetaTag(['name' => 'keywords', 'content' => $manufacturerKeywords . ' ' . $filterKeywords ], 'keywords');
        } else {
            if ($category->seoKeywords) {
                $this->registerMetaTag(['name' => 'keywords', 'content' => $category->seoKeywords], 'keywords');
            }
        }
    }

    
    if(count($manufacturer_ids) >= 2 || count($filter_ids) >= 2 || count($manufacturer_ids) + count($filter_ids) >=2) {
        $this->registerMetaTag(['name' => 'robots', 'content' => 'noindex, nofollow']);
    }
?>
<div class="items">
    <div class="wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
            <li itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" class="breadcrumbs__item" ><a itemprop="item"  href="<?=Url::to(['default/index'])?>"><span itemprop="name"> <?=Yii::t('web', 'Главная')?> </span> » </a> <meta itemprop="position" content="1" /> </li>
         
            <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem" ><a itemprop="item" href="<?=Url::to(['categories/index'])?>"> <span itemprop="name"><?=Yii::t('web', 'Интернет-магазин')?></span> » </a> <meta itemprop="position" content="2" /></li>



    </ol>

        <h1 class="items__title">
            <?php
            if ($this->params['seoH1']) {
                echo $this->params['seoH1'];
            } elseif((count($manufacturer_ids) + count($filter_ids)) > 0) {
                if($seoheader) {
                    echo $manufacturerH . ' ' . $filterH;
                } else {
                    echo $category->name . ' ' . $manufacturerH . $filterH;
                }  
            } else {
                echo !empty($category->seoHeader)?$category->seoHeader:$category->name;
            }
        ?>
        </h1>
        <div class="itemsSidebar">
            <?php if ($categories): ?>
                <?= $this->render('/partial/_categories', compact('categories')) ?>
            <?php endif; ?>

        <?php if (count($manufacturers) > 0) : ?>    
            <div class="itemsSidebar-producers">
                <div class="itemsSidebar-producers__title"><?=Yii::t('web', 'Производители')?></div>
                <ul class="itemsSidebar-producers-list">
                    <?php foreach ($manufacturers as $manufacturer): ?>
                        <li class="itemsSidebar-producers-list-item">
                            <a href="<?= Url::toCategory($category, $_manufacturer_ids[$manufacturer['manufacturer']->id], $filter_ids); ?>">
                                <span class="itemsSidebar-producers-list-item__label">
                                    <input data-href="<?= Url::toCategory($category, $_manufacturer_ids[$manufacturer['manufacturer']->id], $filter_ids); ?>" type="checkbox" <?=($manufacturer['checked']?'checked':'')?> class="manufacturer_select itemsSidebar-producers-list-item__input"><i> </i>
                                    <?=$manufacturer['manufacturer']->name?> <span> (<?=$manufacturer['count']?>)</span>
                                </span>
                            </a>
                            
                        </li>
                    <?php endforeach; ?>
                    <?php $this->registerJs("
                        $(document).ready(function(){
                            $('.manufacturer_select').change(function(){
                                location = $(this).data('href');
                            });
                        });
                    "); ?>
                </ul>
            </div>
        <?php endif; ?>
            <?php if(count($pageFilters) > 0): ?>

                    <?php foreach ($pageFilters as $parentFilterName => $childFilters ) : ?>
                    <div class="itemsSidebar-producers">
                    <div class="itemsSidebar-producers__title"><?=$parentFilterName?></div>
                    <ul class="itemsSidebar-producers-list">
                        <?php foreach ($childFilters as $id => $childFilter): ?>
                            <?php
                            if($childFilter['count'] == 0)
                                continue;
                                $filter_id = $id;
                                $_filter_ids = $filter_ids;
                                if (is_array($_filter_ids) && in_array($filter_id, $_filter_ids)){
                                    $_filter_ids = array_filter($_filter_ids, function($i)use($filter_id){return $filter_id != $i;});
                                } else {
                                    $_filter_ids[] = $filter_id;
                                }?>
                            <li class="itemsSidebar-producers-list-item">
                                <a href="<?= Url::toCategory($category, $manufacturer_ids, $_filter_ids); ?>">
                                    <span class="itemsSidebar-producers-list-item__label">
                                        <input data-href="<?= Url::toCategory($category, $manufacturer_ids, $_filter_ids); ?>" type="checkbox" <?=
                                        (in_array($id, $filter_ids)?'checked':'')
                                        ?> class="filter_select itemsSidebar-producers-list-item__input"><i> </i>
                                        <?= $childFilter['filter']->name;?> <span> (<?= $childFilter['count']?>)</span>
                                    </span>
                                </a>
                                
                            </li>
                        <?php endforeach; ?>
                        <?php $this->registerJs("
                            $(document).ready(function(){
                                $('.filter_select').change(function(){
                                    location = $(this).data('href');
                                });
                            });
                        "); ?>
                    </ul>
                    </div>
                    <?php endforeach; ?>

            <?php endif; ?>
        </div>
        <ul class="itemsList">
            <?php foreach ($models as $model): ?><li class="itemsList-item col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <a href="<?=Url::toProduct($model)?>" class="itemsList-item__img" style="background-image:url('<?=$model->image?$model->image->url:null?>')"></a>
                    <?php if (1 - $model->discountRate): ?>
                        <div class="itemsList-item-sale">
                            <div class="itemsList-item-sale__percent"><span>-<?=(int)$model->discount?>%</span> <?=Yii::t('web', 'скидка')?></div>
                            <div class="itemsList-item-sale__old"><span><?=number_format($model->currencyOldPrice, 2)?></span> грн</div>
                            <div class="itemsList-item-sale__rest">
                                <?php if ($model->discount_till): ?>
                                    <?=(($model->discountDaysLeft == 1)?Yii::t('web', 'Остался'):Yii::t('web', 'Осталось'))?>
                                    <span><?=$model->discountDaysLeft?></span>
                                    <?=(($model->discountDaysLeft == 1)?Yii::t('web', 'день'):Yii::t('web', 'дней'))?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="itemsList-item__title"><a href="<?=Url::toProduct($model)?>"><?=$model->name?></a></div>
                    <div class="itemsList-item__from"><?=$model->manufacturer?$model->manufacturer->name:null?></div>
                    <div class="itemsList-item__price"><?=number_format($model->currencyPrice, 2)?> грн <?php if (!$model->ykazatel == '0' && !$model->ykazatel == ''): ?> / <?=$model->ykazatel;?><?php endif; ?></div>
                    <div class="itemsList-item__more"><a href="<?=Url::toProduct($model)?>"><?=Yii::t('web', 'Подробнее')?> &gt;&gt;</a></div>
                </li><?php endforeach; ?>

            <div class="space"></div>
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'pageCssClass' => 'pagination__item',
                'prevPageCssClass' => 'pagination__item pagination__item_prev',
                'nextPageCssClass' => 'pagination__item pagination__item_next',
                'activePageCssClass' => 'pagination__item_active',
                'disabledPageCssClass' => 'hidden',
                'nextPageLabel' => Yii::t('web', 'Далее'),
                'prevPageLabel' => Yii::t('web', 'Назад'),
            ]) ?>
        </ul>
        <?php if($page == 1): ?>
            <?php
            if ($this->params['seoText']) : ?>
                <div class="dynamic_content"><?=$this->params['seoText']?></div>
            <?php elseif(!empty($manufacturerDescriptionFull) || !empty($filterDescriptionFull)) : ?>
                <?php if(!empty($manufacturerDescriptionFull)) foreach ($manufacturerDescriptionFull as $mdf) : ?>
                    <div class="dynamic_content"><?=$mdf?> </div>
                <?php endforeach; ?>
                <?php if(!empty($filterDescriptionFull)) foreach ($filterDescriptionFull as $fdf) : ?>
                    <div class="dynamic_content"><?=$fdf?> </div>
                <?php endforeach; ?>
            <?php elseif((count($manufacturer_ids) + count($filter_ids)) === 0): ?>
                <div class="dynamic_content"><?=$category->description?></div>
            <?php endif; ?>
        <?php endif; ?>

    </div>

</div>
