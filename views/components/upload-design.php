<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<div class="form-group">
    <h2><?php esc_html_e('Upload design', 'web-to-print-online-designer'); ?></h2>
    <?php 
        $login_required = (nbdesigner_get_option('nbdesigner_upload_file_php_logged_in') !== 'no' && !is_user_logged_in()) ? 1 : 0;
        if($login_required):
        if( $ui_mode == 1 ){
            $site_url = site_url();
            if ( class_exists('SitePress') ) {
                $site_url = home_url();
            }  
            $current_url = add_query_arg(array('action' => 'nbdesigner_editor_html', 'product_id' => $product_id), $site_url . '/');
        }else{
            $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        };
        $redirect = getUrlPageNBD('redirect');
        $login_url = get_permalink( get_option('woocommerce_myaccount_page_id') ).'?nbu_redirect=';
    ?>
    <p><?php esc_html_e('You need to be logged in to upload images!', 'web-to-print-online-designer'); ?></p> 
<!--    <a class="btn btn-primary shadow nbdesigner_upload ng-binding" href="<?php //echo wp_login_url( $redirect ); ?>">{{(langs['LOGIN']) ? langs['LOGIN'] : "Login"}}</a>-->
    <a class="btn btn-primary shadow nbdesigner_upload ng-binding" data-current-url="<?php echo $current_url; ?>" data-ui_mode="<?php echo $ui_mode; ?>" onclick="showPopupLogin(event, this)" data-url-ridirect="<?php echo $redirect; ?>" data-url-login="<?php echo $login_url; ?>" href="#"><?php esc_html_e('Login', 'web-to-print-online-designer'); ?></a>
    <?php else: ?>
    <p>
        <input type="file" id="nbd-file-upload" autocomplete="off" ng-file-select="onFileUploadSelect($files)" class="inputfile"/> 
        <label for="nbd-file-upload">
            <span></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"> 
                </path>
            </svg>
            <span><?php esc_html_e('Choose a file to upload', 'web-to-print-online-designer'); ?></span>
        </label>
        <span id="nbd-upload-note" style="cursor: pointer;color: #cc324b;" class="first_time_in_hour fa fa-info-circle nbd-tooltip-<?php if( wp_is_mobile() ) echo 'top'; else echo 'right'; ?>" data-tooltip-content="#tooltip_upload_rule"></span>
    </p>      
    <div style="display: none;">
        <div id="tooltip_upload_rule" style="color: #394264; font-size: 12px;">
            <p ng-if="undefined !== uploadSetting.allow_type && uploadSetting.allow_type != ''"><?php esc_html_e('Allow extensions', 'web-to-print-online-designer'); ?>: <b>{{formatListString( uploadSetting.allow_type )}}</b></p>
            <p ng-if="undefined !== uploadSetting.disallow_type && uploadSetting.disallow_type != ''"><?php esc_html_e('Disallow extensions', 'web-to-print-online-designer'); ?>: <b>{{formatListString( uploadSetting.disallow_type )}}</b></p>
            <p><?php esc_html_e('Min size', 'web-to-print-online-designer'); ?>: <b>{{uploadSetting.minsize}} MB</b></p>
            <p><?php esc_html_e('Max size', 'web-to-print-online-designer'); ?>: <b>{{uploadSetting.maxsize}} MB</b></p>
        </div>
    </div>
    <p ng-if="fileUpload.length > 0" class="file-upload-name">{{fileUpload[0]['name']}}</p>
    <p ng-show="fileUpload.length > 0">
        <button class="btn btn-primary shadow nbdesigner_upload" ng-click="startUploadDesign()"><?php esc_html_e('Upload', 'web-to-print-online-designer'); ?></button>
    </p>
    <div class="progress progress-bar-container" ng-show="loading">
        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="{{progressUpload}}"
             aria-valuemin="0" aria-valuemax="100" ng-style="{'width': progressUpload + '%'}" >{{progressUpload}}%</div>
    </div>     
    <div class="upload-design-preview" id="upload-design-preview">
        <!-- show preview design -->
        <div ng-repeat="file in listFileUpload" class="nbd-upload-items">
            <div class="nbd-upload-items-inner">
                <img ng-src="{{file.src}}" class="shadow nbd-upload-item"/>
                <p class="nbd-upload-item-title">{{file.name}}</p>
                <span ng-click="deleteUploadfile($index)" class="shadow"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div ng-show="listFileUpload.length > 0">
        <span class="submit-upload-design" ng-click="completeUpload()"><?php esc_html_e('Complete', 'web-to-print-online-designer'); ?></span>
    </div>
    <p style="margin: 15px;" ng-hide="settings.task == 'reup' || settings.enable_upload_without_design == 2"><a ng-click="changeDesignMode('custom')"><?php esc_html_e('Or design your own', 'web-to-print-online-designer'); ?></a></p>
    <p style="font-size: 12px; opacity: 0.5; margin-top: 15px;" ng-hide="settings['ui_mode'] == 1"><a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><?php esc_html_e('Return to shop', 'web-to-print-online-designer'); ?></a></p>
    <?php endif; ?> 
</div>

