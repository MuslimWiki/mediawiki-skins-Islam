# GitHub Actions Workflows

This directory contains GitHub Actions workflows for the Islam Skin project.

## Available Workflows

### `docs.yml`

Handles the CI/CD pipeline for the documentation.

#### Triggers
- On push to `main` or `develop` branches
- On pull requests to `main` or `develop`
- Manual trigger via GitHub Actions UI

#### Jobs
1. **Build and Test**
   - Sets up Node.js environment
   - Installs dependencies
   - Builds documentation
   - Generates search index
   - Updates table of contents
   - Checks for broken links

2. **Deploy** (main/develop only)
   - Deploys to GitHub Pages on the `gh-pages` branch
   - Preserves CNAME and .nojekyll files

## Setup Instructions

1. Enable GitHub Pages in your repository settings:
   - Go to Settings > Pages
   - Set Source to `gh-pages` branch
   - Set folder to `/ (root)`

2. For custom domain (when ready):
   - Update the `CNAME` file with your domain
   - Follow GitHub's guide for setting up a custom domain

## Manual Deployment

To manually trigger a deployment:
1. Go to Actions
2. Select "Documentation CI/CD"
3. Click "Run workflow"
4. Select branch and click "Run workflow"
