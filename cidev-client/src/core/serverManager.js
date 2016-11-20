/**
 * Codeigniter Server Manager
 */
class ServerManager {

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
     * Gestione risposta azione controller
     * @param data Stringa in formato json della risposta
     */
    _handleActionControllerResponse(data) {
        let jsonData = JSON.parse(data);
        if (!jsonData) {
            return;
        }

        console.log(jsonData);
    }

}

export let serverManager = new ServerManager();