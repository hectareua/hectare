
<?php
	use kartik\form\ActiveForm;
	use yii\helpers\Url;
	use yii\helpers\Html;
	use app\modules\documentflow\models\UserDocumentFlow;
	use app\modules\documentflow\models\UserDocumentLink;
	use app\modules\documentflow\components\RuDate;
	use kartik\date\DatePicker;
?>
<?php $form = ActiveForm::begin([
		'action' => Url::to(['/documentflow/document/send-document']),
	    'enableAjaxValidation' => true,
	    'options' => [
	        'enctype' => 'multipart/form-data'
        ]
    ]); ?>
<div class="parent-box-document">
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

			<div class="cell" data-title="Name">

			</div>

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
				<?= $form->field($modelDocLink, 'user_id_to')->dropDownList([
					1 => 'Бугалтер',
					2 => 'Юрист',
				]) -> label(false);?>
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
						'format' => 'dd MM yyyy',
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
						<div class="box-item-load">
							<a href="#">Скачать</a>
						</div>
						<div class="box-item-load">
							<a href="#">Скачать<br>(ответ)</a>
						</div>
					</div>
					<div class="cell" data-title="Location">
						<?= $form->field($modelFlowDoc, 'status')->dropDownList([
							UserDocumentFlow::STATUS_SENT => 'Отправлен',
							UserDocumentFlow::STATUS_SIGNED => "Подписан",
							UserDocumentFlow::STATUS_IN_WAIT => 'В ожидании подписания',
							UserDocumentFlow::STATUS_IN_WORK => 'В работе',
							UserDocumentFlow::STATUS_PAID => ' Оплачен',
							UserDocumentFlow::STATUS_NO_PAID => 'Не оплачен',
							UserDocumentFlow::STATUS_WAIT_PAID => 'Ожидание оплаты',
							UserDocumentFlow::STATUS_COMPLETED => 'Завершен',
						  ])->label(false); ?>
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
<?php ActiveForm::end(); ?>