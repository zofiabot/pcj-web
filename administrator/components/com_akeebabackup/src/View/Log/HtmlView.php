<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\View\Log;

defined('_JEXEC') or die;

use Akeeba\Component\AkeebaBackup\Administrator\Model\LogModel;
use Akeeba\Component\AkeebaBackup\Administrator\View\Mixin\ProfileIdAndName;
use Akeeba\Engine\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Uri\Uri;

class HtmlView extends BaseHtmlView
{
	use ProfileIdAndName;

	/**
	 * Big log file threshold: 2Mb
	 */
	public const bigLogSize = 2097152;

	/**
	 * JHtml list of available log files
	 *
	 * @var  array
	 */
	public $logs = [];

	/**
	 * Currently selected log file tag
	 *
	 * @var  string
	 */
	public $tag;

	/**
	 * Is the select log too big for being
	 *
	 * @var bool
	 */
	public $logTooBig = false;

	/**
	 * Size of the log file
	 *
	 * @var int
	 */
	public $logSize = 0;

	/**
	 * The main page of the log viewer. It allows you to select a profile to display. When you do it displays the IFRAME
	 * with the actual log content and the button to download the raw log file.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// Toolbar
		ToolbarHelper::title(Text::_('COM_AKEEBABACKUP_LOG'), 'icon-akeeba');

		ToolbarHelper::back('COM_AKEEBABACKUP_CONTROLPANEL', 'index.php?option=com_akeebabackup');
		ToolbarHelper::help(null, false, 'https://www.akeeba.com/documentation/akeeba-backup-joomla/view-log.html');

		// Load the view-specific Javascript
		$this->document->getWebAssetManager()
			->useScript('com_akeebabackup.log');

		// Get a list of log names
		/** @var LogModel $model */
		$model      = $this->getModel();

		$this->logs = $model->getLogList();

		$tag = $model->getState('tag', '');

		if (empty($tag))
		{
			$tag = null;
		}

		$this->tag = $tag;

		// Let's check if the file is too big to display
		if ($this->tag)
		{
			$logFile = Factory::getLog()->getLogFilename($this->tag);

			if (@file_exists($logFile))
			{
				$this->logSize   = filesize($logFile);
				$this->logTooBig = ($this->logSize >= self::bigLogSize);
			}
		}

		if ($this->logTooBig)
		{
			$src = Uri::base() . 'index.php?option=com_akeebabackup&view=Log&task=inlineRaw&&tag=' . urlencode($this->tag) . '&tmpl=component';
			$this->document->addScriptOptions('akeeba.Log.iFrameSrc', $src);
		}

		$this->getProfileIdAndName();

		parent::display($tpl);
	}
}