if(!xtag.tags['cd-toolbaritem']) {
    xtag.register('cd-toolbaritem', {
        accessors: {
            id: {
                attribute: {}
            },
            icon: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                
            }
        }
    });
}