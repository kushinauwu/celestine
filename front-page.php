<?php
/**
 * The front page template file
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
                <div class="col-lg-8 blog-main">
                    <?php 
                    // Show the latest post differently.
         $query = new WP_query ( array(
             'posts_per_page' => 1,
            'post_type' => 'post',
            'post_status' => 'publish',
        ) );
        
        if ( $query->have_posts() ) ?>
                    <section class="latest-post">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                        <article id="post-<?php the_ID(); ?>">
                            <div <?php post_class(); ?>>
                                <div class="post-display">

                                    <a href="<?php the_permalink(); ?>">
                                        <h1>
                                            <?php the_title(); ?>
                                        </h1>
                                    </a>
                                    <p class="date">
                                        <?php echo get_the_date(); ?>
                                    </p>
                                    <?php if ( has_post_thumbnail() ) {
                                the_post_thumbnail();
                                } ?>
                                    <div class="post-content">

                                        <p>
                                            <?php the_excerpt(); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; 
                                     rewind_posts();
                                     ?>
                        <?php 
                                     
                wp_reset_postdata(); ?>
                    </section>

                    <?php 
                    // Offset the custom query by one post and show 6 of the next posts in a different style than the latest post.
                    $custom_query_args = array( 
                                                'post_type' => 'post',
                                                'post_status' => 'publish',
                                                'posts_per_page' => 6,
                                                'offset' => 1 );
                    // Get current page and append to custom query parameters array
                    $custom_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                    // Instantiate custom query
                    $custom_query = new WP_Query( $custom_query_args );

                    // Pagination fix
                    $temp_query = $wp_query;
                    $wp_query   = NULL;
                    $wp_query   = $custom_query;

                    // Output custom query loop
                    if ( $custom_query->have_posts() ) : ?>
                    <section class="recent-post">
                        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                        <article id="post-<?php the_ID(); ?>">
                            <div class="post-display">

                                <?php
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail();
                                        }
                                         ?>
                                <div class="post-content">
                                    <a href="<?php the_permalink(); ?>">
                                        <h1>
                                            <?php the_title(); ?>
                                        </h1>
                                    </a>
                                    <p class="date">
                                        <?php echo get_the_date(); ?>
                                    </p>
                                    <p>
                                        <?php the_excerpt(); ?>
                                    </p>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; ?>
                    </section>
                    <?php endif;
                    wp_reset_postdata(); 
                    $wp_query = NULL;
                    $wp_query = $temp_query; ?>

                    <?php
                    // Show the rest of the page contents as edited by the user from the Wordpress console
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
                </div>
                <div class="col-lg-3 offset-lg-1 blog-sidebar">
                    <?php get_sidebar(); ?>
                </div>
            </div>

        </div>
    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>
