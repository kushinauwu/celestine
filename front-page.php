<?php
/**
 * The front page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package celestine
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <header id="masthead" class="site-header">
                <div class="site-branding">
                    <?php
			the_custom_logo();
			if ( is_front_page() ) :
				?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?></a></h1>
                    <?php
			else :
				?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?></a></p>
                    <?php
			endif;
			$celestine_description = get_bloginfo( 'description', 'display' );
			if ( $celestine_description || is_customize_preview() ) :
				?>
                    <p class="site-description">
                        <?php echo $celestine_description; /* WPCS: xss ok. */ ?>
                    </p>
                    <?php endif; ?>
                </div><!-- .site-branding -->
            </header><!-- #masthead -->

            <div class="row">
                <div class="col-lg-8">
                    <?php // latest post
         $query = new WP_query ( array(
             'posts_per_page' => 1,
            'post_type' => 'post',
            'post_status' => 'publish',
        ) );
        
        if ( $query->have_posts() ) ?>
                    <section class="latest-post">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                        <article id="post-<?php the_ID(); ?>">
                            <div class="post-display">

                                <a href="<?php the_permalink(); ?>">
                                    <h1>
                                        <?php the_title(); ?>
                                    </h1>
                                </a>
                                <?php the_post_thumbnail(); ?>
                                <div class="post-content">

                                    <p>
                                        <?php the_excerpt(); ?>
                                    </p>
                                </div>

                            </div>
                        </article>
                        <?php endwhile; 
                                     rewind_posts();
                                     ?>
                        <?php 
                                     
                wp_reset_postdata(); ?>
                    </section>



                    <?php $query = new WP_query ( array(
            'post_type' => 'post',
            'post_status' => 'publish',
    'posts_per_page' => 3,
            'offset' => 1
        ) );
        
        if ( $query->have_posts() ) ?>
                    <section class="recent-post">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                        <article id="post-<?php the_ID(); ?>">
                            <div class="post-display">

                                <a href="<?php the_permalink(); ?>">
                                    <h2>
                                        <?php the_title(); ?>
                                    </h2>
                                </a>
                                <?php the_post_thumbnail(); ?>
                                <div class="post-content">
                                    <p class="date"> [
                                        <?php the_date(); ?> ]</p>
                                    <p>
                                        <?php the_excerpt(); ?>
                                    </p>
                                </div>

                            </div>
                        </article>
                        <?php endwhile; 
                                     rewind_posts();
                                     ?>
                        <?php 
                                     
                wp_reset_postdata(); ?>
                    </section>
                </div>
                <div class="col-lg-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>

        </div>
    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>
