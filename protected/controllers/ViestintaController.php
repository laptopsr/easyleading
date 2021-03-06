<?php

class ViestintaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	// <-- Teematus
        public function init()
        {

		if(Yii::app()->user->isGuest){
                        Yii::app()->theme = 'classic';
                } elseif(!Yii::app()->user->isGuest) {
                        Yii::app()->theme = 'sisainen';
                }
                parent::init();
        }
	//     Teematus -->

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Viestinta;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Viestinta']))
		{
			$model->attributes=$_POST['Viestinta'];
			if($model->save()){

				$saaja 		= $_POST['Viestinta']['saaja'];
				$subject 	= $_POST['Viestinta']['otsikko'];
				$message	= $_POST['Viestinta']['teksti'];

				$mail = new YiiMailer();
				$mail->setFrom('info@'.Yii::app()->params['site_host'], Yii::app()->params['site_host']);
				$mail->setTo($saaja);
				$mail->setSubject($subject);
				$mail->setBody($message);
				//$mail->setAttachment($path.'/'.$file);
				$mail->send();

				$this->redirect(array('//site/index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Viestinta']))
		{
			$model->attributes=$_POST['Viestinta'];
			if($model->save())
				$this->redirect(array('//site/index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = Viestinta::model()->findByPk($id);
		if(isset($model->piilottu_seuraavasta_idsta) and is_array(json_decode($model->piilottu_seuraavasta_idsta, true)))
		{
			$arr = json_decode($model->piilottu_seuraavasta_idsta, true);
			$arr[] = Yii::app()->user->id;
			Viestinta::model()->updateByPk($id, array('piilottu_seuraavasta_idsta'=>json_encode($arr)));
		} elseif( isset($model->piilottu_seuraavasta_idsta) and empty($model->piilottu_seuraavasta_idsta) ){

			$arr = array();
			$arr[] = Yii::app()->user->id;
			Viestinta::model()->updateByPk($id, array('piilottu_seuraavasta_idsta'=>json_encode($arr)));
		}
		
		$this->redirect(array('index'));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $dataProvider=new CActiveDataProvider('Viestinta', array(
                        'criteria'=>array(
                                'order'=>'t.id DESC',
				'condition'=>" saaja='".Yii::app()->user->id."' 
					AND piilottu_seuraavasta_idsta NOT LIKE '%".Yii::app()->user->id."%' ",
                        )));

                $dataProvider_lahetetyt=new CActiveDataProvider('Viestinta', array(
                        'criteria'=>array(
                                'order'=>'t.id DESC',
				'condition'=>" lahettaja='".Yii::app()->user->id."' 
					AND piilottu_seuraavasta_idsta NOT LIKE '%".Yii::app()->user->id."%' ",
                        )));

                $this->render('index',array(
                        'dataProvider'=>$dataProvider,
			'dataProvider_lahetetyt'=>$dataProvider_lahetetyt
                ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Viestinta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Viestinta']))
			$model->attributes=$_GET['Viestinta'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Viestinta the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Viestinta::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Viestinta $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='viestinta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function etuSukunimi($id)
	{

		$model=Profile::model()->findByPk($id);
		if(isset($model->user_id))
		return $model->firstname.' '.$model->lastname;
	}
}
