<?php
/**
* @version   $Id: styledeclaration.php 9047 2013-04-02 15:18:14Z djamil $
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright 	Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');
gantry_import('core.utilities.gantrymobiledetect');

class GantryFeatureStyleDeclaration extends GantryFeature {
	var $_feature_name = 'styledeclaration';

	function isEnabled() {
		global $gantry;
		$menu_enabled = $this->get('enabled');

		if (1 == (int)$menu_enabled) return true;
		return false;
	}

	function init() {
	global $gantry;
	$browser = $gantry->browser;

        // Logo
	$css = $this->buildLogo();

        // Section Background Images
	$lessVariables = array(
		'header-background'=>$gantry->get('header-background', '#e5eaed'),
		'header-accent'=>$gantry->get('header-accent', '#3cb2ce'),
		'header-accent2'=>$gantry->get('header-accent2', '#fbf994'),
		'header-pattern'=>$gantry->get('header-pattern', 'noise'),
		'header-contrast'=>$gantry->get('header-contrast', 'light'),

		'showcase-background'=>$gantry->get('showcase-background', '#e5eaed'),
		'showcase-accent'=>$gantry->get('showcase-accent', '#3cb2ce'),
		'showcase-accent2'=>$gantry->get('showcase-accent2', '#fbf994'),
		'showcase-pattern'=>$gantry->get('showcase-pattern', 'noise'),
		'showcase-contrast'=>$gantry->get('showcase-contrast', 'light'),

		'feature-background'=>$gantry->get('feature-background', '#e0e6e6'),
		'feature-accent'=>$gantry->get('feature-accent', '#3cb2ce'),
		'feature-accent2'=>$gantry->get('feature-accent2', '#fbf994'),
		'feature-pattern'=>$gantry->get('feature-pattern', 'noise'),
		'feature-contrast'=>$gantry->get('feature-contrast', 'light'),

		'utility-background'=>$gantry->get('utility-background', '#458493'),
		'utility-accent'=>$gantry->get('utility-accent', '#3cb2ce'),
		'utility-accent2'=>$gantry->get('utility-accent2', '#fbf994'),
		'utility-pattern'=>$gantry->get('utility-pattern', 'noise'),
		'utility-contrast'=>$gantry->get('utility-contrast', 'dark'),

		'main-accent'=>$gantry->get('main-accent','#3cb2ce'),
		'main-accent2'=>$gantry->get('main-accent2','#fbf994'),
		'main-pattern'=>$gantry->get('main-pattern', 'noise'),
		'main-body'=>$gantry->get('main-body', 'light'),

		'extension-background'=>$gantry->get('extension-background', '#2c7d90'),
		'extension-accent'=>$gantry->get('extension-accent', '#3cb2ce'),
		'extension-accent2'=>$gantry->get('extension-accent2', '#fbf994'),
		'extension-pattern'=>$gantry->get('extension-pattern', 'noise'),
		'extension-contrast'=>$gantry->get('extension-contrast', 'dark'),

		'bottom-background'=>$gantry->get('bottom-background', '#e5eaed'),
		'bottom-accent'=>$gantry->get('bottom-accent', '#3cb2ce'),
		'bottom-accent2'=>$gantry->get('bottom-accent2', '#fbf994'),
		'bottom-pattern'=>$gantry->get('bottom-pattern', 'noise'),
		'bottom-contrast'=>$gantry->get('bottom-contrast', 'dark'),

		'footer-background'=>$gantry->get('footer-background', '#0e80a4'),
		'footer-accent'=>$gantry->get('footer-accent', '#3697b8'),
		'footer-accent2'=>$gantry->get('footer-accent2', '#fbf994'),
		'footer-pattern'=>$gantry->get('footer-pattern', 'noise'),
		'footer-contrast'=>$gantry->get('footer-contrast', 'dark')
	);

	$positions = array('showcase', 'feature', 'utility', 'extension', 'bottom', 'footer');

	foreach ($positions as $position) {
	        $data = $gantry->get($position . '-image', false) ? json_decode(str_replace("'", '"', $gantry->get($position . '-image'))) : false;
	        $lessVariables[$position . '-image'] = $data ? 'url(' . JURI::root(true) . '/' . $data->path . ')' : 'none';
	}

   	$gantry->addLess('global.less', 'master.css', 8, $lessVariables);
   	$gantry->addLess('top-section.less', 'top-section.css', 9, $lessVariables);
   	$gantry->addLess('bottom-section.less', 'bottom-section.css', 10, $lessVariables);

	$this->_disableRokBoxForiPhone();

	$gantry->addInlineStyle($css);
	if ($gantry->get('layout-mode')=="responsive") $gantry->addLess('mediaqueries.less');
	if ($gantry->get('layout-mode')=="960fixed") $gantry->addLess('960fixed.less');
	if ($gantry->get('layout-mode')=="1200fixed") $gantry->addLess('1200fixed.less');

        // SmoothScroll
	$gantry->addInlineScript("
		window.addEvent('domready', function(){ new Fx.SmoothScroll({ link: 'cancel', offset: {x: 0, y: -60}}); });
		");

        // Parallax JS
	$detect = new GantryMobileDetect();
	if ($gantry->get('showcase-parallax') or $gantry->get('feature-parallax') or $gantry->get('utility-parallax') or
		$gantry->get('extension-parallax') or $gantry->get('bottom-parallax') or
		$gantry->get('footer-parallax')){

		//$gantry->addScript('visibility-watcher.js');
		if (!$detect->isTablet() && !$detect->isMobile()) $gantry->addScript('rt-parallax.js');
	}

        // Third Party (k2)
	if ($gantry->get('k2')) $gantry->addLess('thirdparty-k2.less');
}

function buildLogo(){
	global $gantry;

	if ($gantry->get('logo-type')!="custom") return "";

	$source = $width = $height = "";

	$logo = str_replace("&quot;", '"', str_replace("'", '"', $gantry->get('logo-custom-image')));
	$data = json_decode($logo);

	if (!$data){
		if (strlen($logo)) $source = $logo;
		else return "";
	} else {
		$source = $data->path;
	}

	if (substr($gantry->baseUrl, 0, strlen($gantry->baseUrl)) == substr($source, 0, strlen($gantry->baseUrl))){
		$file = JPATH_ROOT . '/' . substr($source, strlen($gantry->baseUrl));
	} else {
		$file = JPATH_ROOT . '/' . $source;
	}

	if (isset($data->width) && isset($data->height)){
		$width = $data->width;
		$height = $data->height;
	} else {
		$size = @getimagesize($file);
		$width = $size[0];
		$height = $size[1];
	}

	if (!preg_match('/^\//', $source))
	{
		$source = JURI::root(true).'/'.$source;
	}

	$output = "";
	$output .= "#rt-logo {background: url(".$source.") 50% 0 no-repeat !important;}"."\n";
	$output .= "#rt-logo {width: ".$width."px;height: ".$height."px;}"."\n";

	$file = preg_replace('/\//i', DIRECTORY_SEPARATOR, $file);

	return (file_exists($file)) ?$output : '';
}

function _createGradient($direction, $from, $fromOpacity, $fromPercent, $to, $toOpacity, $toPercent){
	global $gantry;
	$browser = $gantry->browser;

	$fromColor = $this->_RGBA($from, $fromOpacity);
	$toColor = $this->_RGBA($to, $toOpacity);
	$gradient = $default_gradient = '';

	$default_gradient = 'background: linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';

	switch ($browser->engine) {
		case 'gecko':
		$gradient = ' background: -moz-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
		break;

		case 'webkit':
		if ($browser->shortversion < '5.1'){

			switch ($direction){
				case 'top':
				$from_dir = 'left top'; $to_dir = 'left bottom'; break;
				case 'bottom':
				$from_dir = 'left bottom'; $to_dir = 'left top'; break;
				case 'left':
				$from_dir = 'left top'; $to_dir = 'right top'; break;
				case 'right':
				$from_dir = 'right top'; $to_dir = 'left top'; break;
			}
			$gradient = ' background: -webkit-gradient(linear, '.$from_dir.', '.$to_dir.', color-stop('.$fromPercent.','.$fromColor.'), color-stop('.$toPercent.','.$toColor.'));';
		} else {
			$gradient = ' background: -webkit-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
		}
		break;

		case 'presto':
		$gradient = ' background: -o-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
		break;

		case 'trident':
		if ($browser->shortversion >= '10'){
			$gradient = ' background: -ms-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
		} else if ($browser->shortversion <= '6'){
			$gradient = $from;
			$default_gradient = '';
		} else {

			$gradient_type = ($direction == 'left' || $direction == 'right') ? 1 : 0;
			$from_nohash = str_replace('#', '', $from);
			$to_nohash = str_replace('#', '', $to);

			if (strlen($from_nohash) == 3) $from_nohash = str_repeat(substr($from_nohash, 0, 1), 6);
			if (strlen($to_nohash) == 3) $to_nohash = str_repeat(substr($to_nohash, 0, 1), 6);

			if ($fromOpacity == 0 || $fromOpacity == '0' || $fromOpacity == '0%') $from_nohash = '00' . $from_nohash;
			if ($toOpacity == 0 || $toOpacity == '0' || $toOpacity == '0%') $to_nohash = '00' . $to_nohash;

			$gradient = " filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#".$to_nohash."', endColorstr='#".$from_nohash."',GradientType=".$gradient_type." );";

			$default_gradient = '';

		}
		break;

		default:
		$gradient = $from;
		$default_gradient = '';
		break;
	}

	return  $default_gradient . $gradient;
}

function _HEX2RGB($hexStr, $returnAsString = false, $seperator = ','){
	$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
	$rgbArray = array();

	if (strlen($hexStr) == 6){
		$colorVal = hexdec($hexStr);
		$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
		$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
		$rgbArray['blue'] = 0xFF & $colorVal;
	} elseif (strlen($hexStr) == 3){
		$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
		$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
		$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
	} else {
		return false;
	}

	return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
}

function _RGBA($hex, $opacity){
	return 'rgba(' . $this->_HEX2RGB($hex, true) . ','.$opacity.')';
}

function _disableRokBoxForiPhone() {
	global $gantry;

	if ($gantry->browser->platform == 'iphone' || $gantry->browser->platform == 'android') {
		$gantry->addInlineScript("window.addEvent('domready', function() {\$\$('a[rel^=rokbox]').removeEvents('click');});");
	}
}
}
