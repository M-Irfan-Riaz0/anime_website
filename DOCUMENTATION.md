# 📺 Anime Starter Theme - Complete Documentation

**Version:** 1.0.0  
**Author:** Irfan  
**WordPress Compatibility:** 6.0+  
**PHP Version:** 7.4+

---

## 📑 Table of Contents

1. [Theme Overview](#-theme-overview)
2. [File Structure & Functionality](#-file-structure--functionality)
3. [Installation Guide](#-installation-guide)
4. [Custom Post Types Explained](#-custom-post-types-explained)
5. [Taxonomies Explained](#-taxonomies-explained)
6. [Adding Content Guide](#-adding-content-guide)
7. [Template Hierarchy](#-template-hierarchy)
8. [Video Player System](#-video-player-system)
9. [SEO Implementation](#-seo-implementation)
10. [Customization Guide](#-customization-guide)
11. [Automation with Free AI (Gemini)](#-automation-with-free-ai-gemini)
12. [Performance Optimization](#-performance-optimization)
13. [Scaling & Safety](#-scaling--safety)
14. [Troubleshooting](#-troubleshooting)

---

## 🎯 Theme Overview

This is a **minimal, SEO-first WordPress theme** for anime streaming sites built with:

- ✅ **Pure WordPress** - No page builders
- ✅ **Vanilla JavaScript** - No jQuery, no React
- ✅ **Custom Post Types** - Series & Episodes
- ✅ **Native Meta Boxes** - No ACF required
- ✅ **Performance Optimized** - Fast loading
- ✅ **SEO Ready** - Schema markup included

### Core Principle
> **Theme = Renderer, Not Brain**

The theme only displays data. All logic is handled through WordPress's native systems.

---

## 📁 File Structure & Functionality

```
anime-starter-theme/
│
├── style.css              → Theme header + ALL CSS styles
├── functions.php          → CPTs, taxonomies, meta boxes, helpers
├── index.php              → Homepage / fallback template
├── header.php             → Site header, navigation, search
├── footer.php             → Site footer, copyright
├── single-series.php      → Single series detail page
├── single-episode.php     → Episode watch page (PLAYER)
├── archive-series.php     → All series listing
├── taxonomy-genre.php     → Genre archive pages
├── search.php             → Search results
├── 404.php                → Page not found
│
├── assets/
│   ├── css/               → (empty - all CSS in style.css)
│   └── js/
│       └── main.js        → Vanilla JS for interactions
│
├── inc/                   → (empty - ready for additional PHP)
├── template-parts/        → (empty - ready for partials)
│
├── DOCUMENTATION.md       → This file
└── SCREENSHOT-INFO.md     → Screenshot requirements
```

### File-by-File Explanation

#### `style.css`
**Purpose:** Theme identification + ALL styles

WordPress requires this file. The comment block at the top tells WordPress:
- Theme name, version, author
- Required PHP/WP versions
- Theme description

Contains:
- CSS Variables for easy customization
- Base reset styles
- Header & navigation styles
- Footer styles
- Card components (series/episode)
- Player styles
- Archive pages
- Search & 404 pages
- Utility classes

#### `functions.php`
**Purpose:** The brain of your theme

This file:
1. **Registers CPTs** - Creates 'series' and 'episode' post types
2. **Registers Taxonomies** - Creates 'genre', 'year', 'status'
3. **Creates Meta Boxes** - Admin interface for episode details
4. **Enqueues Assets** - Loads CSS and JS properly
5. **Helper Functions** - Reusable functions for templates
6. **Performance** - Disables emoji, cleans up head
7. **Admin Columns** - Better episode management

#### `header.php`
**Purpose:** Everything before main content

Contains:
- `<!DOCTYPE html>` and `<head>` section
- Meta tags for SEO
- `wp_head()` call (CRITICAL - loads styles/scripts)
- Site header with logo
- Primary navigation
- Mobile menu toggle
- Search form

#### `footer.php`
**Purpose:** Everything after main content

Contains:
- Footer navigation
- Copyright text
- `wp_footer()` call (CRITICAL - loads scripts)
- Closing HTML tags

#### `index.php`
**Purpose:** Homepage and ultimate fallback

Shows:
- Latest episodes (grid)
- Popular series (grid)
- Genre links

This is used when no other template matches.

#### `single-series.php`
**Purpose:** Individual series page

Displays:
- Series poster image
- Title and alternative titles
- Meta info (year, status, episode count)
- Genre tags
- Description
- Episode list (numbered buttons)
- Related series

#### `single-episode.php` ⭐ MOST IMPORTANT
**Purpose:** The watch page with video player

Displays:
- Episode title with series link
- **Video player (iframe)**
- **Source switcher buttons**
- Previous/Next navigation
- Series info brief

#### `archive-series.php`
**Purpose:** All series listing page

Features:
- Filter dropdowns (genre, year, status, sort)
- Series grid
- Pagination

#### `taxonomy-genre.php`
**Purpose:** Genre archive pages (e.g., /genre/action/)

Shows:
- Genre name and description
- Series count
- Series in that genre
- Other genres links

#### `search.php`
**Purpose:** Search results page

Features:
- Search query display
- Results count
- Refined search form
- Mixed results (series + episodes)
- Popular series suggestions

#### `404.php`
**Purpose:** Page not found

Features:
- Friendly error message
- Search form
- Quick links to home/series
- Random series suggestions

#### `assets/js/main.js`
**Purpose:** All JavaScript functionality

Features:
- Mobile menu toggle
- Search form toggle
- **Video source switcher** (changes iframe src)
- Server preference memory (sessionStorage)
- Lazy loading support

---

## 🔧 Installation Guide

### Step 1: Upload Theme
```
1. Download the theme ZIP file
2. Go to WordPress Admin > Appearance > Themes
3. Click "Add New" > "Upload Theme"
4. Choose the ZIP file and click "Install Now"
5. Click "Activate"
```

### Step 2: Create Menus
```
1. Go to Appearance > Menus
2. Create a new menu called "Primary Menu"
3. Add pages/links/categories
4. Assign to "Primary Menu" location
5. Repeat for "Footer Menu" (optional)
```

### Step 3: Add Default Terms
Go to **Series > Genres** and add:
- Action
- Adventure
- Comedy
- Drama
- Fantasy
- Romance
- Sci-Fi
- Slice of Life
- etc.

Go to **Series > Status** and add:
- Ongoing
- Completed

Go to **Series > Years** and add:
- 2024
- 2023
- 2022
- etc.

### Step 4: Add Your First Series
```
1. Go to Series > Add New
2. Enter title (e.g., "Naruto")
3. Add description in editor
4. Set featured image (poster)
5. Select genres, year, status
6. Optionally add total episodes and alt titles
7. Publish
```

### Step 5: Add Episodes
```
1. Go to Episodes > Add New
2. Enter title (e.g., "Naruto Episode 1")
3. Select Parent Series from dropdown
4. Enter Episode Number (e.g., 1)
5. Select Subtitle Type (Sub/Dub/Raw)
6. Add Streaming Links:
   - Server Name: "Server 1"
   - URL: "https://embed.example.com/video/abc123"
   - Click "+ Add Server" for more
7. Publish
```

### Step 6: Update Permalinks
```
1. Go to Settings > Permalinks
2. Choose "Post name" or custom structure
3. Click "Save Changes" (this flushes rewrite rules)
```

---

## 📊 Custom Post Types Explained

### Series CPT

**What it is:** The main content type for anime/shows

**Admin Location:** Dashboard > Series

**Stores:**
- Title
- Description (main editor)
- Featured Image (poster)
- Total Episodes (meta)
- Alternative Titles (meta)

**Connected to:**
- Genre taxonomy
- Year taxonomy  
- Status taxonomy
- Episode CPT (parent relationship)

**URL Pattern:** `/series/series-slug/`

### Episode CPT

**What it is:** Individual episodes linked to a series

**Admin Location:** Dashboard > Episodes

**Stores:**
- Title
- Episode Number (meta)
- Series ID - parent relationship (meta)
- Subtitle Type - sub/dub/raw (meta)
- Air Date (meta)
- Streaming Links - array of name/url pairs (meta)

**URL Pattern:** `/episode/episode-slug/`

---

## 🏷 Taxonomies Explained

### Genre (Hierarchical - like Categories)
- Can have parent/child relationships
- Used for categorizing series by type
- Examples: Action, Comedy, Drama

### Year (Non-hierarchical - like Tags)
- Simple flat list
- Used for filtering by release year
- Examples: 2024, 2023, 2022

### Status (Hierarchical - like Categories)
- Simple list with possible children
- Indicates if series is ongoing or finished
- Examples: Ongoing, Completed, Hiatus

---

## 📝 Adding Content Guide

### Adding a New Series

1. Go to **Series > Add New**
2. **Title:** Enter anime name (e.g., "Attack on Titan")
3. **Content:** Add synopsis/description
4. **Featured Image:** Upload poster (recommended 400x600)
5. **Genres:** Check applicable genres
6. **Year:** Select release year
7. **Status:** Select Ongoing/Completed
8. **Series Details (sidebar):**
   - Total Episodes: Leave blank if ongoing
   - Alternative Titles: One per line (Japanese name, etc.)
9. Click **Publish**

### Adding Episodes

1. Go to **Episodes > Add New**
2. **Title:** "Series Name Episode X" (for URL/SEO)
3. **Episode Details:**
   - **Parent Series:** Select from dropdown (REQUIRED)
   - **Episode Number:** Enter number (1, 2, 3...)
   - **Subtitle Type:** Sub, Dub, or Raw
   - **Air Date:** When it aired (optional)
   - **Streaming Links:** Add your embed URLs
4. Click **Publish**

### Streaming Links Format

Add iframe-compatible embed URLs:
```
Server Name: Server 1
URL: https://embed.provider.com/video/abc123

Server Name: Server 2  
URL: https://backup.provider.com/video/xyz789
```

The first link is auto-selected. Users can switch servers.

**IMPORTANT:** Only add embed URLs, NOT direct video files!

---

## 🗺 Template Hierarchy

WordPress looks for templates in this order:

### For Single Series:
1. `single-series-{slug}.php` (e.g., single-series-naruto.php)
2. `single-series.php` ← **We use this**
3. `single.php`
4. `singular.php`
5. `index.php`

### For Single Episode:
1. `single-episode-{slug}.php`
2. `single-episode.php` ← **We use this**
3. `single.php`
4. `singular.php`
5. `index.php`

### For Series Archive:
1. `archive-series.php` ← **We use this**
2. `archive.php`
3. `index.php`

### For Genre Taxonomy:
1. `taxonomy-genre-{slug}.php` (e.g., taxonomy-genre-action.php)
2. `taxonomy-genre.php` ← **We use this**
3. `taxonomy.php`
4. `archive.php`
5. `index.php`

### For Search:
1. `search.php` ← **We use this**
2. `index.php`

### For 404:
1. `404.php` ← **We use this**
2. `index.php`

---

## 🎥 Video Player System

### How It Works

1. **You manually add embed URLs** in episode meta
2. **Theme renders iframe** with first URL as default
3. **JavaScript enables switching** between servers
4. **No video hosting** - just embedding

### The Player HTML Structure

```html
<div class="player-container">
    <div class="player-wrapper">
        <iframe id="video-player" src="FIRST_LINK_HERE"></iframe>
    </div>
</div>

<div class="source-switcher">
    <button class="source-btn active" data-src="LINK_1">Server 1</button>
    <button class="source-btn" data-src="LINK_2">Server 2</button>
</div>
```

### JavaScript Source Switching

When user clicks a server button:
1. Get `data-src` attribute
2. Update iframe `src`
3. Toggle active class
4. Store preference in sessionStorage

### Supported Embed Formats

Most video embed providers use iframe format:
```
https://player.provider.com/embed/VIDEO_ID
https://www.youtube.com/embed/VIDEO_ID
https://drive.google.com/file/d/FILE_ID/preview
```

**DO NOT add direct .mp4 links** - use embed URLs only!

---

## 🔍 SEO Implementation

### Title Structure

**Episode Pages:**
```
{Series Name} Episode {Number} {Sub Type} - Watch Online
Example: "Naruto Episode 1 English Sub - Watch Online"
```

**Series Pages:**
```
{Series Name} - Watch All Episodes Online
```

### Meta Description (Auto-generated)

```
Watch {Series Name} Episode {Number} {Sub Type} online for free. 
High quality streaming available on multiple servers.
```

### Schema Markup

**Series Page:** TVSeries schema
```html
<article itemscope itemtype="https://schema.org/TVSeries">
    <meta itemprop="name" content="Series Name">
    <meta itemprop="description" content="...">
    <meta itemprop="image" content="poster.jpg">
</article>
```

**Episode Page:** VideoObject schema
```html
<article itemscope itemtype="https://schema.org/VideoObject">
    <meta itemprop="name" content="Episode Title">
    <meta itemprop="description" content="...">
    <meta itemprop="thumbnailUrl" content="thumb.jpg">
    <meta itemprop="uploadDate" content="2024-01-15">
</article>
```

### Breadcrumbs

Implemented for navigation and SEO:
```
Home › Series › Series Name › Episode 1
```

### URL Structure (Clean Permalinks)

```
/series/naruto/
/episode/naruto-episode-1/
/genre/action/
/year/2024/
```

---

## 🎨 Customization Guide

### Changing Colors

Edit CSS variables in `style.css`:

```css
:root {
    --color-primary: #1a1a2e;     /* Header/footer bg */
    --color-secondary: #16213e;   /* Buttons, cards */
    --color-accent: #e94560;      /* Links, highlights */
    --color-text: #eaeaea;        /* Main text */
    --color-text-muted: #a0a0a0;  /* Secondary text */
    --color-bg: #0f0f23;          /* Page background */
    --color-bg-card: #1a1a2e;     /* Card background */
    --color-border: #2a2a4a;      /* Borders */
}
```

### Changing Fonts

```css
:root {
    --font-primary: 'Your Font', -apple-system, sans-serif;
}
```

Don't forget to enqueue the font in `functions.php` if using Google Fonts.

### Changing Layout

```css
:root {
    --container-max: 1200px;      /* Max content width */
    --border-radius: 8px;         /* Rounded corners */
    --spacing-md: 1rem;           /* Base spacing unit */
}
```

### Adding Custom Image Sizes

In `functions.php`, find `anime_theme_setup()`:

```php
// Add new size
add_image_size('custom-size', 300, 200, true);
```

Regenerate thumbnails after adding sizes.

---

## 🤖 Automation with Free AI (Gemini)

You can automate content addition using Google's free Gemini API.

### Method 1: WordPress REST API + Gemini

#### Step 1: Enable REST API

Already enabled by default in WordPress.

#### Step 2: Get Gemini API Key

1. Go to https://makersuite.google.com/app/apikey
2. Create a new API key (FREE tier available)
3. Save it securely

#### Step 3: Create Automation Script

Create `automation/add-episode.php` in your theme:

```php
<?php
/**
 * Automation script to add episodes via Gemini
 * Run via CLI or cron
 */

// WordPress bootstrap
require_once('/path/to/wp-load.php');

// Gemini API
$gemini_api_key = 'YOUR_API_KEY_HERE';
$gemini_url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $gemini_api_key;

/**
 * Ask Gemini to generate episode data
 */
function ask_gemini($prompt, $api_key) {
    $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $api_key;
    
    $data = [
        'contents' => [
            ['parts' => [['text' => $prompt]]]
        ]
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $result = json_decode($response, true);
    return $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
}

/**
 * Create episode via WordPress
 */
function create_episode($title, $series_id, $episode_num, $links) {
    $post_data = [
        'post_title'  => $title,
        'post_type'   => 'episode',
        'post_status' => 'publish',
    ];
    
    $post_id = wp_insert_post($post_data);
    
    if ($post_id) {
        update_post_meta($post_id, '_series_id', $series_id);
        update_post_meta($post_id, '_episode_number', $episode_num);
        update_post_meta($post_id, '_subtitle_type', 'sub');
        update_post_meta($post_id, '_streaming_links', $links);
    }
    
    return $post_id;
}

// Example usage:
// $prompt = "Generate a JSON object with title and description for Naruto Episode 5";
// $response = ask_gemini($prompt, $gemini_api_key);
// Parse and use the response...
```

### Method 2: Using n8n (Free Self-Hosted)

n8n is a free, self-hosted automation tool.

#### Workflow:
1. **Trigger:** Webhook or Schedule
2. **HTTP Request:** Fetch episode data from source
3. **Gemini Node:** Process/enhance data
4. **WordPress Node:** Create post via REST API

#### Setup:
1. Install n8n: `npm install -g n8n`
2. Run: `n8n start`
3. Access: http://localhost:5678
4. Create workflow with WordPress + HTTP nodes

### Method 3: Python Script with Schedule

```python
# automation.py
import requests
import google.generativeai as genai
from datetime import datetime

# Config
GEMINI_API_KEY = "your-key"
WP_REST_URL = "https://yoursite.com/wp-json/wp/v2"
WP_USER = "username"
WP_APP_PASSWORD = "xxxx xxxx xxxx xxxx"

genai.configure(api_key=GEMINI_API_KEY)
model = genai.GenerativeModel('gemini-pro')

def generate_description(anime_name, episode_num):
    prompt = f"Write a 2-sentence SEO description for {anime_name} Episode {episode_num}"
    response = model.generate_content(prompt)
    return response.text

def create_episode(title, series_id, episode_num, links):
    auth = (WP_USER, WP_APP_PASSWORD)
    
    # First create the post
    post_data = {
        'title': title,
        'status': 'publish',
    }
    
    response = requests.post(
        f"{WP_REST_URL}/episode",
        auth=auth,
        json=post_data
    )
    
    if response.status_code == 201:
        post_id = response.json()['id']
        
        # Update meta (requires additional REST API setup)
        # Or use direct database connection
        
        print(f"Created episode {post_id}")
        return post_id
    
    return None

# Schedule with cron or use schedule library
# pip install schedule
import schedule
import time

def job():
    # Your automation logic here
    pass

schedule.every().day.at("10:00").do(job)

while True:
    schedule.run_pending()
    time.sleep(60)
```

### Method 4: WP-CLI + Bash Script

```bash
#!/bin/bash
# add-episode.sh

SERIES_ID=123
EPISODE_NUM=5
TITLE="Naruto Episode $EPISODE_NUM"

# Create post
POST_ID=$(wp post create --post_type=episode --post_title="$TITLE" --post_status=publish --porcelain)

# Add meta
wp post meta update $POST_ID _series_id $SERIES_ID
wp post meta update $POST_ID _episode_number $EPISODE_NUM
wp post meta update $POST_ID _subtitle_type "sub"

echo "Created episode $POST_ID"
```

### Tips for Automation

1. **Use Application Passwords** for WordPress REST API auth
2. **Validate all data** before inserting
3. **Add rate limiting** to avoid API quota issues
4. **Log everything** for debugging
5. **Test in staging first**

---

## ⚡ Performance Optimization

### Already Implemented

1. **No jQuery** - Vanilla JS only
2. **Emoji disabled** - Removes emoji scripts
3. **Clean head** - Removes unnecessary meta
4. **Lazy loading** - Native `loading="lazy"` on images/iframes
5. **Deferred JS** - Scripts load after HTML
6. **Single CSS file** - Reduces HTTP requests
7. **Single JS file** - Minimal scripts

### Additional Steps

#### 1. Enable Caching
Use a caching plugin:
- LiteSpeed Cache (if using LiteSpeed server)
- WP Super Cache
- W3 Total Cache

#### 2. Use Cloudflare (Free)
1. Sign up at cloudflare.com
2. Add your domain
3. Enable:
   - Auto minify CSS/JS
   - Brotli compression
   - Caching
   - Page Rules for static content

#### 3. Optimize Images
Before uploading, optimize with:
- TinyPNG (web)
- ImageOptim (Mac)
- ShortPixel (WordPress plugin)

#### 4. Database Optimization
Use WP-Optimize plugin monthly to:
- Clean revisions
- Remove spam comments
- Optimize tables

### Performance Goals

| Metric | Target |
|--------|--------|
| LCP (Largest Contentful Paint) | < 2.5s |
| FID (First Input Delay) | < 100ms |
| CLS (Cumulative Layout Shift) | < 0.1 |
| PageSpeed Score | > 90 |

---

## 🔐 Scaling & Safety

### Backup Strategy

1. **Daily Database Backups**
   - Use UpdraftPlus (free)
   - Store on Google Drive/Dropbox

2. **Weekly Full Backups**
   - Database + files
   - Keep 4 weeks of backups

### Export Theme/Content

```bash
# Export theme
zip -r theme-backup.zip /wp-content/themes/anime-starter-theme/

# Export database
wp db export backup.sql
```

### Domain Swap Ready

If you need to move domains:
1. Export database
2. Search-replace old domain: `wp search-replace 'old.com' 'new.com'`
3. Upload files to new host
4. Update DNS

### Ad Integration (Hooks)

Don't hardcode ads! Use hooks:

```php
// In functions.php - create ad hooks
function anime_before_player() {
    do_action('anime_before_player');
}

function anime_after_player() {
    do_action('anime_after_player');
}

// Add ads via hook (can be in child theme or plugin)
add_action('anime_before_player', function() {
    echo '<div class="ad-slot"><!-- Ad code here --></div>';
});
```

Then in templates:
```php
<?php anime_before_player(); ?>
<!-- Player HTML -->
<?php anime_after_player(); ?>
```

---

## ❓ Troubleshooting

### Episodes Not Showing

1. Check Series ID is set in episode
2. Verify episode number is set
3. Check post status is "Published"
4. Flush permalinks (Settings > Permalinks > Save)

### 404 Errors on Archives

1. Go to Settings > Permalinks
2. Click "Save Changes" (no actual changes needed)
3. This flushes rewrite rules

### Player Not Loading

1. Check streaming URL is correct
2. Verify URL is embed-compatible (not direct video)
3. Check browser console for errors
4. Test URL directly in browser

### Styles Not Loading

1. Verify `style.css` exists in theme root
2. Check `wp_head()` is in `header.php`
3. Clear any caching
4. Check for PHP errors in functions.php

### JavaScript Not Working

1. Verify `main.js` exists in `assets/js/`
2. Check `wp_footer()` is in `footer.php`
3. Check browser console for errors
4. Ensure no jQuery dependency (we don't use it)

### Meta Boxes Not Saving

1. Check nonce verification in save function
2. Verify user has edit permissions
3. Check for PHP errors
4. Ensure field names match in form and save function

### Images Not Displaying

1. Check featured image is set
2. Verify image file exists in uploads
3. Check image size is registered
4. Regenerate thumbnails if needed

---

## 🚀 Next Steps

1. **Add screenshot.png** (1200x900) to theme folder
2. **Create menus** in WordPress admin
3. **Add initial content** (genres, series, episodes)
4. **Test all pages** thoroughly
5. **Set up backups** before going live
6. **Configure caching** for performance
7. **Add Cloudflare** for CDN/security
8. **Implement automation** as content grows

---

## 📞 Support

For questions or issues:
1. Re-read this documentation
2. Check WordPress debug log
3. Test in default theme to isolate issues
4. Search WordPress.org forums

---

**Built for scale. Built for speed. Built for SEO.**

Good luck with your anime streaming site! 🎬
