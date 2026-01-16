
<?php
/**
 * Footer Template
 * 
 * WHAT THIS FILE DOES:
 * - Closes main content area
 * - Contains site footer with links, copyright
 * - Closes HTML document
 * - Loads footer scripts via wp_footer()
 * 
 * @package AnimeStarter
 */
?>
    </main><!-- #main-content -->
    
    <!-- ==================== SITE FOOTER ==================== -->
    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-inner">
                
                <!-- Footer Navigation -->
                <nav class="footer-nav" aria-label="<?php esc_attr_e('Footer Menu', 'anime-starter'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </nav>
                
                <!-- Copyright -->
                <div class="copyright">
                    <p>
                        &copy; <?php echo date('Y'); ?> 
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
                        <?php esc_html_e('All rights reserved.', 'anime-starter'); ?>
                    </p>
                </div>
                
            </div>
        </div>
    </footer>
    
</div><!-- #page -->

<?php 
/**
 * wp_footer() - CRITICAL
 * Loads all enqueued scripts and required WordPress footer items.
 * NEVER remove this or JavaScript won't work!
 */
wp_footer(); 
?>

</body>
</html>
