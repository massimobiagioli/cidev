import BaseClientOperationProcessor from './BaseClientOperationProcessor'
import { store } from '../stateManager'
import { dataGridInit } from '../actions/DataGridActions.js'  

/**
 * Impostazione contenuto di un div
 */
export default class extends BaseClientOperationProcessor {

    constructor() {
        super();
    }

    process(operation) {
        super.process(operation);
        
        let gridId = operation.params.target,
            gridObj = $('#' + gridId);

        /* Bugfix: dopo la chiamata a reload(), vengono duplicati header, filtri  e paginator */
        $('#' + gridId + ' > div > div.ui-datatable-header').remove();
        $('#' + gridId + ' > div > div.ui-datatable-tablewrapper > table > thead > tr.ui-state-default').remove();
        $('#' + gridId + ' > div > div.ui-paginator').remove();
        
        // Ricarica datatable
        document.getElementById(gridId).reload();

        // Reset state
        store.dispatch(dataGridInit(gridId, gridObj));
    }

}