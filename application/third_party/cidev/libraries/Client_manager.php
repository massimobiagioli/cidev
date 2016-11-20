<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_manager {
    
    public function set_div_content($sender, $target, $content) {
        $data = [
            'sender' => $sender,
            'client_operations' => [
                [
                    'type' => 'set_div_content',
                    'params' => [
                        'target' => $target,
                        'content' => $content
                    ]
                ]
            ]
        ];
        echo json_encode($data);
    }
    
}