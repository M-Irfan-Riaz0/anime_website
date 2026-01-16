<?php
/**
 * Search Results Template
 * 
 * WHAT THIS FILE DOES:
 * - Displays search results
 * - Shows search form for refinement
 * - Handles both series and episode results
 * 
 * URL PATTERN: /?s=searchterm
 * 
 * @package AnimeStarter
 */

get_header();
?>

<div class="container">
    
    <!-- Breadcrumbs -->
    <?php anime_breadcrumbs(); ?>
    
    <!-- Search Header -->
    <header class="search-header">
        
        <h1 class="search-results-title">
            <?php
            printf(
                esc_html__('Search Results for: "%s"', 'anime-starter'),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
        
        <p class="search-meta">
            <?php
            global $wp_query;
            printf(
                _n('%d result found', '%d results found', $wp_query->found_posts, 'anime-starter'),
                $wp_query->found_posts
            );
            ?>
        </p>
        
        <!-- Search Form for Refinement -->
        <form class="search-form-large" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <input type="search" 
                   name="s" 
                   value="<?php echo get_search_query(); ?>" 
                   placeholder="<?php esc_attr_e('Search anime...', 'anime-starter'); ?>"
                   required>
            <input type="hidden" name="post_type" value="series">
            <button type="submit"><?php esc_html_e('Search', 'anime-starter'); ?></button>
        </form>
        
    </header>
    
    <!-- Search Results -->
    <?php if (have_posts()) : ?>
        
        <div class="search-results">
            
            <div class="grid grid-5">
                <?php while (have_posts()) : the_post(); 
                    $post_type = get_post_type();
                    
                    if ($post_type === 'episode') {
                        $series = anime_get_episode_series(get_the_ID());
                        $episode_num = get_post_meta(get_the_ID(), '_episode_number', true);
                    }
                ?>
                    <article class="card <?php echo esc_attr($post_type); ?>-card">
                        <a href="<?php the_permalink(); ?>">
                            <div class="card-image">
                                <?php 
                                // For episodes, show series thumbnail
                                $thumb_id = ($post_type === 'episode' && $series) ? $series->ID : get_the_ID();
                                
                                if (has_post_thumbnail($thumb_id)) : 
                                    echo get_the_post_thumbnail($thumb_id, 'poster-small', array('loading' => 'lazy'));
                                else : 
                                ?>
                                    <div class="lazy-placeholder"></div>
                                <?php endif; ?>
                                
                                <span class="card-badge">
                                    <?php 
                                    if ($post_type === 'episode') {
                                        echo 'EP ' . esc_html($episode_num);
                                    } elseif ($post_type === 'series') {
                                        $status = get_the_terms(get_the_ID(), 'status');
                                        if (!empty($status) && !is_wp_error($status)) {
                                            echo esc_html($status[0]->name);
                                        } else {
                                            echo 'Series';
                                        }
                                    } else {
                                        echo ucfirst($post_type);
                                    }
                                    ?>
                                </span>
                            </div>
                            
                            <div class="card-content">
                                <h2 class="card-title">
                                    <?php 
                                    if ($post_type === 'episode' && $series) {
                                        echo esc_html($series->post_title) . ' - EP ' . esc_html($episode_num);
                                    } else {
                                        the_title();
                                    }
                                    ?>
                                </h2>
                                <div class="card-meta">
                                    <span><?php echo esc_html(ucfirst($post_type)); ?></span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            
        </div>
        
        <!-- Pagination -->
        <nav class="pagination">
            <?php
            echo paginate_links(array(
                'prev_text' => '← ' . __('Previous', 'anime-starter'),
                'next_text' => __('Next', 'anime-starter') . ' →',
            ));
            ?>
        </nav>
        
    <?php else : ?>
        
        <div class="no-results">
            <div class="no-results-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    <line x1="8" y1="11" x2="14" y2="11"></line>
                </svg>
            </div>
            
            <h2><?php esc_html_e('No Results Found', 'anime-starter'); ?></h2>
            
            <p><?php esc_html_e('Sorry, we couldn\'t find any anime matching your search.', 'anime-starter'); ?></p>
            
            <div class="search-suggestions">
                <h3><?php esc_html_e('Suggestions:', 'anime-starter'); ?></h3>
                <ul>
                    <li><?php esc_html_e('Check your spelling', 'anime-starter'); ?></li>
                    <li><?php esc_html_e('Try different keywords', 'anime-starter'); ?></li>
                    <li><?php esc_html_e('Try more general terms', 'anime-starter'); ?></li>
                </ul>
            </div>
            
            <a href="<?php echo esc_url(get_post_type_archive_link('series')); ?>" class="btn-secondary">
                <?php esc_html_e('Browse All Series', 'anime-starter'); ?>
            </a>
        </div>
        
    <?php endif; ?>
    
    <!-- Popular Searches / Trending -->
    <section class="trending-section mt-2">
        <h2 class="section-title"><?php esc_html_e('Popular Series', 'anime-starter'); ?></h2>
        
        <div class="grid grid-5">
            <?php
            $popular = get_posts(array(
                'post_type'      => 'series',
                'posts_per_page' => 5,
                'orderby'        => 'rand',  // Random for now, replace with view count later
            ));
            
            foreach ($popular as $s) :
            ?>
                <article class="card series-card">
                    <a href="<?php echo get_permalink($s->ID); ?>">
                        <div class="card-image">
                            <?php if (has_post_thumbnail($s->ID)) : ?>
                                <?php echo get_the_post_thumbnail($s->ID, 'poster-small', array('loading' => 'lazy')); ?>
                            <?php else : ?>
                                <div class="lazy-placeholder"></div>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title"><?php echo esc_html($s->post_title); ?></h3>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    
</div>

<style>
.search-header {
    text-align: center;
    margin-bottom: var(--spacing-2xl);
    padding-bottom: var(--spacing-xl);
    border-bottom: 1px solid var(--color-border);
}

.search-results-title span {
    color: var(--color-accent);
}

.search-meta {
    color: var(--color-text-muted);
    margin-bottom: var(--spacing-lg);
}

.no-results {
    text-align: center;
    padding: var(--spacing-2xl);
    background: var(--color-bg-card);
    border-radius: var(--border-radius);
}

.no-results-icon {
    color: var(--color-text-muted);
    margin-bottom: var(--spacing-lg);
}

.no-results h2 {
    margin-bottom: var(--spacing-md);
}

.search-suggestions {
    text-align: left;
    max-width: 300px;
    margin: var(--spacing-xl) auto;
    padding: var(--spacing-lg);
    background: var(--color-secondary);
    border-radius: var(--border-radius);
}

.search-suggestions h3 {
    font-size: var(--font-size-sm);
    color: var(--color-text-muted);
    margin-bottom: var(--spacing-sm);
}

.search-suggestions ul {
    list-style: disc;
    padding-left: var(--spacing-lg);
    color: var(--color-text-muted);
}

.search-suggestions li {
    margin-bottom: var(--spacing-xs);
}
</style>

<?php get_footer(); ?>
