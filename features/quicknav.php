<?php
/**
* @version   $Id: quicknav.php 8859 2013-03-27 19:22:53Z kevin $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureQuicknav extends GantryFeature {
	var $_feature_name = 'quicknav';

	function init(){
		global $gantry;
	}

	function render($position="") {
		global $gantry;

		$gantry->addScript('scrollspy-nav.js');
		$gantry->addScript('visibility-watcher.js');
		$gantry->addScript('rt-quicknav.js');

		ob_start();
		global $gantry;
		?>
		<div class="rt-quicknav">
			<a href="#back-to-top" class="quicknav-item home">
				<span class="icon-home" title="Home"></span>
			</a>
			<?php if ($gantry->countModules('feature')) : ?>
				<a href="#rt-feature" class="quicknav-item feature">
					<span class="<?php echo ($gantry->get('feature-icon') == '' ? 'icon-star' : $gantry->get('feature-icon')); ?>" title="<?php echo $gantry->get('feature-headline'); ?>"></span>
				</a>
			<?php endif; ?>
			<?php if ($gantry->countModules('utility')) : ?>
				<a href="#rt-utility" class="quicknav-item utility">
					<span class="<?php echo ($gantry->get('utility-icon') == '' ? 'icon-star' : $gantry->get('utility-icon')); ?>" title="<?php echo $gantry->get('utility-headline'); ?>"></span>
				</a>
			<?php endif; ?>
			<a href="#rt-main-container" class="quicknav-item main">
				<span class="<?php echo ($gantry->get('main-icon') == '' ? 'icon-star' : $gantry->get('main-icon')); ?>" title="<?php echo $gantry->get('main-headline'); ?>"></span>
			</a>
			<?php if ($gantry->countModules('extension')) : ?>
				<a href="#rt-extension" class="quicknav-item extension">
					<span class="<?php echo ($gantry->get('extension-icon') == '' ? 'icon-star' : $gantry->get('extension-icon')); ?>" title="<?php echo $gantry->get('extension-headline'); ?>"></span>
				</a>
			<?php endif; ?>
			<?php if ($gantry->countModules('bottom')) : ?>
				<a href="#rt-bottom" class="quicknav-item bottom">
					<span class="<?php echo ($gantry->get('bottom-icon') == '' ? 'icon-star' : $gantry->get('bottom-icon')); ?>" title="<?php echo $gantry->get('bottom-headline'); ?>"></span>
				</a>
			<?php endif; ?>
			<?php if ($gantry->countModules('footer')) : ?>
				<a href="#rt-footer" class="quicknav-item footer">
					<span class="<?php echo ($gantry->get('footer-icon') == '' ? 'icon-star' : $gantry->get('footer-icon')); ?>" title="<?php echo $gantry->get('footer-headline'); ?>"></span>
				</a>
			<?php endif; ?>
			<?php if ($gantry->get('social-enabled')) : ?>
				<?php echo $gantry->displayModules('social','basic','basic'); ?>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}
}
