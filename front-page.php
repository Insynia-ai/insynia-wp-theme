<?php
/**
 * The front page template.
 *
 * Renders the homepage when a static page is assigned under
 * Settings → Reading → "A static page". Customize freely.
 *
 * @package Insynia
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'front-page' ); ?>>
				<?php if ( get_the_content() ) : ?>
					<div class="container container--narrow section entry-content">
						<?php the_content(); ?>
					</div>
				<?php else : ?>
					<section class="section">
						<div class="container container--narrow" style="text-align:center;">
							<h1 class="page-title"><?php bloginfo( 'name' ); ?></h1>
							<p class="page-tagline"><?php bloginfo( 'description' ); ?></p>
							<p class="page-placeholder">
								<?php esc_html_e( 'Edit this page in the WordPress admin to add your homepage content, or customize front-page.php in the theme.', 'insynia' ); ?>
							</p>
						</div>
					</section>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>

</main>

<?php
get_footer();
