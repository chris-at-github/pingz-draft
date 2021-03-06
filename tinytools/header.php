<?php

/*
|-----------------------------------------------------------------
| Konfiguration
|-----------------------------------------------------------------
| Array mit den Einstellungen, Menueeintraegen, usw. laden
|
*/
	include($_SERVER['DOCUMENT_ROOT'] . '/tinytools/php/config.php');

/*
|-----------------------------------------------------------------
| TinyTools
|-----------------------------------------------------------------
| lade alle PHP-Anwendungen, Funktionen, Einstellungen, die
| waehrend des Seitenaufbaus benoetigt werden
|
*/
	include($_SERVER['DOCUMENT_ROOT'] . '/tinytools/php/init.php');

/*
|-----------------------------------------------------------------
| Seitenelemente
|-----------------------------------------------------------------
| setzt die Seitenelemente, wie Seitentitel, Keywords, usw.
| zusammen. Sollten auf der Seite keine eigenen Elemente angegeben
| worden sein, werden die Daten aus der Konfigurationsdatei
| verwendet
|
*/
	if(isset($_T_CONFIG_LOCAL) === false) {
		$_T_CONFIG_LOCAL = array();
	}

	$_T_CONFIG = tArray::arrayMergeRecursive($_T_CONFIG_DEFAULT, $_T_CONFIG_LOCAL);

/*
|-----------------------------------------------------------------
| Menue-Bibliothek
|-----------------------------------------------------------------
| laden der Menuebibliothek, die zur Anzeige der verschiedenen
| Menues, des Breadcrumbs, ... usw. benoetigt wird
|
*/
	$menu = tMenu::singleton()
		->reset()
		->setConfiguration($_T_CONFIG)
		->setActive($_SERVER['PHP_SELF'])
		->setData(array_merge($_T_MENU['header'], $_T_MENU['mainmenu'], $_T_MENU['footerSitemap'], $_T_MENU['footer'], $_T_MENU['basket'], $_T_MENU['user']));

	if(isset($_T_HEADER) === false) {
		$_T_HEADER = $menu->getActiveTitle();
	}

/*
|-----------------------------------------------------------------
| Elements
|-----------------------------------------------------------------
| laden von fertigen Seitenteilen wie z.B. Infoboxen in der linken
| Spalte, abhaenig von der aktuellen URL
|
*/

	if(isset($_T_WIDGET_LOCAL) === false) {
		$_T_WIDGET_LOCAL = array();
	}

	$_T_WIDGET	= array_merge($_T_WIDGET_DEFAULT, $_T_WIDGET_LOCAL);

	// Widget Factory initialisieren
	$widget			= tWidget::singleton()
		->setConfiguration($_T_CONFIG)
		->setData($_T_WIDGET);
?>
<!doctype html>
<!--[if ie 7]> <html class="no-js ie ie7" lang="de" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if ie 8]> <html class="no-js ie ie8" lang="de" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if ie 9]> <html class="no-js ie ie9" lang="de" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<html class="no-js" lang="de" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $menu->renderBreadcrumbTitle(); ?>Pingz Webshop</title>

	<!-- meta -->
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="must-revalidate" />

	<meta name="keywords" content="<?php echo $_T_CONFIG['meta']['keywords']; ?>" />
	<meta name="description" content="<?php echo $_T_CONFIG['meta']['description']; ?>" />
	<meta name="author" content="Christian Pschorr; http://christian-pschorr.de/" />
	<meta name="language" content="german, deutsch, de, ch, at" />

	<meta name="robots" content="all" />
	<meta name="robots" content="index, follow" />
	<meta name="revisit-after" content="3 days" />
	<!-- /meta -->

	<!--[if lt ie 9]><script src="/out/pingz/src/js/html5shiv.js"></script><![endif]-->

	<!-- favicon -->
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">

	<!-- style -->
	<link rel="stylesheet" type="text/css" href="/out/pingz/src/css/screen.css" media="screen, projection, print" />
	<?php if(empty($_T_CONFIG['css']) === false) { ?>
		<?php foreach($_T_CONFIG['css'] as $css) { ?>
			<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>" media="screen, projection, print" />
		<?php } ?>
	<?php } ?>
	<!-- /style -->

</head>
<body class="no-js">

	<!-- page -->
	<div id="page" <?php if(isset($_T_SCHEMA['type']) === true) { echo 'itemscope itemtype="' . $_T_SCHEMA['type'] . '"'; } ?><?php if($_T_CONFIG['widescreen'] === true) { echo 'class="widescreen"'; } ?>>

		<?php if($_T_CONFIG['section']['header'] === true) { ?>
			<header id="header" class="clearfix">
				<div id="logo"><a href="/" title="Logo mit Link auf die Pingz Startseite"><img src="/out/pingz/img/logo.png" alt="Logo Pingz" /></a></div>
				<nav id="headmenu">
					<ul class="clearfix">
						<li class="dropdown">
							<a href="/konto/" title="Meine Kontoinformationen" class="dropdown-trigger">Mein Konto<span class="caret"></span></a>
							<!--<ul class="dropdown-menu">
								<li><a href="#">Mein Konto</a></li>
								<li><a href="#">Mein Merkzettel</a></li>
								<li><a href="#">Mein Wunschzettel</a></li>
							</ul>-->
						</li>
						<?php
							echo $menu
								->reset()
								->setData($_T_MENU['header'])
								->setOptions(array(
									'renderUlTag' 	=> false,
									'setFirstChild'	=> false,
									'maxDepth'			=> 1
								))
								->render();
						?>
					</ul>
				</nav>
				<nav id="mainmenu" class="nav-collapse">
					<?php
						echo $menu
							->reset()
							->setData($_T_MENU['mainmenu'])
							->setOptions(array(
								'maxDepth'		=> 1,
								'ulHtmlClass'	=> 'clearfix'
							))
							->render();
					?>
				</nav>
				<div id="basket">
<!--					<div id="basket-new-article-notice"><div class="arrow"></div>
						<div class="notice-description text-small">Neuer Artikel im Warenkorb</div>
						<div class="notice-article">Smart <strong>Stars &amp; Stripes</strong></div>
					</div>-->

					<a id="basket-trigger" href="/warenkorb">
						<span id="basket-title">Ihr Warenkorb</span>
						<span id="basket-status"><span id="basket-status-products">2 <span id="basket-status-products-label">Produkte</span></span><span id="basket-status-price">34,98 €</span></span>
					</a>
				</div>
			</header>
		<?php } ?>

		<div id="body">
			<?php if($_T_CONFIG['section']['bodyheader'] === true) { ?>
				<header id="body-header">
					<div id="body-header-inner">
						<?php if($_T_CONFIG['section']['breadcrumb'] === true) { ?>
							<div id="breadcrumb" class="clearfix">
								<div id="breadcrumb-title">Sie sind hier:</div>
								<?php echo $menu->renderBreadcrumb(); ?>
							</div>
						<?php } ?>
						<h1 <?php if(isset($_T_SCHEMA['type']) === true) { echo 'itemprop="name"'; } ?>><?php echo $_T_HEADER; ?></h1>
					</div>
				</header>
			<?php } ?>

			<?php if($_T_CONFIG['widescreen'] === false) { ?>
				<div class="fluid-grid">
					<div id="body-inner" class="grid">
			<?php } ?>