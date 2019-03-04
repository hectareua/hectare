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

    /**
     * @var UploadedFile
     */
    public $imageFileRu;
    public $imageFileUk;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['imageUrlRu','imageUrlUk'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'imageUrlRu' => 'URL зображення для російського сайту',
            'imageFileRu' => 'Файл зображення для російського сайту',
            'imageUrlUk' => 'URL зображення для українського сайту',
            'imageFileUk' => 'Файл зображення для українського сайту',
        ]);
    }

    public function afterFind()
    {
        parent::afterFind();
        if ($this->imageru);
            $this->imageUrlRu = $this->imageru->url;
            
        if ($this->imageuk)
            $this->imageUrlUk = $this->imageuk->url;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            if ($this->imageru)
                $this->imageru->delete();
            
            if ($this->imageuk)
                $this->imageuk->delete();
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
            if (!$imageRu)
            {
                $imageRu = new Image();
            }

            if (!$imageUk)
            {
                $imageUk = new Image();
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

            $this->image_id_ru = $imageRu->id;
            $this->image_id_uk = $imageUk->id;

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
