/**
 * This is an example for implementing the command through mw.hook(),
 * for places like MediaWiki:Islam.js or gadgets.
 *
 * If you are implementing a built-in command, please refer to other
 * non-example files in this directory.
 *
 * Note that site scripts and gadgets might not support Modern JS syntax (T381537, T389736).
 */

/* eslint-disable no-console */
/* Type declaration is not required, but is included for clarity. */
const { CommandPaletteCommand, CommandPaletteItem, CommandPaletteNoneAction } = require( '../types.js' );

/**
 * Example Sub-query Command
 *
 * This demonstrates registering a command that uses a sub-query to generate results.
 *
 * @type {CommandPaletteCommand}
 */
const exampleSubqueryCommand = {
	/**
	 * Unique identifier for this command.
	 */
	id: 'example-subquery',

	/**
	 * Triggers: Keywords that activate this command.
	 * Must end with a colon (':') to indicate a sub-query is expected.
	 */
	triggers: [ '/subquery:', '/sub:' ],

	/**
	 * Description: A short explanation shown below the label.
	 */
	description: 'Requires a sub-query to show results.',

	/**
	 * getResults: Function to fetch/generate results based on the sub-query.
	 * NOTE: async/await is not supported in some places in MW yet (T381537, T389736)
	 *
	 * @param {string} subQuery The part of the user's query *after* the matched trigger.
	 * @return {Promise<Array<CommandPaletteItem>>} A promise resolving to an array of result items.
	 */
	getResults( subQuery ) {
		console.debug( `[ExampleSubqueryCommand] Received subQuery: "${ subQuery }"` );

		// We always return a Promise, even if it's synchronous.
		return new Promise( ( resolve ) => {
			setTimeout( resolve, 150 ); // Simulate network delay
		} ).then( () => {
			let results = [];

			if ( subQuery.toLowerCase().startsWith( 'help' ) ) {
				results = [
					{
						id: 'example-subquery-help',
						label: 'Sub-query Help',
						description: 'Shows help info for the sub-query command.',
						value: '/subquery help' // Value to insert when selected
					}
				];
			} else if ( subQuery ) {
				// Example: Return items based on the sub-query
				results = [
					{
						id: `example-subquery-item-${ subQuery }-1`,
						label: `Result 1 for "${ subQuery }"`,
						description: 'First simulated result.',
						value: `/subquery ${ subQuery } item1`,
						highlightQuery: true // Tell the provider to highlight the subQuery
					},
					{
						id: `example-subquery-item-${ subQuery }-2`,
						label: `Result 2 for "${ subQuery }"`,
						description: 'Second simulated result.',
						value: `/subquery ${ subQuery } item2`,
						highlightQuery: true
					}
				];
			} else {
				// Example: Default results when no sub-query is provided yet
				results = [
					{
						id: 'example-subquery-default-1',
						label: 'Default Sub-query Action 1',
						description: 'Perform the first default sub-query action.',
						value: '/subquery default1'
					},
					{
						id: 'example-subquery-default-2',
						label: 'Default Sub-query Action 2',
						description: 'Perform the second default sub-query action.',
						value: '/subquery default2'
					}
				];
			}

			// Add type: 'command-example-subquery'
			return results.map( ( item ) => Object.assign( {}, item, { type: 'command-example-subquery' } ) );
		} );
	},

	/**
	 * onResultSelect: Handles selection of an item generated by this command.
	 *
	 * @param {CommandPaletteItem} item The selected item.
	 * @return {CommandPaletteNoneAction} Action result for the UI.
	 */
	onResultSelect( item ) {
		console.debug( '[ExampleSubqueryCommand] Item selected:', item );

		if ( item.id === 'example-subquery-help' ) {
			mw.notify( 'Displaying help for the sub-query command!' );
			return { action: 'none' }; // Stay in palette
		} else {
			mw.notify( `Action for ${ item.label } would run now.` );
			// Example: Navigate if item has a URL
			// if ( item.url ) {
			//     return { action: 'navigate', payload: item.url };
			// }
			return { action: 'none' };
		}
	}
};

// Register the command
mw.loader.using( 'skins.islam.commandPalette' ).then( () => {
	mw.hook( 'skins.islam.commandPalette.registerCommand' ).add( ( registrationData ) => {
		if ( registrationData && registrationData.registerCommand ) {
			registrationData.registerCommand( exampleSubqueryCommand );
		}
	} );
} );
