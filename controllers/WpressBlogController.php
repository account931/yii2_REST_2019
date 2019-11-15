<?php

namespace app\controllers;

use Yii;
use app\models\Wpress\WpressBlogPost;
use app\models\Wpress\WpressCategory;
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
			
			// my test behavior...
			'slugOrAnyName_at_all' => [
                'class' => 'app\componentsX\behaviorsX\Slug', //specify your behavior class, i.e it is located in /componentsX/behaviorsX/Slug.php
                //'iniciali' => 'someVar', //passing some variable to our behavior
            ]
			//my test behavior........
        ];
    }

	
	
	
	
	
	
	
	
  //triggered before any action in this controller. An equivalent of Access Filter
  public function beforeAction($action)
  {
	  if(Yii::$app->user->isGuest){
           throw new \yii\web\NotFoundHttpException("You are not logged. Triggered in beforeAction()");
	  }
      return parent::beforeAction($action);
  }
	
	
	
	
    /**
     * Lists all WpressBlogPost models.
     * @return mixed
     */
    public function actionIndex()
    {
	    //if user has no RBAC adminX right - terminate all now
		if(!Yii::$app->user->can('adminX')){
		    throw new \yii\web\NotFoundHttpException("You don't have the adminX RBAC access right");
		}
		
		//For GridView
        $dataProvider = new ActiveDataProvider([
            'query' => WpressBlogPost::find(),
        ]);
        
		//test-> trigger EVENT(specified in models/WpressBlogPost.php)
		//$eventStatus = $GLOBALS['eventStatus'];
		global $eventStatus;
		$model = new WpressBlogPost();
		$model->trigger(WpressBlogPost::EVENT_NEW_MY_TRIGGER_X); 
		//test-> trigger EVENT(specified in models/WpressBlogPost.php)
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
			 'eventStatus' => $eventStatus, //just text var, was set as EVENT in  models/WpressBlogPost.php
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
        $model = new WpressBlogPost(); //for form
		
	    //getting all categories for dropdown list in form
		$allCategories = WpressCategory::find()->orderBy ('wpCategory_id DESC')->all(); 

		//if u submitted the form
        if ($model->load(Yii::$app->request->post())/* && $model->save()*/) {
			if($model->save()){
				 $this->refresh();
			    //set FLASH message
			    Yii::$app->getSession()->setFlash('addedSuccess', "Your article <b>$model->wpBlog_title</b> has been successfully saved");
			    return $this->refresh();
				$model->wpBlog_text = ""; //resetting the fields
				$model->wpBlog_title = ""; //resetting the fields
			    //return $this->render('create', ['model' => $model,'allCategories' => $allCategories]);
                //return $this->redirect(['view', 'id' => $model->wpBlog_id]);
            } else {
			    Yii::$app->getSession()->setFlash('addedSuccess', "Your article saving was crashed!!!");
		    }
		}

        return $this->render('create', [
            'model' => $model,
			'allCategories' => $allCategories
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
        if(!Yii::$app->getRequest()->getQueryParam('category') || Yii::$app->getRequest()->getQueryParam('category') == '0' ){
			$queryBasic = WpressBlogPost::find()-> orderBy('wpBlog_id DESC')->where(['wpBlog_status' => '1']);//->all(); //Main SQL QUERY
		} else {
		    $queryBasic = WpressBlogPost::find()-> orderBy('wpBlog_id DESC')->where(['wpBlog_status' => '1'])->andWhere(['wpBlog_category' => Yii::$app->getRequest()->getQueryParam('category')]);//->all(); //Main SQL QUERY
		}
		
		$queryX = $queryBasic; //->all(); //for counting all blogs in view
        $pageSizeX = 3; //number of articles per 1 page for Pagination
		
		
		//PageLinker
		$query = $queryBasic;//WpressBlogPost::find()-> orderBy('wpBlog_id DESC')->where(['wpBlog_status' => '1']);  // dont use -> all() as it returns array not object
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $pageSizeX]);
        $modelPageLinker = $query->offset($pages->offset)->limit($pages->limit)->all();  
        //PageLinker
		
		
		/*
		foreach($modelPageLinker as $vv){
			foreach ($vv->tokens as $n){
		        $orders[] = $n->wpCategory_id; //call hasMany action //Token is a function getTokens
			}}
		*/
		
        //find all categories fro dropdown
        $categories = WpressCategory::find()->all();		
			
		//RENDER
        return $this->render('blog-posts-all', [
             'modelPageLinker' => $modelPageLinker, //pageLinker
             'pages' => $pages,           //pageLinker
			 'queryX' => $queryX,         //for counting of general amountof all blogs in view
			 'categories' => $categories, //all categories fro dropdown
			 //'pageSizeX' => $pageSizeX,  ////number of articles per 1 page for Pagination, used in view to display correct number of article 
			 //'orders' => $orders,  //has many relations Getter
        ]);
    }
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  
	
	
	
	
	
	
	
	//Viewing 1 single blog post, followed by link "Read all"
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
    public function actionMySingleView($id)
    {
        
	    $model = $this->findModel($id);
		
	    //RENDER
        return $this->render('my-single-view', [
             'model' => $model, //
        ]);
	}
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  
	
	
	
}
