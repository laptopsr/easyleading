<?php
/* @var $this VarastoRakenneController */
/* @var $model VarastoRakenne */
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
		<?php echo $form->label($model,'yid'); ?>
		<?php echo $form->textField($model,'yid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'varaston_nimike'); ?>
		<?php echo $form->textField($model,'varaston_nimike',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sarakkeen_nimi'); ?>
		<?php echo $form->textField($model,'sarakkeen_nimi',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sarakkeen_tyyppi'); ?>
		<?php echo $form->textField($model,'sarakkeen_tyyppi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sum'); ?>
		<?php echo $form->textField($model,'sum'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->