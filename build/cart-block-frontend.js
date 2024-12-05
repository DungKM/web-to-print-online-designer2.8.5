/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/cart-block/block.js":
/*!************************************!*\
  !*** ./src/js/cart-block/block.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Block: () => (/* binding */ Block)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! lodash */ "lodash");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _options__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./options */ "./src/js/cart-block/options.js");

/**
 * External dependencies
 */






/**
 * Internal dependencies
 */

const Block = props => {
  /**
   * setExtensionData will update the wc/store/checkout data store with the values supplied. It
   * can be used to pass data from the client to the server when submitting the checkout form.
   */
  // const { setExtensionData } = checkoutExtensionData;
  // /**
  //  * Debounce the setExtensionData function to avoid multiple calls to the API when rapidly
  //  * changing options.
  //  */
  // // eslint-disable-next-line react-hooks/exhaustive-deps
  // const debouncedSetExtensionData = useCallback(
  // 	debounce((namespace, key, value) => {
  // 		setExtensionData(namespace, key, value);
  // 	}, 1000),
  // 	[setExtensionData]
  // );
  // console.log(checkoutExtensionData);
  // const validationErrorId = 'shipping-workshop-other-value';

  // const { setValidationErrors, clearValidationError } = useDispatch(
  // 	'wc/store/validation'
  // );

  // const validationError = useSelect((select) => {
  // 	const store = select('wc/store/validation');
  // 	/**
  // 	 * [frontend-step-07]
  // 	 * 📝 Write some code to get the validation error from the `wc/store/validation` data store.
  // 	 * Using the `getValidationError` selector on the `store` object, get the validation error.
  // 	 *
  // 	 * The `validationErrorId` variable can be used to get the validation error. Documentation
  // 	 * on the validation data store can be found here:
  // 	 * https://github.com/woocommerce/woocommerce-blocks/blob/trunk/docs/third-party-developers/extensibility/data-store/validation.md
  // 	 */

  // 	/**
  // 	 * [frontend-step-07-extra-credit]
  // 	 * 💰 Extra credit: In the `useEffect` that handles the "other" textarea, only call
  // 	 * `clearValidationError` if the validation error is in the data store already.
  // 	 */
  // });
  // const [
  // 	selectedAlternateShippingInstruction,
  // 	setSelectedAlternateShippingInstruction,
  // ] = useState('try-again');
  // const [otherShippingValue, setOtherShippingValue] = useState('');

  // /* Handle changing the select's value */
  // useEffect(() => {
  // 	/**
  // 	 * [frontend-step-02]
  // 	 * 📝 Using `setExtensionData`, write some code in this useEffect that will run when the
  // 	 * `selectedAlternateShippingInstruction` value changes.
  // 	 *
  // 	 * The API of this function is: setExtensionData( namespace, key, value )
  // 	 *
  // 	 * This code should use `setExtensionData` to update the `alternateShippingInstruction` key
  // 	 * in the `shipping-workshop` namespace of the checkout data store.
  // 	 */
  // 	/**
  // 	 * [frontend-step-02-extra-credit-1]
  // 	 * 💰 Extra credit: Ensure the `setExtensionData` function is not called multiple times. We
  // 	 * can use the `debouncedSetExtensionData` function for this. The API is the same.
  // 	 */
  // }, [setExtensionData, selectedAlternateShippingInstruction]);

  // /**
  //  * [frontend-step-02-extra-credit-2]
  //  * 💰 Extra credit: Use a `useState` to track whether the user has interacted with the "other"
  //  * textbox. If they have, then the validation error should not be hidden when the user changes
  //  * the select's value. If it is "pristine" then we should keep the error hidden.
  //  */

  // /* Handle changing the "other" value */
  // useEffect(() => {
  // 	/**
  // 	 * [frontend-step-03]
  // 	 * 📝 Write some code in this useEffect that will run when the `otherShippingValue` value
  // 	 * changes. This code should use `setExtensionData` to update the `otherShippingValue` key
  // 	 * in the `shipping-workshop` namespace of the checkout data store.
  // 	 */
  // 	/**
  // 	 * [frontend-step-03-extra-credit]
  // 	 * 💰 Extra credit: Ensure the `setExtensionData` function is not called multiple times. We
  // 	 * can use the `debouncedSetExtensionData` function for this. The API is the same.
  // 	 */
  // 	/**
  // 	 * [frontend-step-04]
  // 	 * 📝 Write some code that will use `setValidationErrors` to add an entry to the validation
  // 	 * data store if `otherShippingValue` is empty.
  // 	 *
  // 	 * The API of this function is: `setValidationErrors( errors )`.
  // 	 *
  // 	 * `errors` is an object with the following shape:
  // 	 * {
  // 	 *     [ validationErrorId ]: {
  // 	 *  		message: string,
  // 	 *	    	hidden: boolean,
  // 	 *     }
  // 	 * }
  // 	 *
  // 	 * For now, the error should remain hidden until the user has interacted with the field.
  // 	 *
  // 	 * [frontend-step-04-extra-credit]
  // 	 * 💰 Extra credit: If the `selectedAlternateShippingInstruction` is not `other` let's skip
  // 	 * adding the validation error. Make sure to place this code before the
  // 	 * `setValidationErrors` call, thus, the spoiler of [frontend-step-04] comes after the one
  // 	 * of [frontend-step-04-extra-credit].
  // 	 */
  // 	/**
  // 	 * [frontend-step-05]
  // 	 * 📝 Update the above code so that it will use `clearValidationError` to remove the
  // 	 * validation error from the data store if `selectedAlternateShippingInstruction` is not
  // 	 * `other`, or if the `otherShippingValue` is not empty.
  // 	 *
  // 	 * The API of `clearValidationError` is: `clearValidationError( validationErrorId )`
  // 	 *
  // 	 * 💡Don't forget to update the dependencies of the `useEffect` when you reference new
  // 	 * functions/variables!
  // 	 */
  // }, [
  // 	/**
  // 	 * [frontend-step-06]
  // 	 * 💡 Don't forget to update the dependencies of the `useEffect` when you reference new
  // 	 * functions/variables!
  // 	 */
  // 	otherShippingValue,
  // 	setExtensionData,
  // ]);

  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "ddd"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('ccccdddd', 'shipping-workshop'),
    value: 'c',
    options: _options__WEBPACK_IMPORTED_MODULE_6__.options
  }));
};

/***/ }),

/***/ "./src/js/cart-block/options.js":
/*!**************************************!*\
  !*** ./src/js/cart-block/options.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   options: () => (/* binding */ options)
/* harmony export */ });
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__);
/**
 * External dependencies
 */

const options = [{
  label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Try again another day', 'shipping-workshop'),
  value: 'try-again'
}
/**
 * [frontend-step-01]
 * 📝 Add more options using the same format as above. Ensure one option has the key "other".
 */];

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "lodash":
/*!*************************!*\
  !*** external "lodash" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["lodash"];

/***/ }),

/***/ "@woocommerce/blocks-checkout":
/*!****************************************!*\
  !*** external ["wc","blocksCheckout"] ***!
  \****************************************/
/***/ ((module) => {

module.exports = window["wc"]["blocksCheckout"];

/***/ }),

/***/ "@woocommerce/blocks-registry":
/*!******************************************!*\
  !*** external ["wc","wcBlocksRegistry"] ***!
  \******************************************/
/***/ ((module) => {

module.exports = window["wc"]["wcBlocksRegistry"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "@wordpress/plugins":
/*!*********************************!*\
  !*** external ["wp","plugins"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["plugins"];

/***/ }),

/***/ "./src/js/cart-block/block.json":
/*!**************************************!*\
  !*** ./src/js/cart-block/block.json ***!
  \**************************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"apiVersion":2,"name":"cart/cart-block","version":"2.0.0","title":"Design image","category":"woocommerce","description":"Detail design after add to cart","supports":{"html":false,"align":false,"multiple":false,"reusable":false},"parent":["woocommerce/cart-items-block"],"attributes":{"lock":{"type":"object","default":{"remove":true,"move":true}},"text":{"type":"string","default":""}},"textdomain":"shipping-workshop","editorStyle":"file:../../../build/style-cart-block.css"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***************************************!*\
  !*** ./src/js/cart-block/frontend.js ***!
  \***************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_plugins__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/plugins */ "@wordpress/plugins");
/* harmony import */ var _wordpress_plugins__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_plugins__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _woocommerce_blocks_checkout__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @woocommerce/blocks-checkout */ "@woocommerce/blocks-checkout");
/* harmony import */ var _woocommerce_blocks_checkout__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_woocommerce_blocks_checkout__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _woocommerce_blocks_registry__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @woocommerce/blocks-registry */ "@woocommerce/blocks-registry");
/* harmony import */ var _woocommerce_blocks_registry__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_woocommerce_blocks_registry__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _block__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./block */ "./src/js/cart-block/block.js");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./block.json */ "./src/js/cart-block/block.json");
/**
 * External dependencies
 */




/**
 * Internal dependencies
 */


const {
  registerBlockComponent
} = window.wc.wcBlocksRegistry;
const {
  registerCheckoutFilters
} = window.wc.blocksCheckout;
const modifyItemName = (defaultValue, extensions, args) => {
  console.log(args);
  var item = args.cartItem.extensions.online_design;
  var html = defaultValue;
  if (typeof item != 'undefined') {
    if (item.nbd_item_key) {
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
                <a class="button nbd-edit-design" href="${item.edit_design}">${(0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Edit design')}</a></div>
            <a>`;
    }
    if (item.nbu_item_key) {
      var image = ``;
      var t = Date.now();
      item.images.forEach(img => {
        image += `<div class="nbd-cart-item-upload-preview-wrap">
                    <a target="_blank" href="${img.file_url}">
                        <img decoding="async" class="nbd-cart-item-upload-preview" src="${img.src}">
                    </a>
                    <p class="nbd-cart-item-upload-preview-title">${img.name}</p>
                </div>`;
      });
      var edit_btn = item.edit_design ? `<a class="button nbd-reup-design" href="${item.edit_design}">${(0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Reupload design')}</a>` : '';
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
registerCheckoutFilters(_block_json__WEBPACK_IMPORTED_MODULE_5__, {
  itemName: modifyItemName
});
})();

/******/ })()
;
//# sourceMappingURL=cart-block-frontend.js.map