<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */
?>
<?php global $road_opt; 
if(is_ssl()){
	$road_opt['logo_main']['url'] = str_replace('http:', 'https:', $road_opt['logo_main']['url']);
}
?>
		<div class="header-container layout1 skin1">
			<div class="header">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<div class="global-table left-logo">
								<div class="global-row">
									<div class="global-cell">
										<?php if( isset($road_opt['logo_main']['url']) ){ ?>
											<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url($road_opt['logo_main']['url']); ?>" alt="" /></a></div>
										<?php
										} else { ?>
											<h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
											<?php
										} ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-9">
							<div class="horizontal-menu">
								<div class="global-table right-menu">
									<div class="global-row">
										<div class="global-cell">
											<div class="visible-large">
												<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'primary-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
											</div>
											<div class="visible-small mobile-menu">
												<div class="nav-container">
													<div class="mbmenu-toggler"><?php if(isset($road_opt['mobile_menu_label'])) {echo esc_html($road_opt['mobile_menu_label']);} ?><span class="mbmenu-icon"></span></div>
													<?php wp_nav_menu( array( 'theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="nav-container">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-md-3">
								<?php
								$cat_menu_class = '';
								if(isset($road_opt['categories_menu_home']) && $road_opt['categories_menu_home']) {
									$cat_menu_class .=' show_home';
								}
								if(isset($road_opt['categories_menu_sub']) && $road_opt['categories_menu_sub']) {
									$cat_menu_class .=' show_inner';
								}
								?>
								<div class="categories-menu visible-large <?php echo esc_attr($cat_menu_class); ?>">
									<div class="catemenu-toggler"><i class="fa fa-bars"></i><span><?php if(isset($road_opt)) { echo esc_html($road_opt['categories_menu_label']); } else { _e('Category', 'roadthemes'); } ?></span><i class="fa fa-chevron-circle-down"></i></div>
									<?php wp_nav_menu( array( 'theme_location' => 'categories', 'container_class' => 'categories-menu-container', 'menu_class' => 'categories-menu' ) ); ?>
									<div class="morelesscate">
										<span class="morecate"><i class="fa fa-plus"></i><?php if ( isset($road_opt['categories_more_label']) && $road_opt['categories_more_label']!='' ) { echo esc_html($road_opt['categories_more_label']); } else { _e('More Categories', 'roadthemes'); } ?></span>
										<span class="lesscate"><i class="fa fa-minus"></i><?php if ( isset($road_opt['categories_less_label']) && $road_opt['categories_less_label']!='' ) { echo esc_html($road_opt['categories_less_label']); } else { _e('Close Menu', 'roadthemes'); } ?></span>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-9">
								
								<?php if( class_exists('WC_Widget_Product_Categories') && class_exists('WC_Widget_Product_Search') ) { ?>
								<div class="header-search">
									<div class="cate-toggler"><?php _e('All Categories', 'roadthemes');?></div>
									<?php the_widget('WC_Widget_Product_Categories', array('hierarchical' => true, 'title' => 'Categories', 'orderby' => 'order')); ?>
									<?php the_widget('WC_Widget_Product_Search', array('title' => 'Search')); ?>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .header -->
			<div class="clearfix"></div>
		</div>