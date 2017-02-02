<?php
/* @var $this VarastoRakenneController */
/* @var $model VarastoRakenne */
/* @var $form CActiveForm */

	if(Yii::app()->getModule('user')->user()->profile->getAttribute('yid'))
	$model->yid = Yii::app()->getModule('user')->user()->profile->getAttribute('yid');

	$criteria = new CDbCriteria;
	$criteria->order = " id DESC ";
	$criteria->group = " varaston_nimike ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND value=''
	";
	$varastot = VarastoOtsikkot::model()->findAll($criteria);

?>


<div class="row">

                            <!-- Basic Form Example -->
                            <div class="col-lg-12">

                                <div class="portlet portlet-default">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4>Varastorakenne</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#basicFormExample"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="basicFormExample" class="panel-collapse collapse in">
                                        <div class="portlet-body">



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'varasto-otsikkot-form',
	'enableAjaxValidation'=>false,
    	'htmlOptions'=>array(
        	'role'=>'form',
   	),
)); ?>


	<p class="note"><?php echo Yii::t('main', 'Tähdellä<span class="required">*</span> merkityt kentät ovat pakollisia.'); ?> 		
	 <span class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Tällä sivulla voit luoda uuden varaston tai muokata vanhaa varastoa. Jos olet luomassa uutta varastoa tee näin; 1. Kirjoita varaston nimi 'varaston nimi'-sarakkeeseen. 2. Kirjoita ensimmäisen sarakkeen nimi, joka tulee tuotelomakkeeseen. 3. Valitse sarakkeen tyyppi (jos tuotteeseen tulee tulevaisuudessa VAIN numeerisia arvoja niin valitse 'numerona'. Jos valokuvia, vaitse 'valokuvana'. Jos pelkkiä kirjaimia TAI kirjaimia JA numeroita, valitse 'tekstinä'. 4. Valitse summaus valikosta lasketaan yhteensä vaihtoehto JOS haluat arvojen laskettavan yhteen. 5. Anna sarakkeelle järjestynumero. Tämä tarkoittaa sitä monentena sarake on täytettävänä uutta tuotetta lisätessä (esimerkiski 'malli' tai 'merkki' sarakkeet ovat yleensä ennen 'korkeus' tai 'leveys' arvoja. 6. Sarake näytetään varaston etusivulla valikosta voit valita haluatko tuotteen näkymään varason etusivulla. 7. TALLENNA 8. Tämän jälkeen kun haluat lisätä uusia sarakkeita varastolle, niin valitse varasto 'Valitse muokattava varasto' valikosta ja lisää uusi sarake samoin kuin ensimmäinen sarake.">
	  <i class="fa fa-info" aria-hidden="true"></i>
	 </span> 
	</p>


<div class="row">
  <div class="col-sm-4">

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'yid'); ?>

	<?php if(count($varastot) > 0): ?>
	<div class="form-group">
		<i class="fa fa-question-circle pull-right" data-toggle="tooltip" title="Valitse muokattava varasto. Jos olet luomassa uutta varastoa, niin laita varaston nimi seuraavaan sarakkeeseen Varaston nimi'-sarake."></i>
		<label><?php echo Yii::t('main', 'Valitse muokattava varasto'); ?></label>
		<?php
        	echo CHtml::dropDownList('olemassa', 'varaston_olemassa', CHtml::listData(VarastoOtsikkot::model()->findAll($criteria), 'varaston_nimike', 'varaston_nimike'),
		array('empty'=>Yii::t('main', 'Valitse varasto'),'class'=>'form-control'));	
        	?>

	</div>
	<?php endif; ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'varaston_nimike'); ?>
		<?php echo $form->textField($model,'varaston_nimike',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'varaston_nimike'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sarakkeen_nimi'); ?>
		<?php echo $form->textField($model,'sarakkeen_nimi',array('size'=>60,'maxlength'=>255, 'class'=>'form-control', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>Yii::t('main', "Jos haluat luoda alasvetovalikon, kirjoita sarakkeeseen esim. \n Yksikkö:mm;cm;m;km"))); ?>
		<?php echo $form->error($model,'sarakkeen_nimi'); ?>
	</div>
  </div>
  <div class="col-sm-4">

	<div class="form-group">
		<?php echo $form->labelEx($model,'sarakkeen_tyyppi'); ?>
		<?php
		$list = array(
			1=>Yii::t('main', 'Tekstinä'), 
			2=>Yii::t('main', 'Numerona'), 
			3=>Yii::t('main', 'Valokuva'),
			4=>Yii::t('main', 'Alasvetovaliko')
		);
        	echo $form->dropDownList($model, 'sarakkeen_tyyppi', $list,
		array('class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'sarakkeen_tyyppi'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sum'); ?>
		<?php
		$list = array(0=>Yii::t('main', 'Ei lasketa yhteensä'), 1=>Yii::t('main', 'Lasketaan yhteensä'));
        	echo $form->dropDownList($model, 'sum', $list,
		array('class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'sum'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->numberField($model,'position',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>
 </div>

  <div class="col-sm-4">

	<div class="form-group">
		<?php echo $form->labelEx($model,'naytetaan_taulussa'); ?>
		<?php
		$list = array(1=>Yii::t('main', 'Kyllä'), 0=>Yii::t('main', 'Ei'));
        	echo $form->dropDownList($model, 'naytetaan_taulussa', $list,
		array('class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'naytetaan_taulussa'); ?>
	</div>

 </div>

</div><!-- form -->

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Luo' : 'Tallenna', array('class'=>'submit btn btn-default submitRakenne')); ?>
	</div>

<?php $this->endWidget(); ?>




                                        </div>
                                    </div>
                                </div>
                                <!-- /.portlet -->
                            </div>
                            <!-- /.col-lg-12 (nested) -->
                            <!-- End Basic Form Example -->
</div>



<script type="text/javascript">
$(document).ready(function(){

$('#olemassa').change(function(){
	var thisVal = $('#olemassa option:selected').text();
	$('#VarastoOtsikkot_varaston_nimike').attr('readonly','yes').val(thisVal);
});

$('.submitRakenne').click(function(){
	var tyyppi = $('#VarastoOtsikkot_sarakkeen_tyyppi option:selected').val();
	var sarakkeen_nimi = $('#VarastoOtsikkot_sarakkeen_nimi').val();

	if(( sarakkeen_nimi.indexOf(":") > -1 ) && (tyyppi != '4'))
	{
		alert('Kaksoispiste merkki sopisi vain Alasvetovalikkon tyyppille Sarakkeen tyyppi alla');
		return false;
	}


});

});
</script>


