<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Dirk Wenzel <wenzel@webfox01.de>, Agentur Webfox
 *  Michael Kasten <kasten@webfox01.de>, Agentur Webfox
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package t3events
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_T3events_Service_ExtensionService extends Tx_Extbase_Service_ExtensionService implements t3lib_Singleton {
	
	/**
     * Checks if the given action is cacheable or not.
     *
     * Method from parent class overwritten to allow evaluation of plugin setting 'makeNonCachable'.
     * Thus an editor is able to force an non caching behavior of the plugin.
     *
     * @param string $extensionName Name of the target extension, without underscores
     * @param string $pluginName Name of the target plugin
     * @param string $controllerName Name of the target controller
     * @param string $actionName Name of the action to be called
     * @return boolean TRUE if the specified plugin action is cacheable, otherwise FALSE
     */
    public function isActionCacheable($extensionName, $pluginName, $controllerName, $actionName) {
		$frameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, $extensionName, $pluginName);
        if ( !parent::isActionCacheable ($extensionName, $pluginName, $controllerName, $actionName) ||
        	isset($frameworkConfiguration['settings']['cache']['makeNonCacheable']) &&
        	$frameworkConfiguration['settings']['cache']['makeNonCacheable']) 
        	{
        		return FALSE;
			}
			return TRUE;
			
	} 
}

?>
