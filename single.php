<?php
	get_header();

	$show_breadcrumbs = StockieSettings::breadcrumbs_is_displayed();
	$page_wrapped = StockieSettings::page_is_wrapped();
	$sidebar_position = StockieSettings::get_post_sidebar_position();

	$hide_author_widget = StockieSettings::get( 'post_hide_author_widget', 'global' );
	if ( ! isset( $hide_author_widget ) ) {
		$hide_author_widget = false;
	}

	$hide_comments = StockieSettings::get( 'post_hide_comments', 'global' );

	$sidebar_row_class = '';
	if ( $sidebar_position == 'right' ) {
		$sidebar_row_class = ' with-right-sidebar';
	} elseif ( $sidebar_position == 'left' ) {
		$sidebar_row_class = ' with-left-sidebar';
	}
	$sidebar_layout = StockieSettings::page_sidebar_layout();
	$sidebar_class = '';
	if ( $sidebar_layout ) {
		$sidebar_class .= ' sidebar-' . $sidebar_layout;
	}

	$page_container_class = '';
	if ( !$show_breadcrumbs ) {
		$page_container_class .= ' without-breadcrumbs';
	}
	if ( !$page_wrapped ) {
		$page_container_class .= ' full';
	}

	while ( have_posts() ) : the_post();
?>

<?php get_template_part( 'parts/elements/header-title' ); ?>

<?php get_template_part( 'parts/elements/breadcrumbs' ); ?>

<div class="page-container <?php echo esc_attr( $page_container_class ); ?>">
	
	<?php if ( is_active_sidebar( 'stockie-sidebar-blog' ) && $sidebar_position == 'left' ) : ?>
	<div class="page-sidebar sidebar-left<?php echo esc_attr( $sidebar_class ); ?>">
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'stockie-sidebar-blog' ); ?>
		</aside>
	</div>
	<?php endif; ?>

	<div class="page-content<?php echo esc_attr( $sidebar_row_class ); ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main page-offset-bottom">
				<div class="vc_row">
					<div class="vc_col-lg-8 vc_col-lg-push-2"> <!-- <div class="vc_col-lg-12"> -->
					<?php get_template_part( 'parts/content', get_post_format() ); ?>
					<?php
						$author = get_the_author_meta( 'ID' );
						if ( $author && get_the_author_meta( 'description', $author ) && ! $hide_author_widget ) {
							the_widget( 'stockie_widget_about_author', array( 'words' => '' ) );
						}
					?>	
					</div>
				</div>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

	<?php if ( is_active_sidebar( 'stockie-sidebar-blog' ) && $sidebar_position == 'right' ) : ?>
	<div class="page-sidebar sidebar-right<?php echo esc_attr( $sidebar_class ); ?>">
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'stockie-sidebar-blog' ); ?>
		</aside>
	</div>
	<?php endif; ?>

</div>

<?php get_template_part( 'parts/elements/next-n-prev-posts' ); ?>

<?php get_template_part( 'parts/elements/related-posts' ); ?>

<?php if ( !$hide_comments && (comments_open() || get_comments_number()) ) : ?>
	<?php comments_template(); ?>
<?php endif; ?>

<?php
	endwhile;
	get_footer();