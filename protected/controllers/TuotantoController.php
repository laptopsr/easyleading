<?php

class TuotantoController extends Controller
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
		$model=new Tuotanto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tuotanto']))
		{
			$model->attributes=$_POST['Tuotanto'];
			$model->liitteet=CUploadedFile::getInstance($model,'liitteet');
			if($model->save())
			{
				$path = "uploaded/tuotanto/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
				if (!file_exists(Yii::app()->basePath."/../".$path)) {
					mkdir(Yii::app()->basePath."/../".$path, 0777, true);
				}

				$model->liitteet->saveAs($path.'/'.$model->liitteet);
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Tuotanto']))
		{
			$model->attributes=$_POST['Tuotanto'];
			$model->liitteet=CUploadedFile::getInstance($model,'liitteet');
			if($model->save())
			{
				$path = "uploaded/tuotanto/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
				if (!file_exists(Yii::app()->basePath."/../".$path)) {
					mkdir(Yii::app()->basePath."/../".$path, 0777, true);
				}

print_r($_POST);

			if(isset($_FILES['liitteet']) and !empty($_FILES['liitteet']))
			{
				$liiteArr = $this->reArrayFiles($_FILES['liitteet']);

    				foreach($liiteArr as $val)
    				{
					$model->liitteet->saveAs($path.'/'.$val['tmp_name']);
    				}
			}

exit;
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	protected function reArrayFiles($file)
	{
	    $file_ary = array();
	    $file_count = count($file['name']);
	    $file_key = array_keys($file);
	    
	    for($i=0;$i<$file_count;$i++)
	    {
	        foreach($file_key as $val)
	        {
	            $file_ary[$i][$val] = $file[$val][$i];
	        }
	    }
	    return $file_ary;
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
       		$criteria = new CDbCriteria();

		if(isset($_POST['tehtavanimike']) and !empty($_POST['tehtavanimike']))
	        $criteria->addCondition (" tehtavanimike LIKE '%".$_POST['tehtavanimike']."%' ");

		$dataProvider=new CActiveDataProvider('Tuotanto', array(
			'criteria'=>$criteria,
			//'pagination'=>false
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tuotanto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tuotanto']))
			$model->attributes=$_GET['Tuotanto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tuotanto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tuotanto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tuotanto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tuotanto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
