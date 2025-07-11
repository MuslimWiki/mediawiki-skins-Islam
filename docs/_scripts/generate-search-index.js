#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const matter = require('gray-matter');
const { execSync } = require('child_process');

// Configuration
const DOCS_DIR = path.join(__dirname, '..');
const OUTPUT_FILE = path.join(DOCS_DIR, 'search-index.json');
const IGNORE_FILES = ['search.md', 'search-index.json', 'README.md', 'node_modules', '.git', '.github', 'assets', '_scripts'];

// Get all markdown files recursively
function getMarkdownFiles(dir, fileList = []) {
  const files = fs.readdirSync(dir);
  
  files.forEach(file => {
    const filePath = path.join(dir, file);
    const stat = fs.statSync(filePath);
    
    if (IGNORE_FILES.includes(file)) {
      return;
    }
    
    if (stat.isDirectory()) {
      getMarkdownFiles(filePath, fileList);
    } else if (file.endsWith('.md')) {
      fileList.push(filePath);
    }
  });
  
  return fileList;
}

// Process markdown files and generate search index
function generateSearchIndex() {
  const files = getMarkdownFiles(DOCS_DIR);
  const documents = [];
  
  files.forEach(file => {
    try {
      const content = fs.readFileSync(file, 'utf8');
      const { data: frontmatter, content: markdown } = matter(content);
      
      // Skip files with noindex: true in frontmatter
      if (frontmatter.noindex) return;
      
      // Generate URL path
      let url = path.relative(DOCS_DIR, file)
        .replace(/\\/g, '/') // Convert Windows paths to URLs
        .replace(/\/index\.md$/, '/') // Convert /path/index.md to /path/
        .replace(/\.md$/, '/'); // Convert /path/file.md to /path/file/
      
      // Add leading slash if needed
      if (!url.startsWith('/')) {
        url = '/' + url;
      }
      
      // Add to documents
      documents.push({
        title: frontmatter.title || path.basename(file, '.md').replace(/-/g, ' '),
        content: markdown.replace(/[#*`_\[\]()]/g, ' ').replace(/\s+/g, ' ').trim(),
        url: url,
        tags: Array.isArray(frontmatter.tags) ? frontmatter.tags.join(' ') : '',
        description: frontmatter.description || ''
      });
      
    } catch (error) {
      console.error(`Error processing ${file}:`, error);
    }
  });
  
  // Write search index
  fs.writeFileSync(
    OUTPUT_FILE,
    JSON.stringify({ docs: documents }, null, 2),
    'utf8'
  );
  
  console.log(`Search index generated with ${documents.length} documents at ${OUTPUT_FILE}`);
}

// Run the generator
try {
  // Ensure output directory exists
  if (!fs.existsSync(path.dirname(OUTPUT_FILE))) {
    fs.mkdirSync(path.dirname(OUTPUT_FILE), { recursive: true });
  }
  
  generateSearchIndex();
} catch (error) {
  console.error('Error generating search index:', error);
  process.exit(1);
}
