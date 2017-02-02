<?php
/* @var $this ViestintaController */
/* @var $data Viestinta */
$style = '';
if($data->is_katsonut == 0)
$style = 'style="font-weight: bold" data-toggle="tooltip" data-placement="top" title="'.Yii::t('main', 'Lukematon viesti').'"';
?>

<tr>

	<td><?php echo date("d.m.Y", strtotime($data->time)); ?></td>
	<td><span <?php echo $style; ?>><?php echo CHtml::link(CHtml::encode($data->otsikko), array('view', 'id'=>$data->id)); ?></span></td>

	<td>
	<div class="pull-right">
	<?php if(isset($saapuneet)) : ?>
	<?php echo CHtml::link('<i class="fa fa-reply" data-toggle="tooltip" data-placement="top" title="'.Yii::t('main', 'Vastaa viestiin').'"></i>', array('create', 'vastaus_id'=>$data->id), array('class'=>'btn btn-default btn-md btn-group')); ?>
	<?php endif; ?>



	   <?php
		echo CHtml::link('<i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.Yii::t('main', 'Poista viesti').'"></i>', '#', array(
		'submit'=>array('delete', "id"=>$data->id), 
		'confirm' => 'Haluatko varmaasti poistaa?',
		'class'=>'btn btn-red btn-md pull-group'
		));

	   ?>
	</div>
	</td>


</tr>
