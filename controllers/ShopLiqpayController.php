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
		
		$id = $_POST['serverID'];//get product ID from ajax

        //session_start();
        if (!isset($_SESSION['cart'])) {//если сесия корзины не существует
            $temp[$id] = (int)$_POST['serverQuantity'];//в масив заносим количество тавара 
        } else {//если в сесии корзины уже есть товары
            $temp = $_SESSION['cart'];//заносим в масив старую сесию
            if (!array_key_exists($id, $temp)) {//проверяем есть ли в корзине уже такой товар
                $temp[$id] = (int)$_POST['serverQuantity']; //в масив заносим количество тавара 1
            } else {
				$temp[$id] = (int)$_POST['serverQuantity'];
			}				
        }
        $count = count($temp);//считаем товары в корзине
        $_SESSION['cart'] = $temp;//записывае в сесию наш масив
        //echo $count; //возвращаем количество товаров
		
		
		
		
		//RETURN JSON DATA
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => "OK",
			 'id' => $_POST['serverID'], 
			 'quantity' => $_POST['serverQuantity'],
             'count' => $count ,			 
          ]; 
    }
	
	


}
