<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div>
    <?=$message?>
    
    <hr>
    
    <!-- Buttons -->
    <div style="text-align: center">
        <cd-components-wrapper>
            <?php foreach ($buttons as $button): ?>
                <button is="p-button" 
                        id="<?=$button['id']?>"
                        data-clickhandler="<?=$button['clickhandler']?>"
                        <?php if (array_key_exists('info', $button)): ?>
                        data-info="<?=$button['info']?>"
                        <?php endif; ?>
                        ><?=$button['text']?></button>
            <?php endforeach; ?>   
        </cd-components-wrapper>
    </div>
    
</div>