/**
 * Codeigniter Server Manager
 */
class ServerManager {

    /**
     * Invoca azione di un controller
     * @param url Modulo/Controller/Azione/Parametri
     */
    invokeActionController(url) {
        $.ajax({
            type: "POST",
            url: url,
            success: function(data) {
                console.log(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
            }
        });
    }

}

export let serverManager = new ServerManager();