import { serverManager } from '../core/serverManager' 

// Aggiunge sottoelementi a menu
let createNestedPanelMenuDom = function(tag, element, id, menuExpandedId, menuClickHandler) {
    let children = tag.children();

    for(let i = 0; i < children.length; i++) {
        let childTag = children.eq(i),
            childTagSubChildren = childTag.children(),
            childTagname = childTag.get(0).tagName.toLowerCase();
        
        if(childTagname === 'cd-panelmenuitem') {       
            let menuitemDomWrapper = $('<div></div>'),
                menuitemDomHeaderWrapper = $('<div></div>'),
                menuitemDomHeader = $('<a></a>'),
                idHeader = (childTag.attr('id') ? (id ? id + '-' : '') + childTag.attr('id') : ''),
                icon = childTag.attr('icon'),
                href = childTag.attr('href'),
                autoexpand = childTag.attr('autoexpand'),
                textContent = childTag.clone().children().remove().end().text();

            // Header    
            if (idHeader) {
                menuitemDomHeader.attr('id', idHeader);
                if (autoexpand) {
                    menuExpandedId.push(idHeader);
                }
            }
            if (icon) {
                menuitemDomHeader.data('icon', icon);
            }
            if (href) {
                menuitemDomHeader.attr('href', href);
            }
            menuitemDomHeader.text(textContent);
            menuitemDomHeaderWrapper.append(menuitemDomHeader);
            menuitemDomWrapper.append(menuitemDomHeaderWrapper);
            
            // Sottoelementi
            let menuitemDomSubitemWrapperDiv = $('<div></div>'),
                menuitemDomSubitemWrapperUl = $('<ul></ul>');

            for(let j = 0; j < childTagSubChildren.length; j++) {
                let childTagSub = childTagSubChildren.eq(j),
                    childTagnameSub = childTagSub.get(0).tagName.toLowerCase();

                if(childTagnameSub === 'cd-panelmenusubitem') {  
                    let menuitemDomSubitemLi = $('<li></li>'),
                        menuitemDomSubitem = $('<a></a>'),
                        idSub = (childTagSub.attr('id') ? idHeader + childTagSub.attr('id') : ''),
                        iconSub = childTagSub.attr('icon'),
                        hrefSub = childTagSub.attr('href'),
                        textContentSub = childTagSub.get(0).textContent;

                    if (idSub) {
                        menuitemDomSubitem.attr('id', idSub);
                        menuitemDomSubitem.data('menuId', childTagSub.attr('id'));
                    }
                    if (iconSub) {
                        menuitemDomSubitem.data('icon', iconSub);
                    }
                    if (hrefSub) {
                        menuitemDomSubitem.attr('href', hrefSub);
                    }
                    if (menuClickHandler) {
                        menuitemDomSubitem.on('click', function(e) {
                            serverManager.invokeActionController(menuClickHandler + '/' + $(e.currentTarget).data('menuId'));
                        });
                    }
                    menuitemDomSubitem.text(textContentSub);

                    menuitemDomSubitemLi.append(menuitemDomSubitem);
                    menuitemDomSubitemWrapperUl.append(menuitemDomSubitemLi);
                }  
            }
            
            menuitemDomSubitemWrapperDiv.append(menuitemDomSubitemWrapperUl);
            menuitemDomWrapper.append(menuitemDomSubitemWrapperDiv);
            element.append(menuitemDomWrapper);
        }
    }
};

if(!xtag.tags['cd-panelmenu']) {
    xtag.register('cd-panelmenu', {
        accessors: {
            id: {
                attribute: {}
            },
            width: {
                attribute: {}
            },
            menuclickhandler: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                let element = $(this),
                    divWrapper = $('<div></div>'),
                    menuExpandedId = [];

                // Div Wrapper    
                if (this.width) {
                    divWrapper.css('width', this.width);
                }
                this.xtag.container = divWrapper.appendTo(this);

                // Aggiunge figli
                createNestedPanelMenuDom.call(this, element, this.xtag.container, this.id, menuExpandedId, this.menuclickhandler);
                element.children('cd-panelmenuitem').remove();

                // Render Panelmenu utilizzando PrimeUI
                $(this.xtag.container).puipanelmenu();

                // Gestione nodi espansi
                menuExpandedId.forEach(function(menuId) {
                    $('#' + menuId).trigger('click');
                });
            }
        }
    });
}