import BaseReducerReactor from './BaseReducerReactor'
import _ from 'underscore'

/**
 * Selezione row
 */
export default class extends BaseReducerReactor {

    constructor() {
        super();
    }

    doAction(state, action) {
        let newState = state;
        
        // Se la grid è impostata in selezione singola, azzera l'array delle righe selezionate
        if (newState.grids[action.gridId].selectionMode === 'single') {
            newState.grids[action.gridId].selectedRows = [];    
        }
        
        // Aggiunge la riga all'insieme delle righe selezionate, se non presente
        if (!(_.contains(newState.grids[action.gridId].selectedRows, action.data))) {
            newState.grids[action.gridId].selectedRows.push(action.data);
        }
        
        return newState;
    }

}