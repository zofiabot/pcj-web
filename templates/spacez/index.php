<?php
/**
 * @package		Templates.SpaceZ
 *
 * @copyright	(C) 2021 Michał Sobkowiak & Zofia
 * @license		Single use licence for Polskie Centrum Joomla
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Document;

require_once('functions.php');


/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa	= $this->getWebAssetManager();

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Detecting Active Variables
$option	= $app->input->getCmd('option', '');
$view		= $app->input->getCmd('view', '');
$layout	= $app->input->getCmd('layout', '');
$task		= $app->input->getCmd('task', '');
$itemid	= $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu		= $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Template path
$templatePath = 'templates/' . $this->template;

// Enable assets
$wa->usePreset('template.spacez.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'))
	->useStyle('template.active.language')
	->useStyle('template.user')
	->useScript('template.user')
;

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.spacez.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);


$hasClass = '';

if ($this->countModules('sidebar-left', true))
{
	$hasClass .= ' has-sidebar-left';
}

if ($this->countModules('sidebar-right', true))
{
	$hasClass .= ' has-sidebar-right';
}

// Container
$wrapper = $this->params->get('fluidContainer') ? 'wrapper-fluid' : 'wrapper-static';

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

$stickyHeader = $this->params->get('stickyHeader') ? 'position-sticky sticky-top' : '';

?><!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>

<body class="site <?php echo $option
	. ' ' . $wrapper
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($pageclass ? ' ' . $pageclass : '')
	. $hasClass
	. ($this->direction == 'rtl' ? ' rtl' : '');
?>">


<?php require_once('sz_header.php');?>

	<?php if ($this->countModules('breadcrumbs', true)) : ?>
		<section class="section-slider action bg-indigo pt-5">
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<jdoc:include type="modules" name="breadcrumbs" style="none" />
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ($this->countModules('action', true)) : ?>
		<section class="section-slider action bg-indigo pt-5">
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<jdoc:include type="modules" name="action" style="3col" />
				</div>
			</div>
		</section>
	<?php endif; ?>
	
	<?php if ($this->countModules('top1', true)) : ?>
		<section class="section-top	py-4 top1">
			<div class="container text-center">
				<?php format_advantages('top1'); ?>
			</div>
		</section>
	<?php endif; ?>
	
	<?php if ($this->countModules('top2', true)) : ?>
		<section class="section-top py-4 top2">
			<div class="container">
				<div class="row align-items-center justify-content-center g-4">
				<div class="col col-12 col-md-8 fs-5 pe-md-3 ps-md-5"> <?php echo renderModule( 'top2',0 ) ?></div>
				<div class="col col-12 col-md-4 mt-0 fancy-list"> <?php echo renderModule( 'top2',1 ) ?></div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	
	<?php if ($this->countModules('top3', true)) : ?>
		<section class="section-top top3">
			<div class="container">
				<jdoc:include type="modules" name="top3" style="none" />
			</div>
		</section>
	<?php endif; ?>
	
	<?php if ($this->countModules('top4', true)) : ?>
		<section class="section-top py-4 top4">
			<div class="container container-top4">
				<jdoc:include type="modules" name="top4" style="none" />
			</div>
		</section>
	<?php endif; ?>
	
	<?php if ($this->countModules('top5', true)) : ?>
		<section class="section-top py-4 top5">
			<div class="container">
				<jdoc:include type="modules" name="top5" style="module" />
			</div>
		</section>
	<?php endif; ?>
	
	<?php if ($this->countModules('top6', true)) : ?>
		<section class="section-top py-4 top6">
			<div class="container">
				<jdoc:include type="modules" name="top6" style="module" />
			</div>
		</section>
	<?php endif; ?>


	<?php if ($this->countModules('banner', true)) : ?>
		<section class="section-banner py-4">
			<jdoc:include type="modules" name="banner" style="none" />
		</section>
	<?php endif; ?>

	<?php // TODO
	
	if ($this->countModules('sidebar-left', true)) : ?>
	<div class="container container-sidebar-left">
		<jdoc:include type="modules" name="sidebar-left" style="none" />
	</div>
	<?php endif; ?>

	<div class="container-fluid pb-4">
		<div class="container container-component ">
			<jdoc:include type="modules" name="main-top" style="none" />
			<jdoc:include type="message" />
			<main>
			<jdoc:include type="component" />
			</main>
			<jdoc:include type="modules" name="main-bottom" style="none" />
		</div>
	</div>

	<?php // TODO
	
	if ($this->countModules('sidebar-right', true)) : ?>
	<?php endif; ?>

	<?php require_once ( 'sz_footer.php' ); ?>

	<?php if ($this->params->get('backTop') == 1) : ?>
		<a href="#top" id="back-top" class="back-to-top-link" aria-label="<?php echo Text::_('TPL_SPACEZ_BACKTOTOP'); ?>">
			<span class="icon-arrow-up icon-fw" aria-hidden="true"></span>
		</a>
	<?php endif; ?>

	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
