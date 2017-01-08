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
		echo CHtml::link('<i class="fa fa-pencil-square-o" title="Muokkaa saraketta." aria-hidden="true"></i>', 
		Yii::app()->request->baseUrl.'/index.php/varastoOtsikkot/index?update='.$data->id);
	?>
	<?php
		echo CHtml::link('<i class="fa fa-times" title="Poista sarake pysyvästi KAIKISTA tuotteista." aria-hidden="true"></i>', 
		array('delete', "id"=>$data->id), 
		array('confirm'=>'Haluatko varmaasti poistaa sarakkeen? Poistamalla sarakkeen KAIKISTA tuotteista poistuu pysyvästi data, joissa on kyseiseen sarakkeeseen merkitty arvoja.'));

	?>
</th>
