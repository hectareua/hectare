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
	use app\modules\documentflow\components\damp;
	use app\modules\documentflow\models\uploadForm;
	use app\modules\documentflow\models\UserDocumentFlow;
	use app\modules\documentflow\models\UserDocumentLink;
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

//		public $ip_dev = '217.77.212.240';
		public $ip_dev = '212.92.238.35';

		public function index()
		{
			$user_type = Yii::$app -> user -> identity -> ctype;
			$modelDocLink = new UserDocumentLink();
			$modelFlowDoc = new UserDocumentFlow();
			return $this -> render('index',[
				'documents' => UserDocumentLink::getDocument(),
				'modelFlowDoc' => $modelFlowDoc,
				'modelDocLink' => $modelDocLink,
				'selectData' => $this -> getTypeSelectForUser(),
				'user_type' => $user_type
			]);
		}

		/**
		 * @return array
		 * @throws \yii\db\Exception
		 */
		private function getTypeSelectForUser()
		{
			switch(Yii::$app -> user -> identity -> ctype)
			{
				case UserTypeSend::USER_TYPE_PARTNERS :
					$result = [
						'Бугалтер' => UserTypeSend::getAccountants(),
						'Юрист' => UserTypeSend::getLawyers()
					];
					break;
				case UserTypeSend::USER_TYPE_MANUFACTURERS :
					$result = [
						'Бугалтер' => UserTypeSend::getAccountants(),
						'Юрист' => UserTypeSend::getLawyers()
					];
					 break;
				case UserTypeSend::USER_TYPE_ACCOUNTANTS:
					$result = [
						'Партнер' => UserTypeSend::getPartners(),
						'Производитель' => UserTypeSend::getManufacturers(),
						'Юрист' => UserTypeSend::getLawyers()
					];
					break;
				case UserTypeSend::USER_TYPE_LAWYERS :
					$result = [
						'Партнер' => UserTypeSend::getPartners(),
						'Производитель' => UserTypeSend::getManufacturers(),
						'Бугалтер' => UserTypeSend::getAccountants()
					];
					break;
			}
			return $result;
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
		public function actionDownloadDocument($pathdoc)
		{
			$name = array_reverse(explode('/',$pathdoc))[0];
			return Yii::$app->response->sendFile($pathdoc, $name)->send();
		}

		/**
		 * @return \yii\web\Response
		 * return - request on send document
		 */
		public function actionSetNewPathDocument()
		{
			$modelFlowDoc = new UserDocumentFlow();
			$modelUpload = new uploadForm();
			$post = Yii::$app -> request -> post();
			$docuemntFile = UploadedFile::getInstance($modelFlowDoc, 'path_to_doc');
			if($modelFlowDoc -> load($post)) {
				$modelUpload -> document = $docuemntFile;
				$path = $modelUpload->uploadDocument(
					$post['UserDocumentLink']['user_id_from']
				);

				$model = UserDocumentFlow::findOne($post['UserDocumentLink']['id_flow_doc']);
				$model->scenario = UserDocumentFlow::SCENARIO_SET_PATH_DOC;
				$model  -> path_to_doc = $path;
				$model -> save();

				UserDocumentLink::setStatusSendFrom(
					$post['UserDocumentLink']['id_flow_doc'],
					$post['UserDocumentLink']['return_status']
				);
			}

			return $this -> redirect('/osobistij-kabinet/index');
		}

		/**
		 * change status document
		 */
		public function actionSetStatusDoc()
		{
			$post = Yii::$app -> request -> post();
			$model = UserDocumentFlow::findOne($post['UserDocumentFlow']['id_flow_doc']);
			$model->scenario = UserDocumentFlow::SCENARIO_STATUS;
			$model -> status = $post['UserDocumentFlow']['status'];
			$model -> save();
			return $this -> redirect('/osobistij-kabinet/index');
		}
	}