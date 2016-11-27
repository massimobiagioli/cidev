import BaseClientOperationProcessor from './BaseClientOperationProcessor'

/**
 * Impostazione contenuto di un div
 */
export default class extends BaseClientOperationProcessor {

    constructor() {
        super();
    }

    process(operation) {
        super.process(operation);
        console.log('sender: ' + operation.sender + ' - messsage: ' + operation.params.msg);
    }

}