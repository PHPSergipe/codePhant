<?php
/**
* @version   $Id: branding.php 8151 2013-03-08 22:41:17Z josh $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureBranding extends GantryFeature {
    var $_feature_name = 'branding';

	function render($position) {
	    ob_start();
	    ?>
	    <div class="rt-block">
			<a href="http://www.gantry-framework.org/" title="Gantry Framework" class="powered-by"></a>
		</div>
		<?php
	    return ob_get_clean();
	}
}