<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Phoca Component
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.helper');

class PhocaMapsHelperRoute
{

	function getMapRoute($id, $idAlias = '') {
		$needles = array(
			'map'  => (int) $id
		);
		
		
		if ($idAlias != '') {
			$id = $id . ':' . $idAlias;
		}
		
		//Create the link
		$link = 'index.php?option=com_phocamaps&view=map&id='. $id;

		if($item = PhocaMapsHelperRoute::_findItem($needles)) {
			if(isset($item->id)) {
				$link .= '&Itemid='.$item->id;
			}
		}

		return $link;
	}
	
	function getPrintRouteRoute($id, $idAlias = '', $suffix = '') {
		$needles = array(
			'map'  => (int) $id
		);
		
		
		if ($idAlias != '') {
			$id = $id . ':' . $idAlias;
		}

		if ($suffix != '') {
			$suffix = '&'. $suffix;
		}
		
		$link = 'index.php?option=com_phocamaps&view=route&id='. $id . $suffix;
		
		if($item = PhocaMapsHelperRoute::_findItem($needles)) {
			if(isset($item->id)) {
				$link .= '&Itemid='.$item->id;
			}
		}

		return $link;
	}


	function _findItem($needles, $notCheckId = 0)
	{
		$component =& JComponentHelper::getComponent('com_phocamaps');

		$menus	= &JApplication::getMenu('site', array());
		$items	= $menus->getItems('componentid', $component->id);

		if(!$items) {
			return JRequest::getVar('Itemid', 0, '', 'int');
			//return null;
		}
		
		$match = null;
		

		foreach($needles as $needle => $id)
		{
			
			if ($notCheckId == 0) {
				foreach($items as $item) {
					if ((@$item->query['view'] == $needle) && (@$item->query['id'] == $id)) {
						$match = $item;
						break;
					}
				}
			} else {
				foreach($items as $item) {
					if (@$item->query['view'] == $needle) {
						$match = $item;
						break;
					}
				}
			}

			if(isset($match)) {
				break;
			}
		}

		return $match;
	}
}
?>
