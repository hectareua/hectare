<?php
namespace app\modules\web\controllers;

use app\models\AttributeValue;
use app\models\ClientTypeBonusRel;
use app\models\Currency;
use app\models\Department;
use app\models\DepartmentRating;
use app\models\Filter;
use app\models\ManagerTrophy;
use app\models\ManagerTrophyRelation;
use app\models\Manufacturer;
use app\models\OrderBonus;
use app\models\ProductBonus;
use app\models\User;
use app\modules\admin\models\ManagerForm;
use app\modules\admin\models\ManagerUserForm;
use DateTime;
use yii\base\Object;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\helpers\ArrayHelper;
use Yii;
use app\models\Client;
use app\models\Stock;
use app\models\Product;
use app\models\Stock1c;
use app\models\SalePlan;
use app\models\Manager;
use app\models\OrderStatus;
use app\models\UserReview;
use app\models\Category;
use app\models\OrderProductSearch;
use app\models\Order;
use app\models\OrderProduct;
use app\models\OrderProductAttributeValue;
use app\modules\web\models\OrderClientForm;
use app\modules\web\models\UserForm;
use app\modules\web\models\LoginForm;
use app\modules\web\models\PasswordResetRequestForm;
use app\modules\web\models\PasswordResetRequestForSMSCheckForm;
use app\modules\web\models\PasswordResetRequestForSMSGenerateForm;
use app\modules\web\models\ResetPasswordForm;
use yii\helpers\Url;
use yii\web\UploadedFile;

class UserController extends Controller
{

    public function beforeAction($action) {
        $parentCategories = Category::find()
            ->where(['parent_id' => null])
            ->with('categories', 'image')->orderBy('order')
            ->all();
        $this->view->params['parentCategories'] = $parentCategories;

        return parent::beforeAction($action);
    }

    public function actionIndex($category_id='', $manufacturer_ids='', $filter_ids='')
    {
        if (Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        $user = Yii::$app->user->identity;
		
		Yii::$app->assetManager->bundles = [
            'yii\bootstrap\BootstrapPluginAsset' => false,
        ];

        $orders = [];
        $ordersTotalCount = 0;
        $ordersTotalCost = 0;
        $orderStats = [];
        $client = new Client();

        if ($user->client)
        {
            $orders = $user->client->orders;
            $ordersViaPhone = $user->client->ordersViaPhone;
            $orders = array_merge($orders, $ordersViaPhone);
            //var_dump($user->client->id);
            //var_dump($user->client->ordersViaPhone);
            //exit;


            foreach ($orders as $order)
            {
                $ordersTotalCost += $order->price;
                if (empty($orderStats[$order->status_id]))
                    $orderStats[$order->status_id] = [
                        'amount' => 0,
                        'cost' => 0,
                        'status' => $order->status
                    ];
                $orderStats[$order->status_id]['amount']++;
                $orderStats[$order->status_id]['cost'] += $order->price;
            }
            $client = $user->client;
        }
        $ordersTotalCount = count($orders);
        $closedOrders = [];
        foreach ($orders as $i => $order) {
            if ($order->status_id == OrderStatus::CLOSED_ORDER_STATUS_ID)
            {
                unset($orders[$i]);
                $closedOrders[] = $order;
            }
        }
        foreach ($orders as $i => $order) {
            if ($order->status_id == OrderStatus::CLOSED_ORDER_STATUS_ID)
            {
                unset($orders[$i]);
                $closedOrders[] = $order;
            }
        }
		
		$stock = array();
		
		if ($user->clientType->stock) {

			$avids = [];
			
						//Временное решение по объединению производителей
			if($user->id == 421){
                $av = Yii::$app->db->createCommand("select id from attribute_value WHERE product_id in (select p.id from product p where p.manufacturer_id in (108,35))")->queryAll();
            }else{
                $av = Yii::$app->db->createCommand("select id from attribute_value WHERE product_id in (select p.id from product p where p.manufacturer_id = '".$user->ctypeid."')")->queryAll();
            }


			
			//$av = Yii::$app->db->createCommand("select id from attribute_value WHERE product_id in (select p.id from product p where p.manufacturer_id = '".$user->ctypeid."')")->queryAll();
			foreach ($av as $p) {
				$avids[] = $p['id'];
			}
			
			$products = Product::find()->all();
			$stocksi = Stock1c::find()->where(['not', ['representative_id' => null]])->groupBy(['representative_id'])->all();;
			$stockitem = array();
		/*	foreach ($av as $p) {
				$stockitem = array_merge($stock,Stock::findAll(['avid'=>$p['id']]));
			}
			$stock[0] = $stockitem; */
			$stock[0] =Yii::$app->db->createCommand("SELECT (sum(main) + sum(franch)) as quantity,sum(stock) as stock,avid,product_id FROM `stock` WHERE avid in (".implode(',',$avids).") GROUP BY avid")->queryAll();

			$stockForExcel = Stock::findBySql("SELECT avid,product_id,stockid, sum(franch) as franch, sum(main) as main FROM `stock`                                               
                                                  WHERE avid in (".implode(',',$avids).") GROUP BY stockid,avid,product_id ORDER BY stockid,avid");
			
			foreach ($stocksi as $s) {
				$stock1 = Stock1c::find()->select(['id'])->where(['representative_id' => $s->representative_id])->indexBy('id')->asArray()->all();

				//print_r(implode(',',array_keys($stock1)));die();
				$stock[$s->id] =Yii::$app->db->createCommand("SELECT (sum(main) + sum(franch)) as quantity,avid,product_id FROM `stock` WHERE stockid in (".implode(',',array_keys($stock1)).") AND avid in (".implode(',',$avids).") GROUP BY avid")->queryAll();
				
				//$stock[$s->id] =Yii::$app->db->createCommand("SELECT (sum(main) + sum(franch)) as quantity,avid,product_id FROM `stock` WHERE stockid=".$s->id." AND avid in (".implode(',',$avids).") GROUP BY product_id")->queryAll();	
			}
		}
		$searchOrder = new OrderProductSearch();
        $dataOrder = $searchOrder->search([Yii::$app->request->queryParams]);
        $searchOrderArch = new OrderProductSearch();
       // print_r(Yii::$app->request->queryParams); die;
      //  $status = ['status' => 7];
        $params = Yii::$app->request->queryParams;
        $params['status'] = 7;
        $dataOrderArch = $searchOrderArch->search($params);
        $userReview = new UserReview();
        if ($userReview->load(Yii::$app->request->post()))
        {
            $userReview->user_id = $user->id;
            $userReview->created_at = new \yii\db\Expression('NOW()');
            if ($userReview->save())
            {
                $userReview->trigger(UserReview::EVENT_ON_CREATE);
            }
        }
		$diffDays = 0;	
		if($user->clientType->stock_with_filter) {
            //Yii::$app->cache->flush();
			$categories = Category::find()->where(['not in','id',[26,150]])->all();

            if($category_id != '') {
                $activeCategory = Category::find()->where(['id' => $category_id])->one();
				$manufacturer_ids = array_filter(explode(",", $manufacturer_ids), function($i){return !!$i;});

                if(strlen($filter_ids) > 0)
                {
                    $filter_ids = array_filter(explode(",", $filter_ids), function($i){return (bool)$i;});
                    $items = Filter::find()->where(['id' => $filter_ids])->with(['filterToProducts'])->asArray()->all();
                    $items = ArrayHelper::getColumn($items, 'filterToProducts');
                    $ids = [];
                    foreach ($items as $item) {
                        foreach($item as $itemOne) {
                            $ids[] = $itemOne['product_id'];
                        }
                    }
                    // добавляем к модели условие на выборку
                }else{
                    $filter_ids = [];
                }
                $manufacturers = [];
                $productManufacturers = $activeCategory->getProducts()
                    ->select(['manufacturer_id', 'COUNT(1) as cnt'])
                    ->groupBy(['manufacturer_id'])
                    ->asArray()
                    ->all();

                $_manufacturers = Manufacturer::find()->where(['id' => array_column($productManufacturers, 'manufacturer_id')])->all();
                foreach ($_manufacturers as $manufacturer)
                    $manufacturers[$manufacturer->id] = ['manufacturer' => $manufacturer, 'checked' => false];
                foreach ($productManufacturers as $productManufacturer)
                    if ($productManufacturer['manufacturer_id'])
                        $manufacturers[$productManufacturer['manufacturer_id']]['count'] = $productManufacturer['cnt'];

                    foreach ($manufacturer_ids as $manufacturer_id)
                        if (isset($manufacturers[$manufacturer_id])) {
                            $manufacturers[$manufacturer_id]['checked'] = true;
                        } else {
                            throw new \yii\web\NotFoundHttpException();
                        }




                $pageFilters = [];
                $parentFilters = Filter::find()->where(['filter_id' => null])->with(['filters', 'filters.products' => function($query) use ($activeCategory, $manufacturer_ids) {
                    $query->andWhere(['category_id' => $activeCategory->id]);
                    if ($manufacturer_ids) {
                        $query->andWhere(['manufacturer_id' => $manufacturer_ids]);
                    }
                }])->all();
                $parentFilters = ArrayHelper::index($parentFilters, 'id');
                foreach ($parentFilters as $key => $parentFilter ) {
                    foreach ($parentFilter->filters as $childFilter) {
                        if(count($childFilter->products) > 0)
                            $pageFilters[$parentFilter->name][$childFilter->id] = [
                                'filter' => $childFilter,
                                'count' => count($childFilter->products),
                                'checked' => false,
                            ];
                    }
                }
                foreach ($manufacturers as $manufacturer) {
                    $manufacturer_id = $manufacturer['manufacturer']->id;
                    $_manufacturer_ids[$manufacturer_id] = $manufacturer_ids;
                    if (in_array($manufacturer_id, $_manufacturer_ids[$manufacturer_id] )){
                        $_manufacturer_ids[$manufacturer_id]  = array_filter($_manufacturer_ids[$manufacturer_id] , function($i)use($manufacturer_id){return $manufacturer_id != $i;});
                    } else {
                        $_manufacturer_ids[$manufacturer_id][] = $manufacturer_id;
                    }
                }

                $stockWithFilter = $this->addStockFilter($category_id, $manufacturer_ids, $ids);
            }else{
                $stockWithFilter = Yii::$app->db->createCommand("SELECT concat(p.name_uk,' (',ao.name_uk,')') as name, (sum(main)) as quantity, if(created_at>=ADDDATE(now(), INTERVAL -10 DAY),1,0) as newState FROM stock s
                                              inner join attribute_value av on av.id =  s.avid
                                              inner join product p on p.id=s.product_id
                                              inner join attribute_option ao on ao.id=av.option_id
                                              GROUP BY p.name_uk, ao.name_uk
                                              having sum(main)>0
                                              order by newState DESC,p.id")->queryAll();
            }

        }

        if($user->ctype == 9) {
            $departments = Department::find()->where(['in','id',['1','5','6']])->all();
        }else{
            $departments = Department::find()->all();
        }
        $dateLastVote = DepartmentRating::find()->select(['MAX(date_add)'])->where(['user_id' => $user->id])->scalar();
        $subordinates = new ActiveDataProvider(['query' => Manager::find()->where(['user_add_id' => $user->id])->orderBy('id DESC')]);

        $managerForm = new ManagerUserForm();
        $vote = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($dateLastVote)));
        $now = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        if($user->clientType->vote){
            $diffDays = $now->diff($vote)->days;
        }else{
            $diffDays = 1;
        }
        $fromDate = (new DateTime('first day of this month'))->format('Y-m-d');
        $toDate = (new DateTime('last day of this month'))->format('Y-m-d');
        $managerRating = Yii::$app->db->createCommand("
                                    select m.name, sum(sale_sum) as summ from sale_rating sr
                                    inner join manager m on m.code1c=sr.code1c
                                    where type=1 and m.manager_type<>1 and rating_date between '$fromDate' and '$toDate'
                                    group by m.name
                                    order by summ DESC
									limit 10
            ")->queryAll();
        $maxManagerRaiting = 0;
        $mounth = 1; //default
        $i = 0;

        foreach ($managerRating as $manager){
            if($mounth > $i){
                $maxManagerRaiting += $manager['summ'];
                $i++;
            }
        }

        $shopRating = Yii::$app->db->createCommand("
                                    select s.fullname, sum(sale_sum) as summ from sale_rating sr
                                    inner join stock1c s on s.name=sr.code1c
                                    where type=2 and rating_date between '$fromDate' and '$toDate'
                                    group by s.fullname
                                    order by summ DESC
									limit 10
            ")->queryAll();
        $maxShopRaiting = 0;
        $mounth = 1; //default
        $i = 0;

        foreach ($shopRating as $shop){
            if($mounth > $i){
                $maxShopRaiting += $shop['summ'];
                $i++;
            }
        }

        if($user->clientType->depart_eval) {
            $managerCode =  $user->manager->code1c;

            $saleByMonth = Yii::$app->db->createCommand("
                SELECT MONTH(rating_date) month, YEAR(rating_date) year, sum(sale_sum) sale_sum FROM sale_rating 
                WHERE YEAR(rating_date) > DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -3 YEAR),'%Y-01-01') and code1c = '$managerCode'
                group by MONTH(rating_date), YEAR(rating_date)
                order by year, month
            ")->queryAll();

            $yearMonthPlanPersonal = Yii::$app->db->createCommand("
                SELECT MONTH(plan_date) month, YEAR(plan_date) year, ifnull(sum(sale_sum),0) sale_sum, sum(plan.sum_plan) sum_plan, sum(ifnull(sale_sum,0)-plan.sum_plan) diff  
                FROM manager_sale_plan plan
                inner join manager m on m.id=plan.manager_id
                left join sale_rating sr on sr.code1c=m.code1c and  MONTH(plan_date) = MONTH(rating_date) and YEAR(plan_date) = YEAR(rating_date) 
                WHERE YEAR(plan_date) > DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -1 YEAR),'%Y-01-01') and m.code1c = '$managerCode' and plan.plan_year = 0
                group by MONTH(plan_date), YEAR(plan_date)
                order by year, month
            ")->queryAll();
            $month_uk = ['Січень','Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'];
            $month_ru = ['Январь','Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
            $chartArray = ArrayHelper::map($saleByMonth,'month','sale_sum','year');
            $colors = ['red','blue','orange'];
            $temp = array();
            $i = 0;
            foreach ($chartArray as $key => $value){
                array_push($temp, array(
                    'label' => $key,
                    'data' => $value,
                    'fill' => 'false',
                    'backgroundColor' => $colors[$i],
                    'borderColor' => $colors[$i]
                ));
                $i++;
            }
            $jsonChart = json_encode(array_values($temp),JSON_FORCE_OBJECT);
            //str_replace('"', "'",

            $beginYear = date('Y-01-01');
            $endYear = date('Y-12-31');
            $currentMonthPlan = SalePlan::find()->select(['plan_sum'])->where(['between','plan_date',$fromDate,$toDate])->scalar();
            $currentYearPlan = SalePlan::find()->select(['plan_sum'])->where(['between','plan_date',$beginYear,$endYear])->andWhere(['plan_year' => 1])->scalar();
            if($user->ctype == 10){
                $currentMonthRating = DepartmentRating::find()->select(['avg(mark)'])->where(['between','date_add',$fromDate,$toDate])->andWhere(['depart_id' => '5'])->scalar();
            }
            //$currentMonthSales = SaleRating::find()->select(['sum(sale_sum)'])->where(['between','rating_date',$fromDate,$toDate])->andWhere(['type' => 1])->scalar();
            $currentMonthSales = Yii::$app->db->createCommand("
                                    select sum(sale_sum) as summ from sale_rating sr
                                    inner join manager m on m.code1c=sr.code1c
                                    where type=1 and rating_date between '$fromDate' and '$toDate'
                                    ")->queryScalar();
            if($currentYearPlan){
                $currentYearSales = Yii::$app->db->createCommand("
                                    select sum(sale_sum) as summ from sale_rating sr
                                    inner join manager m on m.code1c=sr.code1c
                                    where type=1 and rating_date between '$beginYear' and '$endYear'
                                    ")->queryScalar();
            }

            $currentManagerBonus = Yii::$app->db->createCommand("
                select sum(sum_bonus) as sum_bonus from manager_bonus
                where bonus_date between '$fromDate' and '$toDate' and manager_code1c = :code1c
            ")->bindValue(':code1c', $user->manager->code1c)
              ->queryScalar();
            $curManagerOwnSale = Yii::$app->db->createCommand("
               select ifnull(sum(sale_sum),0) as sale_sum, ifnull(sum(sum_plan),0) sum_plan  from manager_sale_plan msp 
                                    inner join manager m on m.id=msp.manager_id
                                    left outer join sale_rating sr on sr.code1c=m.code1c  and rating_date between '$fromDate' and '$toDate' 
                                    where plan_date between '$fromDate' and '$toDate' and manager_id = :manager_id and msp.plan_year = 0
            ")->bindValue(':manager_id', $user->manager->id)
                ->queryOne();
            $curManagerOwnYearSale = Yii::$app->db->createCommand("
               select ifnull(sum(sale_sum),0) as sale_sum, ifnull(sum(DISTINCT sum_plan),0) sum_plan  from manager_sale_plan msp 
                                    inner join manager m on m.id=msp.manager_id
                                    left outer join sale_rating sr on sr.code1c=m.code1c  and rating_date between '$beginYear' and '$endYear' 
                                    where plan_date between '$beginYear' and '$endYear' and manager_id = :manager_id and msp.plan_year = 1
            ")->bindValue(':manager_id', $user->manager->id)
                ->queryOne();
            //print_r($currentManagerBonus);die;
            $currentMonthData = [
                'currentMonthPlan' => $currentMonthPlan,
                'currentMonthSales' => $currentMonthSales,
                'currentMonthRating' => $currentMonthRating,
                'currentManagerBonus' => $currentManagerBonus,
                'curManagerOwnSale' => $curManagerOwnSale,

            ];
            $currentYearData = [
                'currentYearPlan' => $currentYearPlan,
                'currentYearSales' => $currentYearSales,
                'curManagerOwnYearSale' => $curManagerOwnYearSale
            ];
        }

        //бонусы
        if($user->clientType->bonus) {
            if ($user->ctype == 10){
                $fromDate = date('Y-01-01');
                $toDate = date('Y-12-31');
                $managerRel = '';
            }else{
                $managerRel = 'cts.manager_code1c=m.code1c and';
            }

            /*$clientTypeBonusRel = new ClientTypeBonusRel();
            print_r($clientTypeBonusRel->checkFinishedBonus());*/

            //*(SELECT rate from currency where code='USD') as money_plan
            $bonusForManagers = Yii::$app->db->createCommand("
                    select ctbr.id, ctb.id as bonus_id, ctb.name_bonus_uk, ctb.name_bonus_ru, ctb.condition_uk, ctb.condition_ru, ctb.show_condition, 
                    ctbr.confirm, ctb.bonus_one, ctb.stage, ctb.percent_stage, 
                    ctb.money_plan, ctb.bonus_all, mf.logo, ctb.currency,ctb.unit, sum(cts.qty*ifnull(a_option.multiplier/10000,1/10000)) as sum_unit_sale,
                    ctb.qty_sale, ifnull(sum(cts.qty),0) sum_qty_sale, ifnull(sum(cts.sale_sum),0) sale_sum,
                    ifnull(sum(cts.sale_sum),0)/(SELECT rate from currency where code='USD') as sale_sum_usd 
                    from client_type_bonus_rel ctbr
                        inner join client_type_bonus ctb on ctb.id=ctbr.ctype_bonus_id
                        inner join user u on u.id=ctbr.user_id
                        inner join manager m on m.id=u.manager_id
                        inner join  manufacturer mf on mf.id=ctb.manufacturer_id
                        left outer join client_type_sale cts on $managerRel cts.manufacturer_code1c=mf.code1c and cts.sale_date between ctb.date_from and ctb.date_to
                        left outer join  attribute_value av on av.code1c=cts.product_code1c
                        left outer join attribute_option a_option on a_option.id = av.option_id
                    where ctbr.user_id = $user->id and ctb.attribute_value_id is null and ctb.ctype_bonus_av_rel is null
                    group by ctbr.id, ctb.id, ctb.name_bonus_uk, ctb.name_bonus_ru, ctb.condition_ru, 
                    ctb.show_condition, ctbr.confirm, ctbr.confirm,ctb.bonus_one, ctb.stage, ctb.percent_stage, 
                    ctb.money_plan, ctb.bonus_all,mf.logo,ctb.qty_sale,ctb.currency,ctb.unit
                    UNION ALL
                    select ctbr.id, ctb.id as bonus_id, ctb.name_bonus_uk, ctb.name_bonus_ru, ctb.condition_uk, ctb.condition_ru, ctb.show_condition, 
                    ctbr.confirm, ctb.bonus_one, ctb.stage, ctb.percent_stage, 
                    ctb.money_plan, ctb.bonus_all, mf.logo, ctb.currency,ctb.unit, sum(cts.qty*ifnull(a_option.multiplier/10000,1/10000)) as sum_unit_sale,
                    ctb.qty_sale, ifnull(sum(cts.qty),0) sum_qty_sale, ifnull(sum(cts.sale_sum),0) sale_sum,
                    ifnull(sum(cts.sale_sum),0)/(SELECT rate from currency where code='USD') as sale_sum_usd 
                    from client_type_bonus_rel ctbr
                        inner join client_type_bonus ctb on ctb.id=ctbr.ctype_bonus_id
                        inner join user u on u.id=ctbr.user_id
                        inner join manager m on m.id=u.manager_id
                        inner join  manufacturer mf on mf.id=ctb.manufacturer_id
                        inner join  attribute_value av on av.id=ctb.attribute_value_id
                        inner join attribute_option a_option on a_option.id = av.option_id
                        left outer join client_type_sale cts on $managerRel cts.product_code1c=av.code1c and cts.sale_date between ctb.date_from and ctb.date_to
                    where ctbr.user_id = $user->id and ctb.attribute_value_id is not null
                    group by ctbr.id, ctb.id, ctb.name_bonus_uk, ctb.name_bonus_ru, ctb.condition_ru, ctb.show_condition, ctbr.confirm, 
                    ctbr.confirm,ctb.bonus_one, ctb.stage, ctb.percent_stage, ctb.money_plan, ctb.bonus_all,mf.logo,ctb.qty_sale,ctb.currency,ctb.unit
                     UNION ALL
                    select ctbr.id, ctb.id as bonus_id, ctb.name_bonus_uk, ctb.name_bonus_ru, ctb.condition_uk, ctb.condition_ru, ctb.show_condition, 
                    ctbr.confirm, ctb.bonus_one, ctb.stage, ctb.percent_stage, 
                    ctb.money_plan, ctb.bonus_all, mf.logo, ctb.currency,ctb.unit, sum(cts.qty*ifnull(a_option.multiplier/10000,1/10000)) as sum_unit_sale,
                    ctb.qty_sale, ifnull(sum(cts.qty),0) sum_qty_sale, ifnull(sum(cts.sale_sum),0) sale_sum,
                    ifnull(sum(cts.sale_sum),0)/(SELECT rate from currency where code='USD') as sale_sum_usd 
                    from client_type_bonus_rel ctbr
                        inner join client_type_bonus ctb on ctb.id=ctbr.ctype_bonus_id
                        inner join client_type_bonus_attribute attrs on attrs.rel=ctb.ctype_bonus_av_rel
                        inner join user u on u.id=ctbr.user_id
                        inner join manager m on m.id=u.manager_id
                        inner join  manufacturer mf on mf.id=ctb.manufacturer_id
                        inner join  attribute_value av on av.id=attrs.attribute_value_id
                        inner join attribute_option a_option on a_option.id = av.option_id
                        left outer join client_type_sale cts on $managerRel cts.product_code1c=av.code1c and cts.sale_date between ctb.date_from and ctb.date_to
                    where ctbr.user_id = $user->id
                    group by ctbr.id, ctb.id, ctb.name_bonus_uk, ctb.name_bonus_ru, ctb.condition_ru, ctb.show_condition, ctbr.confirm, 
                    ctbr.confirm,ctb.bonus_one, ctb.stage, ctb.percent_stage, ctb.money_plan, ctb.bonus_all,mf.logo,ctb.qty_sale,ctb.currency,ctb.unit
                    
                    order by confirm DESC
                    ")->queryAll();

            $bonusShow = Yii::$app->db->createCommand("
                    select count(*) from client_type_bonus_rel
                    where user_id = $user->id and created_at between '$fromDate' and '$toDate' and show_ones = 0
                    ")->queryScalar();
        }


        if (Yii::$app->request->post()) {
            if ($managerForm->load(Yii::$app->request->post())) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $managerForm->imageFile = UploadedFile::getInstance($managerForm, 'imageFile');
                    $managerForm->job = 'Співробітник магазину';
                    $managerForm->name = $managerForm->lastName.' '.$managerForm->firstName;
                    $managerForm->manager_type = 3;
                    $managerForm->user_add_id = $user->id;
                    $managerForm->saveForm();
                    $newUser = new User();
                    $newClient = new Client();
                    $newUser->login = \app\helpers\PhoneDigits::get($managerForm->phone);

                    $newUser->password_hash = $newUser->hashPassword($managerForm->pass);

                    $newUser->auth_key = md5(uniqid());

                    $newUser->email = $managerForm->email;
                    $newUser->ctype = 8; //сотрудник магазина

                    $newUser->save();
                    $newClient->user_id = $newUser->id;
                    $newClient->billing_first_name = $managerForm->firstName;
                    $newClient->billing_last_name = $managerForm->lastName;
                    $newClient->billing_phone = \app\helpers\PhoneDigits::get($managerForm->phone);
                    $newClient->save();

                    $this->sendMail($managerForm->phone, $managerForm->pass, $managerForm->firstName, $managerForm->lastName);
                    $transaction->commit();


                    $managerForm = new ManagerUserForm();

                } catch(\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('warning-manager', Yii::t('web', 'К сожалению сотрудник с телефоном ').
                        $managerForm->phone.Yii::t('web', ' уже существует'));

                } catch(\Throwable $e) {
                    $transaction->rollBack();

                }
            }else {
                $req = Yii::$app->request->bodyParams;
                if(is_array($req['DepartmentRating'])){
                    foreach ($req['DepartmentRating'] as $key => $value) {
                        $departRating = new DepartmentRating();
                        $departRating->user_id = $user->id;
                        $departRating->depart_id = $key;
                        $departRating->mark = $value;
                        $departRating->save();
                    }
                    Yii::$app->session->setFlash('success', Yii::t('web', 'Ваши голоса приняты. Спасибо, что приняли участие! Следующее голосование будет через 2 недели.'));
                    return $this->redirect('index');
                }

            }
        }

        //bonus product
        $productBonus = ProductBonus::find()->where(['status' => 1])->all();
        $userTrophies = ManagerTrophyRelation::find()->where(['manager_id' => $user->manager_id])->all();
        $manager = $user->manager;
        $trophyArr = $this->checkTrophy($manager->code1c);
        $trophyRating = ManagerTrophy::find()->where(['trophy_type_id' => 2])->all();


        $manager = $user->manager;
        $userPartnerImg = Manufacturer::find()->select(['logo','name'])->where(['id' => $user->ctypeid])->one();
		
		if($user->clientType->create_order) {
        $orderModel = new OrderClientForm();
        $products = Product::find()->select(['a.id', "concat(product.name_uk,' - (',o.name_uk, ')') as names", 'a.price'])->joinWith(['attributeValues a' => function($q) {
            $q->joinWith('option o');
        }])->orderBy('product.id')->asArray()->all();
        $productsArray = ArrayHelper::map($products, 'id', 'names');

            if ($orderModel->load(Yii::$app->request->post()) && $orderModel->validate()) {
                $order = new Order();
                $client = Client::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
                $valuesOrder = [
                    'client_id' => $client->id,
                    'payment_system_id' => 1, //1 - наложка
                    'status_id' => 1, //1 - не подтвержден
                    'billing_fullname' => $client->billingFullName,
                    'billing_city' => $client->billing_city,
                    'billing_phone' => $client->billing_phone,
                    'billing_email' => $client->user->email,
                    'delivery_fullname' => $client->billingFullName,
                    'delivery_address' => $client->delivery_address,
                    'delivery_city' => $client->delivery_city,
                    'delivery_phone' => $client->delivery_phone,
					'comment' => $orderModel->comment,
                ];

                $order->attributes = $valuesOrder;
                $order->save();
                //Yii::$app->db->schema->refresh(); //при добавлении нового поля в БД использовать
                foreach ($orderModel->data as $value) {
                    $product = AttributeValue::find()->where(['id' => $value['product_id']])->one();
                    $orderProduct = new OrderProduct();
                    $orderAV = new OrderProductAttributeValue();
                    $orderProductValue = [
                        'order_id' => $order->id,
                        'product_id' => $product->product_id,
                        'amount' => $value['amount'] != null ? $value['amount'] : 1,
                        'price' => $value['price'] != null ? $value['price'] : $product->part_price,
                    ];
                    $orderProduct->attributes = $orderProductValue;

                    $orderProduct->save();
                    $orderAV->order_product_id = $orderProduct->id;
                    $orderAV->attribute_value_id = $value['product_id'];
                    $orderAV->save();
                }
                Yii::$app->session->setFlash('success', Yii::t('web', 'Заказ') . ' №<b>' . $order->id . '</b> ' . Yii::t('web', 'успешно создан. Спасибо, что Вы с нами!'));
                //  $successMassage = Yii::t('web', 'Ваш заказ успешно создан');
                return $this->redirect('index');


            }
        }

        return $this->render('index', compact('user', 'client', 'orders', 'closedOrders', 'orderStats',
            'ordersTotalCount', 'ordersTotalCost', 'userReview', 'manager','stocksi','stock','products', 'userPartnerImg',
            'stockForExcel', 'dataOrder','searchOrder','dataOrderArch', 'searchOrderArch','orderModel','productsArray', 'products', 'departments','diffDays',
			'managerForm', 'subordinates', 'managerRating','maxManagerRaiting', 'shopRating', 'maxShopRaiting','productBonus','userTrophies','trophyArr',
            'trophyRating','categories','activeCategory','filter_ids','pageFilters', 'manufacturers', '_manufacturer_ids', 'manufacturer_ids',
            'currentMonthData','bonusForManagers','stockWithFilter','bonusShow','currentYearData', 'jsonChart','yearMonthPlanPersonal','month_uk', 'month_ru'));
    }

    public function actionEdit()
    {

        if (Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        $user = Yii::$app->user->identity;
        $model = $user->client;
        if (!$model)
            $model = new Client();

        if ($user->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()))
        {
            $model->delivery_phone = \app\helpers\PhoneDigits::get($model->delivery_phone);
            $model->billing_phone = \app\helpers\PhoneDigits::get($model->billing_phone);
            if (!$model->delivery_differs)
            {
                $model->delivery_first_name = $model->billing_first_name;
                $model->delivery_middle_name = $model->billing_middle_name;
                $model->delivery_last_name = $model->billing_last_name;
                $model->delivery_country_id = $model->billing_country_id;
                $model->delivery_region = $model->billing_region;
                $model->delivery_city = $model->billing_city;
                $model->delivery_phone = $model->billing_phone;
                $model->delivery_address = $model->billing_address;
                $model->delivery_postcode = $model->billing_postcode;
            }

            if ($user->save() && $model->save())
                return $this->redirect('index');
        }

        return $this->render('edit', compact('model', 'user'));
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $done = false;
        $user = new UserForm();
        $client = new Client();
        if ($user->load(Yii::$app->request->post()))
        {
            $done = true;
            $user->generateAuthKey();
            $user->login =  \app\helpers\PhoneDigits::get(Yii::$app->request->post('Client')['billing_phone']);
            //$user->manager_id = Manager::findOne('id'!=null)->id;
            if (!$user->validate())
            {
                $done = false;
            }
        }
        if ($done)
        {
            if ($client->load(Yii::$app->request->post()))
            {
                if (!$client->validate())
                {
                    $done = false;
                }
            }
        }
        if ($done)
        {
            $client->billing_phone = \app\helpers\PhoneDigits::get($client->billing_phone);
            $user->save();
            $client->link('user', $user);
            Yii::$app->user->login($user);
            return $this->redirect(['index']);
        }

        return $this->render('register', compact('user', 'client'));
    }

    public function actionRecoveryEmail()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->sendEmail()) {
                    return $this->redirect(['recovery-success']);
                }
            }
        }
        return $this->render('recovery_email', compact('model'));
    }

    public function actionRecoverySms()
    {
        $model = new PasswordResetRequestForSMSGenerateForm();

                if ($model->load(Yii::$app->request->post())) {
                    $model->billing_phone = \app\helpers\PhoneDigits::get($model->billing_phone);

                    if ($model->validate()) {
                        $user = $model->getUserByPhone();
                        $this->_saveBillingPhone($model->billing_phone);

                        if (!$user->validation_code) {
                            if ($model->sendSMS()) {
                                return $this->redirect(['user/recovery-sms-check']);
                            } else {
                                return $this->redirect(['user/recovery-sms']);
                            }
                        } else {
                            $user->validation_code = NULL;
                            $user->save();
                            return $this->redirect(['user/recovery-sms']);
                        }
                    }
                }

                return $this->render('recovery_sms_generate', compact('model'));
    }

    public function actionRecoverySmsCheck()
    {
        $model = new PasswordResetRequestForSMSCheckForm();

        if ($model->load(Yii::$app->request->post())) {
                $model->billing_phone = $this->_loadBillingPhone();
                $this->_saveBillingPhone(NUll);
                $user = $model->getUserByPhone();

                    if ($user) {
                        if ($model->userHasValidationCode()) {

                            if ($user->validation_code) {
                                if ($user->validateValidationCode($model->validation_code)) {

                                    if (!empty($user->password_reset_token)) {
                                        if(!$user->isPasswordResetTokenValid($user->password_reset_token)) {
                                            $user->generatePasswordResetToken();
                                            $user->save();
                                        }
                                    } else {
                                        $user->generatePasswordResetToken();
                                        $user->save();
                                    }
                                    $user->validation_code = NULL;
                                    $user->save();
                                    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['web/user/reset-password', 'token' => $user->password_reset_token]);
                                    return $this->redirect($resetLink);
                                } else {
                                    $user->validation_code = NULL;
                                    $user->save();
                                    return $this->redirect(['user/recovery-sms']);
                                }
                            } else {
                                return $this->redirect(['user/recovery-sms']);
                            }
                        }
                        $this->redirect(['user/recovery-sms']);
                    } else {
                        return $this->redirect(['user/recovery-sms']);
                    }
                 }

       return $this->render('recovery_sms_check', compact('model'));
    }

    public function actionRecovery()
    {
        $model = new PasswordResetRequestForm();
        return $this->render('recovery', compact('model'));
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (\yii\base\InvalidParamException $e) {
            throw new \yii\web\BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRecoverySuccess()
    {
        return $this->render('recoverySuccess');
    }

    public function actionLogin($returnUrl = null)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->username = \app\helpers\PhoneDigits::get($model->username);
            if ($model->login()) {
                if (!$returnUrl)
                    $returnUrl = ['index'];
                return $this->redirect($returnUrl);
            }
        }
        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
	
	public function actionExportOrders(){
        $user = Yii::$app->user->identity->id;
        $client = Client::find()->select('id')->where(['user_id' => $user])->one();
        $orders = Order::find()->
        where(['status_id' => 1])
            ->andWhere(['and', ['client_id' => $client], ['status_id' => 1]])
            ->all();
        //print_r($client); die;
        $ctype = Yii::$app->user->identity->ctype;
        if($ctype == 6 || $ctype == 3){
             Order::updateAll(['status_id' => 2], ['and', ['client_id' => $client], ['status_id' => 1]]);
             return count($orders);
        }
       // var_dump($array);
        return false;
    }
	
	public function actionGetProductPrice(){
        if(Yii::$app->request->isAjax) {
            $id = Yii::$app->request->get('id');
            $price = AttributeValue::find()->where(['id'=>$id])->one();
            return $price->part_price ? number_format($price->part_price, 2, '.', '') : number_format($price->price, 2, '.', '');
        }
    }
	
	public function actionDelete($id)
    {
        try {
            Order::findOne($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (\Exception $e) {
        }
        return true;

    }
	
	public function actionDeleteManager($id)
    {

        try {
            $manager = Manager::find()->where(['id' => $id])->one();
            $manager->delete();
            $user = User::find()->where(['login' => \app\helpers\PhoneDigits::get($manager->phone)])->one();
            $user->delete();

        } catch (StaleObjectException $e) {
        } catch (\Exception $e) {
        }

        Yii::$app->session->setFlash('success-manager', Yii::t('web', 'Вы удалили сотрудника ').$manager->name);
        $this->actionIndex();

    }
	
	public function actionAddProductToOrderBonus(){
        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');
            $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
            $productBonus = ProductBonus::find()->where(['id'=>$id])->one();
            $userBonus = $user->bonus;
            if($userBonus < $productBonus->price){
                return false;
            }else{
                $order = new OrderBonus();
                $order->user_id = +$user->id;
                $order->product_bonus_id = +$id;
                $order->price = +$productBonus->price;
                $order->ordered_at = date('Y-m-d H:i:s');
                if($order->save()){
                    $bonus = $user->bonus - $productBonus->price;
                    $user->bonus = $bonus;
                    $user->save();
                }
                return true;
            }

        }


    }
	
    private function sendMail($phone, $pass, $name, $surname){
        $receiverEmail = \app\models\SiteInfo::loadData()->contacts_email;
        Yii::$app
            ->mailer
            ->compose(
                ['html' => 'userAdd-html', 'text' => 'userAdd-text'],
                ['phone' => $phone, 'pass' => $pass, 'name' => $name, 'surname' =>$surname]
            )
            ->setFrom(['info@hectare.com.ua' => Yii::$app->name])
            ->setTo('shpytko.hectare@gmail.com')
            ->setSubject("Додано нового співробітника")
            ->send();

    }
	
	private function checkTrophy($managerCode){
        $ratingSum = Yii::$app->db->createCommand("
                                    select sum(sale_sum) as summ from sale_rating
                                    where code1c = '$managerCode'
            ")->queryOne();
       // print_r($ratingSum['summ']);
        $trophy = ManagerTrophy::find()->where(['and',['<=','min_sale',$ratingSum['summ']],['>','max_sale',$ratingSum['summ']]])->one();
        $countStars = 1+($ratingSum['summ']-$trophy->min_sale)/($trophy->step ? $trophy->step:0.0001);

        $showTrophy = array(
            'trophyId' => $trophy->id,
            'stars' => (int)$countStars
        );
        return $showTrophy;
    }
	
private function addStockFilter($category_id, $manufacturer_ids, $filter_ids){
        $manufacturer_ids = implode(',', $manufacturer_ids);
		if($filter_ids)
        $filter_ids = implode(',', $filter_ids);
        ///print_r($filter_ids);
        $manufacturer =  $manufacturer_ids ? " and manufacturer_id in ($manufacturer_ids) ":" ";
        $filter =  $filter_ids ? " and p.id in ($filter_ids) ":" ";
        $query = "SELECT concat(p.name_uk,' (',ao.name_uk,')') as name, (sum(main)) as quantity, if(created_at>=ADDDATE(now(), INTERVAL -10 DAY),1,0) as newState FROM stock s
                                              inner join attribute_value av on av.id =  s.avid
                                              inner join product p on p.id=s.product_id
                                              inner join attribute_option ao on ao.id=av.option_id
                                              where p.category_id = $category_id 
                                              $manufacturer
                                              $filter
                                              GROUP BY p.name_uk, ao.name_uk
                                              having sum(main)>0
                                              order by newState DESC,p.id";

        $stock = Yii::$app->db->createCommand($query)->queryAll();
        return $stock;
    }
	
	public function actionConfirmBonus(){
        if(Yii::$app->request->isAjax){
            Yii::$app->db->createCommand("
                update client_type_bonus_rel set confirm = :status where id = :id
            ")
            ->bindValue(':id',Yii::$app->request->post('id'))
            ->bindValue(':status', '1')
            ->execute();
            return true;
        }else{
            return false;
        }
    }

    public function actionBonusShow(){
        $user = Yii::$app->user->identity->id;

        Yii::$app->db->createCommand("
        update client_type_bonus_rel set show_ones = 1 where user_id = :user_id  
        ")
        ->bindValue(':user_id', $user)
        ->execute();

        return true;
    }

    public function actionGetConditionText(){
        if(Yii::$app->request->isAjax) {
            $id= Yii::$app->request->post('bonusId');
            $lang= Yii::$app->request->post('lang');
            $condition = Yii::$app->db->createCommand("select condition_".$lang." from client_type_bonus where id=:id")
                ->bindValue(':id', $id)
                ->queryScalar();
            return $condition;
        }
        return false;
    }
  
}
