<?php

declare( strict_types=1 );

namespace MediaWiki\Skins\Islam\Components;

/**
 * IslamComponentMainMenu component
 */
class IslamComponentMainMenu implements IslamComponent {

	public function __construct( private array $sidebarData ) {
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData(): array {
		$portletsRest = [];
		foreach ( $this->sidebarData[ 'array-portlets-rest' ] as $data ) {
			/**
			 * Remove toolbox from main menu as we moved it to article tools
			 * TODO: Move handling to SkinIslam.php after we convert pagetools to component
			 */
			if ( $data['id'] === 'p-tb' ) {
				continue;
			}
			$portletsRest[] = ( new IslamComponentMenu( $data ) )->getTemplateData();
		}
		$firstPortlet = new IslamComponentMenu( $this->sidebarData['data-portlets-first'] );

		return [
			'data-portlets-first' => $firstPortlet->getTemplateData(),
			'array-portlets-rest' => $portletsRest
		];
	}
}
