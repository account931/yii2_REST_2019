<?php

namespace app\controllers;

use Yii;
use app\models\Wpress\WpressBlogPost;
use app\models\Wpress\WpressCategoryt;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\Pagination;
//use yii\data\ActiveDataProvider;

/**
 * WpressBlogController implements the CRUD actions for WpressBlogPost model.
 */
class WpressBlogController extends Controller
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
     * Lists all WpressBlogPost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => WpressBlogPost::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WpressBlogPost model.
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
     * Creates a new WpressBlogPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WpressBlogPost();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->wpBlog_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WpressBlogPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->wpBlog_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WpressBlogPost model.
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
     * Finds the WpressBlogPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WpressBlogPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WpressBlogPost::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	
	
	
	
	
	
	
	 /**
     * Shows all Blog posts
     * 
     */
	 
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
    public function actionShowAllBlogs()
    {
        
		$queryX = WpressBlogPost::find()-> orderBy('wpBlog_id DESC')->all(); //for counting all blogs in view
        
		$query = WpressBlogPost::find()-> orderBy('wpBlog_id DESC');  // dont use -> all() as it returns array not object
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2]);
        $modelPageLinker = $query->offset($pages->offset)->limit($pages->limit)->all();  
        
		
		
		/*
		foreach($modelPageLinker as $vv){
			foreach ($vv->tokens as $n){
		        $orders[] = $n->wpCategory_id; //call hasMany action //Token is a function getTokens
			}}
		*/
			
		//RENDER
        return $this->render('blog-posts-all', [
             'modelPageLinker' => $modelPageLinker, //pageLinker
             'pages' => $pages,      //pageLinker
			 //'orders' => $orders,  //has many relations Getter
			 'queryX' => $queryX,  //for counting all blogs in view
        ]);
    }
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  
	
	
	
	
	
	
	
	
}
