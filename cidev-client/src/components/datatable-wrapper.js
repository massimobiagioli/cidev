import { serverManager } from '../core/serverManager'
import { store } from '../core/stateManager'
import { dataGridInit, dataGridHandleRowSelect, dataGridHandleRowUnselect } from '../core/actions/DataGridActions.js'  

// Registra funzioni globali per gestione DataGrid
function datatableRegisterGlobalFunctions(gridId, gridObj) {
    
    // Iniziaizza stato grid
    store.dispatch(dataGridInit(gridId, gridObj));

    // Selezione elemento
    window.dataGridHandleRowSelect = function(event, data) {
        store.dispatch(dataGridHandleRowSelect(gridId, data));
    }
    
    // Deselezione elemento
    window.dataGridHandleRowUnselect = function(event, data) {
        store.dispatch(dataGridHandleRowUnselect(gridId, data));
    }
}

if(!xtag.tags['cd-datatable-wrapper']) {
    xtag.register('cd-datatable-wrapper', {
        accessors: {
            id: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                let element = $(this),
                    grid = element.children().eq(0).get(0),
                    childId = grid.id,
                    gridObj = $('#' + childId);

                // Registra funzioni globali per gestione DataGrid    
                datatableRegisterGlobalFunctions(childId, gridObj);

                // Registra eventi                 
                gridObj.attr('onrowselect', 'dataGridHandleRowSelect');
                gridObj.attr('onrowunselect', 'dataGridHandleRowUnselect');
            }
        }
    });
}