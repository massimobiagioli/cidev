if(!xtag.tags['cd-panelmenuitem']) {
    xtag.register('cd-panelmenuitem', {
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
            expanded: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                
            }
        }
    });
}