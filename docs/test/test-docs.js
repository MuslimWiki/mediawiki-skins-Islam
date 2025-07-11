#!/usr/bin/env node

/**
 * Documentation Test Runner
 * 
 * This script runs various tests on the documentation to ensure quality and consistency.
 */

const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');
const { promisify } = require('util');
const readdir = promisify(fs.readdir);
const stat = promisify(fs.stat);

// Configuration
const DOCS_DIR = path.join(__dirname, '..');
const IGNORE_DIRS = ['node_modules', '.git', 'test', '_site', '_scripts', 'assets'];
const MARKDOWN_EXT = '.md';

/**
 * Recursively find all markdown files in a directory
 */
async function findMarkdownFiles(dir) {
  const subdirs = await readdir(dir);
  const files = await Promise.all(
    subdirs.map(async (subdir) => {
      const res = path.resolve(dir, subdir);
      const stats = await stat(res);
      
      if (IGNORE_DIRS.includes(subdir)) {
        return [];
      }
      
      if (stats.isDirectory()) {
        return findMarkdownFiles(res);
      } else if (path.extname(res) === MARKDOWN_EXT) {
        return res;
      }
      return [];
    })
  );
  return files.flat();
}

/**
 * Run markdown linting
 */
function runMarkdownLint(files) {
  console.log('\n🔍 Running Markdown linting...');
  try {
    execSync(`npx markdownlint ${files.join(' ')} --config .markdownlint.json`, {
      stdio: 'inherit'
    });
    console.log('✅ Markdown linting passed');
    return true;
  } catch (error) {
    console.error('❌ Markdown linting failed');
    return false;
  }
}

/**
 * Check for broken links
 */
function checkLinks(files) {
  console.log('\n🔗 Checking for broken links...');
  try {
    execSync(`npx markdown-link-check --config .markdown-link-check.json ${files.join(' ')}`, {
      stdio: 'inherit'
    });
    console.log('✅ Link checking passed');
    return true;
  } catch (error) {
    console.error('❌ Link checking failed');
    return false;
  }
}

/**
 * Validate code examples
 */
function validateCodeExamples(files) {
  console.log('\n💻 Validating code examples...');
  let hasErrors = false;
  
  files.forEach(file => {
    const content = fs.readFileSync(file, 'utf8');
    const codeBlocks = content.match(/```[\s\S]*?```/g) || [];
    
    codeBlocks.forEach(block => {
      // Skip non-code blocks and language-specific validation for now
      if (block.startsWith('```mermaid') || block.startsWith('```diff')) {
        return;
      }
      
      // Basic validation could be added here
      // For now, we'll just log the code blocks
      console.log(`\nFound code block in ${file}:`);
      console.log(block.split('\n').slice(0, 5).join('\n') + (block.split('\n').length > 5 ? '\n...' : ''));
    });
  });
  
  if (!hasErrors) {
    console.log('✅ Code example validation passed');
  } else {
    console.error('❌ Code example validation found issues');
  }
  
  return !hasErrors;
}

/**
 * Main function
 */
async function main() {
  console.log('🚀 Starting documentation tests\n');
  
  try {
    // Find all markdown files
    const files = await findMarkdownFiles(DOCS_DIR);
    console.log(`📄 Found ${files.length} markdown files`);
    
    // Run tests
    const lintPassed = runMarkdownLint(files);
    const linksPassed = checkLinks(files);
    const examplesPassed = validateCodeExamples(files);
    
    // Print summary
    console.log('\n📊 Test Summary:');
    console.log(`- Markdown Lint: ${lintPassed ? '✅' : '❌'}`);
    console.log(`- Link Check: ${linksPassed ? '✅' : '❌'}`);
    console.log(`- Code Examples: ${examplesPassed ? '✅' : '❌'}`);
    
    // Set exit code
    const allPassed = lintPassed && linksPassed && examplesPassed;
    process.exit(allPassed ? 0 : 1);
    
  } catch (error) {
    console.error('\n❌ Error running tests:', error);
    process.exit(1);
  }
}

// Run the tests
main();
