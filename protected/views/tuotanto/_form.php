<?php
/* @var $this TuotantoController */
/* @var $model Tuotanto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tuotanto-form',
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
		<?php echo $form->labelEx($model,'tehtavanimike'); ?>
		<?php echo $form->textField($model,'tehtavanimike',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tehtavanimike'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'osoitettu_tyontekija'); ?>
		<?php echo $form->textField($model,'osoitettu_tyontekija'); ?>
		<?php echo $form->error($model,'osoitettu_tyontekija'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tyon_tiedot'); ?>
		<?php echo $form->textArea($model,'tyon_tiedot',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'tyon_tiedot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suunniteltu_aloitus'); ?>
		<?php echo $form->textField($model,'suunniteltu_aloitus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'suunniteltu_aloitus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suuniteltu_lopetus'); ?>
		<?php echo $form->textField($model,'suuniteltu_lopetus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'suuniteltu_lopetus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'toteutunut_aloitus'); ?>
		<?php echo $form->textField($model,'toteutunut_aloitus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'toteutunut_aloitus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'toteutunut_lopetus'); ?>
		<?php echo $form->textField($model,'toteutunut_lopetus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'toteutunut_lopetus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lisatiedot'); ?>
		<?php echo $form->textArea($model,'lisatiedot',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lisatiedot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'liitteet'); ?>
		<?php echo $form->textField($model,'liitteet'); ?>
		<?php echo $form->error($model,'liitteet'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'varasto_tuote'); ?>
		<?php echo $form->textField($model,'varasto_tuote'); ?>
		<?php echo $form->error($model,'varasto_tuote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'extra_sarake1'); ?>
		<?php echo $form->textField($model,'extra_sarake1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'extra_sarake1'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->