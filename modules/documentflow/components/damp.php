<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-03-03
	 * Time: 18:50
	 */

	namespace app\modules\documentflow\components;

	class damp
	{
		public static function dd($var = 'Done!', $die = false){
			echo 'file:' . debug_backtrace()[0]['file'] . ' (' . debug_backtrace()[0]['line'] . ')';
			echo '<pre>'.print_r($var,true).'</pre>';
			if(!$die){
				die();
			}
		}
	}