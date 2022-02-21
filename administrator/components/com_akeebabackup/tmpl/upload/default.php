<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

// Protect from unauthorized access
defined('_JEXEC') || die();

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

?>
<form action="<?= Route::_('index.php?option=com_akeebabackup&view=Upload&task=upload&tmpl=component') ?>"
	  id="akeebaform" method="post" name="akeebaform">
	<input type="hidden" name="id" value="<?= (int) $this->id ?>" />
	<input type="hidden" name="part" value="0" />
	<input type="hidden" name="frag" value="0" />
</form>

<div class="alert alert-info">
	<p>
		<?= Text::_('COM_AKEEBABACKUP_TRANSFER_MSG_START') ?>
	</p>
</div>
