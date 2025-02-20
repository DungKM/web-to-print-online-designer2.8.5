<?php if(nbdesigner_get_option( 'nbdesigner_attachment_show_upload_color' , 'no') == 'yes') : ?>
<div class="<?php if( $nbav_active_tabs['active_background'] ) echo 'active'; ?> tab nbd-onload" id="tab-background" data-container="#tab-background" nbd-scroll="scrollLoadMore(container, type)" data-type="background" data-offset="20">
    <div class="tab-main tab-scroll">
        <?php if(nbdesigner_get_option( 'nbdesigner_show_type_background' , 'no') == 'yes') : ?>
        <div class="inner-tab-layer">
            <spectrum-colorpicker
                ng-model="colorBackground" 
                ng-change="changeBackgroundColor(colorBackground)" 
                nb-dragstart="changeBackgroundColor(colorBackground)"
                options="{
                    allowEmpty: true,
                    showPaletteOnly: false, 
                    flat: true,
                    clickoutFiresChange: true,
                    togglePaletteOnly: false, 
                    showInitial: false,
                    showPalette: true, 
                    showSelectionPalette: false,
                    showButtons: false,
                    showAlpha: true,
                    preferredFormat: 'hex3',
                    palette: [
                        ['#000','#444','#666','#999','#ccc','#eee','#f3f3f3','#fff'],
                        ['#f00','#f90','#ff0','#0f0','#0ff','#00f','#90f','#f0f'],
                        ['#f4cccc','#fce5cd','#fff2cc','#d9ead3','#d0e0e3','#cfe2f3','#d9d2e9','#ead1dc'],
                        ['#ea9999','#f9cb9c','#ffe599','#b6d7a8','#a2c4c9','#9fc5e8','#b4a7d6','#d5a6bd'],
                        ['#e06666','#f6b26b','#ffd966','#93c47d','#76a5af','#6fa8dc','#8e7cc3','#c27ba0'],
                        ['#c00','#e69138','#f1c232','#6aa84f','#45818e','#3d85c6','#674ea7','#a64d79'],
                        ['#900','#b45f06','#bf9000','#38761d','#134f5c','#0b5394','#351c75','#741b47'],
                        ['#600','#783f04','#7f6000','#274e13','#0c343d','#073763','#20124d','#4c1130']
                        ],
                    showInput: true}">
            </spectrum-colorpicker>
        </div>
        <?php endif; ?>
        
        <div class="nbd-search">
                <input type="text" name="search" placeholder="<?php _e('Search Background', 'web-to-print-online-designer'); ?>" ng-model="resource.background.filter.search"/>
                <i class="icon-nbd icon-nbd-fomat-search"></i>
        </div>
        <div class="backgrounds-category" ng-class="resource.background.data.cat.length > 0 ? '' : 'nbd-hiden'">           
                <div class="nbd-button nbd-dropdown">
                    <span>{{resource.background.filter.currentCat.name}}</span>
                    <i class="icon-nbd icon-nbd-chevron-right rotate90"></i>
                    <div class="nbd-sub-dropdown" data-pos="center">
                        <ul class="nbd-perfect-scroll">
                            <li ng-click="changeCat('background', cat)" ng-repeat="cat in resource.background.data.cat"><span>{{cat.name}}</span><span>{{cat.amount}}</span></li>
                        </ul>
                    </div>
                </div>
        </div>
        <div class="nbd-items">
            <div class="nbd-title-item"><?php esc_html_e('Current background','web-to-print-online-designer'); ?></div>
            <img class="current_background" ng-src="{{stages[currentStage].canvas.backgroundImage.getSrc()}}" alt="">
            <label nbd-upload-bg=uploadBackgroundImage(files) class="nbd-button upload-background"><?php esc_html_e('upload background image','web-to-print-online-designer'); ?><input type="file" style="display:none"></label>
            <button class="btn btn-range" ng-click="removeBgRera();"><?php esc_html_e('Remove current background','web-to-print-online-designer'); ?></button>
        </div>
        <div class="nbd-items colors-items">
            <ul class="main-color-palette nbd-perfect-scroll" >
                <li class="color-palette-add" ng-init="showbgPalette = false" ng-click="showbgPalette = !showbgPalette;" ng-style="{'background-color': backgroundColor}"></li>
                <li ng-repeat="color in listBackgroundColor track by $index" class="color-palette-item" ng-click="changeBackgroundColor(color)" data-color="{{color}}" title="{{color}}" ng-style="{'background-color': color}"></li>
            </ul>
            <div class="nbd-text-color-picker" id="nbd-bg-color-palette" ng-class="showbgPalette ? 'active' : ''" >
                <spectrum-colorpicker
                    ng-model="backgroundColor"
                    options="{
                            preferredFormat: 'hex',
                            color: '#3e4653',
                            flat: true,
                            showButtons: false,
                            showInput: true,
                            containerClassName: 'nbd-sp'
                    }">
                </spectrum-colorpicker>
                <div style="text-align: <?php echo (is_rtl()) ? 'right' : 'left'?>">
                    <button class="nbd-button" ng-click="addColorBackground();changeBackgroundColor(backgroundColor);showbgPalette = false;"><?php esc_html_e('Choose','web-to-print-online-designer'); ?></button>
                </div>
            </div>
        </div>
      
        <div class="nbd-items-dropdown" style="padding:10px;">
            <div>
            <div class="background-wrap">
                    <div class="background-item" nbd-drag="background.url" extenal="false" type="svg"  ng-repeat="background in resource.background.filteredBackgrounds | limitTo: resource.background.filter.currentPage * resource.background.filter.perPage" repeat-end="onEndRepeat('background')" >
                            <img ondragstart="dragStart(event)" ng-src="{{background.url}}" ng-click="addBackgrounds(background, true, true)" alt="{{background.name}}" >
                    </div>
            </div>
            <div class="loading-photo" style="width: 40px; height: 40px;">
                    <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                    </svg>
            </div>
            <div class="tab-load-more" style="display: none;" ng-show="!resource.background.onload && resource.background.filteredBackgrounds.length && resource.background.filter.currentPage * resource.background.filter.perPage < resource.background.filter.total">
                    <a class="nbd-button" ng-click="scrollLoadMore('#tab-background', 'background')"><?php _e('Load more','web-to-print-online-designer');?></a>
            </div>
            </div>
        </div>
    </div>         
</div>
<style type="text/css">
    .sp-container{background-color: unset;border: none; width: auto;}
    .sp-picker-container{border:none;clear: both;}
    #tab-background .sp-container .sp-palette-container{width: 90%;border: none;}
    #nav-background #background-icon{fill:#fff;}
    #nav-background.active #background-icon{fill:#404762;}
    .nbd-workspace .tabs-content.mobile{height: 190px !important}
    .nbd-workspace .main.mobile{z-index: 111111}
    .nbd-workspace .tabs-content.mobile #tab-background .sp-container .sp-palette-container{display: none;}
    .nbd-sidebar #tab-background .tab-main{height:calc(100% - 20px);}
    .nbd-sidebar #tab-background .nbd-items-dropdown span{font-size:12px;color:#404762}
    .nbd-sidebar #tab-background .nbd-items-dropdown .info-support span{font-size:16px}
    .nbd-sidebar #tab-background .nbd-items-dropdown .main-items{position:relative}
    .nbd-sidebar #tab-background .nbd-items-dropdown .main-items .items .item{width:33.33%}
    .nbd-sidebar #tab-background .nbd-items-dropdown .main-items .items .item .main-item{border-radius:2px;cursor:pointer;-webkit-transition:-webkit-box-shadow .3s;transition:-webkit-box-shadow .3s;transition:box-shadow .3s;transition:box-shadow .3s,-webkit-box-shadow .3s;border:none}
    .nbd-sidebar #tab-background .nbd-items-dropdown .main-items .items .item .main-item:hover .item-svg{-webkit-box-shadow:1px 0 10px rgba(0,0,0,.1);box-shadow:1px 0 10px rgba(0,0,0,.1)}
    .nbd-sidebar #tab-background .nbd-items-dropdown .main-items .items .item .main-item .item-svg{background:#fff;padding:20px;border-radius:2px}
    .nbd-sidebar #tab-background .nbd-items-dropdown .main-items .items .item .main-item .item-svg svg{width:40px}
    .nbd-sidebar #tab-background .nbd-items-dropdown .main-items .items .item .main-item .item-info{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;padding:5px}
    .nbd-sidebar #tab-background .nbd-items-dropdown .result-loaded{margin-top:0}
    .nbd-sidebar #tab-background .nbd-items-dropdown .result-loaded .nbdesigner-gallery .nbdesigner-item{width:33.33%}
    .nbd-sidebar #tab-background .backgrounds-category{padding:0 10px;display: flex;}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button{width:100%;margin:0;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-ms-flex-align:center;align-items:center;overflow:unset;font-size:12px;text-transform:capitalize;}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button .nbd-sub-dropdown{width:100%;top:calc(100% + 5px)}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button .nbd-sub-dropdown:after,.nbd-sidebar #tab-background .backgrounds-category .nbd-button .nbd-sub-dropdown:before{display:none}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button ul{min-width:220px;max-height:250px;margin:10px 0}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button ul li{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-ms-flex-align:center;align-items:center;padding:0 20px}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button ul li span{color:#404762;text-transform:capitalize}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button ul li:hover{background-color:hsla(0,0%,62%,.2)}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button i,.nbd-sidebar #tab-background .backgrounds-category .nbd-button span{color:#fff}
    .nbd-sidebar #tab-background .backgrounds-category .nbd-button i{font-size:24px}
    .nbd-sidebar #tab-background .nbd-search {position: relative;left:0;}
    /*style.min.css*/
    .nbdesigner_background_modal_header {
    text-align: center;
    padding-bottom: 5px
}
.nbdesigner_background_modal_header > span {
    font-weight: 700;
    float: left;
    margin-top: 5px
}
.nbdesigner_background_modal_header input {
    display: inline-block;
    max-width: 200px;
    height: 30px;
    border-radius: 0
}
.nbdesigner_background_modal_header button.dropdown-toggle,
.nbdesigner_background_modal_header button.dropdown-toggle:focus {
    height: 30px;
    border-radius: 0;
    background: #394264;
    border: none
}
.nbdesigner_background_modal_header .open button.dropdown-toggle {
    background: #394264
}
.nbdesigner_background_modal_header ul.dropdown-menu {
    border-radius: 0;
    border: none;
    margin-top: 5px;
    text-align: left
}
.nbdesigner_background_modal_header ul.dropdown-menu li a:hover {
    background: #394264
}
#nbdesigner_background_container {
    max-height: 350px;
    position: relative;
    overflow: hidden
}
@media screen and (-ms-high-contrast: active),
(-ms-high-contrast: none) {
    #nbdesigner_background_container .nbdesigner_thumb {
        max-width: 100px;
        margin-left: 10px;
        margin-bottom: 10px;
        width: 100px;
        height: 100px
    }
    #nbdesigner_background_container .nbdesigner_upload_image {
        max-width: 100px;
        max-height: 100px;
        height: auto
    }
}
@media (max-width: 767px) {
    #nbdesigner_background_container {
        max-height: 300px
    }
    .nbdesigner_background_modal_header input {
        margin-bottom: 10px
    }
    .nbdesigner_background_modal_header .btn-group {
        vertical-align: top
    }
}
.nbd-sidebar #tab-background .nbd-items{
    padding: 13px 10px;
}
.nbd-sidebar #tab-background .nbd-items .nbd-title-item{
    text-align: left;
}
.nbd-sidebar #tab-background .nbd-items .current_background{
    width: 100px;
    height: 100px;
}
.nbd-button.upload-background{
    background: #7dadf8;
    display: block;
    font-weight: 600;
    font-size: 11px;
}
.nbd-button.upload-background.highlight{
    box-shadow: 1px 1px 6px 2px #888888;
}
.nbd-text-color-picker.active{
    z-index: 9;
}
.nbd-sidebar #tab-background .nbd-items.colors-items{
    position: relative;
}
.nbd-sidebar #tab-background .nbd-items.colors-items ul li.color-palette-add{
    border: 2px solid #fff;
}
.nbd-sidebar #tab-background .nbd-items.colors-items ul li.color-palette-add:after{
    top: -2px;
    left: -2px;
    color : #fff;
    text-shadow: none;
    
}
.nbd-sidebar #tab-background .nbd-items.colors-items ul li{
    margin-right: 5px;
    margin-bottom: 5px;
}
    <?php if(is_rtl()):?>
        /*nbdesigner-rtl.css*/
        .nbdesigner_background_modal_header > span {
            float: right;
        }
    <?php endif; ?>
    /*modern-additional.css*/
    .background-wrap .background-item {
        visibility: visible !important; 
        width: 33.33%;
        padding: 2px;
        opacity: 0;
        z-index: 3;
        cursor: pointer;
    }
    .background-wrap .background-item.in-view {
        opacity: 1;
    }
    .mansory-wrap .mansory-item
    .nbd-sidebar #tab-background .backgrounds-category {
        margin-top: 70px;
        padding: 0px 10px 10px;        
    }

</style>

<script type="text/javascript">
    function dragStart(event) {
        event.preventDefault();
    }
</script>

<?php endif; ?>