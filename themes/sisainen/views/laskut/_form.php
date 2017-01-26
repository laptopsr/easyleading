<?php
/* @var $this LaskuController */
/* @var $model Lasku */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lasku-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php if(isset($model->id) and $model->tyyppi == 'henkilo') : ?> 
<style>
.yritys,.y_tunnus, #kalut, .toimitus{
	display:none;
}
</style>
<?php elseif(isset($model->id) and $model->tyyppi == 'yritys') : ?> 
<style>
.nimi, #kalut, .toimitus{
	display:none;
}
</style>
<?php else : ?> 
<style>
.hidd,.ashidd,.ashidd_a,.tyyppi, #kalut, .toimitus{
	display:none;
}
</style>
<?php endif; ?> 

<?php
$asetukset = Asetukset::model()->findbypk(1);

$model->saaja_iban = $asetukset->iban;
if(empty($model->viivastyskorko))
$model->viivastyskorko = $asetukset->viivastyskorko;


if(isset($model->id)){
$model->paivays = date("d.m.Y", strtotime($model->paivays));
$model->erapaiva = date("d.m.Y", strtotime($model->erapaiva));

echo '<input type="hidden" id="modelID" value="1">';
echo '<input type="hidden" id="forLaskutusTyyppi" value="'.$model->laskutus.'">';
echo '<input type="hidden" id="forTilanne" value="'.$model->tilanne.'">';
} else {
$model->paivays = date("d.m.Y");
echo '<input type="hidden" id="forTilanne" value="0">';
}


?>

	<?php echo $form->errorSummary($model); ?>

<div class="row">
  <div class="col-sm-3">
  <legend><?php echo Yii::t('main', 'ASIAKAS'); ?></legend>

	<?php if(isset($model->id)) : ?> 
	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'as_nro'); ?>
		<?php echo $form->textField($model,'as_nro',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'as_nro'); ?>
	</div>
	<?php endif; ?> 


	<?php
       		$criteria = new CDbCriteria();
       		$criteria->order = " laskunumero!='' DESC,id DESC ";
		$ln = 0;
		$vm = Laskut::model()->find($criteria);
		if(isset($vm->id) and empty($model->laskunumero))
		$ln = $vm->laskunumero+1;
		elseif(isset($model->laskunumero) and !empty($model->laskunumero))
		$ln = $model->laskunumero;

	?>
	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'laskunumero'); ?>
		<?php echo $form->textField($model,'laskunumero',array('value'=>$ln,'size'=>60,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'laskunumero'); ?>
	</div>


	<?php if(!isset($model->id)) : ?> 
	<div class="section fill mb5 asiakas">
		<?php echo $form->labelEx($model,'as_nro'); ?>
    		<?php 
       		$criteria = new CDbCriteria();
		//$criteria->select = " COALESCE(NULLIF(yhteyshenkilo,yhteyshenkilo),'gg') AS yht ";
		$criteria->order = " yhteyshenkilo ";

        	$a = Asiakkaat::model()->findAll($criteria);
		echo '<select name="Lasku[as_nro]" class="form-control" id="Lasku_as_nro">';

		if(isset($model->asiakas_id) and !empty($model->asiakas_id))
		{
        	  $aon = Asiakkaat::model()->findbypk($model->asiakas_id);
		  if(!empty($aa->yrityksen_nimi))
		    echo '<option value="'.$aon->asiakasnumero.'">'.$aon->yrityksen_nimi.'</option>';
		  elseif(empty($aon->yhteyshenkilo) and empty($aon->yrityksen_nimi))
		    echo '<option value="'.$aon->asiakasnumero.'">nimet puutuu '.$aon->id.'</option>';
		  else
		    echo '<option value="'.$aon->asiakasnumero.'">'.$aon->yhteyshenkilo.'</option>';
		} else {
	        echo '<option></option>';
		}

		foreach($a as $aa)
		{
		  if(!empty($aa->yrityksen_nimi))
		    echo '<option value="'.$aa->asiakasnumero.'">'.$aa->yrityksen_nimi.'</option>';
		  elseif(empty($aa->yhteyshenkilo) and empty($aa->yrityksen_nimi))
		    echo '<option value="'.$aa->asiakasnumero.'">nimet puutuu '.$aa->id.'</option>';
		  else
		    echo '<option value="'.$aa->asiakasnumero.'">'.$aa->yhteyshenkilo.'</option>';
		}
		echo '</select>';
		?>
		<?php echo $form->error($model,'as_nro'); ?>
	</div>
	<?php endif; ?>


	<div class="section fill mb5 tyyppi">
		<?php echo $form->labelEx($model,'tyyppi'); ?>
		<?php
		$list = array('yritys'=>Yii::t('main', 'Yritys'),'henkilo'=>Yii::t('main', 'Yksityishenkilö'));
        	echo $form->dropDownList($model, 'tyyppi', $list,
		array('empty'=>'Valitse tyyppi','class'=>'form-control'));	
        	?>
		<?php echo $form->error($model,'tyyppi'); ?>
	</div>

	<div class="section fill mb5 yritys ashidd">
		<?php echo $form->labelEx($model,'yritys'); ?>
		<?php echo $form->textField($model,'yritys',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'yritys'); ?>
	</div>

	<div class="section fill mb5 y_tunnus ashidd">
		<?php echo $form->labelEx($model,'y_tunnus'); ?>
		<?php echo $form->textField($model,'y_tunnus',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'y_tunnus'); ?>
	</div>

	<div class="section fill mb5 nimi ashidd">
		<?php echo $form->labelEx($model,'nimi'); ?>
		<?php echo $form->textField($model,'nimi',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nimi'); ?>
	</div>

	<div class="section fill mb5 ashidd_a">
		<?php echo $form->labelEx($model,'osoite'); ?>
		<?php echo $form->textField($model,'osoite',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'osoite'); ?>
	</div>

	<div class="section fill mb5 ashidd_a">
		<?php echo $form->labelEx($model,'postinumero'); ?>
		<?php echo $form->textField($model,'postinumero',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'postinumero'); ?>
	</div>

	<div class="section fill mb5 ashidd_a">
		<?php echo $form->labelEx($model,'toimipaikka'); ?>
		<?php echo $form->textField($model,'toimipaikka',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'toimipaikka'); ?>
	</div>

	<div class="section fill mb5 ashidd_a">
		<?php echo $form->labelEx($model,'toimitusosoite'); ?>
		<?php
		$list = array(0=>'Ei',1=>'Kyllä');
        	echo $form->dropDownList($model, 'toimitusosoite', $list,
		array('class'=>'form-control'));
        	?>
		<?php echo $form->error($model,'toimitusosoite'); ?>
	</div>

	<div class="section fill mb5 toimitus">
		<?php echo $form->labelEx($model,'t_yritys'); ?>
		<?php echo $form->textField($model,'t_yritys',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_yritys'); ?>
	</div>

	<div class="section fill mb5 toimitus">
		<?php echo $form->labelEx($model,'t_y_tunnus'); ?>
		<?php echo $form->textField($model,'t_y_tunnus',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_y_tunnus'); ?>
	</div>

	<div class="section fill mb5 toimitus">
		<?php echo $form->labelEx($model,'t_nimi'); ?>
		<?php echo $form->textField($model,'t_nimi',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_nimi'); ?>
	</div>

	<div class="section fill mb5 toimitus">
		<?php echo $form->labelEx($model,'t_osoite'); ?>
		<?php echo $form->textField($model,'t_osoite',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_osoite'); ?>
	</div>

	<div class="section fill mb5 toimitus">
		<?php echo $form->labelEx($model,'t_postinumero'); ?>
		<?php echo $form->textField($model,'t_postinumero',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_postinumero'); ?>
	</div>

	<div class="section fill mb5 toimitus">
		<?php echo $form->labelEx($model,'t_toimipaikka'); ?>
		<?php echo $form->textField($model,'t_toimipaikka',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_toimipaikka'); ?>
	</div>

	<div class="section fill mb5 toimitus">
		<?php echo $form->labelEx($model,'t_puhelin'); ?>
		<?php echo $form->textField($model,'t_puhelin',array('size'=>60,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_puhelin'); ?>
	</div>

	<div class="section fill mb5 toimitus">
		<?php echo $form->labelEx($model,'t_sahkoposti'); ?>
		<?php echo $form->textField($model,'t_sahkoposti',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_sahkoposti'); ?>
	</div>

  </div><div class="col-sm-3">
  <legend><?php echo Yii::t('main', 'LASKUTUS'); ?></legend>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'laskutus'); ?>
		<?php
		$list = array(	'posti'=>Yii::t('main','Posti'),
				'verkkolasku'=>Yii::t('main','Verkkolasku'),
				'sahkoposti'=>Yii::t('main','Sähköposti')
				);

        	echo $form->dropDownList($model, 'laskutus', $list,
		array('empty'=>'Valitse','class'=>'form-control'));
        	?>
		<?php echo $form->error($model,'laskutus'); ?>
	</div>

	<div class="section fill mb5 sahkoposti hidd">
		<?php echo $form->labelEx($model,'sahkoposti'); ?>
		<?php echo $form->textField($model,'sahkoposti',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sahkoposti'); ?>
	</div>

	<div class="section fill mb5 verkkolaskuosoite hidd">
		<?php echo $form->labelEx($model,'verkkolaskuosoite'); ?>
		<?php echo $form->textField($model,'verkkolaskuosoite',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'verkkolaskuosoite'); ?>
	</div>

	<div class="section fill mb5 v_tunnus hidd">
		<?php echo $form->labelEx($model,'v_tunnus'); ?>
		<?php echo $form->textField($model,'v_tunnus',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'v_tunnus'); ?>
	</div>

	<div class="section fill mb5 yhteyshenkilo hidd">
		<?php echo $form->labelEx($model,'yhteyshenkilo'); ?>
		<?php echo $form->textField($model,'yhteyshenkilo',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'yhteyshenkilo'); ?>
	</div>

	<div class="section fill mb5 nimitarkenne hidd">
		<?php echo $form->labelEx($model,'nimitarkenne'); ?>
		<?php echo $form->textField($model,'nimitarkenne',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nimitarkenne'); ?>
	</div>

	<div class="section fill mb5 puhelin hidd">
		<?php echo $form->labelEx($model,'puhelin'); ?>
		<?php echo $form->textField($model,'puhelin',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'puhelin'); ?>
	</div>

	<div class="section fill mb5 deliverymethod">
		<?php echo $form->labelEx($model,'deliverymethod'); ?>
		<?php echo $form->textField($model,'deliverymethod',array('size'=>50,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'deliverymethod'); ?>
	</div>

	<div class="section fill mb5 deliveryterm">
		<?php echo $form->labelEx($model,'deliveryterm'); ?>
		<?php echo $form->textField($model,'deliveryterm',array('size'=>50,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'deliveryterm'); ?>
	</div>

  </div><div class="col-sm-3">
  <legend><?php echo Yii::t('main', 'LASKUN TIEDOT'); ?></legend>
	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'paivays'); ?>
		<?php echo $form->textField($model,'paivays',array('size'=>20,'maxlength'=>20,'class'=>'form-control  datepickerFI')); ?>
		<?php echo $form->error($model,'paivays'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'erapaiva'); ?>
		<?php echo $form->textField($model,'erapaiva',array('size'=>20,'maxlength'=>20,'class'=>'form-control datepickerFI')); ?>
		<?php echo $form->error($model,'erapaiva'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'muistutuslasku_auto'); ?>
		<?php
		$list = array(	'0'=>Yii::t('main','Kyllä'),
				'1'=>Yii::t('main','Ei')
				);
        	echo $form->dropDownList($model, 'muistutuslasku_auto', $list,
		array('class'=>'form-control'));
        	?>
		<?php echo $form->error($model,'muistutuslasku_auto'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'kirjeenluokka'); ?>
		<?php
		$list = array(	'1'=>Yii::t('main','Luokka 1'),
				'2'=>Yii::t('main','Luokka 2')
				);
        	echo $form->dropDownList($model, 'kirjeenluokka', $list,
		array('class'=>'form-control'));
        	?>
		<?php echo $form->error($model,'kirjeenluokka'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'toimituspaiva'); ?>
		<?php echo $form->textField($model,'toimituspaiva',array('size'=>20,'maxlength'=>20,'class'=>'form-control datepicker')); ?>
		<?php echo $form->error($model,'toimituspaiva'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'maksuehto'); ?>
		<?php echo $form->textField($model,'maksuehto',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'maksuehto'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'viitenumero'); ?>
		<?php echo $form->textField($model,'viitenumero',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>'se tulee luomisen jälkeen')); ?>
		<?php echo $form->error($model,'viitenumero'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'viivastyskorko'); ?>
		<?php echo $form->textField($model,'viivastyskorko',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'viivastyskorko'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'tilanne'); ?>
		<?php echo $form->textField($model,'tilanne',array('size'=>50,'maxlength'=>50,'class'=>'form-control','readonly'=>'yes')); ?>
		<?php echo $form->error($model,'tilanne'); ?>
	</div>

  </div><div class="col-sm-3">
  <legend><?php echo Yii::t('main', 'YRITYS'); ?></legend>


	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'saaja_iban'); ?>
		<?php echo $form->textField($model,'saaja_iban',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'saaja_iban'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'viitenne'); ?>
		<?php echo $form->textField($model,'viitenne',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'viitenne'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'viitemme'); ?>
		<?php echo $form->textField($model,'viitemme',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'viitemme'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'freetext'); ?>
		<?php echo $form->textarea($model,'freetext',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'freetext'); ?>
	</div>

	<div class="section fill mb5 vatperiod">
		<?php echo $form->labelEx($model,'vatperiod'); ?>
		<?php echo $form->textField($model,'vatperiod',array('size'=>50,'maxlength'=>50,'class'=>'form-control datepicker')); ?>
		<?php echo $form->error($model,'vatperiod'); ?>
	</div>

  </div>
</div>

<br>

<div class="row form tosoite" style="display:none">
  <div class="col-sm-3">
  <legend><?php echo Yii::t('main', 'TOIMITUS OSOITE'); ?></legend>


	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'t_yritys'); ?>
		<?php echo $form->textField($model,'t_yritys',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_yritys'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'t_y_tunnus'); ?>
		<?php echo $form->textField($model,'t_y_tunnus',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_y_tunnus'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'t_nimi'); ?>
		<?php echo $form->textField($model,'t_nimi',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_nimi'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'t_osoite'); ?>
		<?php echo $form->textField($model,'t_osoite',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_osoite'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'t_postinumero'); ?>
		<?php echo $form->textField($model,'t_postinumero',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_postinumero'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'t_toimipaikka'); ?>
		<?php echo $form->textField($model,'t_toimipaikka',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_toimipaikka'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'t_puhelin'); ?>
		<?php echo $form->textField($model,'t_puhelin',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_puhelin'); ?>
	</div>

	<div class="section fill mb5">
		<?php echo $form->labelEx($model,'t_sahkoposti'); ?>
		<?php echo $form->textField($model,'t_sahkoposti',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'t_sahkoposti'); ?>
	</div>
  </div>
</div>

<br>

<!--<span class="pull-right  btn btn-info" data-toggle="collapse"  data-target="#kalut"><?php echo Yii::t('main', 'Työkalut'); ?> <b class="caret"></b></span>
<br>
-->
<br>



	<input type="hidden" class="form-control" id="kohteistaRivit" readonly><br>
	<div id="tuntienTulos"></div>
	<div id="hinnoitelu"></div>

	<?php if(!isset($model->id)) : ?> 
	<div id="ilmoitusAllennusta"></div>
	<?php endif; ?> 

<br>

<div id="rivit" class="table-responsive">
<TABLE class="table well" id="TableRivit">

     <TR>
     <thead class="myBgColors">
	<TH style="width:1%"><span id="uusiRivi" class="link" style="font-size: 150%;"><i class="fa fa-plus-square"></i></span></TH>
	<TH class="col-sm-2">Tuote/Palvelu</TH>
	<TH class="col-sm-1">Kpl</TH>
	<TH class="col-sm-1">Yksikkö</TH>
	<TH class="col-sm-1">Hinta</TH>
	<TH class="col-sm-1">ALV %</TH>
	<TH class="col-sm-1">ALV</TH>
	<TH class="col-sm-1">Ale %</TH>
	<TH class="col-sm-1">Veroton</TH>
	<TH class="col-sm-1">Yhteensä</TH>
	<TH class="col-sm-1">Viesti</TH>
     </thead>
     </TR>

     <tbody>
     <?php if(!isset($model->id)) : ?> 
     <div class="tr_rivit"></div>
     <?php else : ?>

     <?php 
	if(isset($laskunRivit))
	{
		$num = 0;
		foreach($laskunRivit as $rivi){ 
		$num++;
		echo $this->renderPartial("tr_rivi_update",array('num'=>$num,'rivi'=>$rivi));
		}
	}
     ?>

     <?php endif; ?>  
     </tbody>

     <tfoot>
     <TR>
	<TD></TD>
	<TD></TD>
	<TD></TD>
	<TD></TD>
	<TD></TD>
	<TD></TD>
	<TD><input type="text" class="form-control" size="10" name="Laskut[yhteensa_total_verot]" id="yhteensa_total_verot" readonly></TD>
	<TD></TD>
	<TD><input type="text" class="form-control" size="10" name="Laskut[yhteensa_total_veroton]" id="yhteensa_total_veroton" readonly></TD>
	<TD><input type="text" class="form-control" size="10" name="Laskut[yhteensa_total]" id="yhteensa_total" readonly></TD>
	<TD></TD>
     </TR>
     </tfoot>
</TABLE>
</div>

  

<br><br><br><br><br><br>

	<div class="section fill mb5 subm">
	 <div class="form-inline">
		<?php if(!isset($model->id) or $model->tilanne == '0') : ?>
		<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Tallenna' : 'Tallenna',array('class'=>'btn  btn-primary myBgColors')); ?>
		</div>
		<?php endif; ?>

		<?php  if(
			isset($model->id) 
		) : ?>
		<div class="form-group">
		<a href="lasku_pdf?id=<?php echo $model->id; ?>" target="_blank" class="btn  btn-primary btn-group myBgColors" data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t('main', 'Tämä esikatselu on vain blaa, koska netvisorilla on oma PDF'); ?>"><?php echo Yii::t('main','Esikatselu'); ?></a>
		</div>
		<?php endif; ?>

		<?php if(isset($model->id) 
			and $model->tilanne == 1 
			and $asetukset->netvisor_kaytto == 1
			and $model->netvisorkey == 0
			and $model->tilanne != 999
		): ?>
		<div class="form-group">
		<a href="finvoice?id=<?php echo $model->id; ?>&lahetaNetvisor=true" class="btn btn-group btn-success btn-group myBgColors" data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t('main', 'Lähetä Netvisoriin'); ?>"><?php echo Yii::t('main','Lähetä'); ?></a> 
		</div>
		<?php endif; ?>


		<?php if(isset($model->id) and $model->tilanne == '0') : ?>
		<div class="form-group">
		<a href="finvoice?id=<?php echo $model->id; ?>&hyvaksyminen=true" class="btn btn-success btn-group myBgColors" data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t('main', 'Hyväksymisen jälkeen ei voi enää muokata'); ?>"><?php echo Yii::t('main','Hyväksy'); ?></a> 
		</div>
		<?php endif; ?>

		<?php if(
			isset($model->id)
			and $model->tilanne != 999
		) : ?>
		<div class="form-group">
		<a href="lasku_pdf?id=<?php echo $model->id; ?>&muistutuslasku=true" target="_blank" class="btn btn-primary btn-group myBgColors"><?php echo Yii::t('main','Maksumuistutus'); ?></a>
		</div>
		<?php endif; ?>

		<?php if(isset($model->id) 
			and $model->laskun_nimetys != "Hyvityslasku" 
			and $model->tilanne != 999
			)
		: ?>
		<div class="form-group">
		<a href="hyvityslasku?id=<?php echo $model->id; ?>" class="btn btn-success btn-group myBgColors"><?php echo Yii::t('main','Hyvityslasku'); ?></a>
		</div>
		<?php endif; ?>


		<?php if(
			isset($model->id)
			and $model->tilanne != 999
		) : ?>
		<div class="form-group">
		<a href="finvoice?id=<?php echo $model->id; ?>&mitatointi=true" class="btn btn-success btn-group myBgColors"><?php echo Yii::t('main','Mitätöi'); ?></a>
		<a href="finvoice?id=<?php echo $model->id; ?>&kopio=true" class="btn btn-success btn-group myBgColors"><?php echo Yii::t('main','Kopio'); ?></a>
		</div>
		<?php endif; ?>


		<hr>
		<p><b>Laskun tila: </b><?php echo $this->tilanneCheck($model,null); ?></p>
		<br>

		<?php if(
			isset($model->id) 
			and $model->tilanne != '0'
		) : ?>
		<a href="finvoice?id=<?php echo $model->id; ?>&merkitseMaksetuksi=true" class="btn  btn-primary btn-group myBgColors"><?php echo Yii::t('main','Maksettu'); ?></a>
		<?php endif; ?>

		<?php if(
			isset($model->id) 
			and $model->tilanne != '0'
		) : ?>
		<a href="finvoice?id=<?php echo $model->id; ?>&merkitseLahetettavaksi=true" class="btn  btn-primary btn-group myBgColors"><?php echo Yii::t('main','Lähetetty'); ?></a>
		<?php endif; ?>

		<?php if(
			isset($model->id) 
			and $model->tilanne != '0'
		) : ?>
		<a href="finvoice?id=<?php echo $model->id; ?>&merkitseMaksumuistutusLahetettavaksi=true" class="btn  btn-primary btn-group myBgColors"><?php echo Yii::t('main','Maksumuistutus lähetetty'); ?></a>
		<?php endif; ?>


	 </div>
	</div>

<?php $this->endWidget(); ?>




<script type="text/javascript">
$(document).ready(function(){


$("#lasku-form").on('submit',function(e) {

    var checkAll = true;

    $('table#TableRivit .for_tkoodi').each(function() {
	var tkoodi =  $(this).val();

	if(tkoodi == '')
	{	
	    $(this).css({"border" : "2px #f14010 solid"}).focus();
	    checkAll = false;
	}
    });

	if(checkAll == false)
	    return false;
	else
	    return true;
});

if(parseInt($("#forTilanne").val()) !== 0){
  $("input").prop("disabled", true);
  $("select").prop("disabled", true);
  $("textarea").prop("disabled", true);
  $(".poista").remove();
  $("#uusiRivi").remove();
}

if($("#modelID").val() != '1'){
    var rivi = $("#samaRivi").html();
    var rowCount = $('table#TableRivit tbody tr').length;

        $.ajax({
           url: 'tr_rivit_tyhja',
           type: "POST",
           data: {num : rowCount},
           success: function(html){
         	$("table#TableRivit tbody tr").last().after(html);
	  	Rivi();
           }
        });
}

$("#uusiRivi").click(function() {
    var rivi = $("#samaRivi").html();
    var rowCount = $('table#TableRivit tbody tr').length;

        $.ajax({
           url: 'tr_rivit_tyhja',
           type: "POST",
           data: {num : rowCount},
           success: function(html){
         	$("table#TableRivit tbody tr").last().after(html);
	  	Rivi();
           }
        });
});


function jumpToPageBottom() {
    $('html, body').animate({scrollTop:1000}, 'slow');
    return false;
}



function valitseTuote(){

$("table#TableRivit .valitseTuote").change(function() {
    var tuoteID = $(this).val();
    var num = $(this).attr("num");

        $.ajax({
           url: 'valitsetuote',
           type: "POST",
           data: { tuoteID : tuoteID },
           success: function(data){
		var sp = data.split("//");

		$("#kpl_"+num).val("1");

		if(sp[0])
		$("#tkoodi_"+num).val(sp[0]);
		if(sp[1])
		$("#hinta_"+num).val(sp[1]);
		if(sp[3])
		$("#yksikko_"+num+" option[value="+sp[3]+"]").attr('selected','selected');
		if(sp[2])
		$("#alv_"+num+" option[value="+sp[2]+"]").attr('selected','selected');

		if(sp[5])
		$("#tuoteID_"+num).val(sp[5]);

		eachLaskenta();
		$("#lt_"+num).hide();
		console.log(data)
           }
        });

});

	poista();
}


poista();
function poista(){
  $(".poista").click(function() {
	var forID = $(this).attr("for").split("_");
	$("#trRivi_"+forID[1]).remove();
	yhteensaTotal();
  });
}


Rivi();
function Rivi(){

  valitseTuote();

  $(".onlyDigits ").attr('type', 'number').attr('step', '0.01');

  $('#rivit input[type="number"]').keyup(function() {
  	eachLaskenta();
    	yhteensaTotal();

  });

  $('.for_tkoodi').keyup(function(){
	var forID = $(this).attr("id").split("_");
	$('#lt_'+forID[1]).hide();
  });

}


  eachLaskenta();

  var aleAsiakkaasta = '';
function eachLaskenta(){

  $("#rivit input").each(function() {

	var inputKenta = $(this).attr("id").split("_");
	var hinta_alv_0 = parseFloat($("#hinta_"+inputKenta[1]).val());
	var alv = parseFloat($("#alv_"+inputKenta[1]).val());
	var kpl = parseFloat($("#kpl_"+inputKenta[1]).val());
	var ale = parseFloat($("#ale_"+inputKenta[1]).val());

	inputKenta[1] = parseFloat(inputKenta[1], 10);

	var laske = parseFloat(((hinta_alv_0*kpl)/100*alv), 10);

	if(laske)
	{

		var veroton = parseFloat(hinta_alv_0, 10)*kpl;
		yhteensa = laske+veroton;
	
		$("#hinta_alv_"+inputKenta[1]).val((laske).toFixed(2));
	
		//if(veroton-laskeAleV > 0)
		  $("#veroton_"+inputKenta[1]).val(veroton.toFixed(2));
		//else
		  //$("#veroton_"+inputKenta[1]).val('0.00');
	
		//if(yhteensa-laskeAleY > 0)
		  $("#yhteensa_alv_"+inputKenta[1]).val(yhteensa.toFixed(2));
		//else
		  //$("#yhteensa_alv_"+inputKenta[1]).val('0.00');
	}

  });
    	yhteensaTotal();

}

function yhteensaTotal(){

	var sum = 0;
	$('.yhteensa_total_verot').each(function(){
	    sum += parseFloat(this.value);
	    $('#yhteensa_total_verot').val(sum.toFixed(2));
	});
	var sum1 = 0;
	$('.yhteensa_total_veroton').each(function(){
	    sum1 += parseFloat(this.value);
	    $('#yhteensa_total_veroton').val(sum1.toFixed(2));
	});
	var sum2 = 0;
	$('.yhteensa_total').each(function(){
	    sum2 += parseFloat(this.value);
	    $('#yhteensa_total').val(sum2.toFixed(2));
	});
}


$(".luoRiviTunti").click(function() {

	var from = $("#from").val();
	var to = $("#to").val();
	var kohteet = $(".selectpicker.h").val();
	var tuotePalvelu = $("#tuntipalvelu").val();

	if (from  === '') 
	{
	     $('#from').css({"border" : "2px #f14010 solid"}).focus();
	     return false;
	}
	if (to  === '') 
	{
	     $('#to').css({"border" : "2px #f14010 solid"}).focus();
	     return false;
	}
	if (!kohteet) 
	{ 
	    alert('Valitse kohde')
	    return false;

	} 

	    pyyntoRiville(kohteet,from,to,tuotePalvelu,"tunti");
});



$(".luoRiviKk").click(function() {

	var from = $("#fromkk").val();
	var to = $("#tokk").val();
	var kohteet = $(".selectpicker.kk").val();
	var tuotePalvelu = $("#kkpalvelu").val();


	if (from  === '') 
	{
	     $('#fromkk').css({"border" : "2px #f14010 solid"}).focus();
	     return false;
	}
	if (to  === '') 
	{
	     $('#tokk').css({"border" : "2px #f14010 solid"}).focus();
	     return false;
	}
	if (!kohteet) 
	{ 
	    alert('Valitse kohde')
	    return false;

	} 

	    pyyntoRiville(kohteet,from,to,tuotePalvelu,"kk");

});


function pyyntoRiville(kohteet,from,to,tuotePalvelu,tuntiVaiKk){

	    if($('#tkoodi_1').val() === '')
	    $("#trRivi_1").remove();

	    $.each(kohteet, function( index, value ) {

	    var spH = value.split("//");
	    if(spH[3] == 'onkohde')
	    var mistaLuo = 'luoKohteista';

	    if(spH[3] == 'eikohde')
	    var mistaLuo = 'luoAsiakaasta';


	        $.ajax({
	           url: mistaLuo+'?id='+spH[0],
		   type: 'POST',
		   data: { from : from, to : to },
	           success: function(data){
	               	console.log(data);
			var tunnit = data;			
			var num = 0;
			if((tunnit == 0) && (tuntiVaiKk == "tunti"))
			{
				$("#tuntienTulos").addClass("alert alert-danger").html('<b>Ei löydy tuntia</b>');
				//$("#rivit").hide('slow');
			}

			if((tunnit > 0) || (tuntiVaiKk == "kk"))
			{
			num = $("table#TableRivit tbody tr").length+index;
			
			var kpl = 0;
			var yksikko = 0;
			if(tuntiVaiKk == "kk"){
			  yksikko = 'kk';
			  kpl = '1';
			} else {
			  yksikko = spH[2];
			  kpl = tunnit;
			}

	        	$.ajax({
		           url: 'tr_rivit?id='+spH[0],
			   type: 'POST',
			   data: { num : num, from : from, to : to, kpl : kpl, hinta : spH[1], yksikko : yksikko, onkokohde : spH[3], tuotePalvelu : tuotePalvelu },
		           success: function(data){
				console.log(value);
				$("table#TableRivit tbody tr").last().after(data);
				poista();
				eachLaskenta();
				Rivi();
				$("#tuntienTulos").removeClass("alert alert-danger").html('');
				$("#rivit").show('slow');
				$(".subm").show('slow');
		           },
		           error: function(XMLHttpRequest, textStatus, errorThrown){
		               	console.log(XMLHttpRequest);
			   }
		        });

			}
	
	           },
	           error: function(XMLHttpRequest, textStatus, errorThrown){
	               	console.log(XMLHttpRequest);
		   }
	        });
	    });

	    
	    jumpToPageBottom();

}

$("#Lasku_yid").change(function() {

    var saaja = $(this).val();

        $.ajax({
           url: 'etsisaaja?id='+saaja,
           success: function(data){
               	console.log(data);

		if(data)
		$("#Lasku_saaja_iban").val(data);
		

           },
           error: function(XMLHttpRequest, textStatus, errorThrown){
               	console.log(XMLHttpRequest);
	   }
        });
});


$("#Lasku_as_nro").change(function() {

    var asiakas = $("#Lasku_as_nro option:selected").val();
    if(!asiakas)
    {
	alert("Asiakasnumero puuttuu");
	return false;
    }
	

        $.ajax({
           url: 'etsiasiakas?id='+asiakas,
           success: function(data){
		var sp = JSON.parse(data).split("//");
               	console.log(sp);

		$(".tyyppi").show('slow');


		laskutus(sp[0]);
		if(sp[0]){
		  $("#Laskut_laskutus option[value="+sp[0]+"]").attr('selected','selected');
		}
		if(sp[1]){
		  $("#Laskut_maksuehto").val(sp[1]);
		}


		if(sp[2]){
		  var spR = sp[2].split("**");
		  $("#Laskut_tyyppi option[value="+spR[0]+"]").attr('selected','selected');
		  laskutusTyyppi(spR[0]);
		
		  if(spR[0] =='yritys')
		  {
		    $("#Laskut_yritys").val(spR[1])
		    $("#Laskut_y_tunnus").val(spR[2])
		  }

		  if(spR[0] =='henkilo')
		  {
		    $("#Laskut_nimi").val(spR[1])
		  }
		}


		    $("#Laskut_osoite").val(sp[3])
		    $("#Laskut_postinumero").val(sp[4])
		    $("#Laskut_toimipaikka").val(sp[5])
		    $("#Laskut_yhteyshenkilo").val(sp[6])
		    $("#Laskut_puhelin").val(sp[7])
		    $("#Laskut_erapaiva").val(sp[9])
		    $("#Laskut_v_tunnus").val(sp[10])
		    $("#Laskut_verkkolaskuosoite").val(sp[11])
		    $("#Laskut_muistutuslasku_auto option[value="+sp[12]+"]").attr('selected','selected');
		    $("#Laskut_kirjeenluokka option[value="+sp[13]+"]").attr('selected','selected');
		    $("#Laskut_sahkoposti").val(sp[14])
		    $("#Laskut_viivastyskorko").val(sp[15])

           },
           error: function(XMLHttpRequest, textStatus, errorThrown){
               	console.log(XMLHttpRequest);
	   }
        });

});


$("#Laskut_tyyppi").change(function() {
    var value = $(this).val();
    laskutusTyyppi(value);
});

$("#Laskut_laskutus").change(function() {
    var value = $(this).val();
    laskutus(value);
});

laskutus($("#forLaskutusTyyppi").val())

function laskutusTyyppi(value){

	$(".ashidd_a").show('slow');
    if(value == 'yritys'){
	$(".ashidd").hide('slow');
	$(".yritys").show('slow');
	$(".y_tunnus").show('slow');
    }
    if(value == 'henkilo'){
	$(".ashidd").hide('slow');
	$(".nimi").show('slow');
    }

}

function laskutus(value){

    if(value == 'sahkoposti'){
	$(".hidd").hide('slow');
	$(".sahkoposti").show('slow');
	$(".yhteyshenkilo").show('slow');
	$(".puhelin").show('slow');
    }
    if(value == 'posti'){
	$(".hidd").hide('slow');
	$(".yhteyshenkilo").show('slow');
	$(".puhelin").show('slow');
    }
    if(value == 'verkkolasku'){
	$(".hidd").hide('slow');
	$(".verkkolaskuosoite").show('slow');
	$(".v_tunnus").show('slow');
	$(".yhteyshenkilo").show('slow');
	$(".puhelin").show('slow');
    }

}


$("#Laskut_toimitusosoite").change(function() {
    var toimitusosoite = $(this).val();
    if(toimitusosoite == 1){
	$(".toimitus").show('slow');
    }
    if(toimitusosoite == 0){
	$(".toimitus").hide('slow');
    }
});


// hinnoitelu
$(document).delegate(".selectpicker","change",function(){

  if($(this).val())
  {
	var thisVal = $(this).val();
        $.ajax({
           url: 'kohteen_tieto',
	   type: 'POST',
	   data: { id : thisVal },
           success: function(data){
		var sp = JSON.parse(data).split("//");
		if(sp[0])
		$('#hinnoitelu').html('<div class="alert alert-success">'+sp[0]+'</div>');

           },
           error: function(XMLHttpRequest, textStatus, errorThrown){
               	console.log(XMLHttpRequest);
	   }
        });
   } else {
		$('#hinnoitelu').html('');
   }

});



});
</script>





	<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.modal.js"></script>-->
	<div id="showres" class="modal fade" tabindex="-1" role="dialog"></div>


<script type="text/javascript">
$(document).ready(function(){

/* valikot */
$(".muokaValiko").click(function() {
    var thisFor = $(this).attr("for");

        $.ajax({
           url: location.protocol + "//" + location.host + "/index.php/site/valiko",
	   type:'POST',
	   data: { "select_type" : thisFor },
           success: function(data){
		////console.log(data);
		$('#showres').modal().html(JSON.parse(data));
           }
        });
});
/* valikot */


});
</script>

