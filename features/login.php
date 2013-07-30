<?php
/**
* @version   $Id: login.php 8157 2013-03-09 01:15:33Z kevin $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureLogin extends GantryFeature 
{
    var $_feature_name = 'login';

	function render($position) 
	{
		global $gantry;
	    ob_start();

	    $user = JFactory::getUser();
	    
	    ?>
	    <div class="rt-block <?php global $gantry; echo 'rt-'.$gantry->get("blocks-default-overlay").'-block'; ?>">
			<div class="rt-popupmodule-button">
			<?php if ($user->guest) : ?>
				<a href="#" class="buttontext button" rel="rokbox[385 200][module=rt-popuplogin]">
					<span class="desc"><?php echo $this->get('text'); ?></span>
				</a>
			<?php else : ?>
				<a href="#" class="buttontext button" rel="rokbox[385 120][module=rt-popuplogin]">
					<span class="desc"><?php echo $this->get('logouttext'); ?> <?php echo JText::sprintf($user->get('username')); ?></span>
				</a>
			<?php endif; ?>
			</div>
		</div>
		<?php
	    return ob_get_clean();
	}
}