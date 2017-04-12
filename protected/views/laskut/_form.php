<?php
/* @var $this LaskutController */
/* @var $model Laskut */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'laskut-form',
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
		<?php echo $form->labelEx($model,'yid'); ?>
		<?php echo $form->textField($model,'yid'); ?>
		<?php echo $form->error($model,'yid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tyyppi'); ?>
		<?php echo $form->textField($model,'tyyppi',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tyyppi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yritys'); ?>
		<?php echo $form->textField($model,'yritys',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'yritys'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'y_tunnus'); ?>
		<?php echo $form->textField($model,'y_tunnus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'y_tunnus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nimi'); ?>
		<?php echo $form->textField($model,'nimi',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nimi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'as_nro'); ?>
		<?php echo $form->textField($model,'as_nro'); ?>
		<?php echo $form->error($model,'as_nro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'osoite'); ?>
		<?php echo $form->textField($model,'osoite',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'osoite'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postinumero'); ?>
		<?php echo $form->textField($model,'postinumero',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'postinumero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'toimipaikka'); ?>
		<?php echo $form->textField($model,'toimipaikka',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'toimipaikka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'laskutus'); ?>
		<?php echo $form->textField($model,'laskutus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'laskutus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sahkoposti'); ?>
		<?php echo $form->textField($model,'sahkoposti',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sahkoposti'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verkkolaskuosoite'); ?>
		<?php echo $form->textField($model,'verkkolaskuosoite',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'verkkolaskuosoite'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'v_tunnus'); ?>
		<?php echo $form->textField($model,'v_tunnus',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'v_tunnus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yhteyshenkilo'); ?>
		<?php echo $form->textField($model,'yhteyshenkilo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'yhteyshenkilo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nimitarkenne'); ?>
		<?php echo $form->textField($model,'nimitarkenne',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nimitarkenne'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'puhelin'); ?>
		<?php echo $form->textField($model,'puhelin',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'puhelin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_yritys'); ?>
		<?php echo $form->textField($model,'t_yritys',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'t_yritys'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_y_tunnus'); ?>
		<?php echo $form->textField($model,'t_y_tunnus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'t_y_tunnus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_nimi'); ?>
		<?php echo $form->textField($model,'t_nimi',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'t_nimi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_osoite'); ?>
		<?php echo $form->textField($model,'t_osoite',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'t_osoite'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_postinumero'); ?>
		<?php echo $form->textField($model,'t_postinumero',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'t_postinumero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_toimipaikka'); ?>
		<?php echo $form->textField($model,'t_toimipaikka',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'t_toimipaikka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_puhelin'); ?>
		<?php echo $form->textField($model,'t_puhelin',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'t_puhelin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_sahkoposti'); ?>
		<?php echo $form->textField($model,'t_sahkoposti',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'t_sahkoposti'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'toimitusosoite'); ?>
		<?php echo $form->textField($model,'toimitusosoite',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'toimitusosoite'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paivays'); ?>
		<?php echo $form->textField($model,'paivays',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'paivays'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'erapaiva'); ?>
		<?php echo $form->textField($model,'erapaiva',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'erapaiva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'toimituspaiva'); ?>
		<?php echo $form->textField($model,'toimituspaiva',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'toimituspaiva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maksuehto'); ?>
		<?php echo $form->textField($model,'maksuehto',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'maksuehto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'viitenumero'); ?>
		<?php echo $form->textField($model,'viitenumero',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'viitenumero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'viivastyskorko'); ?>
		<?php echo $form->textField($model,'viivastyskorko',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'viivastyskorko'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yhteensa_total_verot'); ?>
		<?php echo $form->textField($model,'yhteensa_total_verot',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'yhteensa_total_verot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yhteensa_total_veroton'); ?>
		<?php echo $form->textField($model,'yhteensa_total_veroton',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'yhteensa_total_veroton'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yhteensa_total'); ?>
		<?php echo $form->textField($model,'yhteensa_total',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'yhteensa_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'saaja_iban'); ?>
		<?php echo $form->textField($model,'saaja_iban',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'saaja_iban'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'saaja_virtualkoodi'); ?>
		<?php echo $form->textField($model,'saaja_virtualkoodi',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'saaja_virtualkoodi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tilanne'); ?>
		<?php echo $form->textField($model,'tilanne',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tilanne'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maksettu_euro'); ?>
		<?php echo $form->textField($model,'maksettu_euro',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'maksettu_euro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hyvityslasku'); ?>
		<?php echo $form->textField($model,'hyvityslasku',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'hyvityslasku'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'laskun_nimetys'); ?>
		<?php echo $form->textField($model,'laskun_nimetys',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'laskun_nimetys'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tapahtumapvm'); ?>
		<?php echo $form->textField($model,'tapahtumapvm',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tapahtumapvm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'laskunumero'); ?>
		<?php echo $form->textField($model,'laskunumero',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'laskunumero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'muistutuslasku_auto'); ?>
		<?php echo $form->textField($model,'muistutuslasku_auto'); ?>
		<?php echo $form->error($model,'muistutuslasku_auto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kirjeenluokka'); ?>
		<?php echo $form->textField($model,'kirjeenluokka'); ?>
		<?php echo $form->error($model,'kirjeenluokka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'viitenne'); ?>
		<?php echo $form->textField($model,'viitenne',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'viitenne'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'viitemme'); ?>
		<?php echo $form->textField($model,'viitemme',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'viitemme'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'freetext'); ?>
		<?php echo $form->textField($model,'freetext',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'freetext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deliverymethod'); ?>
		<?php echo $form->textField($model,'deliverymethod',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'deliverymethod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deliveryterm'); ?>
		<?php echo $form->textField($model,'deliveryterm',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'deliveryterm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vatperiod'); ?>
		<?php echo $form->textField($model,'vatperiod',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'vatperiod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netvisorkey'); ?>
		<?php echo $form->textField($model,'netvisorkey'); ?>
		<?php echo $form->error($model,'netvisorkey'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->