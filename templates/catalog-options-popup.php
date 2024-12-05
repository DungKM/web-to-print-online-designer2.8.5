<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="nbdp-popup" id="nbd-catalog-option-popup" data-animate="scale">
    <div class="overlay-popup"></div>
    <div class="main-popup">
        <div class="nbdp-popup-head">
            <i class="close-popup">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <title>close</title>
                    <path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
                </svg>
            </i>
        </div>
        <div class="nbdp-popup-body">
            <div class="nbco-options-header"><?php esc_html_e('How would you love to order?', 'web-to-print-online-designer'); ?></div>
            <div class="nbco-options-wrap">
                <div class="nbco-option nbco-option-upload">
                    <a class="nbco-option-upload-link">
                        <div class="nbco-option-icon">
                            <svg viewBox="0 0 49 30" width="100%" height="100%"><g stroke-width=".8" fill="none" fill-rule="evenodd"><path d="M39.793 8.384c.001-.053.004-.106.004-.16 0-2.56-2.061-4.637-4.603-4.637-1.226 0-2.339.485-3.164 1.273A13.124 13.124 0 0 0 22.726 1C16.135 1 10.672 5.86 9.673 12.217c-.055 0-.11-.004-.164-.004-4.7 0-8.509 3.838-8.509 8.572 0 4.59 3.58 8.336 8.08 8.56v.012h28.362c5.822 0 10.542-4.755 10.542-10.62 0-5.052-3.502-9.276-8.191-10.353z" stroke="#4B4F54" stroke-dasharray="2,2" fill="#FFF"></path><path d="M26.597 14.366l-2.054-2.022v11.691h-.749V12.343l-2.053 2.023-.53-.522 2.429-2.39.529-.522.53.522 2.427 2.39-.53.522zm-2.453-.974h.05l-.025-.024-.025.024z" stroke="#52575C" stroke-linejoin="round" fill="#52575C"></path></g></svg>                                        
                        </div>
                        <div class="nbco-option-text">
                            <p><?php esc_html_e('Upload your design', 'web-to-print-online-designer'); ?></p>
                            <p><?php esc_html_e('Select this option to upload your print-ready artwork files to our platform.', 'web-to-print-online-designer'); ?></p>
                        </div>
                    </a>
                </div>
                <div class="nbco-option nbco-option-design">
                    <a class="nbco-option-design-link">
                        <div class="nbco-option-icon">
                            <svg viewBox="0 0 49 39" width="100%" height="100%"><g fill="none" fill-rule="evenodd"><path stroke="#4B4F54" stroke-dasharray="4,4" fill="#FFF" d="M2.577 2.627h44.165v34.392H2.577z"></path><path stroke="#52575C" fill="#FFF" d="M1.225 1.232H4.38v3.253H1.225zM44.939 1.232h3.155v3.253h-3.155zM1.225 35.16H4.38v3.253H1.225zM44.939 35.16h3.155v3.253h-3.155z"></path><path d="M32.663 23.91a.459.459 0 0 1-.46-.473v-.917c-.582.901-1.486 1.454-2.711 1.454-1.87 0-3.294-1.517-3.294-3.618 0-2.102 1.424-3.619 3.294-3.619 1.225 0 2.129.553 2.711 1.454v-.916c0-.269.2-.474.46-.474s.46.205.46.474v6.162c0 .268-.2.474-.46.474zm-3.049-6.367c-1.532 0-2.497 1.17-2.497 2.813 0 1.643.965 2.812 2.497 2.812 1.578 0 2.59-1.28 2.59-2.812 0-1.533-1.012-2.813-2.59-2.813zm-4.658 6.368c-.23 0-.353-.143-.414-.3l-1.256-2.892h-5.27l-1.257 2.891c-.061.158-.184.3-.414.3-.275 0-.444-.19-.444-.426 0-.079.03-.158.061-.22l4.26-9.813c.091-.205.214-.316.429-.316.214 0 .337.11.429.316l4.259 9.812c.03.063.061.142.061.221 0 .237-.169.427-.444.427zm-4.305-9.45l-2.284 5.42h4.566l-2.282-5.42z" fill="#FFC600"></path><path fill="#CC9E00" d="M15.646 25.865h18.477v.5H15.646z"></path></g></svg>
                        </div>
                        <div class="nbco-option-text">
                            <p><?php esc_html_e('Design online', 'web-to-print-online-designer'); ?></p>
                            <p><?php esc_html_e('Browse our designs and customize to your taste.', 'web-to-print-online-designer'); ?></p>
                        </div>
                    </a>
                </div>
                <?php if( nbdesigner_get_option('nbdesigner_button_hire_designer', 'no') == 'yes' ): ?>
                <div class="nbco-option nbco-option-hire">
                    <a class="nbco-option-hire-link">
                        <div class="nbco-option-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -47 454.00016 454"><path d="m445.984375.00390625h-318.957031c-2.09375-.06250005-4.125.72265575-5.636719 2.17578175-1.511719 1.457031-2.371094 3.457031-2.390625 5.554687v51.269531h-110.984375c-4.464844.109375-8.0273438 3.765625-8.015625 8.234375v285.035157c-.0195312 3.011718 1.664062 5.773437 4.347656 7.136718 2.683594 1.363282 5.90625 1.097656 8.328125-.691406l73.484375-52.714844h240.8125c2.109375.027344 4.144532-.789062 5.652344-2.269531 1.507812-1.476563 2.363281-3.5 2.375-5.609375v-51.121094h32.839844l73.484375 52.460938c1.367187.945312 2.996093 1.433594 4.660156 1.398437 4.433594-.066406 7.996094-3.667969 8.015625-8.101562v-285.027344c-.015625-2.097656-.875-4.097656-2.382812-5.554687-1.507813-1.453126-3.539063-2.2382818-5.632813-2.17578175zm-126.984375 289.99999975h-235.410156c-1.679688.019532-3.3125.566406-4.667969 1.554688l-62.921875 45.144531v-261.699219h103v163.613282c-.015625 4.5 3.53125 8.207031 8.027344 8.386718h191.972656zm119-12.808594-62.921875-44.890624c-1.378906-.914063-3.015625-1.371094-4.667969-1.300782h-235.410156v-215h303zm0 0" fill="#7679B3"/><path xmlns="http://www.w3.org/2000/svg" fill="#7679B3" d="m199.058594 221.003906h23.339844c2.078124-.003906 4.058593-.851562 5.496093-2.351562 1.433594-1.5 2.195313-3.515625 2.105469-5.589844v-3.058594h112v3.058594c-.085938 2.074219.671875 4.089844 2.109375 5.589844 1.433594 1.5 3.417969 2.347656 5.492187 2.351562h23.339844c4.417969.03125 8.027344-3.523437 8.058594-7.941406v-22.851562c-.011719-4.46875-3.589844-8.113282-8.058594-8.207032h-2.941406v-120h2.941406c4.46875-.09375 8.046875-3.738281 8.058594-8.210937v-22.847657c-.03125-4.417968-3.640625-7.972656-8.058594-7.941406h-23.339844c-2.074218.003906-4.058593.851563-5.492187 2.351563-1.4375 1.496093-2.195313 3.515625-2.109375 5.589843v3.058594h-112v-3.058594c.089844-2.074218-.671875-4.09375-2.105469-5.589843-1.4375-1.5-3.417969-2.347657-5.496093-2.351563h-23.339844c-4.417969-.03125-8.027344 3.523438-8.058594 7.941406v22.847657c.011719 4.472656 3.589844 8.117187 8.058594 8.210937h2.941406v120h-2.941406c-4.46875.09375-8.046875 3.738282-8.058594 8.207032v22.851562c.03125 4.417969 3.640625 7.972656 8.058594 7.941406zm14.941406-16h-7v-7h7zm151 0h-7v-7h7zm-7-166h7v7h-7zm-151 0h7v7h-7zm11 23h4.398438c4.417968 0 7.601562-3.792968 7.601562-8.210937v-3.789063h112v3.789063c0 4.417969 3.183594 8.210937 7.601562 8.210937h4.398438v120h-4.398438c-4.417968 0-7.601562 3.789063-7.601562 8.207032v3.792968h-112v-3.792968c0-4.417969-3.183594-8.207032-7.601562-8.207032h-4.398438zm0 0"/><path xmlns="http://www.w3.org/2000/svg" fill="#7679B3" d="m234.164062 181.839844c.605469 0 1.207032-.066406 1.796876-.203125l35.238281-8.148438c2.03125-.46875 3.890625-1.5 5.363281-2.976562l65.121094-65.25c5.53125-5.558594 5.527344-14.542969-.011719-20.09375l-18.835937-18.839844c-5.554688-5.539063-14.542969-5.542969-20.101563-.007813l-65.253906 65.121094c-1.472657 1.472656-2.503907 3.328125-2.972657 5.359375l-8.148437 35.238281c-.546875 2.375.019531 4.871094 1.535156 6.78125 1.519531 1.90625 3.824219 3.019532 6.261719 3.019532zm12.925782-28.40625 7.476562 7.480468-9.722656 2.246094zm23.269531.644531-16.433594-16.4375 45.65625-45.5625 16.34375 16.34375zm58.742187-58.859375-1.871093 1.875-16.324219-16.320312 1.875-1.871094zm0 0"/></svg>
                        </div>
                        <div class="nbco-option-text">
                            <p><?php esc_html_e('Request for design', 'web-to-print-online-designer'); ?></p>
                            <p><?php esc_html_e('Let our experts help you with your design.', 'web-to-print-online-designer'); ?></p>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>