;((function(){
    var QuickNav = new Class({
        initialize: function(element){
            this.element = document.id(element) || document.getElement(element);
            if (!this.element) return;

            this.watch();
        },

        watch: function(){
            var position, target, relativeTo, index, watch, menu, scroll;

            watch = new moostrapScrollspy(this.element, {
                mask: 'a[href^=#]',
                offset: -(window.getSize().y / 4),
                onActive: function(el){
                    target = el.retrieve('navMonitor');
                    index = watch.links.indexOf(el);
                    relativeTo = !index ? '' : 'rt-quicknav-container';
                    position = target.getPosition(relativeTo).y;

                    el.addClass('active');

                    /*this.element.setStyles({
                        top: position + el.getSize().y / 2,
                        position: 'absolute'
                    });*/

                }.bind(this),
                onInactive: function(el){
                    el.removeClass('active');
                }
            });


            var container = document.id('rt-quicknav-container'),
                previous = (!container) ? null : container.getPrevious();

            previous = (previous) ? previous.getSize().y : 0;
            var positionContainer = this.element.getPosition('rt-quicknav-container').y + previous,
                topPosition = this.element.getStyle('top');

            scroll = function(){
                if (window.getScrollTop() + 25 > positionContainer){
                    this.element.setStyles({
                        position: 'fixed',
                        top: 25
                    });
                } else {
                    this.element.setStyles({
                        position: 'absolute',
                        top: topPosition
                    });
                }
            }.bind(this);

            RokScrollEvents.include(scroll);
            //window.addEvent('scroll', scroll);

            watch.scroll();
        }
    });

    window.addEvent('domready', function(){
        this.RTQuickNav = new QuickNav('.rt-quicknav');
    });
})());
