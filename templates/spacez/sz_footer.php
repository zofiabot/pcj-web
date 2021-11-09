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
?>
<footer class="container-footer footer p-0 dark">
	
	<section class="py-2 dark">
		<div class="container row align-items-start mx-auto">
			<jdoc:include type="modules" name="footer" style="3col" />
		</div>
	</section>
	<section class="py-4 darker">
		<div class="container row align-items-center mx-auto">
			<jdoc:include type="modules" name="footer-after" style="2col" />
			<div class="p-2 col-12 col-md-6 align-self-center align-items-center align-middle d-flex text-end">
				<jdoc:include type="modules" name="translation-team" style="none" />
				<?php echo svg( [ Logo_TranslationTeam, 'title' => 'Joomla Translation Team', 'desc' => 'PCJ! jest akredytowanym uczestnikiem Joomla! Translation Team.', 'id' => 'tt', 'class' => 'flex-shrink-0 align-middle' ] ) ?>
			</div>
		</div>
	</section>
	<section class="py-2 darkest">
		<div class="container row mx-auto">
			<div class="p-2 col-12 align-self-center"><jdoc:include type="modules" name="footer2" style="module" /><jdoc:include type="modules" name="copyright" style="none" /></div>
		</div>
	</section>
</footer>

