<?php
/* @var $this AsiakkaatController */
/* @var $model Asiakkaat */

$this->breadcrumbs=array(
	'Asiakkaats'=>array('index'),
	$model->id,
);


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



		<?php echo CHtml::link('<i class="fa fa-home" aria-hidden="true"></i>', 
				array('index'), 
				array(
					'class'=>'btn btn-primary myBgColors', 
					'style'=>'color:white', 
					'data-toggle'=>'tooltip', 
					'data-placement'=>'top', 
					'title'=>Yii::t('main', 'Palaa asiakkaan etusivulle') 
				)
			); 
		?>


<h1>Asiakas ID#<?php echo $model->id; ?></h1>

<?php 
   $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=> $arr,
   ));

?>
