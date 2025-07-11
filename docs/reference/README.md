# API Reference

This directory contains the complete API reference for the Islam Skin.

## Table of Contents

- [Components API](api/components.md) - Documentation for all component APIs
- [Templates API](api/templates.md) - Documentation for template system
- [Hooks](hooks.md) - Available hooks and extension points

## Getting Started

### Installation

```bash
npm install islam-skin
# or
yarn add islam-skin
```

### Basic Usage

```javascript
import { Component, ThemeProvider } from 'islam-skin';

function App() {
  return (
    <ThemeProvider theme="light">
      <Component />
    </ThemeProvider>
  );
}
```

## API Conventions

### Props

Each component's props are documented with:
- Type information
- Default values
- Required/Optional status
- Description of purpose

### Methods

Instance methods are documented with:
- Parameters and their types
- Return values
- Side effects
- Error conditions

### Events

Events are documented with:
- Event name
- Payload structure
- When the event is triggered
- Example usage

## TypeScript Support

All components include TypeScript type definitions. To get proper type checking and IntelliSense:

```typescript
import { Component } from 'islam-skin';

interface MyComponentProps {
  // Your props here
}

const MyComponent: React.FC<MyComponentProps> = (props) => {
  // Component implementation
};
```

## Browser Support

The skin supports all modern browsers and IE11+. For IE11 support, include the appropriate polyfills.

## Versioning

This project follows [Semantic Versioning](https://semver.org/).

## License

MIT

## Contributing

See the [Contributing Guide](../development/contributing.md) for details on how to contribute to the project.
