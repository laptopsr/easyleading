<?php
/* @var $this AsiakkaatController */
/* @var $model Asiakkaat */


$arr = array(
		'id',
		'time',
		'yrityksen_nimi',
		'tyyppi',
		'y_tunnus',
		'henkilotunnus',
		'yhteyshenkilo',
		'sahkoposti',
		'osoite',
		'postinumero',
		'postitoimipaikka',
		'kayntiosoite',
		'kayntipostinumero',
		'kayntipostitoimipaikka',
		'puhelinnumero',
		'laskutuskanava',
		'kirjeluokka',
		'ovt_tunnus',
		'verkkolaskuosoite',
		'valittajatunnus',
		'viivastyskorko',
		'maksuehto',
		'alv_prosentti',
	);

 if($model->tyyppi == 0) // jos yritys
 {
	if(($key = array_search('henkilotunnus', $arr)) !== false) {
	    unset($arr[$key]);
	}
	if(($key = array_search('yhteyshenkilo', $arr)) !== false) {
	    unset($arr[$key]);
	}
 }

 if($model->tyyppi == 1) // jos yksityishenkilo
 {

	if(($key = array_search('yrityksen_nimi', $arr)) !== false) {
	    unset($arr[$key]);
	}
	if(($key = array_search('y_tunnus', $arr)) !== false) {
	    unset($arr[$key]);
	}
 }

 if($model->eriosoite != 'on') // jos yksityishenkilo
 {

	if(($key = array_search('kayntiosoite', $arr)) !== false) {
	    unset($arr[$key]);
	}
	if(($key = array_search('kayntipostinumero', $arr)) !== false) {
	    unset($arr[$key]);
	}
	if(($key = array_search('kayntipostitoimipaikka', $arr)) !== false) {
	    unset($arr[$key]);
	}

 }

if($model->tyyppi == 0) $model->tyyppi = 'Yritys';
if($model->tyyppi == 1) $model->tyyppi = 'Yksityishenkilö';
?>



                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Asiakkaat
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a></li>
                                <li>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/asiakkaat/index'; ?>">asiakkaat</a></li>
                                <li class="active">  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/asiakkaat/update?id='.$model->id; ?>">muoka asiakas #<?php echo $model->id; ?></a></li>
                                <li class="active">  asiakas #<?php echo $model->id; ?></li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->


<div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Katso työ</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">

<?php 
   $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=> $arr,
   ));

?>


   </div>
 </div>
</div>
<!-- /.portlet -->
