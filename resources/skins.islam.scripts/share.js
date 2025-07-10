/**
 * Initializes the share button functionality for Islam
 *
 * @return {void}
 */
function init() {
	const shareButton = document.getElementById( 'islam-share' );
	if ( !shareButton ) {
		// Islam will not add the islam-share element if the share button is undesirable
		return;
	}

	const canonicalLink = document.querySelector( 'link[rel="canonical"]' );
	const url = canonicalLink ? canonicalLink.href : window.location.href;
	const shareData = {
		title: document.title,
		url: url
	};

	// eslint-disable-next-line es-x/no-async-functions
	const handleShareButtonClick = async () => {
		shareButton.disabled = true; // Disable the button
		try {
			if ( navigator.share ) {
				await navigator.share( shareData );
			} else if ( navigator.clipboard ) {
				// Fallback to navigator.clipboard if Share API is not supported
				await navigator.clipboard.writeText( url );
				mw.notify( mw.msg( 'islam-share-copied' ), {
					tag: 'islam-share',
					type: 'success'
				} );
			}
		} catch ( error ) {
			mw.log.error( `[Islam] ${ error }` );
		} finally {
			shareButton.disabled = false; // Re-enable button after error or share completes
		}
	};

	shareButton.addEventListener( 'click', mw.util.debounce( handleShareButtonClick, 100 ) );
}

module.exports = {
	init: init
};
