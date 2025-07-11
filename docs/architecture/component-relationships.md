# Component Relationships

> **Version Compatibility**: MediaWiki 1.43+

## 📊 Overview

This document provides detailed diagrams and explanations of the relationships between components in the Islam skin. These visualizations help understand how different parts of the skin interact and work together.

## 🏗️ High-Level Architecture

```mermaid
graph TD
    subgraph "MediaWiki Core"
        A[MediaWiki] -->|Extends| B[SkinMustache]
    end
    
    subgraph "Islam Skin"
        B --> C[SkinIslam]
        C -->|Manages| D[Template Engine]
        C -->|Loads| E[Resource Loader]
        
        D -->|Renders| F[Components]
        D -->|Uses| G[Templates]
        
        E -->|Loads| H[Styles]
        E -->|Loads| I[JavaScript]
        E -->|Loads| J[Assets]
    end
    
    subgraph "Components"
        F --> K[Menu]
        F --> L[UserInfo]
        F --> M[Search]
        F --> N[PageTools]
        K -->|Contains| O[MenuItems]
        L -->|Uses| P[UserMenu]
    end
    
    style A fill:#e1f5fe,stroke:#039be5
    style B fill:#bbdefb,stroke:#1976d2
    style C fill:#90caf9,stroke:#1565c0
    style F fill:#e8f5e9,stroke#388e3c
    style K,L,M,N fill:#c8e6c9,stroke#2e7d32
```

## 🔄 Component Interaction Diagram

```mermaid
sequenceDiagram
    participant M as MediaWiki
    participant S as SkinIslam
    participant C as Components
    participant T as Templates
    participant V as View
    
    M->>S: Initialize Skin
    S->>C: Instantiate Components
    C-->>S: Register Templates
    
    loop For each page load
        M->>S: Generate Output
        S->>C: Prepare Data
        C-->>S: Return Component Data
        S->>T: Render Templates with Data
        T-->>S: Return Rendered HTML
        S-->>M: Return Complete Page
        M->>V: Display to User
    end
    
    Note right of V: User interacts with page
    V->>C: Handle Events
    C->>T: Update Templates
    T-->>V: Update DOM
```

## 📦 Component Dependencies

```mermaid
graph TD
    A[Menu] -->|Uses| B[MenuContents]
    B -->|Uses| C[MenuListItem]
    C -->|Uses| D[Link]
    
    E[UserInfo] -->|Uses| F[Menu]
    E -->|Uses| G[MenuListItem]
    
    H[PageTools] -->|Uses| I[Menu]
    H -->|Uses| J[MenuContents]
    
    K[Search] -->|Uses| L[Menu]
    
    style A fill:#e8f5e9,stroke#2e7d32
    style B,C,D fill:#c8e6c9,stroke#2e7d32
    style E,F,G fill:#e1f5fe,stroke#039be5
    style H,I,J fill#fff3e0,stroke#ef6c00
    style K,L fill#f3e5f5,stroke#8e24aa
```

## 🔄 Data Flow

```mermaid
flowchart LR
    A[MediaWiki] -->|1. Request| B[SkinIslam]
    B -->|2. Get Data| C[Components]
    C -->|3. Process Data| D[Template Data]
    D -->|4. Render| E[Mustache Templates]
    E -->|5. HTML| F[Browser]
    F -->|6. User Interaction| G[Components]
    G -->|7. Update| F
```

## 🏗️ Template Hierarchy

```mermaid
graph TD
    A[skin.mustache] --> B[Header]
    A --> C[Content]
    A --> D[Footer]
    
    B --> E[Logo]
    B --> F[Search]
    B --> G[UserMenu]
    
    C --> H[PageTools]
    C --> I[Article]
    C --> J[Sidebar]
    
    D --> K[FooterLinks]
    D --> L[Copyright]
    
    G --> M[UserInfo]
    G --> N[Menu]
    
    style A fill:#e1f5fe,stroke#039be5
    style B,C,D fill:#bbdefb,stroke#1976d2
    style E,F,G,H,I,J,K,L fill#90caf9,stroke#1565c0
    style M,N fill#64b5f6,stroke#0d47a1
```

## 🛠️ Component Lifecycle

```mermaid
stateDiagram-v2
    [*] --> Initialized
    Initialized --> DataLoaded: Load Data
    DataLoaded --> Rendered: Render Templates
    Rendered --> [*]: Destroy
    Rendered --> DataChanged: Update Data
    DataChanged --> Rendered
    
    state DataLoaded {
        [*] --> ProcessData
        ProcessData --> ValidateData
        ValidateData --> [*]
    }
    
    state Rendered {
        [*] --> EventListeners
        EventListeners --> HandleEvents
        HandleEvents --> [*]
    }
```

## 📱 Responsive Layout

```mermaid
graph TD
    subgraph "Mobile View"
        A[Hamburger Menu] --> B[Slide-out Panel]
        B --> C[Main Menu]
        B --> D[User Menu]
        E[Search Bar] --> F[Expanded on Tap]
    end
    
    subgraph "Tablet View"
        G[Collapsible Sidebar] --> H[Main Menu]
        I[Header] --> J[Logo]
        I --> K[Search]
        I --> L[User Menu]
    end
    
    subgraph "Desktop View"
        M[Full Header] --> N[Logo + Navigation]
        N --> O[Horizontal Menu]
        P[Sidebar] --> Q[Secondary Navigation]
        R[Content] --> S[Main Content]
        R --> T[Right Rail]
    end
```

## 🔄 Event Flow

```mermaid
sequenceDiagram
    participant U as User
    participant C as Component
    participant M as Mediator
    participant S as Skin
    
    U->>C: Interacts with Component
    C->>M: Dispatch Event
    M->>S: Handle Global Event
    S->>C: Update State
    C->>U: Update UI
    
    Note right of U: Example: Toggle Menu
    U->>C: Clicks Menu Toggle
    C->>M: 'menu:toggle' Event
    M->>S: Update Menu State
    S->>C: New State (open/closed)
    C->>U: Animate Menu
```

## 📚 Related Documents

- [Architecture Overview](./overview.md)
- [Component Documentation](../components/README.md)
- [Template Guide](../templates/README.md)
- [Styling Architecture](./styling.md)

## 📝 Version History

| Version | Changes |
|---------|---------|
| 1.0.0   | Initial release |
| 1.1.0   | Added responsive layout diagrams |
| 1.2.0   | Enhanced component interactions |

## 🤝 Contributing

When updating these diagrams:
1. Keep them in sync with code changes
2. Use consistent styling
3. Update version numbers
4. Document any assumptions

## 🔍 See Also

- [Mermaid.js Documentation](https://mermaid-js.github.io/)
- [MediaWiki Skin Development](https://www.mediawiki.org/wiki/Manual:Skinning)
- [Islam Skin Components](../components/)
