# Documentation Deployment Guide

This guide explains how to deploy and maintain the Islam Skin documentation.

## 📦 Prerequisites

- Node.js 16+ and npm 8+
- Git
- GitHub account with repository access
- (Optional) GitHub Pages enabled for the repository

## 🚀 Deployment Options

### Option 1: GitHub Pages (Recommended)

1. **Configure GitHub Pages**
   - Go to repository Settings > Pages
   - Select `main` branch and `/docs` folder
   - Choose a custom domain if needed

2. **Build Documentation**
   ```bash
   # Install dependencies
   npm install
   
   # Build the documentation
   npm run docs:build
   ```

3. **Commit and Push**
   ```bash
   git add .
   git commit -m "docs: update documentation"
   git push origin main
   ```

4. **Verify Deployment**
   - Wait a few minutes for GitHub Pages to build
   - Visit your GitHub Pages URL (e.g., `https://username.github.io/Islam`)

### Option 2: Self-hosted

1. **Build Documentation**
   ```bash
   npm install
   npm run docs:build
   ```

2. **Deploy to Web Server**
   - Copy contents of the `_site` directory to your web server
   - Configure your web server to serve `index.html` as the default document

## 🔄 Versioning

### Creating a New Version

1. Update version in `package.json`
2. Create a new version directory in `docs/versions/`
3. Copy current documentation to the new version directory
4. Update the version switcher in the navigation
5. Update the "latest" symlink

### Maintaining Multiple Versions

- Keep the last 3 major versions
- Mark older versions as deprecated
- Update the version switcher with supported versions

## 🔍 Search Configuration

The documentation uses Lunr.js for client-side search. To update the search index:

```bash
npm run search:index
```

This will generate/update the `_site/search-index.json` file.

## 📊 Analytics

To enable Google Analytics:

1. Add your tracking ID to `_config.yml`:
   ```yaml
   google_analytics: UA-XXXXX-Y
   ```

2. Rebuild the documentation:
   ```bash
   npm run docs:build
   ```

## 🔒 Security Considerations

- Never commit sensitive information in documentation
- Use environment variables for API keys and secrets
- Keep dependencies updated
- Use HTTPS for all external resources

## 🛠️ Troubleshooting

### Common Issues

1. **Broken Links**
   ```bash
   npm run test:links
   ```

2. **Markdown Linting**
   ```bash
   npm run test:lint
   ```

3. **Search Not Working**
   - Ensure `search-index.json` exists in `_site/`
   - Check browser console for JavaScript errors
   - Verify CORS headers if hosting on a different domain

## 📝 Updating Documentation

1. Make changes to the Markdown files
2. Test locally:
   ```bash
   npm test
   npm run docs:serve
   ```
3. Commit and push changes
4. Create a pull request for review
5. Merge to `main` branch to trigger deployment

## 🌐 Custom Domain

To use a custom domain:

1. Add a `CNAME` file in the `docs/` directory with your domain
2. Configure DNS settings with your domain registrar
3. Enable HTTPS in GitHub Pages settings

## 📅 Maintenance Schedule

- Weekly: Check for broken links
- Monthly: Update dependencies
- Quarterly: Review and update content
- On Release: Update version documentation

## 📞 Support

For issues with documentation deployment:
1. Check the [troubleshooting](#troubleshooting) section
2. Search existing issues
3. Open a new issue if needed

## 📄 License

This documentation is licensed under the [GPL-3.0-or-later](LICENSE) license.
