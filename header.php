<?php
if(isset($_GET['export']) && $_GET['export'] == rss) $export = true;
else $export = false;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<script type="text/javascript">
//Script Show Hide
function showHideDiv(divId){
	obj = document.getElementById(divId);
	v = obj.style.display; 

	if (v == 'none' || v == '' ) {
		disp = 'block';
	}else {
		disp = 'none';
	}
	
	obj.style.display = disp;
}

</script>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<? if(!$export) : ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" /> 
<? endif ?>
<?php
	if(!$export) wp_head();
?>
</head>
<body <?php body_class(); ?>>
<div class="container">
	<div class="header">
		<? if (!$export): ?>
			<div class="bar">
				<?php
					if ( is_user_logged_in() ) {
					    global $current_user;
						get_currentuserinfo();
						      echo '<span class="userConected">Conectado como: <a href="' . get_bloginfo( 'wpurl' ) .'/author/' . $current_user->user_login . '">' . $current_user->display_name . "\n</b></span>";
						      echo '<span class="controlPanel"><a href="' . get_bloginfo( 'wpurl' ) .'/wp-admin/edit.php?post_type=post&author=' . $current_user->ID . '">Painel de Controle</a></span>';
						      echo '<span class="help"><a href="http://wiki.bireme.org/intranet/index.php/Manual_de_Publica%C3%A7%C3%A3o_do_Boletim_PSI" target="_blank">Ajuda</a></span>';
						      $logout = wp_logout_url( home_url() );
						      echo '<span class="logout"><a href="' . $logout . '" title="Logout">Logout</a></span>';
					} else {
					    echo '<span class="login"><a href="javascript:showHideDiv(\'loginArea\');">Login</a></span>';
					}
					
				?>
			</div><!--/bar-->
		<? endif ?>
		<img src="<?php bloginfo( 'template_directory' ); ?>/images/banner.gif">
		<div class="date">
			<?php
				$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
				$diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");
				$hoje = getdate();
				$dia = $hoje["mday"];
				$mes = $hoje["mon"];
				$nomemes = $meses[$mes];
				$ano = $hoje["year"];
				$diadasemana = $hoje["wday"];
				$nomediadasemana = $diasdasemana[$diadasemana];
				echo "$nomediadasemana, $dia de $nomemes de $ano";
			 ?>
		</div><!--/date-->
	</div><!--/header-->
		
