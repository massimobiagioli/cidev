import BaseReducerReactor from './BaseReducerReactor'

/**
 * Deselezione row
 */
export default class extends BaseReducerReactor {

    constructor() {
        super();
    }

    doAction(state, action) {
        console.log("action: " + JSON.stringify(action));
    }

}