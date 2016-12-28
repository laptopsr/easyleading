<?php
/* @var $this VarastoRakenneController */
/* @var $model VarastoRakenne */
/* @var $form CActiveForm */
?>




<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'varasto-otsikkot-form',
	'enableAjaxValidation'=>false,
    	'htmlOptions'=>array(
        	'enctype' => 'multipart/form-data',
    	),
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'varaston_nimike'); ?>
	<?php echo $form->hiddenField($model,'sarakkeen_tyyppi'); ?>

<div class="form row">
  <div class="col-sm-4">


	<div class="row">
		<?php echo $form->labelEx($model,'tuotteen_ryhman_nimike'); ?>
		<div id="alasvetoRyhmat">
		 <select id="VarastoOtsikkot_tuotteen_ryhman_nimike" name="VarastoOtsikkot[tuotteen_ryhman_nimike]" class="form-control">
		  <option>Valitse</option>
		 </select>
		</div>
		<?php echo $form->error($model,'tuotteen_ryhman_nimike'); ?>
	</div>


	<?php
	$criteria = new CDbCriteria;
	$criteria->order = " position ASC ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND varaston_nimike='".$model->varaston_nimike."'
	";
	$varastot = VarastoOtsikkot::model()->findAll($criteria);
	foreach($varastot as $data)
	{
		if($data->sarakkeen_tyyppi == 1)
			$tyyppi = 'text';
		if($data->sarakkeen_tyyppi == 2)
			$tyyppi = 'number';
		if($data->sarakkeen_tyyppi == 3)
			$tyyppi = 'file';

		$arr = array(
				'yid'=>$data->yid,
				'varaston_nimike'=>$data->varaston_nimike,
				'sarakkeen_nimi'=>$data->sarakkeen_nimi,
				'sarakkeen_tyyppi'=>$data->sarakkeen_tyyppi,
				'position'=>$data->position,
				'sum'=>$data->sum,
				'varaston_nimike_id'=>$model->varaston_nimike_id,
		);

		$checkAlasveto = explode(":", $data->sarakkeen_nimi);
		if (isset($checkAlasveto[1]))
		{
			$array = explode(";", $checkAlasveto[1]);
			if(is_array($array))
			{
			echo '
			<div class="row">
				<label>'.$checkAlasveto[0].'</label>';

				echo '<select class="form-control" name="VarastoRakenne[sarakkeen_nimi][]">';
				foreach($array as $val)
				echo '<option value="'.$val.'">'.$val.'</option>';
				echo '</select>';

			echo '</div>';
			}

		} else {

			if($data->sarakkeen_tyyppi == 3)
			{
			echo '
			<div class="row">
				<label>'.$data->sarakkeen_nimi.'</label>
				<input type="file" class="form-control" name="fileToUpload[]" multiple id="fileToUpload" data-toggle="tooltip" data-placement="top" title="Kun haluat valita monta kuvaa käytä CTRL ja hiiri. Ensimmäinen kuva tule tauluun">
				<input type="hidden" class="form-control" name="fileLomake[varaston_nimike]" value="'.$data->varaston_nimike.'">
				<input type="hidden" class="form-control" name="fileLomake[sarakkeen_nimi]" value="'.$data->sarakkeen_nimi.'">
				<input type="hidden" class="form-control" name="fileLomake[sarakkeen_tyyppi]" value="'.$data->sarakkeen_tyyppi.'">
				<input type="hidden" class="form-control" name="fileLomake[position]" value="'.$data->position.'">
				<input type="hidden" class="form-control" name="fileLomake[sum]" value="'.$data->sum.'">
			</div>';
			} else {
			echo '
			<div class="row">
				<label>'.$data->sarakkeen_nimi.'</label>
				<input type="'.$tyyppi.'" class="form-control" name="VarastoOtsikkot[sarakkeen_nimi][]">
			</div>';
			}
		}

		echo '<textarea class="form-control" name="VarastoOtsikkot[arr][]" style="display:none">'.json_encode($arr).'</textarea>';

	}
	?>

 </div>
</div><!-- form -->

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Luo' : 'Tallenna', array('class'=>'submit btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>


<script type="text/javascript">
$(document).ready(function(){

/*
$('#olemassa').change(function(){
	var thisVal = $('#olemassa option:selected').text();
	$('#VarastoRakenne_varaston_nimike').attr('readonly','yes').val(thisVal);
});
*/

});
</script>


