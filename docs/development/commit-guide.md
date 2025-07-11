# GitHub Commit Guide for MuslimWiki

## Overview
This guide provides a structured approach to writing commit messages for the MuslimWiki project. Following these conventions will help maintain clarity and consistency in our version control history.

## Commit Message Format

```
<type>(<scope>): <emoji> <short description>

[optional body]

[optional footer(s)]
```

## Commit Types

| Type     | Description                                                                | Emoji |
|----------|----------------------------------------------------------------------------|-------|
| feat     | A new feature                                                              | ✨    |
| fix      | A bug fix                                                                  | 🐛    |
| docs     | Documentation only changes                                                 | 📚    |
| style    | Changes that do not affect the meaning of the code                         | 🎨    |
| refactor | A code change that neither fixes a bug nor adds a feature                  | 🔄    |
| perf     | A code change that improves performance                                    | 💥    |
| test     | Adding missing tests or correcting existing tests                          | 🚨    |
| build    | Changes that affect the build system or external dependencies              | 📦    |
| ci       | Changes to CI configuration files and scripts                              | 👷    |
| chore    | Other changes that don't modify src or test files                          | 🔧    |
| revert   | Reverts a previous commit                                                  | ⏪    |
| security | Security-related changes                                                   | 🔒    |

## Emoji Reference

| Emoji | Meaning                              | When to use it                                      |
|-------|--------------------------------------|-----------------------------------------------------|
| ✨    | Feature                              | New features                                        |
| 🐛    | Bug fix                              | Bug fixes                                           |
| 📚    | Documentation                        | Documentation updates                               |
| 🎨    | Code style                           | Formatting, missing semi-colons, etc                |
| 🔄    | Code refactoring                     | Code changes that neither fix bugs nor add features |
| 💥    | Performance improvements             | Performance-related changes                         |
| 🚨    | Tests                                | Adding or modifying tests                           |
| 👷    | CI/CD                                | CI/CD configuration changes                         |
| 🔧    | Configuration                        | Configuration file changes                          |
| ⏪    | Revert                               | Reverting changes                                   |
| 🔒    | Security                             | Security fixes                                      |
| 🚧    | Work in progress                     | Incomplete features                                 |
| 🚀    | Deployment                           | Deployment-related changes                          |
| 🗑️    | Removal                              | Removing code or files                             |

## Scopes

Scopes should be lowercase and represent the part of the codebase being modified. Examples:
- `search`
- `header`
- `menu`
- `styles`
- `i18n`
- `auth`
- `api`

## Examples

### Simple Commit
```
feat(search): ✨ add advanced search filters
```

### Commit with Body
```
fix(header): 🐛 fix mobile menu not closing

The mobile menu was not closing when clicking outside the menu area. This commit adds an event listener to close the menu when clicking outside.

Fixes #456
```

### Commit with Multiple Paragraphs
```
refactor(auth): 🔄 improve authentication flow

- Extract authentication logic into separate service
- Add input validation
- Improve error handling

Closes #123
Related to #456
```

### Revert Commit
```
revert: ⏪ revert "feat: add experimental feature"

This reverts commit 1234567890abcdef.

Reason: Caused regression in production
```

## Best Practices

1. **Be Clear and Concise**
   - Keep the subject line under 50 characters
   - Use the body to explain what and why, not how

2. **Use the Imperative Mood**
   - Write commands, not descriptions
   - Good: "Add feature"
   - Bad: "Added feature" or "Adding feature"

3. **Reference Issues**
   - Reference issues and pull requests liberally
   - Use keywords like "Closes", "Fixes", "Resolves" to automatically close issues

4. **Keep Commits Atomic**
   - Each commit should represent a single logical change
   - Split large changes into multiple commits

5. **Test Before Committing**
   - Ensure all tests pass before committing
   - Don't commit commented-out code

## Common Mistakes to Avoid

1. **Vague Commit Messages**
   - Bad: "Fix bug"
   - Good: "fix(auth): 🐛 prevent null reference in login"

2. **Including Unrelated Changes**
   - Keep commits focused on a single change
   - Use `git add -p` to stage changes selectively

3. **Forgetting to Add Emojis**
   - Emojis help quickly identify the type of change
   - Use them consistently

4. **Writing Too Much or Too Little**
   - Find the right balance between too much and too little information
   - Include enough context to understand the change without being verbose

## Advanced: Git Hooks

Consider using Git hooks to enforce commit message conventions. A sample pre-commit hook is available in `.git/hooks/commit-msg.sample`.

## License

This guide is part of the MuslimWiki project and is licensed under the [GNU General Public License v3.0](LICENSE).
