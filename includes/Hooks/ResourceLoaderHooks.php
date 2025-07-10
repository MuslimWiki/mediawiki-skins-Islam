<?php
/**
 * Islam - A responsive skin developed for the Star Islam Wiki
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

declare( strict_types=1 );

namespace MediaWiki\Skins\Islam\Hooks;

use MediaWiki\Config\Config;
use MediaWiki\MainConfigNames;
use MediaWiki\Registration\ExtensionRegistry;
use MediaWiki\ResourceLoader as RL;

/**
 * Hooks to run relating to the resource loader
 */
class ResourceLoaderHooks {

	/**
	 * Passes config variables to skins.islam.scripts ResourceLoader module.
	 * @param RL\Context $context
	 * @param Config $config
	 * @return array
	 */
	public static function getIslamResourceLoaderConfig(
		RL\Context $context,
		Config $config
	) {
		return [
			'wgIslamEnablePreferences' => $config->get( 'IslamEnablePreferences' ),
			'wgIslamOverflowInheritedClasses' => $config->get( 'IslamOverflowInheritedClasses' ),
			'wgIslamOverflowNowrapClasses' => $config->get( 'IslamOverflowNowrapClasses' ),
			'wgIslamSearchModule' => $config->get( 'IslamSearchModule' ),
			'wgIslamEnableCommandPalette' => $config->get( 'IslamEnableCommandPalette' ),
		];
	}

	/**
	 * Passes config variables to skins.islam.preferences ResourceLoader module.
	 * @param RL\Context $context
	 * @param Config $config
	 * @return array
	 */
	public static function getIslamPreferencesResourceLoaderConfig(
		RL\Context $context,
		Config $config
	) {
		return [
			'wgIslamThemeDefault' => $config->get( 'IslamThemeDefault' ),
		];
	}

	/**
	 * Passes config variables to skins.islam.search ResourceLoader module.
	 * @param RL\Context $context
	 * @param Config $config
	 * @return array
	 */
	public static function getIslamSearchResourceLoaderConfig(
		RL\Context $context,
		Config $config
	) {
		$extensionRegistry = ExtensionRegistry::getInstance();

		return [
			'isAdvancedSearchExtensionEnabled' => $extensionRegistry->isLoaded( 'AdvancedSearch' ),
			'isMediaSearchExtensionEnabled' => $extensionRegistry->isLoaded( 'MediaSearch' ),
			'wgIslamSearchGateway' => $config->get( 'IslamSearchGateway' ),
			'wgIslamSearchDescriptionSource' => $config->get( 'IslamSearchDescriptionSource' ),
			'wgIslamMaxSearchResults' => $config->get( 'IslamMaxSearchResults' ),
			'wgScriptPath' => $config->get( MainConfigNames::ScriptPath ),
			'wgSearchSuggestCacheExpiry' => $config->get( MainConfigNames::SearchSuggestCacheExpiry )
		];
	}

	/**
	 * Passes config variables to skins.islam.commandPalette ResourceLoader module.
	 * @param RL\Context $context
	 * @param Config $config
	 * @return array
	 */
	public static function getIslamCommandPaletteResourceLoaderConfig(
		RL\Context $context,
		Config $config
	) {
		$extensionRegistry = ExtensionRegistry::getInstance();

		return [
			'isMediaSearchExtensionEnabled' => $extensionRegistry->isLoaded( 'MediaSearch' ),
			'wgSearchSuggestCacheExpiry' => $config->get( MainConfigNames::SearchSuggestCacheExpiry )
		];
	}
}
