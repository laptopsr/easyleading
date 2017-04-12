<?php
/* @var $this LaskutusTuotteetController */
/* @var $model LaskutusTuotteet */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'laskutus-tuotteet-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tuotenimi'); ?>
		<?php echo $form->textField($model,'tuotenimi',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tuotenimi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hinta_alv_0'); ?>
		<?php echo $form->textField($model,'hinta_alv_0',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'hinta_alv_0'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hinta_alv_sis'); ?>
		<?php echo $form->textField($model,'hinta_alv_sis',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'hinta_alv_sis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alv'); ?>
		<?php echo $form->textField($model,'alv',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'alv'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yksikko'); ?>
		<?php echo $form->textField($model,'yksikko',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'yksikko'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisorkey'); ?>
		<?php echo $form->textField($model,'netvisorkey'); ?>
		<?php echo $form->error($model,'netvisorkey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ryhma'); ?>
		<?php echo $form->textField($model,'ryhma'); ?>
		<?php echo $form->error($model,'ryhma'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->