<?php

declare( strict_types=1 );

namespace MediaWiki\Skins\Islam\Components;

/**
 * IslamComponentMenuListItem component
 */
class IslamComponentMenuListItem implements IslamComponent {

	public function __construct(
		private IslamComponentLink $link,
		private string $class = '',
		private string $id = ''
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData(): array {
		return [
			'array-links' => $this->link->getTemplateData(),
			'item-class' => $this->class,
			'item-id' => $this->id,
		];
	}
}
