<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_pdf_images".
 *
 * @property integer $id
 * @property integer $info_tabs_content_id
 * @property integer $image_id
 */
class InfoPdfImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_pdf_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['info_tabs_content_id', 'image_id'], 'integer'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['info_tabs_content_id'], 'exist', 'skipOnError' => true, 'targetClass' => InfoTabsContent::className(), 'targetAttribute' => ['info_tabs_content_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'info_tabs_content_id' => 'Info Tabs Content ID',
            'image_id' => 'Image ID',
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    public function getInfoTabsContent()
    {
        return $this->hasOne(InfoTabsContent::className(), ['id' => 'info_tabs_content_id']);
    }

}
