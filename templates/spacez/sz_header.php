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

<header class="dark py-2 py-lg-3 <?php echo $stickyHeader ? ' ' . $stickyHeader : ''; ?>" id="top">

	<?php if ($this->countModules('topbar')) : ?>
		<div class="container-fluid container-topbar">
		<jdoc:include type="modules" name="topbar" style="none" />
		</div>
	<?php endif; ?>

	<div class="container d-flex">
		
		<?php if ($this->params->get( 'brand', 1 )) : ?>
		<a class="navbar-brand justify-self-start" href="<?php echo $this->baseurl; ?>/">
			<?php echo joomlalogo( $sitename, 64 ) . pcjlogo( $sitename, 64 ); ?>
		</a>
		<?php endif; ?>
		<!-- <nav class="navbar navbar-expand-lg"> -->

			<jdoc:include type="modules" name="menu" style="none" />
			<!-- <div id="navsearch" class="container-search ms-xl-2 justify-self-end"> -->
		<!-- </nav> -->
				<jdoc:include type="modules" name="search" style="none" />
			<!-- </div> -->

		</div>
			<?php if ($this->countModules('below-top')) : ?>
				<div class="container-fluid container-below-top">
					<jdoc:include type="modules" name="below-top" style="none" />
				</div>
			<?php endif; ?>
	</div>
</header>
