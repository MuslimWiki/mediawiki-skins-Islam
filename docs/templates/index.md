# Templates

This section contains documentation for all templates used in the Islam Skin. Templates define the structure and markup of UI components, separate from their logic.

## Available Templates

### Menu Templates
- [Menu](./menu/menu.md) - Main menu container
- [Menu Contents](./menu/contents.md) - Renders menu items
- [Menu List Item](./menu/list-item.md) - Individual menu item

### Other Templates
- [User Info](./user-info.md) - User profile and information display

## Template System Overview

The Islam Skin uses a template system that separates presentation from logic. Templates are written in a simple, HTML-like syntax with support for:

- Variables: `{{variable}}`
- Conditionals: `{{#if condition}}...{{/if}}`
- Loops: `{{#each items}}...{{/each}}`
- Partials: `{{> template-name}}`
- Helpers: `{{helperName arg1 arg2}}`

## Example Template

```handlebars
<!-- Example: menu.hbs -->
<nav class="menu {{#if isVertical}}menu-vertical{{/if}}">
  <ul>
    {{#each items}}
      {{> menu-item item=this}}
    {{/each}}
  </ul>
</nav>
```

## Template Helpers

### Built-in Helpers
- `eq`: Equality check
- `ne`: Not equal
- `gt`: Greater than
- `lt`: Less than
- `and`: Logical AND
- `or`: Logical OR
- `not`: Logical NOT

### Custom Helpers
You can also create custom helpers for your templates. See the [Custom Helpers](../development/template-helpers.md) guide for more information.

## Best Practices

1. **Keep Templates Simple**: Focus on presentation logic only
2. **Reuse Templates**: Use partials to avoid duplication
3. **Document Variables**: Clearly document all available variables
4. **Accessibility**: Use semantic HTML and ARIA attributes
5. **Performance**: Avoid complex logic in templates

## Extending Templates

To customize a template:

1. Copy the template file to your project
2. Make your changes
3. Configure the skin to use your custom template

## Next Steps

- Learn about [Component Templates](../components/README.md)
- Explore the [Template API Reference](../reference/api/templates.md)
- Read the [Template Best Practices](../template-best-practices.md) guide
