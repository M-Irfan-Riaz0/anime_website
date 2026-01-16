<?php
/**
 * Archive Series Template
 * 
 * WHAT THIS FILE DOES:
 * - Displays all series in a grid
 * - Includes filtering options
 * - Pagination
 * 
 * URL PATTERN: /series/
 * 
 * @package AnimeStarter
 */

get_header();
?>

<div class="container">
    
    <!-- Breadcrumbs -->
    <?php anime_breadcrumbs(); ?>
    
    <!-- Archive Header -->
    <header class="archive-header">
        <h1 class="archive-title"><?php esc_html_e('All Series', 'anime-starter'); ?></h1>
        <p class="archive-description">
            <?php esc_html_e('Browse our complete collection of anime series.', 'anime-starter'); ?>
        </p>
    </header>
    
    <!-- Filter Bar -->
    <div class="filter-bar">
        
        <!-- Genre Filter -->
        <select class="filter-select" id="filter-genre" onchange="applyFilters()">
            <option value=""><?php esc_html_e('All Genres', 'anime-starter'); ?></option>
            <?php
            $genres = get_terms(array('taxonomy' => 'genre', 'hide_empty' => true));
            $current_genre = isset($_GET['genre']) ? sanitize_text_field($_GET['genre']) : '';
            foreach ($genres as $genre) :
            ?>
                <option value="<?php echo esc_attr($genre->slug); ?>" <?php selected($current_genre, $genre->slug); ?>>
                    <?php echo esc_html($genre->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <!-- Year Filter -->
        <select class="filter-select" id="filter-year" onchange="applyFilters()">
            <option value=""><?php esc_html_e('All Years', 'anime-starter'); ?></option>
            <?php
            $years = get_terms(array('taxonomy' => 'year', 'hide_empty' => true, 'orderby' => 'name', 'order' => 'DESC'));
            $current_year = isset($_GET['year']) ? sanitize_text_field($_GET['year']) : '';
            foreach ($years as $year) :
            ?>
                <option value="<?php echo esc_attr($year->slug); ?>" <?php selected($current_year, $year->slug); ?>>
                    <?php echo esc_html($year->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <!-- Status Filter -->
        <select class="filter-select" id="filter-status" onchange="applyFilters()">
            <option value=""><?php esc_html_e('All Status', 'anime-starter'); ?></option>
            <?php
            $statuses = get_terms(array('taxonomy' => 'status', 'hide_empty' => true));
            $current_status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
            foreach ($statuses as $status) :
            ?>
                <option value="<?php echo esc_attr($status->slug); ?>" <?php selected($current_status, $status->slug); ?>>
                    <?php echo esc_html($status->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <!-- Sort -->
        <select class="filter-select" id="filter-sort" onchange="applyFilters()">
            <?php $current_sort = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date'; ?>
            <option value="date" <?php selected($current_sort, 'date'); ?>><?php esc_html_e('Latest', 'anime-starter'); ?></option>
            <option value="title" <?php selected($current_sort, 'title'); ?>><?php esc_html_e('A-Z', 'anime-starter'); ?></option>
            <option value="modified" <?php selected($current_sort, 'modified'); ?>><?php esc_html_e('Recently Updated', 'anime-starter'); ?></option>
        </select>
        
    </div>
    
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
            <p><?php esc_html_e('Try adjusting your filters or search criteria.', 'anime-starter'); ?></p>
        </div>
        
    <?php endif; ?>
    
</div>

<script>
// Simple filter apply function (redirects with query params)
function applyFilters() {
    const genre = document.getElementById('filter-genre').value;
    const year = document.getElementById('filter-year').value;
    const status = document.getElementById('filter-status').value;
    const sort = document.getElementById('filter-sort').value;
    
    let url = '<?php echo get_post_type_archive_link('series'); ?>';
    const params = new URLSearchParams();
    
    if (genre) params.set('genre', genre);
    if (year) params.set('year', year);
    if (status) params.set('status', status);
    if (sort && sort !== 'date') params.set('orderby', sort);
    
    const queryString = params.toString();
    if (queryString) {
        url += '?' + queryString;
    }
    
    window.location.href = url;
}
</script>

<style>
.no-results {
    text-align: center;
    padding: var(--spacing-2xl);
    background: var(--color-bg-card);
    border-radius: var(--border-radius);
}

.no-results h2 {
    margin-bottom: var(--spacing-md);
}

.no-results p {
    color: var(--color-text-muted);
}
</style>

<?php get_footer(); ?>
