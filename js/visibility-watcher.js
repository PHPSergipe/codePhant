/*
---
description: VisibilityWatcher class.

license: MIT-style

authors:
- Francois Cartegnie

requires:
- core/1.2.3: '*'

provides: [VisibilityWatcher]

...
*/

((function(){
    Browser.Features.Touch = (function(){
        try {
            document.createEvent('TouchEvent').initTouchEvent('touchstart');
            return true;
        } catch (exception){}

        return false;
    })();

    window.requestAnimFrame = (function(){
        return  window.requestAnimationFrame       ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame    ||
                function( callback ){
                    window.setTimeout(callback, 1000 / 60);
                };
    })();


    var VisibilityWatcher = new Class({
        Implements: [Options, Events],

        options: {
            poll_interval: 50,
            method: 'event', /* poll or scroll event based */
            delay: 0, /* Delay before considering the event as stable */
            delta_px: 0, /* Extend the detection area by delta_px pixels */
            event_source: window /* scrollable element */
        },

        initialize: function(el, events, options){
            this.targetElements = [];
            this.setOptions(options);

            this.addEvents(events);
            this.add(el);
            this.visibilityChangedCheck();
            this.startWatching();
        },

        getVisibility: function(targetElement){
            if (typeof targetElement == 'undefined' )
                targetElement = this.targetElements[0].element;

            var elementPosition = targetElement.getPosition();
            var elementSize = targetElement.getSize();
            var returned_array = [];

            ['x', 'y'].each( function(el, index){
                if ( document.getScroll()[el] > (elementPosition[el] + elementSize[el] + this.options.delta_px) )
                    returned_array[el] = 'after';
                else
                if ( (document.getScroll()[el] + window.getSize()[el]) > (elementPosition[el] - this.options.delta_px) )
                    returned_array[el] = 'on';
                else
                    returned_array[el] = 'before';
            }, this);

            return returned_array;
        },

        startWatching: function() {
            if (Browser.Features.Touch){
                document.addEventListener("touchmove", this.touchMoveChangeCheck.bind(this), false);
            }

            if (this.options.method == 'poll'){
                this.interval_id = this.visibilityChangedCheck.periodical(this.options.poll_interval, this);
            } else {
                RokScrollEvents.include(this.visibilityChangedCheck.bind(this));
                //document.id(this.options.event_source).addEvent('scroll', this.visibilityChangedCheck.bind(this));
            }

            return this;
        },

        stopWatching: function() {
            if (Browser.Features.Touch) document.removeEventListener("touchmove", this.touchMoveChangeCheck.bind(this), false);

            if (this.options.method == 'poll'){
                this.interval_id = clearTimeout(this.interval_id);
            } else {
                RokScrollEvents.erase(this.visibilityChangedCheck.bind(this));
                //document.id(this.options.event_source).removeEvent('scroll', this.visibilityChangedCheck.bind(this));
                if (this.gratuitouscheck_id) clearTimeout(this.gratuitouscheck_id);
            }
            return this;
        },

        add: function(targetElement){
            Array.from( targetElement ).each( function(el, index){
                this.targetElements.push( {'element': document.id( el ), 'last_state': []} );
            }.bind(this) );
            return this;
        },

        remove: function(targetElement){
            targetElement = document.id(targetElement);
            this.targetElements = this.targetElements.filter(function(el){
                return ( targetElement != el['element'] );
            });
            return this;
        },

        prepareAndFireEvent: function(eventName, element)
        {
            this.fireEvent(eventName, element);
        },

        touchMoveChangeCheck: function(e){
            if (e.touches.length != 1) return true;
            this.visibilityChangedCheck();
        },

        visibilityChangedCheck: function(){
            var currentTime = Date.now();
            this.targetElements.each( function(targetElement, index){
                var cur_state = this.getVisibility( targetElement.element );

                if ( ! ['x', 'y'].every( function(axis, index){ return (cur_state[axis] == targetElement.last_state[axis]); }, this) )
                {
                    if (!targetElement.last_state['started']) targetElement.last_state['started'] = currentTime;
                    if ((currentTime - targetElement.last_state['started']) >= this.options.delay)
                    {
                        targetElement.last_state = cur_state;
                        if ( ['x', 'y'].every( function(axis, index){ return( cur_state[axis] == 'on'); }) )
                            this.prepareAndFireEvent('enteredscreen', targetElement.element);
                        else
                            this.prepareAndFireEvent('leftscreen', targetElement.element);
                    } else {
                        if (this.options.delay>0 && this.options.method == 'event')
                        {   /*Force an additional check if events have stopped*/
                            if (this.gratuitouscheck_id) clearTimeout(this.gratuitouscheck_id);
                            this.gratuitouscheck_id = this.visibilityChangedCheck.delay(this.options.delay+1, this);
                        }
                    }
                } else {
                    targetElement.last_state.erase('started');
                }
            }.bind(this) );

            this.prepareAndFireEvent('updatedvisibilitystatus');
            return this;
        }
    });

    this.VisibilityWatcher = VisibilityWatcher;
})());
