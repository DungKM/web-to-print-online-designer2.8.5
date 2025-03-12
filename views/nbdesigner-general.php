<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly  
?>
<div id="printcart-design" class="wp-core-ui" ng-app="printcartApp">
    <div ng-controller="printcartCtrl" keypress ng-cloak>
        <div class="printcart-body">
            <div>
                <div class="printcart-import-product">
                    <div class="d-flex justify-content-between align-items-center p-1">
                        <div class="my-2">
                            <?php esc_html_e('These are sample products that we have pre-configured with printing options and templates to help you easily set up a product.', 'web-to-print-online-designer'); ?>
                        </div>
                    </div>
                </div>
                <div class="border border-gray-300 p-2">
                    <div class="d-flex align-items-center px-2">
                        <input id="pcSelectAll" type="checkbox" ng-model="selectAll"
                            ng-change="toggleAllProducts(selectAll)">
                            <label for="" class="nbd-label">Select All</label>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 g-2" ng-repeat="(key, product) in product_sample">
                                <div
                                    class="d-flex flex-column p-0 mt-0 h-100 w-100 align-items-center border border-gray-300 p-2 rounded">
                                    <div class="d-flex h-100 w-100 align-items-center">
                                        <input class="me-2" type="checkbox" ng-model="product.checked"
                                            id="pcItem{{key}}" ng-change="selectProduct(key)">
                                        <label for="pcItem{{key}}" class="form-check-label d-flex w-100">
                                            <img style="width: 50px; height: 50px" ng-src="{{product.image}}"
                                                class="me-2" alt="{{product.name}}">
                                            <div style="width: calc(100% - 80px);" class="text-start text-truncate"
                                                title="{{product.name}}">
                                                {{product.name}}
                                                <div>
                                                    <span ng-if="product.templates"
                                                        class="badge bg-info position-relative">
                                                        <?php esc_html_e('Templates', 'web-to-print-online-designer'); ?>
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                            {{product.templates}}
                                                        </span>
                                                    </span>
                                                    <span ng-if="product.print_options"
                                                        class="badge bg-success position-relative">
                                                        <?php esc_html_e('Printing options', 'web-to-print-online-designer'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <button
                    class="btn btn-outline-primary px-3 position-relative overflow-hidden"
                    ng-click="changeTab(true)" ng-disabled="isLoadingSaveSetting">
                      <?php esc_html_e('Import', 'web-to-print-online-designer'); ?>
                    <div ng-show="isLoadingSaveSetting"
                        class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-light bg-opacity-75">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden"> <?php esc_html_e('Loading...', 'web-to-print-online-designer'); ?></span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
        <div class="modal" id="importProductModal" tabindex="-1" aria-labelledby="importProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importProductModalLabel">
                            <?php esc_html_e('Import products', 'web-to-print-online-designer'); ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-start mb-2 h6">
                            <?php esc_html_e('Do not turn off the page while importing products. It may take a few minutes.', 'web-to-print-online-designer'); ?>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Animated striped example"
                            aria-valuenow="{{100 * productImportedCount/productImportedTotal}}" aria-valuemin="0"
                            aria-valuemax="100">
                            <div class="progress-bar progress-bar bg-success progress-bar-striped progress-bar-animated"
                                style="width: {{100 * productImportedCount/productImportedTotal}}%">
                                {{ (100 * productImportedCount / productImportedTotal).toFixed(0) }}%
                            </div>
                        </div>
                        <div class="text-start my-1">
                            Name: {{product_sample_checked[productImportedCount].name}}
                        </div>
                    </div>
                    <div ng-show="isLoadingChange"
                        class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-25">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="confirmImportProductModal" tabindex="-1" aria-labelledby="confirmImportProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importProductModalLabel">
                            <?php esc_html_e('Import products', 'web-to-print-online-designer'); ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="nbd-text-start mb-2 h6">
                            <?php
                            esc_html_e('Some products have already been imported and may be duplicated. Are you sure you want to proceed with the import?', 'web-to-print-online-designer');
                            ?>
                            <span class="text-muted">
                                <?php esc_html_e(' (If you proceed, this will not affect the existing products)', 'web-to-print-online-designer'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button"
                            ng-click="current_tab = 'general'; hiddenModal('confirmImportProductModal')"
                            class="btn btn-outline-primary" type="submit">
                            <?php esc_html_e('Skip', 'web-to-print-online-designer'); ?>
                        </button>
                        <button type="button" ng-click="importProducts()" class="btn btn-primary" type="submit">
                            <?php esc_html_e('Import product', 'web-to-print-online-designer'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="confirmNavigationModal" tabindex="-1" aria-labelledby="confirmNavigationLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmNavigationLabel">
                            <?php esc_html_e('Do you want to leave this page?', 'web-to-print-online-designer'); ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-start mb-2 h6">
                            <?php esc_html_e('Do you want to stay on this page or go to the product page?', 'web-to-print-online-designer'); ?>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" ng-click="hiddenModal('confirmNavigationLabel')">
                            <?php esc_html_e('Stay on this page', 'web-to-print-online-designer'); ?>
                        </button>
                        <a href="<?php echo admin_url('admin.php?page=nbdesigner_manager_product') ?>" class="btn btn-primary">
                            <?php esc_html_e('Go to product page', 'web-to-print-online-designer'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Toast -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 999999;">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
                data-bs-delay="3000">
                <div class="alert mb-0 p-0"
                    ng-class="toastConfig.status == 'success' ? 'alert-success' : 'alert-danger'">
                    <div class="alert-heading d-flex align-items-center justify-content-between py-2 px-3 text-white"
                        ng-class="toastConfig.status == 'success' ? 'bg-success' : 'bg-danger'">
                        <strong class="me-auto">{{toastConfig.title}}</strong>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                    <div class="py-2 px-3 text-start fw-medium">
                        <p class="mb-0">{{toastConfig.message}}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>