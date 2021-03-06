<?php
/**
* @package		Templates.spacez
*
* @copyright	(C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*
* @copyright	for changes (C) 2021 Michał Sobkowiak & Zofia
* @license		Single use licence for Polskie Centrum Joomla
*/

defined('_JEXEC') or die;
?>


<div class="mod-custom custom banner-overlay" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?> >
	<div class="overlay">
		<?php echo $module->content; ?>
	</div>
</div>
