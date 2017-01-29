import { serverManager } from '../core/serverManager'
import { store } from '../core/stateManager'
import { dataGridInit, dataGridHandleRowSelect, dataGridHandleRowUnselect } from '../core/actions/DataGridActions.js'  

// Registra funzioni globali per gestione DataGrid
function datatableRegisterGlobalFunctions(gridId, gridObj, baseurl, queryLimit) {
    
    // Iniziaizza stato grid
    store.dispatch(dataGridInit(gridId, gridObj));

    // Caricamento
    window.dataGridLoad = function(callback, ui) {
        //console.log(JSON.stringify(ui));

        // Prepara QueryData per caricamento
        // TODO: completare filtri e ordinamenti
        let queryData = {
            filters: [],
            sort: [],
            limit: queryLimit,
            offset: (ui.first > 0 ? ui.first : 0) 
        };

        // Effettua chiamata a server per caricamento blocco dati
        $.ajax({
            type: "GET",
            url: baseurl + '/query/' + btoa(JSON.stringify(queryData)),
            dataType: "json",
            context: this,
            success: function(response) {
                callback.call(this, response);
            }
        });
       
        // Reimposta il numero totale di record
        if (!gridObj.firstload) {
            // TODO richiamare la count
            gridObj.puidatatable('setTotalRecords', 20);
        } else {
            gridObj.firstload = false;
        }
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

// Conta numero dei record in modo da impostare correttamente il paginatore
function getTotalRecords(baseurl, filters = []) {
    let queryData = {
        filters: filters,
        sort: [],
        limit: 0,
        offset: 0 
    };

    return $.ajax({
        type: "GET",
        url: baseurl + '/count_query/' + btoa(JSON.stringify(queryData)),
        dataType: "json",
        context: this
    });
}

if(!xtag.tags['cd-datatable-crud']) {
    xtag.register('cd-datatable-crud', {
        accessors: {
            id: {
                attribute: {}
            },
            querylimit: {
                attribute: {}
            },
            baseurl: {
                attribute: {}
            },
            caption: {
                attribute: {}
            },
            selectionmode: {
                attribute: {}
            },
            emptymessage: {
                attribute: {}
            }
        },
        lifecycle: {
            created: function() {
                let element = $(this),
                    divWrapper = $('<div></div>'),
                    gridId = this.id || 'grid',
                    gridObj = $('#' + gridId),
                    limit = this.querylimit || 10;

                // Precondizioni
                if (!this.baseurl) {
                    console.err("Parametro base_url non specificato!");
                    return;
                }

                // Registra funzioni globali per gestione DataGrid    
                gridObj.firstload = true;
                datatableRegisterGlobalFunctions(this.id, gridObj, this.baseurl, limit);

                // Div Wrapper
                divWrapper.attr('id', gridId);    
                this.xtag.container = divWrapper.appendTo(this);

                // Ricava numero totale record
                getTotalRecords(this.baseurl)
                .then((value) => {
                    
                    // Render DataTable
                    // TODO: impostare columns
                    gridObj.puidatatable({
                        lazy: true,
                        caption: this.caption || gridId,
                        selectionMode: this.selectionmode || 'single',
                        emptyMessage: this.emptymessage || 'No records selected',
                        paginator: {
                            rows: limit,
                            totalRecords: value.RC
                        },
                        columns: [
                            {field: 'sog_id', headerText: 'ID', filter: true, sortable: true},
                            {field: 'sog_nominativo', headerText: 'Nominativo', filter: true, sortable: true},
                            {field: 'sog_indirizzo', headerText: 'Indirizzo', filter: true, sortable: true},
                        ],
                        datasource: window.dataGridLoad,
                        onrowselect: dataGridHandleRowSelect,
                        onrowunselect: dataGridHandleRowUnselect
                    });
                }, (err) => {
                    console.error(err);
                });                                    
            }
        }
    });
}