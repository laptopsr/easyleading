<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
            		'yiichat'=>array('class'=>'YiiChatAction'),
		);
	}


	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array('varasto'),
                		'expression'=>"Yii::app()->controller->VarastonOmmistaja()",
			),
			array('allow', 
				'actions'=>array('varaston_poisto'),
                		'expression'=>"Yii::app()->controller->VarastonYid()",
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('chat', 'chat_ajax', 'chat_check'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function VarastonOmmistaja() 
	{
	   if(!Yii::app()->user->isGuest)
	   {
		$criteria = new CDbCriteria;
		$criteria->condition = " 
			id='".$_GET['id']."'
			AND yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		";
		$v = VarastoRakenne::model()->find($criteria);
	        if(isset($v->id))
	            return true;
		else
	            die('Error: Varaston omistus');
	   } else {
	            return false;
	   }

	}


	public function VarastonYid() 
	{
	   if(!Yii::app()->user->isGuest)
	   {
		$criteria = new CDbCriteria;
		$criteria->condition = " 
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		";
		$v = VarastoRakenne::model()->find($criteria);
	        if(isset($v->id))
	            return true;
		else
	            return false;
	   } else {
	            return false;
	   }

	}

	public function actionVaraston_poisto()
	{

		if(isset($_POST['yid']))
		{

			$criteria = new CDbCriteria;
			$criteria->order = " id DESC ";
			$criteria->condition = " 
				yid='".$_POST['yid']."'
				AND varaston_nimike_id='".$_POST['varaston_nimike_id']."'
				AND tr_rivi='".$_POST['tr_rivi']."'
			";
			VarastoRakenne::model()->deleteAll($criteria);
			echo json_encode('dfd');
		}

		exit;
	}


	public function actionVarasto($id)
	{


		$fromModel=VarastoRakenne::model()->findbypk($id);
		if(!isset($fromModel->yid))
		{
			die('Error');
			exit;
		}
		$model=new VarastoRakenne;
		$model->yid = $fromModel->yid;
		$model->is_otsikko = $fromModel->is_otsikko;
		$model->varaston_nimike = $fromModel->varaston_nimike;
		$model->sarakkeen_tyyppi = $fromModel->sarakkeen_tyyppi;
		$model->varaston_nimike_id = $id;





		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VarastoRakenne']))
		{

			$taulu = VarastoRakenne::model()->findbypk($id);
			$criteria = new CDbCriteria;
			$criteria->order = " id DESC ";
			$criteria->group = " varaston_nimike ";
			$criteria->condition = " 
				yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."'
				AND varaston_nimike='".$taulu->varaston_nimike."'
				AND is_otsikko=0
			";
			$varastoViimeinen = VarastoRakenne::model()->find($criteria);

			if(isset($varastoViimeinen->tr_rivi))
				$tr_rivi = $varastoViimeinen->tr_rivi+1;
			else
				$tr_rivi = 1;

			foreach($_POST['VarastoRakenne']['sarakkeen_nimi'] as $key=>$value)
			{
				if(empty($value)) $value = 0;
				$arr = json_decode($_POST['VarastoRakenne']['arr'][$key], true);

				$v = new VarastoRakenne;
				$v->attributes=$arr;
				$v->value=$value;
				$v->tr_rivi=$tr_rivi;
				if(!$v->save())
				var_dump($v->getErrors());
			}
			$this->redirect(array('varasto', 'id'=>$id));
		}

		$taulu = VarastoRakenne::model()->findbypk($id);
		$criteria = new CDbCriteria;
		$criteria->order = " id ASC ";
		$criteria->group = " varaston_nimike ";
		$criteria->condition = " 
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."'
			AND varaston_nimike='".$taulu->varaston_nimike."'
			AND is_otsikko=1
		";
		$varasto = VarastoRakenne::model()->find($criteria);


		$this->render('varasto',array(
			'varasto'=>$varasto,
			'model'=>$model,
		));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$isMessage = false;
		$criteria = new CDbCriteria;
		$criteria->condition = " 
			saaja='".Yii::app()->user->id."' 
			AND is_katsonut!=1
		";
		$viestinta = Viestinta::model()->findAll($criteria);
		if(count($viestinta) > 0)
		$isMessage = true;

		$this->render('index', array(
			'isMessage'=>$isMessage
		));
	}


	public function actionChat_check()
	{
		if(Yii::app()->getModule('user')->user()->profile->getAttribute('yid') != 0)
		$yid = Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
		else
		$yid = Yii::app()->user->id;

		$criteria = new CDbCriteria;
		$criteria->condition = " 
			chat_id='".$yid."' 
		";
		$model = YiichatPost::model()->findAll($criteria);
		if(isset($model[0]))
			echo json_encode(count($model));
		else
			echo json_encode(0);
	}

	public function actionChat_ajax()
	{
		if(Yii::app()->getModule('user')->user()->profile->getAttribute('yid') != 0)
		$yid = Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
		else
		$yid = Yii::app()->user->id;

		if(isset($_POST['newMessage']))
		{
			$new = new YiichatPost;
			$new->chat_id = $yid;
			$new->text = $_POST['teksti'];
			$new->owner = Yii::app()->getModule('user')->user()->profile->getAttribute('firstname').' '.Yii::app()->getModule('user')->user()->profile->getAttribute('lastname');
			$new->save();
		}


		$criteria = new CDbCriteria;
		$criteria->order = " id DESC";
		$criteria->limit = 15;
		$criteria->condition = " 
			chat_id='".$yid."' 
		";
		$model = YiichatPost::model()->findAll($criteria);
		$this->renderPartial('chat_ajax', array('chat'=>$model));
	}

	public function actionChat()
	{
		$this->render('chat');
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
