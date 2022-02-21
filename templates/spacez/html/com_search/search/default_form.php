<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*
* @copyright	for the changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
*/

defined('_JEXEC') or die;

// JHtml::_('bootstrap.tooltip');
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Pagination;


$limit = $this->pagination->limit;
$serchword_em = (strlen($this->searchword) > 25) ? (substr($this->searchword, 0, 20) . '[...]' ) : ($this->searchword);
$serchword_em = '<em><strong>' . $serchword_em . '</strong></em>';
$searchbuttonlabel = JText::_('COM_SEARCH_SEARCH');
$searchbuttonkeyword = JText::_('COM_SEARCH_SEARCH_KEYWORD');
$svgicon = ' <svg class="search-icon inline-icon" viewBox="0 0 30 30" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><title>' . $searchbuttonlabel . '</title><path d="M11.635 2.984c-2.12.054-4.266.873-6.022 2.63-5.618 5.618-1.64 15.224 6.307 15.224a8.865 8.865 0 0 0 5.184-1.668l7.697 7.676a1.456 1.456 0 0 0 1.15.568 1.456 1.456 0 0 0 1.455-1.455 1.456 1.456 0 0 0-.478-1.078 1.456 1.456 0 0 0-.014-.012l-7.752-7.754a8.875 8.875 0 0 0 1.676-5.195c0-5.464-4.54-9.053-9.203-8.936zm.285 2.76a6.166 6.166 0 0 1 6.174 6.176 6.165 6.165 0 0 1-6.174 6.174 6.166 6.166 0 0 1-6.176-6.174 6.168 6.168 0 0 1 6.176-6.176z"/></svg>';


?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post">
  <div class="row">
	<div class="col-12 col-lg-6 g-3">
		<?php 
		if (!empty($this->searchword)) {
			echo '<div class="alert '; echo ($this->total > 0) ? 'alert-secondary' : 'alert-warning'; echo ' fade show w-auto mb-0 py-2">';
					if ($this->total == 0) { echo clean( Text::printf('COM_SEARCH_QUERY_RESULTS_NONE', '', $serchword_em )); }
					elseif ($this->total == 1) { echo clean( JText::printf('COM_SEARCH_QUERY_RESULTS_ONE', '' , $serchword_em)); }
					elseif ($this->total < 5) { echo clean( Text::printf('COM_SEARCH_QUERY_RESULTS_FEW', $this->total, $serchword_em )); }
					else { echo clean( Text::printf('COM_SEARCH_QUERY_RESULTS_MANY', $this->total, $serchword_em ));}
				echo '</div>';
				} ?>
				 
				 <p class="counter ps-3 mb-2 pt-1">
					 <?php echo $this->pagination->getPagesCounter(); ?> &nbsp;
				 </p>

		<div class="input-group py-2">
			<input type="text" name="searchword" minlength="3" class="form-control form-control-lg border-primary border-end-0" aria-label="<?php echo $searchbuttonkeyword; ?>" title="<?php echo $searchbuttonkeyword; ?>" placeholder="<?php echo $searchbuttonkeyword; ?>" id="search-searchword" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox" />
		<input type="hidden" name="task" value="search" />
			<button name="Search" onclick="this.form.submit()" class="input-group-text button btn btn-primary color-white" aria-label="<?php echo $searchbuttonlabel; ?>" title="<?php echo $searchbuttonlabel; ?>">
				<?php echo $svgicon; ?>
			</button>
		</div>
			<div class="input-group pt-2 my-3">
				<label class="input-group-text" for="ordering" class="ordering">
					<?php echo JText::_('JFIELD_ORDERING_LABEL'); ?>
				</label>
				<?php echo inject('form-select w-auto' , $this->lists['ordering']); ?>
		<?php if ($this->total > 0) : ?>
				<?php echo getLimitBox($limit, $this->total, 'form-select'); ?>
				<label class="input-group-text border-start-0" for="limit">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
		<?php endif; ?>	
			</div>
		</div>

	<div class="col-12 col-lg-6 col-md-12 g-3">		

		<ul class="list-group list-group-horizontal">

			<?php if ($this->params->get('search_areas', 1)) : ?>
			<li class="list-group-item w-50">
			<fieldset class="only">
				<legend class="">	<?php echo JText::_('COM_SEARCH_SEARCH_ONLY'); ?></legend>
				<ul class="list-unstyled">
					<?php foreach ($this->searchareas['search'] as $val => $txt) : ?>
					<?php $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : ''; ?>
				 <li class="mb-1"><label class="fs-6 m-0 py-0 px-1" for="area-<?php echo $val; ?>">
						 <input class="form-check-input" type="checkbox" name="areas[]" value="<?php echo $val; ?>" id="area-<?php echo $val; ?>" <?php echo $checked; ?> />
						 <?php echo Text::_($txt); ?>
						 </label>
						</li>
				<?php endforeach; ?>
				</ul>
			</fieldset>
			</li>
			<?php endif; ?>
			
			<?php if ($this->params->get('search_phrases', 1)) : ?>
			<li class="list-group-item w-50">
				 <legend><?php echo JText::_('COM_SEARCH_FOR'); ?></legend>
				 <?php echo $this->lists['searchphrase']; ?>
			</li>
			<?php endif; ?>
		 </ul>
	</div>

  </div>
</form>

<?php 

function getLimitBox ( $limit , $total , $class) 
// Builds option list for select: number of search results
// and returns the select
	{
		$limits = array();


		// Make the option list.
		$options = [ 10, 25, 50, 100 ]; //array of options to choose
		
		foreach ( $options as $option )
		{
			if( $option <= $total || $option == 10) // if option lower than number of results (skip the lowest option though)
			{
			$limits[] = HTMLHelper::_('select.option', "$option"); // add option
			}
		}
		
		$limits[] = HTMLHelper::_('select.option', '0', JText::_('JALL')); // add option for all

		$selected = $limit == 10 ? 10 : ($limit > $total ? 0 : $limit );

		// Build the select.
			$html = HTMLHelper::_(
				'select.genericlist',
				$limits,
				'limit',
				'class="' . $class . '" onchange="this.form.submit()"',
				'value',
				'text',
				$selected
			);

		return $html;
	}
function inject( $class , $subject ) // an ugly hack not to rewrite entire CMS ;)
  {
		$replace = 'onchange="this.form.submit()" class="' . $class . ' ';
		return str_replace('class="', $replace , $subject);
  }
function clean( $subject ) // Utility to clean those misterious numbers Joomla injects.. I have no patience to search for root cause
  {
		$pattern = '/\d+/';
		return preg_replace($pattern , '', $subject);
  }
?>
