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
 */

namespace MediaWiki\Skins\Islam\Api;

use MediaWiki\Api\ApiFormatJson;

/**
 * T282500
 * TODO: This should be merged to core
 */
class ApiWebappManifestFormatJson extends ApiFormatJson {

	/**
	 * Return the proper content-type
	 */
	public function getMimeType(): string {
		return 'application/manifest+json';
	}
}
