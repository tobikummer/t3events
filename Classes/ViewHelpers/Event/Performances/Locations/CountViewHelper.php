<?php
namespace DWenzel\T3events\ViewHelpers\Event\Performances\Locations;

	/***************************************************************
	 *  Copyright notice
	 *  (c)* 2013 Dirk Wenzel <wenzel@webfox01.de> All rights reserved
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 2 of the License, or
	 *  (at your option) any later version.
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/
/**
 * Return the number of locations for a given event
 *
 * @author Dirk Wenzel
 * @package T3events
 * @subpackage ViewHelpers/Event/Performances/Locations
 */

class CountViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Inititalize Arguments
	 */

	public function initializeArguments() {
		parent::registerArgument('event', '\\DWenzel\\T3events\\Domain\\Model\\Event', 'Event whose performances should be rendered.', TRUE);
	}

	/**
	 * Render method
	 *
	 * @return \string
	 */
	public function render() {
		$performances = $this->arguments['event']->getPerformances();
		$locationsArray = array();

		// get uids of locations
		foreach ($performances as $performance) {
			$eventLocation = $performance->getEventLocation();
			if ($eventLocation) {
				array_push($locationsArray, $eventLocation->getUid());
			}
		}
		// make array unique
		$locationsArray = array_values(array_unique($locationsArray));

		return count($locationsArray);
	}
}

