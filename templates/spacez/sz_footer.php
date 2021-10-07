<?php
/**
 * * @package		Templates.SpaceZ
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
<footer class="container-fluid container-footer footer">
	<div class="container py-4">
		<div class="row align-items-start">
			<jdoc:include type="modules" name="footer" style="3col" />
		</div>
		<div class="row align-items-center">
			<jdoc:include type="modules" name="footer-after" style="2col" />
			<div class="p-2 col-12 col-md-6 align-self-center align-items-center align-middle d-flex text-end">
				<jdoc:include type="modules" name="translation-team" style="none" />
				<?php echo svg( [ Logo_TranslationTeam, 'title' => 'Joomla Translation Team', 'desc' => 'PCJ! jest akredytowanym uczestnikiem Joomla! Translation Team.', 'id' => 'tt', 'class' => 'flex-shrink-0 align-middle' ] ) ?>
			</div>
		</div>
		<div class="row">
				<div class="p-2 col-12 align-self-center"><jdoc:include type="modules" name="copyright" style="none" /></div>
		</div>
	</div>
</footer>

