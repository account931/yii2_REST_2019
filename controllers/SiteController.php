<?php

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
use app\models\AuthAssignment; //table with Rbac roles $ users' id assigned to that rbac role


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

	
	
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

	
	
	
	
	
	
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	
	
	
//My Error handler NOT USED, to use , should comment {'error' => ['class' => 'yii\web\ErrorAction',}
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
	public function actionErrorNOTUSED()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if ($exception->statusCode == 404)
                return $this->render('error404', ['exception' => $exception->getMessage()]); //$exception->getMessage() to get short mess, i.e "Page not found"
            else
                 return $this->render('error', ['exception' => $exception]);
        }
    }
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************











	 //Add just 1 user Admin if it doesnot exist
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
	 public function actionAddAdmin() {
		 
	 echo "<h3>Currently, any logged user who visits this page, will obtain the access Rbac role {adminX}</h3>";
		 
	  //$rbac = AuthItem::find()->where(['name' => 'admin'])->one();
	  
	 
	 
	 //$rbac_RolesList = Yii::$app->authManager->getRoles();//gets all existing roles from auth_item DB. Format is ARRAY, not object
     //echo '<pre>' , var_dump($rbac_RolesList) , '</pre>'; //pretty var-dump of array
     //echo "Role Item-> ". $rbac_RolesList['admin']->name; //gets the name of existing role
	 
     	

	//create a new role, it is created if this role does not exist in table {auth_item}
	if(AuthItem::checkIfRoleExist('adminX')){   //method from /models/AuthItem.php. Checks if Rbac role already exists. Name of rbac role is passes as arg $roleName
        $role = Yii::$app->authManager->createRole('adminX');
        $role->description = 'myAdminX';
        Yii::$app->authManager->add($role);
	} /*else {
		echo "<p> Role already exists</p>";
	}*/
	
	
	
	//create a new user 'admin' in table {users},checks if user Admin already exists	 
    $model = User::find()->where(['username' => 'admin'])->one();
	//if user Admin does not exist, create it
    if (empty($model)) {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@кодер.укр';
        $user->setPassword('admin');
        $user->generateAuthKey();
        if ($user->save()) {
            echo 'good';
        }
	//if user Admin already exists
    } else {
		echo '<meta charset="'.  Yii::$app->charset .' ">'; //add charset as this page without render with view
		echo '<p>User {admin} already exists</p>';
		echo 'current user ' . Yii::$app->user->identity->username; //current user
		echo '<br>User with admin rights: ' . $model->username;   //admin name
		echo '<br>' . $idX = $model->id;   
		echo '<br>' . $model->email .'<br>';   //admin mail
		//echo Yii::$app->charset; //current charset
		
		//print user {admin} role rigths, $idX is a user {admin} id
		echo "<p>User <b>{admin}</b> roles-></p>";
		var_dump($rolesForUser = Yii::$app->authManager->getRolesByUser($idX));
		
		
		//check role, if current user doesn't have it, we assign it to current user
		if(Yii::$app->user->can('adminX')){
            echo '<br><br>Роль <b>adminX</b> уже присвоена to current user';
        } else {
			echo "<br> You have no <b>adminX</b> role";
			$userRole = Yii::$app->authManager->getRole('adminX');
            Yii::$app->authManager->assign($userRole, Yii::$app->user->identity->id);
		}
		
		echo "<p> Current user <b>" . Yii::$app->user->identity->username . " </b>roles-></p>";
		$myRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id); //gets array with current user all roles rights (form table auth_item)
		foreach ($myRoles as $key => $value){
			echo $key . "<br>";
		}
	}
}
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************







//Registration, added by me
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
     public function actionSignup()
    {
        $model = new SignupForm();
 
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
 
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************









//RBAC management table 
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
     public function actionRbac()
    {
		//check if user has Rbac role {adminX}. If user has, do next....
		if(Yii::$app->user->can('adminX')){
			
			//Inner Join 3 tables---------------------
            $query = new \yii\db\Query;  //must be {$query = new \yii\db\Query;} not{$query = new Query;}, adding {use yii\db\Query} won't help
            $query  ->select(['item_name', 'user_id', /*users DB*/ 'id', 'username', /*auth_item DB*/'description'])  //columns list from all JOIN tables[/*auth_assignment DB*/,  /*users DB*/,/*auth_item DB*/ ]
                ->from('auth_assignment')  //table1
				
				
				//
				 ->join( 'INNER JOIN',  
                     'auth_item', //table2
                     'auth_item.name=auth_assignment.item_name' //table2.column = table1.column
                  )
				//
				
                 ->join( 'RIGHT JOIN',  //INNER JOIN //use RIGHT JOIN to get all users regardless in their ids in auth_assignment
                     'user', //table3
                     'auth_assignment.user_id=user.id ' //table2.column = table1.column
                  ); 
            $command = $query->createCommand();
            $query = $command->queryAll(); 
		    // END Inner Join 3 tables-----------------
			
			
			
			
			
			
			//Selects all RBAc roles from table auth_item(for <select><option>)
			$rbacRoleList = AuthItem::find()->/*where(['username' => 'admin'])->one()*/all();
			
			
			return $this->render('rbac-view', [
                         //'model' => $model,
						 'query' => $query, //Inner Join result (based on Buyres/Orders Sql)
						 'rbacRoleList' => $rbacRoleList, //all RBAc roles from table auth_item(for <select><option>)
                         ]);
						 
			
		//if user does not have Rbac role {adminX}	
		} else {
			return $this->render('no-access', [
            //'model' => $model,
            ]);
		}
        
 
        
    }
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************


}
