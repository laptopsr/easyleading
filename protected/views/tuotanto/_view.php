<?php
/* @var $this TuotantoController */
/* @var $data Tuotanto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tehtavanimike')); ?>:</b>
	<?php echo CHtml::encode($data->tehtavanimike); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('osoitettu_tyontekija')); ?>:</b>
	<?php echo CHtml::encode($data->osoitettu_tyontekija); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tyon_tiedot')); ?>:</b>
	<?php echo CHtml::encode($data->tyon_tiedot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suunniteltu_aloitus')); ?>:</b>
	<?php echo CHtml::encode($data->suunniteltu_aloitus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suuniteltu_lopetus')); ?>:</b>
	<?php echo CHtml::encode($data->suuniteltu_lopetus); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('toteutunut_aloitus')); ?>:</b>
	<?php echo CHtml::encode($data->toteutunut_aloitus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('toteutunut_lopetus')); ?>:</b>
	<?php echo CHtml::encode($data->toteutunut_lopetus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lisatiedot')); ?>:</b>
	<?php echo CHtml::encode($data->lisatiedot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('liitteet')); ?>:</b>
	<?php echo CHtml::encode($data->liitteet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('varasto_tuote')); ?>:</b>
	<?php echo CHtml::encode($data->varasto_tuote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extra_sarake1')); ?>:</b>
	<?php echo CHtml::encode($data->extra_sarake1); ?>
	<br />

	*/ ?>

</div>