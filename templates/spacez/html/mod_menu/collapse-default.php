<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2021 Open Source Matters, Inc. <https://www.joomla.org>
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*
* @copyright	for changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
*/

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

//HTMLHelper::_('bootstrap.collapse');
?>

<nav class="navbar navbar-expand-lg testing">
  <div class="container-fluid">
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-<?php echo $module->id ?>"  aria-expanded="false" aria-label="Toggle navigation">
		<?php echo smico('menu', 24) ?>
	</button>
	<div class="collapse navbar-collapse" id="navbar-<?php echo $module->id; ?>">
		<?php require __DIR__ . '/default.php'; ?>
	</div>
	</div>
</nav>
