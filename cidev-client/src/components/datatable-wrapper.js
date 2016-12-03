import { serverManager } from '../core/serverManager' 

// Registra funzioni globali per gestione DataGrid
function datatableRegisterGlobalFunctions(container) {
    
    // Selezione elemento
    window.dataGridHandleRowSelect = function(event, data) {
        console.log("dataGridHandleRowSelect fired");
    }
    
    // Deselezione elemento
    window.dataGridHandleRowUnselect = function(event, data) {
        console.log("dataGridHandleRowUnselect fired");
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
                datatableRegisterGlobalFunctions(element);

                // Inizializza array row selezionate
                this.selectedRows = [];
                
                // Registra eventi                 
                gridObj.attr('onrowselect', 'dataGridHandleRowSelect');
                gridObj.attr('onrowunselect', 'dataGridHandleRowUnselect');
            }
        }
    });
}