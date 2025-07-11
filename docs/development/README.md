# Development Guide

Welcome to the Islam Skin development guide. This document provides all the information you need to start developing with the Islam Skin.

## Getting Started

1. [Setup Guide](./setup.md) - Set up your development environment
2. [Project Structure](./project-structure.md) - Understand the codebase organization
3. [Development Workflow](./workflow.md) - Learn about our development process

## Guidelines

- [Code Style Guide](./style-guide.md) - Coding standards and best practices
- [Component Development Guide](./component-guide.md) - How to create new components
- [Testing Guide](./testing.md) - Writing and running tests
- [Documentation Guide](./documentation.md) - How to document your code

## Tools

- Build System: Webpack
- Testing: Jest + React Testing Library
- Linting: ESLint + Stylelint
- Formatting: Prettier
- Version Control: Git

## Documentation Link Checking

We use an automated link checker to ensure all internal and external links in our documentation are valid. This helps maintain the quality and reliability of our documentation.

### Running the Link Checker

```bash
# Run the link checker script
python scripts/check_links.py

# Install Python dependencies (if not already installed)
pip install requests
```

The script will check all markdown files in the documentation and report any broken links.

### Link Checker Output

- **No output** means all links are valid
- **Error messages** will show the file, line number, and type of broken link
- Exit code 0 means success, 1 means broken links were found

### CI Integration

The link checker can be integrated into your CI/CD pipeline. See [Link Checking Guide](./link-checking.md) for details on setting up automated checks.

## Common Tasks

### Starting the Development Server

```bash
npm run dev
```

### Running Tests

```bash
# Run all tests
npm test

# Run tests in watch mode
npm test -- --watch

# Run coverage report
npm test -- --coverage
```

### Building for Production

```bash
npm run build
```

## Contributing

1. Read the [Contributing Guide](./contributing.md)
2. Follow the [Pull Request Process](./pull-requests.md)
3. Adhere to the [Code of Conduct](../about/code-of-conduct.md)

## Troubleshooting

See the [Troubleshooting Guide](./troubleshooting.md) for solutions to common issues.

## Need Help?

- Join our [community chat](https://example.com/chat)
- Open an [issue](https://github.com/your-org/islam-skin/issues)
- Check the [FAQ](./faq.md)
