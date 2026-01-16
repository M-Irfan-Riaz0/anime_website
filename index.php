<?php
/**
 * Main Index Template (Homepage / Fallback)
 * 
 * WHAT THIS FILE DOES:
 * - This is the ultimate fallback template
 * - WordPress uses this if no other template matches
 * - We use it as homepage showing latest episodes + series
 * 
 * TEMPLATE HIERARCHY:
 * WordPress looks for templates in this order:
 * 1. front-page.php (if set as static front page)
 * 2. home.php (if set as blog page)
 * 3. index.php (always falls back to this)
 * 
 * @package AnimeStarter
 */

get_header();
?>

<div class="container">
     <!-- ==================== POPULAR SERIES SECTION ==================== -->
    <section class="popular-series-section mt-2" aria-labelledby="popular-series-title">
        
        <header class="section-header">
            <h2 id="popular-series-title" class="section-title">
                <?php esc_html_e('Popular Series', 'anime-starter'); ?>
            </h2>
            <a href="<?php echo esc_url(get_post_type_archive_link('series')); ?>" class="view-all-link">
                <?php esc_html_e('View All', 'anime-starter'); ?> →
            </a>
        </header>
        
        <?php
        // Get popular series
        $popular_series = anime_get_popular_series(10);
        
        if (!empty($popular_series)) :
        ?>
            <div class="grid grid-5">
                <?php foreach ($popular_series as $s) : 
                    $genres = get_the_terms($s->ID, 'genre');
                    $status = get_the_terms($s->ID, 'status');
                    $episode_count = anime_get_episode_count($s->ID);
                ?>
                    <article class="card series-card">
                        <a href="<?php echo get_permalink($s->ID); ?>" class="card-link">
                            <div class="card-image">
                                <?php if (has_post_thumbnail($s->ID)) : ?>
                                    <?php echo get_the_post_thumbnail(
                                        $s->ID, 
                                        'poster-small',
                                        array('loading' => 'lazy', 'alt' => esc_attr($s->post_title))
                                    ); ?>
                                <?php else : ?>
                                    <div class="lazy-placeholder"></div>
                                <?php endif; ?>
                                
                                <?php if (!empty($status) && !is_wp_error($status)) : ?>
                                    <span class="card-badge">
                                        <?php echo esc_html($status[0]->name); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-content">
                                <h3 class="card-title"><?php echo esc_html($s->post_title); ?></h3>
                                <div class="card-meta">
                                    <?php if ($episode_count > 0) : ?>
                                        <span><?php echo esc_html($episode_count); ?> EP</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="no-content"><?php esc_html_e('No series found. Start adding some!', 'anime-starter'); ?></p>
        <?php endif; ?>
        
    </section>
    
    <!-- ==================== LATEST EPISODES SECTION ==================== -->
    <section class="latest-episodes-section" aria-labelledby="latest-episodes-title">
        
        <header class="section-header">
            <h1 id="latest-episodes-title" class="section-title">
                <?php esc_html_e('Latest Episodes', 'anime-starter'); ?>
            </h1>
            <a href="<?php echo esc_url(get_post_type_archive_link('episode')); ?>" class="view-all-link">
                <?php esc_html_e('View All', 'anime-starter'); ?> →
            </a>
        </header>
        
    <?php
    // Get latest 12 episodes
    $latest_episodes = anime_get_latest_episodes(12);
    
    if (!empty($latest_episodes)) :
    ?>
        <div class="grid grid-4">
            <?php foreach ($latest_episodes as $episode) : 
                $series = anime_get_episode_series($episode->ID);
                $episode_num = get_post_meta($episode->ID, '_episode_number', true);
                $sub_type = get_post_meta($episode->ID, '_subtitle_type', true);
                
                // Determine which thumbnail to use (Episode first, then Series fallback)
                $thumbnail_id = 0;
                if (has_post_thumbnail($episode->ID)) {
                    // Episode has its own thumbnail
                    $thumbnail_id = $episode->ID;
                } elseif ($series && has_post_thumbnail($series->ID)) {
                    // Fallback to series thumbnail
                    $thumbnail_id = $series->ID;
                }
            ?>
                <article class="card episode-card">
                    <a href="<?php echo get_permalink($episode->ID); ?>" class="card-link">
                        <div class="card-image">
                            <?php if ($thumbnail_id) : ?>
                                <?php echo get_the_post_thumbnail(
                                    $thumbnail_id, 
                                    'episode-thumb',
                                    array('loading' => 'lazy', 'alt' => esc_attr($episode->post_title))
                                ); ?>
                            <?php else : ?>
                                <div class="lazy-placeholder"></div>
                            <?php endif; ?>
                            
                            <span class="card-badge">
                                <?php echo $sub_type === 'dub' ? 'DUB' : 'SUB'; ?>
                            </span>
                            
                            <span class="episode-number">EP <?php echo esc_html($episode_num); ?></span>
                        </div>
                        
                        <div class="card-content">
                            <h2 class="card-title">
                                <?php echo esc_html($series ? $series->post_title : $episode->post_title); ?>
                            </h2>
                            <div class="card-meta">
                                <span>Episode <?php echo esc_html($episode_num); ?></span>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="no-content"><?php esc_html_e('No episodes found. Start adding some!', 'anime-starter'); ?></p>
    <?php endif; ?>
        
    </section>
    
   
    <!-- ==================== GENRES SECTION ==================== -->
    <section class="genres-section mt-2" aria-labelledby="browse-genres-title">
        
        <header class="section-header">
            <h2 id="browse-genres-title" class="section-title">
                <?php esc_html_e('Browse by Genre', 'anime-starter'); ?>
            </h2>
        </header>
        
        <?php
        $genres = get_terms(array(
            'taxonomy'   => 'genre',
            'hide_empty' => true,
            'number'     => 12,
        ));
        
        if (!empty($genres) && !is_wp_error($genres)) :
        ?>
            <div class="genres-grid">
                <?php foreach ($genres as $genre) : ?>
                    <a href="<?php echo esc_url(get_term_link($genre)); ?>" class="genre-tag">
                        <?php echo esc_html($genre->name); ?>
                        <span class="genre-count">(<?php echo esc_html($genre->count); ?>)</span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
    </section>
    
</div>

<style>
/* Additional styles specific to homepage */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid var(--color-border);
}

.view-all-link {
    color: var(--color-accent);
    font-size: var(--font-size-sm);
    font-weight: 500;
}

.genres-grid {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-sm);
}

.genres-grid .genre-tag {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.genre-count {
    opacity: 0.7;
    font-size: 0.8em;
}

.no-content {
    text-align: center;
    padding: var(--spacing-2xl);
    color: var(--color-text-muted);
    background: var(--color-bg-card);
    border-radius: var(--border-radius);
}
</style>

<?php get_footer(); ?>
