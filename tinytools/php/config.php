<?php

/*
|-------------------------------------------------------------------------------
| Konfiguration
|-------------------------------------------------------------------------------
*/
$_T_CONFIG_DEFAULT = array(

	'meta' => array(
		'keywords'		=> 'Pingz, Wärmekissen, XXL, Dinkel, Kirschkern, klein, groß',
		'description'	=> 'Eine Auswahl von stylischen, selbstproduzierten Wärmekissen mit Dinkel- oder Kirschkernfüllung. Mit passenden Größen sowohl für die ganz Kleinen als auch XXL-Wärmekissen für die großen Genießer.'
	),

	'breadcrumb'	=> array(
		'root'	=>	array(
			'url'		=> '/',
			'title'	=> 'Startseite'
		),
		'seperator'	=> ' &#187; '
	),

	'section'	=> array(
		'header'			=> true,
		'footer'			=> true,
		'breadcrumb'	=> true,
		'bodyheader'	=> true
	),

	'widescreen'	=> false,

	'css'	=> array(),

	'script'	=> array(
		'/out/pingz/src/js/i18n/messages.de.js',
		'/out/pingz/src/js/parsley-1.1.16.js'
	)
);

/*
|-------------------------------------------------------------------------------
| Menue
|-------------------------------------------------------------------------------
*/
$_T_MENU['mainmenu'] = array(
	'/dinkelkissen/' => array(
		'title'			=> 'Dinkelkissen',
		'children'	=> array(
			'/dinkelkissen/smart-stars-stripes/' => array(
				'title'	=> 'Smart Stars & Stripes',
				'menu'	=> false
			),
			'/dinkelkissen/stretched-acid-dots/' => array(
				'title'	=> 'Stretched Acid Dots',
				'menu'	=> false
			),
			'/dinkelkissen/squared-ms-prison/' => array(
				'title'	=> 'Squared Ms. Prison',
				'menu'	=> false
			),
			'/dinkelkissen/smart-bluepoint/' => array(
				'title'	=> 'Smart Bluepoint',
				'menu'	=> false
			)
		)
	),
	'/ueber-uns/' => array(
		'title'			=> 'Über uns'
	),
	'/kontakt/' => array(
		'title'			=> 'Kontakt'
	)
);

$_T_MENU['basket'] = array(
	'/warenkorb/' => array(
		'title'			=> 'Warenkorb',
		'children'	=> array(
			'/warenkorb/2/' => array(
				'title'	=> 'Adressen wählen',
				'menu'	=> false
			),
			'/warenkorb/3/' => array(
				'title'	=> 'Versand &amp; Zahlungsart',
				'menu'	=> false
			),
			'/warenkorb/4/' => array(
				'title'	=> 'Überprüfen &amp; Absenden',
				'menu'	=> false
			),
			'/warenkorb/5/' => array(
				'title'	=> 'Bestellung abschliessen',
				'menu'	=> false
			)
		)
	)
);

$_T_MENU['user'] = array(
	'/konto/' => array(
		'title'	=> 'Mein Konto',
		'children'	=> array(
			'/konto/bestellhistorie/' => array(
				'title'	=> 'Bestellhistorie'
			),
			'/konto/registrieren/' => array(
				'title'	=> 'Registrieren'
			)
		)
	)
);

$_T_MENU['header'] = array(
	'/konto/registrieren/' => array(
		'title'	=> 'Registrieren'
	),
	'/hilfe/' => array(
		'title'	=> 'Hilfe',
		'children'	=> array(
			'/hilfe/produktinformationen/' => array(
				'title'	=> 'Produktinformationen',
				'children'	=> array(
					'/hilfe/produktinformationen/fuellungen/' => array(
						'title'	=> 'Füllungen',
						'children'	=> array(
							'/hilfe/produktinformationen/fuellungen/dinkel/' => array(
								'title'	=> 'Dinkel'
							),
							'/hilfe/produktinformationen/fuellungen/kirschkerne/' => array(
								'title'	=> 'Kirschkerne'
							)
						)
					),
					'/hilfe/produktinformationen/herstellung/' => array(
						'title'	=> 'Herstellung'
					)
				)
			),
			'/hilfe/bezahlung-versand/' => array(
				'title'	=> 'Bezahlung und Versand'
			)
		)
	)
);

$_T_MENU['footerSitemap'] = array(
	'/service/'	=> array(
		'title'			=> 'Service',
		'children'	=> array(
			'/kontakt/' => array(
				'title'	=> 'Kontaktieren Sie uns'
			),
			'/service/bestellvorgang/' => array(
				'title'	=> 'Bestellvorgang'
			),
			'/service/haeufige-fragen/' => array(
				'title'	=> 'Häufige Fragen'
			)
		)
	),
	'/produktinformationen/'	=> array(
		'title'			=> 'Produktinformationen',
		'children'	=> array(
			'/produktinformationen/dinkel/' => array(
				'title'	=> 'Dinkel'
			),
			'/produktinformationen/anwendungsmoeglichkeiten/' => array(
				'title'	=> 'Anwendungsmöglichkeiten'
			),
			'/produktinformationen/nutzungshinweise/' => array(
				'title'	=> 'Nutzungshinweise'
			)
		)
	),
	'/rechtliche-hinweise/'	=> array(
		'title'			=> 'Rechtliche Hinweise',
		'children'	=> array(
			'/rechtliche-hinweise/datenschutzerklaerung/' => array(
				'title'	=> 'Datenschutzerklärung'
			),
			'/rechtliche-hinweise/allgemeine-geschaeftsbedingungen/' => array(
				'title'	=> 'Allgemeine Geschäftsbedingungen'
			),
			'/rechtliche-hinweise/widerrufsbelehrung/' => array(
				'title'	=> 'Widerrufsbelehrung'
			)
		)
	)
);

$_T_MENU['footer'] = array(
	'/'	=> array(
		'title' 		=> 'Startseite',
	),
	'/impressum/'	=> array(
		'title'			=> 'Impressum',
	),
	'/ueber-uns/'	=> array(
		'title'			=> 'Über uns',
	)
);

/*
|-------------------------------------------------------------------------------
| Widgets
|-------------------------------------------------------------------------------
*/
$_T_WIDGET_DEFAULT = array(
	'article-price-notify'	=> '/widget/article-price-notify.html'
);

?>