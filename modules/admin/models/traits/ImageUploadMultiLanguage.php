<?php

namespace app\modules\admin\models\traits;

use Yii;
use yii\web\UploadedFile;
use app\models\Image;

trait ImageUploadMultiLanguage
{
    /**
     * @var string
     */
    public $imageUrlRu;
    public $imageUrlUk;
    public $imageUrlDeskRu;
    public $imageUrlDeskUk;

    /**
     * @var UploadedFile
     */
    public $imageFileRu;
    public $imageFileUk;
    public $imageFileDeskRu;
    public $imageFileDeskUk;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['imageUrlRu','imageUrlUk','imageUrlDeskRu','imageUrlDeskUk'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'imageUrlRu' => 'URL зображення для російського сайту',
            'imageFileRu' => 'Файл зображення для російського сайту',
            'imageUrlUk' => 'URL зображення для українського сайту',
            'imageFileUk' => 'Файл зображення для українського сайту',
            'imageUrlDeskUk'=> 'Десктоп URL зображення для українського сайту',
            'imageUrlDeskRu'=> 'Десктоп URL зображення для російського сайту',
            'imageFileDeskUk' => 'Десктоп файл зображення для українського сайту',
            'imageFileDeskRu' => 'Десктоп файл зображення для російського сайту',
        ]);
    }

    public function afterFind()
    {
        parent::afterFind();
        if ($this->imageru);
            $this->imageUrlRu = $this->imageru->url;
            
        if ($this->imageuk)
            $this->imageUrlUk = $this->imageuk->url;

        if ($this->imageDeskRu)
            $this->imageUrlDeskRu = $this->imageDeskRu->url;

        if ($this->imageDeskUk)
            $this->imageUrlDeskUk = $this->imageDeskUk->url;

    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            if ($this->imageru)
                $this->imageru->delete();
            
            if ($this->imageuk)
                $this->imageuk->delete();

            if ($this->imageDeskRu)
                $this->imageDeskRu->delete();

            if ($this->imageDeskUk)
                $this->imageDeskUk->delete();
            return true;
        }
        return false;
    }

    public function saveForm()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try
        {
            $imageRu = $this->imageru;
            $imageUk = $this->imageuk;
            $imageDeskRu = $this->imageDeskRu;
            $imageDeskUk = $this->imageDeskUk;
            if (!$imageRu)
            {
                $imageRu = new Image();
            }

            if (!$imageUk)
            {
                $imageUk = new Image();
            }

            if (!$imageDeskRu)
            {
                $imageDeskRu = new Image();
            }

            if (!$imageDeskUk)
            {
                $imageDeskUk = new Image();
            }

            if ($this->imageFileRu)
            {
                if (!$imageRu->saveUploadedFile($this->imageFileRu))
                    return false;
            }
            elseif ($imageRu->url != $this->imageUrlRu)
            {
                if (!$imageRu->saveUrl($this->imageUrlRu))
                    return false;
            }

            if ($this->imageFileUk)
            {
                if (!$imageUk->saveUploadedFile($this->imageFileUk))
                    return false;
            }
            elseif ($imageUk->url != $this->imageUrlUk)
            {
                if (!$imageUk->saveUrl($this->imageUrlUk))
                    return false;
            }

            if ($this->imageFileDeskRu)
            {
                if (!$imageDeskRu->saveUploadedFile($this->imageFileDeskRu))
                    return false;
            }
            elseif ($imageDeskRu->url != $this->imageUrlDeskRu)
            {
                if (!$imageDeskRu->saveUrl($this->imageUrlDeskRu))
                    return false;
            }

            if ($this->imageFileDeskUk)
            {
                if (!$imageDeskUk->saveUploadedFile($this->imageFileDeskUk))
                    return false;
            }
            elseif ($imageDeskUk->url != $this->imageUrlDeskUk)
            {
                if (!$imageDeskUk->saveUrl($this->imageUrlDeskUk))
                    return false;
            }

            $this->image_id_ru = $imageRu->id;
            $this->image_id_uk = $imageUk->id;
            $this->img_id_desk_ru = $imageDeskRu->id;
            $this->img_id_desk_uk = $imageDeskUk->id;

            if ($this->save())
            {
                $transaction->commit();
                return true;
            }
        }
        catch (\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }

        return false;
    }
}
