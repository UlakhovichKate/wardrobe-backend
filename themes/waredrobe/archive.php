<?php
/*
 * The template for displaying archive pages
 */

get_header();
?>

<h1>Category: <?php echo single_cat_title("", false); ?></h1>

<?php if ( have_posts() ) : ?>

    <div class="page">

	<?php /* Start the Loop */
	while ( have_posts() ) : the_post(); ?>

		<div <?php post_class('one-post');?>>

			<div class="entry-thumbnail">
				<a href="<?php echo esc_url(get_the_permalink());?>">
                    <?php echo get_the_post_thumbnail( $page->ID, 'thumbnail'); ?>
				</a>
			</div>

			<div class="entry-title">
				<a href="<?php echo esc_url(get_the_permalink());?>" class="h3"><?php the_title();?></a>
			</div>

			<div class="entry-summary"><?php

				if(has_excerpt()){
					echo wp_kses_post(get_the_excerpt());
				} else {
					echo wp_kses_post(wp_trim_words(get_the_content(), 30, ' ...' ));
				}

			?></div>



		</div>

	<?php endwhile; ?>

    </div>

<?php endif;

get_footer();
