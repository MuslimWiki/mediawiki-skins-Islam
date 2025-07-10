<?php

declare( strict_types=1 );

namespace MediaWiki\Skins\Islam\Components;

use MediaWiki\Registration\ExtensionRegistry;
use MediaWiki\Skin\SkinComponentUtils;
use MessageLocalizer;

/**
 * IslamComponentSearchBox component
 */
class IslamComponentSearchBox implements IslamComponent {

	public function __construct(
		private MessageLocalizer $localizer,
		private ExtensionRegistry $extensionRegistry,
		private array $searchBoxData
	) {
	}

	/**
	 * Get the keyboard hint data
	 */
	private function getKeyboardHintData(): array {
		$data = [];
		// There is probably a cleaner way to handle this
		$map = [
			'↑ ↓' => $this->localizer->msg( "islam-search-keyhint-select" )->text(),
			'/' => $this->localizer->msg( "islam-search-keyhint-open" )->text(),
			'Esc' => $this->localizer->msg( "islam-search-keyhint-exit" )->text()
		];

		foreach ( $map as $key => $label ) {
			$keyhint = new IslamComponentKeyboardHint( $label, $key );
			$data[] = $keyhint->getTemplateData();
		}
		return $data;
	}

	/**
	 * Get the footer message
	 */
	private function getFooterMessage(): string {
		$isCirrusSearchExtensionEnabled = $this->extensionRegistry->isLoaded( 'CirrusSearch' );
		$searchBackend = $isCirrusSearchExtensionEnabled ? 'cirrussearch' : 'mediawiki';
		return $this->localizer->msg(
			'islam-search-poweredby',
			$this->localizer->msg( "islam-search-poweredby-$searchBackend" )
		)->text();
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData(): array {
		$searchBoxData = $this->searchBoxData + [
			'array-keyboard-hint' => $this->getKeyboardHintData(),
			'msg-islam-search-footer' => $this->getFooterMessage(),
			'msg-islam-search-toggle-shortcut' => '[/]',
			'html-random-href' => SkinComponentUtils::makeSpecialUrl( 'Randompage' )
		];
		return $searchBoxData;
	}
}
