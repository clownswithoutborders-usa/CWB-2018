<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CWB-USA
 */

?>

	</div><!-- #content -->
<div class="above-footer" style="border-bottom: 8px solid #faf6f0;text-align:center;">
		<div class="row">
			<div class="column medium-6">
				<p>Stay up-to-date by joining our newsletter and track the CWB troupe from the comfort of your email inbox!</p> <br />
				<a class="buttonlink" href="/newsletter/">Sign up</a>
			</div>
			<div class="column medium-6">
				Looking for something?<br />
				<div style="max-width:260px;margin:6px auto 0;"><?php get_search_form(); ?></div>
			</div>	
		</div>

</div>
<div class="above-footer">
		<div class="row">
			<h2>Connect</h2>
			<?php echo do_shortcode( '[instagram-feed num=4]'); ?>
			<div class="footer-columns">
				<div class="columns medium-2">
					<p>Clowns Without Borders USA<br />
						PO Box 574<br />
						Blue Lake CA 95525<br />
						302-729-3707<br />
						<a href="/privacy-policy/">Privacy Policy</a></p>
				</div>
				<div class="columns medium-2">
				<a href="http://www.cwb-international.org/" target="_blank"><img src="/wp-content/themes/cwb-usa/img/cwbi-logo-transp.png" /></a>


				</div>
				<div class="columns medium-2">
					<div class="gnp-badge" style="display:block; width:133px; height:170px; background:white;margin: 0 auto;">
			    	<div class="white-frame" style="display:block; margin-top: 4px; margin-left: 4px; width:125px; height:149px;">
			        <div style="font-size: 9px; text-align: center; text-decoration:none; font-family: Arial, sans-serif; font-weight: bold; color: white; padding-top: 7px; "><a href="https://greatnonprofits.org/org/clowns-without-borders-inc?badge=1" target="_blank" onclick="_gaq.push(['_trackEvent', 'Badge Simple Click', 'Review This Charity on']);">Review This Charity on</a></div>
			        <div style="font-size: 14px; text-align: center; text-decoration:none; font-family: Arial, sans-serif; font-weight: bold; color: white; padding-top: 2px; padding-bottom: 6px; "><a href="https://greatnonprofits.org/org/clowns-without-borders-inc?badge=1" target="_blank" onclick="_gaq.push(['_trackEvent', 'Badge Simple Click', 'GreatNonprofits']);">GreatNonprofits</a></div>
			                <div style=" display:block; overflow: hidden; min-height: 50px; min-width: 50px; margin-left: 35px; ">
			            <div style="display:block; height: 50px; width: 50px; ">
			                <img src="//static.greatnonprofits.org/images/thumbnails/logos/imgres-1.jpg" alt="CLOWNS WITHOUT BORDERS Inc charity reviews, charity ratings, best charities, best nonprofits, search nonprofits" style="max-width: 50px; max-height: 50px">                <!-- <img src="ORG LOGO..." width="50" alt="charity reviews, charity ratings, best charities, best nonprofits, search nonprofits" /> -->
			            </div>
			        </div>

			        <div style="padding-top:6px; text-align:center; font-family:Arial, sans-serif; text-decoration:none; font-size:10px; ">
			            <a href="https://greatnonprofits.org/org/clowns-without-borders-inc?badge=1" target="_blank" onclick="_gaq.push(['_trackEvent', 'Badge Simple Click', 'Read Review']);">Read reviews about <br> <div style=" line-height: 10px; "><strong>CLOWNS WITHOUT BORDERS Inc</strong></div></a>            
			        </div>

    				</div>

					    <div class="color-link" style="font-size: 9px; text-align: center; text-decoration:none; font-family: Arial, sans-serif; font-weight: bold; color: #e49217; padding-top: 3px; "><a style=" color: #e49217; text-decoration:none;  " href="https://greatnonprofits.org/" target="_blank">Volunteer. Donate. Review.</a></div>

					</div>
				</div>
				<div class="columns medium-3">
					<a href="//greatnonprofits.org/org/clowns-without-borders-inc?badge=1" target="_blank">
							<img src="/wp-content/themes/cwb-usa/img/2015-top-rated-awards-badge-sized.png">
						</a>
				</div>
				<div class="columns medium-3 social">
					<p style="text-align: center;">
					<a href="https://www.facebook.com/clownswithoutborders.usa/" target="_blank">
						<i class="fa fa-facebook-square" aria-hidden="true"></i>
					</a>
					<a href="https://twitter.com/CWBUSA" target="_blank">
						<i class="fa fa-twitter-square" aria-hidden="true"></i>
					</a>
					<a href="https://plus.google.com/u/1/117602869912967579391" target="_blank">
						<i class="fa fa-google-plus-square" aria-hidden="true"></i>
					</a> 
					<a href="https://www.youtube.com/channel/UCDn2LG2LZv45ozUUvVA3onw" target="_blank">
						<i class="fa fa-youtube-square" aria-hidden="true"></i>
					</a> 
					</p>
				</div>
			</div>	
				
			</div>
		</div>


	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
		
		<?php the_field( 'footer_content', 'option' ); ?>
		<div style="text-align:center;">&#169; <?php echo date("Y"); ?> <?php bloginfo('name'); ?></div>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>


</body>


</html>



