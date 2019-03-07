<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-03-01
	 * Time: 19:16
	 */

	namespace app\modules\documentflow\models;

	use app\models\User;
	use app\modules\documentflow\components\damp;
	use yii\db\Query;
	use Yii;

	class UserDocumentFlow extends User
	{
		const STATUS_SENT = 1;
		const STATUS_SIGNED = 2;
		const STATUS_IN_WAIT = 3;
		const STATUS_IN_WORK = 4;
		const STATUS_PAID = 5;
		const STATUS_NO_PAID = 6;
		const STATUS_WAIT_PAID = 7;
		const STATUS_COMPLETED = 8;

		const SCENARIO_STATUS = 'change_status';
		const SCENARIO_SET_DATE = 'set_date';
		const SCENARIO_SET_PATH_DOC = 'set_path_doc';

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return 'user_document_flow';
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['type_doc', 'user_id'], 'required'],
				[['type_doc', 'user_id', 'status'], 'integer'],
				[['path_to_doc'],'string'],
				[['date_to_period'],'safe'],
				[['status'], 'required', 'on' => self::SCENARIO_STATUS],
				[['date_to_period'], 'required', 'on' => self::SCENARIO_SET_DATE],
				[['path_to_doc'], 'required', 'on' => self::SCENARIO_SET_PATH_DOC],
				[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
			];
		}

		/**
		 * @return array
		 */
		public function scenarios()
		{
			$scenarios = parent::scenarios();
			$scenarios[self::SCENARIO_STATUS] = ['status'];
			$scenarios[self::SCENARIO_SET_DATE] = ['date_to_period'];
			$scenarios[self::SCENARIO_SET_PATH_DOC] = ['path_to_doc'];
			return $scenarios;
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'id' => 'ID',
				'type_doc' => 'Type ID',
				'date_to_period' => 'Date to period',
				'date_from_period' => 'Date from period',
				'user_id' => 'User ID',
				'status' => 'Status',
				'path_to_doc' => 'Path to doc',
			];
		}

		/**
		 * @param $post
		 * @param $file
		 *
		 * @return bool
		 */
		public function  setData($post,$file)
		{
			$modelUpload = new uploadForm();
			$modelDocLink = new UserDocumentLink();
			$model = new self();
			$model -> type_doc = $post['UserDocumentFlow']['type_doc'];
			$model -> date_from_period = date('Y-m-d H:i:s',time());
			$model -> status = self::STATUS_SENT;
			$model -> user_id = Yii::$app -> user -> identity -> getId();
			$model -> date_to_period = date('Y-m-d H:i:s',strtotime($post['UserDocumentFlow']['date_to_period']));
			$modelUpload -> document = $file;
			$model -> path_to_doc = $modelUpload->uploadDocument($model -> user_id);
			if($model -> save()) {
				$modelDocLink->setData($post['UserDocumentLink'],$model -> id);
				return true;
			}
			return false;
		}

		/**
		 * @param $type
		 *
		 * @return int|string
		 */
		public static function getStatus($type)
		{
			$status = (integer)'';
			switch($type) {
				case self::STATUS_SENT :
					$status = 'Отправлен';
					break;
				case self::STATUS_SIGNED :
					$status = 'Подписан';
					break;
				case self::STATUS_IN_WAIT :
					$status = 'В ожидании подписания';
					break;
				case self::STATUS_IN_WORK :
					$status = 'В работе';
					break;
				case self::STATUS_PAID :
					$status = 'Оплачен';
					break;
				case self::STATUS_NO_PAID :
					$status = 'Не оплачен';
					break;
				case self::STATUS_WAIT_PAID :
					$status = 'Ожидание оплаты';
					break;
				case self::STATUS_COMPLETED :
					$status = 'Завершен';
					break;
			}
			return $status;
		}
	}