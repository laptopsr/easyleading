<?php
/* @var $this AsetuksetController */
/* @var $data Asetukset */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('johtaja')); ?>:</b>
	<?php echo CHtml::encode($data->johtaja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viivastyskorko')); ?>:</b>
	<?php echo CHtml::encode($data->viivastyskorko); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tilinumero')); ?>:</b>
	<?php echo CHtml::encode($data->tilinumero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iban')); ?>:</b>
	<?php echo CHtml::encode($data->iban); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bic')); ?>:</b>
	<?php echo CHtml::encode($data->bic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_customer_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_partner_id')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_partner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_userkey')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_userkey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_partnerkey')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_partnerkey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_kaytto')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_kaytto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_organisation_identifier')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_organisation_identifier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_host')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_host); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_acceptancestatus')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_acceptancestatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netvisor_mita_lahetetaan')); ?>:</b>
	<?php echo CHtml::encode($data->netvisor_mita_lahetetaan); ?>
	<br />

	*/ ?>

</div>