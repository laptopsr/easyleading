<?php
/* @var $this AsiakkaatController */
/* @var $model Asiakkaat */
/* @var $form CActiveForm */

if(!isset($model->id))
{

       		$criteria = new CDbCriteria();
       		$criteria->order = " asiakasnumero DESC ";
       		$criteria->condition = " asiakasnumero!='' ";
		$asiakasnumero = 0;
		$vm = Asiakkaat::model()->find($criteria);
		if(isset($vm->id))
		$asiakasnumero = (int)$vm->asiakasnumero+1;

		$model->asiakasnumero = $asiakasnumero;
}
?>

<style>
.yritys, .yksityishenkilo{
	display:none;
}
</style>





<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asiakkaat-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Tähdellä <span class="required">*</span> merkityt kentät ovat pakollisia.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row form">
 <div class="col-sm-4">

	<legend>Asiakkaan tiedot</legend>

	<div class="">
		<?php echo $form->labelEx($model,'asiakasnumero'); ?>
		<?php echo $form->textField($model,'asiakasnumero',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'asiakasnumero'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'tyyppi'); ?>
		<?php
		$list = array(0=>Yii::t('main', 'Yritys'),1=>Yii::t('main', 'Yksityishenkilö'));
        	echo $form->dropDownList($model, 'tyyppi', $list,
		array('class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'tyyppi'); ?>
	</div>

	<div class="yritys">
		<?php echo $form->labelEx($model,'yrityksen_nimi'); ?>
		<?php echo $form->textField($model,'yrityksen_nimi',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'yrityksen_nimi'); ?>
	</div>


	<div class="yritys">
		<?php echo $form->labelEx($model,'y_tunnus'); ?>
		<?php echo $form->textField($model,'y_tunnus',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'y_tunnus'); ?>
	</div>

	<div class="yksityishenkilo">
		<?php echo $form->labelEx($model,'henkilotunnus'); ?>
		<?php echo $form->textField($model,'henkilotunnus',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'henkilotunnus'); ?>
	</div>

	<div class="yksityishenkilo">
		<?php echo $form->labelEx($model,'yhteyshenkilo'); ?>
		<?php echo $form->textField($model,'yhteyshenkilo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'yhteyshenkilo'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'sahkoposti'); ?>
		<?php echo $form->textField($model,'sahkoposti',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sahkoposti'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'osoite'); ?>
		<?php echo $form->textField($model,'osoite',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'osoite'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'postinumero'); ?>
		<?php echo $form->textField($model,'postinumero',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'postinumero'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'postitoimipaikka'); ?>
		<?php echo $form->textField($model,'postitoimipaikka',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'postitoimipaikka'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'puhelinnumero'); ?>
		<?php echo $form->textField($model,'puhelinnumero',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'puhelinnumero'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'ryhma'); ?>
		<?php
		$list = array(
			Yii::t('main', 'Ryhmä 1')=>Yii::t('main', 'Ryhmä 1'),
			Yii::t('main', 'Ryhmä 2')=>Yii::t('main', 'Ryhmä 2'),
			Yii::t('main', 'Ryhmä 3')=>Yii::t('main', 'Ryhmä 3'),
		);
        	echo $form->dropDownList($model, 'ryhma', $list,
		array('class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'ryhma'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'aktiivinen'); ?>
		<?php
		$list = array(
			1=>Yii::t('main', 'Kyllä'),
			0=>Yii::t('main', 'Ei'),
		);
        	echo $form->dropDownList($model, 'aktiivinen', $list,
		array('class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'aktiivinen'); ?>
	</div>

     <input type="hidden" id="onkoEriosoite" value="<?php echo $model->eriosoite; ?>">
     <legend><?php echo Yii::t('main', 'Käyntiosoite on eri kuin laskutusosoite'); ?> <input type="checkbox" name="Asiakkaat[eriosoite]" id="eriosoite" data-toggle="collapse" data-target="#kosoiteet"></legend>
     <div id="kosoiteet" class="collapse">

	<div class="">
		<?php echo $form->labelEx($model,'kayntiosoite'); ?>
		<?php echo $form->textField($model,'kayntiosoite',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'kayntiosoite'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'kayntipostinumero'); ?>
		<?php echo $form->textField($model,'kayntipostinumero',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'kayntipostinumero'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'kayntipostitoimipaikka'); ?>
		<?php echo $form->textField($model,'kayntipostitoimipaikka',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'kayntipostitoimipaikka'); ?>
	</div>

    </div>

 </div>
 <div class="col-sm-4">

	<legend>Laskutus</legend>

	<div class="">
		<?php echo $form->labelEx($model,'laskutuskanava'); ?>
		<?php
		$list = array(	'posti'=>Yii::t('main','Posti'),
				'verkkolasku'=>Yii::t('main','Verkkolasku'),
				'sahkoposti'=>Yii::t('main','Sähköposti')
				);
        	echo $form->dropDownList($model, 'laskutuskanava', $list,
		array('empty'=>'Valitse','class'=>'form-control'));
        	?>
		<?php echo $form->error($model,'laskutuskanava'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'kirjeluokka'); ?>
		<?php
		$list = array(	'1'=>Yii::t('main','Luokka 1'),
				'2'=>Yii::t('main','Luokka 2')
				);
        	echo $form->dropDownList($model, 'kirjeluokka', $list,
		array('empty'=>'Valitse','class'=>'form-control'));
        	?>
		<?php echo $form->error($model,'kirjeluokka'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'ovt_tunnus'); ?>
		<?php echo $form->textField($model,'ovt_tunnus',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'ovt_tunnus'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'verkkolaskuosoite'); ?>
		<?php echo $form->textField($model,'verkkolaskuosoite',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'verkkolaskuosoite'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'valittajatunnus'); ?>
		<?php echo $form->textField($model,'valittajatunnus',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'valittajatunnus'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'viivastyskorko'); ?>
		<?php echo $form->textField($model,'viivastyskorko',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'viivastyskorko'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'maksuehto'); ?>
		<?php echo $form->textField($model,'maksuehto',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'maksuehto'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'alv_prosentti'); ?>
		<?php echo $form->textField($model,'alv_prosentti',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'alv_prosentti'); ?>
	</div>


 </div>
</div><!-- form -->

	<br>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Valmis' : 'Tallenna', array('class' => 'btn btn-default btn-lg')); ?>
	</div>

<?php $this->endWidget(); ?>








<script type="text/javascript">
$(document).ready(function(){

 var onkoEriosoite = $('#onkoEriosoite').val();
 if(onkoEriosoite === 'on')
 {
	$('#eriosoite').prop('checked', true);
	$('#kosoiteet').addClass('in');
 }

 $("#Asiakkaat_tyyppi").change(function() {
    laskutusTyyppi();
 });


 laskutusTyyppi();

 function laskutusTyyppi(){

    var value = $("#Asiakkaat_tyyppi option:selected").val();

    if(value == 0){
	$(".yritys").show();
	$(".yksityishenkilo").hide();
    }
    if(value == 1){
	$(".yritys").hide();
	$(".yksityishenkilo").show();
    }

 }


});
</script>

