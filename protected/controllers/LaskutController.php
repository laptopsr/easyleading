<?php

class LaskutController extends Controller
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

	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','index','view','etsikohde','etsiasiakas', 'etsisaaja','luoKohteista', 'luoAsiakaasta', 'tr_rivit', 'tr_rivitkk','lasku_pdf', 'finvoice', 'postita', 'tr_rivit_tyhja','valitsetuote', 'hyvityslasku', 'postita_pdf', 'get_historia', 'kohteen_tieto', 'osoite_haku', 'indexnv', 'updatenv', 'laheta_valitsemmat'),
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

	protected function num($val){
	    if($val > 0)
		return  number_format((float)$val/3600, 2, '.', '');
	}

	public function actionTr_rivit_tyhja()
	{
		$this->renderPartial('tr_rivit_tyhja');
	}


	public function actionOsoite_haku()
	{

				$result = '';

		if(isset($_POST['word']))
		{
       			$criteria = new CDbCriteria();
       			$criteria->condition = " osoite LIKE '%".$_POST['word']."%' ";
			$k=Kohteet::model()->findAll($criteria);
			if(isset($k[0]))
			{

				$result .= '<br><select class="form-control" id="loytyiOsoitteet">';
				$result .= '<option>'.Yii::t('main', 'Valitse asiakkaita kohteista').'</option>';
				foreach($k as $data)
				{
					$a=Asiakkaat::model()->findbypk($data->asiakas_id);
					$result .= '<option value="'.$a->asiakasnumero.'">'.$data->osoite.'</option>';
				}
				$result .= '</select>';

			}	
		}

				echo json_encode($result);

	}


	public function actionKohteen_tieto()
	{

		if(isset($_POST['id']))
		{
			$k=Kohteet::model()->findbypk($_POST['id']);
			if(isset($k->id))
			{
				echo json_encode($k->hinnoittelu."//");
			}	
		}
	}

	public function actionHyvityslasku($id)
	{

		$lasku = $this->loadModel($id);

		$asetukset=Asetukset::model()->findbypk(1);

		// <-- Jos netvisor niin laskunumero on seurava

       			$criteria = new CDbCriteria();
	       		$criteria->order = " laskunumero!='' DESC,id DESC ";
			$vm = Laskut::model()->find($criteria);
			if(isset($vm->id) and empty($model->laskunumero))
			$lasku->laskunumero = $vm->laskunumero+1;

		//     Jos netvisor niin laskunumero on seurava -->


		$model=new Laskut;
		$model->attributes=$lasku->attributes;
		$model->hyvityslasku=$lasku->id;
		$model->laskun_nimetys="Hyvityslasku";
		$model->yhteensa_total='-'.$lasku->yhteensa_total;
		$model->netvisorkey='';
		if($model->save()){

		$laskunRivit=LaskunRivit::model()->findAll("lid='".$lasku->id."'");
		foreach($laskunRivit as $rivit)
		{
		$lm=new LaskunRivit;
		$lm->attributes=$rivit->attributes;
		$lm->lid=$model->id;
		//$lm->hinta='-'.$rivit->hinta;
		$lm->kpl='-'.$rivit->kpl;
		$lm->hinta_alv='-'.$rivit->hinta_alv;
		$lm->veroton='-'.$rivit->veroton;
		$lm->yhteensa_alv='-'.$rivit->yhteensa_alv;
		$lm->save();
		}


		// Lasku historia
		$historia = new LaskuHistoria;
		$historia->lid = $model->id;
		$historia->status = 'HYVITYSLASKU';
		$historia->palvelu = "local";
		$historia->yht_euro = $model->yhteensa_total;
		$historia->save();

		$this->redirect(array('update','id'=>$model->id));

		} else {
		var_dump($model->getErrors());
		}


	}

	public function actionPostita()
	{
       		$criteria = new CDbCriteria();
       		$criteria->condition = " postita_jobid!='' ";
		$lasku = Lasku::model()->findAll($criteria);
		$asetukset=Asetukset::model()->find("id=1");
		$firmanTiedot=FirmanTiedot::model()->find("id=1");


		$this->render('postita', 

			array(
			'lasku'=>$lasku,
			'asetukset'=>$asetukset,
			'yritys'=>$firmanTiedot,

			));

	}

	public function actionFinvoice($id)
	{

		$lasku=$this->loadModel($id);
		$laskunRivit=LaskunRivit::model()->findAll("lid='".$id."'");
		$asetukset=Asetukset::model()->find("id=1");


		$this->renderPartial('finvoice', 

			array(
			'lasku'=>$lasku,
			'asetukset'=>$asetukset,
			'laskunRivit'=>$laskunRivit,
			));

	}

	public function Lasku_pdf($id)
	{

		$lasku=$this->loadModel($id);
		$laskunRivit=LaskunRivit::model()->findAll("lid='".$id."'");
		$asetukset=Asetukset::model()->find("id=1");


	        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en');
		$html2pdf->setDefaultFont('Arial');
	        $html2pdf->WriteHTML($this->renderPartial('lasku_pdf', 
			array(
			'lasku'=>$lasku,
			'asetukset'=>$asetukset,
			'laskunRivit'=>$laskunRivit,
			),true));
		//$content_PDF = $html2pdf->Output('my_doc.pdf', EYiiPdf::OUTPUT_TO_STRING);
		return $html2pdf->Output();
	}


	public function actionLasku_pdf($id)
	{

		$lasku=$this->loadModel($id);
		$laskunRivit=LaskunRivit::model()->findAll("lid='".$id."'");
		$asetukset=Asetukset::model()->find("id=1");


	          $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en');
		  $html2pdf->setDefaultFont('Arial');
	          $html2pdf->WriteHTML($this->renderPartial('lasku_pdf', 
			array(
			'lasku'=>$lasku,
			'asetukset'=>$asetukset,
			'laskunRivit'=>$laskunRivit,
			),true));
	          $html2pdf->Output();


	}


	public function actionTr_rivit($id)
	{

		$num 		= $_POST['num'];
		$kpl 		= $_POST['kpl'];
		$from 		= $_POST['from'];
		$to 		= $_POST['to'];
		$hinta 		= $_POST['hinta'];
		$yksikko 	= $_POST['yksikko'];
		$onkokohde 	= $_POST['onkokohde'];

		$this->renderPartial('tr_rivit',array(
			'from'=>$from,
			'to'=>$to,
			'num'=>$num,
			'kohde'=>$id,
			'kpl'=>$kpl,
			'hinta'=>$hinta,
			'yksikko'=>$yksikko,
			'onkokohde'=>$onkokohde,
		));
	}

	public function actionValitsetuote()
	{

	  if(isset($_POST['tuoteID']))
	  {
		$tuoteID = $_POST['tuoteID'];
		$tuote = VarastoRakenne::model()->findbypk($tuoteID);
		$val = json_decode($tuote->value, true);
		if(is_array($val))
		{
			$tuotenimi = $val['tuotenimi'];
			$hinta_alv_0 = $val['hinta_alv_0'];
			$alv = $val['alv'];
			$yksikko = $val['yksikko'];
			$hinta_alv_sis = $val['hinta_alv_sis'];

			echo json_encode(array(
				'tuotenimi'=>$tuotenimi,
				'hinta_alv_0'=>$hinta_alv_0,
				'alv'=>$alv,
				'yksikko'=>$yksikko,
				'hinta_alv_sis'=>$hinta_alv_sis,
				'tuoteID'=>$tuoteID
			));
			exit;
		} else {
			echo json_encode(array('ERROR'=>'Tuote error'));
			exit;
		}
	  }

		echo json_encode(array('ERROR'=>'Tuote error'));

	}

	public function actionluoAsiakaasta($id)
	{
		echo 1;
	}



	public function actionEtsisaaja($id)
	{
		$a = Asetukset::model()->findbypk($id);
		echo $a->iban;
	}

	public function actionEtsiasiakas($id)
	{

		$a = Asiakkaat::model()->find(" asiakasnumero='".$id."' ");


		$tyyppi = '';
		if(!empty($a->yrityksen_nimi))
		$tyyppi = "yritys**".$a->yrityksen_nimi."**".$a->y_tunnus;

		if(empty($a->yrityksen_nimi) and !empty($a->yhteyshenkilo))
		$tyyppi = "henkilo**".$a->yhteyshenkilo;

		$kodeOn = 0;

		$erapaiva = '';
		if(!empty($a->maksuehto))
		$erapaiva = date("d.m.Y",strtotime("+$a->maksuehto day"));

		echo json_encode($a->laskutuskanava."//".$a->maksuehto."//".$tyyppi."//".$a->osoite."//".$a->postinumero."//".$a->postitoimipaikka."//".$a->yhteyshenkilo."//".$a->puhelinnumero."//".$kodeOn."//".$erapaiva."//".$a->valittajatunnus."//".$a->verkkolaskuosoite."//0//".$a->kirjeluokka."//".$a->sahkoposti."//".$a->viivastyskorko);
	}


	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	protected function yksikkot($row){
		$body = '';
		if($row)
		$body .= '<option value="'.$row.'">'.$row.' kpl</option>';

		$site = Yii::app()->createController('Site');
		$l = $site[0]->Yksikkot();

		    foreach($l as $v)
		    {
			$body .= '<option value="'.$v.'">'.$v.'</option>';
		    }

		return $body;
	}

	protected function alv($row){
		$body = '';
		if($row)
		$body .= '<option value="'.$row.'">'.$row.'</option>';
		$body .= '<option value="24">24</option>';
		for ($i = 0; $i <= 100 ; $i++) {
		    $body .= '<option value='.$i.'>'.$i.'</option>';
		}
		return $body;
	}

	protected function Viite($string)
	{

		$string = strval($string);
		$paino = array(7, 3, 1);
		$summa = 0;

		  for($i=strlen($string)-1, $j=0; $i>=0; $i--,$j++){
		    $summa += (int) $string[$i] * (int) $paino[$j%3];
		  }
		$tarkiste = (10-($summa%10))%10;
		return $string.$tarkiste;

	}

	public function actionCreate()
	{


		$model=new Laskut;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Laskut']))
		{

			//$vm = Lasku::model()->find(array('order'=>'id DESC'));

			$model->attributes=$_POST['Laskut'];
			$model->tilanne=0;
			$model->tapahtumapvm=date("Y-m-d H:i:s");
			$model->paivays=date("Y-m-d", strtotime($_POST['Laskut']['paivays']));
			$model->erapaiva=date("Y-m-d", strtotime($_POST['Laskut']['erapaiva']));
			$model->laskun_nimetys="Lasku";
			if($model->save()){


			// Viite
			$viite = $this->Viite($model->as_nro."00".$model->id);
			Laskut::model()->updatebypk($model->id, array('viitenumero'=>$viite));

			$as = Asiakkaat::model()->find(" asiakasnumero='".$model->as_nro."'  ");


			foreach($_POST['tkoodi'] as $key=>$val)
			{
				$lr = new LaskunRivit;
				$lr->lid	=$model->id;
				$lr->rivi	=$key;
				$lr->tkoodi	=$_POST['tkoodi'][$key];
				$lr->free_text	=$_POST['free_text'][$key];
				$lr->kpl	=$_POST['kpl'][$key];
				$lr->yksikko	=$_POST['yksikko'][$key];
				$lr->hinta	=$_POST['hinta'][$key];
				$lr->alv	=$_POST['alv'][$key];
				$lr->hinta_alv	=$_POST['hinta_alv'][$key];
				$lr->ale	=$_POST['ale'][$key];

				if(isset($_POST['tuoteID']))
					$lr->tuoteID	=$_POST['tuoteID'][$key];


				$lr->veroton	=$_POST['veroton'][$key];
				$lr->yhteensa_alv=$_POST['yhteensa_alv'][$key];
				$lr->save();
			}


		    		// Lasku historia
				$historia = new LaskuHistoria;
				$historia->lid = $model->id;
				$historia->status = "Lasku luotu";
				$historia->palvelu = "local";
				$historia->yht_euro = $model->yhteensa_total;
				$historia->save();

				$this->redirect(array('update','id'=>$model->id));
				//$this->redirect(array('admin'));
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
		$laskunRivit=LaskunRivit::model()->findAll("lid='".$id."'");

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_GET['tilanne']) and $_GET['tilanne'] == '1')
		{
			Laskut::model()->updatebypk($id, array('tilanne'=>1));
			$this->redirect(array('update','id'=>$model->id));
		}

		if(isset($_POST['Laskut']))
		{
			$model->attributes=$_POST['Laskut'];
			$model->paivays=date("Y-m-d", strtotime($_POST['Laskut']['paivays']));
			$model->erapaiva=date("Y-m-d", strtotime($_POST['Laskut']['erapaiva']));
			if($model->save()){


			LaskunRivit::model()->deleteAll("lid='".$id."'");


			if(isset($_POST['tkoodi']))
			{
			  foreach($_POST['tkoodi'] as $key=>$val)
			  {
				$lr = new LaskunRivit;
				$lr->lid	=$model->id;
				$lr->rivi	=$key;
				$lr->tkoodi	=$_POST['tkoodi'][$key];
				$lr->free_text	=$_POST['free_text'][$key];
				$lr->kpl	=$_POST['kpl'][$key];
				$lr->yksikko	=$_POST['yksikko'][$key];
				$lr->hinta	=$_POST['hinta'][$key];
				$lr->alv	=$_POST['alv'][$key];
				$lr->hinta_alv	=$_POST['hinta_alv'][$key];
				$lr->ale	=$_POST['ale'][$key];

				if(isset($_POST['tuoteID']))
					$lr->tuoteID	=$_POST['tuoteID'][$key];

				$lr->veroton	=$_POST['veroton'][$key];
				$lr->yhteensa_alv=$_POST['yhteensa_alv'][$key];
				$lr->save();
			  }
			}

		    		// Lasku historia
				$historia = new LaskuHistoria;
				$historia->lid = $model->id;
				$historia->status = "Lasku on muokattu";
				$historia->palvelu = "local";
				$historia->yht_euro = $model->yhteensa_total;
				$historia->save();

				$this->redirect(array('update','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'laskunRivit'=>$laskunRivit,
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
		LaskunRivit::model()->deleteAll(" lid='".$id."' ");
		LaskuHistoria::model()->deleteAll("lid='".$id."'");

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		$lahettamattomat = false;
		//$asetukset=Asetukset::model()->findbypk(1);

		$from = date("Y-m-d", strtotime("first day of this month"));
		$to = date("Y-m-d");

		if(isset($_POST['from']) and isset($_POST['to'])){
		$from 	= date("Y-m-d",strtotime($_POST['from']));
		$to 	= date("Y-m-d",strtotime($_POST['to']));
		}


		// <!-- Lasku updater
		$info 	= '';
		$info 	.= $this->LaskuUpdater($from,$to);
		// Lasku updater -->

       		$criteria = new CDbCriteria();
	        $criteria->order = "  id DESC ";


		if(Yii::app()->request->getPost('asiakasLaskulle'))
       		$criteria->addCondition ( " as_nro='".Yii::app()->request->getPost('asiakasLaskulle')."' " );

        	$criteria->addCondition ("DATE(paivays) BETWEEN 
			'".$from."' AND '".$to."' 
		");

		if(isset($_POST['laskunumero']) and !empty(trim($_POST['laskunumero'])))
	        $criteria->addCondition (" laskunumero LIKE '%".$_POST['laskunumero']."%' ");

		if(isset($_POST['viitenumero']) and !empty(trim($_POST['viitenumero'])))
	        $criteria->addCondition (" viitenumero LIKE '%".$_POST['viitenumero']."%' ");

		if(isset($_POST['laskuosoite']) and !empty(trim($_POST['laskuosoite'])))
	        $criteria->addCondition (" osoite LIKE '%".$_POST['laskuosoite']."%' ");

		// <-- Luotu
		if( isset($_POST['tilaLaskulle']) and $_POST['tilaLaskulle'] == 0 )
		{
		$criteria->addCondition (" tilanne=0 ");
		}
		//  Luotu -->


		// <-- Lahetamattomat hyväksyttyt
		if( (isset($_POST['tilaLaskulle']) and $_POST['tilaLaskulle'] == 1) or (isset($_GET['lahettamattomat'])) )
		{
		$criteria->addCondition (" 
			tilanne=1 AND postita_jobid='' AND trust_jobid='' AND netvisorkey=0 
		");
		$lahettamattomat = true;
		}
		//     Lahetamattomat hyväksyttyt -->


		// LOCAL Lahetetty
		if(isset($_POST['tilaLaskulle']) and $_POST['tilaLaskulle'] == 2)
		{
		$criteria->addCondition ("
		id in (SELECT lid FROM 
			(SELECT lid FROM lasku_historia 
			   WHERE id IN (SELECT MAX(id) FROM lasku_historia GROUP BY lid)
			   AND status='LÄHETETTY'
			) as lid)
		");
		}



		$dataProvider=new CActiveDataProvider('Laskut', array(
			'criteria'=>$criteria,
			//'pagination'=>false
		));

		$dataProvider->pagination->pageSize = 200;
		$this->render('index', array(
				'dataProvider' => $dataProvider, 
				'from'=>$from, 
				'to'=>$to, 
				//'asetukset' => $asetukset,
				'info' => $info,
				'lahettamattomat' => $lahettamattomat
		));
	}


	public function actionPostita_pdf($id)
	{
		$this->renderPartial('postita_pdf',array('id'=>$id));
	}


	public function actionAdmin()
	{


		$model=new Lasku('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Lasku']))
			$model->attributes=$_GET['Lasku'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Lasku the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Laskut::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Lasku $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='lasku-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    	protected function asianro($data,$row)
	{ 
		    $job_id = '';

		if($data->postita_jobid != '')

		    $job_id = 'Postita:<br>'.$data->postita_jobid;

		if($data->trust_jobid != '')
		    $job_id = 'Trust:<br>'.$data->trust_jobid;

            	return $job_id;
	}


    	public function tilanneCheck($data)
	{ 

       		$criteria = new CDbCriteria();
       		$criteria->order = " id DESC ";
       		$criteria->condition = " lid='".$data->id."' ";
		$l = LaskuHistoria::model()->find($criteria);


		// <-- Local
		$local = false;
		$localStr = '';
		if(isset($l->palvelu) and $l->palvelu == 'local')
		{

		  if($l->status == 'LÄHETETTY'){
		   $localStr = 'Lasku lähetetty';
		   $local = true;
		  } elseif($l->status == 'MAKSUMUISTUTUS'){
		   $localStr = 'Maksumuistutus lähetetty';
		   $local = true;
		  } elseif($l->status == 'MAKSETTU'){
		   $localStr = 'Lasku maksettu';
		   $local = true;
		  } elseif($l->status == 'Lasku luotu'){
		   $localStr = 'Lasku luotu';
		   $local = true;
		  } elseif($l->status == 'HYVÄKSYTTY'){
		   $localStr = 'Lasku hyväksytty';
		   $local = true;
		  } elseif($l->status == 'Lähetetty sähköpostilla'){
		   $localStr = 'Lähetetty sähköpostilla';
		   $local = true;
		  } elseif($l->status == 'Lasku mitätöity'){
		   $localStr = 'Lasku mitätöity';
		   $local = true;
		  }

		}
		//  Local -->
		


		// <-- Netvisor
		$netvisor = false;
		$netvisorStr = '';
		if(isset($l->palvelu) and $l->palvelu == 'netvisor')
		{
		   $netvisorStr = $l->status;
		   $netvisor = true;
		}
		//  Netvisor -->
  
		$tilanne = ''; 


		if($local == true)
		    $tilanne = $localStr;
		elseif($netvisor == true)
		    $tilanne = $netvisorStr;

            	return $tilanne;
	}


    	protected function avoinnaCheck($data,$row)
	{ 

       		$criteria = new CDbCriteria();
       		$criteria->select = " yht_euro ";
       		$criteria->order = " id DESC ";
       		$criteria->condition = " lid='".$data->id."' AND yht_euro!='' ";
		$l = LaskuHistoria::model()->find($criteria);

		$yht_euro = $data->yhteensa_total;
		if(isset($l->yht_euro))
		$yht_euro = $l->yht_euro;

            	return $yht_euro;
	}

	public function actionGet_historia()
	{

	$bod = '
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		<h2 class="modal-title">'.Yii::t('main', 'Historia').' '.$_POST['id'].'</h2>
	
		</div>
		<div class="modal-body">
		<div class="dialogTable clearfix modal-osio">';

       		$criteria = new CDbCriteria();
       		$criteria->select = " time,status ";
       		$criteria->order = " id ASC ";
       		$criteria->condition = " lid='".$_POST['id']."' ";
		$lh = LaskuHistoria::model()->findAll($criteria);
		$la = Laskut::model()->findbypk($_POST['id']);

		$str = '';


		foreach($lh as $l)
		{

		// <-- Local
		  if($l->status == 'LÄHETETTY'){
		   $str .= '<b>'.date("d.m.Y H:i",strtotime($l->time)).'</b> Lasku lähetetty<br>';
		  } elseif($l->status == 'MAKSUMUISTUTUS'){
		   $str .= '<b>'.date("d.m.Y H:i",strtotime($l->time)).'</b> Maksumuistutus lähetetty<br>';
		  } elseif($l->status == 'MAKSETTU'){
		   $str .= '<b>'.date("d.m.Y H:i",strtotime($l->time)).'</b> Lasku maksettu<br>';
		  } elseif($l->status == 'Lasku luotu'){
		   $str .= '<b>'.date("d.m.Y H:i",strtotime($l->time)).'</b> Lasku luotu<br>';
		  } elseif($l->status == 'HYVÄKSYTTY'){
		   $str .= '<b>'.date("d.m.Y H:i",strtotime($l->time)).'</b> Lasku hyväksytty<br>';
		  } elseif($l->status == 'Lähetetty sähköpostilla'){
		   $str .= '<b>'.date("d.m.Y H:i",strtotime($l->time)).'</b> Lähetetty sähköpostilla<br>';
		  } elseif($l->status == 'Lasku mitätöity'){
		   $str .= '<b>'.date("d.m.Y H:i",strtotime($l->time)).'</b> Lasku mitätöity<br>';
		  } 
		//  Local -->

		}


		$bod .= $str;

	$bod .= '
		</div>
		</div>
	   </div>
	</div>';

	echo json_encode($bod);
	exit;
	}




	protected function netvisorLasku($tila, $model)
	{



		$return = '';
		$site = Yii::app()->createController('Site');
		$n = $site[0]->netvisorYhteys();

	if(isset($n[0]))
	{
		if( $tila == 'add' )
		$url		= $n[0].'/salesinvoice.nv?method=add';
		if( $tila == 'edit' and !empty($model->netvisorkey))
		$url		= $n[0].'/salesinvoice.nv?id='.$model->netvisorkey.'&method=edit';

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
	if(!empty($model->yritys))
	$name = $model->yritys;
	elseif(empty($model->yritys) and !empty($model->nimi))
	$name = $model->nimi;

	$InvoicingCustomerIdentifier = '';
	$asiakas = Asiakkaat::model()->find(" asiakasnumero='".$model->as_nro."' ");
	if(isset($asiakas->id) and $asiakas->netvisorkey != 0)
	{
		$InvoicingCustomerIdentifier = $asiakas->netvisorkey;
	} else {
		die('ERROR: Tämä asiakas ei saanut netvisorkey viellä');
	}


$xml = '
<root>
  <SalesInvoice>
    <SalesInvoiceNumber>'.$model->laskunumero.'</SalesInvoiceNumber>
    <SalesInvoiceDate format="ansi">'.date("Y-m-d", strtotime($model->paivays)).'</SalesInvoiceDate>
    <SalesInvoiceDeliveryDate format="ansi">'.date("Y-m-d", strtotime($model->paivays)).'</SalesInvoiceDeliveryDate>
    <SalesInvoiceReferenceNumber>'.$model->viitenumero.'</SalesInvoiceReferenceNumber>
    <SalesInvoiceAmount>'.$model->yhteensa_total.'</SalesInvoiceAmount>
    <SellerIdentifier type="netvisor">32</SellerIdentifier> 
    <SalesInvoiceStatus type="netvisor">unsent</SalesInvoiceStatus>
    <InvoicingCustomerIdentifier type="netvisor">'.$InvoicingCustomerIdentifier.'</InvoicingCustomerIdentifier>
    <InvoicingCustomerName>'.$name.'</InvoicingCustomerName>
    <InvoicingCustomerNameExtension></InvoicingCustomerNameExtension>
    <InvoicingCustomerAddressLine>'.$model->osoite.'</InvoicingCustomerAddressLine>
    <InvoicingCustomerPostNumber>'.$model->postinumero.'</InvoicingCustomerPostNumber>
    <InvoicingCustomerTown>'.$model->toimipaikka.'</InvoicingCustomerTown>
    <InvoicingCustomerCountryCode type="ISO-3166">FI</InvoicingCustomerCountryCode>
    <DeliveryAddressName>'.$name.'</DeliveryAddressName>
    <DeliveryAddressNameExtension>Lasku</DeliveryAddressNameExtension>
    <DeliveryAddressLine>'.$model->osoite.'</DeliveryAddressLine>
    <DeliveryAddressPostNumber>'.$model->postinumero.'</DeliveryAddressPostNumber>
    <DeliveryAddressTown>'.$model->toimipaikka.'</DeliveryAddressTown>
    <DeliveryAddressCountryCode type="ISO-3166">FI</DeliveryAddressCountryCode>
    <PaymentTermNetDays>'.$model->maksuehto.'</PaymentTermNetDays>';

$laskunRivit=LaskunRivit::model()->findAll("lid='".$model->id."'");

if(count($laskunRivit) > 0)
$xml .= '<InvoiceLines>';

foreach($laskunRivit as $rivit)
{

	$ProductIdentifier = '';
	$tuotteet = VarastoRakenne::model()->findByPk($rivit->tuoteID);
	if(isset($tuotteet->id)) {

		$val = json_decode($tuotteet->value, true);
		if(is_array($val))
		{
			if(isset($val[0]['netvisorkey'][0]))
			$ProductIdentifier = $val[0]['netvisorkey'][0];
		} else {
			die('ERROR: Tuotteella netvisorkey ei ole saattavilla');
		}

	} elseif($this->onkoOletusProductEsitetty() != false) {
			$ProductIdentifier = $this->onkoOletusProductEsitetty();
	} else {
		die('ERROR: Tuotteen netvisorkey ei esitetty');
	}


	$Comment = '';
	if(!empty($rivit->free_text)){
	$Comment = '
	<InvoiceLine>
		<SalesInvoiceCommentLine>
			<Comment>'.$rivit->free_text.'</Comment>
		    </SalesInvoiceCommentLine>
	</InvoiceLine>';
	}

$xml .= '
       <InvoiceLine>
         <SalesInvoiceProductLine>
             <ProductIdentifier type="netvisor">'.$ProductIdentifier.'</ProductIdentifier>
             <ProductName>'.$rivit->tkoodi.'</ProductName>
             <ProductUnitPrice type="net">'.$rivit->hinta.'</ProductUnitPrice>
             <ProductVatPercentage vatcode="KOMY">'.$rivit->alv.'</ProductVatPercentage>
             <SalesInvoiceProductLineQuantity>'.$rivit->kpl.'</SalesInvoiceProductLineQuantity>
             <SalesInvoiceProductLineDiscountPercentage>'.$rivit->ale.'</SalesInvoiceProductLineDiscountPercentage>
         </SalesInvoiceProductLine>
       </InvoiceLine>
            '.$Comment.'
       ';
}

if(count($laskunRivit) > 0)
$xml .= '</InvoiceLines>';

$xml .= '
  </SalesInvoice>
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
		exit;

	  }


	} // if isset $n[0]

		return $return;

	}


	protected function onkoOletusProductEsitetty()
	{

	  $tuot = VarastoRakenne::model()->find(" sarakkeen_nimi='NETVISOR_DEFAULT' ");
	  if(!isset($tuot->id))
	  {

	
		$defaultTuote = new VarastoRakenne;
		$defaultTuote->sarakkeen_nimi = 'NETVISOR_DEFAULT';
		$defaultTuote->varaston_nimike = 'NETVISOR_DEFAULT';
		$defaultTuote->sarakkeen_tyyppi = '1';
		$defaultTuote->sum = '0';
		$defaultTuote->position = '0';
		if($defaultTuote->save())
		{
	
			// <-- Netvisor
			$a = Asetukset::model()->findbypk(1);
			if($a->netvisor_kaytto == 1)
			{
				$InsertedDataIdentifier = $this->netvisorProductAddDefault();
				if(!empty($InsertedDataIdentifier))
				{
					VarastoRakenne::model()->updateByPk($defaultTuote->id, array('value'=>$InsertedDataIdentifier));
					return $InsertedDataIdentifier;
				}
	
			}
			//  Netvisor -->

		} else {
			var_dump($defaultTuote->getErrors());
		}
	  } else {
		return $tuot->value;
	  }

		return false;
	}




	protected function netvisorProductAddDefault()
	{

		$return = '';
		$site = Yii::app()->createController('Site');
		$n = $site[0]->netvisorYhteys();

	if(isset($n[0]))
	{
		$url		= $n[0].'/product.nv?method=add';

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
	


$xml = '
<root>
  <product>
    <productbaseinformation>
      <productcode>99999</productcode>
      <productgroup>Default group</productgroup>
      <name>Default product</name>
      <description></description>
      <unitprice type="net">0</unitprice>
      <unit>kpl</unit>
      <unitweight>1</unitweight>
      <purchaseprice>0</purchaseprice>
      <tariffheading></tariffheading>
      <comissionpercentage>0</comissionpercentage>
      <isactive>1</isactive>
      <issalesproduct>0</issalesproduct>
      <inventoryenabled>1</inventoryenabled>
    </productbaseinformation>
    <productbookkeepingdetails>
      <defaultvatpercentage>24</defaultvatpercentage>
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
		$return=$result->Replies->InsertedDataIdentifier;

	  } else {

		echo '<pre>';
		print_r( $response );
		echo '</pre>';

	  }

	


	} // if isset $n[0]

		return $return;


	}


	protected function netvisorGetsalesinvoice($netvisorkey)
	{

		$return = '';
		$site = Yii::app()->createController('Site');
		$n = $site[0]->netvisorYhteys();

	  if(isset($n[0]))
	  {
		$url		= $n[0].'/getsalesinvoice.nv?netvisorkey='.$netvisorkey;
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
		    "X-Netvisor-Authentication-MAC: $getMAC\r\n"; 
		
	
		$optsGET = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Accept: text/plain\r\n" .
		              "Content-Type: application/x-www-form-urlencoded\r\n".
			      $auth_data,
		    'content'=> ''
		  )
		);
	
		$context = stream_context_create($optsGET);
		
		$response = file_get_contents($url, false, $context);
		$return = new SimpleXMLElement($response);
	   }

		return $return;
	}


	protected function netvisorList($lastmodifiedstart, $lastmodifiedend)
	{

		$return = '';
		$site = Yii::app()->createController('Site');
		$n = $site[0]->netvisorYhteys();

	  if(isset($n[0]))
	  {
		$url		= $n[0].'/salesinvoicelist.nv?lastmodifiedstart='.$lastmodifiedstart.'&lastmodifiedend='.$lastmodifiedend;
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
		    "X-Netvisor-Authentication-MAC: $getMAC\r\n"; 
		
	
		$optsGET = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Accept: text/plain\r\n" .
		              "Content-Type: application/x-www-form-urlencoded\r\n".
			      $auth_data,
		    'content'=> ''
		  )
		);
	
		$context = stream_context_create($optsGET);
		
		$response = file_get_contents($url, false, $context);
		$return = new SimpleXMLElement($response);

	   }

		return $return;
	}

	public function actionIndexnv()
	{
		$result = $this->netvisorList(null,null);
		$this->render('indexnv', array('result'=>$result));
	}


	
	public function actionUpdatenv($id)
	{

/*

		$return = '';
		$site = Yii::app()->createController('Site');
		$n = $site[0]->netvisorYhteys();

	  if(isset($n[0]))
	  {

		if(isset($_POST['Sales_Invoice_Number']))
		$url		= $n[0].'/salesinvoice.nv?id='.$id.'&method=edit';
		else
		$url		= $n[0].'/getsalesinvoice.nv?netvisorkey='.$id;

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
		    "X-Netvisor-Authentication-MAC: $getMAC\r\n"; 
		

		// update -->
		if(isset($_POST['Sales_Invoice_Number']))
		{

		header("Content-Type: text/html; charset=utf-8");



$xml = '
<root>
  <SalesInvoice>
    <SalesInvoiceDate format="ansi">'.date("Y-m-d", strtotime($_POST['Sales_Invoice_Date'])).'</SalesInvoiceDate>
    <SalesInvoiceDeliveryDate format="ansi">'.date("Y-m-d", strtotime($_POST['Sales_Invoice_Delivery_Date'])).'</SalesInvoiceDeliveryDate>
    <SalesInvoiceReferenceNumber>'.$_POST['Sales_Invoice_Reference_Number'].'</SalesInvoiceReferenceNumber>
    <SalesInvoiceAmount>'.$_POST['Sales_Invoice_Amount'].'</SalesInvoiceAmount>
    <SellerIdentifier type="netvisor">32</SellerIdentifier> 
    <SalesInvoiceStatus type="netvisor">'.$_POST['Sales_Invoice_Status'].'</SalesInvoiceStatus>
    <InvoicingCustomerIdentifier type="netvisor">1</InvoicingCustomerIdentifier>
    <InvoicingCustomerName>'.$_POST['Invoicing_Customer_Name'].'</InvoicingCustomerName>
    <InvoicingCustomerNameExtension></InvoicingCustomerNameExtension>
    <InvoicingCustomerAddressLine>'.$_POST['Invoicing_Customer_Address_Line'].'</InvoicingCustomerAddressLine>
    <InvoicingCustomerPostNumber>'.$_POST['Invoicing_Customer_Postnumber'].'</InvoicingCustomerPostNumber>
    <InvoicingCustomerTown>'.$_POST['Invoicing_Customer_Town'].'</InvoicingCustomerTown>
    <InvoicingCustomerCountryCode type="ISO-3166">FI</InvoicingCustomerCountryCode>
    <DeliveryAddressName>'.$_POST['Delivery_Address_Name'].'</DeliveryAddressName>
    <DeliveryAddressNameExtension>Lasku</DeliveryAddressNameExtension>
    <DeliveryAddressLine>'.$_POST['Delivery_Address_Line'].'</DeliveryAddressLine>
    <DeliveryAddressPostNumber>'.$_POST['Delivery_Address_Postnumber'].'</DeliveryAddressPostNumber>
    <DeliveryAddressTown>'.$_POST['Delivery_Address_Town'].'</DeliveryAddressTown>
    <DeliveryAddressCountryCode type="ISO-3166">FI</DeliveryAddressCountryCode>
    <PaymentTermNetDays>'.$_POST['Payment_Term_Net_Days'].'</PaymentTermNetDays>
    <PaymentTermCashDiscountDays>'.$_POST['Payment_Term_Cash_Discount_Days'].'</PaymentTermCashDiscountDays>
';


if(count($_POST['InvoiceLine']['ProductName']) > 0)
$xml .= '<InvoiceLines>';

$forLaskuRivit = array();
foreach($_POST['InvoiceLine']['ProductName'] as $key=>$rivit)
{

$xml .= '
       <InvoiceLine>
          <SalesInvoiceProductLine>
             <ProductIdentifier type="netvisor">8</ProductIdentifier>
             <ProductName>'.$_POST['InvoiceLine']['ProductName'][$key].'</ProductName>
             <ProductUnitPrice type="net">'.$_POST['InvoiceLine']['ProductUnitPrice'][$key].'</ProductUnitPrice>
             <ProductVatPercentage vatcode="KOMY">'.$_POST['InvoiceLine']['ProductVatPercentage'][$key].'</ProductVatPercentage>
             <SalesInvoiceProductLineQuantity>'.$_POST['InvoiceLine']['SalesInvoiceProductLineQuantity'][$key].'</SalesInvoiceProductLineQuantity>
             <SalesInvoiceProductLineDiscountPercentage>'.$_POST['InvoiceLine']['SalesInvoiceProductLineDiscountPercentage'][$key].'</SalesInvoiceProductLineDiscountPercentage>
             <AccountingAccountSuggestion>3000</AccountingAccountSuggestion> 
             <Dimension>
                <DimensionName>Liiketoimintayksikkö laskentakohteena</DimensionName>
                <DimensionItem>Yleishallinto</DimensionItem>
             </Dimension>
             <Dimension>
                <DimensionName>Severan "työ" laskentakohteena</DimensionName>
                <DimensionItem>Makkaran paisto</DimensionItem>
             </Dimension>
           </SalesInvoiceProductLine>
       </InvoiceLine>';

	$forLaskuRivit[] = array(
	   $_POST['InvoiceLine']['ProductName'][$key],
	   $_POST['InvoiceLine']['ProductUnitPrice'][$key],
	   $_POST['InvoiceLine']['ProductVatPercentage'][$key],
	   $_POST['InvoiceLine']['SalesInvoiceProductLineQuantity'][$key],
	   $_POST['InvoiceLine']['SalesInvoiceProductLineDiscountPercentage'][$key]
	);
}

if(count($_POST['InvoiceLine']['ProductName']) > 0)
$xml .= '</InvoiceLines>';

$xml .= '
  </SalesInvoice>
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

		$l = Lasku::model()->find(" netvisorkey='".$id."' ");
		if(isset($l->id))
		{

			Lasku::model()->updateByPk($l->id, array(
				'paivays'=>date("Y-m-d", strtotime($_POST['Sales_Invoice_Date'])),
				'toimituspaiva'=>date("Y-m-d", strtotime($_POST['Sales_Invoice_Delivery_Date'])),
				'viitenumero'=>$_POST['Sales_Invoice_Reference_Number'],
				'yhteensa_total'=>$_POST['Sales_Invoice_Amount'],
				'viitenumero'=>$_POST['Sales_Invoice_Reference_Number'],
				'response'=>$_POST['Sales_Invoice_Status'],
				'nimi'=>$_POST['Invoicing_Customer_Name'],
				'osoite'=>$_POST['Invoicing_Customer_Address_Line'],
				'postinumero'=>$_POST['Invoicing_Customer_Postnumber'],
				'toimipaikka'=>$_POST['Invoicing_Customer_Town']
			));

		    	LaskunRivit::model()->deleteAll("lid='".$l->id."'");


			if(count($forLaskuRivit) > 0)
			{
			   foreach($forLaskuRivit as $key=>$val)
			   {
				$lr = new LaskunRivit;
				$lr->lid	=$l->id;
				$lr->rivi	=$key;
				$lr->tkoodi	=$forLaskuRivit[$key][0]; // on nimetus
				$lr->kpl	=$forLaskuRivit[$key][3];
				//$lr->yksikko	=$_POST['yksikko'][$key];
				$lr->hinta	=$forLaskuRivit[$key][1];
				$lr->alv	=$forLaskuRivit[$key][2];
				//$lr->hinta_alv	=$_POST['hinta_alv'][$key];
				$lr->ale	=$forLaskuRivit[$key][4];
				//$lr->veroton	=$_POST['veroton'][$key];
				//$lr->yhteensa_alv=$_POST['yhteensa_alv'][$key];
				if(!$lr->save())
				print_r($lr->getErrors()).'<br>';
			   }
			}


		}

			$this->redirect(array('indexnv'));

			echo '<pre>';
			print_r($result);
			echo '</pre>';
			exit;

	  } else {

			echo '<pre>';
			print_r($result);
			echo '</pre>';
			exit;
	  }



		}
		// loppu update -->


	
		$optsGET = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Accept: text/plain\r\n" .
		              "Content-Type: application/x-www-form-urlencoded\r\n".
			      $auth_data,
		    'content'=> ''
		  )
		);
	
		$context = stream_context_create($optsGET);
		
		$response = file_get_contents($url, false, $context);
		$result = new SimpleXMLElement($response);
	
		$this->render('updatenv', array('id'=>$id, 'result'=>$result));

	  }
*/
	}



	public function LaskuUpdater($from,$to)
	{
		$return = '';
		$asetukset=Asetukset::model()->findbypk(1);

		// <-- Netvisor updater
		$netvisorUpdateCheck = false;
		if($asetukset->netvisor_kaytto == 1)
		{

			$netvisorList = $this->netvisorList(date("Y-m-d",strtotime($from)),date("Y-m-d",strtotime($to.' +1 day')));
			if($netvisorList->ResponseStatus->Status == 'OK')
			{
				foreach($netvisorList->SalesInvoiceList->SalesInvoice as $list)
				{
	
					//echo '<pre>';
					//print_r( $list );
					//echo '</pre>';
	
					$getLaskun = $this->netvisorGetsalesinvoice($list->NetvisorKey);
	
					if($getLaskun->ResponseStatus->Status == 'OK')
					{
						//echo '<pre>';
						//print_r( $getLaskun );
						//echo '</pre><hr>';
	
		
				       		$criteria = new CDbCriteria();
					        $criteria->condition = " netvisorkey='".$list->NetvisorKey."' ";
						$l = Laskut::model()->find($criteria);
	
						if(isset($l->id))
						{
						//echo $l->id.'<br>';
				       		$criteria = new CDbCriteria();
					        $criteria->order = " id DESC ";
					        $criteria->condition = " lid='".$l->id."' ";
						$h = LaskuHistoria::model()->find($criteria);
						}
		
						if( isset($l->id) and isset($h->id) and $l->id == $h->lid
							and 
							(
							$h->status != $getLaskun->SalesInvoice->InvoiceStatus 
							or $h->yht_euro != str_replace(",",".",$list->OpenSum)
							)
						)
						{
		
							//echo '<pre>';
							//print_r( $list );
							//echo '</pre>';
		
				    			// Lasku historia 
							$historia = new LaskuHistoria;
							$historia->time = date("Y-m-d H:i:s", strtotime($list->Invoicedate));
							$historia->lid = $l->id;
							$historia->status = $getLaskun->SalesInvoice->InvoiceStatus;
							$historia->palvelu = "netvisor";
							$historia->yht_euro = str_replace(",",".",$list->OpenSum);
							$historia->save();

							$netvisorUpdateCheck = true;
						}
	
	
					}
	
				}
			}
	
		}
		//exit;


		return $return;

	}


	protected function lahetaNetvisoriin($id)
	{
		$return = false;
		$tapahtumapvm = date("Y-m-d H:i:s");
		Laskut::model()->updatebypk($id, array('tapahtumapvm'=>$tapahtumapvm));

	     	$l = Laskut::model()->findbypk($id);
		//$InsertedDataIdentifier = $this->netvisorLasku("edit", $model);
		$InsertedDataIdentifier = $this->netvisorLasku("add", $l);
		if(!empty($InsertedDataIdentifier)){
			Laskut::model()->updateByPk($id, array('netvisorkey'=>$InsertedDataIdentifier));
			$return = true;
		}

		return $return;
	}

	public function actionLaheta_valitsemmat($id)
	{
		$bod = '';
		$asetukset = Asetukset::model()->findByPk(1);

		// <-- Netvisor
		if($asetukset->palvelu_tyyppi == 4)
		{
			$return = $this->lahetaNetvisoriin($id);
			if($return != false)
				$bod = "OK";
			else
				$bod = "Error";
		}
		//     Netvisor -->

		return $bod;
	}

}
