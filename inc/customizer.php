<?php
/**
 * celestine Theme Customizer
 *
 * @package celestine
 */




/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * Add color scheme support for changing text colors.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function celestine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    
    // Color scheme
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    $wp_customize->add_section('textcolors', array('title' => 'Color Scheme',));
    
    // Primary / site title, headings, nav links, blockquote border, footer
    $txtcolors[] = array(
        'slug' => 'color_scheme_1',
        'default' => '#65B6FF',
        'label' => 'Primary Color'
    );
    
    // Secondary / site description, sidebar headings, nav links on hover, button bg-border
    $txtcolors[] = array(
        'slug' => 'color_scheme_2',
        'default' => '#2A447E',
        'label' => 'Secondary Color'
    );
    
    // Link color
    $txtcolors[] = array(
        'slug' => 'link_color',
        'default' => '#65B6FF',
        'label' => 'Link Color'
    );
    
    // Link hover color
    $txtcolors[] = array(
        'slug' => 'link_color_hover',
        'default' => '#2A447E',
        'label' => 'Link Hover Color'
    );
    
    // Text color
    $txtcolors[] = array(
        'slug' => 'text_color',
        'default' => '#000',
        'label' => 'Text Color'
    );
    
    // Add the settings and controls for each color
    foreach( $txtcolors as $txtcolor ) {
        $wp_customize->add_setting(
            $txtcolor['slug'], array(
                'default' => $txtcolor['default'],
                'type' => 'option', 
                'capability' =>  'edit_theme_options',
                'sanitize_callback' => 'esc_attr',

            )
        ); 

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $txtcolor['slug'], 
                array('label' => $txtcolor['label'], 
                'section' => 'textcolors',
                'settings' => $txtcolor['slug'])
            )
        );
    }

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'celestine_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'celestine_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'celestine_customize_register' );

/**
 * Generate CSS based on user defined color scheme
 */
function celestine_customize_colors() {
     // Primary color
    $color_scheme_1 = get_option( 'color_scheme_1' );

    // Secondary color
    $color_scheme_2 = get_option( 'color_scheme_2' );

    // Link color
    $link_color = get_option( 'link_color' );

    // Hover or active link color
    $hover_link_color = get_option( 'link_color_hover' );
    
    // Text color
    $text_color = get_option( 'text_color' );   
    ?>

<style>
    .site-title a,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .navbar-light .navbar-nav .nav-link,
    .main-navigation .dropdown-item,
    footer h3 {
        color: <?php echo $color_scheme_1;
        ?>;
    }

    blockquote {
        border-left-color: <?php echo $color_scheme_1;
        ?>;
        border-right-color: <?php echo $color_scheme_1;
        ?>;
    }

    button:hover,
    input[type="button"]:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover,
    .sticky {
        border-color: <?php echo $color_scheme_1;
        ?>;
    }

    .main-navigation li:after {
        background-color: <?php echo $color_scheme_1;
        ?>;
    }

    .site-description,
    .blog-sidebar h2,
    .navbar-light .navbar-nav .nav-link:hover,
    .main-navigation .dropdown-item:hover,
    .navbar-light .navbar-nav .active .nav-link,
    blockquote p,
    a.moretag,
    .sticky a.moretag:hover {
        color: <?php echo $color_scheme_2;
        ?>;
    }

    button:hover,
    input[type="button"]:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover,
    a.moretag:hover,
    .sticky {
        background-color: <?php echo $color_scheme_2;
        ?>;
    }

    a {
        color: <?php echo $link_color;
        ?>;
    }

    a:hover,
    a:active,
    a:visited {
        color: <?php echo $hover_link_color;
        ?>;
    }

    body {
        color: <?php echo $text_color;
        ?>;
    }

</style>

<?php
}
add_action( 'wp_head', 'celestine_customize_colors' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function celestine_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function celestine_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function celestine_customize_preview_js() {
	wp_enqueue_script( 'celestine-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'celestine_customize_preview_js' );
