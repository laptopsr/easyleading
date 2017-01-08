<?php
/* @var $this AsiakkaatController */
/* @var $model Asiakkaat */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'yrityksen_nimi'); ?>
		<?php echo $form->textField($model,'yrityksen_nimi',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tyyppi'); ?>
		<?php echo $form->textField($model,'tyyppi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'y_tunnus'); ?>
		<?php echo $form->textField($model,'y_tunnus',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'henkilotunnus'); ?>
		<?php echo $form->textField($model,'henkilotunnus',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'yhteyshenkilo'); ?>
		<?php echo $form->textField($model,'yhteyshenkilo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sahkoposti'); ?>
		<?php echo $form->textField($model,'sahkoposti',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'osoite'); ?>
		<?php echo $form->textField($model,'osoite',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postinumero'); ?>
		<?php echo $form->textField($model,'postinumero'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postitoimipaikka'); ?>
		<?php echo $form->textField($model,'postitoimipaikka',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kayntiosoite'); ?>
		<?php echo $form->textField($model,'kayntiosoite',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kayntipostinumero'); ?>
		<?php echo $form->textField($model,'kayntipostinumero'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kayntipostitoimipaikka'); ?>
		<?php echo $form->textField($model,'kayntipostitoimipaikka',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'puhelinnumero'); ?>
		<?php echo $form->textField($model,'puhelinnumero',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'laskutuskanava'); ?>
		<?php echo $form->textField($model,'laskutuskanava',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kirjeluokka'); ?>
		<?php echo $form->textField($model,'kirjeluokka'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ovt_tunnus'); ?>
		<?php echo $form->textField($model,'ovt_tunnus',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'verkkolaskuosoite'); ?>
		<?php echo $form->textField($model,'verkkolaskuosoite',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valittajatunnus'); ?>
		<?php echo $form->textField($model,'valittajatunnus',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'viivastyskorko'); ?>
		<?php echo $form->textField($model,'viivastyskorko'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maksuehto'); ?>
		<?php echo $form->textField($model,'maksuehto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alv_prosentti'); ?>
		<?php echo $form->textField($model,'alv_prosentti'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->