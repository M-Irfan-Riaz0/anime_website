<?php
/**
 * 404 Error Template
 * 
 * WHAT THIS FILE DOES:
 * - Displays when a page is not found
 * - Provides search and navigation options
 * - Suggests popular content
 * 
 * @package AnimeStarter
 */

get_header();
?>

<div class="container">
    
    <!-- Breadcrumbs -->
    <?php anime_breadcrumbs(); ?>
    
    <article class="error-page">
        
        <!-- Error Animation/Icon -->
        <div class="error-icon">
            <span class="error-code">404</span>
        </div>
        
        <h1 class="error-title">
            <?php esc_html_e('Page Not Found', 'anime-starter'); ?>
        </h1>
        
        <p class="error-description">
            <?php esc_html_e('Oops! The page you\'re looking for doesn\'t exist or has been moved.', 'anime-starter'); ?>
        </p>
        
        <!-- Search Form -->
        <div class="error-search">
            <form class="search-form-large" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                <input type="search" 
                       name="s" 
                       placeholder="<?php esc_attr_e('Search for anime...', 'anime-starter'); ?>">
                <input type="hidden" name="post_type" value="series">
                <button type="submit"><?php esc_html_e('Search', 'anime-starter'); ?></button>
            </form>
        </div>
        
        <!-- Quick Links -->
        <div class="error-links">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="error-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <?php esc_html_e('Go Home', 'anime-starter'); ?>
            </a>
            
            <a href="<?php echo esc_url(get_post_type_archive_link('series')); ?>" class="error-btn secondary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                    <line x1="7" y1="2" x2="7" y2="22"></line>
                    <line x1="17" y1="2" x2="17" y2="22"></line>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <line x1="2" y1="7" x2="7" y2="7"></line>
                    <line x1="2" y1="17" x2="7" y2="17"></line>
                    <line x1="17" y1="17" x2="22" y2="17"></line>
                    <line x1="17" y1="7" x2="22" y2="7"></line>
                </svg>
                <?php esc_html_e('Browse Series', 'anime-starter'); ?>
            </a>
        </div>
        
    </article>
    
    <!-- Suggestions -->
    <section class="error-suggestions mt-2">
        
        <h2 class="section-title"><?php esc_html_e('Maybe You\'re Looking For...', 'anime-starter'); ?></h2>
        
        <div class="grid grid-5">
            <?php
            // Show random popular series
            $suggestions = get_posts(array(
                'post_type'      => 'series',
                'posts_per_page' => 5,
                'orderby'        => 'rand',
            ));
            
            foreach ($suggestions as $s) :
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
.error-page {
    text-align: center;
    padding: var(--spacing-2xl) var(--spacing-md);
}

.error-icon {
    margin-bottom: var(--spacing-lg);
}

.error-code {
    font-size: 8rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--color-accent), #ff6b8a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    display: block;
}

@media (max-width: 480px) {
    .error-code {
        font-size: 5rem;
    }
}

.error-title {
    font-size: var(--font-size-2xl);
    margin-bottom: var(--spacing-md);
}

.error-description {
    color: var(--color-text-muted);
    max-width: 500px;
    margin: 0 auto var(--spacing-xl);
}

.error-search {
    max-width: 500px;
    margin: 0 auto var(--spacing-xl);
}

.error-links {
    display: flex;
    justify-content: center;
    gap: var(--spacing-md);
    flex-wrap: wrap;
}

.error-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    background: var(--color-accent);
    color: white;
    padding: var(--spacing-md) var(--spacing-xl);
    border-radius: var(--border-radius);
    font-weight: 600;
    transition: transform var(--transition-fast), background var(--transition-fast);
}

.error-btn:hover {
    transform: translateY(-2px);
    background: #d63850;
    color: white;
}

.error-btn.secondary {
    background: var(--color-secondary);
    color: var(--color-text);
}

.error-btn.secondary:hover {
    background: var(--color-accent);
    color: white;
}

.error-suggestions {
    padding: var(--spacing-xl);
    background: var(--color-bg-card);
    border-radius: var(--border-radius);
}
</style>

<?php get_footer(); ?>
