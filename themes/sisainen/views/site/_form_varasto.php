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
	<legend>Tuote</legend>

	<div class="">
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
			<div class="">
				<label>'.$checkAlasveto[0].'</label>';

				echo '<select class="form-control" name="VarastoOtsikkot[sarakkeen_nimi]['.$data->sarakkeen_nimi.']">';
				foreach($array as $val)
				echo '<option value="'.$val.'">'.$val.'</option>';
				echo '</select>';

			echo '</div>';
			}

		} else {

			if($data->sarakkeen_tyyppi == 3)
			{
			echo '
			<div class="">
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
			<div class="">
				<label>'.$data->sarakkeen_nimi.'</label>
				<input type="'.$tyyppi.'" class="form-control" name="VarastoOtsikkot[sarakkeen_nimi]['.$data->sarakkeen_nimi.']">
			</div>';
			}
		}

		echo '<textarea class="form-control" name="VarastoOtsikkot[arr][]" style="display:none">'.json_encode($arr).'</textarea>';

	}
	?>

 </div>
 <div class="col-sm-4">
  <legend>Netvisor <input type="checkbox" id="nv_kayttoon" name="nv_kayttoon"></legend>
  <div id="nv_lomake" class="collapse">
	<div class="">
		<label>Tuotenimi</label><br>
		<input type="text" name="LaskutusTuotteet[tuotenimi]" class="form-control">
	</div>

	<div class="">
		<label>Hinta ALV 0</label><br>
		<?php echo CHtml::numberField('LaskutusTuotteet[hinta_alv_0]','hinta_alv_0',array('size'=>20,'maxlength'=>20,'class'=>'form-control', 'step'=>'0.01')); ?>
	</div>

	<div class="">
		<label>Hinta sis. ALV</label><br>
		<?php echo CHtml::numberField('LaskutusTuotteet[hinta_alv_sis]','hinta_alv_0',array('size'=>20,'maxlength'=>20,'class'=>'form-control', 'step'=>'0.01')); ?>
	</div>

	<div class="">
		<label>ALV</label><br>
		<?php
        	$l = array();
		for ($i = 1; $i <= 50; $i++) {
		    $l[$i] = $i;
		}

		echo CHtml::dropDownList('LaskutusTuotteet[alv]','alv',$l, 
			array('class'=>'form-control','options' => array('24'=>array('selected'=>true)))
		);
		?>
	</div>

	<div class="">
		<label>Yksikkö</label><br>
		<?php
		$site = Yii::app()->createController('Site');
		$l = $site[0]->Yksikkot();

		echo CHtml::dropDownList('LaskutusTuotteet[yksikko]','yksikko',$l, 
			array('class'=>'form-control')
		);
		?>
	</div>

	<div class="">
		<label>Ryhmä</label><br>
		<?php
		$l = array(
			Yii::t('main', 'Ryhmä 1')=>Yii::t('main', 'Ryhmä 1'),
			Yii::t('main', 'Ryhmä 2')=>Yii::t('main', 'Ryhmä 2'),
			Yii::t('main', 'Ryhmä 3')=>Yii::t('main', 'Ryhmä 3'),
		);

		echo CHtml::dropDownList('LaskutusTuotteet[ryhma]','ryhma',$l, 
			array('class'=>'form-control')
		);
		?>
	</div>

	<div class="">
		<label>Aktiivinen</label><br>
		<?php
        	$l = array(0=>Yii::t('main', 'Ei'),1=>Yii::t('main', 'Kyllä'));

		echo CHtml::dropDownList('LaskutusTuotteet[is_active]','is_active',$l, 
			array('class'=>'form-control')
		);
		?>
	</div>
 </div>
 </div>
</div><!-- form -->

	<br>
	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Luo' : 'Tallenna', array('class'=>'submitVarasto btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>


<script type="text/javascript">
$(document).ready(function(){

 $('#LaskutusTuotteet_hinta_alv_0').keyup(function(){
	lasketa();
 });

 $('#LaskutusTuotteet_alv').change(function(){
	lasketa();
 });

 function lasketa(){
	var hinta_alv_0 = parseFloat($('#LaskutusTuotteet_hinta_alv_0').val());
	var alv = parseFloat($('#LaskutusTuotteet_alv').val());

	var result = ((hinta_alv_0*alv)/100)+hinta_alv_0;
	var result = Math.round(result * 100) / 100;
	$('#LaskutusTuotteet_hinta_alv_sis').val(result);
 }



 $('#nv_kayttoon').change(function() {
        if ($(this).is(":checked")) {
            $('#nv_lomake').addClass('in');
            $('#nv_lomake input').attr('required', 'yes');
            $('#nv_lomake label').append(' <span class="required">*</span>');
        } else {
            $('#nv_lomake').removeClass('in');
            $('#nv_lomake input').removeAttr('required');
            $('#nv_lomake label .required').remove();
	}
 });



$('#varasto-otsikkot-form').submit(function(e) {

     if ($('#nv_kayttoon').is(":checked")) {

	$('#nv_lomake input').each(function(){
		if( $(this).val() === ''){
			$(this).css({"border":"2px red solid"});
			console.log(this);
			return false;
		}
	});
     }
	$(this).submit();
	event.preventDefault(e)
});

});
</script>


