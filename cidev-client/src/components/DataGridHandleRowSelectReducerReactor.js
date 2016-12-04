import BaseReducerReactor from './BaseReducerReactor'

/**
 * Selezione row
 */
export default class extends BaseReducerReactor {

    constructor() {
        super();
    }

    doAction(state, action) {
        let newState = state;
        
        newState.grids[action.gridId].selectedRows.push(action.data);
        console.log("state: " + JSON.stringify(newState));
        return newState;
    }

}