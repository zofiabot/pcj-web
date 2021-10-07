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
$title = $module->title;
$title = strtr( $title, [ '[[strong]]' => '<strong>', '[[/strong]]' => '</strong>' ]);

if ($module->content === null || $module->content === '')
{
	return;
}

$moduleTag						  = $params->get('module_tag', 'div');
$moduleAttribs				  = [];
$moduleAttribs['class'] = $module->position . ' ' . htmlspecialchars($params->get('moduleclass_sfx'), ENT_QUOTES, 'UTF-8');
$headerTag						  = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass						= htmlspecialchars($params->get('header_class', ''), ENT_QUOTES, 'UTF-8');
$headerAttribs				  = [];
$headerAttribs['class'] = $headerClass;

$moduleAttribs['aria-label'] = $title;

$header = '<' . $headerTag . ' ' . ArrayHelper::toString($headerAttribs) . '>' . $title . '</' . $headerTag . '>';
?>
<<?php echo $moduleTag; ?> <?php echo ArrayHelper::toString($moduleAttribs); ?>>
	<?php if ($module->showtitle && $headerClass !== 'card-title') : ?>
		<?php echo $header; ?>
	<?php endif; ?>
		<?php if ($module->showtitle && $headerClass === 'card-title') : ?>
			<?php echo $header; ?>
		<?php endif; ?>
		<?php echo $module->content; ?>
</<?php echo $moduleTag; ?>>
