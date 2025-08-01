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
 * Example Simple Command
 *
 * This demonstrates registering a simple command without a sub-query.
 * It performs an action directly when selected.
 *
 * @type {CommandPaletteCommand}
 */
const exampleSimpleCommand = {
	/**
	 * Unique identifier for this command.
	 */
	id: 'example-simple',

	/**
	 * Triggers: Keywords that activate this command.
	 * Should not end with a colon as there's no sub-query.
	 */
	triggers: [ '/simple', '/sim' ],

	/**
	 * Description: A short explanation shown below the label.
	 */
	description: 'Executes a simple action directly.',

	/**
	 * onCommandSelect: Handles selection of the command item itself.
	 * Since there's no sub-query, this performs the final action.
	 *
	 * @param {CommandPaletteItem} item The selected command item.
	 * @return {CommandPaletteNoneAction} Action result for the UI.
	 */
	onCommandSelect( item ) {
		console.debug( '[ExampleSimpleCommand] Command selected:', item );
		mw.notify( `Simple command '${ item.label }' executed!` );
		return { action: 'none' };
	},

	// No getResults or onResultSelect needed for a simple command.
	type: 'command-example-simple' // Add a specific type if needed
};

// Register the command
mw.loader.using( 'skins.islam.commandPalette' ).then( () => {
	mw.hook( 'skins.islam.commandPalette.registerCommand' ).add( ( registrationData ) => {
		if ( registrationData && registrationData.registerCommand ) {
			registrationData.registerCommand( exampleSimpleCommand );
		}
	} );
} );
