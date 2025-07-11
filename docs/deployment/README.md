# Deployment Guide

This guide provides instructions for deploying the Islam Skin to various environments.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Deployment Options](#deployment-options)
- [Configuration](#configuration)
- [Environment Variables](#environment-variables)
- [Troubleshooting](#troubleshooting)
- [Maintenance](#maintenance)

## Prerequisites

Before deploying, ensure you have:

- Node.js 16+ installed
- npm 8+ or yarn 1.22+
- Access to the target deployment environment
- Required environment variables configured

## Deployment Options

### 1. Production Deployment

```bash
# Build for production
npm run build

# Deploy to production
npm run deploy:production
```

### 2. Staging Deployment

```bash
# Build for staging
npm run build:staging

# Deploy to staging
npm run deploy:staging
```

### 3. Docker Deployment

```bash
# Build the Docker image
docker build -t islam-skin .

# Run the container
docker run -p 3000:3000 islam-skin
```

## Configuration

### Environment Variables

Create a `.env` file in the project root with the following variables:

```env
NODE_ENV=production
API_BASE_URL=https://api.example.com
PUBLIC_URL=/
```

### Server Requirements

- Node.js 16+
- 1GB RAM minimum (2GB recommended)
- 1 CPU core minimum (2+ recommended)
- 1GB free disk space

## CI/CD

The project includes GitHub Actions workflows for automated testing and deployment. These are triggered on push to specific branches:

- `main` -> Production deployment
- `staging` -> Staging deployment
- `develop` -> Development preview

## Monitoring

After deployment, monitor the application using:

- Application logs
- Error tracking (Sentry)
- Performance monitoring
- Uptime monitoring

## Rollback

To rollback to a previous version:

```bash
# Find the previous deployment ID
npm run deployments:list

# Rollback to a specific deployment
npm run deploy:rollback -- <deployment-id>
```

## Maintenance

### Updating Dependencies

```bash
# Check for outdated packages
npm outdated

# Update packages
npm update

# Update to latest major versions
npx npm-check-updates -u
npm install
```

### Database Migrations

```bash
# Run pending migrations
npm run db:migrate

# Rollback last migration
npm run db:rollback
```

## Troubleshooting

### Common Issues

1. **Build Failures**
   - Check Node.js and npm versions
   - Delete `node_modules` and `package-lock.json`, then reinstall

2. **Environment Variables**
   - Ensure all required variables are set
   - Check for typos in variable names

3. **Permissions**
   - Ensure the deployment user has proper permissions
   - Check file ownership in the deployment directory

## Support

For additional help, please contact the development team or open an issue in the repository.
