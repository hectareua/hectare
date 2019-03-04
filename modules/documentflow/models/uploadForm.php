<?php
	namespace app\modules\documentflow\models;

	use yii\base\Model;
	use yii\web\UploadedFile;

	/**
	 * Class UploadForm
	 * @package app\models
	 */
	class uploadForm extends Model
	{
		/**
		 * @var UploadedFile
		 */
		public $document;

		public function rules()
		{
			return [
				[['document'], 'file', 'skipOnEmpty' => false, 'extensions' => 'doc,docx,pdf'],
			];
		}

		/**
		 * @return bool]
		 * Upload Main document
		 */
		public function upload()
		{
			if ($this->validate()) {
				$this->docFile->saveAs('documents/' . $file = $this->docFile->baseName.'_'.$this -> randomNumber() . '.' . $this->docFile->extension);
				return true;
			} else {
				return false;
			}
		}

		/**
		 * @return bool
		 * Upload documents
		 */
		public function uploadDocument($id_user,$id_doc)
		{
			$path = \Yii::getAlias('@documentflow').'/documents/';
			if ($this->validate()) {
				if( !file_exists($path . $id_user ) )
				{
					mkdir($path . $id_user, 0777 ,true);
				}
				$aftersave = UserDocumentFlow::findOne($id_doc);
				$aftersave -> path_to_doc = \Yii::getAlias('@documentflow').'/documents/';
				if($aftersave -> save()) {
					$this->document->saveAs($path . $id_user . '/' . $this->document->baseName . '_' . $this -> randomNumber() . '.' . $this->document->extension);
				}
				return true;
			} else {
				return false;
			}
		}

		/**
		 * @return string
		 * Generate random string for document file
		 */
		protected static function randomNumber()
		{
			$length = 4;
			$str    = '';
			for( $i = 0; $i < $length; ++$i )
			{
				$first = $i ? 0 : 1;
				$n     = mt_rand( $first, 9 );
				$str   .= $n;
			}
			return $str;
		}
	}