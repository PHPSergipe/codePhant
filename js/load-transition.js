/**
* @version   $Id: load-transition.js 8151 2013-03-08 22:41:17Z josh $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

((function(){

var animation = function(){
	var body = document.id('rt-transition');

	if (Browser.Engine.gecko19 || (Browser.Engine.trident && !Browser.Engine.trident7)){
		if (body){
			body.set('tween', {duration: 800, transition: 'quad:out'});
			body.setStyles({'visibility': 'hidden', 'opacity': 0});
			body.removeClass('rt-hidden').fade('in');
		}
		
		return;
	}
	
	if (body) body.removeClass('rt-hidden').addClass('rt-visible');
};

window.addEvent('load', animation);

})());