import { serverManager } from '../core/serverManager' 

// Aggiunge sottoelementi a menu
var createNestedPanelMenuDom = function(tag, element, id, menuExpandedId) {
    var children = tag.children();

    for(var i = 0; i < children.length; i++) {
        var childTag = children.eq(i),
            childTagSubChildren = childTag.children(),
            childTagname = childTag.get(0).tagName.toLowerCase();
        
        if(childTagname === 'cd-panelmenuitem') {       
            var menuitemDomWrapper = $('<div></div>'),
                menuitemDomHeaderWrapper = $('<div></div>'),
                menuitemDomHeader = $('<a></a>'),
                idHeader = (childTag.attr('id') ? (id ? id + '-' : '') + childTag.attr('id') : ''),
                icon = childTag.attr('icon'),
                href = childTag.attr('href'),
                autoexpand = childTag.attr('autoexpand'),
                textContent = childTag.get(0).textContent;

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
            
            // SubElements
            var menuitemDomSubitemWrapperDiv = $('<div></div>'),
                menuitemDomSubitemWrapperUl = $('<ul></ul>');

            for(var j = 0; j < childTagSubChildren.length; j++) {
                var childTagSub = childTagSubChildren.eq(j),
                    childTagnameSub = childTagSub.get(0).tagName.toLowerCase();

                if(childTagnameSub === 'cd-panelmenusubitem') {  
                    var menuitemDomSubitemLi = $('<li></li>'),
                        menuitemDomSubitem = $('<a></a>'),
                        idSub = (childTagSub.attr('id') ? idHeader + childTagSub.attr('id') : ''),
                        iconSub = childTagSub.attr('icon'),
                        hrefSub = childTagSub.attr('href'),
                        menuClickHandlerSub = childTagSub.attr('menuClickHandler'),
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
                    if (menuClickHandlerSub) {
                        menuitemDomSubitem.on('click', function(e) {
                            serverManager.invokeActionController(menuClickHandlerSub + '/' + $(e.currentTarget).data('menuId'));
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
            }
        },
        lifecycle: {
            created: function() {
                var element = $(this),
                    divWrapper = $('<div></div>'),
                    menuExpandedId = [];

                // Div Wrapper    
                if (this.width) {
                    divWrapper.css('width', this.width);
                }
                this.xtag.container = divWrapper.appendTo(this);

                // add children
                createNestedPanelMenuDom.call(this, element, this.xtag.container, this.id, menuExpandedId);
                element.children('cd-panelmenuitem').remove();

                // PrimeUI transform
                $(this.xtag.container).puipanelmenu();

                // Handle Menu expanded
                menuExpandedId.forEach(function(menuId) {
                    $('#' + menuId).trigger('click');
                });
            }
        }
    });
}