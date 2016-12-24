import { serverManager } from '../core/serverManager'
import { store } from '../core/stateManager' 

// Aggiunge pulsanti a toolbar
let createNestedElementDom = function(tag, element, id, buttonClickHandler, linkedGrid) {
    let children = tag.children();

    for(let i = 0; i < children.length; i++) {
        let childTag = children.eq(i),
            childTagname = childTag.get(0).tagName.toLowerCase();
        
        if(childTagname === 'cd-toolbaritem') {       
            let buttonDom = $('<button type="button"></button>'), 
                fullId = (childTag.attr('id') ? (id ? id + '-' : '') + childTag.attr('id') : ''),
                icon = childTag.attr('icon'),
                textContent = childTag.get(0).textContent;

            // Imposta proprietà pulsante    
            if (fullId) {
                buttonDom.attr('id', fullId);
                buttonDom.data('buttonId', childTag.attr('id'));
            }
            buttonDom.text(textContent);
            
            // Gestione click su pulsante
            if (buttonClickHandler) {
                buttonDom.on('click', function(e) {
                    let encodedInfo = encodeURIComponent(btoa(JSON.stringify(store.getState().grids[linkedGrid])));
                    serverManager.invokeActionController(buttonClickHandler + '/' + $(e.currentTarget).data('buttonId') + '/' + encodedInfo);
                });
            }

            // Effettua il render del pulsante con PrimeUI
            buttonDom.puibutton({
                icon: icon
            });

            element.append(buttonDom);
        }
    }
};

if(!xtag.tags['cd-toolbar']) {
    xtag.register('cd-toolbar', {
        accessors: {
            id: {
                attribute: {}
            },
            linkedgrid: {
                attribute: {}
            },
            buttonclickhandler: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                let element = $(this),
                    divWrapper = $('<div></div>');

                // Div Wrapper    
                divWrapper.css('margin-bottom', '5px');
                this.xtag.container = divWrapper.appendTo(this);

                // Aggiunge pulsanti
                createNestedElementDom.call(this, element, this.xtag.container, this.id, this.buttonclickhandler, this.linkedgrid);
                element.children('cd-toolbaritem').remove();
            }
        }
    });
}