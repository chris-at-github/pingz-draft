			<?php if($_T_CONFIG['widescreen'] === false) { ?>
					</div>
				</div>
			<?php } ?>
		</div>

		<?php if($_T_CONFIG['section']['footer'] === true) { ?>
			<footer>
				<div id="footer-container">
					<div class="fluid-grid border-grid equalheight-grid">
						<div class="grid grid-66">
							<div class="grid-inner">
								<nav id="footer-sitemap" class="clearfix">
									<?php
										echo $menu
											->reset()
											->setData($_T_MENU['footerSitemap'])
											->setOptions(array(
												'expandActive'	=> false
											))
											->render();
									?>
								</nav>
							</div>
						</div>
						<div class="grid grid-33">
							<div class="grid-inner">
								<div id="newsletter">
									<strong class="h2">Newsletter</strong>
									<form action="/newsletter/" method="post" class="form-inline clearfix">
										<div class="form-item">
											<div class="form-label"><label for="newsletter-email">E-Mailadresse:</label></div>
											<div class="form-field"><input type="text" id="newsletter-email" value="" placeholder="E-Mailadresse eingeben" /></div>
										</div>
										<div class="form-actions">
											<button class="button button-icon button-icon-arrow button-icon-arrow-white-right" title="Eintragen"></button>
										</div>
									</form>
								</div>

								<div id="social-links">
									<h2>Besuchen Sie uns auch auf</h2>
									<ul class="clearfix">
										<li><a id="social-links-facebook" href="#" title="Facebook"><span>Facebook</span></a></li>
										<li><a id="social-links-googleplus" href="#" title="Google+"><span>Google+</span></a></li>
										<li><a id="social-links-pinterest" href="#" title="Pinterest"><span>Pinterest</span></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="footer-final" class="clearfix">
					<div id="copyright">&copy; <?php echo date('Y'); ?> <strong>Pingz</strong></div>
					<nav id="footmenu">
						<?php
							echo $menu
								->reset()
								->setData($_T_MENU['footer'])
								->setOptions(array(
									'ulHtmlClass'	=> 'clearfix'
								))
								->render();
						?>
					</nav>
				</div>
			</footer>
		<?php } ?>

	</div>
	<!-- /page -->

	<!-- script -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">!window.jQuery && document.write(unescape('%3Cscript type="text/javascript" src="/js/jquery-1.9.1.js"%3E%3C/script%3E'))</script>
	<script type="text/javascript" src="/js/jquery-ui-1.10.3.min.js"></script>
	<?php if(empty($_T_CONFIG['script']) === false) { ?>
		<?php foreach($_T_CONFIG['script'] as $script) { ?>
			<script type="text/javascript" src="<?php echo $script; ?>"></script>
		<?php } ?>
	<?php } ?>
	<script type="text/javascript" src="/js/pingz.functions.js"></script>
	<!-- /script -->

</body>
</html>