<?php
/**
 * Genre Archive Template
 * 
 * WHAT THIS FILE DOES:
 * - Displays all series within a specific genre
 * - Shows genre name and description
 * - Grid layout with pagination
 * 
 * URL PATTERN: /genre/action/
 * 
 * NOTE: This file handles the 'genre' taxonomy.
 * For 'year' and 'status', WordPress will use this as fallback
 * or you can create taxonomy-year.php and taxonomy-status.php
 * 
 * @package AnimeStarter
 */

get_header();

// Get current term
$term = get_queried_object();
?>

<div class="container">
    
    <!-- Breadcrumbs -->
    <?php anime_breadcrumbs(); ?>
    
    <!-- Archive Header -->
    <header class="archive-header">
        <h1 class="archive-title">
            <?php echo esc_html($term->name); ?> 
            <span class="term-type"><?php esc_html_e('Anime', 'anime-starter'); ?></span>
        </h1>
        
        <?php if (!empty($term->description)) : ?>
            <p class="archive-description">
                <?php echo esc_html($term->description); ?>
            </p>
        <?php else : ?>
            <p class="archive-description">
                <?php printf(
                    esc_html__('Browse all %s anime series.', 'anime-starter'),
                    esc_html($term->name)
                ); ?>
            </p>
        <?php endif; ?>
        
        <div class="archive-meta">
            <span class="series-count">
                <?php printf(
                    _n('%d Series', '%d Series', $term->count, 'anime-starter'),
                    $term->count
                ); ?>
            </span>
        </div>
    </header>
    
    <!-- Series Grid -->
    <?php if (have_posts()) : ?>
        
        <div class="grid grid-5">
            <?php while (have_posts()) : the_post(); 
                $status = get_the_terms(get_the_ID(), 'status');
                $episode_count = anime_get_episode_count(get_the_ID());
            ?>
                <article class="card series-card">
                    <a href="<?php the_permalink(); ?>">
                        <div class="card-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('poster-small', array('loading' => 'lazy')); ?>
                            <?php else : ?>
                                <div class="lazy-placeholder"></div>
                            <?php endif; ?>
                            
                            <?php if (!empty($status) && !is_wp_error($status)) : ?>
                                <span class="card-badge"><?php echo esc_html($status[0]->name); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-content">
                            <h2 class="card-title"><?php the_title(); ?></h2>
                            <div class="card-meta">
                                <?php if ($episode_count > 0) : ?>
                                    <span><?php echo esc_html($episode_count); ?> EP</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
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
            <h2><?php esc_html_e('No Series Found', 'anime-starter'); ?></h2>
            <p><?php esc_html_e('No anime series in this genre yet.', 'anime-starter'); ?></p>
            <a href="<?php echo esc_url(get_post_type_archive_link('series')); ?>" class="btn-secondary">
                <?php esc_html_e('Browse All Series', 'anime-starter'); ?>
            </a>
        </div>
        
    <?php endif; ?>
    
    <!-- Other Genres -->
    <section class="other-genres mt-2">
        <h2 class="section-title"><?php esc_html_e('Other Genres', 'anime-starter'); ?></h2>
        
        <div class="genres-grid">
            <?php
            $other_genres = get_terms(array(
                'taxonomy'   => 'genre',
                'hide_empty' => true,
                'exclude'    => array($term->term_id),
                'number'     => 15,
            ));
            
            if (!empty($other_genres) && !is_wp_error($other_genres)) :
                foreach ($other_genres as $genre) :
            ?>
                <a href="<?php echo esc_url(get_term_link($genre)); ?>" class="genre-tag">
                    <?php echo esc_html($genre->name); ?>
                    <span class="genre-count">(<?php echo esc_html($genre->count); ?>)</span>
                </a>
            <?php 
                endforeach;
            endif; 
            ?>
        </div>
    </section>
    
</div>

<style>
.term-type {
    font-weight: 400;
    color: var(--color-text-muted);
}

.archive-meta {
    margin-top: var(--spacing-md);
}

.series-count {
    background: var(--color-accent);
    color: white;
    padding: var(--spacing-xs) var(--spacing-md);
    border-radius: 20px;
    font-size: var(--font-size-sm);
}

.btn-secondary {
    display: inline-block;
    background: var(--color-secondary);
    color: var(--color-text);
    padding: var(--spacing-md) var(--spacing-xl);
    border-radius: var(--border-radius);
    margin-top: var(--spacing-md);
}

.btn-secondary:hover {
    background: var(--color-accent);
    color: white;
}

.other-genres {
    padding: var(--spacing-xl);
    background: var(--color-bg-card);
    border-radius: var(--border-radius);
}

.other-genres .genres-grid {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-sm);
}
</style>

<?php get_footer(); ?>
