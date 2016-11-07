<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TEST API KEY</title>
    <script src="<?php echo assets_jquery_url(); ?>"></script>
    <script type="text/javascript">
    function send() {
        var apikey = $('#apikey').val(),
            tablekey = $('#tablekey').val();    
        $.ajax({
            method: 'GET',
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            url: "<?php echo base_url();?>api/tester/Soggetto/" + tablekey,
            headers: {
                "X-CI-API-TOKEN": "DUMMY_TOKEN"
            },
            success: function(data) {
                alert(JSON.stringify(data));
            },
            error: function(request, status, error) {
                alert("AJAX Error: " + request.responseText);
            }
        });
    }
    </script>
</head>
<body>
    <div>
        <span>TABLE KEY: </span>
        <input id="tablekey" type="text" value="0"/>
    </div>
    <div>
        <button id="send" onclick="send();">SEND</button>
    </div>
    <div>
        <input id="apikey" type="hidden" value="<?php echo $api_key; ?>"/>
    </div>
</body>
</html>