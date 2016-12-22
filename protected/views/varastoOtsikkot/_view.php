<?php
/* @var $this VarastoRakenneController */
/* @var $data VarastoRakenne */
	$checkAlasveto = explode(":", $data->sarakkeen_nimi);
	if (isset($checkAlasveto[0]))
	$data->sarakkeen_nimi = $checkAlasveto[0];
?>

<th>
	<?php echo CHtml::encode($data->sarakkeen_nimi); ?><br>
	<?php
		echo CHtml::link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', '#', array(
		'submit'=>array('index', "update"=>$data->id), 
		'class'=>'btn btn-sm btn-warning'
		));
	?>
	<?php
		echo CHtml::link('<i class="fa fa-times" aria-hidden="true"></i>', '#', array(
		'submit'=>array('delete', "id"=>$data->id), 
		'confirm' => 'Haluatko varmaasti poistaa?',
		'class'=>'btn btn-sm btn-danger'
		));
	?>
</th>
