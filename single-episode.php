<?php
/**
 * Single Episode Template (THE PLAYER PAGE)
 * 
 * WHAT THIS FILE DOES:
 * - Displays the video player (iframe embed)
 * - Source switcher for multiple servers
 * - Episode navigation (prev/next)
 * - SEO optimized with VideoObject schema
 * - Link to parent series
 * 
 * URL PATTERN: /episode/episode-slug/
 * 
 * THIS IS YOUR MAIN REVENUE PAGE - Optimize for user experience!
 * 
 * @package AnimeStarter
 */

get_header();

while (have_posts()) : the_post();
    
    // Get episode data
    $series = anime_get_episode_series(get_the_ID());
    $episode_num = get_post_meta(get_the_ID(), '_episode_number', true);
    $sub_type = get_post_meta(get_the_ID(), '_subtitle_type', true);
    $air_date = get_post_meta(get_the_ID(), '_air_date', true);
    $streaming_links = anime_get_streaming_links(get_the_ID());
    
    // Navigation
    $prev_episode = anime_get_prev_episode(get_the_ID());
    $next_episode = anime_get_next_episode(get_the_ID());
    
    // SEO Title
    $seo_title = anime_episode_seo_title();
    $sub_label = $sub_type === 'dub' ? 'English Dub' : 'English Sub';
?>

<div class="container">
    
    <!-- Breadcrumbs -->
    <?php anime_breadcrumbs(); ?>
    
    <article class="episode-single" itemscope itemtype="https://schema.org/VideoObject">
        
        <!-- Hidden SEO Meta -->
        <meta itemprop="name" content="<?php echo esc_attr($seo_title); ?>">
        <meta itemprop="description" content="<?php echo esc_attr(anime_episode_meta_description()); ?>">
        <?php if ($series && has_post_thumbnail($series->ID)) : ?>
            <meta itemprop="thumbnailUrl" content="<?php echo esc_url(get_the_post_thumbnail_url($series->ID, 'full')); ?>">
        <?php endif; ?>
        <?php if ($air_date) : ?>
            <meta itemprop="uploadDate" content="<?php echo esc_attr($air_date); ?>">
        <?php endif; ?>
        
        <!-- ==================== EPISODE HEADER ==================== -->
        <header class="episode-header">
            <h1 class="episode-title">
                <?php if ($series) : ?>
                    <a href="<?php echo get_permalink($series->ID); ?>" class="series-link">
                        <?php echo esc_html($series->post_title); ?>
                    </a>
                    <span class="ep-separator">-</span>
                <?php endif; ?>
                <span>Episode <?php echo esc_html($episode_num); ?></span>
                <span class="sub-type-badge <?php echo esc_attr($sub_type); ?>">
                    <?php echo esc_html($sub_label); ?>
                </span>
            </h1>
        </header>
        
        <!-- ==================== VIDEO PLAYER SECTION ==================== -->
        <section class="player-section">
            
            <div class="player-container">
                <div class="player-wrapper" id="player-wrapper">
                    <?php if (!empty($streaming_links)) : ?>
                        <!-- First source loads automatically -->
                        <iframe 
                            id="video-player"
                            src="<?php echo esc_url($streaming_links[0]['url']); ?>"
                            frameborder="0"
                            allowfullscreen
                            scrolling="no"
                            allow="autoplay; fullscreen; encrypted-media; picture-in-picture"
                            loading="lazy"
                            referrerpolicy="no-referrer">
                        </iframe>
                    <?php else : ?>
                        <!-- No sources available -->
                        <div class="player-placeholder">
                            <p><?php esc_html_e('No streaming sources available for this episode.', 'anime-starter'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Source Switcher Buttons -->
            <?php if (count($streaming_links) > 1) : ?>
                <div class="source-switcher">
                    <span class="source-label"><?php esc_html_e('Select Server:', 'anime-starter'); ?></span>
                    <div class="source-buttons" id="source-buttons">
                        <?php foreach ($streaming_links as $index => $link) : ?>
                            <button 
                                type="button"
                                class="source-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                                data-src="<?php echo esc_url($link['url']); ?>"
                                data-index="<?php echo esc_attr($index); ?>">
                                <?php echo esc_html($link['name'] ?: 'Server ' . ($index + 1)); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif (count($streaming_links) === 1) : ?>
                <div class="source-switcher">
                    <span class="source-label">
                        <?php esc_html_e('Server:', 'anime-starter'); ?> 
                        <?php echo esc_html($streaming_links[0]['name'] ?: 'Server 1'); ?>
                    </span>
                </div>
            <?php endif; ?>
            
        </section>
        
        <!-- ==================== EPISODE NAVIGATION ==================== -->
        <nav class="episode-nav" aria-label="<?php esc_attr_e('Episode Navigation', 'anime-starter'); ?>">
            
            <?php if ($prev_episode) : 
                $prev_num = get_post_meta($prev_episode->ID, '_episode_number', true);
            ?>
                <a href="<?php echo get_permalink($prev_episode->ID); ?>" class="episode-nav-btn prev">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15,18 9,12 15,6"></polyline>
                    </svg>
                    <span>
                        <small><?php esc_html_e('Previous', 'anime-starter'); ?></small>
                        <strong>Episode <?php echo esc_html($prev_num); ?></strong>
                    </span>
                </a>
            <?php else : ?>
                <span class="episode-nav-btn disabled">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15,18 9,12 15,6"></polyline>
                    </svg>
                    <span><?php esc_html_e('First Episode', 'anime-starter'); ?></span>
                </span>
            <?php endif; ?>
            
            <!-- Episode List Link -->
            <?php if ($series) : ?>
                <a href="<?php echo get_permalink($series->ID); ?>#episodes-list-title" class="episode-nav-btn episodes-list">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                    <span><?php esc_html_e('All Episodes', 'anime-starter'); ?></span>
                </a>
            <?php endif; ?>
            
            <?php if ($next_episode) : 
                $next_num = get_post_meta($next_episode->ID, '_episode_number', true);
            ?>
                <a href="<?php echo get_permalink($next_episode->ID); ?>" class="episode-nav-btn next">
                    <span>
                        <small><?php esc_html_e('Next', 'anime-starter'); ?></small>
                        <strong>Episode <?php echo esc_html($next_num); ?></strong>
                    </span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9,18 15,12 9,6"></polyline>
                    </svg>
                </a>
            <?php else : ?>
                <span class="episode-nav-btn disabled">
                    <span><?php esc_html_e('Latest Episode', 'anime-starter'); ?></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9,18 15,12 9,6"></polyline>
                    </svg>
                </span>
            <?php endif; ?>
            
        </nav>
        
        <!-- ==================== EPISODE INFO ==================== -->
        <section class="episode-info-section">
            
            <div class="episode-details">
                
                <?php if ($series) : ?>
                    <div class="series-info-brief">
                        <div class="series-thumb">
                            <?php if (has_post_thumbnail($series->ID)) : ?>
                                <a href="<?php echo get_permalink($series->ID); ?>">
                                    <?php echo get_the_post_thumbnail($series->ID, 'poster-small'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="series-text">
                            <h2>
                                <a href="<?php echo get_permalink($series->ID); ?>">
                                    <?php echo esc_html($series->post_title); ?>
                                </a>
                            </h2>
                            <?php 
                            $genres = get_the_terms($series->ID, 'genre');
                            if (!empty($genres) && !is_wp_error($genres)) : 
                            ?>
                                <div class="series-genres">
                                    <?php foreach (array_slice($genres, 0, 3) as $genre) : ?>
                                        <a href="<?php echo get_term_link($genre); ?>" class="genre-tag">
                                            <?php echo esc_html($genre->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>
            
        </section>
        
    </article>
    
</div>

<style>
/* Episode Page Specific Styles */
.episode-header {
    margin-bottom: var(--spacing-lg);
}

.episode-title {
    font-size: var(--font-size-xl);
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--spacing-sm);
}

.series-link {
    color: var(--color-text);
}

.series-link:hover {
    color: var(--color-accent);
}

.ep-separator {
    color: var(--color-text-muted);
}

.sub-type-badge {
    font-size: var(--font-size-sm);
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: 4px;
    background: var(--color-secondary);
}

.sub-type-badge.dub {
    background: #2196f3;
    color: white;
}

.sub-type-badge.sub {
    background: #4caf50;
    color: white;
}

/* Episode Nav Enhanced */
.episode-nav {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: var(--spacing-md);
}

@media (max-width: 768px) {
    .episode-nav {
        grid-template-columns: 1fr 1fr;
    }
    
    .episodes-list {
        grid-column: span 2;
        order: -1;
    }
}

.episode-nav-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-sm);
    text-align: center;
}

.episode-nav-btn span {
    display: flex;
    flex-direction: column;
}

.episode-nav-btn small {
    font-size: var(--font-size-sm);
    color: var(--color-text-muted);
}

.episode-nav-btn.prev {
    justify-content: flex-start;
}

.episode-nav-btn.next {
    justify-content: flex-end;
}

/* Episode Info Section */
.episode-info-section {
    margin-top: var(--spacing-xl);
    padding: var(--spacing-lg);
    background: var(--color-bg-card);
    border-radius: var(--border-radius);
}

.series-info-brief {
    display: flex;
    gap: var(--spacing-lg);
}

.series-thumb {
    flex-shrink: 0;
    width: 100px;
}

.series-thumb img {
    border-radius: var(--border-radius);
}

.series-text h2 {
    font-size: var(--font-size-lg);
    margin-bottom: var(--spacing-sm);
}

.series-text h2 a {
    color: var(--color-text);
}

.series-text h2 a:hover {
    color: var(--color-accent);
}
</style>

<?php 
endwhile;
get_footer(); 
?>
