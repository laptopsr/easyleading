<?php
/* @var $this LaskuHistoriaController */
/* @var $model LaskuHistoria */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lasku-historia-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lid'); ?>
		<?php echo $form->textField($model,'lid'); ?>
		<?php echo $form->error($model,'lid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textArea($model,'status',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yht_euro'); ?>
		<?php echo $form->textField($model,'yht_euro',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'yht_euro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'palvelu'); ?>
		<?php echo $form->textField($model,'palvelu',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'palvelu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paydate'); ?>
		<?php echo $form->textField($model,'paydate',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'paydate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->