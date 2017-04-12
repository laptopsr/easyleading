<?php
/* @var $this TuotantoController */
/* @var $model Tuotanto */
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
		<?php echo $form->label($model,'tehtavanimike'); ?>
		<?php echo $form->textField($model,'tehtavanimike',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'osoitettu_tyontekija'); ?>
		<?php echo $form->textField($model,'osoitettu_tyontekija'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tyon_tiedot'); ?>
		<?php echo $form->textArea($model,'tyon_tiedot',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suunniteltu_aloitus'); ?>
		<?php echo $form->textField($model,'suunniteltu_aloitus',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suuniteltu_lopetus'); ?>
		<?php echo $form->textField($model,'suuniteltu_lopetus',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'toteutunut_aloitus'); ?>
		<?php echo $form->textField($model,'toteutunut_aloitus',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'toteutunut_lopetus'); ?>
		<?php echo $form->textField($model,'toteutunut_lopetus',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lisatiedot'); ?>
		<?php echo $form->textArea($model,'lisatiedot',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'liitteet'); ?>
		<?php echo $form->textField($model,'liitteet'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'varasto_tuote'); ?>
		<?php echo $form->textField($model,'varasto_tuote'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'extra_sarake1'); ?>
		<?php echo $form->textField($model,'extra_sarake1',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->