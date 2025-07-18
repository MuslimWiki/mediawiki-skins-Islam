<!--
Partially based on the MenuItem component from Codex.
@see https://github.com/wikimedia/design-codex/blob/main/packages/codex/src/components/menu-item/MenuItem.vue
-->
<!-- eslint-disable max-len -->
<template>
	<li
		:id="id"
		ref="rootRef"
		role="option"
		:aria-selected="highlighted"
		class="islam-command-palette-list-item"
		:class="rootClasses"
		:data-type="type"
		@mousedown.prevent="onMouseDown"
		@click.prevent="onClick"
	>
		<command-palette-list-item-content
			:label="label"
			:description="description"
			:thumbnail="thumbnail"
			:thumbnail-icon="thumbnailIcon"
			:metadata="metadata"
			:type="type"
			:type-label="typeLabel"
			:search-query="searchQuery"
			:url="url"
			:highlight-query="highlightQuery"
		></command-palette-list-item-content>
		<command-palette-list-item-actions
			ref="actionsRef"
			:item-id="id"
			:actions="actions"
			:highlighted="highlighted"
			@action="onAction"
			@navigate-list="$emit( 'navigate-list', $event )"
			@focus-action="$emit( 'focus-action', $event )"
			@blur-actions="$emit( 'blur-actions' )"
		></command-palette-list-item-actions>
	</li>
</template>

<script>
const { defineComponent, computed, ref } = require( 'vue' );
// Import the new sub-components
const CommandPaletteListItemContent = require( './CommandPaletteListItemContent.vue' );
const CommandPaletteListItemActions = require( './CommandPaletteListItemActions.vue' );

// @vue/component
module.exports = exports = defineComponent( {
	name: 'CommandPaletteListItem',
	components: {
		// Register the new sub-components
		CommandPaletteListItemContent,
		CommandPaletteListItemActions
	},
	props: {
		id: {
			type: String,
			required: true
		},
		active: {
			type: Boolean,
			default: false
		},
		highlighted: {
			type: Boolean,
			default: false
		},
		type: {
			type: String,
			required: true
		},
		label: {
			type: String,
			required: true
		},
		url: {
			type: String,
			default: ''
		},
		value: {
			type: String,
			default: ''
		},
		thumbnail: {
			type: [ Object, null ],
			default: null
		},
		thumbnailIcon: {
			type: [ String, Object ],
			default: ''
		},
		description: {
			type: [ String, null ],
			default: ''
		},
		searchQuery: {
			type: String,
			default: ''
		},
		metadata: {
			type: Array,
			default: () => []
		},
		actions: {
			type: Array,
			default: () => []
		},
		highlightQuery: {
			type: Boolean,
			default: false
		},
		source: {
			type: String,
			default: undefined
		}
	},
	emits: [
		'select',
		'action',
		'navigate-list',
		'focus-action',
		'blur-actions',
		'change'
	],
	setup( props, { emit, expose } ) {
		const rootRef = ref( null );
		const actionsRef = ref( null );

		// --- Item Interaction Logic ---
		const onMouseDown = ( e ) => {
			// Prevents focus shifting from the input field
			// and triggering blur on the command palette.
			// Also used to set the item to 'active' visually.
			if ( e.button === 0 ) {
				emit( 'change', 'active', true );
			}
		};

		const onClick = ( event ) => {
			emit( 'select', {
				id: props.id,
				label: props.label,
				url: props.url,
				type: props.type,
				value: props.value,
				thumbnail: props.thumbnail,
				thumbnailIcon: props.thumbnailIcon,
				description: props.description,
				metadata: props.metadata,
				actions: props.actions,
				source: props.source,
				eventDetails: {
					button: event.button,
					ctrlKey: event.ctrlKey,
					metaKey: event.metaKey,
					shiftKey: event.shiftKey,
					altKey: event.altKey
				}
			} );
		};

		// --- Action Handling ---
		const onAction = ( actionPayload ) => {
			// Simply forward the event from the actions sub-component
			emit( 'action', actionPayload );
		};

		// --- Computed Properties ---
		const rootClasses = computed( () => ( {
			'islam-command-palette-list-item--active': props.active && props.highlighted,
			'islam-command-palette-list-item--highlighted': props.highlighted
		} ) );

		// Messages that can be used here:
		// * islam-command-palette-type-page
		// eslint-disable-next-line mediawiki/msg-doc
		const typeLabel = computed( () => mw.message( `islam-command-palette-type-${ props.type }` ).text() );

		// --- Expose Methods ---
		expose( {
			focusFirstButton: () => actionsRef.value?.focusFirstButton(),
			focusLastButton: () => actionsRef.value?.focusLastButton()
		} );

		return {
			// Refs
			rootRef,
			actionsRef,
			// Event Handlers
			onMouseDown,
			onClick,
			onAction,
			// Computed
			rootClasses,
			typeLabel
		};
	}
} );
</script>

<style lang="less">
.islam-command-palette-list-item {
	position: relative;
	outline: 0;
	list-style: none;

	&--highlighted {
		cursor: pointer;
		background-color: var( --background-color-interactive-subtle--hover );
		--actions-fade-color: var( --background-color-interactive-subtle--hover );
	}

	&--active {
		background-color: var( --background-color-interactive-subtle--active );
		--actions-fade-color: var( --background-color-interactive-subtle--active );
	}
}
</style>
