<?php
/* @var $this VarastoRakenneController */
/* @var $model VarastoRakenne */
/* @var $form CActiveForm */
?>



<div class="form row">
  <div class="col-sm-4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'varasto-rakenne-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'yid'); ?>
	<?php echo $form->hiddenField($model,'is_otsikko', array('value'=>0)); ?>
	<?php echo $form->hiddenField($model,'varaston_nimike'); ?>
	<?php echo $form->hiddenField($model,'sarakkeen_tyyppi'); ?>



	<?php
	$criteria = new CDbCriteria;
	$criteria->order = " position ASC ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND is_otsikko=1
		AND varaston_nimike='".$model->varaston_nimike."'
	";
	$varastot = VarastoRakenne::model()->findAll($criteria);
	foreach($varastot as $data)
	{
		if($data->sarakkeen_tyyppi == 1)
			$tyyppi = 'text';
		if($data->sarakkeen_tyyppi == 2)
			$tyyppi = 'number';

		$arr = array(
				'yid'=>$data->yid,
				'varaston_nimike'=>$data->varaston_nimike,
				'sarakkeen_nimi'=>$data->sarakkeen_nimi,
				'sarakkeen_tyyppi'=>$data->sarakkeen_tyyppi,
				'position'=>$data->position,
				'sum'=>$data->sum,
				'varaston_nimike_id'=>$model->varaston_nimike_id,
		);
		echo '
		<div class="row">
		<label>'.$data->sarakkeen_nimi.'</label>
		<input type="'.$tyyppi.'" class="form-control" name="VarastoRakenne[sarakkeen_nimi][]">
		<textarea class="form-control" name="VarastoRakenne[arr][]" style="display:none">'.json_encode($arr).'</textarea>
		</div>';
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


