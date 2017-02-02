<?php

?>

    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Muokkaa tuotetta</h4>
        </div>
        <div class="modal-body">
          <form id="modalForm" action="saveModal" enctype="multipart/form-data" method="POST">
	
		<input type="hidden" class="form-control" name="backLinkID" value="<?php echo $_POST['backLinkID']; ?>">

		<?php 
		$path = Yii::app()->basePath."/../";
		$nextPath = "uploaded/varasto/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');

		$sarakkeen_nimi = array();
		foreach($varastoOtsikkot as $data)
		{	


			if($data->sarakkeen_tyyppi == 1)
				$tyyppi = 'text';
			if($data->sarakkeen_tyyppi == 2)
				$tyyppi = 'number';


			$value 		= '';
			$valueId	= '';
			$criteria 	= new CDbCriteria;
			$criteria->condition = " 
				varaston_nimike='".$data->varaston_nimike."'
				AND tr_rivi='".$tr_rivi."'
				AND sarakkeen_nimi='".$data->sarakkeen_nimi."'
			";
			$values = VarastoRakenne::model()->find($criteria);
			if(isset($values->id)) {
				$valueId = $values->id;
				$value = $values->value;
			}


			    $arr = array(
				'id'=>$valueId,
				'varaston_nimike'=>$data->varaston_nimike,
				'sarakkeen_nimi'=>$data->sarakkeen_nimi,
				'sarakkeen_tyyppi'=>$data->sarakkeen_tyyppi,
				'position'=>$data->position,
				'sum'=>$data->sum,
				'varaston_nimike_id'=>$data->id,
				'tr_rivi'=>$tr_rivi,
				'tuotteen_ryhman_nimike'=>$tuotteen_ryhman_nimike,
			    );



			$array = array();
			$checkAlasveto = explode(":", $data->sarakkeen_nimi);
			$yksikko = false;
			if(isset($checkAlasveto[1])) 
			{
				$array = explode(";", $checkAlasveto[1]);
				$yksikko = true;
			}

			if(is_array($array) and count($array) > 0)
			{
				echo '<div class="form-group">';
				echo '<label for="recipient-name" class="form-control-label">'.$checkAlasveto[0].'</label>';
				echo '<select class="form-control" name="VarastoRakenne[sarakkeen_nimi][]">';
				foreach($array as $val)
				echo '<option value="'.$val.'">'.$val.'</option>';
				echo '</select>';
				echo '</div>';

			} else {

			   if($data->sarakkeen_tyyppi == 3 ) {

/*
				$ekaKuva = '';
				if(is_array(json_decode($value, true)))
				{
					$kuvat = json_decode($value, true);


					echo '<div class="row">';
					foreach($kuvat as $item)
					{
					echo '
					 <div class="col-sm-4">
					  <span class="openModalImage">
						<img src="../../'.$nextPath.'/'.$item.'" class="img-thumbnail">
					  </span>
					 </div>
					';
					}
					echo '</div><br>';

					$arr = array();
					foreach($kuvat as $item)
					{
					$arr['../../'.$nextPath.'/'.$item] = $item;
					}

$this->widget('application.extensions.Slider.Slider',array(
'items'=>$arr,

'options'=>array(
'speed'=>'3000',
),
));


				}
*/


			echo '
			<div class="form-group">
				<label>'.$data->sarakkeen_nimi.'</label>
				<input type="file" class="form-control" name="fileToUpload[]" multiple id="fileToUpload" data-toggle="tooltip" data-placement="top" title="Kun haluat valita monta kuvaa käytä CTRL ja hiiri. Ensimmäinen kuva tule tauluun">
				<input type="hidden" class="form-control" name="fileLomake[varaston_nimike]" value="'.$data->varaston_nimike.'">
				<input type="hidden" class="form-control" name="fileLomake[tuotteen_ryhman_nimike]" value="'.$tuotteen_ryhman_nimike.'">
				<input type="hidden" class="form-control" name="fileLomake[sarakkeen_nimi]" value="'.$data->sarakkeen_nimi.'">
				<input type="hidden" class="form-control" name="fileLomake[sarakkeen_tyyppi]" value="'.$data->sarakkeen_tyyppi.'">
				<input type="hidden" class="form-control" name="fileLomake[position]" value="'.$data->position.'">
				<input type="hidden" class="form-control" name="fileLomake[sum]" value="'.$data->sum.'">
				<input type="hidden" class="form-control" name="fileLomake[thisId]" value="'.$valueId.'">
				<input type="hidden" class="form-control" name="fileLomake[tr_rivi]" value="'.$tr_rivi.'">
			</div>';




			  } 


				echo '<div class="form-group">';
				echo '<label for="recipient-name" class="form-control-label">'.$data->sarakkeen_nimi.':</label>';
				echo '<input type="text" class="form-control" name="VarastoRakenne[sarakkeen_nimi][]" value="'.$value.'">';
				echo '</div>';
			}



				echo '<textarea class="form-control" name="VarastoOtsikkot[arr][]" style="display:none">'.json_encode($arr).'</textarea>';
		}


		?>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulje</button>
          <button type="button" class="btn btn-primary saveModalForm" data-dismiss="modal">Tallenna</button>
        </div>
      </div>
    </div>
  </div>

