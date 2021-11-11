<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*
* @copyright	for changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
*/

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

// Add strings for translations in Javascript.
Text::script('JGLOBAL_EXPAND_CATEGORIES');
Text::script('JGLOBAL_COLLAPSE_CATEGORIES');

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa*/
$wa = $this->document->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('com_categories');
// $wa->usePreset('com_categories.shared-categories-accordion');

?>
<div class="com-content-categories categories-list">
	<?php
		echo LayoutHelper::render('joomla.content.categories_default', $this);
		echo $this->loadTemplate('items');
	?>
</div>
