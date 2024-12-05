/**
 * External dependencies
 */
import { registerPlugin } from '@wordpress/plugins';
import { registerCheckoutBlock } from '@woocommerce/blocks-checkout';
import { getRegisteredBlockComponents } from '@woocommerce/blocks-registry';
import { __ } from '@wordpress/i18n';
/**
 * Internal dependencies
 */
import { Block } from './block';
import metadata from './block.json';
const { registerBlockComponent } = window.wc.wcBlocksRegistry;
const { registerCheckoutFilters } = window.wc.blocksCheckout;

const modifyItemName = ( defaultValue, extensions, args ) => {
    console.log(args);
    var item = args.cartItem.extensions.online_design;
    var html = defaultValue;
    if(typeof item != 'undefined'){
        if(item.nbd_item_key){
            var image = ``;
            var t = Date.now();
            item.images.forEach(img => {
                image += `<img decoding="async" class="nbd_cart_item_design_preview" src="${img + '?t=' + t}">`;
            });
            html += `</a>
            <div id="nbd${item.cart_item_key}" class="nbd-custom-dsign nbd-cart-item-design" onclick="noLoadPage(event)">
                <p>Custom design
                    <a class="remove nbd-remove-design nbd-cart-item-remove-design" href="#" data-type="custom" data-cart-item="${item.cart_item_key}">×</a>
                </p>
                <div>
                    ${image}
                </div>
                <br>
                <a class="button nbd-edit-design" href="${item.edit_design}">${__('Edit design')}</a></div>
            <a>`;
        }
        if(item.nbu_item_key){
            var image = ``;
            var t = Date.now();
            item.images.forEach(img => {
                image += 
                `<div class="nbd-cart-item-upload-preview-wrap">
                    <a target="_blank" href="${img.file_url}">
                        <img decoding="async" class="nbd-cart-item-upload-preview" src="${img.src}">
                    </a>
                    <p class="nbd-cart-item-upload-preview-title">${img.name}</p>
                </div>`;
            });
            var edit_btn = item.edit_design ? `<a class="button nbd-reup-design" href="${item.edit_design}">${__('Reupload design')}</a>` : '';

            html += `<div id="nbu${item.cart_item_key}" class="nbd-cart-upload-file nbd-cart-item-upload-file" onclick="noLoadPage(event)">
                <p>Upload file<a class="remove nbd-cart-item-remove-file" href="#" data-type="upload" data-cart-item="${item.cart_item_key}">×</a></p>
                    ${image}
                <br>
                ${edit_btn}
                </div>`;
        }
    }
    
    return `${html}`;
};

registerCheckoutFilters( metadata, {
    itemName: modifyItemName
} );