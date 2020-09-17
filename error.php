<?php
/**
* @package Joomla.Site
* @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
* @license GNU General Public License version 2 or later; see LICENSE.txt
*/
defined('_JEXEC') or die;
if (!isset($this->error)) {
$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
$this->debug = false;
}
//get language and direction
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php defined('JPATH_BASE') or die();
echo file_get_contents(JURI::root().'/index.php?option=com_content&Itemid=1000&id=71&lang=ru&view=article');?>