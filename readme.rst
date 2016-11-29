====================================
Configurazioni applicazione
====================================

Occorre impostare la seguente chiave: 

.. code-block::

  $config['base_url'] = "http://....."

====================================
Configurazioni modulo cidev
====================================

***************
Cache
***************

Esempio impostazione cache su APC:

.. code-block::

  $config['cidev_cache'] = array('adapter' => 'apc', 'backup' => 'file');

***************
CORS
***************

Esempio di abilitazione CORS:

.. code-block::

  $config['cidev_cors'] = array(
      'headers' => array(
          'Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding',
          'Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'
      )
  );

***************
UUID
***************

E' possibile generare UUID v3, v4 e v5.
Esempio di utilizzo v4:

.. code-block::

  $config['cidev_uuid'] = array(
      'version' => 'v4',
      'name' => '',
      'namespace' => ''
  );

******************************
System Administrator
******************************

Occorre definire la password dell'utente Sysadmin per l'accesso alla console di amministrazione:

.. code-block::

  $config['cidev_sysadmin'] = array(
      'sysadmin_password' => 'sys'
  );
