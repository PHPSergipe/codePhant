<?php
/**
 * @version   $Id: copyright.php 8659 2013-03-21 03:18:50Z kevin $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');
/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureCopyright extends GantryFeature
{
	var $_feature_name = 'copyright';

	function render($position)
	{
		ob_start();
		?>
	<div class="clear"></div>
	<div class="rt-block">
		<span class="copyright-text"><?php echo $this->get('text'); ?></span>
	</div>
	<?php
		return ob_get_clean();
	}
}
