<?php
/**
 * @package		 Joomla.Site
 * @subpackage  Templates.spacez
 *
 * @copyright	Michał Sobkowiak & Zofia
 * @license		 propriatery, see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));
$text = JTEXT::_('MOD_FINDER_SEARCH_VALUE');

$buttontext = JTEXT::_('JSEARCH_FILTER_SUBMIT');

if ($width)
{
	$moduleclass_sfx .= ' ' . 'mod_search' . $module->id;
	$css = 'div.mod_search' . $module->id . ' input[type="search"]{ width:auto; }';
	JFactory::getDocument()->addStyleDeclaration($css);
	$width = ' size="' . $width . '"';
}
else
{
	$width = '';
}


$label= '';

$inputfield = '<input name="searchword" id="searchword" class="searchword form-control border-primary" type="search" placeholder="' . $text . '" aria-label="' . $text . '" >';

$svgicon = ' <svg class="bi" viewBox="0 0 30 30" width="25" height="25" xmlns="http://www.w3.org/2000/svg"><title>' . $button_text . '</title><path d="M11.635 2.984c-2.12.054-4.266.873-6.022 2.63-5.618 5.618-1.64 15.224 6.307 15.224a8.865 8.865 0 0 0 5.184-1.668l7.697 7.676a1.456 1.456 0 0 0 1.15.568 1.456 1.456 0 0 0 1.455-1.455 1.456 1.456 0 0 0-.478-1.078 1.456 1.456 0 0 0-.014-.012l-7.752-7.754a8.875 8.875 0 0 0 1.676-5.195c0-5.464-4.54-9.053-9.203-8.936zm.285 2.76a6.166 6.166 0 0 1 6.174 6.176 6.165 6.165 0 0 1-6.174 6.174 6.166 6.166 0 0 1-6.176-6.174 6.168 6.168 0 0 1 6.176-6.176z"/></svg>';


$btn_search = ' <button class="input-group-text button btn btn-sm bi btn-primary">' . $svgicon . '</button>';

$output = $inputfield . $btn_search;
		
$btn_collapse = ' <button class="btn navbar-toggler text-primary p-0" type="button" data-bs-toggle="collapse" data-bs-target="#search-nav" aria-controls="search-nav" aria-expanded="false" aria-label="Toggle navigation" onclick="this.form.searchword.focus();">' . $svgicon . '</button>';

?>

<nav class="navbar navbar-expand-xl mt-2">
	
	
	<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-inline d-flex" role="search">
		
		<div id="search-nav" name="search-nav" class="collapse navbar-collapse input-group search<?php echo $moduleclass_sfx; ?>">
			
			 <?php echo $output; ?>
			
		</div>
		
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
		
		<?php echo $btn_collapse; ?>
	</form>
	
</nav>
