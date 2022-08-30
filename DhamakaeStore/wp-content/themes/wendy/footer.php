<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */
?>
<?php global $road_opt; ?>
			<div class="footer">
				<?php if( isset($road_opt['newsletter_form']) || isset($road_opt['social_icons']) ) { ?>
				<div class="footer-top">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-md-5 col-sm-5">
								<div class="widget widget-last">
									<h3 class="widget-title"><?php echo esc_html($road_opt['follow_title']);?></h3>
									<?php
									if(isset($road_opt['social_icons'])) {
										echo '<ul class="social-icons">';
										foreach($road_opt['social_icons'] as $key=>$value ) {
											if($value!=''){
												if($key=='vimeo'){
													echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';
												} else {
													echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-'.esc_attr($key).'"></i></a></li>';
												}
											}
										}
										echo '</ul>';
									}
									?>
								</div>
							</div>
<!-- 							<div class="col-xs-12 col-md-7 col-sm-7">
							
								if ( isset($road_opt['newsletter_form']) ) {
									if(class_exists( 'WYSIJA_NL_Widget' )){
										the_widget('WYSIJA_NL_Widget', array(
											'title' => esc_html($road_opt['newsletter_title']),
											'form' => (int)$road_opt['newsletter_form'],
											'id_form' => 'newsletter1',
											'success' => '',
										));
									}
								}
								
							</div> -->
						</div>
					</div>
				</div>
				<?php } ?>
				<?php 
				$showftmiddle = false;
				if(isset($road_opt['about_us']) && $road_opt['about_us']!=''){
					$showftmiddle = true;
				}
				if( isset($road_opt['footer_menu1']) && $road_opt['footer_menu1']!='' ) {
					$showftmiddle = true;
				}
				if( isset($road_opt['footer_menu2']) && $road_opt['footer_menu2']!='' ) {
					$showftmiddle = true;
				}
				if(isset($road_opt['contact_us']) && $road_opt['contact_us']!=''){
					$showftmiddle = true;
				}
				if($showftmiddle) { ?>
				<div class="footer-middle">
					<div class="container">
						<div class="row">
							<?php if(isset($road_opt['about_us']) && $road_opt['about_us']!=''){ ?>
							<div class="col-xs-12 col-md-4 col-sm-6">
								<div class="widget_footer_about">
									<?php echo wp_kses($road_opt['about_us'], array(
										'a' => array(
											'href' => array(),
											'title' => array()
										),
										'img' => array(
											'src' => array(),
											'alt' => array()
										),
										'ul' => array(),
										'li' => array(),
										'i' => array(
											'class' => array()
										),
										'br' => array(),
										'em' => array(),
										'strong' => array(),
										'p' => array(),
									)); ?>
								</div>	
							</div>
							<?php } ?>
							<?php
							if( isset($road_opt['footer_menu1']) && $road_opt['footer_menu1']!='' ) {
								$menu1_object = wp_get_nav_menu_object( $road_opt['footer_menu1'] );
								$menu1_args = array(
									'menu_class'      => 'nav_menu',
									'menu'         => $road_opt['footer_menu1'],
								); ?>
								<div class="col-xs-12 col-md-2 col-sm-6">
									<div class="widget widget_menu">
										<h3 class="widget-title"><?php echo esc_html($menu1_object->name); ?></h3>
										<?php wp_nav_menu( $menu1_args ); ?>
									</div>
								</div>
							<?php }
							if( isset($road_opt['footer_menu2']) && $road_opt['footer_menu2']!='' ) {
								$menu2_object = wp_get_nav_menu_object( $road_opt['footer_menu2'] );
								$menu2_args = array(
									'menu_class'      => 'nav_menu',
									'menu'         => $road_opt['footer_menu2'],
								); ?>
								<div class="col-xs-12 col-md-2 col-sm-6">
									<div class="widget widget_menu">
										<h3 class="widget-title"><?php echo esc_html($menu2_object->name); ?></h3>
										<?php wp_nav_menu( $menu2_args ); ?>
									</div>
								</div>
							<?php } ?>
							
							<?php if(isset($road_opt['contact_us']) && $road_opt['contact_us']!=''){ ?>
							<div class="col-xs-12 col-md-3 col-sm-6">
								<div class="widget widget_contact_us">
								<h3 class="widget-title"><?php echo esc_html($road_opt['contact_title']);?></h3>
								<?php echo wp_kses($road_opt['contact_us'], array(
										'a' => array(
											'href' => array(),
											'title' => array()
										),
										'img' => array(
											'src' => array(),
											'alt' => array()
										),
										'ul' => array(),
										'li' => array(),
										'i' => array(
											'class' => array()
										),
										'br' => array(),
										'em' => array(),
										'strong' => array(),
										'p' => array(),
									)); ?>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-md-6 col-sm-6">
								<div class="bottom-left">
									
								</div>
							</div>
							<div class="col-xs-12 col-md-6 col-sm-6">
								<div class="copyright-info">
									<?php 
									if( isset($road_opt['copyright']) && $road_opt['copyright']!='' ) {
										echo wp_kses($road_opt['copyright'], array(
											'a' => array(
												'href' => array(),
												'title' => array()
											),
											'br' => array(),
											'em' => array(),
											'strong' => array(),
										));
									} else {
										echo 'Copyright <a href="http://www.dhamakastore.com/">Dhamaka Store</a> 2022. All Rights Reserved';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .page -->
	</div><!-- .wrapper -->
	<div id="back-top" class="hidden-xs hidden-sm hidden-md"></div>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie8.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_footer(); ?>
</body>
</html>