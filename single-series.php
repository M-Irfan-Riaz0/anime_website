<?php
/**
 * Single Series Template
 * 
 * WHAT THIS FILE DOES:
 * - Displays individual series page
 * - Shows poster, title, description, genres, status
 * - Lists all episodes for this series
 * - Generates proper SEO structure
 * 
 * URL PATTERN: /series/series-slug/
 * 
 * @package AnimeStarter
 */

get_header();

// Start the loop
while (have_posts()) : the_post();
    
    // Get series meta
    $genres = get_the_terms(get_the_ID(), 'genre');
    $years = get_the_terms(get_the_ID(), 'year');
    $status = get_the_terms(get_the_ID(), 'status');
    $total_episodes = get_post_meta(get_the_ID(), '_total_episodes', true);
    $alt_titles = get_post_meta(get_the_ID(), '_alt_titles', true);
    
    // Get all episodes
    $episodes = anime_get_series_episodes(get_the_ID(), 'ASC');
?>

<div class="container">
    
    <!-- Breadcrumbs for SEO -->
    <?php anime_breadcrumbs(); ?>
    
    <!-- ==================== SERIES HERO SECTION ==================== -->
    <article class="series-single" itemscope itemtype="https://schema.org/TVSeries">
        
        <header class="series-hero">
            
            <!-- Poster Image -->
            <div class="series-poster">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('poster-medium', array(
                        'itemprop' => 'image',
                        'alt'      => esc_attr(get_the_title()),
                    )); ?>
                <?php else : ?>
                    <div class="lazy-placeholder" style="aspect-ratio: 2/3;"></div>
                <?php endif; ?>
            </div>
            
            <!-- Series Info -->
            <div class="series-info">
                
                <h1 class="series-title" itemprop="name"><?php the_title(); ?></h1>
                
                <!-- Alternative Titles -->
                <?php if (!empty($alt_titles)) : ?>
                    <p class="series-alt-titles text-muted">
                        <?php echo esc_html($alt_titles); ?>
                    </p>
                <?php endif; ?>
                
                <!-- Meta Info -->
                <div class="series-meta">
                    
                    <?php if (!empty($years) && !is_wp_error($years)) : ?>
                        <span class="series-meta-item" itemprop="datePublished">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <?php echo esc_html($years[0]->name); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if (!empty($status) && !is_wp_error($status)) : ?>
                        <span class="series-meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12,6 12,12 16,14"></polyline>
                            </svg>
                            <?php echo esc_html($status[0]->name); ?>
                        </span>
                    <?php endif; ?>
                    
                    <span class="series-meta-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="23,7 16,12 23,17 23,7"></polygon>
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                        </svg>
                        <?php 
                        $ep_count = count($episodes);
                        if ($total_episodes) {
                            printf(__('%d / %d Episodes', 'anime-starter'), $ep_count, intval($total_episodes));
                        } else {
                            printf(_n('%d Episode', '%d Episodes', $ep_count, 'anime-starter'), $ep_count);
                        }
                        ?>
                    </span>
                    
                </div>
                
                <!-- Genres -->
                <?php if (!empty($genres) && !is_wp_error($genres)) : ?>
                    <div class="series-genres">
                        <?php foreach ($genres as $genre) : ?>
                            <a href="<?php echo esc_url(get_term_link($genre)); ?>" 
                               class="genre-tag"
                               itemprop="genre">
                                <?php echo esc_html($genre->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Description -->
                <div class="series-description" itemprop="description">
                    <?php the_content(); ?>
                </div>
                
                <!-- Quick Action - Watch First Episode -->
                <?php if (!empty($episodes)) : ?>
                    <a href="<?php echo get_permalink($episodes[0]->ID); ?>" class="btn-primary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5,3 19,12 5,21 5,3"></polygon>
                        </svg>
                        <?php esc_html_e('Watch Now', 'anime-starter'); ?>
                    </a>
                <?php endif; ?>
                
            </div>
            
        </header>
        
        <!-- ==================== EPISODES LIST ==================== -->
        <section class="episodes-section" aria-labelledby="episodes-list-title">
            
            <h2 id="episodes-list-title" class="section-title">
                <?php esc_html_e('Episodes', 'anime-starter'); ?>
            </h2>
            
            <?php if (!empty($episodes)) : ?>
                <div class="episodes-grid">
                    <?php foreach ($episodes as $episode) : 
                        $ep_num = get_post_meta($episode->ID, '_episode_number', true);
                        $sub_type = get_post_meta($episode->ID, '_subtitle_type', true);
                    ?>
                        <a href="<?php echo get_permalink($episode->ID); ?>" 
                           class="episode-btn"
                           title="<?php echo esc_attr(sprintf(__('Watch Episode %d', 'anime-starter'), $ep_num)); ?>">
                            <span class="ep-num">EP <?php echo esc_html($ep_num); ?></span>
                            <?php if ($sub_type === 'dub') : ?>
                                <span class="ep-sub-type">DUB</span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="no-episodes">
                    <?php esc_html_e('No episodes available yet. Check back soon!', 'anime-starter'); ?>
                </p>
            <?php endif; ?>
            
        </section>
        
    </article>
    
    <!-- ==================== RELATED SERIES ==================== -->
    <?php if (!empty($genres) && !is_wp_error($genres)) : 
        // Get genre IDs
        $genre_ids = wp_list_pluck($genres, 'term_id');
        
        // Query related series
        $related = get_posts(array(
            'post_type'      => 'series',
            'posts_per_page' => 6,
            'post__not_in'   => array(get_the_ID()),
            'tax_query'      => array(
                array(
                    'taxonomy' => 'genre',
                    'field'    => 'term_id',
                    'terms'    => $genre_ids,
                ),
            ),
        ));
        
        if (!empty($related)) :
    ?>
        <section class="related-series mt-2" aria-labelledby="related-title">
            <h2 id="related-title" class="section-title">
                <?php esc_html_e('You May Also Like', 'anime-starter'); ?>
            </h2>
            
            <div class="grid grid-5">
                <?php foreach ($related as $r) : ?>
                    <article class="card series-card">
                        <a href="<?php echo get_permalink($r->ID); ?>">
                            <div class="card-image">
                                <?php if (has_post_thumbnail($r->ID)) : ?>
                                    <?php echo get_the_post_thumbnail($r->ID, 'poster-small', array('loading' => 'lazy')); ?>
                                <?php else : ?>
                                    <div class="lazy-placeholder"></div>
                                <?php endif; ?>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title"><?php echo esc_html($r->post_title); ?></h3>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php 
        endif;
    endif; 
    ?>
    
</div>

<style>
/* Single Series Page Specific Styles */
.series-alt-titles {
    font-size: var(--font-size-sm);
    font-style: italic;
    margin-bottom: var(--spacing-md);
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    background: var(--color-accent);
    color: white;
    padding: var(--spacing-md) var(--spacing-xl);
    border-radius: var(--border-radius);
    font-weight: 600;
    margin-top: var(--spacing-lg);
    transition: background var(--transition-fast);
}

.btn-primary:hover {
    background: #d63850;
    color: white;
}

.episode-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-xs);
}

.ep-sub-type {
    font-size: 0.7em;
    background: var(--color-accent);
    padding: 2px 4px;
    border-radius: 3px;
}

.no-episodes {
    text-align: center;
    padding: var(--spacing-xl);
    color: var(--color-text-muted);
}
</style>

<?php 
endwhile;
get_footer(); 
?>
