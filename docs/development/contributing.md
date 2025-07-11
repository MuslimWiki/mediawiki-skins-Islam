# Contributing to MuslimWiki

Thank you for your interest in contributing to MuslimWiki! This guide will help you get started with contributing to our project.

## Table of Contents
- [Code of Conduct](#code-of-conduct)
- [Getting Started](#getting-started)
- [Development Workflow](#development-workflow)
- [Commit Message Guidelines](#commit-message-guidelines)
- [Pull Request Process](#pull-request-process)
- [Code Review Guidelines](#code-review-guidelines)
- [Reporting Issues](#reporting-issues)
- [License](#license)

## Code of Conduct

By participating in this project, you are expected to uphold our [Code of Conduct](../about/code-of-conduct.md). Please report any unacceptable behavior to [contact@muslim.wiki](mailto:contact@muslim.wiki).

## Getting Started

1. Fork the repository
2. Clone your fork locally
3. Install dependencies
4. Create a feature branch
5. Make your changes
6. Test your changes
7. Commit your changes
8. Push to your fork
9. Open a pull request

## Development Workflow

1. Always work on a feature branch
2. Keep your fork in sync with the main repository
3. Write clear, concise commit messages
4. Add tests for new features
5. Update documentation as needed
6. Ensure your code passes all tests
7. Open a pull request for review

## Commit Message Guidelines

### Format

```
<type>(<scope>): <emoji> <short description>

[optional body]

[optional footer(s)]
```

### Commit Types

| Type       | Description                                                                 | Emoji |
|------------|-----------------------------------------------------------------------------|-------|
| feat       | A new feature                                                              | ✨    |
| fix        | A bug fix                                                                  | 🐛    |
| docs       | Documentation only changes                                                 | 📚    |
| style     | Changes that do not affect the meaning of the code (white-space, formatting)| 🎨    |
| refactor  | A code change that neither fixes a bug nor adds a feature                  | 🔄    |
| perf      | A code change that improves performance                                    | 💥    |
| test      | Adding missing tests or correcting existing tests                          | 🚨    |
| build     | Changes that affect the build system or external dependencies              | 📦    |
| ci        | Changes to CI configuration files and scripts                              | 👷    |
| chore     | Other changes that don't modify src or test files                          | 🔧    |
| revert    | Reverts a previous commit                                                  | ⏪    |
| security  | Security-related changes                                                   | 🔒    |

### Scopes

Scopes should be lowercase and represent the part of the codebase being modified. Examples:
- `search`
- `header`
- `menu`
- `styles`
- `i18n`

### Examples

```
feat(search): ✨ add advanced search filters

- Add date range filter
- Add category filter
- Add sorting options

Closes #123
```

```
fix(header): 🐛 fix mobile menu not closing

The mobile menu was not closing when clicking outside the menu area. This commit adds an event listener to close the menu when clicking outside.

Fixes #456
```

```
docs(readme): 📚 update installation instructions

Update the README with new installation steps and requirements.
```

## Pull Request Process

1. Ensure any install or build dependencies are removed before the end of the layer when doing a build
2. Update the README.md with details of changes to the interface, this includes new environment variables, exposed ports, useful file locations and container parameters
3. Increase the version numbers in any examples files and the README.md to the new version that this Pull Request would represent. The versioning scheme we use is [SemVer](http://semver.org/)
4. You may merge the Pull Request once you have the sign-off of two other developers, or if you do not have permission to do that, you may request the second reviewer to merge it for you

## Code Review Guidelines

- Be respectful and considerate of others' work
- Focus on the code, not the person
- Suggest improvements with clear explanations
- Keep feedback constructive and actionable
- Acknowledge good practices and improvements
- Be open to discussion and alternative approaches

## Reporting Issues

When reporting issues, please include:

1. A clear, descriptive title
2. Steps to reproduce the issue
3. Expected behavior
4. Actual behavior
5. Screenshots if applicable
6. Browser/OS version if relevant

## License

By contributing, you agree that your contributions will be licensed under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.html).
