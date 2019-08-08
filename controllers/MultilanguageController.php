<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

use app\models\MultuLang;


class MultilanguageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
         return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
                'class' => 'yii\web\ErrorAction',  //predifined error handler, comment if want to use my personal
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	
	
	
	
	
//Action that renders basic view with language dropdown and string translations if any language is enabled
//now available: 'ru-RU', 'en-US', 'my-Lang', 'dk-DK'
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
	
    public function actionIndex()
    {
		//MEGA FIX : {Yii::$app->request->cookies} is READ ONLY, to add a new cookie use {Yii::$app->response->cookies->}
		$session = Yii::$app->session;//opens session for setting language -> not used as now language storage CHANGED TO COOKIES!!!!!
		$cookies = Yii::$app->request->cookies;//getting all Cookies from collection
		
		$modelX =  new MultuLang(); //new model object
		/*
		if ($modelX->load(Yii::$app->request->post()) && $modelX->validate()  ) { //&& $modelToken->save()
			 $modelX->q = "fddfd"; 
			 throw new \yii\web\NotFoundHttpException("works");
		 }
		 */
		
		//check if $_GET['l'] is NOT set
		if (!$lang = Yii::$app->getRequest()->getQueryParam('l')){ //gets $_GET['l'] param), we check if $_GET['l'] is NOT set
		
		     if (!$cookies->has('language')){ //Cookie variant instead of Session
			//if(!$languageX =  $session->get('language')){ //check if language is NOT set in Session  //CHANGED TO COOKIES language storage variant!!!!!
		        //if no language is set,set it to "en-US" by default/ Otherwise, it display no lanaguage status during the 1st visit
                if(!\Yii::$app->language) {
	               \Yii::$app->language = 'en-US';
	            }
		    } else { //if language is set in Session/Cookies use it
			    \Yii::$app->language = $cookies->getValue('language', 'en-US');  //Cookie variant instead of Session
              //\Yii::$app->language = $session->get('language');	//CHANGED TO COOKIES language storage variant!!!!!
		    }
		
        //if $_GET['l'] is set, then use it
		} else {
		
		    $lang = Yii::$app->getRequest()->getQueryParam('l'); //gets $_GET['l'] param
		    \Yii::$app->language = $lang; //set the Yii language
			Yii::$app->response->cookies->add(new \yii\web\Cookie(['name' => 'language', 'value' => $lang, 'expire' => time() + 86400 * 365, ] )); //saves the Yii2 language to Session //Cookie variant instead of Session
		    //$session->set('language', $lang); //saves the Yii2 language to Session //CHANGED TO COOKIES language storage variant!!!!!
		}
		
		
		
        return $this->render('index', [
            'modelX' => $modelX,
			'lang' => \Yii::$app->language,//passing the language
        ]);
    }

	
	
	
	
	
//NOT USED!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **

	//Action that response to changing languages in actionIndex() //now available: 'ru-RU', 'en-US', 'my-Lang', 'dk-DK'
	public function actionSetlanguage()
	{
		/*
		$model =  new MultuLang();
		throw new \yii\web\NotFoundHttpException("works");
		
		if ($model->load(Yii::$app->request->post())  ) {    //&& $modelToken->save()
			throw new \yii\web\NotFoundHttpException("works");
        }
	    */
		
		$lang = Yii::$app->getRequest()->getQueryParam('l');
		\Yii::$app->language = $lang; 
		return $this->redirect(Yii::$app->request->referrer);
	}
	
	
	
	
	
	
	
	
	
	

}
