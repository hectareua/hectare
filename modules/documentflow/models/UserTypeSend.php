<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-03-03
	 * Time: 19:29
	 */

	namespace app\modules\documentflow\models;

	use app\models\User;
	use Yii;

	/**
	 * Class UserTypeSend
	 * @package app\modules\documentflow\models
	 */
	class UserTypeSend extends User
	{
		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		public static function getPartners()
		{
			return Yii::$app->db->createCommand(self::sqlRequest(4))->queryAll();
		}

		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		public static function getManufacturers()
		{
			return Yii::$app->db->createCommand(self::sqlRequest(2))->queryAll();
		}

		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		public static function getAccountants()
		{
			return Yii::$app->db->createCommand(self::sqlRequest(0))->queryAll();
		}

		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		public static function getLawyers()
		{
			return Yii::$app->db->createCommand(self::sqlRequest(0))->queryAll();
		}

		/**
		 * @param $type
		 *
		 * @return string
		 */
		protected static function sqlRequest($type) {
			return 'SELECT client.billing_first_name,client.billing_last_name 
					FROM user 
					LEFT JOIN client ON client.user_id = user.id
					WHERE ctype='.$type;
		}
	}