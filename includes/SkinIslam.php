<?php
/**
 * Islam - A responsive skin developed for MuslimWiki
 *
 * This file is part of Islam.
 *
 * Islam is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Islam is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Islam.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @file
 * @ingroup Skins
 */

namespace MediaWiki\Skins\Islam;

use MediaWiki\MediaWikiServices;
use MediaWiki\Skins\Islam\Components\IslamComponentFooter;
use MediaWiki\Skins\Islam\Components\IslamComponentMainMenu;
use MediaWiki\Skins\Islam\Components\IslamComponentPageFooter;
use MediaWiki\Skins\Islam\Components\IslamComponentPageHeading;
use MediaWiki\Skins\Islam\Components\IslamComponentPageSidebar;
use MediaWiki\Skins\Islam\Components\IslamComponentPageTools;
use MediaWiki\Skins\Islam\Components\IslamComponentSearchBox;
use MediaWiki\Skins\Islam\Components\IslamComponentSiteStats;
use MediaWiki\Skins\Islam\Components\IslamComponentStickyHeader;
use MediaWiki\Skins\Islam\Components\IslamComponentUserInfo;
use MediaWiki\Skins\Islam\Partials\BodyContent;
use MediaWiki\Skins\Islam\Partials\Metadata;
use MediaWiki\Skins\Islam\Partials\Theme;
use SkinMustache;
use SkinTemplate;

/**
 * Skin subclass for Islam
 * @ingroup Skins
 */
class SkinIslam extends SkinMustache {

	/** For caching purposes */
	private ?array $languages = null;

	/**
	 * Overrides template, styles and scripts module
	 *
	 * @inheritDoc
	 */
	public function __construct( $options = [] ) {
		if ( !isset( $options['name'] ) ) {
			$options['name'] = 'islam';
		}

		// Add skin-specific features
		$this->buildSkinFeatures( $options );
		parent::__construct( $options );
	}

	/**
	 * Ensure onSkinTemplateNavigation runs after all SkinTemplateNavigation hooks
	 * @see T287622
	 *
	 * @param SkinTemplate $skin The skin template object.
	 * @param array &$content_navigation The content navigation array.
	 */
	protected function runOnSkinTemplateNavigationHooks( SkinTemplate $skin, &$content_navigation ) {
		parent::runOnSkinTemplateNavigationHooks( $skin, $content_navigation );
		Hooks\SkinHooks::onSkinTemplateNavigation( $skin, $content_navigation );
	}

	/**
	 * Calls getLanguages with caching.
	 * From Vector 2022
	 */
	protected function getLanguagesCached(): array {
		if ( $this->languages === null ) {
			$this->languages = $this->getLanguages();
		}
		return $this->languages;
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData(): array {
		$parentData = parent::getTemplateData();

		$config = $this->getConfig();
		$localizer = $this->getContext();
		$lang = $this->getLanguage();
		$out = $this->getOutput();
		$title = $this->getTitle();
		$user = $this->getUser();
		$pageLang = $title->getPageLanguage();
		$services = MediaWikiServices::getInstance();

		$bodycontent = new BodyContent( $this );

		$components = [
			'data-footer' => new IslamComponentFooter(
				$localizer,
				$parentData['data-footer']
			),
			'data-main-menu' => new IslamComponentMainMenu( $parentData['data-portlets-sidebar'] ),
			'data-page-footer' => new IslamComponentPageFooter(
				$localizer,
				$parentData['data-footer']['data-info']
			),
			'data-page-heading' => new IslamComponentPageHeading(
				$services,
				$localizer,
				$out,
				$pageLang,
				$title,
				$parentData['html-title-heading']
			),
			'data-page-sidebar' => new IslamComponentPageSidebar(
				$localizer,
				$title,
				$parentData['data-last-modified']
			),
			'data-page-tools' => new IslamComponentPageTools(
				$config,
				$localizer,
				$title,
				$user,
				$services->getPermissionManager(),
				count( $this->getLanguagesCached() ),
				$parentData['data-portlets-sidebar'],
				// These portlets can be unindexed
				$parentData['data-portlets']['data-languages'] ?? [],
				$parentData['data-portlets']['data-variants'] ?? []
			),
			'data-search-box' => new IslamComponentSearchBox(
				$localizer,
				$services->getExtensionRegistry(),
				$parentData['data-search-box']
			),
			'data-site-stats' => new IslamComponentSiteStats(
				$config,
				$localizer,
				$pageLang
			),
			'data-user-info' => new IslamComponentUserInfo(
				$services,
				$lang,
				$localizer,
				$title,
				$user,
				$parentData['data-portlets']['data-user-page']
			),
			'data-sticky-header' => new IslamComponentStickyHeader(
				$this->isVisualEditorTabPositionFirst( $parentData['data-portlets']['data-views'] )
			)
		];

		foreach ( $components as $key => $component ) {
			// Array of components or null values.
			if ( $component ) {
				$parentData[$key] = $component->getTemplateData();
			}
		}

		// HACK: So that we only get the tagline once
		$parentData['data-sticky-header']['html-sticky-header-tagline'] = $this->prepareStickyHeaderTagline( $parentData['data-page-heading']['html-tagline'] );

		// HACK: So that we can use Icon.mustache in Header__logo.mustache
		$parentData['data-logos']['icon-home'] = 'home';

		$isTocEnabled = !empty( $parentData['data-toc'][ 'array-sections' ] );
		if ( $isTocEnabled ) {
			$this->getOutput()->addBodyClasses( 'islam-toc-enabled' );
		}

		return array_merge( $parentData, [
			// Booleans
			'toc-enabled' => $isTocEnabled,
			'html-body-content--formatted' => $bodycontent->decorateBodyContent( $parentData['html-body-content'] )
		] );
	}

	/**
	 * Check whether Visual Editor Tab Position is first
	 * From Vector 2022
	 *
	 * @param array $dataViews
	 * @return bool
	 */
	private function isVisualEditorTabPositionFirst( array $dataViews ): bool {
		$names = [ 've-edit', 'edit' ];
		// find if under key 'name' 've-edit' or 'edit' is the before item in the array
		for ( $i = 0; $i < count( $dataViews[ 'array-items' ] ); $i++ ) {
			if ( in_array( $dataViews[ 'array-items' ][ $i ][ 'name' ], $names ) ) {
				return $dataViews[ 'array-items' ][ $i ][ 'name' ] === $names[ 0 ];
			}
		}
		return false;
	}

	/**
	 * Prepare the tagline for the sticky header
	 * Replace <a> elements with <span> elements because
	 * you can't nest <a> elements in <a> elements
	 *
	 * @param string $tagline
	 * @return string
	 */
	private function prepareStickyHeaderTagline( string $tagline ): string {
		return preg_replace( '/<a\s+href="([^"]+)"[^>]*>(.*?)<\/a>/', '<span>$2</span>', $tagline );
	}

	/**
	 * @inheritDoc
	 *
	 * Manually disable some site-wide tools in TOOLBOX
	 * They are re-added in the drawer
	 *
	 * TODO: Remove this hack when Desktop Improvements separate page and site tools
	 */
	protected function buildNavUrls(): array {
		$urls = parent::buildNavUrls();

		$urls['upload'] = false;
		$urls['specialpages'] = false;

		return $urls;
	}

	/**
	 * Add client preferences features
	 * Did not add the islam-feature- prefix because there might be features from core MW or extensions
	 *
	 * @param string $feature
	 * @param string $value
	 */
	private function addClientPrefFeature( string $feature, string $value = 'standard' ): void {
		$this->getOutput()->addHtmlClasses( $feature . '-clientpref-' . $value );
	}

	/**
	 * Set up optional skin features
	 */
	private function buildSkinFeatures( array &$options ): void {
		$config = $this->getConfig();
		$title = $this->getOutput()->getTitle();

		$metadata = new Metadata( $this );
		$skinTheme = new Theme( $this );

		// Add metadata
		$metadata->addMetadata();

		// Add theme handler
		$skinTheme->setSkinTheme();

		// Clientprefs feature handling
		$this->addClientPrefFeature( 'islam-feature-autohide-navigation', '1' );
		$this->addClientPrefFeature( 'islam-feature-pure-black', '0' );
		$this->addClientPrefFeature( 'islam-feature-custom-font-size' );
		$this->addClientPrefFeature( 'islam-feature-custom-width' );

		if ( $title !== null ) {
			// Collapsible sections
			if (
				$config->get( 'IslamEnableCollapsibleSections' ) === true &&
				$title->isContentPage()
			) {
				$options['bodyClasses'][] = 'islam-sections-enabled';
			}
		}

		// CJK fonts
		if ( $config->get( 'IslamEnableCJKFonts' ) === true ) {
			$options['styles'][] = 'skins.islam.styles.fonts.cjk';
		}

		// AR fonts
		if ( $config->get( 'IslamEnableARFonts' ) === true ) {
			$options['styles'][] = 'skins.islam.styles.fonts.ar';
		}
	}
}
