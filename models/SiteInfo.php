<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;

class SiteInfo extends Model
{
	public static $_storagePath = '@app/data/siteInfo.json';
	public static $_storagePathCity = '@app/data/';
	
	public $about_us_image;
    public $about_us_text_front_uk;
    public $about_us_text_front_ru;
	public $about_us_title_uk;
	public $about_us_title_ru;
	public $about_us_text_uk;
	public $about_us_text_ru;
	public $partners_text_uk;
	public $partners_text_ru;
    public $bonus_text_uk;
    public $bonus_text_ru;
	public $contacts_phone;
	public $contacts_cell_phone;
	public $contacts_cell_phone_2;
	public $contacts_cell_phone_3;
	public $contacts_cell_phone_4;
	public $contacts_email;
    public $contacts_second_email;
	public $contacts_skype;
	public $contacts_address;
	public $contacts_address_uk;
    public $front_video_url;
    public $google_play_link;
    public $app_store_link;
    public $map_url;
    public $yt_link;
    public $gp_link;
    public $vk_link;
    public $fb_link;
    public $ok_link;
    public $dostavka1;
    public $dostavka1_uk;
    public $dostavka2;
    public $dostavka2_uk;
    public $dostavka3;
    public $dostavka3_uk;
    public $dostavka4;
    public $dostavka4_uk;
    public $dostavka5;
    public $dostavka5_uk;
    public $dostavka6;
    public $dostavka6_uk;
    public $credits;
    public $credits_uk;    

	public static function loadDataCity($city)
	{
		$filePathCity = Yii::getAlias(static::$_storagePathCity . $city . '.json');
		if (file_exists($filePathCity))
		{
			$jsonDataCity = file_get_contents($filePathCity); 
			$data = Json::decode($jsonDataCity);
		}
		return $data;
	}
	
	public static function loadData()
	{
		$filePath = Yii::getAlias(static::$_storagePath);
		$data = [];
		if (file_exists($filePath))
		{
			$fh = fopen($filePath, 'r');
			$jsonData = fgets($fh);
			$data = Json::decode($jsonData);
		}
		$model = new self();
		$model->setAttributes($data);
		return $model;
	}

	public static function saveData($data)
	{
		$jsonData = Json::encode($data);
		$filePath = Yii::getAlias(static::$_storagePath);
		$fh = fopen($filePath, 'w');
		fputs($fh, $jsonData);
		return true;
	}

	public function rules()
	{
		return [
			[['about_us_image', 'about_us_text_uk', 'about_us_title_uk', 'contacts_phone', 'contacts_cell_phone', 'contacts_email', 'contacts_skype'], 'required'],
			[
                ['about_us_text_ru',
                    'about_us_title_ru',
                    'about_us_text_front_ru',
                    'about_us_text_front_uk',
                    'partners_text_ru',
                    'partners_text_uk',
                    'bonus_text_ru',
                    'bonus_text_uk',
                    'front_video_url',
                    'google_play_link',
                    'app_store_link',
                    'contacts_second_email',
                    'contacts_cell_phone_2',
                    'contacts_cell_phone_3',
                    'contacts_cell_phone_4',
                    'contacts_address',
                    'contacts_address_uk',
                    'map_url',
                    'yt_link',
                    'gp_link',
                    'vk_link',
                    'fb_link',
                    'ok_link',
					'dostavka1',
					'dostavka1_uk',
					'dostavka2',
					'dostavka2_uk',
					'dostavka3',
					'dostavka3_uk',
					'dostavka4',
					'dostavka4_uk',
					'dostavka5',
					'dostavka5_uk',
					'dostavka6',
					'dostavka6_uk',
					'credits',
					'credits_uk',
                ], 'safe'
            ],
		];
	}

	public function save()
	{
		$data = $this->getAttributes();
		return static::saveData($data);
	}

    public function getContactsAddress()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->contacts_address;
        case 'uk':
        default:
            return $this->contacts_address_uk;
        }
    }

    public function getAboutUsTitle()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->about_us_title_ru;
        case 'uk':
        default:
            return $this->about_us_title_uk;
        }
    }

    public function getAboutUsText()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->about_us_text_ru;
        case 'uk':
        default:
            return $this->about_us_text_uk;
        }
    }

    public function getPartnersText()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->partners_text_ru;
        case 'uk':
        default:
            return $this->partners_text_uk;
        }
    }

    public function getAboutUsTextFront()
    {
        switch (Yii::$app->language)
        {
        case 'ru':
            return $this->about_us_text_front_ru;
        case 'uk':
        default:
            return $this->about_us_text_front_uk;
        }
    }

    public function getBonusText()
    {
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->bonus_text_ru;
            case 'uk':
            default:
                return $this->bonus_text_uk;
        }
    }
    
    public static function getHistory()
    {
        return History::find()->all();
    }

	public function attributeLabels()
    {
        return [
            'about_us_image' => 'Про компанию (url зображення)',
            'about_us_title_uk' => 'Про компанию (заголовок) українською',
            'about_us_title_ru' => 'Про компанию (заголовок) російською',
            'about_us_text_uk' => 'Про компанию (текст) українською',
            'about_us_text_ru' => 'Про компанию (текст) російською',
            'about_us_text_front_uk' => 'Про компанию (текст на головній) українською',
            'about_us_text_front_ru' => 'Про компанию (текст на головній) російською',
            'partners_text_uk' => 'Партнери українською',
            'partners_text_ru' => 'Партнери російською',
            'bonus_text_uk' => 'Бонус+ українською',
            'bonus_text_ru' => 'Бонус+ російською',
            'contacts_phone' => 'Контактний міський номер',
            'contacts_cell_phone' => 'Контактний мобільний номер',
            'contacts_cell_phone_2' => 'Контактний мобільний номер 2',
            'contacts_cell_phone_3' => 'Контактний мобільний номер 3',
            'contacts_cell_phone_4' => 'Контактний мобільний номер 4',
            'contacts_email' => 'Контактна електронна адреса',
            'contacts_second_email' => 'Контактна резервна електронна адреса',
            'contacts_skype' => 'Контактний skype логін',
            'contacts_address' => 'Контактна адреса російською',
            'contacts_address_uk' => 'Контактна адреса українською',
            'front_video_url' => 'URL відео на головній',
            'google_play_link' => 'URL додатку в Google Play',
            'app_store_link' => 'URL додатку в App Store',
            'map_url' => 'URL для карти',
            'yt_link' => 'YouTube',
            'gp_link' => 'Google Plus',
            'vk_link' => 'Instagram', //change for instagram
            'fb_link' => 'Facebook',
            'ok_link' => 'Одноклассники',
            'dostavka1' => 'Доставка 1 блок',
            'dostavka1_uk' => 'Доставка 1 блок українською',
            'dostavka2' => 'Доставка 2 блок',
            'dostavka2_uk' => 'Доставка 2 блок українською',
            'dostavka3' => 'Доставка 3 блок',
            'dostavka3_uk' => 'Доставка 3 блок українською',
            'dostavka4' => 'Доставка 4 блок',
            'dostavka4_uk' => 'Доставка 4 блок українською',
            'dostavka5' => 'Доставка 5 блок',
            'dostavka5_uk' => 'Доставка 5 блок українською',
            'dostavka6' => 'Доставка 6 блок',
            'dostavka6_uk' => 'Доставка 6 блок українською',
            'credits' => 'Кредитование',
            'credits_uk' => 'Кредитование українською',

        ];
    }
}
