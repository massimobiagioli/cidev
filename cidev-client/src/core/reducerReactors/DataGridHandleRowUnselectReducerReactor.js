import BaseReducerReactor from './BaseReducerReactor'

/**
 * Deselezione row
 */
export default class extends BaseReducerReactor {

    constructor() {
        super();
    }

    doAction(state, action) {
        
        // Rimuove la riga all'insieme delle righe selezionate
        let newState = _.without(state.grids[action.gridId].selectedRows, action.data);
        
        return newState;
    }

}