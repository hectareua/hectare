<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-03-01
	 * Time: 19:16
	 */

	namespace app\modules\documentflow\models;

	use app\models\User;
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
				[['type_doc', 'date_to_period', 'user_id'], 'required'],
				[['type_doc', 'user_id', 'status'], 'integer'],
				[['path_to_doc'],'string'],
				[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
			];
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
			$model -> date_from_period = date('Y-m-d H:i:s').
			$model -> date_to_period = strtotime(date('Y-m-d',strtotime(str_replace(' ','-',$post['UserDocumentFlow']['date_to_period']))));
			$model -> status = self::STATUS_SENT;
			$model -> user_id = Yii::$app -> user -> identity -> getId();
			if($model -> save()) {
				$modelUpload -> document = $file;
				$modelUpload->uploadDocument($model -> user_id,$model -> id);
				$modelDocLink -> setData($post['UserDocumentLink'],$model -> id);
				return true;
			}
			return false;
		}
	}