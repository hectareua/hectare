<?php
	use app\components\Url;
	use app\helpers\Helper;
	use yii\helpers\ArrayHelper;
	use yii\widgets\LinkPager;
	use yii\widgets\Pjax;

	$get = Yii::$app -> request -> get();
	if(isset($get['cure_id'])) {
		$val_man = $get['cure_id'];
		$cure_id = $get['cure_id'];
	} else {
		$cure_id = 0;
	}
?>

<div class="box-filter curelistblock" style="text-align: center">
	<div class="form-group">
		<form action="/web/categories/cure/" id="form-manufacture" method="get">
			<input type="hidden" name="cure_id" value="<?= $cure_id ?>">
			<label for="filter_manufacturer">Компания</label>
			<select name="manufacturer_id_filter" id="filter_manufacturer" onchange="selectManufacture(this)">
				<?php foreach($manufacturer_select as $key => $item): ?>
					<option <?php if($manufacture_id === $key): ?> selected <?php endif ?> value="<?= $key ?>"><?= $item ?></option>
				<?php endforeach; ?>
			</select>
			<button>Пошук</button>
		</form>
	</div>
</div>
<div class="items__title memusector">
	<h2 class="<?php echo ($cure_id==0)?'activecure':'' ?>">
		<a href="<?php echo (Yii::$app -> language=='ru')?'/ru':''?>/internet-magazin/cure" title="<?= Yii::t('web', 'Промышленный сектор')?>" >
			<?= Yii::t('web', 'Промышленный сектор')?>
		</a>
	</h2>
	<h2 class="<?php echo ($cure_id==1)?'activecure':'' ?>">
		<a href="<?php echo (Yii::$app -> language=='ru')?'/ru':''?>/internet-magazin/cure/1" title="<?= Yii::t('web', 'Частный сектор')?>" >
			<?= Yii::t('web', 'Частный сектор')?>
		</a>
	</h2>
</div>
	<div class="curelistblock">
	<?php if(!empty($cure)): ?>
		<?php if ($cure_id==0) { ?>

			<div class="row catalog-list curelist" id="renderIndustrySector">
				<div class="col-xs-11 hidden-sm hidden-md hidden-lg text-center">
					<select class="navselect form-control">
						<?php
							$fl = true;
							foreach ($list as $k=>$c):?>
								<option<?php if ($fl) {?> selected="selected"<?php $fl=false;} ?> value="<?php echo $k; ?>" data-ref="#tabs-<?php echo $k; ?>">
									<?php echo $plants[$k]['name'.$suff]; ?>
								</option>
							<?php endforeach; ?>
					</select>
				</div>
				<div class=" hidden-xs col-lg-2 text-right right0">
					<ul class="nav tabs-left nav-stacked">
						<?php
							$fl = true;
							foreach ($list as $k=>$c):?>
								<li<?php if ($fl) {?> class="active"<?php $fl=false;} ?> data-ref="#tabs-<?php echo $k; ?>">
									<div class="pltx"><?php echo $plants[$k]['name'.$suff]; ?></div>
									<?php if ($plants[$k]['image_id']>0) {?>
										<img src="<?php echo $images[$plants[$k]['image_id']]['url']; ?>" class="cureimg" alt="<?php echo $plants[$k]['name'.$suff]; ?>" />
									<?php } ?>
								</li>
							<?php endforeach; ?>
					</ul>
				</div>
				<div class="col-xs-11 col-sm-9 col-lg-9 left0">
					<div id="load_content_gif">
						<img src="../img/loading.gif" alt="">
					</div>
					<div class="tab-content" id="renderTable">
						<?php $fl = true; foreach ($list as  $k=>$c) {?>
								<div class="tab-pane <?php if ($fl) {?> active<?php $fl=false;} ?>" id="tabs-<?php echo $k; ?>">
									<table class="">
										<thead>
											<tr>
												<th><?php echo Yii::t('web', 'СЗР') ?></th>
												<th><?php echo Yii::t('web', 'Основные вредители и болезни') ?></th>
												<?php /* <th><?php echo Yii::t('web', 'Препараты') ?></th> */ ?>
											</tr>
										</thead>
										<tbody>
										<?php foreach($c as $f=>$cc) { ?>
											<tr>
												<td><?php if ($phases[$f]['image_id']>0) {?>
														<img src="<?php echo $images[$phases[$f]['image_id']]['url']; ?>" class="cureimg cureimg1" alt="<?php echo $phases[$f]['name'.$suff]; ?>" />
													<?php } ?>
													<h4><?php echo $phases[$f]['name'.$suff]; ?></h4></td>
												<td>
													<ul style="list-style-type: none;" class="ulproblems">
														<?php
															$ccproblems = array();
															foreach($cc['problems'] as $pr) { $ccproblems[] = $pr; }
															$ccproblems = array_unique($ccproblems);
														?>
														<?php foreach($ccproblems as $pr) { ?>
															<li class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
																<?php if(isset($problems[$pr]['image_id'])): ?>
																	<?php if ($problems[$pr]['image_id']>0) {?>
																		<img src="<?php echo $images[$problems[$pr]['image_id']]['url']; ?>" class="cureimg cureimg1 cureimg2" alt="<?php echo $problems[$pr]['name'.$suff]; ?>" title="<?php echo $problems[$pr]['name'.$suff]; ?>" data-products="<?php echo implode(',',$list[$k][$f]['problems1'][$pr]); ?>" />
																	<?php } ?>
																	<div class="prname"><?php echo $problems[$pr]['name'.$suff]; ?></div>
																<?php endif ?>
																<div class="upinfo hidden">
																	<?php
																		$imp = array();
																		foreach(explode(',',implode(',',$list[$k][$f]['problems1'][$pr])) as $pp): ?>
																			<div>
																				<?php
																				$product_data = true;
																				try {
																					 $products[trim($pp)];
																				} catch(Exception $e)
																				{
																					$product_data = false;
																				}
																				?>
																				<?php if($product_data != false): ?>
																					<?php  $name = $products[trim($pp)]['name_'.Yii::$app -> language];?>
																					<a href="<?php echo Url::toProduct($products[trim($pp)]) ?>" title="<?php echo $name ?>"><?php echo $name ?></a>
																				<?php endif ?>
																			</div>

																		<?php endforeach; ?>
																</div>
															</li>
														<?php } ?>
													</ul>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							<?php } ?>
					</div>
				</div>

				<div class="col-lg-1 col-sm-1 hidden-xs">
				</div>
			</div>
		<?php } ?>

		<?php if ($cure_id==1) { ?>

			<div class="container privateblock" >
				<div class="col-xs-11 hidden-sm hidden-md hidden-lg text-center"> <!-- required for floating -->
					<!-- Nav tabs -->
					<select class="navselect1 form-control">
						<?php
							$fl = true;
							foreach ($list as $k=>$c):?>
								<option<?php if ($fl) {?> selected="selected"<?php $fl=false;} ?> value="<?php echo $k; ?>" data-ref="<?php echo $k; ?>">
									<?php echo $plants[$k]['name'.$suff]; ?>
								</option>
							<?php endforeach; ?>
					</select>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-12 hidden-xs pcurel">
					<?php $fl = true;
						// foreach ($listprivate as $k=>$c) {
						$i = 0;
						foreach ($listprivate as $k=>$c) {?>
							<div class="privateplant <?php if ($fl) {$kk = $k; ?> active<?php $fl=false;} ?>" data-ref="<?php echo $k; ?>">
								<?php echo $plants[$k]['name'.$suff]; ?>
							</div>
							<?php $i++; if ($i>39) {break;}
						} ?>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php
						$fl = true;
						foreach ($list as  $k=>$c) { ?>
							<div class="privatecure <?php echo ($kk==$k)?'':'hidden'; ?>" data-p='<?php echo $k;?>'>
								<table>
									<thead>
									<tr>
										<th class="col-lg-2 col-md-3 col-sm-4 col-xs-4"><?php echo Yii::t('web', 'СЗР') ?></th>
										<th class="col-lg-10 col-md-9 col-sm-8 col-xs-8"><?php echo Yii::t('web', 'Основные вредители и болезни') ?></th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($c as $f=>$cc) { ?>
										<tr>
											<td><?php if ($phases[$f]['image_id']>0) {?><img src="<?php echo $images[$phases[$f]['image_id']]['url']; ?>" class="cureimg cureimg1" alt="<?php echo $phases[$f]['name'.$suff]; ?>" /><?php } ?><h4><?php echo $phases[$f]['name'.$suff]; ?></h4></td>
											<td><ul style="list-style-type: none;" class="ulproblems">
													<?php
														$ccproblems = array();
														foreach($cc['problems'] as $pr) { $ccproblems[] = $pr;}
														$ccproblems = array_unique($ccproblems);
													?>
													<?php foreach($ccproblems as $pr) { ?>
														<li class="col-lg-3 col-md-3 col-sm-3 col-xs-6 ccproblems">
															<?php if(isset($problems[$pr]['image_id'])): ?>
																<?php if ($problems[$pr]['image_id']>0) {?>
																	<img src="<?php echo $images[$problems[$pr]['image_id']]['url']; ?>" class="cureimg cureimg1 cureimg2" alt="<?php echo $problems[$pr]['name'.$suff]; ?>" title="<?php echo $problems[$pr]['name'.$suff]; ?>" data-products="<?php echo implode(',',$list[$k][$f]['problems1'][$pr]); ?>" />
																<?php } ?>
																<div class="prname"><?php echo $problems[$pr]['name'.$suff]; ?></div>
															<?php endif  ?>
																<div class="upinfo hidden">

																	<?php
																		$imp = array();
																		foreach(explode(',',implode(',',$list[$k][$f]['problems1'][$pr])) as $pp):?>
																			<?php
																			$product_data = true;
																			try {
																				$products[trim($pp)];
																			} catch(Exception $e)
																			{
																				$product_data = false;
																			}
																			?>
																			<?php if($product_data != false): ?>
																				<?php  $name = $products[trim($pp)]['name_'.Yii::$app -> language];?>
																				<div class="prodcure">
																					<a href="<?php echo Url::toProduct($products[trim($pp)]) ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a>
																				</div>
																			<?php endif ?>
																		<?php endforeach; ?>
																</div>
														</li>
													<?php } ?>
												</ul>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						<?php } ?>
				</div>
				<div class="col-lg-2 col-md-2 hidden-sm hidden-xs pcurer">
					<?php $i=-1;
						foreach ($listprivate as $k=>$c) {
							$i++;
							if ($i>39) {
								?>
								<div class="privateplant" data-ref="<?php echo $k; ?>">
									<?php echo $plants[$k]['name'.$suff]; ?>
								</div>
							<?php }
						}
						?>
				</div>
			</div>
		<?php } ?>
	<?php else: ?>
		<h2>Нічого не знайдено</h2>
	<?php endif ?>
</div>
<?php
$js = <<<JS
	window.onbeforeunload = function() {
		$('#renderTable').css('opacity',0.3);
		$('#load_content_gif').show('fast');
		return 'sss';
	};
JS;

//	$this -> registerJs($js);
?>