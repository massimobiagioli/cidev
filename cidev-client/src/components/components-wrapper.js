import { serverManager } from '../core/serverManager'

// Elabora elementi
var processChildren = function(tag, element, id) {
    var children = tag.children();

    for(var i = 0; i < children.length; i++) {
        var childTag = children.eq(i),
            childId = childTag.attr('id'),
            clickHandler = childTag.data('clickhandler');

        (function(childId, clickHandler) {
            
            // Evento click
            if (clickHandler) {    
                tag.on('click', '#' + childId, function(e) {   
                    serverManager.invokeActionController(clickHandler + '/' + childId);
                });
            }
            
        })(childId, clickHandler); 
    }
}

if(!xtag.tags['cd-components-wrapper']) {
    xtag.register('cd-components-wrapper', {
        accessors: {
            id: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                var element = $(this);

                // Elabora elementi
                processChildren.call(this, element, this.xtag.container, this.id);
                element.children('cd-components-wrapper').remove();
            }
        }
    });
}