# Static Documentation Viewer

This is a zero-dependency documentation viewer for the Islam Skin project. It works directly in the browser with no server required.

## Features

- No server required - works with `file://` protocol
- Client-side Markdown rendering using Marked.js
- Syntax highlighting for code blocks
- Responsive design that works on mobile and desktop
- No build step required
- Fast and lightweight

## How to Use

1. Open `index.html` in any modern web browser:
   - Double-click the file in your file explorer, or
   - Drag the file into your browser window, or
   - Use `File > Open` in your browser

2. The documentation will load automatically from the local Markdown files.

## Navigation

- Use the sidebar to navigate between different documentation pages
- The current page is highlighted in the navigation
- Use your browser's back/forward buttons to navigate between pages
- The URL hash updates to allow bookmarking of specific pages

## Customization

### Adding or Updating Documentation

1. Add or modify Markdown (`.md`) files in the `docs` directory
2. Update `navigation.json` to include your new files:
   ```json
   [
     {"title": "Page Title", "file": "path/to/your-file.md"}
   ]
   ```

### Changing the Theme

Edit the CSS variables in `index.html` to customize colors and spacing:

```css
:root {
    --primary: #2c58a0;      /* Primary brand color */
    --secondary: #4a6da7;    /* Secondary color */
    --text: #333;           /* Main text color */
    --light-bg: #f8f9fa;    /* Light background */
    --border: #e1e4e8;      /* Border color */
}
```

## Requirements

- Modern web browser (Chrome, Firefox, Safari, Edge)
- No server or internet connection required after initial setup

## Troubleshooting

### Content Not Loading
- Make sure all Markdown files exist in the specified locations
- Check the browser console for errors (F12 > Console)
- Ensure file paths in `navigation.json` are correct

### Formatting Issues
- Verify your Markdown follows standard syntax
- Code blocks should be wrapped in triple backticks with the language specified:
  ````markdown
  ```javascript
  console.log('Hello, world!');
  ```
  ````

## License

This documentation viewer is open source and available under the MIT License.

## Credits

- [Marked.js](https://marked.js.org/) - Markdown parser
- [Highlight.js](https://highlightjs.org/) - Syntax highlighting
- [GitHub Markdown CSS](https://github.com/sindresorhus/github-markdown-css) - Base styles
