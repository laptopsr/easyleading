<?php

		echo '<tr>';
		echo '
		<td>
		  <div class="pull-right">
			  <button class="btn btn-warning btn-sm btn-group Muokkaaminen"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
			  <button class="btn btn-danger btn-sm btn-group poista" varaston_nimike="'.$varasto->varaston_nimike.'" tr_rivi="'.$data->tr_rivi.'"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
		</td>';
		foreach($varastoOtsikkot as $dataOtsikko)
		{	
			$value 		= '';
			$valueId	= '';
			$criteria 	= new CDbCriteria;
			$criteria->condition = " 
				varaston_nimike='".$varasto->varaston_nimike."'
				AND tr_rivi='".$data->tr_rivi."'
				AND sarakkeen_nimi='".$dataOtsikko->sarakkeen_nimi."'
			";
			$values = VarastoRakenne::model()->find($criteria);
			if(isset($values->id)) {
				$valueId = $values->id;
				$value = $values->value;
			}

			echo '<td><span class="values" 
				riviID="'.$valueId.'"
				varaston_nimike_id="'.$dataOtsikko->id.'"
				varaston_nimike="'.$varasto->varaston_nimike.'" 
				tr_rivi="'.$data->tr_rivi.'" 
				sarakkeen_nimi="'.$dataOtsikko->sarakkeen_nimi.'"
				sarakkeen_tyyppi="'.$dataOtsikko->sarakkeen_tyyppi.'"
				sum="'.$dataOtsikko->sum.'"
				position="'.$dataOtsikko->position.'"
				tuotteen_ryhman_nimike="'.$data->tuotteen_ryhman_nimike.'"
				>'.$value.'</span></td>';
		}
			echo '<td><span class="ryhmanVaihto" varaston_nimike="'.$varasto->varaston_nimike.'" tr_rivi="'.$data->tr_rivi.'">'.$data->tuotteen_ryhman_nimike.'</span></td>';
		echo '</tr>';

?>
