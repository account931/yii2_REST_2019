<?php

//Controller to reset your forgotten password. 
//When u request it, firstly u input your email, then checks your email box and follow the link with token to reset forgotten password.

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;


use app\models\SignupForm;
use app\models\ResetPassword\PasswordResetRequestForm;
use app\models\ResetPassword\ResetPasswordForm;


class PasswordResetController extends Controller
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
                    throw new \yii\web\NotFoundHttpException("Only logged users are permitted!!!");
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
                'class' => 'yii\web\ErrorAction',  //predifined error handler, comment if want to use my personal
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	
	
	
	
	
  
  
  
  
  /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
		
		//captcha
		$model->captcha = rand(11111,99999);
 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
				
				$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['password-reset/reset-password', 'token' => $GLOBALS['myToken']]); //just for test in flash, must be DELETED in Production
				$text = "Follow the link below to reset your password: <a href = $resetLink >$resetLink</a> "; //just for test in flash, must be DELETED in Production
                Yii::$app->session->setFlash('success', '<b>TEST FLASH -> in PRODUCTION it should not contain Link as it is Classified </b><br>Check your email for further instructions.<br> '. $text); //$text is just for test in flash, must be DELETED in Production

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
 
        return $this->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }
 
 
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
 
        return $this->render('resetPasswordForm', [
            'model' => $model,
			]);
      }
	  
	  
	  
	  
	  
	  
	  
	  
	  


}
