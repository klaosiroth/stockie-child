<?php /* Template Name: Contact page */ ?>

<?php
	get_header();

	$show_breadcrumbs = StockieSettings::breadcrumbs_is_displayed();
	$page_wrapped = StockieSettings::page_is_wrapped();
	$add_content_padding = StockieSettings::page_add_top_padding();

	$page_container_class = '';
	if ( !$show_breadcrumbs && $add_content_padding ) {
		$page_container_class .= ' without-breadcrumbs';
	}
	if ( !$page_wrapped ) {
		$page_container_class .= ' full';
	}
	if ( $add_content_padding ) {
		$page_container_class .= ' bottom-offset';
	}
?>
	
<?php get_template_part( 'parts/elements/header-title' ); ?>

<?php get_template_part( 'parts/elements/breadcrumbs' ); ?>

<div class="page-container<?php echo esc_attr( $page_container_class ); ?>">
	<div id="primary" class="content-area">
		<div class="page-content <?php echo esc_attr( $content_container_class ); ?>">
			<main id="main" class="site-main">
				<!-- Custom content -->
				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'parts/content', 'page' );
					endwhile;
				?>
				<div class="vc_row">
					<div class="vc_col-lg-8 vc_col-lg-push-2 vc_col-md-10 vc_col-md-push-1 vc_col-xs-12">
						<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa itaque quos aliquam vitae, natus pariatur vel accusantium! Neque enim ab voluptas doloremque velit natus itaque impedit necessitatibus in? Quis, reprehenderit!</p>
					</div>
					
				</div>
			</main>
		</div>
	</div>
</div>

<?php get_footer(); ?>