# Versioning and Release Process

This document outlines the versioning strategy and release process for the Islam Skin project.

## Version Numbering

We follow [Semantic Versioning 2.0.0](https://semver.org/):

- **MAJOR** version for incompatible API changes
- **MINOR** version for added functionality in a backward-compatible manner
- **PATCH** version for backward-compatible bug fixes

During initial development (0.x.y), anything may change at any time.

## Single Source of Truth

- One `CHANGELOG.md` at the project root tracks all changes
- Documentation changes are included in the main changelog
- Version numbers apply to the entire project (code and docs)

## Branch Strategy

- `main` - Stable, production-ready code
- `develop` - Integration branch for features
- `feature/*` - New features being developed
- `bugfix/*` - Bug fixes
- `release/*` - Release preparation branches

## Release Process

### Pre-Release Checklist
1. Ensure all changes are merged to `develop`
2. Update `CHANGELOG.md` with release notes including documentation changes
3. Update version numbers in relevant files
4. Run all tests
5. Create a release branch from `develop`

### Creating a Release
1. Merge release branch to `main`
2. Tag the release: `git tag -a vX.Y.Z -m "Version X.Y.Z"`
3. Push the tag: `git push origin vX.Y.Z`
4. Create a GitHub release with release notes
5. Merge `main` back into `develop`

## Changelog Format

All changes, including documentation updates, are tracked in `CHANGELOG.md`:

```markdown
## [X.Y.Z] - YYYY-MM-DD

### Added
- New features

### Changed
- Changes in existing functionality

### Deprecated
- Soon-to-be removed features

### Removed
- Removed features

### Fixed
- Bug fixes

### Security
- Security-related fixes
```

## Pre-release Versions

For pre-release versions, append a hyphen and identifiers:
- `-alpha` for alpha releases
- `-beta` for beta releases
- `-rc` for release candidates

Example: `v1.0.0-rc.1`

## Backward Compatibility

- Major version zero (0.y.z) is for initial development
- Version 1.0.0 defines the public API
- After 1.0.0, breaking changes require a major version increment

## Documentation

Documentation for each version is available in the `docs` directory and should be updated with each release.
