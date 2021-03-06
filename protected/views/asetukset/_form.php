<?php
/* @var $this AsetuksetController */
/* @var $model Asetukset */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asetukset-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'johtaja'); ?>
		<?php echo $form->textField($model,'johtaja',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'johtaja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'viivastyskorko'); ?>
		<?php echo $form->textField($model,'viivastyskorko',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'viivastyskorko'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tilinumero'); ?>
		<?php echo $form->textField($model,'tilinumero',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tilinumero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iban'); ?>
		<?php echo $form->textField($model,'iban',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'iban'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bic'); ?>
		<?php echo $form->textField($model,'bic',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_customer_id'); ?>
		<?php echo $form->textField($model,'netvisor_customer_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'netvisor_customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_partner_id'); ?>
		<?php echo $form->textField($model,'netvisor_partner_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'netvisor_partner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_userkey'); ?>
		<?php echo $form->textField($model,'netvisor_userkey',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'netvisor_userkey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_partnerkey'); ?>
		<?php echo $form->textField($model,'netvisor_partnerkey',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'netvisor_partnerkey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_kaytto'); ?>
		<?php echo $form->textField($model,'netvisor_kaytto'); ?>
		<?php echo $form->error($model,'netvisor_kaytto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_organisation_identifier'); ?>
		<?php echo $form->textField($model,'netvisor_organisation_identifier',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'netvisor_organisation_identifier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_host'); ?>
		<?php echo $form->textField($model,'netvisor_host',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'netvisor_host'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_acceptancestatus'); ?>
		<?php echo $form->textField($model,'netvisor_acceptancestatus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'netvisor_acceptancestatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisor_mita_lahetetaan'); ?>
		<?php echo $form->textField($model,'netvisor_mita_lahetetaan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'netvisor_mita_lahetetaan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->