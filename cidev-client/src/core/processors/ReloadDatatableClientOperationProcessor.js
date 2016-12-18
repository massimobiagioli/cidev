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
        $('#' + gridId + ' > div').remove();
        
        // Ricarica datatable
        document.getElementById(gridId).reload();

        // Reset state
        store.dispatch(dataGridInit(gridId, gridObj));
    }

}