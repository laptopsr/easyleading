<?php
/* @var $this LaskuHistoriaController */
/* @var $data LaskuHistoria */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lid')); ?>:</b>
	<?php echo CHtml::encode($data->lid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('yht_euro')); ?>:</b>
	<?php echo CHtml::encode($data->yht_euro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('palvelu')); ?>:</b>
	<?php echo CHtml::encode($data->palvelu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paydate')); ?>:</b>
	<?php echo CHtml::encode($data->paydate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	*/ ?>

</div>