<?php
/**
 * @package		 Joomla.Site
 * @subpackage  Templates.spacez
 *
 * @copyright	(C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @copyright	for the changes (C) 2021 Michał Sobkowiak & Zofia
 * @license		Single use licence for Polskie Centrum Joomla
 */

defined('_JEXEC') or die;

?>
<?php if ($this->error) : ?>
	<div class="error">
		<?php echo $this->escape($this->error); ?>
	</div>
<?php endif; ?>
