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

	<p class="note">Tähdellä <span class="required">*</span> merkityt kentät ovat pakollisia.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row form">
 <div class="col-sm-4">

	<legend>Netvisor asetukset</legend>


	<div class="">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'logon_polkku'); ?>
		<?php echo $form->textField($model,'logon_polkku',array('size'=>60,'maxlength'=>500, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'logon_polkku'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'johtaja'); ?>
		<?php echo $form->textField($model,'johtaja',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'johtaja'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'viivastyskorko'); ?>
		<?php echo $form->textField($model,'viivastyskorko',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'viivastyskorko'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'tilinumero'); ?>
		<?php echo $form->textField($model,'tilinumero',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tilinumero'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'iban'); ?>
		<?php echo $form->textField($model,'iban',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'iban'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'bic'); ?>
		<?php echo $form->textField($model,'bic',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'bic'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'netvisor_customer_id'); ?>
		<?php echo $form->textField($model,'netvisor_customer_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'netvisor_customer_id'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'netvisor_partner_id'); ?>
		<?php echo $form->textField($model,'netvisor_partner_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'netvisor_partner_id'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'netvisor_userkey'); ?>
		<?php echo $form->textField($model,'netvisor_userkey',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'netvisor_userkey'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'netvisor_partnerkey'); ?>
		<?php echo $form->textField($model,'netvisor_partnerkey',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'netvisor_partnerkey'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'netvisor_kaytto'); ?>
		<?php echo $form->textField($model,'netvisor_kaytto',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'netvisor_kaytto'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'netvisor_organisation_identifier'); ?>
		<?php echo $form->textField($model,'netvisor_organisation_identifier',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'netvisor_organisation_identifier'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'netvisor_host'); ?>
		<?php echo $form->textField($model,'netvisor_host',array('size'=>60,'maxlength'=>500, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'netvisor_host'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'netvisor_acceptancestatus'); ?>
		<?php echo $form->textField($model,'netvisor_acceptancestatus',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'netvisor_acceptancestatus'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'laskutus_yritys'); ?>
		<?php echo $form->textField($model,'laskutus_yritys',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'laskutus_yritys'); ?>
	</div> 

	<div class="">
		<?php echo $form->labelEx($model,'laskutus_osoite'); ?>
		<?php echo $form->textField($model,'laskutus_osoite',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'laskutus_osoite'); ?>
	</div> 

	<div class="">
		<?php echo $form->labelEx($model,'laskutus_postinumero'); ?>
		<?php echo $form->textField($model,'laskutus_postinumero',array('size'=>60,'maxlength'=>20, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'laskutus_postinumero'); ?>
	</div> 

	<div class="">
		<?php echo $form->labelEx($model,'laskutus_postitoimipaikka'); ?>
		<?php echo $form->textField($model,'laskutus_postitoimipaikka',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'laskutus_postitoimipaikka'); ?>
	</div> 

	<div class="">
		<?php echo $form->labelEx($model,'laskutus_y_tunnus'); ?>
		<?php echo $form->textField($model,'laskutus_y_tunnus',array('size'=>60,'maxlength'=>20, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'laskutus_y_tunnus'); ?>
	</div> 

	<div class="">
		<?php echo $form->labelEx($model,'laskutus_puhelin'); ?>
		<?php echo $form->textField($model,'laskutus_puhelin',array('size'=>60,'maxlength'=>20, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'laskutus_puhelin'); ?>
	</div> 

	<div class="">
		<?php echo $form->labelEx($model,'laskutus_sahkoposti'); ?>
		<?php echo $form->textField($model,'laskutus_sahkoposti',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'laskutus_sahkoposti'); ?>
	</div> 

 </div>
</div><!-- form -->

	<br>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Valmis' : 'Tallenna', array('class' => 'btn btn-default btn-md')); ?>
	</div>
<br>

<?php $this->endWidget(); ?>

</div><!-- form -->
