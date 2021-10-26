<?php
/**
 * @package		 Joomla.Site
 * @subpackage  Templates.spacez
 *
 * @copyright		(C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
 * @license		 GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

$module  = $displayData['module'];

if ($module->content === null || $module->content === '')
{
	return;
}

echo tagReplace($module->content); 