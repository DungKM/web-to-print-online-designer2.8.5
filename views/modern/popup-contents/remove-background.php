<div class="nbd-popup popup-nbd-bg-remove" data-animate="bottom-to-top">
    <div class="overlay-popup"></div>
    <div class="main-popup">
        
        <div class="head">
            <h2><?php esc_html_e('Remove background','web-to-print-online-designer'); ?></h2>
        </div>
        <div class="body">
            <div class="main-body">
                <div class="main-body-inner">
                    <img id="crop-source" ng-if="bgRemoveObj.status" ng-src="{{bgRemoveObj.src}}" />
                </div>
            
            </div>
        </div>
        <div class="footer">
            <button ng-click="removeBackground()" class="nbd-button"><?php esc_html_e('Remove background','web-to-print-online-designer'); ?> <i class="icon-nbd icon-nbd-fomat-done"></i></button>
        </div>
    </div>
</div>

