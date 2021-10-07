<?php
/**
 * * @package		Templates.SpaceZ
 * @subpackage	Templates.SpaceZ
 *
 * @copyright Michał Sobkowiak & Zofia
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once "svgs.php" ;

function format_advantages( $positionName , $num = 0 ) {
	
	$html = renderModule ($positionName, $num);
	$html = $html; // 0 for first module
	
	$DOM = new DOMDocument( '1.1', 'utf-8' );
	$DOM->loadHTML( mb_convert_encoding( $html, 'HTML-ENTITIES', 'UTF-8' ) );
	
	$Headers = $DOM->getElementsByTagName('h4');
	$Details = $DOM->getElementsByTagName('p');
	$Buttons = $DOM->getElementsByTagName('a');
	
	$output = '';
	$icons = [ IconSimple, IconComfortable, IconDynamic, IconElastic, IconFunctional, IconScalable, IconEconomical, IconSafe, IconModern ];
	
	for ( $i=0; $i < $DOM->getElementsByTagName('h4')->length; $i++ ){
	
		$output .= '<div class="advantage col g-2 ' . strtolower($Headers->item($i)->textContent) . 
				'"><div>
								<h5>' . ($Headers->item($i)->textContent) . '</h5>' .
				svg( [$icons[$i], [ 128 , 128], 'size' => 64 ] ) .
								'<p>' . ($Details->item($i)->textContent) . '</p></div></div>';

	}

	$output = '<div class="d-flex row row-cols-xl-5 row-cols-md-3 row-cols-2 justify-content-center gx-4 gy-2">' . $output ;

	foreach ($Buttons as $Button){
	
		$output .= '<div class="align-self-center adv-btn"><a href="' . trim($Button->getAttribute('href')) . '" class="btn btn-primary btn-lg mx-auto my-4">' .
							 trim($Button->textContent) . '</a></div>' . '</div>';
	
	}

	return print($output);

}

function renderModule ( $positionName, $num = 0 ){
	$document = JFactory::getDocument();
	$renderer = $document->loadRenderer('module');
	$db = JFactory::getDBO();
	$db->setQuery("SELECT * FROM #__modules WHERE position='$positionName'
	AND published=1 ORDER BY ordering");


	$i=0;
	$modules = $db->loadObjectList();
	if( count( $modules ) > 0 )
	{
		foreach( $modules as $module )
		{

		//just to get rid of that stupid php warning
		$module->user = '';
		$params = array('style'=>'xhtml');
		$output[$i] = $renderer->render($module, $params);
		$i = $i + 1;
		}
	}
	
	return $output[$num];

}

