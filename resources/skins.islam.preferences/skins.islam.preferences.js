/**
 * Clientprefs names theme differently from Islam, we will need to translate it
 * TODO: Migrate to clientprefs fully on MW 1.43
 */

/**
 * Load client preferences based on the existence of 'islam-preferences__card' element.
 */
function loadClientPreferences() {
	const clientPreferenceId = 'islam-preferences-content';
	const clientPreferenceExists = document.getElementById( clientPreferenceId ) !== null;
	if ( clientPreferenceExists ) {
		const clientPreferences = require( /** @type {string} */( './clientPreferences.js' ) );
		const clientPreferenceConfig = ( require( './clientPreferences.json' ) );

		clientPreferences.render( `#${ clientPreferenceId }`, clientPreferenceConfig );
	}
}

/**
 * Set up the listen for preferences button
 *
 * @return {void}
 */
function listenForButtonClick() {
	const details = document.getElementById( 'islam-preferences-details' );
	if ( !details ) {
		return;
	}
	details.addEventListener( 'click', loadClientPreferences, { once: true } );
}

listenForButtonClick();
