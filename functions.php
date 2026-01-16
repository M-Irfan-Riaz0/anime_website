<?php
/**
 * Anime Starter Theme Functions
 * 
 * WHAT THIS FILE DOES:
 * - Registers Custom Post Types (Series, Episodes)
 * - Registers Taxonomies (Genre, Year, Status)
 * - Sets up theme support (images, menus, etc.)
 * - Enqueues scripts and styles
 * - Performance optimizations
 * - Helper functions for templates
 * 
 * @package AnimeStarter
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// =============================================================================
// THEME CONSTANTS
// =============================================================================
define('ANIME_THEME_VERSION', '1.0.0');
define('ANIME_THEME_DIR', get_template_directory());
define('ANIME_THEME_URI', get_template_directory_uri());

// =============================================================================
// THEME SETUP - Runs after theme is loaded
// =============================================================================
function anime_theme_setup() {
    
    // Enable Featured Images (Thumbnails)
    add_theme_support('post-thumbnails');
    
    // Custom Image Sizes for Performance
    add_image_size('poster-small', 150, 225, true);   // Card thumbnails
    add_image_size('poster-medium', 250, 375, true);  // Single page poster
    add_image_size('poster-large', 400, 600, true);   // Archive headers
    add_image_size('episode-thumb', 320, 180, true);  // Episode thumbnails (16:9)
    
    // Register Navigation Menus
    register_nav_menus(array(
        'primary'   => __('Primary Menu', 'anime-starter'),
        'footer'    => __('Footer Menu', 'anime-starter'),
    ));
    
    // HTML5 Support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ));
    
    // Title Tag Support
    add_theme_support('title-tag');
    
    // Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Editor Styles (optional)
    add_theme_support('editor-styles');
    
    // Responsive Embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'anime_theme_setup');

// =============================================================================
// REGISTER CUSTOM POST TYPES
// =============================================================================
function anime_register_post_types() {
    
    // -------------------------------------------------------------------------
    // SERIES CPT - Main content type for anime/shows
    // -------------------------------------------------------------------------
    $series_labels = array(
        'name'                  => __('Series', 'anime-starter'),
        'singular_name'         => __('Series', 'anime-starter'),
        'menu_name'             => __('Series', 'anime-starter'),
        'add_new'               => __('Add New Series', 'anime-starter'),
        'add_new_item'          => __('Add New Series', 'anime-starter'),
        'edit_item'             => __('Edit Series', 'anime-starter'),
        'new_item'              => __('New Series', 'anime-starter'),
        'view_item'             => __('View Series', 'anime-starter'),
        'search_items'          => __('Search Series', 'anime-starter'),
        'not_found'             => __('No series found', 'anime-starter'),
        'not_found_in_trash'    => __('No series in trash', 'anime-starter'),
        'all_items'             => __('All Series', 'anime-starter'),
    );
    
    $series_args = array(
        'labels'              => $series_labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,  // Enable Gutenberg (optional)
        'query_var'           => true,
        'rewrite'             => array('slug' => 'series', 'with_front' => false),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-video-alt3',
        'supports'            => array(
            'title',
            'editor',           // Description
            'thumbnail',        // Featured Image (Poster)
            'excerpt',          // Short description
            'custom-fields',    // For manual meta
        ),
    );
    
    register_post_type('series', $series_args);
    
    // -------------------------------------------------------------------------
    // EPISODE CPT - Individual episodes linked to series
    // -------------------------------------------------------------------------
    $episode_labels = array(
        'name'                  => __('Episodes', 'anime-starter'),
        'singular_name'         => __('Episode', 'anime-starter'),
        'menu_name'             => __('Episodes', 'anime-starter'),
        'add_new'               => __('Add New Episode', 'anime-starter'),
        'add_new_item'          => __('Add New Episode', 'anime-starter'),
        'edit_item'             => __('Edit Episode', 'anime-starter'),
        'new_item'              => __('New Episode', 'anime-starter'),
        'view_item'             => __('View Episode', 'anime-starter'),
        'search_items'          => __('Search Episodes', 'anime-starter'),
        'not_found'             => __('No episodes found', 'anime-starter'),
        'not_found_in_trash'    => __('No episodes in trash', 'anime-starter'),
        'all_items'             => __('All Episodes', 'anime-starter'),
    );
    
    $episode_args = array(
        'labels'              => $episode_labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'episode', 'with_front' => false),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-playlist-video',
        'supports'            => array(
            'title',
            'thumbnail',
            'custom-fields',
        ),
    );
    
    register_post_type('episode', $episode_args);
}
add_action('init', 'anime_register_post_types');

// =============================================================================
// REGISTER TAXONOMIES
// =============================================================================
function anime_register_taxonomies() {
    
    // -------------------------------------------------------------------------
    // GENRE Taxonomy
    // -------------------------------------------------------------------------
    $genre_labels = array(
        'name'              => __('Genres', 'anime-starter'),
        'singular_name'     => __('Genre', 'anime-starter'),
        'search_items'      => __('Search Genres', 'anime-starter'),
        'all_items'         => __('All Genres', 'anime-starter'),
        'edit_item'         => __('Edit Genre', 'anime-starter'),
        'update_item'       => __('Update Genre', 'anime-starter'),
        'add_new_item'      => __('Add New Genre', 'anime-starter'),
        'new_item_name'     => __('New Genre Name', 'anime-starter'),
        'menu_name'         => __('Genres', 'anime-starter'),
    );
    
    register_taxonomy('genre', array('series'), array(
        'labels'            => $genre_labels,
        'hierarchical'      => true,  // Like categories
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'genre', 'with_front' => false),
    ));
    
    // -------------------------------------------------------------------------
    // YEAR Taxonomy
    // -------------------------------------------------------------------------
    $year_labels = array(
        'name'              => __('Years', 'anime-starter'),
        'singular_name'     => __('Year', 'anime-starter'),
        'search_items'      => __('Search Years', 'anime-starter'),
        'all_items'         => __('All Years', 'anime-starter'),
        'edit_item'         => __('Edit Year', 'anime-starter'),
        'update_item'       => __('Update Year', 'anime-starter'),
        'add_new_item'      => __('Add New Year', 'anime-starter'),
        'new_item_name'     => __('New Year Name', 'anime-starter'),
        'menu_name'         => __('Years', 'anime-starter'),
    );
    
    register_taxonomy('year', array('series'), array(
        'labels'            => $year_labels,
        'hierarchical'      => false,  // Like tags
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'year', 'with_front' => false),
    ));
    
    // -------------------------------------------------------------------------
    // STATUS Taxonomy (Ongoing / Completed)
    // -------------------------------------------------------------------------
    $status_labels = array(
        'name'              => __('Status', 'anime-starter'),
        'singular_name'     => __('Status', 'anime-starter'),
        'search_items'      => __('Search Status', 'anime-starter'),
        'all_items'         => __('All Status', 'anime-starter'),
        'edit_item'         => __('Edit Status', 'anime-starter'),
        'update_item'       => __('Update Status', 'anime-starter'),
        'add_new_item'      => __('Add New Status', 'anime-starter'),
        'new_item_name'     => __('New Status Name', 'anime-starter'),
        'menu_name'         => __('Status', 'anime-starter'),
    );
    
    register_taxonomy('status', array('series'), array(
        'labels'            => $status_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'status', 'with_front' => false),
    ));
}
add_action('init', 'anime_register_taxonomies');

// =============================================================================
// REGISTER META BOXES FOR CUSTOM FIELDS (Native WordPress - No ACF needed)
// =============================================================================
function anime_register_meta_boxes() {
    
    // Episode Meta Box
    add_meta_box(
        'episode_details',
        __('Episode Details', 'anime-starter'),
        'anime_episode_meta_box_callback',
        'episode',
        'normal',
        'high'
    );
    
    // Series Meta Box
    add_meta_box(
        'series_details',
        __('Series Details', 'anime-starter'),
        'anime_series_meta_box_callback',
        'series',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'anime_register_meta_boxes');

// Episode Meta Box HTML
function anime_episode_meta_box_callback($post) {
    wp_nonce_field('anime_episode_meta', 'anime_episode_nonce');
    
    // Get saved values
    $episode_number = get_post_meta($post->ID, '_episode_number', true);
    $series_id = get_post_meta($post->ID, '_series_id', true);
    $subtitle_type = get_post_meta($post->ID, '_subtitle_type', true);
    $air_date = get_post_meta($post->ID, '_air_date', true);
    
    // Streaming links (stored as array)
    $streaming_links = get_post_meta($post->ID, '_streaming_links', true);
    if (!is_array($streaming_links)) {
        $streaming_links = array();
    }
    
    // Get all series for dropdown
    $all_series = get_posts(array(
        'post_type'      => 'series',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));
    ?>
    <style>
        .anime-meta-field { margin-bottom: 15px; }
        .anime-meta-field label { display: block; font-weight: 600; margin-bottom: 5px; }
        .anime-meta-field input, .anime-meta-field select, .anime-meta-field textarea { width: 100%; }
        .streaming-links-wrapper { border: 1px solid #ddd; padding: 15px; background: #f9f9f9; }
        .streaming-link-item { display: flex; gap: 10px; margin-bottom: 10px; align-items: center; }
        .streaming-link-item input { flex: 1; }
        .remove-link { background: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer; }
        .add-link { background: #28a745; color: white; border: none; padding: 8px 15px; cursor: pointer; margin-top: 10px; }
    </style>
    
    <div class="anime-meta-field">
        <label for="series_id"><?php _e('Parent Series', 'anime-starter'); ?> *</label>
        <select name="series_id" id="series_id" required>
            <option value=""><?php _e('Select Series', 'anime-starter'); ?></option>
            <?php foreach ($all_series as $s) : ?>
                <option value="<?php echo $s->ID; ?>" <?php selected($series_id, $s->ID); ?>>
                    <?php echo esc_html($s->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="anime-meta-field">
        <label for="episode_number"><?php _e('Episode Number', 'anime-starter'); ?> *</label>
        <input type="number" name="episode_number" id="episode_number" 
               value="<?php echo esc_attr($episode_number); ?>" min="0" required>
    </div>
    
    <div class="anime-meta-field">
        <label for="subtitle_type"><?php _e('Subtitle Type', 'anime-starter'); ?></label>
        <select name="subtitle_type" id="subtitle_type">
            <option value="sub" <?php selected($subtitle_type, 'sub'); ?>>Subbed</option>
            <option value="dub" <?php selected($subtitle_type, 'dub'); ?>>Dubbed</option>
            <option value="raw" <?php selected($subtitle_type, 'raw'); ?>>Raw</option>
        </select>
    </div>
    
    <div class="anime-meta-field">
        <label for="air_date"><?php _e('Air Date', 'anime-starter'); ?></label>
        <input type="date" name="air_date" id="air_date" value="<?php echo esc_attr($air_date); ?>">
    </div>
    
    <div class="anime-meta-field">
        <label><?php _e('Streaming Links (iframe URLs)', 'anime-starter'); ?></label>
        <p class="description"><?php _e('Add embed/iframe URLs. First link will be default.', 'anime-starter'); ?></p>
        
        <div class="streaming-links-wrapper">
            <div id="streaming-links-container">
                <?php 
                if (!empty($streaming_links)) :
                    foreach ($streaming_links as $index => $link) :
                ?>
                    <div class="streaming-link-item">
                        <input type="text" name="link_name[]" placeholder="Server Name (e.g., Server 1)" 
                               value="<?php echo esc_attr($link['name'] ?? ''); ?>">
                        <input type="url" name="link_url[]" placeholder="https://embed.example.com/video" 
                               value="<?php echo esc_url($link['url'] ?? ''); ?>">
                        <button type="button" class="remove-link">&times;</button>
                    </div>
                <?php 
                    endforeach;
                else :
                ?>
                    <div class="streaming-link-item">
                        <input type="text" name="link_name[]" placeholder="Server Name (e.g., Server 1)">
                        <input type="url" name="link_url[]" placeholder="https://embed.example.com/video">
                        <button type="button" class="remove-link">&times;</button>
                    </div>
                <?php endif; ?>
            </div>
            <button type="button" class="add-link" id="add-streaming-link">+ Add Server</button>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('streaming-links-container');
        const addBtn = document.getElementById('add-streaming-link');
        
        addBtn.addEventListener('click', function() {
            const item = document.createElement('div');
            item.className = 'streaming-link-item';
            item.innerHTML = `
                <input type="text" name="link_name[]" placeholder="Server Name">
                <input type="url" name="link_url[]" placeholder="https://embed.example.com/video">
                <button type="button" class="remove-link">&times;</button>
            `;
            container.appendChild(item);
        });
        
        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-link')) {
                e.target.parentElement.remove();
            }
        });
    });
    </script>
    <?php
}

// Series Meta Box HTML
function anime_series_meta_box_callback($post) {
    wp_nonce_field('anime_series_meta', 'anime_series_nonce');
    
    $total_episodes = get_post_meta($post->ID, '_total_episodes', true);
    $alt_titles = get_post_meta($post->ID, '_alt_titles', true);
    ?>
    <div class="anime-meta-field">
        <label for="total_episodes"><?php _e('Total Episodes', 'anime-starter'); ?></label>
        <input type="number" name="total_episodes" id="total_episodes" 
               value="<?php echo esc_attr($total_episodes); ?>" min="0">
        <p class="description"><?php _e('Leave empty if ongoing', 'anime-starter'); ?></p>
    </div>
    
    <div class="anime-meta-field">
        <label for="alt_titles"><?php _e('Alternative Titles', 'anime-starter'); ?></label>
        <textarea name="alt_titles" id="alt_titles" rows="3"><?php echo esc_textarea($alt_titles); ?></textarea>
        <p class="description"><?php _e('One per line', 'anime-starter'); ?></p>
    </div>
    <?php
}

// Save Meta Box Data
function anime_save_meta_boxes($post_id) {
    
    // Episode Meta
    if (isset($_POST['anime_episode_nonce']) && 
        wp_verify_nonce($_POST['anime_episode_nonce'], 'anime_episode_meta')) {
        
        if (isset($_POST['episode_number'])) {
            update_post_meta($post_id, '_episode_number', intval($_POST['episode_number']));
        }
        
        if (isset($_POST['series_id'])) {
            update_post_meta($post_id, '_series_id', intval($_POST['series_id']));
        }
        
        if (isset($_POST['subtitle_type'])) {
            update_post_meta($post_id, '_subtitle_type', sanitize_text_field($_POST['subtitle_type']));
        }
        
        if (isset($_POST['air_date'])) {
            update_post_meta($post_id, '_air_date', sanitize_text_field($_POST['air_date']));
        }
        
        // Save streaming links
        if (isset($_POST['link_name']) && isset($_POST['link_url'])) {
            $links = array();
            $names = $_POST['link_name'];
            $urls = $_POST['link_url'];
            
            for ($i = 0; $i < count($urls); $i++) {
                if (!empty($urls[$i])) {
                    $links[] = array(
                        'name' => sanitize_text_field($names[$i] ?? 'Server ' . ($i + 1)),
                        'url'  => esc_url_raw($urls[$i]),
                    );
                }
            }
            
            update_post_meta($post_id, '_streaming_links', $links);
        }
    }
    
    // Series Meta
    if (isset($_POST['anime_series_nonce']) && 
        wp_verify_nonce($_POST['anime_series_nonce'], 'anime_series_meta')) {
        
        if (isset($_POST['total_episodes'])) {
            update_post_meta($post_id, '_total_episodes', intval($_POST['total_episodes']));
        }
        
        if (isset($_POST['alt_titles'])) {
            update_post_meta($post_id, '_alt_titles', sanitize_textarea_field($_POST['alt_titles']));
        }
    }
}
add_action('save_post', 'anime_save_meta_boxes');

// =============================================================================
// ENQUEUE SCRIPTS & STYLES
// =============================================================================
function anime_enqueue_assets() {
    
    // Main Stylesheet
    wp_enqueue_style(
        'anime-main-style',
        get_stylesheet_uri(),
        array(),
        ANIME_THEME_VERSION
    );
    
    // Main JavaScript (deferred for performance)
    wp_enqueue_script(
        'anime-main-script',
        ANIME_THEME_URI . '/assets/js/main.js',
        array(),
        ANIME_THEME_VERSION,
        true  // Load in footer
    );
    
    // Pass data to JavaScript
    wp_localize_script('anime-main-script', 'animeData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('anime_nonce'),
        'homeUrl' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'anime_enqueue_assets');

// =============================================================================
// PERFORMANCE OPTIMIZATIONS
// =============================================================================

// Disable WordPress Emoji Scripts
function anime_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', function($plugins) {
        return is_array($plugins) ? array_diff($plugins, array('wpemoji')) : array();
    });
}
add_action('init', 'anime_disable_emojis');

// Remove unnecessary WordPress header items
function anime_cleanup_head() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('after_setup_theme', 'anime_cleanup_head');

// Disable Gutenberg for CPTs (Optional - uncomment if needed)
// function anime_disable_gutenberg($current_status, $post_type) {
//     if (in_array($post_type, array('series', 'episode'))) {
//         return false;
//     }
//     return $current_status;
// }
// add_filter('use_block_editor_for_post_type', 'anime_disable_gutenberg', 10, 2);

// =============================================================================
// HELPER FUNCTIONS (Use these in templates)
// =============================================================================

/**
 * Get all episodes for a series
 */
function anime_get_series_episodes($series_id, $order = 'ASC') {
    return get_posts(array(
        'post_type'      => 'episode',
        'posts_per_page' => -1,
        'meta_key'       => '_episode_number',
        'orderby'        => 'meta_value_num',
        'order'          => $order,
        'meta_query'     => array(
            array(
                'key'     => '_series_id',
                'value'   => $series_id,
                'compare' => '=',
            ),
        ),
    ));
}

/**
 * Get series for an episode
 */
function anime_get_episode_series($episode_id) {
    $series_id = get_post_meta($episode_id, '_series_id', true);
    if ($series_id) {
        return get_post($series_id);
    }
    return null;
}

/**
 * Get streaming links for an episode
 */
function anime_get_streaming_links($episode_id) {
    $links = get_post_meta($episode_id, '_streaming_links', true);
    return is_array($links) ? $links : array();
}

/**
 * Get next episode
 */
function anime_get_next_episode($episode_id) {
    $series_id = get_post_meta($episode_id, '_series_id', true);
    $current_number = get_post_meta($episode_id, '_episode_number', true);
    
    $episodes = get_posts(array(
        'post_type'      => 'episode',
        'posts_per_page' => 1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'     => '_series_id',
                'value'   => $series_id,
                'compare' => '=',
            ),
            array(
                'key'     => '_episode_number',
                'value'   => $current_number,
                'compare' => '>',
                'type'    => 'NUMERIC',
            ),
        ),
        'meta_key'       => '_episode_number',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
    ));
    
    return !empty($episodes) ? $episodes[0] : null;
}

/**
 * Get previous episode
 */
function anime_get_prev_episode($episode_id) {
    $series_id = get_post_meta($episode_id, '_series_id', true);
    $current_number = get_post_meta($episode_id, '_episode_number', true);
    
    $episodes = get_posts(array(
        'post_type'      => 'episode',
        'posts_per_page' => 1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'     => '_series_id',
                'value'   => $series_id,
                'compare' => '=',
            ),
            array(
                'key'     => '_episode_number',
                'value'   => $current_number,
                'compare' => '<',
                'type'    => 'NUMERIC',
            ),
        ),
        'meta_key'       => '_episode_number',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
    ));
    
    return !empty($episodes) ? $episodes[0] : null;
}

/**
 * Generate Breadcrumbs
 */
function anime_breadcrumbs() {
    $separator = '<span class="breadcrumb-sep">›</span>';
    $home = '<a href="' . home_url('/') . '">' . __('Home', 'anime-starter') . '</a>';
    
    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo $home;
    
    if (is_singular('series')) {
        echo $separator . '<a href="' . get_post_type_archive_link('series') . '">' . __('Series', 'anime-starter') . '</a>';
        echo $separator . '<span>' . get_the_title() . '</span>';
    } elseif (is_singular('episode')) {
        $series = anime_get_episode_series(get_the_ID());
        echo $separator . '<a href="' . get_post_type_archive_link('series') . '">' . __('Series', 'anime-starter') . '</a>';
        if ($series) {
            echo $separator . '<a href="' . get_permalink($series) . '">' . $series->post_title . '</a>';
        }
        echo $separator . '<span>' . get_the_title() . '</span>';
    } elseif (is_post_type_archive('series')) {
        echo $separator . '<span>' . __('All Series', 'anime-starter') . '</span>';
    } elseif (is_tax('genre')) {
        echo $separator . '<a href="' . get_post_type_archive_link('series') . '">' . __('Series', 'anime-starter') . '</a>';
        echo $separator . '<span>' . single_term_title('', false) . '</span>';
    } elseif (is_search()) {
        echo $separator . '<span>' . __('Search Results', 'anime-starter') . '</span>';
    } elseif (is_404()) {
        echo $separator . '<span>' . __('Page Not Found', 'anime-starter') . '</span>';
    }
    
    echo '</nav>';
}

/**
 * Episode count for series
 */
function anime_get_episode_count($series_id) {
    $episodes = anime_get_series_episodes($series_id);
    return count($episodes);
}

/**
 * Get latest episodes (for homepage)
 */
function anime_get_latest_episodes($count = 12) {
    return get_posts(array(
        'post_type'      => 'episode',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
}

/**
 * Get popular series (by episode count or custom meta)
 */
function anime_get_popular_series($count = 10) {
    return get_posts(array(
        'post_type'      => 'series',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
}

// =============================================================================
// SEO HELPERS
// =============================================================================

/**
 * Generate SEO-friendly title for episode pages
 */
function anime_episode_seo_title($episode_id = null) {
    if (!$episode_id) {
        $episode_id = get_the_ID();
    }
    
    $series = anime_get_episode_series($episode_id);
    $episode_num = get_post_meta($episode_id, '_episode_number', true);
    $sub_type = get_post_meta($episode_id, '_subtitle_type', true);
    
    $sub_label = $sub_type === 'dub' ? 'English Dub' : 'English Sub';
    
    if ($series) {
        return sprintf(
            '%s Episode %s %s - Watch Online',
            $series->post_title,
            $episode_num,
            $sub_label
        );
    }
    
    return get_the_title($episode_id);
}

/**
 * Auto-generate meta description for episodes
 */
function anime_episode_meta_description($episode_id = null) {
    if (!$episode_id) {
        $episode_id = get_the_ID();
    }
    
    $series = anime_get_episode_series($episode_id);
    $episode_num = get_post_meta($episode_id, '_episode_number', true);
    $sub_type = get_post_meta($episode_id, '_subtitle_type', true);
    
    $sub_label = $sub_type === 'dub' ? 'English Dubbed' : 'English Subbed';
    
    if ($series) {
        return sprintf(
            'Watch %s Episode %s %s online for free. High quality streaming available on multiple servers.',
            $series->post_title,
            $episode_num,
            $sub_label
        );
    }
    
    return '';
}

// =============================================================================
// FLUSH REWRITE RULES ON THEME ACTIVATION
// =============================================================================
function anime_rewrite_flush() {
    anime_register_post_types();
    anime_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'anime_rewrite_flush');

// =============================================================================
// ADMIN COLUMNS - Better overview in admin
// =============================================================================
function anime_episode_admin_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['series'] = __('Series', 'anime-starter');
            $new_columns['episode_num'] = __('Episode #', 'anime-starter');
        }
    }
    return $new_columns;
}
add_filter('manage_episode_posts_columns', 'anime_episode_admin_columns');

function anime_episode_admin_column_content($column, $post_id) {
    if ($column === 'series') {
        $series = anime_get_episode_series($post_id);
        if ($series) {
            echo '<a href="' . get_edit_post_link($series->ID) . '">' . esc_html($series->post_title) . '</a>';
        } else {
            echo '—';
        }
    }
    
    if ($column === 'episode_num') {
        $num = get_post_meta($post_id, '_episode_number', true);
        echo $num ? intval($num) : '—';
    }
}
add_action('manage_episode_posts_custom_column', 'anime_episode_admin_column_content', 10, 2);

// Make episode number column sortable
function anime_episode_sortable_columns($columns) {
    $columns['episode_num'] = 'episode_num';
    return $columns;
}
add_filter('manage_edit-episode_sortable_columns', 'anime_episode_sortable_columns');

function anime_episode_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    if ($query->get('orderby') === 'episode_num') {
        $query->set('meta_key', '_episode_number');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'anime_episode_orderby');
// --------------------------------------
// -------------- font is fetch from that code------------------------

function mytheme_enqueue_styles() {
    // Load DM Sans from Google Fonts
    wp_enqueue_style( 'dm-sans-font', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap', array(), null );

    // Load your main theme stylesheet
    wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );
