<?php

class VarastoRakenneController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
                		'expression'=>"Yii::app()->controller->isYrittaja()",
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function isYrittaja() 
	{
		if(Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 1)
		{
		$criteria = new CDbCriteria;
		$criteria->condition = " 
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		";
		$v = VarastoOtsikkot::model()->find($criteria);
	        if(isset($v->id))
	            return true;
		} else {
	            return false;
		}
	}

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
		$model=new VarastoRakenne;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VarastoRakenne']))
		{
			$model->attributes=$_POST['VarastoRakenne'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['VarastoRakenne']))
		{
			$model->attributes=$_POST['VarastoRakenne'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(isset($_GET['update']))
			$model=VarastoOtsikkot::model()->findbypk($_GET['update']);
		else
			$model=new VarastoOtsikkot;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VarastoOtsikkot']))
		{
			$model->attributes=$_POST['VarastoOtsikkot'];
			if($model->save()){

				$criteria = new CDbCriteria;
				$criteria->condition = " 
					yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
					AND is_otsikko=0
					AND varaston_nimike='".$model->varaston_nimike."'
					AND sarakkeen_nimi='".$model->sarakkeen_nimi."'
				";
				VarastoRakenne::model()->updateAll(array('position'=>$model->position), $criteria);

				$this->redirect(array('index'));
			}
		}


		$criteria = new CDbCriteria;
		$criteria->order = " id DESC ";
		$criteria->group = " varaston_nimike ";
		$criteria->condition = " 
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
			AND is_otsikko=1
		";
		$varastot = VarastoOtsikkot::model()->findAll($criteria);

		$this->render('index',array(
			'varastot'=>$varastot,
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new VarastoRakenne('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VarastoRakenne']))
			$model->attributes=$_GET['VarastoRakenne'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return VarastoRakenne the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=VarastoRakenne::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param VarastoRakenne $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='varasto-rakenne-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
