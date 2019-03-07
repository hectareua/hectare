<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-03-03
	 * Time: 20:46
	 */

	namespace app\modules\documentflow\components;

	/**
	 * Class RuDate
	 * @package app\modules\documentflow\components
	 */
	class RuDate
	{
		/**
		 * @param      $str
		 * @param null $setDate
		 *
		 * @return string
		 */
		public function dateru($str,$setDate = null) {
			$result = "";
			$iter = 0;
			while ($iter < mb_strlen($str)) {

				switch (mb_substr($str,$iter,1)) {
					case 'д': {
						if(!is_null($setDate)) {
							$dayN = date("N",$setDate);
						} else {
							$dayN = date("N");
						}
						$day = "";
						switch ($dayN) {
							case 1:$day = "Понедельник";break;
							case 2:$day = "Вторник";break;
							case 3:$day = "Среда";break;
							case 4:$day = "Четверг";break;
							case 5:$day = "Пятница";break;
							case 6:$day = "Суббота";break;
							case 7:$day = "Воскресенье";break;
						}
						$iter++;
						$result .= $day;
						break;
					}
					case 'м': {
						if(!is_null($setDate)) {
							$monthN = date("m",$setDate);
						} else {
							$monthN = date("m");
						}
						$month = "";
						switch($monthN) {
							case '01':$month = "Января";break;
							case '02':$month = "Февраля";break;
							case '03':$month = "Марта";break;
							case '04':$month = "Апреля";break;
							case '05':$month = "Мая";break;
							case '06':$month = "Июня";break;
							case '07':$month = "Июля";break;
							case '08':$month = "Августа";break;
							case '09':$month = "Сентября";break;
							case '10':$month = "Октября";break;
							case '11':$month = "Ноября";break;
							case '12':$month = "Декабря";break;
						}
						$iter++;
						$result .= $month;
						break;

					}
					default: {
						$result .=    date(mb_substr($str,$iter,1));
						$iter++;
						break;
					}
				}
			}
			return $result;
		}
	}