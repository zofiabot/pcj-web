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

<header class="pt-3 <?php echo $stickyHeader ? ' ' . $stickyHeader : ''; ?>">

	<?php if ($this->countModules('topbar')) : ?>
		<div class="container-fluid container-topbar">
		<jdoc:include type="modules" name="topbar" style="none" />
		</div>
	<?php endif; ?>

	<div class="container">
			<div class="d-flex flex-wrap align-items-evenly">

			<?php if ($this->params->get( 'brand', 1 )) : ?>
					<a class="d-flex text-decoration-none navbar-brand" href="<?php echo $this->baseurl; ?>/">
						<?php echo joomlalogo( $sitename, 64 ) . pcjlogo( $sitename, 64 ); ?>
					</a>
					<?php if ($this->params->get('siteDescription')) : ?>
						<div class="site-description"><?php echo htmlspecialchars($this->params->get('siteDescription')); ?></div>
					<?php endif; ?>
			<?php endif; ?>

				<div id="mainmenu" class="nav me-auto justify-self-start">
					<jdoc:include type="modules" name="menu" style="none" />
				</div>
				<div id="navsearch" class="container-search ms-xl-2 justify-self-end">
					<jdoc:include type="modules" name="search" style="none" />
				</div>

			</div>
			<?php if ($this->countModules('below-top')) : ?>
				<div class="container-fluid container-below-top">
					<jdoc:include type="modules" name="below-top" style="none" />
				</div>
			<?php endif; ?>
		</div>
	</div>
</header>
