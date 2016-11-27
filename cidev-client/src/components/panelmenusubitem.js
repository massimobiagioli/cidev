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
            }
        },
        lifecycle: {
            created: function() {
                
            }
        }
    });
}