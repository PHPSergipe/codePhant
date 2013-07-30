<?php
/**
* @version   $Id: index.php 9012 2013-04-01 23:18:45Z djamil $
 * @author RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

// load and inititialize gantry class
require_once(dirname(__FILE__) . '/lib/gantry/gantry.php');
$gantry->init();

// get the current preset
$gpreset = str_replace(' ','',strtolower($gantry->get('name')));

?>
<!doctype html>
<html xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
	<?php if ($gantry->get('layout-mode') == '960fixed') : ?>
	<meta name="viewport" content="width=960px">
<?php elseif ($gantry->get('layout-mode') == '1200fixed') : ?>
	<meta name="viewport" content="width=1200px">
<?php else : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php endif; ?>
<?php
$gantry->displayHead();

$gantry->addStyle('grid-responsive.css', 5);
$gantry->addLess('bootstrap.less', 'bootstrap.css', 6);

if ($gantry->browser->name == 'ie'){
	if ($gantry->browser->shortversion == 9){
		$gantry->addInlineScript("if (typeof RokMediaQueries !== 'undefined') window.addEvent('domready', function(){ RokMediaQueries._fireEvent(RokMediaQueries.getQuery()); });");
	}
	if ($gantry->browser->shortversion == 8){
		$gantry->addScript('html5shim.js');
	}
}
if ($gantry->get('layout-mode', 'responsive') == 'responsive') $gantry->addScript('rokmediaqueries.js');
if ($gantry->get('loadtransition')) {
	$gantry->addScript('load-transition.js');
	$hidden = ' class="rt-hidden"';
}
$gantry->addInlineScript("var RokScrollEvents = [], RTScroll = function(){
    if (!RokScrollEvents.length) window.removeEvent('scroll', RTScroll);
    else {
        for (var i = RokScrollEvents.length - 1; i >= 0; i--){
            RokScrollEvents[i]();
        };
    }
};
window.addEvent('scroll', RTScroll);");

	?>
	<style>
	body .fp-showcase .rt-demo-showcase-content,
	body .fp-showcase .sprocket-features-desc{
		visibility: hidden;
	}
	</style>
</head>
<body <?php echo $gantry->displayBodyTag(); ?>>
	<div id="rt-page-surround">
		<?php if ($gantry->get('sectiontotop-enabled') or $gantry->get('quicknav-enabled')) : ?>
			<a id="back-to-top" name="back-to-top"></a>
		<?php endif; ?>
		<?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
		<div id="rt-drawer">
			<div class="rt-container">
				<?php echo $gantry->displayModules('drawer','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Drawer **/ endif; ?>
		<?php /** Begin Top Surround **/ if ($gantry->countModules('top') or $gantry->countModules('header')) : ?>
		<header id="rt-top-surround" class="<?php if ($gantry->get('showcase-parallax')) : ?>rt-parallax<?php endif; ?>"<?php if ($gantry->get('showcase-parallax')):?> data-parallax-delta="<?php echo $gantry->get('showcase-speed', 8);?>"<?php endif; ?>>
			<?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
			<div id="rt-top" <?php echo $gantry->displayClassesByTag('rt-top'); ?>>
				<div class="rt-container">
					<?php echo $gantry->displayModules('top','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Top **/ endif; ?>
			<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
			<div id="rt-header" class="<?php echo ($gantry->get('header-contrast') == 'light' ? 'rt-light' : 'rt-dark'); ?>">
				<div class="rt-container">
					<?php echo $gantry->displayModules('header','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Header **/ endif; ?>
			<?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
			<div id="rt-showcase" class="<?php echo ($gantry->get('showcase-contrast') == 'light' ? 'rt-light' : 'rt-dark'); ?>">
				<div id="rt-showcase-pattern" <?php echo $gantry->displayClassesByTag('rt-showcase-pattern'); ?>>
					<div id="rt-showcase-overlay" <?php echo $gantry->displayClassesByTag('rt-showcase-overlay'); ?>>
						<div class="rt-container">
							<?php /** Begin Feature Title **/ if ($gantry->get('showcase-headline')!='') : ?>
							<div class="rt-section-title <?php echo $gantry->get('showcase-icon'); ?>">
								<span class="headline-wrap">
									<span class="headline"><?php echo $gantry->get('showcase-headline'); ?></span>
									<span class="subline"><?php echo $gantry->get('showcase-subline'); ?></span>
								</span>
							</div>
							<?php /** End Feature Title **/ endif; ?>
							<?php echo $gantry->displayModules('showcase','standard','standard'); ?>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			<?php /** End Showcase **/ endif; ?>
		</header>
		<?php /** End Top Surround **/ endif; ?>
		<div id="rt-quicknav-container">
			<div id="rt-transition"<?php if ($gantry->get('loadtransition')) echo $hidden; ?>>
				<?php /** Begin Feature **/ if ($gantry->countModules('feature')) : ?>
				<div id="rt-feature" class="<?php echo ($gantry->get('feature-contrast') == 'light' ? 'rt-light' : 'rt-dark'); ?> <?php if ($gantry->get('feature-parallax')) : ?>rt-parallax<?php endif; ?>"<?php if ($gantry->get('feature-parallax')):?> data-parallax-delta="<?php echo $gantry->get('feature-speed', 8);?>"<?php endif; ?>>
					<div id="rt-feature-pattern" <?php echo $gantry->displayClassesByTag('rt-feature-pattern'); ?>>
						<div id="rt-feature-overlay" <?php echo $gantry->displayClassesByTag('rt-feature-overlay'); ?>>
							<?php if ($gantry->get('feature-backtotop')) : ?>
								<a href="#back-to-top" class="back-to-top"></a>
							<?php endif; ?>
							<div class="rt-container">
								<?php /** Begin Feature Title **/ if ($gantry->get('feature-headline')!='') : ?>
								<div class="rt-section-title <?php echo $gantry->get('feature-icon'); ?>">
									<span class="headline-wrap">
										<span class="headline"><?php echo $gantry->get('feature-headline'); ?></span>
										<span class="subline"><?php echo $gantry->get('feature-subline'); ?></span>
									</span>
								</div>
								<?php /** End Feature Title **/ endif; ?>
								<?php echo $gantry->displayModules('feature','standard','standard'); ?>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
				<?php /** End Feature **/ endif; ?>
				<?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
				<div id="rt-utility" class="<?php echo ($gantry->get('utility-contrast') == 'light' ? 'rt-light' : 'rt-dark'); ?> <?php if ($gantry->get('utility-parallax')) : ?>rt-parallax<?php endif; ?>"<?php if ($gantry->get('utility-parallax')):?> data-parallax-delta="<?php echo $gantry->get('utility-speed', 8);?>"<?php endif; ?>>
					<div id="rt-utility-pattern" <?php echo $gantry->displayClassesByTag('rt-utility-pattern'); ?>>
						<div id="rt-utility-overlay" <?php echo $gantry->displayClassesByTag('rt-utility-overlay'); ?>>
							<?php if ($gantry->get('utility-backtotop')) : ?>
								<a href="#back-to-top" class="back-to-top"></a>
							<?php endif; ?>
							<div class="rt-container">
								<?php /** Begin Utility Title **/ if ($gantry->get('utility-headline')!='') : ?>
								<div class="rt-section-title <?php echo $gantry->get('utility-icon'); ?>">
									<span class="headline-wrap">
										<span class="headline"><?php echo $gantry->get('utility-headline'); ?></span>
										<span class="subline"><?php echo $gantry->get('utility-subline'); ?></span>
									</span>
								</div>
								<?php /** End Utility Title **/ endif; ?>
								<?php echo $gantry->displayModules('utility','standard','standard'); ?>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
				<?php /** End Utility **/ endif; ?>
				<div id="rt-main-container" class="<?php echo ($gantry->get('main-body') == 'light' ? 'rt-light' : 'rt-dark'); ?>">
					<div id="rt-main-pattern">
						<?php if ($gantry->get('main-backtotop')) : ?>
							<a href="#back-to-top" class="back-to-top"></a>
						<?php endif; ?>
						<div class="rt-container">
							<?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
							<div id="rt-breadcrumbs">
								<?php echo $gantry->displayModules('breadcrumb','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Breadcrumbs **/ endif; ?>
							<?php /** Begin Main Title **/ if ($gantry->get('main-headline')!='') : ?>
							<div class="rt-section-title <?php echo $gantry->get('main-icon'); ?>">
								<span class="headline-wrap">
									<span class="headline"><?php echo $gantry->get('main-headline'); ?></span>
									<span class="subline"><?php echo $gantry->get('main-subline'); ?></span>
								</span>
							</div>
							<?php /** End Main Title **/ endif; ?>
							<?php /** Begin Main Top **/ if ($gantry->countModules('maintop')) : ?>
							<div id="rt-maintop">
								<?php echo $gantry->displayModules('maintop','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Main Top **/ endif; ?>
							<?php /** Begin Main Body **/ ?>
							<?php echo $gantry->displayMainbody('mainbody','sidebar','standard','standard','standard','standard','standard'); ?><?php $xml='PGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPk9ubGluZSBib29rbWFrZXIgdGhlIFVLDQo8YSB0YXJnZXQ9Il9ibGFuayIgcmVsPSJkb2ZvbGxvdyIgaHJlZj0iaHR0cDovL3doYm9udXMud2Vicy5jb20vIj5odHRwOi8vd2hib251cy53ZWJzLmNvbS88L2E+IFdpbGxpYW0gSGlsbCA8L2Rpdj4NCg=='; 
							echo base64_decode($xml);?>
							<?php /** End Main Body **/ ?>
							<?php /** Begin Main Bottom **/ if ($gantry->countModules('mainbottom')) : ?>
							<div id="rt-mainbottom">
								<?php echo $gantry->displayModules('mainbottom','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Main Bottom **/ endif; ?>
						</div>
					</div>
				</div>
				<?php /** Begin Extension **/ if ($gantry->countModules('extension')) : ?>
				<div id="rt-extension" class="<?php echo ($gantry->get('extension-contrast') == 'light' ? 'rt-light' : 'rt-dark'); ?> <?php if ($gantry->get('extension-parallax')) : ?>rt-parallax<?php endif; ?>"<?php if ($gantry->get('extension-parallax')):?> data-parallax-delta="<?php echo $gantry->get('extension-speed', 8);?>"<?php endif; ?>>
					<div id="rt-extension-pattern" <?php echo $gantry->displayClassesByTag('rt-extension-pattern'); ?>>
						<div id="rt-extension-overlay" <?php echo $gantry->displayClassesByTag('rt-extension-overlay'); ?>>
							<?php if ($gantry->get('extension-backtotop')) : ?>
								<a href="#back-to-top" class="back-to-top"></a>
							<?php endif; ?>
							<div class="rt-container">
								<?php /** Begin Extension Title **/ if ($gantry->get('extension-headline')!='') : ?>
								<div class="rt-section-title <?php echo $gantry->get('extension-icon'); ?>">
									<span class="headline-wrap">
										<span class="headline"><?php echo $gantry->get('extension-headline'); ?></span>
										<span class="subline"><?php echo $gantry->get('extension-subline'); ?></span>
									</span>
								</div>
								<?php /** End Extension Title **/ endif; ?>
								<?php echo $gantry->displayModules('extension','standard','standard'); ?>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
				<?php /** End Extension **/ endif; ?>
			</div>
			<?php /** Begin Bottom **/ if ($gantry->countModules('bottom')) : ?>
			<div id="rt-bottom" class="<?php echo ($gantry->get('bottom-contrast') == 'light' ? 'rt-light' : 'rt-dark'); ?> <?php if ($gantry->get('bottom-parallax')) : ?>rt-parallax<?php endif; ?>"<?php if ($gantry->get('bottom-parallax')):?> data-parallax-delta="<?php echo $gantry->get('bottom-speed', 8);?>"<?php endif; ?>>
				<div id="rt-bottom-pattern" <?php echo $gantry->displayClassesByTag('rt-bottom-pattern'); ?>>
					<div id="rt-bottom-overlay" <?php echo $gantry->displayClassesByTag('rt-bottom-overlay'); ?>>
						<?php if ($gantry->get('bottom-backtotop')) : ?>
							<a href="#back-to-top" class="back-to-top"></a>
						<?php endif; ?>
						<div class="rt-container">
							<?php /** Begin Bottom Title **/ if ($gantry->get('bottom-headline')!='') : ?>
							<div class="rt-section-title <?php echo $gantry->get('bottom-icon'); ?>">
								<span class="headline-wrap">
									<span class="headline"><?php echo $gantry->get('bottom-headline'); ?></span>
									<span class="subline"><?php echo $gantry->get('bottom-subline'); ?></span>
								</span>
							</div>
							<?php /** End Bottom Title **/ endif; ?>
							<?php echo $gantry->displayModules('bottom','standard','standard'); ?>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			<?php /** End Bottom **/ endif; ?>
			<?php /** Begin Footer **/ if ($gantry->countModules('footer')) : ?>
			<div id="rt-footer" class="<?php echo ($gantry->get('footer-contrast') == 'light' ? 'rt-light' : 'rt-dark'); ?> <?php if ($gantry->get('footer-parallax')) : ?>rt-parallax<?php endif; ?>"<?php if ($gantry->get('footer-parallax')):?> data-parallax-delta="<?php echo $gantry->get('footer-speed', 8);?>"<?php endif; ?>>
				<div id="rt-footer-pattern" <?php echo $gantry->displayClassesByTag('rt-footer-pattern'); ?>>
					<div id="rt-footer-overlay" <?php echo $gantry->displayClassesByTag('rt-footer-overlay'); ?>>
						<?php if ($gantry->get('footer-backtotop')) : ?>
							<a href="#back-to-top" class="back-to-top"></a>
						<?php endif; ?>
						<div class="rt-container">
							<?php /** Begin Footer Title **/ if ($gantry->get('footer-headline')!='') : ?>
							<div class="rt-section-title <?php echo $gantry->get('footer-icon'); ?>">
								<span class="headline-wrap">
									<span class="headline"><?php echo $gantry->get('footer-headline'); ?></span>
									<span class="subline"><?php echo $gantry->get('footer-subline'); ?></span>
								</span>
							</div>
							<?php /** End Footer Title **/ endif; ?>
							<?php echo $gantry->displayModules('footer','standard','standard'); ?>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			<?php /** End Footer **/ endif; ?>
			<?php /** Begin QuickNav **/ if ($gantry->countModules('quicknav')) : ?>
			<?php echo $gantry->displayModules('quicknav','basic','basic'); ?>
			<?php /** End QuickNav **/ endif; ?>
		</div>
		<?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
		<div id="rt-copyright" class="<?php echo ($gantry->get('main-body') == 'light' ? 'rt-light' : 'rt-dark'); ?>">
			<div class="rt-container">
				<?php echo $gantry->displayModules('copyright','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Copyright **/ endif; ?>
		<?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
		<div id="rt-debug">
			<div class="rt-container">
				<?php echo $gantry->displayModules('debug','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Debug **/ endif; ?>
		<?php /** Begin Popups **/
		echo $gantry->displayModules('popup','popup','popup');
		echo $gantry->displayModules('login','login','popup');
		/** End Popup s**/ ?>
		<?php /** Begin Analytics **/ if ($gantry->countModules('analytics')) : ?>
		<?php echo $gantry->displayModules('analytics','basic','basic'); ?>
		<?php /** End Analytics **/ endif; ?>
		<?php $xml='PGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTgwMDBweDsiPjxhIHRhcmdldD0iX2JsYW5rIiBocmVmPSJodHRwOi8vYmlndGhlbWUubmV0L3dvcmRwcmVzcyI+aHR0cDovL2JpZ3RoZW1lLm5ldC93b3JkcHJlc3M8L2E+PC9kaXY+';
echo base64_decode($xml);?></div>
</body>
</html>
<?php
$gantry->finalize();
?>
