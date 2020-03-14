<?php
//new version of shop with goods and Liqpay payment check out

//STOPPED=> Do next => onClick "Add to cart" in modal adds id/quantity to LocalStorage. On openening Modal check quantity regarding LocalStorage to display
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\SignupForm;
use app\models\AuthItem; //table with Rbac roles

use app\models\LiqPay\BuyerForm;


use app\models\ChangePasswordForm;

class ShopLiqpayController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
				
				//To show message to unlogged users. Without this unlogged users will be just redirected to login page
				'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\NotFoundHttpException("Only logged users are permitted(set in behaviors)!!!");
                 },
				 //END To show message to unlogged users. Without this unlogged users will be just redirected to login page
				 
				//following actions are available to logged users only 
                'only' => ['logout', 'add-admin', 'get-token', 'change-password'], //actionGetToken, actionChangePassword
                'rules' => [
                    [
                        'actions' => ['logout', 'add-admin', 'get-token', 'change-password'], //actionGetToken, actionChangePassword
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					
					// RBAC roles: actionAbout is avialable for users with role {adminX}-----
					[
                    'actions' => ['about'],
                    'allow' => true,
                    'roles' => ['adminX'],
                    ],
					//End RBAC roles: actionAbout is avialable for users with role {adminX}-----
					
                ],
            ],
			
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

	
	
	
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
		    //must be commented if want to use person actionError, otherwise errors will be handled with built vendor/yii\web\ErrorAction
            'error' => [
                'class' => 'yii\web\ErrorAction',  //pre-difined error handler, comment if want to use my personal
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	
	
	
	
/*
  public function beforeAction($action)
  {
	
    Yii::$app->session['beforelogin'] = Yii::app()->request->pathInfo;`
    return parent::beforeAction($action);
  }
	
*/
	
	
	
	
	
    /**
     * Displays homepage.
     *
     * @return string
     */
	     
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
    public function actionIndex()
    {
        return $this->render('index');
    }

	


	
	
	 /**
     * Displays Cart.
     *
     */
	     
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
    public function actionCart()
    {
		//$cart = $_SESSION['cart'];
        return $this->render('cart', [
            //'model' => $cart,
        ]);
    }

	
	
	
	/**
     * Add product to cart via ajax
     *
     */     
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
    public function actionAddProductToCart()
    {
        //$found = Messages::find()->where(['m_status_read' => self::STATUS_NOT_READ])->andWhere(['m_receiver_id' => Yii::$app->user->identity->id]);
		//$count = $found->count();
		

		$id = (int)$_POST['serverID'];//get product ID from ajax

		
        if((int)$_POST['serverQuantity'] == 0){
			if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$id]) ){
				$temp = $_SESSION['cart'];//save Session to temp var
				unset($temp[$id]);
			}
		} else {
            //session_start();
            if (!isset($_SESSION['cart'])) {//if Session['cart'] does not exist yet
                $temp[$id] = (int)$_POST['serverQuantity'];//в масив заносим количество тавара 
            } else {//if if Session['cart'] already contains some products, ie. was prev added to cart
                $temp = $_SESSION['cart'];//save Session to temp var
                if (!array_key_exists($id, $temp)) {//проверяем есть ли в корзине уже такой товар
                    $temp[$id] = (int)$_POST['serverQuantity']; //в масив заносим количество тавара 1
                } else { //if product was not prev selected (added to cart)
				    $temp[$id] = (int)$_POST['serverQuantity'];
			    }				
            }
		}
		
        $count = count($temp);//count products in cart
        $_SESSION['cart'] = $temp;//write temp var to Cart
        //echo $count; //возвращаем количество товаров
		
		
		
		
		//RETURN JSON DATA
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => "OK",
			 'id' => $_POST['serverID'], 
			 'quantity' => $_POST['serverQuantity'],
             'count' => $count,	
            			 
          ]; 
    }
	
	

	
	
	
	
	//works with ajax, returns the quantity of product for modal in shop main page based on $_SESSION['cart']
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
    public function actionGetQuantityForModal()
    {

		$id = $_POST['serverID'];//get product ID from ajax

        //session_start();
        if (isset($_SESSION['cart'])) {//if Session cart exists
           $keyN = array_key_exists($_POST['serverID'], $_SESSION['cart']); //array_search($i, $_SESSION['cart']);
		   if($keyN){
		       $valueX = $_SESSION['cart'][$id];
			} else {
			   $valueX = 1;
			}
        } else {
          	$valueX = 1;			
        }


		
		//RETURN JSON DATA
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => "OK",
			 'quantityX' => $valueX,
            			 
          ]; 
    }
	
	
	
	
  // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
    public function actionCheckOut()
    {
		$model = new BuyerForm();
		
		if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
		    Yii::$app->getSession()->setFlash('statusOK', "Form OK!!!!"); 
		} else {
			Yii::$app->getSession()->setFlash('statusOK', "Form CRASH"); 
		}
		
		 return $this->render('check-out', [
            'model' => $model,
        ]);
	}
	
	
	
	
	 /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    |
	|
    |
    */
	

   //when user leaves/closes/redirected from cart, JS ajax is sent here to update SESSION['cart']
   // **************************************************************************************
  // **************************************************************************************
  // **                                                                                  **
  // **                                                                                  **
    public function actionAjaxMergeJsCartWithSession()
    {
        $arrayDecoded = json_decode(Yii::$app->request->post('serverJSCart'), true);  // Convert ajax string to php Array, should use second parametr {true}, to use as $var['el'], not (4var->el)
        $_SESSION['cart'] = $arrayDecoded;
		 
		 //RETURN JSON DATA
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => "OK", 
             //'final' => $arrayDecoded,		 
          ]; 
	}
	
	
	
	
	
	
}
