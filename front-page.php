<?php /* The template for displaying front page */ ?>

<?php
	get_header();

	$page_wrapped = StockieSettings::page_is_wrapped();
	$add_content_padding = StockieSettings::page_add_top_padding();

	$page_container_class = '';
	if ( !$page_wrapped ) {
		$page_container_class .= ' full';
	}
	if ( $add_content_padding ) {
		$page_container_class .= ' bottom-offset';
	}
?>

<div class="t-home-hero">
   <canvas id="js_snow" class="t-home-hero__canvas"></canvas>
   <div class="t-home-hero__container">
      <div class="t-home-hero__wrapper">
         <p class="t-home-hero__text">Freshmint</p>
         <h1 class="t-home-hero__title">เย็นสดชื่น ไม่เสียวฟัน</h1>
      </div>
   </div>
</div>


<div class="page-container<?php echo esc_attr( $page_container_class ); ?>">
	
	<div class="page-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'parts/content', 'page' );
					}
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .page-content -->

</div><!-- .page-container -->

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/snow.js"></script>

<?php get_footer(); ?>
