# Versioning Quick Start

This is a quick reference for the Islam Skin versioning and release process.

## Version Numbers
- `X.Y.Z` where:
  - `X` = Major (breaking changes)
  - `Y` = Minor (new features)
  - `Z` = Patch (bug fixes)
- Pre-1.0.0 versions may have breaking changes
- Pre-release versions use suffixes like `-alpha`, `-beta`, `-rc`

## Single Changelog
- All changes go in `CHANGELOG.md` at project root
- Include documentation updates in release notes
- One version number for both code and docs

## Quick Release Steps
1. Update `CHANGELOG.md` with all changes
2. Create release branch: `git checkout -b release/vX.Y.Z`
3. Test thoroughly
4. Merge to `main`
5. Tag: `git tag -a vX.Y.Z -m "Version X.Y.Z"`
6. Push tag: `git push origin vX.Y.Z`
7. Create GitHub release with notes

## Branches
- `main`: Stable releases
- `develop`: Integration branch
- `feature/`: New features
- `bugfix/`: Bug fixes

For full details, see [Versioning and Release Process](../development/versioning.md)
