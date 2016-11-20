if(!xtag.tags['cd-panelmenusubitem']) {
    xtag.register('cd-panelmenusubitem', {
        accessors: {
            id: {
                attribute: {}
            },
            icon: {
                attribute: {}
            },
            href: {
                attribute: {}
            },
            menuClickHandler: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                
            }
        }
    });
}