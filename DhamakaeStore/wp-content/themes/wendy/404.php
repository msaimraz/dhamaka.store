<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */

get_header('error');
global $road_opt;
?>
	<div class="page-404">
		<div class="search-form">
			
			<h3><?php _e( 'This is not the web page you are looking for', 'roadthemes' ); ?></h3>
			<p class="home-link"><?php _e( 'Please try one of the following pages', 'roadthemes' ); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e( 'Home Page', 'roadthemes' ); ?>"><?php _e( 'Home Page', 'roadthemes' ); ?></a></p>
			<label><?php _e('Search our website', 'roadthemes');?></label>
			<?php get_search_form(); ?>
		</div>
	</div>
</div>
<?php get_footer('error'); ?>