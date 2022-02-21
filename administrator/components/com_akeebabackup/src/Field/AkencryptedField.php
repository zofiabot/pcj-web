<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Field;

defined('_JEXEC') || die();

use Akeeba\Component\AkeebaBackup\Administrator\Dispatcher\Mixin\AkeebaEngineAware;
use Akeeba\Engine\Factory;
use Exception;
use Joomla\CMS\Form\Field\TextField;

class AkencryptedField extends TextField
{
	use AkeebaEngineAware;

	protected $type = "Akencrypted";

	protected function getInput()
	{
		$this->value = $this->conditionalDecrypt($this->value);

		return parent::getInput();
	}

	private function conditionalDecrypt($value)
	{
		// If the Factory is not already loaded we have to load the
		if (!class_exists('Akeeba\Engine\Factory'))
		{

			try
			{
				$this->loadAkeebaEngine();
				$this->loadAkeebaEngineConfiguration();
			}
			catch (Exception $e)
			{
				return $value;
			}
		}

		$secureSettings = Factory::getSecureSettings();

		return $secureSettings->decryptSettings($this->value);
	}
}
