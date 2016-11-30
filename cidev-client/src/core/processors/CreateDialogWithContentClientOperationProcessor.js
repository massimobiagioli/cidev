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
        let divWrapper = $('<div></div>');
        let dialogId = 'dlg_' + operation.sender;

        // Costruisce div wrapper
        divWrapper.attr('id', dialogId);
        divWrapper.attr('title', operation.params.title);
        divWrapper.html(operation.params.content);
        
        // Aggiunge div a body
        $('#' + dialogId).remove();
        $('body').append(divWrapper);

        // Effettua il render della dialog
        $('#' + dialogId).puidialog({
            showEffect: operation.params.showEffect || '',
            hideEffect: operation.params.hideEffect || '',
            minimizable: operation.params.minimizable || true,
            maximizable: operation.params.maximizable || true,
            responsive: operation.params.responsive || true,
            minWidth: operation.params.minWidth || 200,
            modal: operation.params.modal || true
        }).puidialog('show');
    }

}