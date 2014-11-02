<?php

	$_T_CONFIG_LOCAL = array(
		'widescreen'	=> true,
		'script'			=> array(
			'/script/jcarousel-0.0.3.js'
		),
		'css'	=> array(
		),
		'section' => array(
			'bodyheader' 	=> false
		)
	);

	$_T_WIDGET_LOCAL = array(
	);

?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/tinytools/header.php'); ?>

			<div id="teaser" class="clearfix">
				<ul>
					<li>
						<div class="teaser-inner">
							<h1>Große Wärmekissen</h1>
							<p>
								La la Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
							</p>
						</div>
						<div class="call-to-action teaser-call-to-action"><a href="/dinkelkissen/"><span>zu den <strong>Produkten</strong></span></a></div>
					</li>
				</ul>
			</div>

			<div id="frontpage-container" class="fluid-grid border-grid equalheight-grid">
				<div class="grid grid-66">
					<div class="grid-inner">
						<h2 class="h1">Beliebte Wärmekissen</h2>

						<div class="article-grid article-frontpage-carousel">
							<div data-jcarousel="true" data-wrap="circular" class="carousel">
								<ul>
									<li>
										<a href="/dinkelkissen/smart-stars-stripes.html">
											<span class="article-link-image"><img src="/img/articles/thumb/180_250_75/smart_stars_and_stripes_intro.jpg" alt="Smart Stars &amp; Stripes"></span>
											<span class="article-link-title h3">Smart <strong>Stars &amp; Stripes</strong></span>
											<span class="article-link-price">19,90 € <span class="article-price-notify">*</span></span>
										</a>
									</li>

									<li>
										<a href="/dinkelkissen/stretched-acid-dots.html">
											<span class="article-link-image"><img src="/img/articles/thumb/180_250_75/stretched_acid_dots_intro.jpg" alt="Stretched Acid Dots"></span>
											<span class="article-link-title h3">Stretched <strong>Acid Dots</strong></span>
											<span class="article-link-price">24,90 € <span class="article-price-notify">*</span></span>
										</a>
									</li>

									<li>
										<a href="/dinkelkissen/squared-ms-prison.html">
											<span class="article-link-image"><img src="/img/articles/thumb/180_250_75/squared_ms_prison_intro.jpg" alt="Squared Ms. Prison"></span>
											<span class="article-link-title h3">Squared <strong>Ms. Prison</strong></span>
											<span class="article-link-price">14,90 € <span class="article-price-notify">*</span></span>
										</a>
									</li>

									<li>
										<a href="/dinkelkissen/smart-bluepoint.html">
											<span class="article-link-image"><img src="/img/articles/thumb/180_250_75/smart_bluepoint_intro.jpg" alt="Smart Bluepoint"></span>
											<span class="article-link-title h3">Smart <strong>Bluepoint</strong></span>
											<span class="article-link-price">19,90 € <span class="article-price-notify">*</span></span>
										</a>
									</li>
								</ul>
							</div>
							<a data-jcarousel-control="true" data-target="-=1" href="#" class="carousel-control-prev"><span>&lsaquo;</span></a>
							<a data-jcarousel-control="true" data-target="+=1" href="#" class="carousel-control-next"><span>&rsaquo;</span></a>
						</div>

						<?php echo $widget->render('article-price-notify'); ?>
					</div>
				</div>

				<div id="frontpage-faq" class="grid grid-33">
					<div class="grid-inner">
						<h2 class="h1">Fragen &amp; Antworten</h2>
						<ul class="ul-default ul-gap">
							<li><a href="/produktinformationen/nutzungshinweise/">Wie erwärme ich Dinkelkissen und was muss ich dabei beachten?</a></li>
							<li><a href="/produktinformationen/anwendungsmoeglichkeiten/">Warum sind Dinkelkissen gesund?</a></li>
							<li><a href="/produktinformationen/anwendungsmoeglichkeiten/#wofuer-kann-ich-dinkelkissen-verwenden">Wofür kann ich Dinkelkissen verwenden?</a></li>
							<li><a href="/produktinformationen/dinkel/">Warum ist Dinkel als Füllung von Wärmekissen so gut geeignet?</a></li>
							<li><a href="/produktinformationen/ueber-dinkelkissen/">Was ist das Besondere an Pingz-Dinkelkissen?</a></li>
							<li><a href="/service/bestellvorgang/">Was muss ich beim Bestellen beachten?</a></li>
						</ul>
					</div>
				</div>
			</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/tinytools/footer.php'); ?>