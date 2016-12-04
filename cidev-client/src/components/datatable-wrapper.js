import { serverManager } from '../core/serverManager'
import { appState } from '../core/stateManager'
import { dataGridInit, dataGridHandleRowSelect, dataGridHandleRowUnselect } from '../core/actions/DataGridActions.js'  

// Registra funzioni globali per gestione DataGrid
function datatableRegisterGlobalFunctions(gridId, gridObj) {
    
    // Iniziaizza stato grid
    appState.dispatch(dataGridInit(gridId, gridObj));

    // Selezione elemento
    window.dataGridHandleRowSelect = function(event, data) {
        appState.dispatch(dataGridHandleRowSelect(gridId, data));
    }
    
    // Deselezione elemento
    window.dataGridHandleRowUnselect = function(event, data) {
        appState.dispatch(dataGridHandleRowUnselect(gridId, data));
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
                var element = $(this),
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