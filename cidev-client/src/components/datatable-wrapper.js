import { serverManager } from '../core/serverManager'
import { store } from '../core/stateManager'
import { dataGridInit, dataGridHandleRowSelect, dataGridHandleRowUnselect } from '../core/actions/DataGridActions.js'  

// Registra funzioni globali per gestione DataGrid
function datatableRegisterGlobalFunctions(gridId, gridObj, datasource, queryLimit) {
    
    // Iniziaizza stato grid
    store.dispatch(dataGridInit(gridId, gridObj));

    // Caricamento
    window.dataGridLoad = function(callback, ui) {
        console.log(JSON.stringify(ui));

        // Prepara QueryData per caricamento
        // TODO: completare filtri e ordinamenti
        let queryData = {
            filters: [],
            sort: [],
            limit: queryLimit,
            offset: (ui.first > 0 ? ui.first - 1 : 0) 
        };

        // Effettua chiamata a server per caricamento blocco dati
        $.ajax({
            type: "GET",
            url: datasource + btoa(JSON.stringify(queryData)),
            dataType: "json",
            context: this,
            success: function(response) {
                callback.call(this, response);
            }
        });
    }

    // Selezione elemento
    window.dataGridHandleRowSelect = function(event, data) {
        store.dispatch(dataGridHandleRowSelect(gridId, data));
    }
    
    // Deselezione elemento
    window.dataGridHandleRowUnselect = function(event, data) {
        store.dispatch(dataGridHandleRowUnselect(gridId, data));
    }
}

function getTotalRecords(counturl) {
    let queryData = {
        filters: [],
        sort: [],
        limit: 0,
        offset: 0 
    };

    return $.ajax({
        type: "GET",
        url: counturl + btoa(JSON.stringify(queryData)),
        dataType: "json",
        context: this
    });
}

if(!xtag.tags['cd-datatable-wrapper']) {
    xtag.register('cd-datatable-wrapper', {
        accessors: {
            id: {
                attribute: {}
            },
            queryurl: {
                attribute: {}
            },
            counturl: {
                attribute: {}
            },
            querylimit: {
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
                datatableRegisterGlobalFunctions(childId, gridObj, this.queryurl, this.querylimit);

                // Registra attributi
                if (this.counturl) {
                    getTotalRecords(this.counturl)
                    .then((value) => {
                        gridObj.attr('totalrecords', value.RC);
                    }, (err) => {
                        console.error(err);
                    });                    
                }
                if (this.queryurl) {
                    gridObj.attr('datasource', 'dataGridLoad');
                }
                if (this.querylimit) {
                    gridObj.attr('rows', this.querylimit);                 
                }
                gridObj.attr('onrowselect', 'dataGridHandleRowSelect');
                gridObj.attr('onrowunselect', 'dataGridHandleRowUnselect');
            }
        }
    });
}