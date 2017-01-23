<?php
/* @var $this AsiakkaatController */
/* @var $data Asiakkaat */
?>

<tr>
	<td>
		<?php echo CHtml::link('<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 110%"></i>', 
				array('update', 'id'=>$data->id), 
				array(
					'data-toggle'=>'tooltip', 
					'data-placement'=>'top', 
					'title'=>Yii::t('main', 'Muokkaa') 
				)
			); 
		?>
	</td>
	<td><?php echo $data->tehtavanimike; ?></td>
	<td><?php echo $data->osoitettu_tyontekija; ?></td>

</tr>
