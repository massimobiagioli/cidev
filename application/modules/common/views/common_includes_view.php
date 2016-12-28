<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
?>
<link rel="stylesheet" href="<?php echo assets_primeui_theme_css_url(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo assets_font_awesome_css_url(); ?>" />
<link rel="stylesheet" href="<?php echo assets_primeui_css_url(); ?>" />
<link rel="stylesheet" href="<?php echo assets_default_css_url(); ?>" />
<script type="text/javascript" src="<?php echo assets_jquery_url(); ?>"></script>
<script type="text/javascript" src="<?php echo assets_jqueryui_url(); ?>"></script>
<script type="text/javascript" src="<?php echo assets_primeui_url(); ?>"></script>
<script type="text/javascript" src="<?php echo assets_xtagcore_url(); ?>"></script>
<script type="text/javascript" src="<?php echo assets_primeelements_url(); ?>"></script>
<script type="text/javascript" src="<?php echo assets_jquery_validation_url(); ?>"></script>
<script type="text/javascript" src="<?php echo assets_jquery_validation_additional_methods_url(); ?>"></script>
<script type="text/javascript" src="<?php echo assets_cidev_client_js_url(); ?>"></script>

<!-- jQuery validation custom messages -->
<script>
jQuery.extend(jQuery.validator.messages, {
    required: "<?=$CI->lang->line('validation_required')?>",
    remote: "<?=$CI->lang->line('validation_remote')?>",
    email: "<?=$CI->lang->line('validation_email')?>",
    url: "<?=$CI->lang->line('validation_url')?>",
    date: "<?=$CI->lang->line('validation_date')?>",
    dateISO: "<?=$CI->lang->line('validation_dateISO')?>",
    number: "<?=$CI->lang->line('validation_number')?>",
    digits: "<?=$CI->lang->line('validation_digits')?>",
    creditcard: "<?=$CI->lang->line('validation_rcreditcard')?>",
    equalTo: "<?=$CI->lang->line('validation_equalTo')?>",
    accept: "<?=$CI->lang->line('validation_accept')?>",
    maxlength: jQuery.validator.format("<?=$CI->lang->line('validation_maxlength_format')?>"),
    minlength: jQuery.validator.format("<?=$CI->lang->line('validation_minlength_format')?>"),
    rangelength: jQuery.validator.format("<?=$CI->lang->line('validation_rangelength_format')?>"),
    range: jQuery.validator.format("<?=$CI->lang->line('validation_range_format')?>"),
    max: jQuery.validator.format("<?=$CI->lang->line('validation_max_format')?>"),
    min: jQuery.validator.format("<?=$CI->lang->line('validation_min_format')?>")
});
</script>

<?php 
if ($CI->config->item('csrf_protection')): 
?>
<script>
    $(function() {
        $.ajaxSetup({
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        });
    });
</script>
<?php endif; ?>
