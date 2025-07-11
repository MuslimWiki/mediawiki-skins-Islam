# Code Style Guide

This document outlines the coding standards and conventions for the Islam Skin and IslamDashboard projects. Adhering to these guidelines ensures consistency and maintainability across the codebase.

## 📋 Table of Contents

- [PHP Coding Standards](#-php-coding-standards)
- [JavaScript Style Guide](#-javascript-style-guide)
- [CSS/SASS Guidelines](#-css-sass-guidelines)
- [Documentation Standards](#-documentation-standards)
- [Git Commit Guidelines](#-git-commit-guidelines)
- [Naming Conventions](#-naming-conventions)
- [Best Practices](#-best-practices)

## 🐘 PHP Coding Standards

### General

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
- Use strict typing: `declare(strict_types=1);`
- Use type hints for all method parameters and return types
- Use PHP 8.0+ features where appropriate

### File Structure

```
src/
  Component/
    ComponentName/
      ComponentName.php
      ComponentName.skin.php
      ComponentName.i18n.php
      ComponentName.hooks.php
  Hook/
      HookHandlerName.php
tests/
  Unit/
    Component/
      ComponentNameTest.php
templates/
  component-name.mustache
```

### Example

```php
<?php
declare(strict_types=1);

namespace Islam\Component;

use OutputPage;
use SkinTemplate;

/**
 * ComponentName component
 */
class ComponentName implements ComponentInterface {
    /** @var array */
    private $config;

    public function __construct(array $config = []) {
        $this->config = array_merge([
            'default' => 'value',
        ], $config);
    }

    /**
     * Get component data
     * 
     * @param SkinTemplate $skin
     * @param array $data
     * @return array
     */
    public function getData(SkinTemplate $skin, array $data = []): array {
        return array_merge($data, [
            'key' => 'value',
        ]);
    }
}
```

## 🌐 JavaScript Style Guide

### General

- Follow [Airbnb JavaScript Style Guide](https://github.com/airbnb/javascript)
- Use ES6+ features
- Use JSDoc for documentation
- Use strict mode: `'use strict';`

### Example

```javascript
/**
 * Component initialization
 * @param {Object} config - Component configuration
 * @returns {Object} Component instance
 */
function initComponent(config = {}) {
    'use strict';

    const defaults = {
        selector: '.component',
        debug: false
    };

    const settings = { ...defaults, ...config };
    const elements = document.querySelectorAll(settings.selector);

    /**
     * Private method example
     * @private
     */
    function privateMethod() {
        if (settings.debug) {
            console.log('Debug mode is enabled');
        }
    }

    // Public API
    return {
        init() {
            elements.forEach(element => {
                // Initialize component
                privateMethod();
            });
            return this;
        }
    };
}

export default initComponent;
```

## 🎨 CSS/SASS Guidelines

### General

- Follow [BEM (Block Element Modifier)](http://getbem.com/) methodology
- Use SASS/SCSS for styles
- Mobile-first approach
- Use CSS custom properties for theming

### Example

```scss
// Variables
$color-primary: #2c3e50;
$spacing-unit: 1rem;

// Component
.component {
    display: block;
    padding: $spacing-unit;
    
    &--modifier {
        background-color: lighten($color-primary, 10%);
    }
    
    &__element {
        margin-bottom: $spacing-unit / 2;
    }
    
    @media (min-width: 768px) {
        display: flex;
    }
}
```

## 📝 Documentation Standards

### PHP Documentation

```php
/**
 * Short description
 *
 * Longer description that explains the purpose of the class/method/function.
 * Can span multiple lines.
 *
 * @param string $param1 Description of parameter
 * @param int $param2 Description of parameter
 * @return array Return value description
 * @throws Exception When something goes wrong
 */
```

### JavaScript Documentation

```javascript
/**
 * Performs an asynchronous operation
 *
 * @async
 * @param {string} url - The URL to fetch
 * @param {Object} [options] - Optional configuration
 * @param {number} [options.timeout=5000] - Request timeout in ms
 * @returns {Promise<Object>} The response data
 * @throws {Error} If the request fails
 */
async function fetchData(url, options = {}) {
    // Implementation
}
```

## 🔖 Git Commit Guidelines

Follow the [Conventional Commits](https://www.conventionalcommits.org/) specification:

```
<type>[optional scope]: <description>

[optional body]

[optional footer(s)]
```

### Commit Types

- `feat`: A new feature
- `fix`: A bug fix
- `docs`: Documentation only changes
- `style`: Changes that do not affect the meaning of the code
- `refactor`: A code change that neither fixes a bug nor adds a feature
- `perf`: A code change that improves performance
- `test`: Adding missing tests or correcting existing tests
- `chore`: Changes to the build process or auxiliary tools

## 📛 Naming Conventions

### PHP

- Classes: `PascalCase`
- Methods: `camelCase`
- Variables: `camelCase`
- Constants: `UPPER_SNAKE_CASE`
- Private/protected properties: `camelCase` with `_` prefix

### JavaScript

- Variables/Functions: `camelCase`
- Classes: `PascalCase`
- Constants: `UPPER_SNAKE_CASE`
- Private members: `_camelCase` with `_` prefix

### CSS/SCSS

- Classes: `kebab-case` (BEM methodology)
- Variables: `kebab-case`
- Mixins: `camelCase`

## 🏆 Best Practices

### Security

- Always validate and sanitize user input
- Use prepared statements for database queries
- Implement CSRF protection
- Follow OWASP security guidelines

### Performance

- Minimize database queries
- Use caching where appropriate
- Optimize assets (minify, compress)
- Implement lazy loading for images and components

### Accessibility

- Use semantic HTML5 elements
- Ensure proper heading hierarchy
- Add appropriate ARIA attributes
- Test with screen readers

### Testing

- Write unit tests for all new features
- Aim for at least 80% code coverage
- Test edge cases
- Include integration tests for critical paths

## 🔄 Code Review Guidelines

- Keep PRs small and focused
- Include tests with new features
- Update documentation when necessary
- Request reviews from appropriate team members
- Address all review comments before merging
