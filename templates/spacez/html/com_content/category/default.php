<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*
* @copyright	for changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
*/

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

?>
<div class="com-content-category category-list">

<?php
$this->subtemplatename = 'articles';
echo LayoutHelper::render('joomla.content.category_default', $this);
?>

</div>
