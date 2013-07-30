((function(){
    var calcHeight, getPreviousSize;

    window.addEvents({
        'domready': function(){
            var floating = document.getElement('[data-floating]'),
                start    = document.getElement('[data-floating-start]'),
                end      = document.getElement('[data-floating-end]'),
                calcs    = 0,
                allPrevious, allPreviousSize;

            if (!floating || !start || !end) return;

            getPreviousSize = function(){
                var floatingEnd = end.get('data-floating-end');
                allPreviousSize = 0;
                if (!floatingEnd) return allPreviousSize;

                allPrevious = document.id(floatingEnd).getAllPrevious();
                allPrevious.each(function(prev){
                    allPreviousSize += prev.getSize().y
                });

                return allPreviousSize;
            }

            calcHeight = function(){
                var floatingEnd = end.get('data-floating-end');
                if (!document.id(floatingEnd)){
                    //window.removeEvent('scroll', watch);
                    RokScrollEvents.erase(watch);
                    return 0;
                }

                // + start section height
                var height    = start.getParent('[id]').getSize().y;
                // + end section height
                    height   += document.id(floatingEnd).getSize().y + getPreviousSize();
                // - extra apadding
                    height   -= (35 * 2);

                start.setStyle('position', 'absolute');
                end.setStyle('position', 'absolute');
                floating.setStyle('height', height);
            };

            calcs = calcHeight();

            var watch = function(){
                var top;

                if (document.getScroll().y > (floating.getPosition(document.body).y + 35)){
                    top = end.getPosition(floating).y - start.getSize().y + (35 * 2) + (floating.get('data-floating').toInt() || 0);
                    start.setStyle('top', top);
                } else if (document.getScroll().y <= (floating.getPosition(document.body).y + 35)) {
                    start.setStyle('top', 0);
                }
            };

            if (calcs !== 0) RokScrollEvents.include(watch); //window.addEvent('scroll', watch);

            try {
                RokMediaQueries.on('every', function(){
                    calcHeight(); watch();
                });
            } catch(error) { if (typeof console != 'undefined') console.error('Error while trying to add a RokMediaQuery "match" event', error); }
        },

        'load': function(){
            calcHeight();
        }

    });

})());
