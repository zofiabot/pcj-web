<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.spacez
 *
 * @copyright	(C) 2021 Open Source Matters, Inc. <https://www.joomla.org>
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

?>

<nav class="navbar navbar-expand-lg mx-auto mx-lg-2">

	<div class="collapse navbar-collapse" id="nav-<?php echo $module->id; ?>">
		<?php require __DIR__ . '/spacez-default.php'; ?>
	</div>

</nav>

	<button class="navbar-toggler ms-auto d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#nav-<?php echo $module->id ?>"  aria-expanded="false" aria-label="Toggle navigation">
		<?php echo smico('menu', 32) ?>
	</button>

	