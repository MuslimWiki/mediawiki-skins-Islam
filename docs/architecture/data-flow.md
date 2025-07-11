# 📊 Data Flow in Islam Skin

[![Status](https://img.shields.io/badge/Status-Stable-brightgreen)]()
[![MediaWiki](https://img.shields.io/badge/MediaWiki-1.43+-blue)](https://www.mediawiki.org/)

## 📝 Overview

This document provides a comprehensive guide to understanding how data moves through the Islam skin, from server-side processing to client-side rendering. A clear understanding of this flow is crucial for:

- Extending the skin's functionality
- Developing new features like the IslamDashboard
- Debugging data-related issues
- Optimizing performance

## 🏗 High-Level Architecture

```mermaid
graph TD
    A[MediaWiki Core] -->|Page Data| B[SkinIslam]
    B -->|Template Data| C[Mustache Templates]
    C -->|HTML| D[Browser]
    D -->|User Actions| E[JavaScript]
    E -->|API Calls| F[MediaWiki API]
    F -->|JSON Data| E
    E -->|DOM Updates| D
    
    style A fill:#f9f,stroke:#333
    style B fill:#bbf,stroke:#333
    style C fill:#f96,stroke:#333
    style D fill:#9f9,stroke:#333
    style E fill:#f9f9b3,stroke:#333
    style F fill:#f9d5b3,stroke:#333
```

## 🔄 Data Flow Details

### 1. Server-Side Processing

#### Initialization Phase

```mermaid
sequenceDiagram
    participant MW as MediaWiki
    participant Skin as SkinIslam
    participant Config as Configuration
    
    MW->>Skin: __construct()
    activate Skin
    
    Skin->>Config: Load skin.json
    Config-->>Skin: Return configuration
    
    Skin->>Skin: Register hooks
    Skin->>Skin: Initialize components
    Skin-->>MW: Skin instance ready
    deactivate Skin
```

#### Page Rendering Process

```mermaid
sequenceDiagram
    participant MW as MediaWiki
    participant Skin as SkinIslam
    participant Components
    participant Template as Mustache
    
    MW->>Skin: generateHTML()
    activate Skin
    
    loop For each component
        Skin->>Components: getTemplateData()
        Components-->>Skin: Return structured data
    end
    
    Skin->>Template: render() with component data
    Template-->>Skin: Rendered HTML
    Skin-->>MW: Final HTML output
    deactivate Skin
```

### 2. Client-Side Processing

#### Initial Page Load

```mermaid
sequenceDiagram
    participant User
    participant Browser
    participant RL as ResourceLoader
    participant JS as JavaScript Modules
    
    User->>Browser: Request page
    activate Browser
    
    Browser->>RL: Load required resources
    RL-->>Browser: Deliver JS/CSS
    
    Browser->>JS: Initialize modules
    JS->>Browser: Set up event handlers
    
    Browser-->>User: Display interactive page
    deactivate Browser
```

#### Dynamic Content Loading

```mermaid
sequenceDiagram
    participant User
    participant JS as JavaScript
    participant API as MediaWiki API
    participant DOM as Page DOM
    
    User->>DOM: Trigger action (e.g., click)
    activate DOM
    
    DOM->>JS: Handle event
    JS->>API: Send API request
    
    alt Cached Response Available
        API-->>JS: Return cached data
    else Fresh Data Required
        API->>API: Process request
        API-->>JS: Return fresh JSON
    end
    
    JS->>DOM: Update UI components
    DOM-->>User: Show updated content
    deactivate DOM
```

## 🏗 Data Structures

### 1. Template Data Structure

```typescript
/**
 * Main template data interface for the Islam skin
 */
interface TemplateData {
    // Site-wide data
    'html-site-notice'?: string;
    'html-user-message'?: string;
    
    // Logo configuration
    'data-logos': {
        '1x': string;          // Standard resolution logo
        '2x'?: string;         // High-DPI logo (optional)
        wordmark?: {            // Text-based logo
            src: string;
            width: number;
            height: number;
        };
        // ... other logo variants
    };
        };
    };
    
    // Navigation data
    'data-navigation': Array<{
        id: string;
        'html-items': string;
        label?: string;
        class?: string;
    }>;
    
    // User data
    'data-user-info'?: {
        id: number;
        name: string;
        groups: string[];
        editCount: number;
        registration: string;
    };
    
    // Search data
    'data-search': {
        'form-action': string;
        'html-button-search': string;
        'html-button-search-fallback': string;
        'html-input': string;
    };
    
    // Page tools
    'data-page-tools'?: Array<{
        id: string;
        'html-items': string;
        label?: string;
    }>;
    
    // Content data
    'html-title'?: string;
    'html-subtitle'?: string;
    'html-body-content'?: string;
    'html-categories'?: string;
    
    // Footer data
    'data-footer': {
        'data-info': Array<{
            id: string;
            'html-items': string;
        }>;
        'data-places': Array<{
            id: string;
            'html-items': string;
        }>;
    };
}
```

### 2. Component Data Flow

#### Menu Component
```mermaid
graph TD
    A[Menu Component] -->|Gets| B[Menu Items]
    B -->|Generates| C[HTML Structure]
    C -->|Renders| D[Navigation Menu]
    D -->|Triggers| E[Menu Events]
    E -->|Updates| F[UI State]
```

#### User Info Component
```mermaid
graph TD
    A[User Session] -->|Provides| B[User Data]
    B -->|Processed by| C[UserInfo Component]
    C -->|Generates| D[User Menu]
    D -->|Responds to| E[User Actions]
```

## IslamDashboard Data Flow

### 1. Dashboard Initialization
```mermaid
sequenceDiagram
    participant User
    participant Dashboard as IslamDashboard
    participant API as MW API
    participant Components as Dashboard Widgets
    
    User->>Dashboard: Access dashboard
    Dashboard->>API: Request widget data
    API-->>Dashboard: Return JSON
    Dashboard->>Components: Initialize widgets
    Components-->>Dashboard: Render widgets
    Dashboard-->>User: Display dashboard
```

### 2. Widget Data Flow
```mermaid
sequenceDiagram
    participant Widget as Dashboard Widget
    participant Dashboard as IslamDashboard
    participant API as MW API
    
    Widget->>Dashboard: Request data
    Dashboard->>API: Fetch widget data
    API-->>Dashboard: Return JSON
    Dashboard-->>Widget: Provide data
    Widget->>Widget: Update UI
```

## Performance Considerations

### 1. Caching Strategies
- **Server-Side**:
  - Use MediaWiki's parser cache
  - Implement component-level caching
  - Cache template rendering results
  
- **Client-Side**:
  - Leverage browser caching
  - Implement data caching in JavaScript
  - Use localStorage for user-specific data

### 2. Data Loading
- **Initial Load**:
  - Include critical data in the initial HTML
  - Defer non-critical resources
  
- **Lazy Loading**:
  - Load widget data asynchronously
  - Implement infinite scrolling for long lists
  - Use intersection observer for below-the-fold content

## Security Considerations

### 1. Data Sanitization
- Always escape user-generated content
- Use MediaWiki's sanitization functions
- Validate all API responses

### 2. Permissions
- Check user permissions before displaying sensitive data
- Implement proper access controls
- Log security-relevant actions

## Debugging Data Flow

### 1. Server-Side Debugging
```php
// Enable debug logging
$wgDebugLogFile = '/path/to/debug.log';
$wgDebugToolbar = true;

// Dump template data
debug_zval_dump($templateData);
```

### 2. Client-Side Debugging
```javascript
// Debug ResourceLoader modules
mw.loader.using('skins.islam.scripts').done(function() {
    console.log('Islam scripts loaded');    
});

// Debug API calls
console.log('API response:', response);
```

## Best Practices

### 1. Data Handling
- Keep data transformations minimal
- Cache expensive operations
- Validate all inputs

### 2. Performance
- Minimize data transfer
- Use efficient data structures
- Implement proper error handling

### 3. Maintainability
- Document data structures
- Follow consistent naming conventions
- Write unit tests for data transformations
