/**
 * Anime Starter Theme - Main JavaScript
 * 
 * WHAT THIS FILE DOES:
 * - Video player source switching
 * - Mobile menu toggle
 * - Search form toggle
 * - Lazy loading for iframes
 * 
 * RULES:
 * - Pure Vanilla JS (NO jQuery)
 * - NO external libraries
 * - Keep it minimal and fast
 * 
 * @package AnimeStarter
 * @version 1.0.0
 */

(function() {
    'use strict';
    
    // ==========================================================================
    // INITIALIZATION - Wait for DOM
    // ==========================================================================
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initSearchToggle();
        initSourceSwitcher();
        initLazyIframes();
    });
    
    // ==========================================================================
    // MOBILE MENU TOGGLE
    // ==========================================================================
    function initMobileMenu() {
        const menuToggle = document.getElementById('menu-toggle');
        const navigation = document.getElementById('primary-navigation');
        
        if (!menuToggle || !navigation) return;
        
        menuToggle.addEventListener('click', function() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            
            // Toggle state
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            navigation.classList.toggle('active');
            
            // Animate hamburger icon
            menuToggle.classList.toggle('active');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navigation.contains(e.target) && !menuToggle.contains(e.target)) {
                navigation.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.classList.remove('active');
            }
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navigation.classList.contains('active')) {
                navigation.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.classList.remove('active');
                menuToggle.focus();
            }
        });
    }
    
    // ==========================================================================
    // SEARCH TOGGLE
    // ==========================================================================
    function initSearchToggle() {
        const searchToggle = document.getElementById('search-toggle');
        const searchForm = document.getElementById('header-search-form');
        const searchInput = document.getElementById('header-search-input');
        
        if (!searchToggle || !searchForm) return;
        
        searchToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            searchForm.classList.toggle('active');
            
            // Focus input when opening
            if (searchForm.classList.contains('active') && searchInput) {
                searchInput.focus();
            }
        });
        
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target) && !searchToggle.contains(e.target)) {
                searchForm.classList.remove('active');
            }
        });
        
        // Close on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchForm.classList.contains('active')) {
                searchForm.classList.remove('active');
                searchToggle.focus();
            }
        });
    }


   // ==========================================================================
    // UTILITY: Debounce Function (for future use with search, etc.)
    // ==========================================================================

 window.debounce = function(func, wait) {
        var timeout;
        return function() {
            var context = this;
            var args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, wait);
        };
    };
    // ==========================================================================
// AUTOCOMPLETE FOR SERIES SEARCH
// ==========================================================================
(function() {
    const searchInput = document.getElementById('header-search-input');
    const searchForm = document.getElementById('header-search-form');

    if (!searchInput || !searchForm) return;

    // Create dropdown container
    const dropdown = document.createElement('ul');
    dropdown.className = 'autocomplete-dropdown';
    searchForm.appendChild(dropdown);

    searchInput.addEventListener('input', debounce(function() {
        const query = this.value.trim();
        if (query.length < 1) {
            dropdown.innerHTML = '';
            return;
        }

        fetch(`/wp-admin/admin-ajax.php?action=series_autocomplete&query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                dropdown.innerHTML = '';
                data.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = item;

                    // click fills input and optionally submits
                    li.addEventListener('click', () => {
                        searchInput.value = item;
                        dropdown.innerHTML = '';
                        searchForm.submit(); // remove if you want only filling
                    });

                    dropdown.appendChild(li);
                });
            });
    }, 300));

    // Close dropdown on outside click
    document.addEventListener('click', (e) => {
        if (!searchForm.contains(e.target)) {
            dropdown.innerHTML = '';
        }
    });

})();

    // ==========================================================================
    // VIDEO SOURCE SWITCHER
    // ==========================================================================
    function initSourceSwitcher() {
        const sourceButtons = document.getElementById('source-buttons');
        const videoPlayer = document.getElementById('video-player');
        
        if (!sourceButtons || !videoPlayer) return;
        
        sourceButtons.addEventListener('click', function(e) {
            const btn = e.target.closest('.source-btn');
            if (!btn) return;
            
            const newSrc = btn.dataset.src;
            if (!newSrc) return;
            
            // Update active state
            const allButtons = sourceButtons.querySelectorAll('.source-btn');
            allButtons.forEach(function(b) {
                b.classList.remove('active');
            });
            btn.classList.add('active');
            
            // Change video source with loading state
            videoPlayer.style.opacity = '0.5';
            
            // Use a small delay to show loading feedback
            setTimeout(function() {
                videoPlayer.src = newSrc;
                videoPlayer.style.opacity = '1';
            }, 100);
            
            // Store preference in sessionStorage
            try {
                sessionStorage.setItem('preferredServer', btn.dataset.index);
            } catch (e) {
                // sessionStorage not available
            }
        });
        
        // Restore preferred server on page load
        try {
            const preferred = sessionStorage.getItem('preferredServer');
            if (preferred) {
                const preferredBtn = sourceButtons.querySelector('[data-index="' + preferred + '"]');
                if (preferredBtn && preferredBtn.dataset.src) {
                    preferredBtn.click();
                }
            }
        } catch (e) {
            // sessionStorage not available
        }
    }
    
    // ==========================================================================
    // LAZY LOAD IFRAMES
    // ==========================================================================
    function initLazyIframes() {
        // Native lazy loading is already added in HTML
        // This is a fallback for older browsers
        
        if ('IntersectionObserver' in window) {
            const lazyIframes = document.querySelectorAll('iframe[loading="lazy"]');
            
            const iframeObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const iframe = entry.target;
                        if (iframe.dataset.src) {
                            iframe.src = iframe.dataset.src;
                            iframe.removeAttribute('data-src');
                        }
                        iframeObserver.unobserve(iframe);
                    }
                });
            }, {
                rootMargin: '200px 0px'  // Load 200px before viewport
            });
            
            lazyIframes.forEach(function(iframe) {
                iframeObserver.observe(iframe);
            });
        }
    }
    
    // ==========================================================================
    // UTILITY: Smooth Scroll to Element
    // ==========================================================================
    window.scrollToElement = function(selector) {
        const element = document.querySelector(selector);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    };
    
 
   
    
})();
