

# New Features!

  - Login
  - database connection
  - RBAC

      ```php
// /path/to/your/controller
public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' =>['contact'],
                        'allow'=> true,
                        //this is where you implement RBAC by checking it against user role
                        'matchCallback'=> function(){
                            $bool = false;
                            if(!Yii::$app->user->isGuest){
                                $bool =Yii::$app->user->identity->access_level == Yii::$app->user->identity->ADMIN;
                            }
                            return $bool;
                        }
                    ],
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


    ```
  - added Foontawesome assets
    

