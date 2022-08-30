<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */

global $road_opt;

get_header();
?>
<?php
$blogsidebar = 'right';
if(isset($road_opt['sidebarblog_pos']) && $road_opt['sidebarblog_pos']!=''){
	$blogsidebar = $road_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$blogsidebar = $_GET['sidebar'];
}
$blogclass = 'blog-sidebar';
$blogcolclass = 9;
$road_postthumb = 'category-thumb';
?>
<div class="main-container page-wrapper">
	<div class="blog_header"><?php _e('Blog', 'roadthemes'); ?></div>
	<div class="container">
		<?php road_breadcrumb(); ?>
		<div class="row">

			<?php if($blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<div class="col-xs-12 <?php echo 'col-md-'.$blogcolclass; ?>">
				<div class="page-content blog-page single <?php echo esc_attr($blogclass); if($blogsidebar=='left') {echo ' left-sidebar'; } if($blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

						<?php comments_template( '', true ); ?>
						
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php if( $blogsidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>