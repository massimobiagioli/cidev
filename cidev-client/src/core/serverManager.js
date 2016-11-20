/**
 * Codeigniter Server Manager
 */
class ServerManager {

    /**
     * Invoca azione di un controller
     * @param url Modulo/Controller/Azione/Parametri
     * @param onSuccessCallback Funzione di callback da richiamare in caso di esito positivo
     * @param onErrorCallback Funzione di callback da richiamare in caso di errore
     */
    invokeActionController(url, onSuccessCallback, onErrorCallback) {
        $.ajax({
            type: "POST",
            url: url,
            success: onSuccessCallback,
            error: onErrorCallback
        });
    }

}

export let serverManager = new ServerManager();