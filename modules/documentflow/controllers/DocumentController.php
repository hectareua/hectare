<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-22
	 * Time: 20:31
	 */
	namespace app\modules\documentflow\controllers;
	use app\models\User;
	use app\modules\documentflow\components\Controller;
	use app\modules\documentflow\models\damp;
	use app\modules\documentflow\models\UserDocumentFlow;
	use app\modules\documentflow\models\UserDocumentLink;
	use app\modules\documentflow\models\uploadForm;
	use app\modules\documentflow\models\UserTypeSend;
	use yii\bootstrap\ActiveForm;
	use yii\web\Response;
	use yii\web\UploadedFile;
	use yii;

	/**
	 * Class DocumentController
	 * @package app\modules\documentflow\controllers
	 */
	class DocumentController extends Controller
	{

		/**
		 * @var string
		 * Type user
		 */
		public $type = '';

		public function index()
		{
			$modelDocLink = new UserDocumentLink();
			$modelFlowDoc = new UserDocumentFlow();

			$user = User::findOne(797);
			if($user -> id === Yii::$app -> user -> identity -> getId()) {
				return $this -> render('index',[
					'documents' => UserDocumentLink::getDocument(),
					'modelFlowDoc' => $modelFlowDoc,
					'modelDocLink' => $modelDocLink,
					'partners' => UserTypeSend::getPartners(),
					'manufacturers' => UserTypeSend::getManufacturers(),
					'accountants' => UserTypeSend::getAccountants(),
					'lawyers' => UserTypeSend::getLawyers(),
				]);
			} else {
				return "Данный раздел в разработке :) \n погодь пока что) кодер делате себе чаек ;)";
			}
		}

		/**
		 * @return array|\yii\web\Response
		 */
		public function actionSendDocument()
		{
			$modelDocLink = new UserDocumentLink();
			$modelFlowDoc = new UserDocumentFlow();

			if (Yii::$app->request->isAjax && $modelDocLink->load(Yii::$app->request->post())) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($modelDocLink);

			}if (Yii::$app->request->isAjax && $modelFlowDoc->load(Yii::$app->request->post())) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($modelFlowDoc);
			}
			if(Yii::$app -> request -> isPost)
			{
				$docuemntFile = UploadedFile::getInstance($modelFlowDoc, 'document');;
				$post = Yii::$app -> request -> post();
				if($modelFlowDoc -> setData($post,$docuemntFile));
					return $this -> redirect('/osobistij-kabinet/index');
			}
		}

		/**
		 * @return string
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

		/**
		 * @param $name
		 * @param $id
		 * Download file
		 * @return mixed
		 */
		public function actionDownloadDocument($name,$id)
		{
			$path = Yii::getAlias('@documentflow').'/documents/'.$id.'/'.$name;
			return Yii::$app->response->sendFile($path, $name)->send();
		}

		/**
		 * @param $name
		 * @param $id
		 *
		 * @return mixed
		 */
		public function actionDeleteDocument($name,$id)
		{
			$path = Yii::getAlias('@documentflow').'/documents/'.$id.'/'.$name;
			if(unlink($path)){
				Yii::$app->session->setFlash('message', 'Документ удален');
			}
		}
	}