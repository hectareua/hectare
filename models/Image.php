<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property boolean $remote
 * @property string $url
 * @property string $path
 *
 * @property Category[] $categories
 * @property News[] $news
 * @property ProductImage[] $productImages
 */
class Image extends \yii\db\ActiveRecord
{
    const BASE_UPLOAD_PATH = '@webroot/upload';
    const BASE_UPLOAD_URL = '@web/upload';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['remote'], 'boolean'],
            [['url', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ['url'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'remote' => 'Remote',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['image_id' => 'id']);
    }
	
	public function getInfoPdfImages()
    {
        return $this->hasMany(InfoPdfImages::className(), ['image_id' => 'id']);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            if ($this->path)
                @unlink(Yii::getAlias($this->path));
            return true;
        }
        return false;
    }

    public function saveUploadedFile($uploadedFile)
    {
        if (!$this->isNewRecord && !$this->remote && $this->path)
        {
            @unlink(Yii::getAlias($this->path));
        }
        $this->remote = false;

        $basePath = Yii::getAlias(self::BASE_UPLOAD_PATH);
        if (!is_dir($basePath))
            mkdir($basePath, 0777, true);
        $info = pathinfo($uploadedFile->name);
        $extension = '';
        if (!empty($info['extension']))
            $extension = $info['extension'];
        $relativeFilePath = uniqid() . '.' . $extension;
        $path = $basePath . '/' . $relativeFilePath;
        $url = Yii::$app->urlManager->getHostInfo() . Yii::getAlias(self::BASE_UPLOAD_URL . '/' . rawurlencode($relativeFilePath));

        if (!$uploadedFile->saveAs(Yii::getAlias($path)))
            return false;
        $this->url = $url;
        $this->path = $path;
        return $this->save();
    }

    public function saveUrl($url)
    {
        if ($url == $this->url)
            return true;

        if (!$this->isNewRecord && !$this->remote && $this->path)
        {
            @unlink(Yii::getAlias($this->path));
        }
        $this->remote = true;

        $this->url = $url;
        $this->path = null;
        return $this->save();
    }

    public function getBase64() {

        $type = pathinfo($this->url, PATHINFO_EXTENSION);
        $data = file_get_contents($this->url);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $base64;
    }

    public function download()
    {
        if (!$this->remote)
            return false;
        $info = pathinfo($this->url);
        if (empty($info['extension']))
            return false;
        $fileName = uniqid() . '.' . $info['extension'];
        $basePath = Yii::getAlias(self::BASE_UPLOAD_PATH);
        if (!is_dir($basePath))
            mkdir($basePath, 0777, true);
        $relativeFilePath = $fileName;
        $path = $basePath . '/' . $relativeFilePath;
        if (Image::find()->where(['path' => $path])->exists())
        {
            $relativeFilePath = uniqid() . '_' . $fileName;
            $path = $basePath . '/' . $relativeFilePath;
        }
        $url = Yii::$app->urlManager->getHostInfo().Yii::getAlias(self::BASE_UPLOAD_URL . '/' . $relativeFilePath);
        if (@copy($this->url, Yii::getAlias($path)));
        {
            $this->remote = false;
            $this->url = $url;
            $this->path = $path;
            return $this->save();
        }
        return false;
    }
}
