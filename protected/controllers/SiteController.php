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
				'actions'=>array('varaston_poisto', 'keyup_updater', 'getModal', 'saveModal', 'annaKaikkiKuvat', 'tuotanto', 'oma_kansio', 'foldertree'),
				'users'=>array('@'),
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


	public function VarastonOmmistaja() 
	{
	   if(!Yii::app()->user->isGuest)
	   {
		$criteria = new CDbCriteria;
		$criteria->condition = " 
			id='".$_GET['id']."'
			AND yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		";
		$v = VarastoOtsikkot::model()->find($criteria);
	        if(isset($v->id))
	            return true;
		else
	            die('Error: Varaston omistus');
	   } else {
	            return false;
	   }

	}


	public function actionFoldertree()
	{
		$this->renderPartial('foldertree');
	}


	public function actionAnnaKaikkiKuvat()
	{
		$nextPath = "uploaded/varasto/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
		$result = '';
		if(isset($_POST['id']))
		{
			$model = VarastoRakenne::model()->findByPk($_POST['id']);
			if(is_array(json_decode($model->value, true)))
			{
				$kuvat = json_decode($model->value, true);
				foreach($kuvat as $item)
				{
					$result .= '
					<div class="row">
					 <div class="col-sm-12">
						<img src="../../'.$nextPath.'/'.$item.'" class="img-thumbnail">
					 </div>
					</div>
					';
				}
			}
		}
		echo json_encode($result);
		exit;
	}

	public function actionVaraston_poisto()
	{

		if(isset($_POST['tr_rivi']))
		{

			// <-- Etsitaan kuvaa
			$criteria = new CDbCriteria;
			$criteria->order = " id DESC ";
			$criteria->condition = " 
				varaston_nimike='".$_POST['varaston_nimike']."'
				AND tr_rivi='".$_POST['tr_rivi']."'
				AND sarakkeen_tyyppi=3 AND value!=''
			";
			$model = VarastoRakenne::model()->find($criteria);
			if(isset($model->value) and is_array(json_decode($model->value, true)))
			{

				$path = Yii::app()->basePath."/../";
				$nextPath = "uploaded/varasto/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');

				$kuvat = json_decode($model->value, true);
				foreach($kuvat as $item)
				{
					if(file_exists($path . $nextPath.'/'.$item))
					unlink($path . $nextPath.'/'.$item);
				}
			}
			// <-- Etsitaan kuvaa -->



			$criteria = new CDbCriteria;
			$criteria->order = " id DESC ";
			$criteria->condition = " 
				varaston_nimike='".$_POST['varaston_nimike']."'
				AND tr_rivi='".$_POST['tr_rivi']."'
			";
			VarastoRakenne::model()->deleteAll($criteria);
		}
		echo json_encode('ok');
		exit;
	}

	public function actionKeyup_updater()
	{

		if(isset($_POST['tr_rivi']))
		{

			$criteria = new CDbCriteria;
			$criteria->order = " id DESC ";
			$criteria->condition = " 
				varaston_nimike='".$_POST['varaston_nimike']."'
				AND tr_rivi='".$_POST['tr_rivi']."'
				AND sarakkeen_nimi='".$_POST['sarakkeen_nimi']."'				
			";
			$model = VarastoRakenne::model()->find($criteria);
			if(isset($model->id))
			{
				VarastoRakenne::model()->updateByPk($model->id, 
				array(
					'value'=>$_POST['thisNewValue'],
					'tuotteen_ryhman_nimike'=>$_POST['tuotteen_ryhman_nimike']
				));
				echo json_encode($model->id);
			} else {
				$model = new VarastoRakenne;
				$model->varaston_nimike 	= $_POST['varaston_nimike'];
				$model->tr_rivi 		= $_POST['tr_rivi'];
				$model->sarakkeen_nimi	 	= $_POST['sarakkeen_nimi'];
				$model->value 			= $_POST['thisNewValue'];
				$model->sarakkeen_tyyppi	= $_POST['sarakkeen_tyyppi'];
				$model->sum 			= $_POST['sum'];
				$model->position		= $_POST['position'];
				$model->varaston_nimike_id	= $_POST['varaston_nimike_id'];
				$model->tuotteen_ryhman_nimike	= $_POST['tuotteen_ryhman_nimike'];
				if($model->save())
					echo json_encode(array('newId'=>$model->id));
				else
					var_dump($model->getErrors());
			}
		}

		exit;
	}

	public function actionVarasto($id)
	{


		$fromModel=VarastoOtsikkot::model()->findbypk($id);
		if(!isset($fromModel->yid))
		{
			die('Error');
			exit;
		}
		$model=new VarastoRakenne;
		$model->varaston_nimike = $fromModel->varaston_nimike;
		$model->sarakkeen_tyyppi = $fromModel->sarakkeen_tyyppi;
		$model->varaston_nimike_id = $id;


		// <-- Category
		$criteria = new CDbCriteria;
		$criteria->condition = " 
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."'
			AND varaston_nimike='".$model->varaston_nimike."'
		";
		$checkCat = VarastoCategory::model()->find($criteria);

		if(!isset($checkCat->id))
			$varastoCategory = new VarastoCategory;
		else
			$varastoCategory = $checkCat;


		if(isset($_POST['VarastoCategory']))
		{
			/*
			echo '<pre>';
			print_r($_POST['VarastoCategory']);
			echo '</pre>';
			exit;
			*/

			$varastoCategory->attributes=$_POST['VarastoCategory'];

			$_POST['VarastoCategory']['ryhmarakenne'] = preg_replace('!\s+!smi', ' ', $_POST['VarastoCategory']['ryhmarakenne']);

			$varastoCategory->ryhmarakenne = json_encode($_POST['VarastoCategory']['ryhmarakenne']);
			if($varastoCategory->save())
			$this->redirect(array('varasto', 'id'=>$id));
		}
		//     Category -->


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VarastoOtsikkot']))
		{


			/*
			echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			exit;
			*/
			

			$taulu = VarastoOtsikkot::model()->findbypk($id);
			$criteria = new CDbCriteria;
			$criteria->order = " id DESC ";
			$criteria->group = " varaston_nimike ";
			$criteria->condition = " varaston_nimike='".$taulu->varaston_nimike."'	";
			$varastoViimeinen = VarastoRakenne::model()->find($criteria);

			$tr_rivi = md5(strtotime(date("Y-m-d H:i:s")));

			/*
			echo '<pre>';
			print_r($_FILES);
			echo '</pre>';
			*/

			// <-- Onko kuva
			if(isset($_FILES['fileToUpload']) and !empty($_FILES['fileToUpload']))
			{
				$img_desc = $this->reArrayFiles($_FILES['fileToUpload']);

				$path = Yii::app()->basePath."/../";
				$nextPath = "uploaded/varasto/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
				if (!file_exists($path . $nextPath)) {
					mkdir($path . $nextPath, 0777, true);
				}
    				$files = array();
				$onkokuva = false;
    				foreach($img_desc as $val)
    				{
					$uploaddir = $path . $nextPath. '/';
					$uploadfile = basename($val['name']);	
					if (move_uploaded_file($val['tmp_name'], $uploaddir . $uploadfile)) {
						array_push($files, $uploadfile);
						$onkokuva = true;
					}
    				}

				if($onkokuva == true)
				{

						$v = new VarastoRakenne;
						$v->attributes=$_POST['fileLomake'];
						$v->value=json_encode($files);
						$v->tuotteen_ryhman_nimike=$_POST['VarastoOtsikkot']['tuotteen_ryhman_nimike'];
						$v->tr_rivi=$tr_rivi;
						if(!$v->save()){
							var_dump($v->getErrors());
							exit;
						}

				}

			}
			//  Onko kuva -->


			/*
			echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			exit;
			*/

			foreach($_POST['VarastoOtsikkot']['arr'] as $key=>$value)
			{
				$arr = json_decode($value, true);
				if($arr['sarakkeen_tyyppi'] == 3)
				continue;

				$value = $_POST['VarastoOtsikkot']['sarakkeen_nimi'][$arr['sarakkeen_nimi']];

				/*
				echo '<pre>';
				print_r($arr);
				echo '</pre>';
				exit;
				*/

			
				$v = new VarastoRakenne;
				$v->attributes=$arr;
				$v->value=$value;
				$v->tuotteen_ryhman_nimike=$_POST['VarastoOtsikkot']['tuotteen_ryhman_nimike'];
				$v->tr_rivi=$tr_rivi;
				if(!$v->save()){
					var_dump($v->getErrors());
					exit;
				}
			}

			if(isset($_POST['nv_kayttoon']) and $_POST['nv_kayttoon'] == 'on')
			{
				$v = new VarastoRakenne;
				$v->sarakkeen_nimi='NETVISOR';
				$v->varaston_nimike=$_POST['VarastoRakenne']['varaston_nimike'];
				$v->sarakkeen_tyyppi=1;
				$v->sum=0;
				$v->position=0;
				$v->value='valmistetaan';
				$v->tuotteen_ryhman_nimike=$_POST['VarastoOtsikkot']['tuotteen_ryhman_nimike'];
				$v->tr_rivi=$tr_rivi;
				if(!$v->save()){
					var_dump($v->getErrors());
					exit;
				} else {

			   		// <-- Netvisor
					   $a = Asetukset::model()->findbypk(1);
					   if($a->netvisor_kaytto == 1)
					   {
							$InsertedDataIdentifier = $this->netvisorProduct("add", $_POST['LaskutusTuotteet'], $v);
							if(!empty($InsertedDataIdentifier))
							{
								array_push($_POST['LaskutusTuotteet'], array('netvisorkey'=>$InsertedDataIdentifier));
								VarastoRakenne::model()->updateByPk($v->id, array('value'=>json_encode($_POST['LaskutusTuotteet'])));

							}

					   }
					 //  Netvisor -->

				}
			}


			$this->redirect(array('varasto', 'id'=>$id));
		}

		$taulu = VarastoOtsikkot::model()->findbypk($id);
		$criteria = new CDbCriteria;
		$criteria->order = " id ASC ";
		$criteria->group = " varaston_nimike ";
		$criteria->condition = " 
			yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."'
			AND varaston_nimike='".$taulu->varaston_nimike."'
		";
		$varasto = VarastoOtsikkot::model()->find($criteria);


		$this->render('varasto',array(
			'varasto'=>$varasto,
			'model'=>$model,
			'id'=>$id,
			'varastoCategory'=>$varastoCategory,
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


	public function actionOma_kansio()
	{
		
		if(!Yii::app()->getModule('user')->user()->profile->getAttribute('yid'))
			die('Error yid');
		else
			$yid = Yii::app()->getModule('user')->user()->profile->getAttribute('yid');

		if(isset($_POST['ajax']))
		{
			$response = $this->renderPartial('oma_kansio_ajax', array(
				'yid'=>$yid,
			), true);
			echo json_encode($response);
			exit;
		}


		$this->render('oma_kansio', array(
			'yid'=>$yid,
		));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

	public function actionGetModal()
	{

		$criteria = new CDbCriteria;
		$criteria->condition = " 
			varaston_nimike='".$_POST['varaston_nimike']."' 
		";
		$varastoOtsikkot = VarastoOtsikkot::model()->findAll($criteria);

		$modal = $this->renderPartial('get_modal', array(
			'varastoOtsikkot'=>$varastoOtsikkot,
			'tr_rivi'=>$_POST['tr_rivi'],
			'tuotteen_ryhman_nimike'=>$_POST['tuotteen_ryhman_nimike']
		), true);
		echo json_encode($modal);
	}


	public function actionSaveModal()
	{


		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		exit;
		*/
		

			// <-- Onko kuva
			if(isset($_FILES['fileToUpload']) and !empty($_FILES['fileToUpload']))
			{
				$img_desc = $this->reArrayFiles($_FILES['fileToUpload']);

				$path = Yii::app()->basePath."/../";
				$nextPath = "uploaded/varasto/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
				if (!file_exists($path . $nextPath)) {
					mkdir($path . $nextPath, 0777, true);
				}
    				$files = array();
				$onkokuva = false;
    				foreach($img_desc as $val)
    				{
					$uploaddir = $path . $nextPath. '/';
					$uploadfile = basename($val['name']);	
					if (move_uploaded_file($val['tmp_name'], $uploaddir . $uploadfile)) {
						$files[] = $uploadfile;
						$onkokuva = true;
					}
    				}

				if($onkokuva == true)
				{

						if(isset($_POST['fileLomake']['thisId'])) {
							$v = VarastoRakenne::model()->findbypk($_POST['fileLomake']['thisId']);
						} else {
							$v = new VarastoRakenne;
						}
						$v->attributes=$_POST['fileLomake'];
						$v->value=json_encode($files);
						if(!$v->save()){
							var_dump($v->getErrors());
							exit;
						}

				}

			}
			//  Onko kuva -->

			
			if(isset($_POST['VarastoOtsikkot']['arr']))
			{

			foreach($_POST['VarastoOtsikkot']['arr'] as $key=>$value)
			{
				$arr = json_decode($value, true);
				if($arr['sarakkeen_tyyppi'] == 3)
				continue;

				$model = VarastoRakenne::model()->findByPk($arr['id']);
				if(isset($model->id)) {
					$v = $model;
				} else {
					$v = new VarastoRakenne;
				}

				$value = $_POST['VarastoOtsikkot']['sarakkeen_nimi'][$arr['sarakkeen_nimi']];

			
				$v->attributes=$arr;
				$v->value=$value;
				$v->tuotteen_ryhman_nimike=$arr['tuotteen_ryhman_nimike'];
				$v->tr_rivi=$arr['tr_rivi'];
				if(!$v->save()){
					var_dump($v->getErrors());
					exit;
				}
			}

/*
			  foreach($_POST['VarastoRakenne']['sarakkeen_nimi'] as $key=>$value)
			  {

				if(empty($value)) $value = 0;
				$arr = json_decode($_POST['VarastoOtsikkot']['arr'][$key], true);
				$model = VarastoRakenne::model()->findByPk($arr['id']);
				if(isset($model->id)) {
					$v = $model;
				} else {
					$v = new VarastoRakenne;
				}


				$checkAlasveto = explode(":", $arr['sarakkeen_nimi']);
				if(isset($checkAlasveto[0]))
					$sarakkeen_nimi = $checkAlasveto[0];
				else
					$sarakkeen_nimi = $arr['sarakkeen_nimi'];

				$v->attributes=$arr;
				$v->sarakkeen_nimi=$sarakkeen_nimi;
				$v->value=$value;
				if(!$v->save()){
					var_dump($v->getErrors());
					exit;
				}

			  }
*/
			}
				$this->redirect(array('varasto', 'id'=>$_POST['backLinkID']));
				//echo json_encode('ok');
	}


	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$this->render('index', array(
			//'isMessage'=>$isMessage
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


	public function malli() {
	
		$malli = '
	        <ul>
	            <li>Pääryhmä 1
	                <ul>
	                    <li>R 1</li>
	                    <li>R 2</li>
	                </ul>
		    </li>
	            <li>Pääryhmä 2
	                <ul>
	                    <li>L 1</li>
	                    <li>L 2</li>
	                </ul>
	            </li>
	        </ul>';
		return $malli;
	}

	public function yidArrayList($var1, $var2)
	{
		$list = array();

		$criteria = new CDbCriteria();
		$criteria->condition = " yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' ";

		$tt = Profile::model()->findAll($criteria);
		foreach($tt as $t)
		$list[$t->user_id] = $t->firstname.' '.$t->lastname;

		return $list;
	}


	public function Yksikkot()
	{	
		$list = array(
			'kpl'=>'kpl',
			'm'=>'m',
			'km'=>'km',
			'min'=>'min',
			'h'=>'h',
			'd'=>'d',
			'vko'=>'vko',
			'kk'=>'kk',
			'Vuosi'=>'Vuosi',
			'dl'=>'dl',
			'm3'=>'m3',
			'g'=>'g',
			'kg'=>'kg',
			't'=>'t',
		);
		return $list;
	}



	public function netvisorYhteys()
	{

	   $return = array();
	   $a = Asetukset::model()->findbypk(1);

	   if($a->netvisor_kaytto == 1)
	   {
		if(empty($a->netvisor_host))
		die('Netvisor HOST ei ole määritetty asetuksessa.');

		$url		= "https://".$a->netvisor_host; 
		$host 		= $a->netvisor_host;

		$sender 	= $a->laskutus_yritys; // Yii::app()->getModule('user')->user()->profile->getAttribute('yrityksen_nimi')
		$customerId	= $a->netvisor_customer_id;
		$partnerId	= $a->netvisor_partner_id;
		$timestamp	=  date("Y-m-d H:i:s");
		$language	= 'FI';
		$organisationIdentifier	= $a->netvisor_organisation_identifier;
		$transactionIdentifier	= rand(0,10000000);
		$userKey 	= $a->netvisor_userkey;
		$partnerKey	= $a->netvisor_partnerkey;

		$return = array($url,$host,$sender,$customerId,$partnerId,$timestamp,$language,$organisationIdentifier,$transactionIdentifier,$userKey, $partnerKey);

	   }

		return $return;

	}

	protected function netvisorProduct($tila, $post, $v)
	{

		$return = '';
		$site = Yii::app()->createController('Site');
		$n = $site[0]->netvisorYhteys();

	if(isset($n[0]))
	{
		if( $tila == 'add' )
		$url		= $n[0].'/product.nv?method=add';
		if( $tila == 'edit' and !empty($post['netvisorkey']))
		$url		= $n[0].'/product.nv?id='.$post['netvisorkey'].'&method=edit';

		$host 		= $n[1];

		$sender 	= $n[2];
		$customerId	= $n[3];
		$partnerId	= $n[4];
		$timestamp	= $n[5];
		$language	= $n[6];
		$organisationIdentifier	= $n[7];
		$transactionIdentifier	= $n[8];
		$userKey 	= $n[9];
		$partnerKey	= $n[10];



	$getMAC = md5(
		$url.'&'.
		$sender.'&'.
		$customerId.'&'.
		$timestamp.'&'.
		$language.'&'.
		$organisationIdentifier.'&'.
		$transactionIdentifier.'&'.
		$userKey.'&'.
		$partnerKey
	 	);
	
	$auth_data = 
	    "Host: $host\r\n".  
	    "X-Netvisor-Authentication-Sender: $sender\r\n".  
	    "X-Netvisor-Authentication-CustomerId: $customerId\r\n".  
	    "X-Netvisor-Authentication-PartnerId: $partnerId\r\n".  
	    "X-Netvisor-Authentication-Timestamp: $timestamp\r\n".
	    "X-Netvisor-Interface-Language: $language\r\n".
	    "X-Netvisor-Organisation-ID: $organisationIdentifier\r\n".  
	    "X-Netvisor-Authentication-TransactionId: $transactionIdentifier\r\n".
	    "X-Netvisor-Authentication-MAC: $getMAC\r\n"
	; 
	

$post['hinta_alv_0'] = str_replace(",",".",$post['hinta_alv_0']);
$post['hinta_alv_sis'] = str_replace(",",".",$post['hinta_alv_0']);

$xml = '
<root>
  <product>
    <productbaseinformation>
      <productcode>'.$v->tr_rivi.'</productcode>
      <productgroup>'.$post['ryhma'].'</productgroup>
      <name>'.$post['tuotenimi'].'</name>
      <description></description>
      <unitprice type="net">'.$post['hinta_alv_0'].'</unitprice>
      <unit>'.$post['yksikko'].'</unit>
      <unitweight>1</unitweight>
      <purchaseprice>'.$post['hinta_alv_sis'].'</purchaseprice>
      <tariffheading></tariffheading>
      <comissionpercentage>0</comissionpercentage>
      <isactive>1</isactive>
      <issalesproduct>0</issalesproduct>
      <inventoryenabled>1</inventoryenabled>
    </productbaseinformation>
    <productbookkeepingdetails>
      <defaultvatpercentage>'.$post['alv'].'</defaultvatpercentage>
    </productbookkeepingdetails>
  </product>
</root>';
	
	$optsPOST = array(
	  'http'=>array(
	    'method'=>"POST",
	    'header'=>"Accept: text/plain\r\n" .
	              "Content-Type: application/x-www-form-urlencoded\r\n".
	              "Content-Length: ".strlen($xml)."\r\n".
		      $auth_data,
	    'content'=> $xml
	  )
	);
	
	$context = stream_context_create($optsPOST);
	
	$response = file_get_contents($url, false, $context);
	$result = new SimpleXMLElement($response);
	
	
	  if($result->ResponseStatus->Status == 'OK')
	  {
		if( $tila == 'add' )
		$return=$result->Replies->InsertedDataIdentifier;
		if( $tila == 'edit' )
		$return=$result;

	  } else {

		echo '<pre>';
		print_r( $response );
		echo '</pre>';

	  }

	


	} // if isset $n[0]

		return $return;


	}
}
