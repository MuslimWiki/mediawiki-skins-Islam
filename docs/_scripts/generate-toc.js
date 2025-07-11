#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const matter = require('gray-matter');
const markdownToc = require('markdown-toc');

// Configuration
const DOCS_DIR = path.join(__dirname, '..');
const IGNORE_FILES = ['search.md', 'search-index.json', 'README.md', 'node_modules', '.git', '.github', 'assets', '_scripts'];

// Get all markdown files recursively
function getMarkdownFiles(dir, fileList = []) {
  const files = fs.readdirSync(dir);
  
  files.forEach(file => {
    const filePath = path.join(dir, file);
    const stat = fs.statSync(filePath);
    
    if (IGNORE_FILES.includes(file) || IGNORE_FILES.some(ignored => filePath.includes(ignored))) {
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

// Generate TOC for a markdown file
function generateToc(filePath) {
  try {
    const content = fs.readFileSync(filePath, 'utf8');
    const { data: frontmatter, content: markdown, orig } = matter(content);
    
    // Skip files with notoc: true in frontmatter
    if (frontmatter.notoc) {
      console.log(`Skipping TOC for ${filePath} (notoc: true)`);
      return false;
    }
    
    // Generate TOC
    const tocOptions = {
      firsth1: false,
      maxdepth: 4,
      bullets: ['-', '  -', '    -', '      -'],
      linkify: function(tocItem) {
        return `[${tocItem.content}](#${tocItem.slug})`;
      }
    };
    
    const toc = markdownToc(markdown, tocOptions).content;
    
    if (!toc.trim()) {
      console.log(`No headings found in ${filePath}`);
      return false;
    }
    
    // Format TOC with header
    const tocContent = `## Table of Contents\n\n${toc}\n\n`;
    
    // Check if TOC already exists
    const tocRegex = /^##\s*Table of Contents[\s\S]*?\n\n/;
    let newContent = content;
    
    if (tocRegex.test(content)) {
      // Update existing TOC
      newContent = content.replace(tocRegex, tocContent);
    } else {
      // Insert TOC after the first heading
      const headingMatch = content.match(/^#.*$/m);
      if (headingMatch) {
        const insertPos = headingMatch.index + headingMatch[0].length;
        newContent = content.slice(0, insertPos) + '\n\n' + tocContent + content.slice(insertPos);
      } else {
        // No heading found, add TOC at the beginning
        newContent = tocContent + content;
      }
    }
    
    // Write the file if content changed
    if (newContent !== content) {
      fs.writeFileSync(filePath, newContent, 'utf8');
      console.log(`Updated TOC for ${path.relative(DOCS_DIR, filePath)}`);
      return true;
    }
    
    return false;
  } catch (error) {
    console.error(`Error processing ${filePath}:`, error);
    return false;
  }
}

// Generate TOC for all markdown files
function generateAllTocs() {
  const files = getMarkdownFiles(DOCS_DIR);
  let updatedCount = 0;
  
  console.log(`Generating TOCs for ${files.length} markdown files...`);
  
  files.forEach(file => {
    if (generateToc(file)) {
      updatedCount++;
    }
  });
  
  console.log(`\nDone! Updated ${updatedCount} of ${files.length} files.`);
  return updatedCount;
}

// Install required dependencies if not already installed
function ensureDependencies() {
  try {
    // Check if markdown-toc is installed
    require.resolve('markdown-toc');
    require.resolve('gray-matter');
  } catch (e) {
    console.log('Installing required dependencies...');
    try {
      const { execSync } = require('child_process');
      execSync('npm install --save-dev markdown-toc gray-matter', { stdio: 'inherit' });
      console.log('Dependencies installed successfully!');
    } catch (error) {
      console.error('Failed to install dependencies. Please run:');
      console.error('npm install --save-dev markdown-toc gray-matter');
      process.exit(1);
    }
  }
}

// Run the generator
function main() {
  ensureDependencies();
  
  // Check if a specific file was provided
  const fileArg = process.argv[2];
  
  if (fileArg) {
    const filePath = path.resolve(process.cwd(), fileArg);
    if (fs.existsSync(filePath)) {
      generateToc(filePath);
    } else {
      console.error(`File not found: ${filePath}`);
      process.exit(1);
    }
  } else {
    generateAllTocs();
  }
}

// Run the main function
main();
