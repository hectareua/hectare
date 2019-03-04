<?php
namespace app\modules\admin\models;

use app\models\InfoTabsContent;

use Yii;

class InfoTabsContentForm extends InfoTabsContent
{

    use \app\modules\admin\models\traits\PdfUpload;
    use \app\modules\admin\models\traits\ImageBaseUpload;

//    public $pdfFile;
//    public function rules()
//    {
//        return array_merge(parent::rules(), [
//            [['pdfFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
//        ]);
//    }
//
//    public function upload()
//    {
//        if ($this->validate()) {
//
//            if(!empty($this->pdfFile)){
//                $this->pdfFile->saveAs('pdf/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension);
//                return true;
//            }
//            return true;
//
//        } else {
//            return false;
//        }
//    }
}