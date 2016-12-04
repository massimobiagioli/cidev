import BaseReducerReactor from './BaseReducerReactor'

/**
 * Inizializza stato grid
 */
export default class extends BaseReducerReactor {

    constructor() {
        super();
    }

    doAction(state, action) {
        let newState = state;
        
        if (newState.grids === undefined) {
            newState.grids = {};
        }
        
        newState.grids[action.gridId] = {
            selectionMode: action.selectionMode,
            selectedRows: []
        };

        return newState;
    }

}