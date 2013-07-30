;((function(){
    Element.implement({
        parallax: function(){
            var height, self = this,
                firstTop = this.getPosition().y,
                pos, top;

            var update = function(){
                pos = window.getScroll().y;
                top = self.getPosition().y;
                height = self.getSize().y;
                speedFactor = self.get('data-parallax-delta') || 0.7;

                if (top + height < pos || top > pos + window.getSize().y) {
                    return;
                }

                self.style.backgroundPosition = "50% " + Math.round((firstTop - pos) * speedFactor) + "px";
            }

            RokScrollEvents.push(update);
            update();
        }
    });

    window.addEvent('load', function(){
        document.getElements('.rt-parallax').each(function(element){
            element.parallax();
        });
    });
})());
