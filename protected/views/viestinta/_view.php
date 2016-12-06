<?php
/* @var $this ViestintaController */
/* @var $data Viestinta */
$style = '';
if($data->is_katsonut == 0)
$style = 'style="font-weight: bold" data-toggle="tooltip" data-placement="top" title="'.Yii::t('main', 'Lukematon viesti').'"';
?>

<div class="view">

	<?php echo date("d.m.Y", strtotime($data->time)); ?>:
	<span <?php echo $style; ?>><?php echo CHtml::link(CHtml::encode($data->otsikko), array('view', 'id'=>$data->id)); ?></span>

</div>
