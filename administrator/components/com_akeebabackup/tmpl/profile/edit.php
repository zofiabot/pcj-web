<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

defined('_JEXEC') || die;

/** @var \Akeeba\Component\AkeebaBackup\Administrator\View\Profile\HtmlView $this */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');

?>
<form action="<?php echo Route::_('index.php?option=com_akeebabackup&view=Profile&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="profile-form"
      aria-label="<?php echo Text::_('COM_AKEEBABACKUP_PROFILES_PAGETITLE_' . ( (int) $this->item->id === 0 ? 'NEW' : 'EDIT'), true); ?>"
      class="form-validate">

	<div>
		<div class="card">
			<div class="card-body">
				<?php echo $this->form->renderField('description'); ?>
				<?php echo $this->form->renderField('quickicon'); ?>
			</div>
		</div>
	</div>

	<input type="hidden" name="task" value="">
	<?php echo HTMLHelper::_('form.token'); ?>
</form>