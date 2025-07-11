# Documentation Link Checking

This document describes how to maintain and check links in the Islam Skin documentation.

## Automated Link Checking

We use a Python script to check for broken links in the documentation. The script verifies both internal and external links.

### Prerequisites

- Python 3.6 or higher
- Required Python packages: `requests`

### Installation

1. Install the required package:
   ```bash
   pip install requests
   ```

### Running the Link Checker

1. Navigate to the docs directory:
   ```bash
   cd /path/to/Islam/skins/Islam/docs
   ```

2. Run the link checker script:
   ```bash
   python scripts/check_links.py
   ```

### Interpreting Results

- The script will output any broken links it finds, including:
  - File and line number where the link appears
  - The URL that's broken
  - Type of link (internal/external)
  - Error details (for external links: status code; for internal: specific issue)

- Exit codes:
  - `0`: No broken links found
  - `1`: Broken links were found

## CI Integration

You can integrate the link checker into your CI/CD pipeline. Here's an example GitHub Actions workflow:

```yaml
name: Check Documentation Links

on:
  push:
    paths:
      - 'docs/**'
  pull_request:
    paths:
      - 'docs/**'

jobs:
  check-links:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Set up Python
        uses: actions/setup-python@v4
        with:
          python-version: '3.10'
      - name: Install dependencies
        run: |
          python -m pip install --upgrade pip
          pip install requests
      - name: Check documentation links
        run: |
          cd docs
          python scripts/check_links.py
```

## Best Practices

1. **Run Before Committing**: Always run the link checker before committing documentation changes.
2. **Fix All Issues**: Don't commit documentation with broken links.
3. **Update External Links**: Periodically check and update external links.
4. **Use Relative Paths**: For internal links, use relative paths to make the documentation more portable.

## Troubleshooting

- **SSL Errors**: If you encounter SSL errors with external links, you can disable SSL verification by modifying the script (not recommended for production).
- **Rate Limiting**: Some websites may block automated requests. If this happens, you can add those domains to the ignore list.
- **Temporary Failures**: Some external sites might be temporarily down. Rerun the checker to confirm if it's a persistent issue.
