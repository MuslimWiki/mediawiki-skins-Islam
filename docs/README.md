# Islam Skin Documentation

[![Documentation Status](https://img.shields.io/badge/docs-latest-blue.svg)](https://github.com/muslim-wiki/Islam-Skin/tree/main/htdocs/skins/Islam/docs)
[![License: GPL-3.0-or-later](https://img.shields.io/badge/License-GPL--3.0--or--later-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
[![Code Style](https://img.shields.io/badge/code%20style-PSR--12-blue)](https://www.php-fig.org/psr/psr-12/)

Welcome to the official documentation for the **Islam** skin for MediaWiki 1.43+. This documentation serves as a comprehensive guide for developers, designers, and contributors working with the Islam skin.

## 📚 Table of Contents

- [Getting Started](#-getting-started)
  - [Quick Start](./getting-started/quick-start.md)
  - [Configuration](./getting-started/configuration.md)
- [Components](./components/README.md)
  - [Link](./components/link.md)
  - [Menu](./components/menu/overview.md)
  - [User Info](./components/user-info.md)
- [Templates](./templates/README.md)
  - [Menu Templates](./templates/menu/README.md)
  - [User Info Template](./templates/user-info.md)
- [Architecture](./architecture/README.md)
  - [Styling](./architecture/styling.md)
  - [Data Flow](./architecture/data-flow.md)
  - [Component Interaction](./architecture/component-interaction.md)
- [Development](./development/README.md)
  - [Contributing](./development/contributing.md)
  - [Development Guide](./development/README.md)
- [Deployment](./deployment/README.md)
- [API Reference](./reference/README.md)
  - [Components API](./reference/api/components.md)
  - [Templates API](./reference/api/templates.md)
  - [Hooks](./reference/hooks.md)
  - [Link Checking](./development/link-checking.md)
- [About](./about/README.md)
  - [Roadmap](./about/roadmap.md)
  - [Code of Conduct](./about/code-of-conduct.md)
  - [Project Summary](./about/project-summary.md)

## 🌟 Overview

The Islam skin is a modern, responsive Skin for MediaWiki, designed with a focus on:

- Clean, accessible user interface
- Mobile-first responsive design
- Extensible component architecture
- Comprehensive documentation

## 🚀 Getting Started

For detailed installation and setup instructions, see our [Quick Start Guide](./getting-started/quick-start.md).

### Local Development Server

1. Start a local PHP server:
   ```bash
   php -S localhost:8000
   ```
2. Open http://localhost:8000 in your browser

### Option 2: Direct File Access

1. Start a PHP development server:
   ```bash
   php -S localhost:8000
   ```
2. Open http://localhost:8000 in your browser

### Option 2: Static HTML Viewer

1. Open `index.php` directly in your browser:
   - Double-click the file in your file explorer, or
   - Drag the file into your browser window, or
   - Use `File > Open` in your browser

2. Use the sidebar to navigate between documentation pages

## 🔍 Features

- **Dynamic Navigation**: Automatically updates when you add new documentation
- **Search**: Find content quickly with full-text search
- **Responsive Design**: Works on all device sizes
- **Light/Dark Theme**: Toggle between light and dark modes
- **Syntax Highlighting**: Code examples with syntax highlighting
   cd Islam/docs
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. View documentation:
   - Open `index.html` in your browser (static viewer)
   - Or use the full development setup (see below)

## 📖 Documentation Viewer Features

The static documentation viewer includes:

- **Zero Setup**: No server or build step required
- **Fast Loading**: Content loads directly in the browser
- **Responsive Design**: Works on mobile and desktop
- **Syntax Highlighting**: Code examples with proper formatting
- **Search**: Browser's built-in find (Ctrl+F)
- **Offline Access**: View documentation without an internet connection

For more details, see [README-STATIC.md](README-STATIC.md).

## 📝 Documentation Guidelines

### 📋 Markdown Style Guide

To maintain consistency across all documentation, please follow these guidelines:

#### Headers
```markdown
# H1 - Document Title
## H2 - Main Sections
### H3 - Subsections
#### H4 - Sub-subsections
##### H5 - Rarely used
###### H6 - Very rarely used
```

#### Text Formatting
```markdown
**Bold text** for important concepts
*Italic text* for emphasis
`code` for inline code and file names
~~strikethrough~~ for deprecated features
> Blockquotes for notes and warnings
```

#### Code Blocks
Use fenced code blocks with language specification:

````markdown
```php
// PHP code example
class Example {
    public function demo() {
        return 'Hello, World!';
    }
}
```

```javascript
// JavaScript example
const example = () => {
    console.log('Hello, World!');
};
```

```sql
-- SQL example
SELECT * FROM users WHERE status = 'active';
```
````

#### Tables

| Column 1 | Column 2 | Column 3 |
|----------|----------|----------|
| Data 1   | Data 2   | Data 3   |
| Data 4   | Data 5   | Data 6   |

#### Links and References
```markdown
[Link text](#)
[External Link](https://www.mediawiki.org/)
[Reference links][ref]

[ref]: https://www.mediawiki.org/wiki/Help:Links "MediaWiki Links Help"
```

#### Lists

```markdown
1. Ordered list item 1
2. Ordered list item 2
   - Nested unordered item 1
   - Nested unordered item 2
3. Ordered list item 3
```

### 📁 File Naming Conventions

- Use `kebab-case.md` for all documentation files
- Prefix files with their category when applicable:
  - `component-*.md` for component documentation
  - `template-*.md` for template documentation
  - `api-*.md` for API documentation
  - `guide-*.md` for how-to guides

### 📑 Documentation Structure

Each documentation file should follow this structure:

```markdown
# Document Title

[![Status](https://img.shields.io/badge/Status-Draft-yellow)]()

## 📝 Overview
Brief description of what this document covers.

## 📋 Table of Contents
- [Section 1](#section-1)
- [Section 2](#section-2)

## Section 1
Content goes here...

## Section 2
More content...

## 🔗 See Also
- [Getting Started Guide](./getting-started/quick-start.md)
- [Component Documentation](./components/README.md)

## 📄 License
[GPL-3.0-or-later](https://www.gnu.org/licenses/gpl-3.0)
```

## 🗂 Project Structure

```
skins/Islam/
├── docs/                       # Documentation files
│   ├── components/            # Component documentation
│   │   ├── component-menu.md  # Menu component docs
│   │   └── ...
│   ├── templates/             # Template documentation
│   ├── architecture/          # Architecture decisions
│   ├── api/                   # API documentation
│   └── guides/                # How-to guides
├── includes/                  # PHP classes
│   └── Components/           # UI Components
├── resources/                 # Frontend resources
│   ├── skins.islam.scripts/  # JavaScript
│   └── skins.islam.styles/   # CSS/LESS
├── templates/                 # Mustache templates
└── skin.json                 # Skin configuration
```

## 🚀 Getting Started

### Prerequisites

- MediaWiki 1.43+
- PHP 8.0+
- Node.js 16+ (for development)
- Composer (for PHP dependencies)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-org/Islam.git skins/Islam
   ```

2. Install PHP dependencies:
   ```bash
   cd skins/Islam
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

## 🛠 Development

### Building Assets

```bash
# Production build
npm run build

# Development mode with watch
npm run watch
```

### Testing

```bash
# Run PHPUnit tests
composer test

# Run JavaScript tests
npm test

# Run linters
composer lint
npm run lint
```

## 🤝 Contributing

We welcome contributions! Please follow these steps:

### Documentation Updates

1. Make your changes to the markdown files in the `docs` directory
2. Commit and push your changes
3. Create a pull request

## 📝 License

This project is licensed under the GPL-3.0 License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- The Muslim community for their support and feedback
- All contributors who have helped improve this project
.
- Inspired by the MediaWiki community and modern web development practices.
