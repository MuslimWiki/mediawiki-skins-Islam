<?php

declare( strict_types=1 );

namespace MediaWiki\Skins\Islam\Components;

/**
 * IslamComponentKeyboardHint component
 */
class IslamComponentKeyboardHint implements IslamComponent {

	public function __construct(
		private string $label = '',
		private string $key = ''
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData(): array {
		return [
			'label' => $this->label,
			'key' => $this->key,
		];
	}
}
