<?php
/* @var $this VarastoCategoryController */
/* @var $data VarastoCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('yid')); ?>:</b>
	<?php echo CHtml::encode($data->yid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ryhmarakenne')); ?>:</b>
	<?php echo CHtml::encode($data->ryhmarakenne); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('varaston_nimike')); ?>:</b>
	<?php echo CHtml::encode($data->varaston_nimike); ?>
	<br />


</div>