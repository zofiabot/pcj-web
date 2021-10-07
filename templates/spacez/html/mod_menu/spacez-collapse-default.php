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

<nav class="navbar navbar-expand-lg fs-5">
	 <button class="navbar-toggler text-primary align-self-start p-0 mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#nav-<?php echo $module->id ?>"  aria-expanded="false" aria-label="Toggle navigation">
		  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
</svg>
		</button>
	 <div class="collapse navbar-collapse" id="nav-<?php echo $module->id; ?>">
		 <?php require __DIR__ . '/spacez-default.php'; ?>
	 </div>
</nav>
