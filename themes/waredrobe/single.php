<?php
/*
 * The template for displaying all single posts
 */

get_header(); ?>

<div class="page-single">

    <div>
    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('post');?>>

            <div class="entry-thumbnails"><?php echo get_the_post_thumbnail( $page->ID, 'large'); ?></div>

            <div class="entry-header">
                <h1><?php the_title(); ?></h1>
            </div>

            <div class="entry-content">
                <?php the_content();?>

                <?php
                if( current_user_can( 'edit_posts' ) ) {
                    echo '<a href="'. get_edit_post_link($page->ID) .'">Edit</a>';
                }
                ?>
            </div>

        </article>

        <?php

    endwhile; ?>
    </div>

<?php get_sidebar(); ?>

</div>

<?php get_footer();
