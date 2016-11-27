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
        console.log("open dialog ...");
        let divWrapper = $('<div></div>');
        let dialogId = 'dlg_' + operation.sender;

        divWrapper.attr('id', dialogId);
        divWrapper.append(operation.params.content);
        
        $('body').append(divWrapper);
        $('#' + dialogId).puidialog();
    }

}