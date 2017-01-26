<?php

class AsiakkaatController extends Controller
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
		$model=new Asiakkaat;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Asiakkaat']))
		{
			$model->attributes=$_POST['Asiakkaat'];

			if(!isset($_POST['Asiakkaat']['eriosoite']))
			$model->eriosoite = '';

			if($model->save())
			{

			   // <-- Netvisor
			   $a = Asetukset::model()->findbypk(1);
			   if($a->netvisor_kaytto == 1)
			   {
					$InsertedDataIdentifier = $this->netvisorCustomer("add", $model);
					if(!empty($InsertedDataIdentifier))
					Asiakkaat::model()->updateByPk($model->id, array('netvisorkey'=>$InsertedDataIdentifier));
			   }
			   //  Netvisor -->


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
		$this->performAjaxValidation($model);

		if(isset($_POST['Asiakkaat']))
		{
			$model->attributes=$_POST['Asiakkaat'];

			if(!isset($_POST['Asiakkaat']['eriosoite']))
			$model->eriosoite = '';

			if($model->save())
			{

			   // <-- Netvisor
			   $a = Asetukset::model()->findbypk(1);
			   if($a->netvisor_kaytto == 1)
			   {
				if($model->netvisorkey == 0)
				{
					$InsertedDataIdentifier = $this->netvisorCustomer("add", $model);
					if(!empty($InsertedDataIdentifier))
					Asiakkaat::model()->updateByPk($model->id, array('netvisorkey'=>$InsertedDataIdentifier));

				} else {

					$InsertedDataIdentifier = $this->netvisorCustomer("edit", $model);

				}
			    }
			   //  Netvisor -->

				$this->redirect(array('view','id'=>$model->id));
			}
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

       		$criteria = new CDbCriteria();

		if(isset($_POST['osoite']) and !empty($_POST['osoite']))
	        $criteria->addCondition (" osoite LIKE '%".$_POST['osoite']."%' ");

		if(isset($_POST['sahkoposti']) and !empty($_POST['sahkoposti']))
	        $criteria->addCondition (" sahkoposti LIKE '%".$_POST['sahkoposti']."%' ");

		$dataProvider=new CActiveDataProvider('Asiakkaat', array(
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
		$model=new Asiakkaat('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Asiakkaat']))
			$model->attributes=$_GET['Asiakkaat'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Asiakkaat the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Asiakkaat::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Asiakkaat $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='asiakkaat-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	protected function netvisorCustomer($tila, $model)
	{

		$return = '';
		$site = Yii::app()->createController('Site');
		$n = $site[0]->netvisorYhteys();

	if(isset($n[0]))
	{
		if( $tila == 'add' )
		$url		= $n[0].'/customer.nv?method=add';
		if( $tila == 'edit' and !empty($model->netvisorkey))
		$url		= $n[0].'/customer.nv?id='.$model->netvisorkey.'&method=edit';

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
	
	
	$name = 'Ei tietoja';
	if(!empty($model->yrityksen_nimi))
	$name = $model->yrityksen_nimi;
	elseif(empty($model->yrityksen_nimi) and !empty($model->yhteyshenkilo))
	$name = $model->yhteyshenkilo;


$xml = '
<root>
  <customer>
    <customerbaseinformation>
      <internalidentifier>'.$model->asiakasnumero.'</internalidentifier>
      <externalidentifier>'.$model->y_tunnus.'</externalidentifier>
      <name>'.$name.'</name>
      <nameextension></nameextension>
      <streetaddress>'.$model->osoite.'</streetaddress>
      <city>'.$model->postitoimipaikka.'</city>
      <postnumber>'.$model->postinumero.'</postnumber>
      <country type="ISO-3166">FI</country>
      <customergroupname>'.$model->ryhma.'</customergroupname>
      <phonenumber>'.$model->puhelinnumero.'</phonenumber>
      <faxnumber></faxnumber>
      <email>'.$model->sahkoposti.'</email>
      <isactive>'.$model->aktiivinen.'</isactive>
    </customerbaseinformation>
    <customerfinvoicedetails>
      <finvoiceaddress>'.$model->verkkolaskuosoite.'</finvoiceaddress>
      <finvoiceroutercode>'.$model->valittajatunnus.'</finvoiceroutercode>
    </customerfinvoicedetails>
    <customerdeliverydetails>
      <deliveryname>'.$name.'</deliveryname>
      <deliverystreetaddress>'.$model->osoite.'</deliverystreetaddress>
      <deliverycity>'.$model->postitoimipaikka.'</deliverycity>
      <deliverypostnumber>'.$model->postinumero.'</deliverypostnumber>
      <deliverycountry type="ISO-3166">FI</deliverycountry>
    </customerdeliverydetails>
      <customercontactdetails>
      <contactperson>'.$name.'</contactperson>
      <contactpersonemail>'.$model->sahkoposti.'</contactpersonemail>
      <contactpersonphone>'.$model->puhelinnumero.'</contactpersonphone>
    </customercontactdetails>
    <customeradditionalinformation>
      <customerreferencenumber></customerreferencenumber>
    </customeradditionalinformation>
  </customer>
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
		$return=$result->Replies->InsertedDataIdentifier;
	  } else {

		echo '<pre>';
		print_r( $response );
		echo '</pre>';
		exit;

	  }

	
	} // if isset $n[0]

		return $return;


	}
}
