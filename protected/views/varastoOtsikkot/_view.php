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
		echo CHtml::link('<i class="fa fa-pencil-square-o" data-toggle="collapse" title="Muokkaa saraketta." aria-hidden="true"></i>', '#', array(
		'submit'=>array('index', "update"=>$data->id), 
		'class'=>'btn btn-sm btn-warning'
		));
	?>
	<?php
		echo CHtml::link('<i class="fa fa-times" data-toggle="collapse" title="Poista sarake pysyvästi KAIKISTA tuotteista." aria-hidden="true"></i>', '#', array(
		'submit'=>array('delete', "id"=>$data->id), 
		'confirm' => 'Haluatko varmaasti poistaa sarakkeen? Poistamalla sarakkeen KAIKISTA tuotteista poistuu pysyvästi data, joissa on kyseiseen sarakkeeseen merkitty arvoja.',
		'class'=>'btn btn-sm btn-danger'
		));
	?>
</th>
