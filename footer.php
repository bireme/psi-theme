	<div class="footer">
		<ul class="institutionList">
			<li>
				<a target="_blank" title="BIREME" id="bireme" href="http://www.bireme.org">
					<span>
						<strong>BIREME/OPAS/OMS</strong>
					</span>
				</a>
			</li>
			<li>
				<strong>BIREME/OPAS/OMS</strong><br>
				Centro Latino-Americano e do Caribe de Informação em Ciências da Saúde<br>
				Rua Botucatu, 862 - 04023-901 - São Paulo/SP - Brasil - Tel: (55 11) 5576-9800 - Fax: (55 11) 5575-8868<br>
			</li>
		</ul>
		<div class="spacer"></div>
	</div>
</div><!--/container-->
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<div id="loginArea" style="display: none;">
	<div class="area980">
		<div class="Box">
		<span class="closeButton"><a href="javascript:showHideDiv('loginArea');">Fechar</a></span>
			<!-- Start Login-Box -->
				<form action="<?php bloginfo( 'wpurl' ); ?>/wp-login.php" method="post">
					<fieldset>
						<legend id="loginbox_title">Login</legend>
			
						<p id="loginbox_username">
							<label>Usuário:<br />
							<input type="text" name="log" id="user_login" class="loginbox_text" value="" /></label>
						</p>
						<p id="loginbox_password">
							<label>Senha:<br />
							<input type="password" name="pwd" id="user_pass" class="loginbox_text" value="" /></label>
						</p>
			
						<p id="loginbox_rememberme">
							<label><input name="rememberme" type="checkbox" id="rememberme" class="loginbox_checkbox" value="forever" />Lembrar</label>
						</p>
						<p id="loginbox_submit"><input type="submit" class="loginbox_button" value="Login &raquo;" /></p>
						<input type="hidden" name="redirect_to" value="
						<?php
							if ( is_home() ) {
							    echo get_bloginfo( 'wpurl' );
							} else {
							    echo get_permalink();
							}
						?>
						">					
					</fieldset>
				</form>
			<!-- End Login-Box -->
		</div>
	</div>
</div>
</body>
</html>
