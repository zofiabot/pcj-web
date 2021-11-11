<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*
* @copyright	for changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
*/

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

$module  = $displayData['module'];

if ($module->content === null || $module->content === '')
{
	return;
}

echo tagReplace($module->content); 