import ChangeViewClientOperationProcessor from './processors/ChangeViewClientOperationProcessor'
import ConsoleLogClientOperationProcessor from './processors/ConsoleLogClientOperationProcessor'
import CreateDialogWithContentClientOperationProcessor from './processors/CreateDialogWithContentClientOperationProcessor'
import CloseDialogClientOperationProcessor from './processors/CloseDialogClientOperationProcessor'
import SetDivContentClientOperationProcessor from './processors/SetDivContentClientOperationProcessor'

/**
 * Codeigniter Server Manager
 */
class ServerManager {

    constructor() {
        this._initClientOperationProcessorMap();
    }

    /**
     * Invoca azione di un controller
     * @param url Modulo/Controller/Azione/Parametri
     */
    invokeActionController(url) {
        let $this = this; 
        $.ajax({
            type: "POST",
            url: url,
            success: function(data) {
                $this._handleActionControllerResponse(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
            }
        });
    }

    /**
     * Inizializza mappa delle classi per elaborazione operazioni client
     */
    _initClientOperationProcessorMap() {
        this.clientOperationProcessorMap = new Map();
        this.clientOperationProcessorMap.set('change_view', new ChangeViewClientOperationProcessor());
        this.clientOperationProcessorMap.set('console_log', new ConsoleLogClientOperationProcessor());
        this.clientOperationProcessorMap.set('create_dialog_with_content', new CreateDialogWithContentClientOperationProcessor());
        this.clientOperationProcessorMap.set('close_dialog', new CloseDialogClientOperationProcessor());
        this.clientOperationProcessorMap.set('set_div_content', new SetDivContentClientOperationProcessor());
    }

    /**
     * Gestione risposta azione controller
     * @param data Stringa in formato json della risposta
     */
    _handleActionControllerResponse(data) {
        let $this = this; 
        let jsonData = JSON.parse(data);
        if (!jsonData) {
            return;
        }

        // Elabora tutte le operazioni client
        jsonData.client_operations.forEach(function(operation) {
            if ($this.clientOperationProcessorMap.has(operation.type)) {
                $this.clientOperationProcessorMap.get(operation.type).process(operation);
            } else {
                console.error('Undefined operation: ' + operation.type);
            }
        });
    }

}

// Esporta singleton per gestione comunicazione con il server
export let serverManager = new ServerManager();