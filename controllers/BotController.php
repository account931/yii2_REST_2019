<?php

namespace app\controllers;

use Yii;
use app\models\Bot\BotModel;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Bot\InputModel; //your input
/**
 * BotController implements the CRUD actions for BotModel model.
 */
class BotController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all BotModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => BotModel::find(),
        ]);

        return $this->render('grid', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BotModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BotModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BotModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->b_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BotModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->b_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BotModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BotModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BotModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BotModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	
	
	
	
	
	
	
	
	
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
    public function actionBotChat()
    {
        
        $model = new InputModel(); //model for my input, not Act Record
		
		$autoCompleteHint = BotModel::find()->all();
		
        return $this->render('bot-view', [
            'model' => $model, //model for my input, not Act Record
			'autoCompleteHint' => $autoCompleteHint, //for my input autocomplete
        ]);
    }

	
	
	
	
	
	
	
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **	
	
	public function actionAjaxReply()
    {
        
        //just a test if ajax is recognized
        if (Yii::$app->request->isAjax) { 
	        $test = "Ajax Worked, recognized! (message is from {actionAjaxReply})";
	    } else {
            $test = "Ajax  not recognized! message is from {actionAjaxReply}";
		}
		
		$found = BotModel::find()->orderBy ('b_id DESC')->andFilterWhere(['like', 'b_key', $_POST['serverMessageX']])->asArray() ->all();
		if($found){
		    //if(strpos( $found[0]['b_reply'], '//' ) !== false){  
		        $arr = explode("//",$found[0]['b_reply']);
		        $countX = count($arr);
		        $random = rand(0,$countX - 1 );
		        $answer = $arr[$random];
		    //} else {
			    //$answer = $arr[0];
		  //}
		} else {
			$answer = "Sorry, did not catch the meaning";
		}
		
		//RETURN JSON DATA
		 // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => $test, // return ajx status
             'code' => 100,	
	         'messageX' => $_POST['serverMessageX'],
             'botreply'	=>	$answer,
          ]; 
    }
	
	
	
	
	
	
	
	
	
	
}
