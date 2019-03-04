<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\SiteInfo;
use app\models\PaymentSystem;
use app\models\Country;
use app\models\Slide;
use app\models\Representative;
use yii\data\ActiveDataProvider;


class InfoController extends ApiController
{
	public function actionContacts()
	{
		$info = SiteInfo::loadData();
		return [
			'phone' 		=> strip_tags($info->contacts_phone),
			'cell_phone' 	=> strip_tags($info->contacts_cell_phone),
			'email' 		=> $info->contacts_email,
			'skype' 		=> $info->contacts_skype,
		];
	}

	public function actionAbout()
	{
		$info = SiteInfo::loadData();
		return [
			'image' => $info->about_us_image,
			'title'	=> [
				'uk'	=> $info->about_us_title_uk,
				'ru'	=> $info->about_us_title_ru,
			],
			'text'	=> [
				'uk'	=> $info->about_us_text_uk,
				'ru'	=> $info->about_us_text_ru,
			],
			'history' => SiteInfo::getHistory()
		];
	}

	public function actionPaymentSystems()
	{
        return new ActiveDataProvider([
            'pagination' => false,
            'query' => PaymentSystem::find(),
        ]);
	}

	public function actionCountries()
	{
        return new ActiveDataProvider([
            'pagination' => false,
            'query' => Country::find(),
        ]);
	}
	
	public function actionSlides()
    {
        return Slide::find()->orderBy('id DESC')->all();
    }
    
    	public function actionShops()
    	{
        return $representatives = Representative::find()->all();
    }
}
