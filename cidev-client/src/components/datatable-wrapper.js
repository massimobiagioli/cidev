import { serverManager } from '../core/serverManager' 

if(!xtag.tags['cd-datatable-wrapper']) {
    xtag.register('cd-datatable-wrapper', {
        lifecycle: {
            created: function() {
                
            }
        }
    });
}