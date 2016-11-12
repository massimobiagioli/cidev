<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <?=$includes?>
    <style>
        .container {
            width: 750px;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .form-signin-heading {
            margin-bottom: 10px;
            font-size: 24px;
        }
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0,0,0,0);
            border: 0;
        }
        .form-control {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>    
    <div class="container">
        <form class="form-signin" method="POST" action="<?php echo admin_form_action_login(); ?>"
            <div class="form-control" align="center">
                <h2 class="form-signin-heading ui-widget">Backend Login</h2>
            </div>
            
            <div class="form-control" align="center">
                <label for="username" class="sr-only">Username</label>
                <input type="text" is="p-inputtext" name="username" value="" placeholder="Username" width="30" required autofocus/>
            </div>
          
            <div class="form-control" align="center">
                <label for="password" class="sr-only">Password</label>
                <input type="password" is="p-password" name="password" placeholder="Password" width="30" required />
            </div>
            
            <div id="hidden_fields">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            </div>  
              
            <div class="form-control" align="center">
                <button is="p-button" type="submit">Login</button>
            </div>                
        </form>
    </div>
</body>
</html>