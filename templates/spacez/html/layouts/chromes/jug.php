<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2020 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
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

$moduleTag						 = $params->get('module_tag', 'div');
$moduleAttribs				 = [];
$moduleAttribs['class'] = $module->position . ' ' . htmlspecialchars($params->get('moduleclass_sfx'), ENT_QUOTES, 'UTF-8');
$headerTag						 = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass						= htmlspecialchars($params->get('header_class', ''), ENT_QUOTES, 'UTF-8');
$headerAttribs				 = [];
$headerAttribs['class'] = $headerClass;

$moduleAttribs['aria-label'] = $module->title;

$header = '<' . $headerTag . ' ' . ArrayHelper::toString($headerAttribs) . '>' . $module->title . '</' . $headerTag . '>';
?>
<<?php echo $moduleTag; ?> <?php echo ArrayHelper::toString($moduleAttribs); ?>>
		<?php if ($module->showtitle) : ?>
			<?php echo $header; ?>
		<?php endif; ?>
		<?php echo $module->content; ?>
</<?php echo $moduleTag; ?>>
