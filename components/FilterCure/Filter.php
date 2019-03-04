<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-12
	 * Time: 11:05
	 */

	namespace app\components\FilterCure;
	use app\models\Manufacturer;
	use Yii;
	use yii\helpers\ArrayHelper;

	class Filter extends \yii\base\Widget
	{
		/**
		 * @var object
		 */
		public $plants;

		/**
		 * @var object
		 */
		public $phases;

		/**
		 * @var object
		 */
		public $problems;

		/**
		 * @var object
		 */
		public $products;

		/**
		 * @var object
		 */
		public $images;

		/**
		 * @var integer
		 */
		public $cure_id;

		/**
		 * @var array
		 */
		public $cure;

		/**
		 * @var string
		 */
		public $sufix = '';

		/**
		 * @var object
		 */
		public $manufacture;


		public function init()
		{
			parent::init(); // TODO: Change the autogenerated stub
		}

		/**
		 * @return string
		 */
		public function run()
		{
			if (Yii::$app -> language =='uk') $this -> sufix ='_uk';
			$objManufactureId = null;
			if(!empty($this -> manufacture -> id) && isset($this -> manufacture -> id)) $objManufactureId = $this -> manufacture -> id;

			$data = $this -> setData();
			$dataList = $this -> setListData();

			return $this -> render('block.php',[
				'plants' => $data['plants'],
				'phases' => $data['phases'],
				'problems' => $data['problems'],
				'products' => $data['products'],
				'images' => $data['images'],
				'cure_id' => $this -> cure_id,
				'cure' => $this -> cure,
				'suff' => $this ->  sufix,
				'manufacturer_select' => $this ->ManufactureNameArray(),
				'listprivate' => $dataList['listprivate'],
				'list' => $dataList['list'],
				'manufacture_id' => $objManufactureId
			]);
		}

		/**
		 * @return array
		 */
		protected function ManufactureNameArray() {
			$manufacturers = Manufacturer::find()->orderBy('name')->asArray()->all();
			return ArrayHelper::map($manufacturers, 'id', 'name');
		}

		/**
		 * @return array
		 */
		public function setData() {

			$pl = array();
			foreach ($this -> plants as $p) {
				$pl[$p['id']] = $p;
			}
			$plants = $pl;

			$pl = array();
			foreach ($this -> phases as $p) {
				$pl[$p['id']] = $p;
			}

			$phases = $pl;

			$pl = array();
			foreach ($this -> problems as $p) {
				$pl[$p['id']] = $p;
			}
			$problems = $pl;

			$pl = array();
			foreach ($this -> products as $p) {
				$pl[$p['id']] = $p;
			}
			$products = $pl;

			$im = array();
			foreach ($this -> images as $p) {
				$im[$p['id']] = $p;
			}
			$images = $im;


			return [
				'plants' => $plants,
				'phases' => $phases,
				'problems' => $problems,
				'products' => $products,
				'images' => $images
			];

		}

		/**
		 * @return array
		 */
		public function setListData($list_cure = null)
		{
			if($list_cure != null) {
				$cure_data = $list_cure;
			} else {
				$cure_data  = $this -> cure;
			}
			$list = [];
			$listprivate = [];
			if(!empty($cure_data)) {
				foreach ($cure_data as $c) {
					$listprivate[$c['plant_id']][] = $c['product_id'];
					$list[$c['plant_id']][$c['phase_id']]['problems'][] = $c['problem_id'];
					$list[$c['plant_id']][$c['phase_id']]['products'][] = $c['product_id'];
					$list[$c['plant_id']][$c['phase_id']]['problems1'][$c['problem_id']][] = $c['product_id'];
				}
			}
			return [
				'listprivate' => $listprivate,
				'list' => $list
			];
		}
	}