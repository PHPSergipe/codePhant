<?php
/**
* @version   $Id: floatingmodule.php 8285 2013-03-14 00:12:52Z djamil $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureFloatingmodule extends GantryFeature
{
	var $_feature_name = 'floatingmodule';

	function render($position)
	{
		global $gantry;
		$gantry->addScript('rt-floatingmodule.js');
		ob_start();

		$user = JFactory::getUser();

		?>
		<div class="rt-floatingmodule" data-floating="<?php echo $gantry->get('floatingmodule-offset'); ?>">
			<div class="rt-floating-top" data-floating-start>
				<?php echo $gantry->displayModules('floatingmodule-top','basic','standard'); ?>
			</div>
			<div class="rt-floating-bottom" data-floating-end="rt-<?php echo $gantry->get('floatingmodule-position_end'); ?>">
				<?php echo $gantry->displayModules('floatingmodule-bottom','basic','standard'); ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}

