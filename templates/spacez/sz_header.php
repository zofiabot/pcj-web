<?php
/**
 * * @package		Templates.SpaceZ
 *
 * @copyright	(C) 2020 Michał Sobkowiak & Zofia
 * @license		Single use licence for Polskie Centrum Joomla
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Document;


// Logo file or site title param
//require('functions.php');

?>

<header class="pt-3 dark<?php echo $stickyHeader ? ' ' . $stickyHeader : ''; ?>" id="top">

	
	<div id="main-nav">

		<div class="container d-flex">

			<?php if ($this->countModules('topbar')) : ?>
			<div class="topbar">
				<jdoc:include type="modules" name="topbar" style="none" />
			</div>
			<?php endif; ?>
			
			<?php if ($this->params->get( 'brand', 1 )) : ?>
				<a class="navbar-brand justify-self-start me-0" href="<?php echo $this->baseurl; ?>/">
				<?php echo joomlalogo( $sitename, 64 ); ?>
			</a>
			<a class="navbar-brand justify-self-start ms-0" href="<?php echo $this->baseurl; ?>/">
				<?php echo pcjlogo( $sitename, 64 ); ?>
			</a>
			<?php endif; ?>
			<nav class="navbar navbar-expand-lg mx-2 me-auto ms-auto ms-lg-0">
				<jdoc:include type="modules" name="menu" style="none" />
			</nav>
			<jdoc:include type="modules" name="search" style="none" />
			<button class="navbar-toggler d-lg-none pt-3" type="button" data-bs-toggle="collapse" data-bs-target="#nav-1"  aria-expanded="false" aria-label="Toggle navigation">
				<?php echo smico('menu', 28) ?>
			</button>
		</div>

	</div>

	<?php if ($this->countModules('below-top')) : ?>
	<div class="container-fluid container-below-top">
		<jdoc:include type="modules" name="below-top" style="none" />
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('social')) : ?>
	<div class="container-fluid social pb-1 pb-xl-2">
		<div class="container text-end pe-2">
		<jdoc:include type="modules" name="social" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('action', true)) : ?>
	<section class="section-slider action pt-0 pb-5">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<jdoc:include type="modules" name="action" style="3col" />
			</div>
		</div>
	</section>
	<?php endif; ?>
</header>
