import { serverManager } from '../core/serverManager'

// Elabora elementi
let processChildren = function(tag, element, id) {
    let children = tag.children();

    for(let i = 0; i < children.length; i++) {
        let childTag = children.eq(i),
            childId = childTag.attr('id'),
            clickHandler = childTag.data('clickhandler'),
            info = childTag.data('info') || '_';

        // Evento click
        if (clickHandler) {    
            tag.on('click', '#' + childId, function(e) {   
                serverManager.invokeActionController(clickHandler + '/' + childId + '/' + info);
            });
        }
       
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
                let element = $(this);

                // Elabora elementi
                processChildren.call(this, element, this.xtag.container, this.id);
                element.children('cd-components-wrapper').remove();
            }
        }
    });
}