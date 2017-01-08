<?php
/* @var $this AsiakkaatController */
/* @var $data Asiakkaat */

if($data->tyyppi == 0) $nimike = $data->yrityksen_nimi;
if($data->tyyppi == 1) $nimike = $data->yhteyshenkilo;
?>

<tr>
	<td>
		<?php echo CHtml::link('<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 110%"></i>', 
				array('update', 'id'=>$data->id), 
				array(
					'class'=>'btn btn-info myBgColors', 
					'style'=>'color:white', 
					'data-toggle'=>'tooltip', 
					'data-placement'=>'top', 
					'title'=>Yii::t('main', 'Muokkaa') 
				)
			); 
		?>
	</td>
	<td><?php echo $nimike; ?></td>
	<td><?php echo $data->osoite; ?></td>
	<td><?php echo $data->sahkoposti; ?></td>

</tr>
