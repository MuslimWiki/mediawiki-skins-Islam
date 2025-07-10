<?php

declare( strict_types=1 );

namespace MediaWiki\Skins\Islam\Components;

/**
 * Component interface for managing Islam-modified components
 *
 * @internal
 */
interface IslamComponent {

	public function getTemplateData(): array;
}
