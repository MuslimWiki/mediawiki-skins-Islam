<?php
/**
 * Recursively scan directory for markdown files
 */
function scanDirectory($dir, $baseDir = '') {
    $result = [];
    $files = scandir($dir);
    
    // Sort files and directories (directories first, then files, both alphabetically)
    usort($files, function($a, $b) use ($dir) {
        $aIsDir = is_dir($dir . '/' . $a);
        $bIsDir = is_dir($dir . '/' . $b);
        
        if ($aIsDir === $bIsDir) {
            return strcasecmp($a, $b);
        }
        return $aIsDir ? -1 : 1;
    });
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..' || $file === '.git' || $file === 'node_modules' || $file === 'vendor') {
            continue;
        }
        
        $path = $dir . '/' . $file;
        $relativePath = ltrim(($baseDir ? $baseDir . '/' : '') . $file, '/');
        
        if (is_dir($path)) {
            // Skip directories that don't contain markdown files
            $hasMarkdown = false;
            $dirFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
            foreach ($dirFiles as $dirFile) {
                if ($dirFile->isFile() && $dirFile->getExtension() === 'md') {
                    $hasMarkdown = true;
                    break;
                }
            }
            
            if ($hasMarkdown) {
                $children = scanDirectory($path, $relativePath);
                if (!empty($children)) {
                    $result[] = [
                        'title' => ucwords(str_replace(['-', '_'], ' ', $file)),
                        'file' => $relativePath . '/README.md',
                        'children' => $children
                    ];
                }
            }
        } elseif (pathinfo($path, PATHINFO_EXTENSION) === 'md') {
            // Skip README.md files as they're handled by their parent directory
            if (basename($file) === 'README.md' && $baseDir !== '') {
                continue;
            }
            
            $title = pathinfo($file, PATHINFO_FILENAME);
            $title = str_replace(['-', '_'], ' ', $title);
            $title = ucwords($title);
            
            $result[] = [
                'title' => $title,
                'file' => $relativePath
            ];
        }
    }
    
    return $result;
}

// Configuration
$config = [
    'default_file' => 'README.md',
    'docs_dir' => __DIR__,
    'title' => 'Islam Skin Documentation'
];

// Generate navigation dynamically
$config['navigation'] = scanDirectory($config['docs_dir']);

// Get requested file
$requestedFile = isset($_GET['file']) ? $_GET['file'] : $config['default_file'];
$filePath = realpath($config['docs_dir'] . '/' . $requestedFile);

// Security check: Prevent directory traversal
if (strpos($filePath, $config['docs_dir']) !== 0) {
    http_response_code(403);
    die('Access denied');
}

// Check if file exists and is readable
if (!is_file($filePath) || !is_readable($filePath)) {
    http_response_code(404);
    $content = "# 404 - File Not Found\n\nThe requested document could not be found.";
    $title = 'Not Found';
} else {
    // Read and parse Markdown
    $content = file_get_contents($filePath);
    $title = pathinfo($filePath, PATHINFO_FILENAME);
    $title = str_replace(['-', '_'], ' ', $title);
    $title = ucwords($title);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title) . ' - ' . $config['title']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/github.min.css" id="highlight-light">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/github-dark.min.css" id="highlight-dark" disabled>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.2.0/github-markdown.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Light Theme (Default) */
            --primary-color: #2c7be5;
            --primary-hover: #1a68d1;
            --folder-color: #6c757d;
            --folder-bg-hover: rgba(108, 117, 125, 0.1);
            --folder-color: #6c757d;
            --folder-bg-hover: rgba(108, 117, 125, 0.1);
            --sidebar-width: 280px;
            --header-height: 60px;
            --border-color: #e3e7ed;
            --bg-color: #f8fafc;
            --content-bg: #ffffff;
            --text-color: #2d3748;
            --text-muted: #64748b;
            --sidebar-bg: #f1f5f9;
            --sidebar-text: #334155;
            --sidebar-hover: #e2e8f0;
            --link-color: #2563eb;
            --link-hover: #1d4ed8;
            --code-bg: #f1f5f9;
            --code-color: #dc2626;
            --blockquote-bg: #f8fafc;
            --blockquote-border: #e2e8f0;
            --shadow-color: rgba(0, 0, 0, 0.05);
            --theme-toggle-icon: '☀️';
        }

        [data-theme="dark"] {
            --primary-color: #3b82f6;
            --primary-hover: #60a5fa;
            --border-color: #374151;
            --bg-color: #111827;
            --content-bg: #1f2937;
            --text-color: #f3f4f6;
            --text-muted: #9ca3af;
            --sidebar-bg: #111827;
            --sidebar-text: #e5e7eb;
            --sidebar-hover: #1f2937;
            --link-color: #60a5fa;
            --link-hover: #93c5fd;
            --code-bg: #1f2937;
            --code-color: #f87171;
            --blockquote-bg: #1f2937;
            --blockquote-border: #4b5563;
            --shadow-color: rgba(0, 0, 0, 0.3);
            --theme-toggle-icon: '🌙';
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            line-height: 1.7;
            color: var(--text-color);
            background-color: var(--bg-color);
            display: flex;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-size: 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: var(--content-bg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 2px 10px var(--shadow-color);
            transition: all 0.3s ease;
            color: var(--text-color);
            font-size: 1.2rem;
            outline: none;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow-color);
            background: var(--sidebar-hover);
        }

        .theme-toggle:active {
            transform: translateY(0);
        }
        
        .theme-toggle:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            height: 100vh;
            position: fixed;
            overflow-y: auto;
            padding: 1.5rem 1rem;
            box-shadow: 1px 0 10px var(--shadow-color);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .sidebar h2 {
            padding: 0 0.5rem 1rem;
            border-bottom: 1px solid var(--border-color);
            margin: 0 0 1rem;
            color: var(--text-color);
            font-size: 1.4rem;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar > ul > li {
            margin-bottom: 0.25rem;
        }
        
        .sidebar ul ul {
            margin-left: 1rem;
            padding-left: 0.5rem;
            border-left: 1px solid var(--border-color);
            margin-top: 0.25rem;
            margin-bottom: 0.5rem;
        }
        
        .sidebar ul ul ul {
            margin-left: 0.75rem;
            padding-left: 0.5rem;
        }
        
        .sidebar li.has-children > a {
            font-weight: 600;
        }
        
        .sidebar li a {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem 0.5rem 2rem;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .folder > a {
            font-weight: 600;
            color: var(--folder-color) !important;
            padding-left: 1rem !important;
        }
        
        .folder > a:before {
            content: '📁';
            margin-right: 0.5rem;
            font-size: 1em;
        }
        
        .folder.collapsed > a:before {
            content: '📂';
        }
        
        .folder > a .folder-toggle {
            position: absolute;
            left: 0.25rem;
            cursor: pointer;
            user-select: none;
            width: 1.5rem;
            text-align: center;
        }
        
        .folder > ul {
            margin-left: 1rem;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
            max-height: 1000px;
        }
        
        .folder.collapsed > ul {
            max-height: 0;
            display: none;
        }
        
        .sidebar li a:hover,
        .sidebar li a:focus {
            background-color: var(--sidebar-hover);
            color: var(--primary-color);
        }
        
        .sidebar li a.active {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        .content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            max-width: 1200px;
            background: var(--bg-color);
            min-height: 100vh;
        }

        .markdown-body {
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
            color: var(--text-color);
            transition: color 0.3s ease, background-color 0.3s ease;
            background: white;
            padding: 2rem;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        [data-theme="dark"] .markdown-body {
            background: var(--content-bg);
        }

        /* Smooth transitions for theme changes */
        .markdown-body * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
        
        .markdown-body h1 {
            color: var(--text-color);
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .markdown-body h2 {
            color: var(--text-color);
            font-size: 1.7rem;
            margin: 2.5rem 0 1rem;
            padding-bottom: 0.3rem;
        }
        
        .markdown-body h3 {
            color: var(--text-color);
            font-size: 1.3rem;
            margin: 2rem 0 1rem;
        }
        
        .markdown-body p {
            margin: 1.2rem 0;
            color: var(--text-color);
        }
        
        .markdown-body a {
            color: var(--link-color);
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .markdown-body a:hover {
            color: var(--link-hover);
            text-decoration: underline;
        }
        
        .markdown-body code {
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            background: var(--code-bg);
            color: var(--code-color);
            padding: 0.2em 0.4em;
            border-radius: 3px;
            font-size: 0.9em;
        }
        
        .markdown-body pre {
            background: var(--code-bg);
            border-radius: 6px;
            padding: 1.2rem;
            overflow-x: auto;
            margin: 1.5rem 0;
            border: 1px solid var(--border-color);
        }
        
        .markdown-body pre code {
            background: transparent;
            padding: 0;
            color: var(--text-color);
        }
        
        .markdown-body blockquote {
            border-left: 4px solid var(--blockquote-border);
            background: var(--blockquote-bg);
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            color: var(--text-muted);
        }
        
        .markdown-body ul, 
        .markdown-body ol {
            margin: 1.2rem 0;
            padding-left: 1.8rem;
        }
        
        .markdown-body li {
            margin: 0.5rem 0;
        }

        @media (max-width: 1024px) {
            .content {
                padding: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                max-height: 50vh;
                position: relative;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
                box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
            }

            .content {
                margin-left: 0;
                padding: 2rem 1.5rem;
            }
        }

        /* Syntax highlighting */
        .hljs {
            background: var(--code-bg) !important;
            border-radius: 6px;
            padding: 1.2rem !important;
            font-size: 0.9em;
            line-height: 1.6;
        }

        /* Tables */
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 1.5rem 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        th, td {
            border: 1px solid var(--border-color);
            padding: 0.75rem 1rem;
            text-align: left;
        }

        th {
            background: var(--sidebar-bg);
            font-weight: 600;
            color: var(--text-color);
        }
        
        tr:nth-child(even) {
            background-color: var(--bg-color);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><?php echo htmlspecialchars($config['title']); ?></h2>
        <ul>
            <?php 
            function renderNavigation($items, $level = 0) {
                global $requestedFile;
                $output = '';
                
                foreach ($items as $item) {
                    $isActive = $requestedFile === $item['file'] || 
                               (isset($item['children']) && 
                                in_array($requestedFile, array_column($item['children'], 'file')));
                    $hasChildren = !empty($item['children']);
                    $url = '?file=' . urlencode($item['file']);
                    
                    if (isset($item['children'])) {
                        $output .= '<li class="folder' . ($level > 0 ? ' nested' : '') . '">';
                        $output .= '<a href="' . htmlspecialchars($item['file'] ?? '#') . '">' . 
                                  htmlspecialchars($item['title']) . '</a>';
                        $output .= '<ul>' . renderNavigation($item['children'], $level + 1) . '</ul>';
                        $output .= '</li>';
                    } else {
                        $output .= '<li><a href="' . htmlspecialchars($item['file']) . '">' . 
                                  htmlspecialchars($item['title']) . '</a></li>';
                    }
                }
                
                return $output;
            }
            
            echo renderNavigation($config['navigation']);
            ?>
        </ul>
    </div>

    <div class="content">
        <div class="markdown-body">
            <?php
            // Simple Markdown parser
            function parseMarkdown($text) {
                // Headers
                $text = preg_replace('/^# (.*$)/m', '<h1>$1</h1>', $text);
                $text = preg_replace('/^## (.*$)/m', '<h2>$1</h2>', $text);
                $text = preg_replace('/^### (.*$)/m', '<h3>$1</h3>', $text);
                
                // Bold and Italic
                $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
                $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
                
                // Links
                $text = preg_replace('/\[(.*?)\]\((.*?)\)/', '<a href="$2">$1</a>', $text);
                
                // Lists
                $text = preg_replace('/^\* (.*$)/m', '<li>$1</li>', $text);
                $text = preg_replace('/(<li>.*<\/li>)/s', '<ul>$1</ul>', $text);
                
                // Code blocks
                $text = preg_replace('/```(.*?)```/s', '<pre><code>$1</code></pre>', $text);
                
                // Inline code
                $text = preg_replace('/`(.*?)`/', '<code>$1</code>', $text);
                
                // Paragraphs
                $text = '<p>' . preg_replace('/\n\n/', '</p><p>', $text) . '</p>';
                $text = str_replace("<p>\n", "<p>", $text);
                
                // Line breaks
                $text = str_replace("\n", "<br>", $text);
                
                return $text;
            }
            
            // Display the content
            echo '<h1>' . htmlspecialchars($title) . '</h1>';
            // Ensure content is properly escaped and parsed with error handling
            try {
                if (!file_exists($filePath)) {
                    throw new Exception("File not found");
                }
                
                $content = @file_get_contents($filePath);
                if ($content === false) {
                    $error = error_get_last();
                    throw new Exception($error['message'] ?? 'Unknown error reading file');
                }
                
                // Check if the file is readable
                if (!is_readable($filePath)) {
                    throw new Exception("Permission denied. The file is not readable.");
                }
                
                // Output the parsed markdown
                echo parseMarkdown(htmlspecialchars($content, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                
            } catch (Exception $e) {
                echo '<div class="error">';
                echo '<h2>Error Loading Content</h2>';
                echo '<p>Could not load the requested document.</p>';
                if (strpos($e->getMessage(), 'Permission denied') !== false) {
                    echo '<p><strong>Permission Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
                    echo '<p>Please check the file permissions for the documentation files.</p>';
                } else {
                    echo '<p><strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
                }
                echo '<p><a href=".">Return to documentation home</a></p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Theme Toggle Button -->
    <button class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
        <i class="fas fa-moon" id="theme-icon"></i>
    </button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        // Theme switcher and folder toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const highlightLight = document.getElementById('highlight-light');
            const highlightDark = document.getElementById('highlight-dark');
            
            // Load saved theme or use system preference
            if (localStorage.getItem('theme') === 'dark' || 
                (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.setAttribute('data-theme', 'dark');
                themeToggle.checked = true;
                highlightLight.disabled = true;
                highlightDark.disabled = false;
            }
            
            themeToggle.addEventListener('change', function() {
                if (this.checked) {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                    highlightLight.disabled = true;
                    highlightDark.disabled = false;
                } else {
                    document.documentElement.removeAttribute('data-theme');
                    localStorage.setItem('theme', 'light');
                    highlightLight.disabled = false;
                    highlightDark.disabled = true;
                }
            });
            
            // Normalize a URL path to prevent double slashes and resolve relative paths
            function normalizePath(path) {
                // If it's already a full URL, return it as is
                if (path.startsWith('http')) {
                    return path;
                }
                
                // Remove any leading slash and ./
                let normalized = path.replace(/\.\//g, '').replace(/^\/+/g, '');
                
                // Handle hash fragments
                const hashIndex = normalized.indexOf('#');
                let hash = '';
                if (hashIndex > -1) {
                    hash = normalized.substring(hashIndex);
                    normalized = normalized.substring(0, hashIndex);
                }
                
                // If it's already a root path, just clean it up
                if (normalized.startsWith('/')) {
                    return normalized.replace(/\.md$/, '') + hash;
                }
                
                // For relative paths, just return as is - we'll handle the base URL in loadContent
                return normalized.replace(/\.md$/, '') + hash;
            }
            
            // Handle all link clicks in the documentation
            document.addEventListener('click', function(e) {
                // Find the closest link that was clicked
                const link = e.target.closest('a');
                
                // If no link was clicked, or it's a hash link, or it's an external link, let it behave normally
                if (!link || link.getAttribute('href').startsWith('#') || 
                    link.hostname !== window.location.hostname) {
                    return true;
                }
                
                // Handle folder toggles
                if (e.target.closest('.folder > a')) {
                    const folder = link.parentElement;
                    const toggle = link.querySelector('.folder-toggle');
                    
                    // Only proceed if clicking the toggle or the link itself (not a child element)
                    if (e.target === link || e.target === toggle) {
                        e.preventDefault();
                        
                        // Toggle collapsed state
                        const wasCollapsed = folder.classList.toggle('collapsed');
                        
                        // Update toggle icon
                        if (toggle) {
                            toggle.textContent = wasCollapsed ? '▾' : '▸';
                        }
                        
                        // Save folder state
                        const folderId = folder.getAttribute('data-folder-id') || 
                                      'folder-' + Math.random().toString(36).substr(2, 9);
                        folder.setAttribute('data-folder-id', folderId);
                        
                        if (wasCollapsed) {
                            localStorage.removeItem('folder-' + folderId);
                        } else {
                            localStorage.setItem('folder-' + folderId, 'collapsed');
                        }
                    }
                    return;
                }
                
                // Handle all internal documentation links
                e.preventDefault();
                
                // Get the clean path
                const href = link.getAttribute('href');
                let cleanPath = normalizePath(href);
                
                // If it's a markdown file, remove the .md extension for cleaner URLs
                if (cleanPath.endsWith('.md')) {
                    cleanPath = cleanPath.replace(/\.md$/, '');
                }
                
                // Update the URL without page reload
                history.pushState({}, '', cleanPath);
                
                // Load the content
                loadContent(cleanPath);
                
                // Update active states
                updateActiveNav();
            });
            
            // Load content via AJAX
            function loadContent(path) {
                // Show loading indicator
                const contentArea = document.querySelector('.content');
                contentArea.innerHTML = '<div class="loading">Loading content...</div>';
                
                // Clean up the path
                let cleanPath = path.replace(/^\/+/, ''); // Remove leading slashes
                
                // Handle hash fragments
                const hashIndex = cleanPath.indexOf('#');
                let hash = '';
                if (hashIndex > -1) {
                    hash = cleanPath.substring(hashIndex);
                    cleanPath = cleanPath.substring(0, hashIndex);
                }
                
                // Define the base path for the documentation
                const docsBasePath = '/dev.muslim.wiki/htdocs/skins/Islam/docs';
                
                // Build the correct URL based on the current environment
                let url;
                if (window.location.hostname === 'localhost') {
                    // For local development - use the current port
                    const port = window.location.port ? ':' + window.location.port : '';
                    const baseUrl = `${window.location.protocol}//${window.location.hostname}${port}${docsBasePath}`;
                    
                    // If the path doesn't already have .md extension, add it
                    if (cleanPath && !cleanPath.endsWith('.md') && !cleanPath.endsWith('/') && cleanPath !== '') {
                        cleanPath += '.md';
                    }
                    
                    // Ensure we don't have double slashes
                    const fullPath = `${cleanPath ? '/' + cleanPath : ''}`.replace(/\/+/g, '/');
                    url = new URL(fullPath, baseUrl);
                } else {
                    // For production
                    const fullPath = `${docsBasePath}${cleanPath ? '/' + cleanPath : ''}`.replace(/\/+/g, '/');
                    url = new URL(fullPath, window.location.origin);
                }
                
                // Add back hash if it exists
                if (hash) {
                    url.hash = hash;
                }
                
                // Add timestamp to prevent caching issues
                url.searchParams.set('t', new Date().getTime());
                
                // For local development, we need to adjust the path
                if (window.location.hostname === 'localhost' && !cleanPath.startsWith('http')) {
                    // Remove any duplicate path segments
                    let pathParts = url.pathname.split('/').filter(part => part);
                    let uniqueParts = [];
                    pathParts.forEach(part => {
                        if (part !== uniqueParts[uniqueParts.length - 1]) {
                            uniqueParts.push(part);
                        }
                    });
                    url.pathname = '/' + uniqueParts.join('/');
                }
                
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    },
                    credentials: 'same-origin' // Send cookies with the request
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(html => {
                    // Create a temporary container to parse the response
                    const temp = document.createElement('div');
                    temp.innerHTML = html;
                    
                    // Extract the content from the response
                    let content = temp.querySelector('.content');
                    
                    // If we can't find .content, try to find the main content area
                    if (!content) {
                        content = temp.querySelector('main') || temp.querySelector('article') || 
                                 temp.querySelector('.markdown-body') || temp.querySelector('body');
                    }
                    
                    if (content) {
                        // Update the content area
                        contentArea.innerHTML = content.innerHTML;
                        
                        // Re-apply syntax highlighting with security options
                        document.querySelectorAll('pre code').forEach(block => {
                            try {
                                // Create a text node to safely escape HTML
                                const textNode = document.createTextNode(block.textContent);
                                block.textContent = ''; // Clear existing content
                                block.appendChild(textNode); // Add back as escaped text
                                
                                // Highlight with security options
                                hljs.highlightElement(block, {
                                    language: block.className.replace('language-', '').replace('hljs ', '').trim(),
                                    ignoreIllegals: true
                                });
                            } catch (e) {
                                console.warn('Error highlighting code block:', e);
                            }
                        });
                        
                        // Scroll to top
                        window.scrollTo(0, 0);
                    } else {
                        throw new Error('Could not find content in the response');
                    }
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    contentArea.innerHTML = `
                        <div class="error">
                            <h2>Error Loading Content</h2>
                            <p>Could not load the requested document: ${error.message}</p>
                            <p>URL: ${url}</p>
                            <p><a href=".">Return to documentation home</a></p>
                        </div>
                    `;
                });
            }
            
            // Update active navigation state
            function updateActiveNav() {
                const currentPath = window.location.pathname + (window.location.search || '') + (window.location.hash || '');
                
                document.querySelectorAll('.sidebar a').forEach(link => {
                    const linkPath = new URL(link.href).pathname + 
                                   (new URL(link.href).search || '') + 
                                   (new URL(link.href).hash || '');
                    
                    link.classList.toggle('active', linkPath === currentPath);
                    
                    // Expand parent folders of active link
                    if (linkPath === currentPath) {
                        let parent = link.parentElement;
                        while (parent) {
                            if (parent.classList && parent.classList.contains('folder')) {
                                parent.classList.remove('collapsed');
                                const toggle = parent.querySelector('.folder-toggle');
                                if (toggle) toggle.textContent = '▾';
                            }
                            parent = parent.parentElement;
                            if (!parent || (parent.classList && parent.classList.contains('sidebar'))) break;
                        }
                    }
                });
            }
            
            // Initialize folder states from localStorage
            function initFolders() {
                document.querySelectorAll('.folder').forEach(folder => {
                    const folderId = folder.getAttribute('data-folder-id') || 
                                   'folder-' + Math.random().toString(36).substr(2, 9);
                    folder.setAttribute('data-folder-id', folderId);
                    
                    // Add toggle button if not exists
                    const link = folder.querySelector('> a');
                    if (link && !link.querySelector('.folder-toggle')) {
                        const toggle = document.createElement('span');
                        toggle.className = 'folder-toggle';
                        toggle.textContent = '▸';
                        link.prepend(toggle);
                    }
                    
                    // Restore collapsed state
                    const isCollapsed = localStorage.getItem('folder-' + folderId) === 'collapsed';
                    folder.classList.toggle('collapsed', isCollapsed);
                    
                    // Update toggle icon
                    const toggle = folder.querySelector('.folder-toggle');
                    if (toggle) {
                        toggle.textContent = isCollapsed ? '▸' : '▾';
                    }
                });
                
                // Update active nav on initial load
                updateActiveNav();
            }
            
            // Get the base path for the documentation
            function getBasePath() {
                // Always return the full docs path
                return '/dev.muslim.wiki/htdocs/skins/Islam/docs';
            }
            
            // Initialize everything when the DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                initFolders();
                
                // Handle browser back/forward navigation
                window.addEventListener('popstate', function() {
                    let path = window.location.pathname;
                    // Remove the base path if present
                    const basePath = getBasePath();
                    if (basePath && path.startsWith(basePath)) {
                        path = path.substring(basePath.length);
                    }
                    loadContent(path || 'index.php');
                    updateActiveNav();
                });
                
                // Handle initial page load
                let currentPath = window.location.pathname;
                const basePath = getBasePath();
                if (basePath && currentPath.startsWith(basePath)) {
                    currentPath = currentPath.substring(basePath.length);
                }
                
                if (currentPath !== '/' && currentPath !== '/index.php' && currentPath !== 'index.php') {
                    loadContent(currentPath);
                }
            });
            // Apply syntax highlighting
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightElement(block);
            });
        });
    </script>
</body>
</html>
