<?php
/**
 * @package		 Joomla.Site
 * @subpackage  Templates.spacez
 *
 * @copyright		(C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license		 GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
//$wa->registerAndUseScript('mod_menu', 'mod_menu/menu.min.js', [], ['type' => 'module']);
//$wa->registerAndUseScript('mod_menu', 'mod_menu/menu-es5.min.js', [], ['nomodule' => true, 'defer' => true]);

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use mod-menu instead
?>
<ul<?php echo $id; ?> class="nav col-12 me-lg-auto mb-2 justify-content-center mb-md-0 navbar-nav <?php echo $class_sfx; ?>">
<?php foreach ($list as $i => &$item)
{
	$itemParams = $item->getParams();
	$class		  = 'item-' . $item->id;
	
	if ($item->level == 1)
	{
	 $class .= ' nav-item';
	}

	if ($item->deeper && $item->level == 1)
	{
		$class .= ' dropdown';
	}

	if ($item->id == $default_id)
	{
		$class .= ' default';
	}

	if ($item->id == $active_id || ($item->type === 'alias' && $itemParams->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $itemParams->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
		else {
		$class .= '';
		}
	}

	if ($item->type === 'separator')
	{
		$class .= ' divider';
	}
	
	if ($item->parent)
	{
		$class .= '';
	}


	echo '<li class="' . $class . '">';

	switch ($item->type) :

		case 'separator':
		case 'component':
		case 'heading':
			// require ModuleHelper::getLayoutPath('mod_menu', 'spacez-default_' . $item->type);
			require ModuleHelper::getLayoutPath('mod_menu', 'spacez-default_url');
			break;
		case 'url':
		default:
			//require ModuleHelper::getLayoutPath('mod_menu', 'spacez-default_' . $item->type);
			require ModuleHelper::getLayoutPath('mod_menu', 'spacez-default_url');
			break;

	endswitch;

	// The next item is deeper.
if ($item->deeper)
	{
		if ($item->level == 1)
		{
		 $ulclass = 'dropdown-menu';
		}
		else
		{
		 $ulclass = 'submenu dropdown-menu';
		}
		echo '<ul class="' . $ulclass . '">';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else
	{
		echo '</li>';
	}
}
?></ul>
