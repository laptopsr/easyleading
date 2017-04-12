<?php

class LaskutusTuotteetController extends Controller
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
				'users'=>array('admin'),
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
		$model=new LaskutusTuotteet;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LaskutusTuotteet']))
		{
			$model->attributes=$_POST['LaskutusTuotteet'];
			if($model->save())
			{

			   // <-- Netvisor
			   $a = Asetukset::model()->findbypk(1);
			   if($a->netvisor_kaytto == 1)
			   {
					$InsertedDataIdentifier = $this->netvisorProduct("add", $model);
					if(!empty($InsertedDataIdentifier))
					LaskutusTuotteet::model()->updateByPk($model->id, array('netvisorkey'=>$InsertedDataIdentifier));

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
		// $this->performAjaxValidation($model);

		if(isset($_POST['LaskutusTuotteet']))
		{
			$model->attributes=$_POST['LaskutusTuotteet'];
			if($model->save())
			{
			   // <-- Netvisor
			   $a = Asetukset::model()->findbypk(1);
			   if($a->netvisor_kaytto == 1)
			   {
				if($model->netvisorkey == 0)
				{
					$InsertedDataIdentifier = $this->netvisorProduct("add", $model);
					if(!empty($InsertedDataIdentifier))
					LaskutusTuotteet::model()->updateByPk($model->id, array('netvisorkey'=>$InsertedDataIdentifier));

				} else {

					$InsertedDataIdentifier = $this->netvisorProduct("edit", $model);

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
	        $criteria->order = " id DESC ";


		$dataProvider=new CActiveDataProvider('LaskutusTuotteet', array(
			'criteria'=>$criteria,
			//'pagination'=>false
		));

		$dataProvider->pagination->pageSize = 50;

		$a = Asetukset::model()->findbypk(1);
		if($a->netvisor_kaytto == 1)
		$netvisor = true;
		else
		$netvisor = false;

		$this->render('index', array('dataProvider' => $dataProvider, 'netvisor' => $netvisor));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LaskutusTuotteet('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LaskutusTuotteet']))
			$model->attributes=$_GET['LaskutusTuotteet'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return LaskutusTuotteet the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=LaskutusTuotteet::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param LaskutusTuotteet $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='laskutus-tuotteet-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function onkoNetvisor($id)
	{

		$return = 'vv';
		$as = LaskutusTuotteet::model()->findbypk($id);
		if(isset($as->id) and $as->netvisorkey != 0)
		{
		$return = CHtml::Button(Yii::t('main', 'Sync'), array(
		'submit'=>array('netvisor_sync', "tila"=>"edit", "id"=>$id), 
		'confirm' => 'Haluatko varmaasti synkronoida Netvisoriin?',
		'class'=>'btn btn-warning btn-block'
		));
		} elseif(isset($as->id) and empty($as->netvisorkey)){
		$return = CHtml::Button(Yii::t('main', 'Tuonti'), array(
		'submit'=>array('netvisor_sync', "tila"=>"add", "id"=>$id), 
		'confirm' => 'Haluatko varmaasti synkronoida Netvisoriin?',
		'class'=>'btn btn-success btn-block'
		));
		}

		return $return;
	}

	protected function netvisorProduct($tila, $model)
	{

		$return = '';
		$site = Yii::app()->createController('Site');
		$n = $site[0]->netvisorYhteys();

	if(isset($n[0]))
	{
		if( $tila == 'add' )
		$url		= $n[0].'/product.nv?method=add';
		if( $tila == 'edit' and !empty($model->netvisorkey))
		$url		= $n[0].'/product.nv?id='.$model->netvisorkey.'&method=edit';

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
	

$model->hinta_alv_0 = str_replace(",",".",$model->hinta_alv_0);
$model->hinta_alv_sis = str_replace(",",".",$model->hinta_alv_0);

$xml = '
<root>
  <product>
    <productbaseinformation>
      <productcode>'.$model->id.'</productcode>
      <productgroup>'.$model->ryhma.'</productgroup>
      <name>'.$model->tuotenimi.'</name>
      <description></description>
      <unitprice type="net">'.$model->hinta_alv_0.'</unitprice>
      <unit>'.$model->yksikko.'</unit>
      <unitweight>1</unitweight>
      <purchaseprice>'.$model->hinta_alv_sis.'</purchaseprice>
      <tariffheading></tariffheading>
      <comissionpercentage>0</comissionpercentage>
      <isactive>1</isactive>
      <issalesproduct>0</issalesproduct>
      <inventoryenabled>1</inventoryenabled>
    </productbaseinformation>
    <productbookkeepingdetails>
      <defaultvatpercentage>'.$model->alv.'</defaultvatpercentage>
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
