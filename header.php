
<?php
/**
 * Header Template
 * 
 * WHAT THIS FILE DOES:
 * - Opens HTML document
 * - Contains <head> section with meta tags, CSS
 * - Site header with logo, navigation, search
 * - Mobile menu toggle
 * 
 * @package AnimeStarter
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php // SEO Meta - Override for specific pages ?>
    <?php if (is_singular('episode')) : ?>
        <title><?php echo esc_html(anime_episode_seo_title()); ?></title>
        <meta name="description" content="<?php echo esc_attr(anime_episode_meta_description()); ?>">
    <?php endif; ?>
    
    <?php // Preconnect to external resources (add your CDNs here) ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <?php // WordPress head - loads styles, scripts, etc ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    
    <a class="skip-link sr-only" href="#main-content">
        <?php esc_html_e('Skip to content', 'anime-starter'); ?>
    </a>
    
    <!-- ==================== SITE HEADER ==================== -->
    <header class="site-header" role="banner">
        <div class="container">
            <div class="header-inner">
                
                <!-- Logo / Site Title -->
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <button class="menu-toggle" id="menu-toggle" 
                        aria-controls="primary-navigation" 
                        aria-expanded="false"
                        aria-label="<?php esc_attr_e('Toggle Menu', 'anime-starter'); ?>">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <!-- Primary Navigation -->
                <nav class="main-nav" id="primary-navigation" role="navigation" 
                     aria-label="<?php esc_attr_e('Primary Menu', 'anime-starter'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'depth'          => 2,
                        'fallback_cb'    => 'anime_fallback_menu',
                    ));
                    ?>
                </nav>
                
                <!-- Header Search -->
                <div class="header-search">
                    <button class="search-toggle" id="search-toggle" 
                            aria-label="<?php esc_attr_e('Toggle Search', 'anime-starter'); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                    
                    <form class="search-form" id="header-search-form" role="search" 
                          action="<?php echo esc_url(home_url('/')); ?>" method="get">
                        <label class="sr-only" for="header-search-input">
                            <?php esc_html_e('Search', 'anime-starter'); ?>
                        </label>
                        <input type="search" 
                               id="header-search-input" 
                               name="s" 
                               placeholder="<?php esc_attr_e('Search anime...', 'anime-starter'); ?>"
                               value="<?php echo get_search_query(); ?>">
                        <input type="hidden" name="post_type" value="series">
                    </form>
                </div>
                
            </div>
        </div>
    </header>
    
    <!-- Main Content Wrapper -->
    <main id="main-content" class="site-content" role="main">

<?php
/**
 * Fallback menu if no menu is assigned
 */
function anime_fallback_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'anime-starter') . '</a></li>';
    echo '<li><a href="' . esc_url(get_post_type_archive_link('series')) . '">' . esc_html__('Series', 'anime-starter') . '</a></li>';
    
    // Get genres
    $genres = get_terms(array('taxonomy' => 'genre', 'hide_empty' => true, 'number' => 5));
    if (!empty($genres) && !is_wp_error($genres)) {
        echo '<li><a href="#">' . esc_html__('Genres', 'anime-starter') . '</a><ul class="sub-menu">';
        foreach ($genres as $genre) {
            echo '<li><a href="' . esc_url(get_term_link($genre)) . '">' . esc_html($genre->name) . '</a></li>';
        }
        echo '</ul></li>';
    }
    
    echo '</ul>';
}
?>
