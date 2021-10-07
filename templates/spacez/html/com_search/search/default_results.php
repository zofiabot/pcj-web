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
<div class="search-results search-results<?php echo $this->pageclass_sfx; ?> pt-4">
<?php foreach ($this->results as $result) : ?>
	<h4 class="result-title d-inline mb-4">
		<?php if ($result->href) : ?>
			<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) : ?> target="_blank"<?php endif; ?>>
				<?php // $result->title should not be escaped in this case, as it may ?>
				<?php // contain span HTML tags wrapping the searched terms, if present ?>
				<?php // in the title. ?>
				<?php echo $result->title; ?>
			</a>
		<?php else : ?>
			<?php // see above comment: do not escape $result->title ?>
			<?php echo $result->title; ?>
		<?php endif; ?>
	</h4>
	<?php if ($result->section) : ?>
			<small class="badge bg-primary">
				<?php echo $this->escape($result->section); ?>
			</small>
	<?php endif; ?>
	<?php if ($this->params->get('show_date')) : ?>
		<small class="date">
			<?php 
			 $date = (substr($result->created,-4,4) < 2010) ? '' :  $result->created;
			 echo $date ?>
		</small>	
	<div class="clearfix"></div>
	<div class="result-text mb-4">
		<?php echo$result->text; ?>
	</div>
	<?php endif; ?>
<?php endforeach; ?>
</div>
<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
