<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- PACE LOAD BAR PLUGIN - This creates the subtle load bar effect at the top of the page. -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/pace/pace.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/pace/pace.js"></script>

    <!-- GLOBAL STYLES - Include these on every page. -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- PAGE LEVEL PLUGIN STYLES -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/messenger/messenger.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/morris/morris.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/datatables/datatables.css" rel="stylesheet">

    <!-- THEME STYLES - Include these on every page. -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/style.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins.css" rel="stylesheet">

    <!-- THEME DEMO STYLES - Use these styles for reference if needed. Otherwise they can be deleted. -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/demo.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/html5shiv.js"></script>
      <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/respond.min.js"></script>
    <![endif]-->

<?php
  $curpage = Yii::app()->getController()->getAction()->controller->id;
  $curpage .= '/'.Yii::app()->getController()->getAction()->controller->action->id;

  //Yii::app()->clientScript->registerPackage('bootstrapJS');
  //Yii::app()->clientScript->registerPackage('bootstrapCSS');

  if(Yii::app()->user->isAdmin())
	$tila = 'Järjestelmänvalvoja';
  if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 1)
	$tila = 'Yrittäjä';
  elseif(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 2)
	$tila = 'Työntekijä';
  elseif(Yii::app()->user->isGuest)
	$tila = 'Vieras';

	// <-- onko asetuksessa rivi id 1
		$onkoid1=Asetukset::model()->findByPk(1);
		if(!isset($onkoid1->id))
		{
			$asetukset = new Asetukset;
			$asetukset->id = 1;
			$asetukset->save();
		}
	//  onko asetuksessa rivi id 1 -->
?>


</head>

<body>

<?php
$curpage = Yii::app()->getController()->getAction()->controller->id;
$curpage .= '/'.Yii::app()->getController()->getAction()->controller->action->id;

  Yii::app()->clientScript->registerPackage('jquery');
?>




    <div id="wrapper">

        <!-- begin TOP NAVIGATION -->
        <nav class="navbar-top" role="navigation">

            <!-- begin BRAND HEADING -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse">
                    <i class="fa fa-bars"></i> Menu
                </button>
                <div class="navbar-brand">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/index" style="color:#ccc">
			<?php echo Yii::app()->name; ?>
			
                        <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/img/flex-admin-logo.png" data-1x="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/img/flex-admin-logo@1x.png" data-2x="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/img/flex-admin-logo@2x.png" class="hisrc img-responsive" alt="">-->
                    </a>
                </div>
            </div>
            <!-- end BRAND HEADING -->

            <div class="nav-top">

                <!-- begin LEFT SIDE WIDGETS -->
                <ul class="nav navbar-left">
                    <li class="tooltip-sidebar-toggle">
                        <a href="#" id="sidebar-toggle" data-toggle="tooltip" data-placement="right" title="Piilota valikko">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <!-- You may add more widgets here using <li> -->
                </ul>
                <!-- end LEFT SIDE WIDGETS -->

                <!-- begin MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->
                <ul class="nav navbar-right">


		    <!-- uusi viesti -->
		    <?php
			$isMessage = '';
			$criteria = new CDbCriteria;
			$criteria->condition = " 
				saaja='".Yii::app()->user->id."' 
				AND is_katsonut!=1
			";
			$viestinta = Viestinta::model()->findAll($criteria);
			if(count($viestinta) > 0)
			$isMessage = 'alerts-link';
		    ?>


                    <!-- begin MESSAGES DROPDOWN -->
                    <li class="dropdown" data-toggle="tooltip" data-placement="bottom" title="Viestintä">
                        <a href="#" class="<?php echo $isMessage; ?> dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <span class="number"><?php echo count($viestinta); ?></span> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-scroll dropdown-messages">


                            <!-- Messages Dropdown Heading -->
                            <li class="dropdown-header">
                                <i class="fa fa-envelope"></i> Uudet viestit
                            </li>

                            <!-- Messages Dropdown Body - This is contained within a SlimScroll fixed height box. You can change the height using the SlimScroll jQuery features. -->
                            <li id="messageScroll">
                                <ul class="list-unstyled">
				    <?php foreach($viestinta as $data) : ?>
				    <?php $user = Profile::model()->findByPk($data->lahettaja); ?>
				    <?php if(isset($user->user_id)) : ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/viestinta/view?id=<?php echo $data->id; ?>">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <!--<img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/img/user-profile-1.jpg" alt="">-->
						    <i class="fa fa-user" style="font-size: 150%"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <p>
                                                        <strong><?php echo $user->firstname.' '.$user->lastname; ?></strong>: <?php echo $data->otsikko; ?>
                                                    </p>
                                                    <p class="small">
                                                        <i class="fa fa-clock-o"></i> <?php echo $data->time; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
				    <?php endif; ?>
				    <?php endforeach; ?>
                                </ul>
                            </li>

                            <!-- Messages Dropdown Footer -->
                            <li class="dropdown-footer">
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/viestinta/index">Lue kaikki viestit</a>
                            </li>

                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- /.dropdown -->
                    <!-- end MESSAGES DROPDOWN -->


                    <!-- begin MESSAGES DROPDOWN -->
                    <li data-toggle="tooltip" data-placement="bottom" title="Chatti">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/chat" id="chattiPainike">
                            <i class="fa fa-weixin"></i>
                        </a>
                    </li>
                    <!-- /.dropdown -->
                    <!-- end MESSAGES DROPDOWN -->

<?php /*
                    <!-- begin ALERTS DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="alerts-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i> 
                            <span class="number">9</span><i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-scroll dropdown-alerts">

                            <!-- Alerts Dropdown Heading -->
                            <li class="dropdown-header">
                                <i class="fa fa-bell"></i> 9 New Alerts
                            </li>

                            <!-- Alerts Dropdown Body - This is contained within a SlimScroll fixed height box. You can change the height using the SlimScroll jQuery features. -->
                            <li id="alertScroll">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon green pull-left">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            Order #2931 Received
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>3 minutes ago</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon blue pull-left">
                                                <i class="fa fa-comment"></i>
                                            </div>
                                            New Comments
                                            <span class="badge blue pull-right">15</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon orange pull-left">
                                                <i class="fa fa-wrench"></i>
                                            </div>
                                            Crawl Errors Detected
                                            <span class="badge orange pull-right">3</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon yellow pull-left">
                                                <i class="fa fa-question-circle"></i>
                                            </div>
                                            Server #2 Not Responding
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>5:25 PM</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon red pull-left">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            Server #4 Crashed
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>3:34 PM</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon green pull-left">
                                                <i class="fa fa-plus-circle"></i>
                                            </div>
                                            New Users
                                            <span class="badge green pull-right">5</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon orange pull-left">
                                                <i class="fa fa-download"></i>
                                            </div>
                                            Downloads
                                            <span class="badge orange pull-right">16</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon purple pull-left">
                                                <i class="fa fa-cloud-upload"></i>
                                            </div>
                                            Server #8 Rebooted
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>12 hours ago</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon red pull-left">

                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            Server #8 Crashed
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>12 hours ago</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Alerts Dropdown Footer -->
                            <li class="dropdown-footer">
                                <a href="#">View All Alerts</a>
                            </li>

                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- /.dropdown -->
                    <!-- end ALERTS DROPDOWN -->

                    <!-- begin TASKS DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="tasks-link dropdown-toggle" data-toggle=dropdown>
                            <i class="fa fa-tasks"></i> 
                            <span class=number>10</span><i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-scroll dropdown-tasks">

                            <!-- Tasks Dropdown Header -->
                            <li class="dropdown-header">
                                <i class="fa fa-tasks"></i> 10 Pending Tasks
                            </li>

                            <!-- Tasks Dropdown Body - This is contained within a SlimScroll fixed height box. You can change the height using the SlimScroll jQuery features. -->
                            <li id="taskScroll">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#">
                                            <p>
                                                Software Update 2.1
                                                <span class="pull-right">
                                                    <strong>60%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Server #2 Hardware Upgrade
                                                <span class="pull-right">
                                                    <strong>90%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Call Ticket #2032
                                                <span class="pull-right">
                                                    <strong>72%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Emergency Maintenance
                                                <span class="pull-right">
                                                    <strong>36%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100" style="width: 36%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Purchase Order #439
                                                <span class="pull-right">
                                                    <strong>52%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100" style="width: 52%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                March Content Update
                                                <span class="pull-right">
                                                    <strong>14%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 14%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Client #42 Data Scrubbing
                                                <span class="pull-right">
                                                    <strong>68%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                PHP Upgrade Server #6
                                                <span class="pull-right">
                                                    <strong>85%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Malware Scan
                                                <span class="pull-right">
                                                    <strong>66%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                New Employee Intake
                                                <span class="pull-right">
                                                    <strong>98%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tasks Dropdown Footer -->
                            <li class="dropdown-footer">
                                <a href="#">View All Tasks</a>
                            </li>

                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- /.dropdown -->
                    <!-- end TASKS DROPDOWN -->

*/ ?>

		    <?php
			$isMessage = false;
			$criteria = new CDbCriteria;
			$criteria->condition = " 
				saaja='".Yii::app()->user->id."' 
			";
			$viestinta = Viestinta::model()->findAll($criteria);
		    ?>


                    <!-- begin USER ACTIONS DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/profile/edit">
                                    <i class="fa fa-user"></i> Profiili
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/asetukset/update?id=1">
                                    <i class="fa fa-money"></i> Netvisor asetukset
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/viestinta/index">
                                    <i class="fa fa-envelope"></i> Viestit
                                    <span class="badge green pull-right"></span>
                                </a>
                            </li>
<!--<?php echo count($viestinta); ?>-->
                            <li>
                                <a class="logout_open" href="#logout">
                                    <i class="fa fa-sign-out"></i> Kirjaudu ulos
                                    <strong><?php echo Yii::app()->user->firstname; ?> <?php echo Yii::app()->user->lastname; ?></strong>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- /.dropdown -->
                    <!-- end USER ACTIONS DROPDOWN -->

                </ul>
                <!-- /.nav -->
                <!-- end MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->

            </div>
            <!-- /.nav-top -->
        </nav>
        <!-- /.navbar-top -->
        <!-- end TOP NAVIGATION -->

        <!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <!--<img class="img-circle" src="img/profile-pic.jpg" alt="">-->
                        <p class="welcome">
                            <i class="fa fa-key"></i> Kirjauduttu tunnuksella
                        </p>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo Yii::app()->user->firstname; ?>
                            <span class="last-name"><?php echo Yii::app()->user->lastname; ?></span> <a style="color: inherit" class="logout_open" href="logout" data-toggle="tooltip" data-placement="top" title="Kirjaudu ulos"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin SIDE NAV SEARCH -->
                    <li class="nav-search">
                        <form role="form">
                            <input type="search" class="form-control" placeholder="Search...">
                            <button class="btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </li>
                    <!-- end SIDE NAV SEARCH -->
                    <!-- begin DASHBOARD LINK -->
                    <li>
                        <a class="<?php if($curpage == 'site/index') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">
                            <i class="fa fa-dashboard"></i> Etusivu
                        </a>
                    </li>
                    <!-- end DASHBOARD LINK -->

		    <!-- Admin -->
		    <?php if(!Yii::app()->user->isGuest and Yii::app()->user->isAdmin()) : ?>
                    <li>
                        <a class="<?php if($curpage == 'default/index') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/user/admin'; ?>">
                            <i class="fa fa-dashboard"></i> Henkilöstö
                        </a>
                    </li>
		    <?php endif; ?>
		    <!-- Admin -->

		    <!-- Yrittaja -->
		    <?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 1) : ?>


                    <li class="panel">
                        <a class="<?php if($curpage == 'viestinta/index' or $curpage == 'viestinta/create' or $curpage == 'viestinta/update' or $curpage == 'site/chat') echo 'active'; ?>" href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#viestinta">
                            <i class="fa fa-envelope"></i> Viestintä <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse <?php if($curpage == 'viestinta/index' or $curpage == 'viestinta/create' or $curpage == 'viestinta/update' or $curpage == 'site/chat') echo 'in'; ?> nav" id="viestinta">
                    	 <li>
	                        <a class="<?php if($curpage == 'viestinta/create') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/viestinta/create'; ?>">
	                            <i class="fa fa-users"></i> Luo viesti
	                        </a>
	                 </li>
                    	 <li>
	                        <a class="<?php if($curpage == 'viestinta/index') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/viestinta/index'; ?>">
	                            <i class="fa fa-users"></i> Kaikki viestit
	                        </a>
	                 </li>
                    	 <li>
                        	<a class="<?php if($curpage == 'site/chat') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/chat'; ?>">
                            	    <i class="fa fa-weixin"></i> Chatti
                        	</a>
                    	 </li>
                        </ul>
                    </li>




                    <li>
                        <a class="<?php if($curpage == 'default/index') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/user'; ?>">
                            <i class="fa fa-user"></i> Henkilöstö  
                        </a>
                    </li>

                    <li class="panel">
                        <a class="<?php if($curpage == 'asiakkaat/index' or $curpage == 'asiakkaat/create' or $curpage == 'asiakkaat/update') echo 'active'; ?>" href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#asiakkaat">
                            <i class="fa fa-users"></i> Asiakkaat <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse <?php if($curpage == 'asiakkaat/index' or $curpage == 'asiakkaat/create' or $curpage == 'asiakkaat/update') echo 'in'; ?> nav" id="asiakkaat">
                    	 <li>
	                        <a class="<?php if($curpage == 'asiakkaat/create') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/asiakkaat/create'; ?>">
	                            <i class="fa fa-users"></i> Luo asiakas
	                        </a>
	                 </li>
                    	 <li>
	                        <a class="<?php if($curpage == 'asiakkaat/index') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/asiakkaat'; ?>">
	                            <i class="fa fa-users"></i> Hallinta
	                        </a>
	                 </li>
                        </ul>
                    </li>
<!--
                    <li>
                        <a class="<?php if($curpage == 'varastoOtsikkot/index') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/varastoOtsikkot/index'; ?>">
                            <i class="fa fa-newspaper-o"></i> Varaston rakenne
                        </a>
                    </li>
-->
		    <?php
			$criteria = new CDbCriteria;
			$criteria->order = " id DESC ";
			$criteria->group = " varaston_nimike ";
			$criteria->condition = " 
				yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
			";
			$varastot = VarastoOtsikkot::model()->findAll($criteria);
		    ?>



                    <!-- begin CHARTS DROPDOWN -->
                    <li class="panel">
                        <a class="<?php if($curpage == 'site/varasto') echo 'active'; ?>" href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#varastot">
                            <i class="fa fa-newspaper-o"></i> <?php echo Yii::t('main', 'Varasto'); ?> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse <?php if($curpage == 'site/varasto') echo 'in'; ?> nav" id="varastot">

	                    <li>
	                        <a class="<?php if($curpage == 'varastoOtsikkot/index') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/varastoOtsikkot/index'; ?>">
	                            <i class="fa fa-newspaper-o"></i>
					<?php if (count($varastot) > 0): ?> 
						Luo/muokkaa varastorakennetta
					<?php else: ?> 
						Luo ensin varastorakenne tästä
					<?php endif; ?> 
	                        </a>
	                    </li>

		    	   <?php if (count($varastot) > 0): ?>
	   		   <?php
				foreach($varastot as $data){
			  		echo '
					<li>
	                                  <a href="'.Yii::app()->request->baseUrl.'/index.php/site/varasto?id='.$data->id.'">
	                                    <i class="fa fa-angle-double-right"></i> '.$data->varaston_nimike.'
	                                  </a>
					</li>';
				}
			   ?>
			   <?php endif; ?>
                        </ul>
                    </li>
                    <!-- end CHARTS DROPDOWN -->

                    <li>
                        <a class="<?php if($curpage == 'site/oma_kansio') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/oma_kansio'; ?>">
                            <i class="fa fa-files-o"></i> Liikekirjeet
                        </a>
                    </li>

                    <li>
                        <a class="<?php if($curpage == 'tuotanto/index') echo 'active'; ?>" href="<?php echo Yii::app()->request->baseUrl.'/index.php/tuotanto/index'; ?>">
                            <i class="fa fa-truck"></i> Tuotanto
                        </a>
                    </li>


                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#laskutus">
                            <i class="fa fa-money"></i> Myyntilaskut <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="laskutus">
                    	 <li>
	                        <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/laskut/create'; ?>">
	                            <i class="fa fa-file"></i> Luo uusi lasku
	                        </a>
	                 </li>
                    	 <li>
	                        <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/laskut/index'; ?>">
	                            <i class="fa fa-money"></i> Kaikki laskut
	                        </a>
	                 </li>
                    	 <li>
	                        <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/laskutusTuotteet/index'; ?>">
	                            <i class="fa fa-plus-circle"></i> Tuotteet ja palvelut
	                        </a>
	                 </li>

                        </ul>
                    </li>


                    <li>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/raportit'; ?>">
                            <i class="fa fa-line-chart"></i> Raportit
                        </a>
                    </li>

		    <?php endif; ?>
		    <!-- Yrittaja -->



		    <!-- Tyontekija -->
		    <?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 2) : ?>
                    <li>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">
                            <i class="fa fa-user"></i> Joko, työntekijän varten
                        </a>
                    </li>
		    <?php endif; ?>
		    <!-- Tyontekija -->






<?php /*

                    <!-- begin CHARTS DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#charts">
                            <i class="fa fa-bar-chart-o"></i> Charts <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="charts">
                            <li>
                                <a href="flot.html">
                                    <i class="fa fa-angle-double-right"></i> Flot Charts
                                </a>
                            </li>
                            <li>
                                <a href="morris.html">
                                    <i class="fa fa-angle-double-right"></i> Morris.js
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end CHARTS DROPDOWN -->
                    <!-- begin FORMS DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#forms">
                            <i class="fa fa-edit"></i> Forms <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="forms">
                            <li>
                                <a href="basic-form-elements.html">
                                    <i class="fa fa-angle-double-right"></i> Basic Elements
                                </a>
                            </li>
                            <li>
                                <a href="advanced-form-elements.html">
                                    <i class="fa fa-angle-double-right"></i> Advanced Elements
                                </a>
                            </li>
                            <li>
                                <a href="validation.html">
                                    <i class="fa fa-angle-double-right"></i> Validation
                                </a>
                            </li>
                            <li>
                                <a href="wysiwyg-editor.html">
                                    <i class="fa fa-angle-double-right"></i> WYSIWYG Editor
                                </a>
                            </li>
                            <li>
                                <a href="dropzone-uploader.html">
                                    <i class="fa fa-angle-double-right"></i> Dropzone Uploader
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end FORMS DROPDOWN -->
                    <!-- begin CALENDAR LINK -->
                    <li>
                        <a href="calendar.html">
                            <i class="fa fa-calendar"></i> Calendar
                        </a>
                    </li>
                    <!-- end CALENDAR LINK -->
                    <!-- begin TABLES DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#tables">
                            <i class="fa fa-table"></i> Tables <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="tables">
                            <li>
                                <a href="basic-tables.html">
                                    <i class="fa fa-angle-double-right"></i> Basic Tables
                                </a>
                            </li>
                            <li>
                                <a href="advanced-tables.html">
                                    <i class="fa fa-angle-double-right"></i> Advanced Tables
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end TABLES DROPDOWN -->
                    <!-- begin UI ELEMENTS DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#ui-elements">
                            <i class="fa fa-wrench"></i> UI Elements <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="ui-elements">
                            <li>
                                <a href="portlets.html">
                                    <i class="fa fa-angle-double-right"></i> Portlets &amp; Widgets
                                </a>
                            </li>
                            <li>
                                <a href="buttons.html">
                                    <i class="fa fa-angle-double-right"></i> Buttons
                                </a>
                            </li>
                            <li>
                                <a href="tabs-accordions.html">
                                    <i class="fa fa-angle-double-right"></i> Tabs &amp; Accordions
                                </a>
                            </li>
                            <li>
                                <a href="notifications.html">
                                    <i class="fa fa-angle-double-right"></i> Popups &amp; Notifications
                                </a>
                            </li>
                            <li>
                                <a href="sliders.html">
                                    <i class="fa fa-angle-double-right"></i> Sliders
                                </a>
                            </li>
                            <li>
                                <a href="typography.html">
                                    <i class="fa fa-angle-double-right"></i> Typography
                                </a>
                            </li>
                            <li>
                                <a href="icons.html">
                                    <i class="fa fa-angle-double-right"></i> Icons
                                </a>
                            </li>
                            <li>
                                <a href="grid.html">
                                    <i class="fa fa-angle-double-right"></i> Grid
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end UI ELEMENTS DROPDOWN -->
                    <!-- begin MESSAGE CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#message-center">
                            <i class="fa fa-inbox"></i> Message Center <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="message-center">
                            <li>
                                <a href="mailbox.html">
                                    <i class="fa fa-angle-double-right"></i> Mailbox
                                </a>
                            </li>
                            <li>
                                <a href="compose-message.html">
                                    <i class="fa fa-angle-double-right"></i> Compose Message
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <i class="fa fa-angle-double-right"></i> Chat
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end MESSAGE CENTER DROPDOWN -->
                    <!-- begin PAGES DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#pages">
                            <i class="fa fa-files-o"></i> Pages <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="pages">
                            <li>
                                <a href="profile.html">
                                    <i class="fa fa-angle-double-right"></i> User Profile
                                </a>
                            </li>
                            <li>
                                <a href="invoice.html">
                                    <i class="fa fa-angle-double-right"></i> Invoice
                                </a>
                            </li>
                            <li>
                                <a href="pricing.html">
                                    <i class="fa fa-angle-double-right"></i> Pricing Tables
                                </a>
                            </li>
                            <li>
                                <a href="faq.html">
                                    <i class="fa fa-angle-double-right"></i> FAQ Page
                                </a>
                            </li>
                            <li>
                                <a href="search-results.html">
                                    <i class="fa fa-angle-double-right"></i> Search Results
                                </a>
                            </li>
                            <li>
                                <a href="login.html">
                                    <i class="fa fa-angle-double-right"></i> Login Basic
                                </a>
                            </li>
                            <li>
                                <a href="login-social.html">
                                    <i class="fa fa-angle-double-right"></i> Login Social
                                </a>
                            </li>
                            <li>
                                <a href="404.html">
                                    <i class="fa fa-angle-double-right"></i> 404 Error
                                </a>
                            </li>
                            <li>
                                <a href="500.html">
                                    <i class="fa fa-angle-double-right"></i> 500 Error
                                </a>
                            </li>
                            <li>
                                <a href="blank.html">
                                    <i class="fa fa-angle-double-right"></i> Blank Page
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end PAGES DROPDOWN -->

*/ ?>
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->



        <?php /*<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.2.min.js"></script>*/?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/bootstrap/bootstrap.min.js"></script>

        <!-- begin MAIN PAGE CONTENT -->
        <div id="page-wrapper">

            <div class="page-content">
		<?php echo $content; ?>
            </div>
            <!-- /.page-content -->

        </div>
        <!-- /#page-wrapper -->
        <!-- end MAIN PAGE CONTENT -->

    </div>
    <!-- /#wrapper -->

    <!-- GLOBAL SCRIPTS -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/popupoverlay/defaults.js"></script>
    <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/img/profile-pic.jpg" alt="">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Haluatko kirjautua ulos?
            </h3>
            <p>Valitse "Ulos" <br> lopettaaksesi istuntosi.</p>
            <ul class="list-inline">
                <li>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout" class="btn btn-green">
                        <strong>Ulos</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Peruuta</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/popupoverlay/logout.js"></script>
    <!-- HISRC Retina Images -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/hisrc/hisrc.js"></script>

    <!-- PAGE LEVEL PLUGIN SCRIPTS -->
    <!-- HubSpot Messenger -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/messenger/messenger.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/messenger/messenger-theme-flat.js"></script>
    <!-- Date Range Picker -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/daterangepicker/moment.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Flot Charts -->
<!--
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/flot/jquery.flot.resize.js"></script>-->
    <!-- Sparkline Charts -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- Moment.js -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/moment/moment.min.js"></script>
    <!-- jQuery Vector Map -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/demo/map-demo-data.js"></script>
    <!-- Easy Pie Chart -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/easypiechart/jquery.easypiechart.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/datatables/datatables-bs3.js"></script>

    <!-- THEME SCRIPTS -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/flex.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/demo/dashboard-demo.js"></script>




<?php
  // <-- Check chat
  if( !Yii::app()->user->isGuest and $curpage != 'site/chat')
  {
    if(!isset(Yii::app()->user->chatCount))
    {
	if(Yii::app()->getModule('user')->user()->profile->getAttribute('yid') != 0)
		$yid = Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
	else
		$yid = Yii::app()->user->id;

	$criteria = new CDbCriteria;
	$criteria->condition = " chat_id='".$yid."' ";
	$model = YiichatPost::model()->findAll($criteria);
	if(isset($model[0]))
	Yii::app()->user->setState('chatCount', count($model));
    }


  	if( isset(Yii::app()->user->chatCount) )
  	echo '<input type="hidden" id="chatCount" value="'.(int)Yii::app()->user->chatCount.'">';
 	else
  	echo '<input type="hidden" id="chatCount" value=0>';

	echo "
	<script type=\"text/javascript\">
	$(document).ready(function(){
	
	$(function() {
	    startRefresh();
	});
	
	function startRefresh() {
	    setTimeout(startRefresh,5000);
	    $.get('".Yii::app()->request->baseUrl."/index.php/site/chat_check', function(data) {
		data=JSON.parse(data);
		if((data !== '') && ( data !== parseFloat($('#chatCount').val()) ) ) {

		  $('.vilkku').pulse({opacity: 0.3}, 
		    {
		     duration : 2250,
		     pulses   : 10000,
		     interval : 300
		 });

	        	$('#chattiPainike').addClass('alerts-link vilkku');
		} else if((data !== '') && ( data === parseFloat($('#chatCount').val()) ) ) {
	        	$('#chattiPainike').removeClass('alerts-link vilkku');
		}
	
		console.log($('#chatCount').val()+ ' '+ data);
	    });
	}
	
	});
	</script>";
  }
  //     Check chat -->

?>


    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.pulse.js"></script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(){

  $('.vilkku').pulse({opacity: 0.3}, 
    {
     duration : 2250,
     pulses   : 10000,
     interval : 300
 });

});
</script>

</body>

</html>

