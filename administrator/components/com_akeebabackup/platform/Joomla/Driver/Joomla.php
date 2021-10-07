<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2021 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Engine\Driver;

// Protection against direct access
defined('_JEXEC') || die();

use Exception;
use Joomla\CMS\Factory;
use RuntimeException;

class Joomla
{
	/** @var Base The real database connection object */
	private $dbo;

	/**
	 * Database object constructor
	 *
	 * @param   array  $options  List of options used to configure the connection
	 */
	public function __construct($options = [])
	{
		// Get the database driver *AND* make sure it's connected.
		$db = Factory::getContainer()->get('DatabaseDriver');
		$db->connect();

		$options['connection'] = $db->getConnection();

		switch ($db->name)
		{
			case 'mysql':
			case 'pdomysql':
				// Note that Joomla! 4's "mysql" is, actually, "pdomysql".
				$driver = 'pdomysql';
				break;

			case 'mysqli':
				$driver = 'mysqli';
				break;

			default:
				throw new RuntimeException("Unsupported database driver {$db->name}");
		}

		$driver    = '\\Akeeba\\Engine\\Driver\\' . ucfirst($driver);
		$this->dbo = new $driver($options);
	}

	public function close()
	{
		/**
		 * We should not, in fact, try to close the connection by calling the parent method.
		 *
		 * If you close the connection we ask PHP's mysql / mysqli / pdomysql driver to disconnect the MySQL connection
		 * resource from the database server inside our instance of Akeeba Engine's database driver. However, this
		 * identical resource is also present in Joomla's database driver. Joomla will also try to close the connection
		 * to a now invalid resource, causing a PHP notice to be recorded.
		 *
		 * By setting the connection resource to null in our own driver object we prevent closing the resource,
		 * delegating that responsibility to Joomla. It will gladly do so at the very least automatically, through its
		 * db driver's __destruct.
		 */
		$this->dbo->setConnection(null);
	}

	public function open()
	{
		if (method_exists($this->dbo, 'open'))
		{
			$this->dbo->open();

			return;
		}

		if (method_exists($this->dbo, 'connect'))
		{
			$this->dbo->connect();
		}
	}

	/**
	 * Magic method to proxy all calls to the loaded database driver object
	 *
	 * @throws  Exception
	 */
	public function __call($name, array $arguments)
	{
		if (is_null($this->dbo))
		{
			throw new Exception('Akeeba Engine database driver is not loaded');
		}

		if (method_exists($this->dbo, $name) || in_array($name, ['q', 'nq', 'qn']))
		{
			return $this->dbo->{$name}(...$arguments);
		}

		throw new Exception('Method ' . $name . ' not found in Akeeba Platform');
	}

	public function __get($name)
	{
		if (isset($this->dbo->$name) || property_exists($this->dbo, $name))
		{
			return $this->dbo->$name;
		}

		$this->dbo->$name = null;

		user_error('Database driver does not support property ' . $name);

		return null;
	}

	public function __set($name, $value)
	{
		if (isset($this->dbo->name) || property_exists($this->dbo, $name))
		{
			$this->dbo->$name = $value;

			return;
		}

		$this->dbo->$name = null;
		user_error('Database driver not support property ' . $name);
	}
}
