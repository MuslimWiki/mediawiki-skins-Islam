#!/usr/bin/env python3
"""
Islam Skin Documentation Link Checker

This script checks for broken links in the documentation.
It verifies both internal and external links.
"""

import os
import re
import sys
import requests
from urllib.parse import urlparse
from pathlib import Path
from concurrent.futures import ThreadPoolExecutor, as_completed

# Configuration
DOCS_DIR = Path(__file__).parent.parent  # Assumes script is in docs/scripts/
EXTERNAL_TIMEOUT = 10  # seconds
MAX_WORKERS = 5  # Number of concurrent requests

# Ignore these URL patterns
IGNORE_PATTERNS = [
    r'^#',  # Anchor links
    r'^mailto:',
    r'^tel:',
    r'^javascript:',
    r'\.(png|jpg|jpeg|gif|svg|ico)$',  # Image files
]

class LinkChecker:
    def __init__(self, root_dir):
        self.root_dir = Path(root_dir).resolve()
        self.checked_links = set()
        self.broken_links = []
        self.session = requests.Session()
        self.session.headers.update({
            'User-Agent': 'IslamSkinDocsLinkChecker/1.0'
        })

    def is_external(self, url):
        """Check if URL is external."""
        return bool(urlparse(url).netloc)

    def should_ignore(self, url):
        """Check if URL should be ignored."""
        return any(re.match(pattern, url) for pattern in IGNORE_PATTERNS)

    def check_url(self, url, source_file, line_number):
        """Check if a URL is accessible."""
        if url in self.checked_links or self.should_ignore(url):
            return

        self.checked_links.add(url)
        
        if self.is_external(url):
            try:
                response = self.session.head(url, allow_redirects=True, timeout=EXTERNAL_TIMEOUT)
                if response.status_code >= 400:
                    self.broken_links.append({
                        'file': str(source_file.relative_to(self.root_dir)),
                        'line': line_number,
                        'url': url,
                        'status': response.status_code,
                        'type': 'external'
                    })
            except Exception as e:
                self.broken_links.append({
                    'file': str(source_file.relative_to(self.root_dir)),
                    'line': line_number,
                    'url': url,
                    'error': str(e),
                    'type': 'external'
                })
        else:
            # Handle internal links
            if url.startswith('/'):
                target_path = self.root_dir / url.lstrip('/')
            else:
                target_path = (source_file.parent / url).resolve()
            
            # Check if file exists
            if not target_path.exists():
                self.broken_links.append({
                    'file': str(source_file.relative_to(self.root_dir)),
                    'line': line_number,
                    'url': url,
                    'error': 'File not found',
                    'type': 'internal'
                })
            # Check for anchor in the file
            elif '#' in url:
                anchor = url.split('#')[1]
                with open(target_path, 'r', encoding='utf-8') as f:
                    content = f.read()
                    if f'<a id="{anchor}"' not in content and f'<a name="{anchor}"' not in content:
                        self.broken_links.append({
                            'file': str(source_file.relative_to(self.root_dir)),
                            'line': line_number,
                            'url': url,
                            'error': f'Anchor "{anchor}" not found',
                            'type': 'internal'
                        })

    def check_file(self, file_path):
        """Check all links in a file."""
        try:
            with open(file_path, 'r', encoding='utf-8') as f:
                content = f.read()
                
            # Find all markdown links [text](url)
            for match in re.finditer(r'\[([^\]]+)\]\(([^)]+)\)', content):
                url = match.group(2).split()[0]  # Get URL part, ignore title if present
                line_number = content[:match.start()].count('\n') + 1
                self.check_url(url, file_path, line_number)
                
        except Exception as e:
            print(f"Error processing {file_path}: {e}", file=sys.stderr)

    def run_checks(self):
        """Run link checks on all markdown files."""
        markdown_files = list(self.root_dir.rglob('*.md'))
        
        print(f"Checking {len(markdown_files)} markdown files...")
        
        with ThreadPoolExecutor(max_workers=MAX_WORKERS) as executor:
            futures = []
            for file_path in markdown_files:
                futures.append(executor.submit(self.check_file, file_path))
            
            # Wait for all tasks to complete
            for future in as_completed(futures):
                future.result()
        
        return self.broken_links

def main():
    checker = LinkChecker(DOCS_DIR)
    broken_links = checker.run_checks()
    
    if broken_links:
        print("\nBroken links found:")
        for link in broken_links:
            print(f"\nFile: {link['file']}:{link['line']}")
            print(f"URL: {link['url']}")
            print(f"Type: {link['type']}")
            if 'status' in link:
                print(f"Status: {link['status']}")
            if 'error' in link:
                print(f"Error: {link['error']}")
        sys.exit(1)
    else:
        print("\nNo broken links found!")
        sys.exit(0)

if __name__ == "__main__":
    main()
