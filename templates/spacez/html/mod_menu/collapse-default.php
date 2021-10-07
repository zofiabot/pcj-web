<?php
/**
 * @package		 Joomla.Site
 * @subpackage  Templates.spacez
 *
 * @copyright		(C) 2021 Open Source Matters, Inc. <https://www.joomla.org>
 * @license		 GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

//HTMLHelper::_('bootstrap.collapse');
?>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
	 <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-<?php echo $module->id ?>"  aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon icon-dark"></span>
		</button>
	 <div class="collapse navbar-collapse" id="navbar-<?php echo $module->id; ?>">
		 <?php require __DIR__ . '/default.php'; ?>
	 </div>
	</div>
</nav>
