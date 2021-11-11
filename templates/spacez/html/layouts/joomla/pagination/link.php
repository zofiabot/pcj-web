<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2014 Open Source Matters, Inc. <https://www.joomla.org>
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*
* @copyright	for changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
require_once('templates/spacez/functions.php');

$item		= $displayData['data'];
$display = $item->text;
$app = Factory::getApplication();

switch ((string) $display)
{
	// Check for "Start" item
	case Text::_('JLIB_HTML_START') :
		$aria = Text::sprintf('JLIB_HTML_GOTO_POSITION', strtolower($item->text));
		$item->text = Text::_('JPREVIOUS');
		$icon = $app->getLanguage()->isRtl() ? 'chevrons-right' : 'chevrons-left';
		break;

	// Check for "Prev" item
	case $item->text === Text::_('JPREV') :
		$aria =Text::sprintf('JLIB_HTML_GOTO_POSITION', strtolower($item->text));
		$item->text = Text::_('JPREVIOUS');
		$icon = $app->getLanguage()->isRtl() ? 'chevron-right' : 'chevron-left' ;
		break;

	// Check for "Next" item
	case Text::_('JNEXT') :
		$aria = Text::sprintf('JLIB_HTML_GOTO_POSITION', strtolower($item->text));
		$item->text = Text::_('JNEXT');
		$icon = $app->getLanguage()->isRtl() ? 'chevron-left' : 'chevron-right';
		break;

	// Check for "End" item
	case Text::_('JLIB_HTML_END') :
		$aria = Text::sprintf('JLIB_HTML_GOTO_POSITION', strtolower($item->text));
		$icon = $app->getLanguage()->isRtl() ? 'chevrons-left' : 'chevrons-right';
		break;

	default:
		$aria = Text::sprintf('JLIB_HTML_GOTO_PAGE', strtolower($item->text));
		$icon = null;
		break;
}

if ($icon !== null)
{
	$display = smico($icon, 23, $display);
}

if ($displayData['active'])
{
	if ($item->base > 0)
	{
		$limit = 'limitstart.value=' . $item->base;
	}
	else
	{
		$limit = 'limitstart.value=0';
	}

	$class = 'active';

	if ($app->isClient('administrator'))
	{
		$link = 'href="#" onclick="document.adminForm.' . $item->prefix . $limit . '; Joomla.submitform();return false;"';
	}
	elseif ($app->isClient('site'))
	{
		$link = 'href="' . $item->link . '"';
	}
}
else
{
	$class = (property_exists($item, 'active') && $item->active) ? 'active' : 'disabled';
}

?>
<?php if ($displayData['active']) : ?>
	<li class="page-item">
		<a aria-label="<?php echo $aria; ?>" <?php echo $link; ?> class="page-link">
			<?php echo $display; ?>
		</a>
	</li>
<?php elseif (isset($item->active) && $item->active) : ?>
	<?php $aria = Text::sprintf('JLIB_HTML_PAGE_CURRENT', strtolower($item->text)); ?>
	<li class="<?php echo $class; ?> page-item">
		<span aria-current="true" aria-label="<?php echo $aria; ?>" class="page-link"><?php echo $display; ?></span>
	</li>
<?php else : ?>
	<li class="<?php echo $class; ?> page-item">
		<span class="page-link" aria-hidden="true"><?php echo $display; ?></span>
	</li>
<?php endif; ?>
