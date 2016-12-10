import { serverManager } from '../core/serverManager'

// Elabora pulsanti
let processButtonContainer = function(tag, childTagSubChildren, operation) {
    for(let j = 0; j < childTagSubChildren.length; j++) {
        let childTagSub = childTagSubChildren.eq(j),
            childSubId = childTagSub.attr('id'),
            buttonClickHandler = childTagSub.data('clickhandler');
        
        if (buttonClickHandler) {    
            tag.on('click', '#' + childSubId, function(e) {   
                e.preventDefault();

                // Effettua validazione
                if (childSubId === 'btn_confirm') {
                    $('#detail_form').validate();
                    if ($('#detail_form').valid()) {
                        serverManager.invokeActionController(buttonClickHandler + '/' + operation + '/' + childSubId);
                    } else {
                        return;
                    }
                } else {
                    serverManager.invokeActionController(buttonClickHandler + '/' + operation + '/' + childSubId);
                }
                
            });
        }    
    }
}

// Elabora elementi
let processChildren = function(tag, element, id, operation) {
    let children = tag.children();

    // Scorre tutti gli elementi della dialog
    for(let i = 0; i < children.length; i++) {
        let childTag = children.eq(i),
            childId = childTag.attr('id'),
            childTagname = childTag.get(0).tagName.toLowerCase(),
            childTagSubChildren = childTag.children();

        switch (childId) {
            case 'button_container':
                processButtonContainer(tag, childTagSubChildren, operation);
                break;
        }

        element.append(children);
    }
}

if(!xtag.tags['cd-form-wrapper']) {
    xtag.register('cd-form-wrapper', {
        accessors: {
            id: {
                attribute: {}
            },
            operation: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                let element = $(this),
                    formWrapper = $('<form id="detail_form"></form>');

                // Form wrapper    
                this.xtag.container = formWrapper.appendTo(this);

                // Elabora elementi
                processChildren.call(this, element, this.xtag.container, this.id, this.operation);
            }
        }
    });
}