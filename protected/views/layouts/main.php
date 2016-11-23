<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="fi" />
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- blueprint CSS framework -->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />-->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->





  <!--<link rel="stylesheet" type="text/css" href="css/navbar.css" />-->
  <!--<link rel="stylesheet" href="css/etunti-bootstrap-theme.css">-->

  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet" type="text/css">
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/openSans.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/footer.css" />








<?php
Yii::app()->clientScript->registerPackage('jquery');
Yii::app()->clientScript->registerPackage('bootstrapJS');
Yii::app()->clientScript->registerPackage('bootstrapCSS');
?>



	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl.'/index.php'; ?>"><?php echo Yii::app()->name; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">


        <li><?php echo CHtml::link('Etusivu',Yii::app()->request->baseUrl.'/index.php/site/index'); ?></li>



      <li class="dropdown">
        <a href="#" class="dropdown-toggle " data-toggle="dropdown" title="Asetukset"><i class="fa fa-bars" style="font-size: 130%"></i></a>
          <ul class="dropdown-menu">

        <li class="menu-item dropdown dropdown-submenu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Asetukset </a>
          <ul class="dropdown-menu">
            <li><?php echo CHtml::link('Test2',Yii::app()->request->baseUrl.'/index.php/site/test2'); ?></li>
          </ul>
      </li>

      </ul>

      </ul>

      <ul class="nav navbar-nav navbar-right" title="Profiili">

	<?php if(!Yii::app()->user->isGuest) : ?>
            <li><?php echo CHtml::link('',Yii::app()->request->baseUrl.'/index.php/user/profile',array('class'=>'fa fa-user','style'=>'font-size: 130%')); ?></li>
	<?php endif; ?>


	<?php if(Yii::app()->user->isGuest) : ?>
            <li><?php echo CHtml::link('Rekisteröinti',Yii::app()->request->baseUrl.'/index.php/user/registration'); ?></li>
            <li><?php echo CHtml::link('Sisään',Yii::app()->request->baseUrl.'/index.php/user/login'); ?></li>
	<?php else : ?>
            <li><?php echo CHtml::link('',Yii::app()->request->baseUrl.'/index.php/user/logout',array('class'=>'logoutPainike fa fa-power-off','style'=>'font-size: 130%', 'id'=>'logout')); ?></li>
	<?php endif; ?>


      </ul>
     </li>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<?php
$curpage = Yii::app()->getController()->getAction()->controller->id;
$curpage .= '/'.Yii::app()->getController()->getAction()->controller->action->id;
?>


<br><br>
<p>
<div class="container container-fluid">
	<?php echo $content; ?>
</div>
</p>


</body>
</html>
