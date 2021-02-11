<?php /* Template Name: Contact page */ ?>

<?php get_header(); ?>
	
<?php get_template_part( 'parts/elements/header-title' ); ?>

<?php get_template_part( 'parts/elements/breadcrumbs' ); ?>

<div class="page-container<?php echo esc_attr( $page_container_class ); ?>">
	<div id="primary" class="content-area">
		<div class="page-content <?php echo esc_attr( $content_container_class ); ?>">
			<main id="main" class="site-main">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'parts/content', 'page' );
				endwhile;
			?>
			</main>
		</div>
	</div>
</div>

<?php get_footer(); ?>