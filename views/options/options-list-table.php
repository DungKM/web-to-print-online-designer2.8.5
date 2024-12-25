<?php 
    if (!defined('ABSPATH')) exit; 
    global $wpdb;
    $table_name = $wpdb->prefix . 'nbdesigner_options';
    $total_options = $wpdb->get_var("SELECT COUNT(*) FROM {$table_name}");
    if ($total_options >= 5) {

        echo '<div class="notice notice-error"><p>';
        _e('You have reached the limit of 5 options. Please recharge your account to add more options.', 'web-to-print-online-designer');
        echo '</p></div>';
    } else {
    $link_create_option = add_query_arg(array(
            'action'    => 'edit',
            'paged'     => 1,
            'id'        => 0
        ),
        admin_url('admin.php?page=nbd_printing_options'));
        
    }
?>
<div class="wrap">
    <h1>
        <?php _e('Printing options', 'web-to-print-online-designer'); ?>
        <a class="nbd-page-title-action" href="<?php echo $link_create_option; ?>"><?php _e('Add new', 'web-to-print-online-designer'); ?></a>
    </h1>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder">
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <form method="post">
                    <?php
                        $nbd_options->prepare_items();
                        $nbd_options->display();
                    ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
</div>