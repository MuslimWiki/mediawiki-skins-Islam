<?php

declare( strict_types=1 );

namespace MediaWiki\Skins\Islam\Components;

use MessageLocalizer;

/**
 * IslamComponentFooter component
 */
class IslamComponentFooter implements IslamComponent {

	public function __construct(
		private MessageLocalizer $localizer,
		private array $footerData
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData(): array {
		$localizer = $this->localizer;
		$footerData = $this->footerData;

		return $footerData + [
			'msg-islam-footer-desc' => $localizer->msg( "islam-footer-desc" )->inContentLanguage()->parse(),
			'msg-islam-footer-tagline' => $localizer->msg( "islam-footer-tagline" )->inContentLanguage()->parse()
		];
	}
}
