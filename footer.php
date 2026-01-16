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
            <div class="footer-grid">
                
                <!-- Brand Column -->
                <div class="footer-brand">
                    <!-- Logo -->
                    <div class="footer-logo">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-site-name">
                                <?php bloginfo('name'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Copyright & Tagline -->
                    <p class="footer-copyright">
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
                    </p>
                    
                    <p class="footer-description">
                        <?php esc_html_e('Your ultimate destination for watching anime online. Stream thousands of episodes in HD quality.', 'anime-starter'); ?>
                    </p>
                    
                    <!-- Social Media Icons -->
                    <div class="footer-social">
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)" class="social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Discord" class="social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20.317 4.3698a19.7913 19.7913 0 00-4.8851-1.5152.0741.0741 0 00-.0785.0371c-.211.3753-.4447.8648-.6083 1.2495-1.8447-.2762-3.68-.2762-5.4868 0-.1636-.3933-.4058-.8742-.6177-1.2495a.077.077 0 00-.0785-.037 19.7363 19.7363 0 00-4.8852 1.515.0699.0699 0 00-.0321.0277C.5334 9.0458-.319 13.5799.0992 18.0578a.0824.0824 0 00.0312.0561c2.0528 1.5076 4.0413 2.4228 5.9929 3.0294a.0777.0777 0 00.0842-.0276c.4616-.6304.8731-1.2952 1.226-1.9942a.076.076 0 00-.0416-.1057c-.6528-.2476-1.2743-.5495-1.8722-.8923a.077.077 0 01-.0076-.1277c.1258-.0943.2517-.1923.3718-.2914a.0743.0743 0 01.0776-.0105c3.9278 1.7933 8.18 1.7933 12.0614 0a.0739.0739 0 01.0785.0095c.1202.099.246.1981.3728.2924a.077.077 0 01-.0066.1276 12.2986 12.2986 0 01-1.873.8914.0766.0766 0 00-.0407.1067c.3604.698.7719 1.3628 1.225 1.9932a.076.076 0 00.0842.0286c1.961-.6067 3.9495-1.5219 6.0023-3.0294a.077.077 0 00.0313-.0552c.5004-5.177-.8382-9.6739-3.5485-13.6604a.061.061 0 00-.0312-.0286zM8.02 15.3312c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9555-2.4189 2.157-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.9555 2.4189-2.1569 2.4189zm7.9748 0c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9554-2.4189 2.1569-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.4189-2.1568 2.4189z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Browse Column -->
                <div class="footer-column">
                    <h3 class="footer-heading"><?php esc_html_e('Browse', 'anime-starter'); ?></h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('series')); ?>"><?php esc_html_e('All Series', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/status/ongoing/')); ?>"><?php esc_html_e('Ongoing Anime', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/status/completed/')); ?>"><?php esc_html_e('Completed Anime', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('episode')); ?>"><?php esc_html_e('Latest Episodes', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/genre/')); ?>"><?php esc_html_e('Genres', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/?s=')); ?>"><?php esc_html_e('Search', 'anime-starter'); ?></a></li>
                    </ul>
                </div>
                
                <!-- Information Column -->
                <div class="footer-column">
                    <h3 class="footer-heading"><?php esc_html_e('Information', 'anime-starter'); ?></h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('About Us', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact Us', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/faq/')); ?>"><?php esc_html_e('FAQ', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/dmca/')); ?>"><?php esc_html_e('DMCA', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/request/')); ?>"><?php esc_html_e('Request Anime', 'anime-starter'); ?></a></li>
                    </ul>
                </div>
                
                <!-- Legal Column -->
                <div class="footer-column">
                    <h3 class="footer-heading"><?php esc_html_e('Legal', 'anime-starter'); ?></h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/terms-of-service/')); ?>"><?php esc_html_e('Terms of Service', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>"><?php esc_html_e('Cookie Policy', 'anime-starter'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/disclaimer/')); ?>"><?php esc_html_e('Disclaimer', 'anime-starter'); ?></a></li>
                    </ul>
                </div>
                
            </div>
            
            <!-- Footer Bottom Bar -->
            <div class="footer-bottom">
                <p class="footer-bottom-text">
                    <?php 
                    printf(
                        esc_html__('%1$s does not store any files on our server, we only link to media hosted on third-party services.', 'anime-starter'),
                        get_bloginfo('name')
                    ); 
                    ?>
                </p>
            </div>
            
        </div>
    </footer>
    
</div><!-- #page -->

<style>
/* ==================== FOOTER STYLES ==================== */
.site-footer {
    background: #0a0a0f;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    padding: 60px 0 30px;
    margin-top: auto;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr;
    gap: 40px;
}

@media (max-width: 992px) {
    .footer-grid {
        grid-template-columns: 1fr 1fr;
        gap: 40px 30px;
    }
}

@media (max-width: 576px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 35px;
    }
}

/* Brand Column */
.footer-brand {
    padding-right: 40px;
}

@media (max-width: 992px) {
    .footer-brand {
        grid-column: span 2;
        padding-right: 0;
    }
}

@media (max-width: 576px) {
    .footer-brand {
        grid-column: span 1;
        text-align: center;
    }
}

.footer-logo {
    margin-bottom: 15px;
}

.footer-site-name {
    font-size: 1.75rem;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
    display: inline-block;
}

.footer-site-name:hover {
    color: var(--color-accent, #e94560);
}

.footer-copyright {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.5);
    margin-bottom: 12px;
}

.footer-description {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.6;
    margin-bottom: 20px;
    max-width: 320px;
}

@media (max-width: 576px) {
    .footer-description {
        max-width: 100%;
    }
}

/* Social Icons */
.footer-social {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

@media (max-width: 576px) {
    .footer-social {
        justify-content: center;
    }
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    color: rgba(255, 255, 255, 0.7);
    transition: all 0.2s ease;
}

.social-icon:hover {
    background: var(--color-accent, #e94560);
    color: #fff;
    transform: translateY(-2px);
}

/* Footer Columns */
.footer-column {
    min-width: 0;
}

.footer-heading {
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.6);
    text-decoration: none;
    transition: color 0.2s ease;
    display: inline-block;
}

.footer-links a:hover {
    color: #fff;
}

/* Footer Bottom */
.footer-bottom {
    margin-top: 50px;
    padding-top: 25px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    text-align: center;
}

.footer-bottom-text {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.4);
    line-height: 1.6;
    max-width: 700px;
    margin: 0 auto;
}
</style>

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