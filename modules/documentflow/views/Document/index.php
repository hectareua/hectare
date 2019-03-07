
<?php
	use kartik\form\ActiveForm;
	use yii\helpers\Url;
	use yii\helpers\Html;
	use app\modules\documentflow\models\UserDocumentFlow;
	use app\modules\documentflow\models\UserDocumentLink;
	use app\modules\documentflow\components\RuDate;
	use kartik\date\DatePicker;
	use app\modules\documentflow\models\UserTypeSend;

?>
<div class="parent-box-document">
	<?php $form = ActiveForm::begin([
		'action' => Url::to(['/documentflow/document/send-document']),
		'enableAjaxValidation' => true,
		'options' => [
			'enctype' => 'multipart/form-data'
		]
	]);
	?>
		<div class="table">
			<div class="row header">
				<div class="cell">
					Дата Загрузки
				</div>
				<div class="cell">
					Тип документа
				</div>
				<div class="cell">
					Получатель
				</div>
				<div class="cell">
					Период документа
				</div>
				<div class="cell">
					Загрузка документа
				</div>
				<div class="cell">
					Статус
				</div>
			</div>
			<div class="row">
				<div class="cell" data-title="Name"></div>
				<div class="cell" data-title="Age">
					<?= $form->field($modelFlowDoc, 'type_doc')->dropDownList([
																				  UserDocumentLink::STATUS_SCORE => 'Счет',
																				  UserDocumentLink::STATUS_ACT => "Акт",
																				  UserDocumentLink::STATUS_TAX_INVOICE => 'Налоговая накладная',
																				  UserDocumentLink::STATUS_TREATY => 'Договор',
																				  UserDocumentLink::STATUS_ACT_RECONCILIATION => 'Акт сверки',
																				  UserDocumentLink::STATUS_SUPPLEMENTARY_AGREEMENT => 'Дополнительное соглашение',
																				  UserDocumentLink::STATUS_SALES_INVOICE => 'Расходная накладная',
																			  ])->label(false); ?>
				</div>
				<div class="cell" data-title="Occupation">
					<?= $form->field($modelDocLink, 'user_id_to')->dropDownList($selectData) -> label(false);?>
				</div>
				<div class="cell" data-title="Location">
					<?= DatePicker::widget([
					   'name' => 'from_date',
					   'type' => DatePicker::TYPE_INPUT,
					   'value' => date('d',time()).' '.date('M').' '. date('Y',time()),
					   'disabled' => true
				   ]); ?>
					<?= $form->field($modelFlowDoc, 'date_to_period')->widget(DatePicker::className(), [
						'options' => ['placeholder' => 'Дата'],
						'convertFormat' => true,
						'type' => DatePicker::TYPE_INPUT,
						'pluginOptions' => [
							'format' => 'yyyy-MM-dd',
							'weekStart'=>1, //неделя начинается с понедельника
							'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
						]
					])->label(false); ?>
				</div>
				<div class="cell" data-title="Location">
					<?= Yii::$app -> uploadComponent -> run($modelFlowDoc) ?>
				</div>
				<div class="cell" data-title="Location">
					<div class="form-group">
						<?= Html::submitButton('Отправить' ,['class' => 'btn btn-success  btn-form-upload']) ?>
					</div>
				</div>


			</div>
		</div>
	<?php ActiveForm::end(); ?>
	<div class="table">
		<?php if(!empty($documents)): ?>
			<?php foreach($documents as $item): ?>
				<div class="row">
					<div class="cell" data-title="Name">
						<?= date('d',strtotime($item['date_from_period'])) ?>
						<?= RuDate::dateru('м',strtotime($item['date_from_period'])) ?>
					</div>
					<div class="cell" data-title="Age">
						<?= UserDocumentLink::getTypeDoc($item['type_doc']) ?>
					</div>
					<div class="cell" data-title="Occupation">
						<a href="#">
							<?= $item['to_username'] . ' ' . $item['to_lastname'] ?>
						</a>
					</div>
					<div class="cell" data-title="Location">
						<?= date('d',strtotime($item['date_from_period'])) ?>
						<?= RuDate::dateru('м',strtotime($item['date_from_period'])) ?>
						<br>
						<?= date('d',strtotime($item['date_to_period'])) ?>
						<?= RuDate::dateru('м',strtotime($item['date_to_period'])) ?>
					</div>
					<div class="cell" data-title="Location">
						<?php if($user_type === UserTypeSend::USER_TYPE_ACCOUNTANTS || $user_type === UserTypeSend::USER_TYPE_LAWYERS ): ?>

							<div class="box-item-load">
								<?php if($item['check_send'] == UserDocumentLink::STATUS_SEND_FROM): ?>
									<a href="<?= Url::to(['/documentflow/document/download-document','pathdoc' => $item['path_to_doc']]) ?>">Скачать<br>(ответ)</a>
								<?php else: ?>
									<p>Отправлено</p>
								<?php endif ?>
							</div>
							<?php if($item['check_send'] == UserDocumentLink::STATUS_SEND_FROM): ?>
								<div class="box-item-load">
									<?php $form = ActiveForm::begin([
																		'action' => Url::to(['/documentflow/document/set-new-path-document']),
																		'options' => [
																			'enctype' => 'multipart/form-data',
																			'id' => 'send_form_'.$item['id_flow_doc']
																		]
																	]); ?>
									<input type="hidden" value="<?= $item['user_id_to'] ?>" name="UserDocumentLink[user_id_from]">
									<input type="hidden" value="<?= $item['id_flow_doc'] ?>" name="UserDocumentLink[id_flow_doc]">
									<input type="hidden" value="<?= UserDocumentLink::STATUS_SEND_TO_PART ?>"  name="UserDocumentLink[return_status]">
									<?= $form->field($modelFlowDoc, 'path_to_doc',['options' => ['id' => 'send_doc_'.$item['id_flow_doc']]])->fileInput()->label('Загрузить') ?>
									<?= Html::submitButton('Отправить' ,['class' => 'btn btn-success  btn-form-upload']) ?>
									<?php ActiveForm::end(); ?>
								</div>
							<?php endif ?>
						<?php else: ?>
							<div class="box-item-load">
								<?php if($item['check_send'] == UserDocumentLink::STATUS_SEND_TO_PART): ?>
									<a href="<?= Url::to(['/documentflow/document/download-document','pathdoc' => $item['path_to_doc']]) ?>">Скачать<br>(ответ)</a>
								<?php else: ?>
									<p>Отправлено</p>
								<?php endif ?>
							</div>
							<?php if($item['check_send'] == UserDocumentLink::STATUS_SEND_TO_PART): ?>
								<div class="box-item-load">
										<?php $form = ActiveForm::begin([
											'action' => Url::to(['/documentflow/document/set-new-path-document']),
											'options' => [
												'enctype' => 'multipart/form-data',
												'id' => 'send_form_'.$item['id_flow_doc']
											]
										]); ?>
											<input type="hidden" value="<?= $item['user_id_from'] ?>" name="UserDocumentLink[user_id_from]">
											<input type="hidden" value="<?= $item['id_flow_doc'] ?>" name="UserDocumentLink[id_flow_doc]">
											<input type="hidden" value="<?= UserDocumentLink::STATUS_SEND_FROM ?>"  name="UserDocumentLink[return_status]">
											<?= $form->field($modelFlowDoc, 'path_to_doc',['options' => ['id' => 'send_doc_'.$item['id_flow_doc']]])->fileInput()->label('Загрузить') ?>
											<?= Html::submitButton('Отправить' ,['class' => 'btn btn-success  btn-form-upload']) ?>
										<?php ActiveForm::end(); ?>
								</div>
							<?php endif ?>
						<?php endif ?>
					</div>
					<div class="cell" data-title="Location">
						<?php if($user_type === UserTypeSend::USER_TYPE_ACCOUNTANTS || $user_type === UserTypeSend::USER_TYPE_LAWYERS ): ?>
							<?php $form = ActiveForm::begin([
								'action' => Url::to(['/documentflow/document/set-status-doc']),
								'options' => [
									'enctype' => 'multipart/form-data',
									'id' => 'send_form_'.$item['id_flow_doc']
								]
							]); ?>
								<input type="hidden" value="<?= $item['id_flow_doc'] ?>" name="UserDocumentFlow[id_flow_doc]">
								<?php $modelFlowDoc -> status = $item['status'] ?>
								<?= $form->field($modelFlowDoc, 'status')->dropDownList([
									UserDocumentFlow::STATUS_SENT => 'Отправлен',
									UserDocumentFlow::STATUS_SIGNED => "Подписан",
									UserDocumentFlow::STATUS_IN_WAIT => 'В ожидании подписания',
									UserDocumentFlow::STATUS_IN_WORK => 'В работе',
									UserDocumentFlow::STATUS_PAID => ' Оплачен',
									UserDocumentFlow::STATUS_NO_PAID => 'Не оплачен',
									UserDocumentFlow::STATUS_WAIT_PAID => 'Ожидание оплаты',
									UserDocumentFlow::STATUS_COMPLETED => 'Завершен',
								  ],['prompt' => 'Выберите статус',['options' =>[ $item['status'] => ['Selected' => true]]]])->label(false); ?>
								<?= Html::submitButton('Сменить' ,['class' => 'btn btn-success  btn-form-upload']) ?>
							<?php ActiveForm::end(); ?>
						<?php else: ?>
							<div class="status_doc">
								<?= UserDocumentFlow::getStatus($item['status']) ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif ?>
	</div>
	<?php if(empty($documents)): ?>
		<div class="empty_doc">
			<h2>У вас пока что нету запросов</h2>
		</div>
	<?php endif ?>
</div>
