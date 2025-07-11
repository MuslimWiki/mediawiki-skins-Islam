# Development Guide

Welcome to the Islam Skin development guide! This document will help you set up your development environment and understand the workflow for contributing to the project.

## 🚀 Quick Start

### Prerequisites

- [Node.js](https://nodejs.org/) (v18 or higher)
- [npm](https://www.npmjs.com/) (v9 or higher)
- [Git](https://git-scm.com/)
- [PHP](https://www.php.net/) (8.1 or higher)
- [Composer](https://getcomposer.org/)
- [MediaWiki](https://www.mediawiki.org/) (1.43 or higher)
- [GitHub Account](https://github.com/) (for contributing)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-org/Islam.git
   cd Islam
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   cd docs
   npm install
   ```

4. **Build the documentation**
   ```bash
   npm run docs:build
   ```

## 🛠 Development Workflow

### Branching Strategy

- `main` - Stable, production-ready code (protected branch)
- `develop` - Integration branch for features (protected branch)
- `feature/*` - New features and enhancements
- `bugfix/*` - Bug fixes
- `docs/*` - Documentation updates
- `release/*` - Release preparation branches

### Development Workflow

1. **Local Development**:
   - Work on feature branches
   - Follow coding standards
   - Write tests for new features
   - Update documentation

2. **Code Review**:
   - Create pull requests
   - Request reviews from team members
   - Address feedback
   - Ensure all tests pass

3. **Merging**:
   - Squash and merge approved PRs
   - Delete merged branches
   - Update local repository

### Making Changes

1. Create a new branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. Make your changes and commit them:
   ```bash
   git add .
   git commit -m "feat: add new feature"
   ```

3. Push your changes:
   ```bash
   git push origin feature/your-feature-name
   ```

4. Create a pull request against the `develop` branch.

## 🔧 Development Tools

### Documentation

- Build documentation: `npm run docs:build`
- Generate search index: `npm run search:index`
- Update table of contents: `npm run toc:generate`
- Run local server: `npx serve -s .`
- Check for broken links: `npx linkinator ./**/*.md`

### Local Development Server

To run a local development server:

```bash
# Start PHP's built-in server
php -S localhost:8000
```

Then open `http://localhost:8000` in your browser.

### Testing

Run the test suite:

```bash
composer test
```

### Coding Standards

Before committing, ensure your code follows the project's coding standards:

```bash
composer cs-check  # Check coding standards
composer cs-fix    # Fix coding standards issues
```

## 🧪 Testing

### Local Testing

Before pushing changes, run:

```bash
# Run all tests
composer test

# Run PHPUnit tests
composer test:phpunit

# Run PHPCS (coding standards)
composer cs-check

# Fix coding standards
composer cs-fix
```

### Local Testing

Run tests locally before pushing changes:

```bash
# Run all tests
composer test

# Run PHPUnit tests
composer test:phpunit

# Check coding standards
composer cs-check
```

### Browser Testing

For cross-browser testing, we recommend:

- [BrowserStack](https://www.browserstack.com/)
- [LambdaTest](https://www.lambdatest.com/)

## 🚀 Building for Production

To create a production build:

```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Build assets
npm run build
```

This will create optimized assets in the appropriate directories.

### Versioning

We follow [Semantic Versioning](https://semver.org/). To create a new release:

1. Update the version in `extension.json`
2. Update `CHANGELOG.md`
3. Create a git tag:
   ```bash
   git tag -a v1.0.0 -m "Version 1.0.0"
   git push origin v1.0.0
   ```

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details on:

- Code of Conduct
- Development Workflow
- Pull Request Process
- Issue Reporting

## 🔍 Code Review Process

1. Create a pull request from your feature branch
2. Request reviews from team members
3. Address any feedback
4. Ensure all tests pass
5. PR is merged by maintainers

## 🐛 Reporting Issues

Found a bug or have a suggestion? Please:
1. Check existing issues
2. Create a new issue with:
   - Clear description
   - Steps to reproduce
   - Expected vs actual behavior
   - Screenshots if applicable

## 📝 License

This project is licensed under the GPL-3.0 License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- The Muslim community for their support and feedback
- All contributors who have helped improve this project
- GitHub for providing CI/CD infrastructure
- The MediaWiki community for their support
