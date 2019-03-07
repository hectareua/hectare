<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-03-03
	 * Time: 19:29
	 */

	namespace app\modules\documentflow\models;

	use app\models\User;
	use app\modules\documentflow\components\damp;
	use Yii;
	use yii\helpers\ArrayHelper;

	/**
	 * Class UserTypeSend
	 * @package app\modules\documentflow\models
	 */
	class UserTypeSend extends User
	{

		const USER_TYPE_MANUFACTURERS = 2;
		const USER_TYPE_PARTNERS = 4;
		const USER_TYPE_ACCOUNTANTS = 12;
		const USER_TYPE_LAWYERS = 13;
		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		public static function getPartners()
		{
			return self::sortData(Yii::$app->db->createCommand(self::sqlRequest(4))->queryAll());
		}

		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		public static function getManufacturers()
		{
			return self::sortData(Yii::$app->db->createCommand(self::sqlRequest(2))->queryAll());
		}

		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		public static function getAccountants()
		{
			return self::sortData(Yii::$app->db->createCommand(self::sqlRequest(12))->queryAll());
		}

		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		public static function getLawyers()
		{
			return self::sortData(Yii::$app->db->createCommand(self::sqlRequest(13))->queryAll());
		}

		/**
		 * @param $data
		 *
		 * @return array
		 */
		public static function sortData($data)
		{

			$array_mass = [];
			foreach( $data as $datum )
			{
				if(!empty($datum['billing_first_name']) && !empty($datum['billing_last_name'])) {
					$array_mass[$datum['user_id']] = $datum['billing_first_name'].' '.$datum['billing_last_name'];
				}
			}
			return $array_mass;
		}
		/**
		 * @param $type
		 *
		 * @return string
		 */
		protected static function sqlRequest($type) {
			return 'SELECT client.user_id,client.billing_first_name,client.billing_last_name,client.delivery_first_name,client.delivery_last_name,client.delivery_middle_name,client.billing_middle_name 
					FROM user 
					LEFT JOIN client ON client.user_id = user.id
					WHERE user.ctype='.$type;
		}
	}