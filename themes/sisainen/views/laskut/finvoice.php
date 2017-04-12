<?php

if(isset($_GET['id']))
  $id = $_GET['id'];



if(isset($_GET['kopio'])){

     // <-- Viimeinen laskunumero taulusta
     $criteria = new CDbCriteria();
     $criteria->order = " laskunumero!='' DESC,id DESC ";
     $ln = 0;
     $vm = Laskut::model()->find($criteria);
     if(isset($vm->id) and empty($model->laskunumero))
     $ln = $vm->laskunumero+1;
     // Viimeinen laskunumero taulusta -->

     $tapahtumapvm = date("Y-m-d H:i:s");
     $l = Laskut::model()->findbypk($id);

     $uusi = new Laskut;
     $uusi->attributes = $l->attributes;
     $uusi->paivays = date("Y-m-d");
     $uusi->erapaiva = date("Y-m-d", strtotime("+".$l->maksuehto." day"));
     $uusi->tilanne = '0';
     $uusi->laskunumero = $ln;
     $uusi->viitenumero = '';
     if($uusi->save())
     {
	$viite = $this->Viite($uusi->as_nro."00".$uusi->id);
	Laskut::model()->updatebypk($uusi->id, array('viitenumero'=>$viite));
     }

     $lr = LaskunRivit::model()->findAll(" lid='".$id."' ");
     foreach($lr as $rivi)
     {

     $uusiR = new LaskunRivit;
     $uusiR->attributes = $rivi->attributes;
     $uusiR->lid = $uusi->id;
     $uusiR->save();

     }


		    $historia = new LaskuHistoria;
		    $historia->time = $tapahtumapvm;
		    $historia->lid = $uusi->id;
		    $historia->status = 'Lasku luotu';
		    $historia->palvelu = "local";
		    $historia->yht_euro = $l->yhteensa_total;
		    $historia->save();

	$this->redirect(array('update','id'=>$uusi->id));
}


if(isset($_GET['merkitseMaksetuksi'])){

     $tapahtumapvm = date("Y-m-d H:i:s");
     Laskut::model()->updatebypk($id, array('tilanne'=>3,'tapahtumapvm'=>$tapahtumapvm));

		    // Lasku historia
		    $l = Laskut::model()->findbypk($id);
		    $yhteensa_total = 0;
		    if(isset($l->yhteensa_total))
		    $yhteensa_total = $l->yhteensa_total;

		    $historia = new LaskuHistoria;
		    $historia->time = $tapahtumapvm;
		    $historia->lid = $id;
		    $historia->status = 'MAKSETTU';
		    $historia->palvelu = "local";
		    $historia->yht_euro = $yhteensa_total;
		    $historia->save();

	$this->redirect(array('update','id'=>$id));
}

if(isset($_GET['merkitseLahetettavaksi'])){

     $tapahtumapvm = date("Y-m-d H:i:s");
     Laskut::model()->updatebypk($id, array('tilanne'=>2,'tapahtumapvm'=>$tapahtumapvm));

		    // Lasku historia
		    $l = Laskut::model()->findbypk($id);
		    $historia = new LaskuHistoria;
		    $historia->time = $tapahtumapvm;
		    $historia->lid = $id;
		    $historia->status = 'LÄHETETTY';
		    $historia->palvelu = "local";
		    $historia->yht_euro = $l->yhteensa_total;
		    $historia->save();

	$this->redirect(array('update','id'=>$id));
}

if(isset($_GET['merkitseMaksumuistutusLahetettavaksi'])){

     $tapahtumapvm = date("Y-m-d H:i:s");
     Laskut::model()->updatebypk($id, array('tapahtumapvm'=>$tapahtumapvm));

		    // Lasku historia
		    $l = Laskut::model()->findbypk($id);
		    $historia = new LaskuHistoria;
		    $historia->time = $tapahtumapvm;
		    $historia->lid = $id;
		    $historia->status = 'MAKSUMUISTUTUS';
		    $historia->palvelu = "local";
		    $historia->yht_euro = $l->yhteensa_total;
		    $historia->save();

	$this->redirect(array('update','id'=>$id));
}

if(isset($_GET['hyvaksyminen'])){

     $tapahtumapvm = date("Y-m-d H:i:s");
     Laskut::model()->updatebypk($id, array('tilanne'=>1,'tapahtumapvm'=>$tapahtumapvm));

		    // Lasku historia
		    $l = Laskut::model()->findbypk($id);
		    $historia = new LaskuHistoria;
		    $historia->time = $tapahtumapvm;
		    $historia->lid = $id;
		    $historia->status = 'HYVÄKSYTTY';
		    $historia->palvelu = "local";
		    $historia->yht_euro = $l->yhteensa_total;
		    $historia->save();

	$this->redirect(array('update','id'=>$id));
}

if(isset($_GET['mitatointi'])){


     $tapahtumapvm = date("Y-m-d H:i:s");
     Laskut::model()->updatebypk($id, array('tilanne'=>999,'tapahtumapvm'=>$tapahtumapvm));

		    // Lasku historia
		    $l = Laskut::model()->findbypk($id);
		    $historia = new LaskuHistoria;
		    $historia->time = $tapahtumapvm;
		    $historia->lid = $id;
		    $historia->status = 'Lasku mitätöity';
		    $historia->palvelu = "local";
		    $historia->yht_euro = $l->yhteensa_total;
		    $historia->save();

	$this->redirect(array('update','id'=>$id));
}




// <-- laheta Netvisor
if(isset($_GET['lahetaNetvisor']))
{
	$return = $this->lahetaNetvisoriin($id);
	if($return != false)
		$this->redirect(array('index'));
}
//  laheta Netvisor -->





?>
