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
	 <?php if ($this->params->get('show_page_heading')) : ?>
		 <h1 class="card-title text-center col-6 col-lg-6 col-md-12 search<?php echo $this->pageclass_sfx; ?>">
			 <?php if ($this->escape($this->params->get('page_heading'))) : ?>
				 <?php echo $this->escape($this->params->get('page_heading')); ?>
			 <?php else : ?>
				 <?php echo $this->escape($this->params->get('page_title')); ?>
			 <?php endif; ?>
		 </h1>
	 <?php endif; ?>

	 <?php echo $this->loadTemplate('form'); ?>

<div class="row mx-3" id="search-result-list">
	<?php if ($this->error == null && count($this->results) > 0) : ?>
		<?php echo $this->loadTemplate('results'); ?>
	<?php else : ?>
		<?php echo $this->loadTemplate('error'); ?>
	<?php endif; ?>
</div>
