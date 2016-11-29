### Configurazioni applicazione ###

Occorre impostare la seguente chiave: 

> $config['base_url'] = "http://....."


----------

### Configurazioni modulo cidev ###

#### Cache ####

Esempio impostazione cache su APC:

> $config['cidev_cache'] = array('adapter' => 'apc', 'backup' =>
> 'file');

#### CORS ####

Esempio di abilitazione CORS:

> $config['cidev_cors'] = array(
>     'headers' => array(
>         'Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding',
>         'Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'
>     ) );

#### UUID ####

E' possibile generare UUID v3, v4 e v5.
Esempio di utilizzo v4:

> $config['cidev_uuid'] = array(
>     'version' => 'v4',
>     'name' => '',
>     'namespace' => '' );

#### System Administrator ####

Occorre definire la password dell'utente Sysadmin per l'accesso alla console di amministrazione:

> $config['cidev_sysadmin'] = array(
>     'sysadmin_password' => 'sys' );
