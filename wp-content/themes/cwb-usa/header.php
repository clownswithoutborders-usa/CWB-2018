<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CWB-USA
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-38080782-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-38080782-1');
</script>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="p:domain_verify" content="b68142022bc415c112a9491530cf9f6d"/>
<link rel="profile" href="http://gmpg.org/xfn/11">
<script src="https://use.fontawesome.com/428873c898.js"></script> 

<link href="https://fonts.googleapis.com/css?family=Catamaran:300,500,700|Montserrat" rel="stylesheet">


<?php wp_head(); ?>
<!--Flipcause Integration v3.0// Flipcause Integration Instructions: 
Install the following code block once in the website Header (after <head> tag) -->
<style>
.fc-black_overlay{ 
display:none; position: fixed; z-index:1000001; top: 0%;left: 0%;width: 100%;height: 100%;
background-color: black; filter: alpha(opacity=50); cursor:pointer; opacity:0.5; 
}
.fc-white_content {
opacity:1; display:none; margin-top: -320px; margin-left: -485px; width:970px; height:640px; 
position:fixed; top:50%; left:50%; border: none;z-index:1000002;overflow: auto;
}
.fc-main-box{
opacity:1; display:none; margin:15px auto 0 auto; width:930px; position:relative; z-index:1000003;
}
.fc-widget_close{
opacity:1; background: url(https://www.flipcause.com/assets/close-icon.png);
position:absolute; z-index:1000004; right:-16px; top:-16px; display:block; cursor:pointer; width:49px; height:49px;
}
.floating_button{
display: block; margin-top: 0px; margin-left: 0px; width:auto ; height: auto; 
position:fixed; z-index:999999; overflow: auto;
}
@keyframes backfadesin {
   from { opacity:0; }
   to {opacity:.5;}
}
@-moz-keyframes backfadesin { 
    from { opacity:0; }
    to {opacity:.5;}
}
@-webkit-keyframes backfadesin { 
    from { opacity:0; }
    to {opacity:.5;}
}
@-o-keyframes backfadesin {
    from { opacity:0; }
    to {opacity:.5;}
}
@-ms-keyframes backfadesin {
    from { opacity:0; }
    to {opacity:.5;}
}
@keyframes fadesin {
   0%{ opacity:0; }
   50%{ opacity:0; }
   75% {opacity: 0; transform: translateY(20px);}
   100% {opacity: 1; transform: translateY(0);}
}
@-moz-keyframes fadesin {
   0%{ opacity:0; }
   50%{ opacity:0; }
   75% {opacity: 0; -moz-transform: translateY(20px);}
   100% {opacity: 1; -moz-transform: translateY(0);}
}
@-webkit-keyframes fadesin {
   0%{ opacity:0; }
   50%{ opacity:0; }
   75% {opacity: 0; -webkit-transform: translateY(20px);}
   100% {opacity: 1; -webkit-transform: translateY(0);}
@-o-keyframes fadesin {
   0%{ opacity:0; }
   50%{ opacity:0; }
   75% {opacity: 0; -o-transform: translateY(20px);}
   100% {opacity: 1; -o-transform: translateY(0);}
}
@-ms-keyframes fadesin {
   0%{ opacity:0; }
   50%{ opacity:0; }
   75% {opacity: 0; -ms-transform: translateY(20px);}
   100% {opacity: 1; -ms-transform: translateY(0);}
}
</style>
<script>
function open_window(cause_id) {
var  protocol=String(document.location.protocol);
var new_url;
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
new_url="https://www.flipcause.com/widget/"+cause_id
window.open(new_url);
}
else {
document.getElementById("fc-fade").style.display="block";
document.getElementById("fc-fade").style.webkitAnimation="backfadesin 1s";
document.getElementById("fc-fade").style.animation="backfadesin 1s";
document.getElementById("fc-fade").style.mozAnimation="backfadesin 1s";
document.getElementById("fc-light").style.display="block";
document.getElementById("fc-light").style.webkitAnimation="fadesin 1.5s";
document.getElementById("fc-light").style.animation="fadesin 1.5s";
document.getElementById("fc-light").style.mozAnimation="fadesin 1.5s";
document.getElementById("fc-main").style.display="block";
document.getElementById("fc-main").style.webkitAnimation="fadesin 1.5s";
document.getElementById("fc-main").style.animation="fadesin 1.5s";
document.getElementById("fc-main").style.mozAnimation="fadesin 1.5s";
document.getElementById("fc-close").style.display="block";
document.getElementById("fc-close").style.webkitAnimation="fadesin 1.5s";
document.getElementById("fc-close").style.animation="fadesin 1.5s";
document.getElementById("fc-close").style.mozAnimation="fadesin 1.5s";
document.getElementById("fc-myFrame").style.display="block";
document.getElementById("fc-myFrame").style.webkitAnimation="fadesin 1.5s";
document.getElementById("fc-myFrame").style.animation="fadesin 1.5s";
document.getElementById("fc-myFrame").style.mozAnimation="fadesin 1.5s";
document.getElementById("fc-myFrame").src="https://www.flipcause.com/widget/"+cause_id;
}
}
function close_window() {
document.getElementById("fc-fade").style.display="none";
document.getElementById("fc-light").style.display="none";
document.getElementById("fc-main").style.display="none";
document.getElementById("fc-close").style.display="none";
document.getElementById("fc-myFrame").style.display="none";
}</script>

<div id="fc-fade" class="fc-black_overlay" onclick="close_window()"></div>
<div id="fc-light" class="fc-white_content">
<div id="fc-main" class="fc-main-box">
<div id="fc-close" class="fc-widget_close" onclick="close_window()"> 
</div><iframe id="fc-myFrame" iframe height="580" width="925" style="border: 0; 
border-radius:5px 5px 5px 5px; box-shadow:0 0 8px rgba(0, 0, 0, 0.5);" scrolling="no" src=""></iframe></div>
</div>

<!--END Flipcause Main Integration Code-->
</head>
<style>
/* why is this still here? put this stuff where it's supposed to go ffs */
@media screen and (min-width:960px) {
	.herocontainer {
		margin-top: 69px;
	}
}
.header-inner-wrap {
	background: #f5f6a4;
	padding: 10px 24px;
}
.site-branding {
	max-width: 320px;
}

.section {
	margin-bottom: 36px;
}

</style>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cwb-usa' ); ?></a>


	<header id="masthead" class="site-header clear" role="banner">
	<div id="header-fixed" class="header-inner-wrap">
		<div class="site-branding">

			<div class="logo-large show-for-medium">
				<a href="/"><img class="show-for-medium" src="<?php echo get_stylesheet_directory_uri(); ?>/img/cwb-header-logo_sized.png" /></a>
			</div>
			<div class="logo-small show-for-small-only">
				<a href="/"><img class="show-for-small-only" src="<?php echo get_stylesheet_directory_uri(); ?>/img/cwb-header-logo_sized.png" /></a>
			</div>

			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="menutext">MENU</span><i class="fa fa-bars"></i>
				<i class="fa fa-times"></i>
			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		<div class="clear"></div>
</div>

<?php if ( is_page()  && ! is_page_template( 'page-worksection.php' )) { // if it's a regular page, put hero image here.  
																	// For other post types it has to go further down

                $image = get_field('hero_image');
                $size = 'hero'; // 1600 x 550

    	if( $image ) { ?>
			<div class="herocontainer row expanded">
                    <div class="hero">
                    <?php   echo wp_get_attachment_image( $image, $size ); ?>
                    </div>
        	</div>                  

			</header><!-- #masthead -->

			<div id="content" class="site-content with-hero row expanded">
			<?php } 

			else { ?>
				</header><!-- #masthead -->

			<div id="content" class="site-content row expanded">

		<?php }

 	} 
 	elseif ( is_search() || is_home() || is_archive() && ! is_post_type_archive('project') ) { ?>
 		</header><!-- #masthead -->

	<div id="content" class="site-content row">


	<?php } else { ?>
		</header><!-- #masthead -->

	<div id="content" class="site-content row expanded">


	<?php	} ?>
