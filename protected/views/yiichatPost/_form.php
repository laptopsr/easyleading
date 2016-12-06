<?php
/* @var $this YiichatPostController */
/* @var $model YiichatPost */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'yiichat-post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_id'); ?>
		<?php echo $form->textField($model,'chat_id',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'chat_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_identity'); ?>
		<?php echo $form->textField($model,'post_identity',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'post_identity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->textField($model,'owner',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'owner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'data'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->