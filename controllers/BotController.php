<?php
//ReadMe is in => https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/Readme_YII2_mine_This_Project_itself.txt
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
		if(!Yii::$app->user->can('adminX')){
			throw new \yii\web\NotFoundHttpException("Sorry, you don't have adminX RBAC");
		}
		
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
		
		$autoCompleteHint = BotModel::find()->all(); //finds all sentences for autocomplete
		
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
		
        $myModel = new BotModel();
		
        //just a test if ajax is recognized
        $test = $myModel->testIf_IsAjax();
		
		//Reg Exp to differentiate Statements/Questions; //NOT USED so far!!!!!!!
        $myModel->ifStatements_orQuestions_category();
		
		//START CORE LOGIC => it outputs the final answer to ajax
		
		//if user's message is empty 
		if($_POST['serverMessageX']==""){
			$answerX = "Your message is empty. Please try harder with a new one.";
			
		} else { //if user's message is not empty
		
		    if($myModel->isSearchAnswerExists_inSQL()){ //if found keys [b_key] in SQL that matches user's message. Search for key words presence in SQL Dn [b_key], if exist return TRUE
			   
				if($myModel->found[0]['b_category'] == 'Script_Processed'){ //if found category has category 'Script_Processed', meaning it Gets calculated answer, like response from Weather, News API, current time/date, etc

					 $answerX = $myModel->giveComputeredAnswer($myModel->found); // Gets calculated answer(), i.e response from Weather, News API, current time/date
				} else {

					$answerX = $myModel->AnswerFromDataBase($myModel->found); //Gets predifined answers from SQL DBc  
				}
				
			//if DID NOT found keys [b_key] in SQL that matches user's message   
		    } else {
			    $answerX = "Sorry, can not understand you. Try with another question.";
				
		    }
			
		}
		//END CORE LOGIC => it outputs the final answer to ajax
		
		

		
		
		
		//RETURN JSON DATA
		 // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => $test, // return ajx status
             'code' => 100,	
	         'messageX' => $_POST['serverMessageX'],
			 'category' => $myModel->category,
             'botreply'	=>	$answerX, //Bot FINAL answer
          ]; 
    }
	
	
	
	
	
	
	
	
	
	
}
