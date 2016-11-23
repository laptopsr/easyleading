<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
/*
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Hallitse käyttäjiä'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('Listaa käyttäjät'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profiili'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Vaihda salasana'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Kirjaudu ulos'), 'url'=>array('/user/logout')),
);
*/
?><h1><?php echo UserModule::t('Muokkaa profiilia'); ?></h1>


<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Tähdellä<span class="required">*</span> merkityt kentät ovat pakollisia.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {

echo '<div class="row form">';

echo '
<div class="row">
 <div class="col-sm-4">
  <div class="panel panel-info">
   <div class="panel-heading">Yhteystiedot</div>
   <div class="panel-body">';

		 foreach($profileFields as $field) 
		 {
		 if(
			$field->varname == 'lastname'
			or $field->varname == 'firstname'
			or $field->varname == 'puhelinnumero'
		 ){
		    echo '<div class="row" id="My_'.$field->varname.'">';
			lomake($profile,$field,$form);
		    echo '</div>';
		 }

		 }
echo '
   </div>
  </div>
 </div>
</div>
';



echo '
<div class="row">
 <div class="col-sm-4">
  <div class="panel panel-info">
   <div class="panel-heading">Yleiset</div>
   <div class="panel-body">';

		 foreach($profileFields as $field) 
		 {
		 if(
			$field->varname == 'ppkkvvvv'
			or $field->varname == 'sukupuoli'
			or $field->varname == 'pituus'
			or $field->varname == 'paino'
			or $field->varname == 'varoitukset'
		 ){
		    echo '<div class="row" id="My_'.$field->varname.'">';
			lomake($profile,$field,$form);
		    echo '</div>';
		 }
		 }
echo '
   </div>
  </div>
 </div>
</div>
';


echo '
<div class="row">
 <div class="col-sm-4">
  <div class="panel panel-info">
   <div class="panel-heading">Tavoite</div>
   <div class="panel-body">';

		 foreach($profileFields as $field) 
		 {
		 if(
			$field->varname == 'tavoitepaino'
			or $field->varname == 'tavoitepaino_itse'
			or $field->varname == 'ruokavalio'
			or $field->varname == 'muokkaa_ruokavalio_suositusta'
			or $field->varname == 'proteiini'
			or $field->varname == 'rasva'
			or $field->varname == 'energia'
			or $field->varname == 'muokkaa_energia_suositusta'
			or $field->varname == 'laihtumisnopeus_viikossa'
			or $field->varname == 'energiavaje_energialisa'
			or $field->varname == 'energiatavoite_kiintea'
			or $field->varname == 'liikunta'
			or $field->varname == 'liikunnan_kesto_viikossa'
			or $field->varname == 'maarita_itse'
			or $field->varname == 'liikunta_kertojen_maara_viikossa'
			or $field->varname == 'aineenvaihdunta'
			or $field->varname == 'lepoaineenvaihdunta'
			or $field->varname == 'aktiivisuuskerroin'
			or $field->varname == 'Ravitsemus_ja_liikuntasuositukset'
			or $field->varname == 'proteiinia_1'
			or $field->varname == 'hiilihydraatteja'
			or $field->varname == 'rasvaa'
		 ){
		    echo '<div class="row" id="My_'.$field->varname.'">';
			lomake($profile,$field,$form);
		    echo '</div>';
		 }

		 }
echo '
   </div>
  </div>
 </div>
</div>
';



echo '</div>'; //form
		}


function lomake($profile,$field,$form){

		/* lomake */
		echo $form->labelEx($profile,$field->varname);
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range),
				array(
					//'empty'=>'Valitse',
					'class'=>'form-control'
			 	));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'form-control input-sm'));
		} elseif ($field->field_type=="FLOAT") {
			echo $form->numberField($profile,$field->varname,array('class'=>'form-control input-sm', 'step'=>'0.01'));
		} elseif ($field->varname=="ppkkvvvv") {
			echo $form->dateField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control input-sm'));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control input-sm'));
		}
		echo $form->error($profile,$field->varname); 
		/* lomake */
}
?>

<div class="row form">
<div class="col-sm-4">
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::link('Vaihda salasana','changepassword',array('class'=>'btn btn-primary btn-block')) ?>
	<br>
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Luo') : UserModule::t('Tallenna'),array('class'=>'btn btn-primary btn-block')); ?>
	</div>

<?php $this->endWidget(); ?>
 </div>
</div><!-- form -->





<script type="text/javascript">
$(document).ready(function(){





 $('#Profile_aineenvaihdunta').change(function(){
	
	if($(this).val() == '0')
	{
	  $('#Profile_lepoaineenvaihdunta').val(0);
	}
 	TarkistaAineVaihdu();
 });

 	TarkistaAineVaihdu();

 function TarkistaAineVaihdu(){
	var thisVal = $('#Profile_aineenvaihdunta').val();

 	if(thisVal == '0')
 	{
	  $('#My_lepoaineenvaihdunta').hide('slow').css({"margin-left":"20px"});
 	} else {
	  $('#My_lepoaineenvaihdunta').show('slow').css({"margin-left":"20px"});
	}


 }

/* -- */

 $('#Profile_muokkaa_energia_suositusta').change(function(){
	  $('#My_energiavaje_energialisa input').val('');
	  $('#My_energiatavoite_kiintea input').val('');

	if($(this).val() == '0')
	{
	  $('#My_laihtumisnopeus_viikossa').hide('slow');
	  $('#Profile_laihtumisnopeus_viikossa').val(0);
	}

 	TarkistaEnergiaSuositus();
 });

 	TarkistaEnergiaSuositus();

 function TarkistaEnergiaSuositus(){
	var thisVal = $('#Profile_muokkaa_energia_suositusta').val();
	var energia = $('#Profile_energia').val();

 	if((thisVal == '1') && (energia == 1))
 	{
	  $('#My_laihtumisnopeus_viikossa').show('slow').css({"margin-left":"20px"});
	  $('#My_energiavaje_energialisa').hide('slow').css({"margin-left":"20px"});
	  $('#My_energiatavoite_kiintea').hide('slow').css({"margin-left":"20px"});
 	}

 	if((thisVal == '2') && (energia == 1))
 	{
	  $('#My_laihtumisnopeus_viikossa').hide('slow').css({"margin-left":"20px"});
	  $('#My_energiavaje_energialisa').show('slow').css({"margin-left":"20px"});
	  $('#My_energiatavoite_kiintea').hide('slow').css({"margin-left":"20px"});
 	}

 	if((thisVal == '3') && (energia == 1))
 	{
	  $('#My_laihtumisnopeus_viikossa').hide('slow').css({"margin-left":"20px"});
	  $('#My_energiavaje_energialisa').hide('slow').css({"margin-left":"20px"});

	  $('#My_energiatavoite_kiintea').show('slow').css({"margin-left":"20px"});
 	}


 }

/* -- */


 $('#Profile_energia').change(function(){
 	TarkistaEnergia();
 });

 	TarkistaEnergia();

 function TarkistaEnergia(){
	var thisVal = $('#Profile_energia').val();


 	if(thisVal == '0')
 	{
	  $('#My_muokkaa_energia_suositusta').hide('slow').css({"margin-left":"20px"});
	  $('#My_laihtumisnopeus_viikossa').hide('slow').css({"margin-left":"20px"});
	  $('#My_energiavaje_energialisa').hide('slow').css({"margin-left":"20px"});
	  $('#My_energiatavoite_kiintea').hide('slow').css({"margin-left":"20px"});
 	} else {
	  $('#My_muokkaa_energia_suositusta').show('slow').css({"margin-left":"20px"});
	  $('#My_laihtumisnopeus_viikossa').show('slow').css({"margin-left":"20px"});
	}


 }

/* -- */



 $('#Profile_liikunta').change(function(){
 	TarkistaLiikunta();
 });

 	TarkistaLiikunta();

 function TarkistaLiikunta(){
	var thisVal = $('#Profile_liikunta').val();

 	if(thisVal == '0')
 	{
	  $('#My_liikunta_kertojen_maara_viikossa').hide('slow').css({"margin-left":"20px"});
	  $('#My_liikunnan_kesto_viikossa').hide('slow').css({"margin-left":"20px"});
	  $('#My_maarita_itse').hide('slow').css({"margin-left":"20px"});
	  $('#Profile_maarita_itse').val('');
	  $('#Profile_liikunnan_kesto_viikossa').val(0);
 	} else {
	  $('#My_liikunta_kertojen_maara_viikossa').show('slow').css({"margin-left":"20px"});
	  $('#My_liikunnan_kesto_viikossa').show('slow').css({"margin-left":"20px"});
	}


 }


/* -- */



 $('#Profile_liikunnan_kesto_viikossa').change(function(){
 	TarkistaLiikuntaKestoViikossa();
 });

 	TarkistaLiikuntaKestoViikossa();

 function TarkistaLiikuntaKestoViikossa(){
	var thisVal = $('#Profile_liikunnan_kesto_viikossa').val();

 	if(thisVal == '5')
 	{
	  $('#My_maarita_itse').show('slow').css({"margin-left":"20px"});
 	} else {
	  $('#My_maarita_itse').hide('slow').css({"margin-left":"20px"});
	}


 }

/* -- */


 $('#Profile_muokkaa_ruokavalio_suositusta').change(function(){
 	TarkistaRuokavalioSuositusta();

	var thisVal = $(this).val();
 	if(thisVal == '0')
 	{
	  $('#My_proteiini').show('slow').css({"margin-left":"20px"});
	  $('#My_rasva').show('slow').css({"margin-left":"20px"});
	  $('#Profile_proteiinia_1').val('');
	  $('#Profile_hiilihydraatteja').val('');
	  $('#Profile_rasvaa').val('');
	} 

 });

 	TarkistaRuokavalioSuositusta();

 function TarkistaRuokavalioSuositusta(){
	var thisVal = $('#Profile_muokkaa_ruokavalio_suositusta').val();

 	if(thisVal == '1')
 	{
	  $('#My_proteiinia_1').show('slow').css({"margin-left":"20px"});
	  $('#My_hiilihydraatteja').show('slow').css({"margin-left":"20px"});
	  $('#My_rasvaa').show('slow').css({"margin-left":"20px"});
	  $('#My_proteiini').hide('slow').css({"margin-left":"20px"});
	  $('#My_rasva').hide('slow').css({"margin-left":"20px"});
 	} else {
	  $('#My_proteiinia_1').hide('slow').css({"margin-left":"20px"});
	  $('#My_hiilihydraatteja').hide('slow').css({"margin-left":"20px"});
	  $('#My_rasvaa').hide('slow').css({"margin-left":"20px"});
	}

 }


/* -- */


 $('#Profile_ruokavalio').change(function(){

	var thisVal = $(this).val();
 	if(thisVal == '0')

 	{

	  $('#My_proteiinia_1').hide('slow');
	  $('#My_hiilihydraatteja').hide('slow');
	  $('#My_rasvaa').hide('slow');

	  $('#Profile_muokkaa_ruokavalio_suositusta').val(0);
	  $('#Profile_proteiinia_1').val('');
	  $('#Profile_hiilihydraatteja').val('');
	  $('#Profile_rasvaa').val('');

	} 

 	TarkistaRuokavalio();
 });

 	TarkistaRuokavalio();

 function TarkistaRuokavalio(){
	var thisVal = $('#Profile_ruokavalio').val();

 	if(thisVal == '0')
 	{
	  $('#My_rasvaa').hide('slow'); 
	  $('#My_hiilihydraatteja').hide('slow'); 
	  $('#My_proteiinia_1').hide('slow'); 
	  $('#My_muokkaa_ruokavalio_suositusta').hide('slow'); 
	  $('#My_proteiini').hide('slow');
	  $('#My_rasva').hide('slow');
 	} else {
	  $('#My_muokkaa_ruokavalio_suositusta').show('slow').css({"margin-left":"20px"}); 
	  $('#My_proteiini').show('slow').css({"margin-left":"20px"});
	  $('#My_rasva').show('slow').css({"margin-left":"20px"});
	}


 }

/* -- */

	TarkistaLiikuntasuositukset();

 $('#Profile_Ravitsemus_ja_liikuntasuositukset').change(function(){
	TarkistaLiikuntasuositukset();
 });

 function TarkistaLiikuntasuositukset(){
	var thisVal = $('#Profile_Ravitsemus_ja_liikuntasuositukset').val();



 	if(thisVal == '0')
 	{
	  $('#Profile_ruokavalio').val(0);
	  $('#Profile_liikunta').val(0);
	  $('#Profile_energia').val(0);
	  $('#Profile_muokkaa_energia_suositusta').val(0);
	  $('#Profile_aineenvaihdunta').val(0);
	  $('#Profile_lepoaineenvaihdunta').val(0);
	  $('#Profile_aktiivisuuskerroin').val(0);


	  $('#My_ruokavalio').hide('slow').css({"margin-left":"20px"}); 
	  $('#My_liikunta').hide('slow').css({"margin-left":"20px"});
	  $('#My_energia').hide('slow').css({"margin-left":"20px"});
	  $('#My_aineenvaihdunta').hide('slow').css({"margin-left":"20px"});
	  $('#My_aktiivisuuskerroin').hide('slow').css({"margin-left":"20px"});
	  $('#My_laihtumisnopeus_viikossa').hide('slow').css({"margin-left":"20px"});

 	} 

 	if(thisVal == '1')
 	{

	  $('#My_ruokavalio').show('slow').css({"margin-left":"20px"}); 
	  $('#My_liikunta').show('slow').css({"margin-left":"20px"});
	  $('#My_energia').show('slow').css({"margin-left":"20px"});
	  $('#My_aineenvaihdunta').show('slow').css({"margin-left":"20px"});
	  $('#My_aktiivisuuskerroin').show('slow').css({"margin-left":"20px"});

	}

 	TarkistaRuokavalio();
 	TarkistaLiikunta();
 	TarkistaEnergia();
 	TarkistaEnergiaSuositus();
 	TarkistaAineVaihdu();
 	TarkistaRuokavalioSuositusta();
 	TarkistaLiikuntaKestoViikossa();
 }


 

 $('#Profile_proteiinia_1').keyup(function(){
	var thisVal = $(this).val();
	max100(thisVal);
 });

 $('#Profile_hiilihydraatteja').keyup(function(){
	var thisVal = $(this).val();
	max100(thisVal);
 });

 $('#Profile_rasvaa').keyup(function(){
	var thisVal = $(this).val();
	max100(thisVal);
 });

 function max100(val)
 {
	var pr = parseFloat($('#Profile_proteiinia_1').val());
	var hi = parseFloat($('#Profile_hiilihydraatteja').val());
	var rasv = parseFloat($('#Profile_rasvaa').val());
	var sum = pr+hi+rasv;

	if(sum > 100)
	{
		$('#Profile_proteiinia_1').val('');
		$('#Profile_hiilihydraatteja').val('');
		$('#Profile_rasvaa').val('');
		alert('Yhteenlaskettu arvo saa olla maksimissaan 100')
	}
 }



 $('#Profile_maarita_itse').attr('placeholder','Laita arvo minuuteissa').attr('type', 'number');
 $('#Profile_lepoaineenvaihdunta').attr('placeholder','Laita arvo minuuteissa').attr('type', 'number');




/* laskuri */
 $('#Profile_pituus').keyup(function(){
	laskuri(null);
 });
 $('#Profile_paino').keyup(function(){
	laskuri(null);
 });



 function laskuri(sel)
 {
   var pituus = $('#Profile_pituus').val();
   var paino = $('#Profile_paino').val();
   var alaraja = '';

   $.ajax({
   url: 'alaraja_ajax',
      type: "POST",
      data: { pituus : pituus },
      	success: function(data){
  	  	console.log(data);
		alaraja = data;
		replaCer(paino,pituus,alaraja,sel);
      	},
  	error:function(data){
  		console.log(data); 
  	}
   });

 }

 laskuri($('#Profile_tavoitepaino').val());

 $('#Profile_tavoitepaino_itse').attr('type', 'number');

 if($('#Profile_tavoitepaino_itse').val() !== '')
 {
   $('#My_tavoitepaino_itse').show();
 } else {
   $('#My_tavoitepaino_itse').hide();
 }


 function replaCer(paino,pituus,alaraja,sel){

   $('#My_tavoitepaino').replaceWith(
	'<div class="row" id="My_tavoitepaino">' +
	'<label for="Profile_tavoitepaino">Tavoitepaino</label>' +
	'<select class="form-control" name="Profile[tavoitepaino]" id="Profile_tavoitepaino">' +
	'<option value="nykyinen:'+(paino)+'">Nykyinen paino '+(paino)+'kg</option>' +
	'<option value="normaali:'+(pituus-100)+'">Normaalipaino '+(pituus-100)+'kg</option>' +
	'<option value="ihanne:'+(pituus-100-8)+'">Ihannepaino '+(pituus-100-8)+'kg</option>' +
	'</select>' +
	'<div class="errorMessage" id="Profile_tavoitepaino_em_" style="display:none"></div>' +
	'</div>'); 

        if(alaraja !== '')
		$('#Profile_tavoitepaino').append('<option value="alaraja:'+alaraja+'">Alin turvallinen paino '+alaraja+'kg</option>');

	$('#Profile_tavoitepaino').append('<option value=":itse">Määritä itse tavoitepaino</option>');


 $('#Profile_tavoitepaino').change(function(){
	var thisVal = $(this).val();
	if(thisVal == ':itse'){
	$('#My_tavoitepaino_itse').show('slow');
	} else {
	$('#My_tavoitepaino_itse').hide('slow');
	$('#Profile_tavoitepaino_itse').val('');
	}
 });

   $("#Profile_tavoitepaino option[value='"+sel+"']").prop('selected', true);
 }

   $("#Profile_tavoitepaino option[value='"+$("#Profile_tavoitepaino").val()+"']").prop('selected', true);



   if($('#Profile_pituus').val() == 0)
   {
   $('#Profile_pituus').val('');
   $('#Profile_pituus').attr('placeholder','cm');
   }

   if($('#Profile_paino').val() == 0)
   {
   $('#Profile_paino').val('');
   $('#Profile_paino').attr('placeholder','kg');
   }


   $('#Profile_proteiinia_1').attr('placeholder','%');
   $('#Profile_hiilihydraatteja').attr('placeholder','%');
   $('#Profile_rasvaa').attr('placeholder','%');
   $('#Profile_energiavaje_energialisa').attr('placeholder','kcal');
   $('#Profile_energiatavoite_kiintea').attr('placeholder','kcal');
   $('#Profile_lepoaineenvaihdunta').attr('placeholder','kcal');

   if($('#Profile_lepoaineenvaihdunta').val() == 0)
   {
   $('#Profile_lepoaineenvaihdunta').val('');
   $('#Profile_lepoaineenvaihdunta').attr('placeholder','kcal');
   }

});
</script>







