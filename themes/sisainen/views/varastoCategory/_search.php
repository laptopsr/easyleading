<?php
/* @var $this VarastoCategoryController */
/* @var $model VarastoCategory */
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
		<?php echo $form->label($model,'ryhmarakenne'); ?>
		<?php echo $form->textArea($model,'ryhmarakenne',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'varaston_nimike'); ?>
		<?php echo $form->textField($model,'varaston_nimike',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->