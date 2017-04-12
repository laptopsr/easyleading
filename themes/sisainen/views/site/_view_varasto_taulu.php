<?php

		echo '<tr>';

		foreach($varastoOtsikkot as $dataOtsikko)
		{	
			$value 		= '';
			$valueId	= '';
			$sarakkeen_tyyppi = '';

			$criteria 	= new CDbCriteria;
			$criteria->condition = " 
				varaston_nimike='".$varasto->varaston_nimike."'
				AND tr_rivi='".$data->tr_rivi."'
				AND sarakkeen_nimi='".$dataOtsikko->sarakkeen_nimi."'
			";
			$values = VarastoRakenne::model()->find($criteria);
			if(isset($values->id)) {
				$valueId 		= $values->id;
				$value 			= $values->value;
				$sarakkeen_tyyppi 	= $values->sarakkeen_tyyppi;
			}

			echo '<td>';

			if(!empty($sarakkeen_tyyppi) and $sarakkeen_tyyppi == 3)
			{
				$ekaKuva = '';
				if(is_array(json_decode($value, true)))
				{
					$ekaKuva = array_shift(json_decode($value, true));
				}

				echo '
				<div class="row">
				 <div class="col-sm-4">
				  <span class="openModalImage pull-left link" riviId="'.$valueId.'">
					<img src="../../'.$nextPath.'/'.$ekaKuva.'" class="img-thumbnail">
				  </span>
				 </div>
				</div>
				';


			} else {
			   	echo '<span class="values" 
				riviID="'.$valueId.'"
				varaston_nimike_id="'.$dataOtsikko->id.'"
				varaston_nimike="'.$varasto->varaston_nimike.'" 
				tr_rivi="'.$data->tr_rivi.'" 
				sarakkeen_nimi="'.$dataOtsikko->sarakkeen_nimi.'"
				sarakkeen_tyyppi="'.$dataOtsikko->sarakkeen_tyyppi.'"
				sum="'.$dataOtsikko->sum.'"
				position="'.$dataOtsikko->position.'"
				tuotteen_ryhman_nimike="'.$data->tuotteen_ryhman_nimike.'"
				>'.$value.'</span>';
			}

			echo '</td>';

		}
			echo '<td>'.$data->tuotteen_ryhman_nimike.'</td>';
		
		echo '
		<td>
		  <div class="pull-right btn-group">
			  <button class="getModal" tuotteen_ryhman_nimike="'.$data->tuotteen_ryhman_nimike.'" varaston_nimike="'.$varasto->varaston_nimike.'" tr_rivi="'.$data->tr_rivi.'"><i class="fa fa-list-alt" aria-hidden="true"></i></button>
			  <button class="poista" varaston_nimike="'.$varasto->varaston_nimike.'" tr_rivi="'.$data->tr_rivi.'"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </div>
		</td>';
echo '</tr>';
//			  <button class="Muokkaaminen"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
?>
