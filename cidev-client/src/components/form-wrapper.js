import { serverManager } from '../core/serverManager'
import _ from 'underscore'

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

                        // Mappa tutti i controlli di tipo checkbox
                        let checkboxArray = $("input:checkbox").map(function(x) {
                            return {
                                name: $(this).get(0).id,
                                value: $(this).is(":checked")
                            }
                        }).get();
                        
                        // Serializza form
                        let serializedForm = $('#detail_form').serializeArray().reduce(function(a, x) { 
                            let i = _.findIndex(checkboxArray, { name: x.name });
                            if (i != -1) {
                                a[x.name] = checkboxArray[i].value; 
                            } else {
                                a[x.name] = x.value; 
                            }
                            return a; 
                        }, {});
                        
                        console.log(serializedForm);

                        let encodedInfo = encodeURIComponent(btoa(JSON.stringify(serializedForm)));

                        // Effettua chiamata al server
                        serverManager.invokeActionController(buttonClickHandler + '/' + operation + '/' + childSubId + '/' + encodedInfo);
                    } else {
                        return;
                    }
                } else {
                    serverManager.invokeActionController(buttonClickHandler + '/' + operation + '/' + childSubId + '/_');
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