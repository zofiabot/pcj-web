<?php
/**
* @package		Templates.spacez
*
* @copyright	Michał Sobkowiak & Zofia
* @license		propriatery, see LICENSE.txt
*
* @copyright	for changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
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

$collapseicon = smico('search', 28, $text, 'collapsed') .  smico('x', 28, $text, 'expanded') ;
$formicon = smico('search', 28, $text) ;

$inputfield = '<input type="text" name="searchword" id="searchword" class="searchword form-control dark" type="search" placeholder="' . $text . '" aria-label="' . $text . '" >';
$btn_search = '<button class="btn input-group-text">' . $formicon . '</button>';

?>

<nav class="navbar navbar-search navbar-expand-xl ms-lg-auto align-self-start justify-self-end pt-2">
	
	
	<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="d-flex" role="search">
		
		<div id="search-nav" name="search-nav" class="collapse navbar-collapse input-group search<?php echo $moduleclass_sfx; ?>">
			
			<?php echo $inputfield . $btn_search; ?>
			
		</div>
		
		<button class="navbar-toggler collapsed pt-2" type="button" data-bs-toggle="collapse" data-bs-target="#search-nav" aria-controls="search-nav" aria-expanded="false" aria-label="Toggle navigation">
			<?php echo $collapseicon ?>
		</button>

		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
	
</nav>
