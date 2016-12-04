import { createStore } from 'redux';
import DataGridInitReducerReactor from './reducerReactors/DataGridInitReducerReactor'
import DataGridHandleRowSelectReducerReactor from './reducerReactors/DataGridHandleRowSelectReducerReactor'
import DataGridHandleRowUnselectReducerReactor from './reducerReactors/DataGridHandleRowUnselectReducerReactor'

// Definisce mappa dei reattori alle azioni
const reducerReactorMap = new Map();
reducerReactorMap.set('dataGridInit', new DataGridInitReducerReactor());
reducerReactorMap.set('dataGridHandleRowSelect', new DataGridHandleRowSelectReducerReactor());
reducerReactorMap.set('dataGridHandleRowUnselect', new DataGridHandleRowUnselectReducerReactor());

// Definizione reducer di default
function defaultReducer(state = {}, action) {
    if (reducerReactorMap.has(action.type)) {
        return reducerReactorMap.get(action.type).doAction(state, action);
    } else {
        console.error('Undefined operation: ' + action.type);
    }
}

// Creazione store
export const appState = createStore(defaultReducer);