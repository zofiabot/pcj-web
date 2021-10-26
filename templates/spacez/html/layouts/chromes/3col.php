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
$params  = $displayData['params'];
$attribs = $displayData['attribs'];

if ($module->content === null || $module->content === '')
{
	return;
}

$moduleTag						  = $params->get('module_tag', 'div');
$moduleAttribs				  = [];
$moduleAttribs['class'] = $module->position . ' col-12 col-md-4 mb-4 g-4 mod-' . $module->id . htmlspecialchars($params->get('moduleclass_sfx'), ENT_QUOTES, 'UTF-8');
$headerTag						  = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass						= htmlspecialchars($params->get('header_class', ''), ENT_QUOTES, 'UTF-8');
$headerAttribs				  = [];

// Only output a header class if one is set
if ($headerClass !== '')
{
	$headerAttribs['class'] = $headerClass;
}

// Only add aria if the moduleTag is not a div
if ($moduleTag !== 'div')
{
	if ($module->showtitle) :
		$moduleAttribs['aria-labelledby'] = 'mod-' . $module->id;
		$headerAttribs['id']						  = 'mod-' . $module->id;
	else:
		$moduleAttribs['aria-label'] = $module->title;
	endif;
}

$headerAttribs = ArrayHelper::toString($headerAttribs);
$moduleAttribs = ArrayHelper::toString($moduleAttribs);

$header = "<{$headerTag} {$headerAttribs}>{$module->title}</{$headerTag}>";

echo "<{$moduleTag} {$moduleAttribs}>";
if ($module->showtitle) {echo tagReplace($header);}
echo tagReplace($module->content);
echo "</{$moduleTag}>";