<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-03-01
	 * Time: 19:11
	 */

	namespace app\modules\documentflow\models;

	use app\models\Client;
	use app\models\User;
	use yii\db\Query;

	class UserDocumentLink extends User
	{
		const STATUS_SCORE = 1;
		const STATUS_ACT = 2;
		const STATUS_TAX_INVOICE = 3;
		const STATUS_TREATY = 4;
		const STATUS_ACT_RECONCILIATION = 5;
		const STATUS_SUPPLEMENTARY_AGREEMENT = 6;
		const STATUS_SALES_INVOICE = 7;
		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return 'user_documents_links';
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['user_id_from', 'user_id_to','id_document'], 'required'],
				[['user_id_to', 'user_id_from','id_document'], 'integer'],
				[['user_id_from'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['user_id_from' => 'user_id']],
				[['user_id_to'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['user_id_to' => 'user_id']],
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'id' => 'ID',
				'user_id_from' => 'User ID from',
				'user_id_to' => 'User ID to',
				'id_document' => 'ID document',
			];
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getUserFrom()
		{
			return $this->hasOne(Client::className(), ['user_id' => 'user_id_from']);
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getUserTo()
		{
			return $this->hasOne(Client::className(), ['user_id' => 'user_id_to']);
		}

		/**
		 * @return array
		 */
		public static function getDocument()
		{
			$row =  (new Query())->from(self::tableName())
				-> select('
					user_doc.type_doc,
					user_doc.status,
					user_doc.path_to_doc,
					user_doc.date_from_period,
					user_doc.date_to_period,
					
					user_from.billing_first_name as from_username,
					user_from.billing_last_name as from_lastname,
					
					user_to.billing_first_name as to_username,
					user_to.billing_last_name as to_lastname,
					'
				)
				-> leftJoin( Client ::tableName() . " user_from", 'user_from.user_id = user_documents_links.user_id_from' )
				-> leftJoin( Client ::tableName() . " user_to", 'user_to.user_id = user_documents_links.user_id_to' )
				-> leftJoin( UserDocumentFlow ::tableName() . " user_doc", 'user_doc.id = user_documents_links.id_document' )
				-> all();

			return $row;
		}

		/**
		 * @param $post
		 *
		 * @return bool
		 */
		public function setData($post,$id_document)
		{
			$model                 = new self();
			$model -> user_id_from = \Yii ::$app -> user -> identity -> getId();
			$model -> user_id_to   = $post[ 'user_id_to' ];
			$model -> id_document  = $id_document;
			if( $model -> save() )
			{
				return TRUE;
			}
		}

		/**
		 * @param $type
		 *
		 * @return int|string
		 */
		public static function getTypeDoc($type)
		{
			$status = (integer)'';
			switch($type) {
				case self::STATUS_SCORE :
					$status = 'Счет';
					break;
				case self::STATUS_ACT :
					$status = 'Акт';
					break;
				case self::STATUS_TAX_INVOICE :
					$status = 'Налоговая накладная';
					break;
				case self::STATUS_TREATY :
					$status = 'Договор';
					break;
				case self::STATUS_ACT_RECONCILIATION :
					$status = 'Акт сверки';
					break;
				case self::STATUS_SUPPLEMENTARY_AGREEMENT :
					$status = 'Дополнительное соглашение';
					break;
				case self::STATUS_SALES_INVOICE :
					$status = 'Расходная накладная';
					break;
			}
			return $status;
		}
	}