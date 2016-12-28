import BaseClientOperationProcessor from './BaseClientOperationProcessor'

/**
 * Chiude dialog
 */
export default class extends BaseClientOperationProcessor {

    constructor() {
        super();
    }

    process(operation) {
        super.process(operation);
        let dialogId = 'dlg_' + operation.sender;
        $('#' + dialogId).remove();
    }

}