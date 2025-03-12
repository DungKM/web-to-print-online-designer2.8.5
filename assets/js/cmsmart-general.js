"use strict";

var printcartDashboardApp = angular.module("printcartApp", []);

printcartDashboardApp.controller("printcartCtrl", [
  "$scope",
  function ($scope) {
    $scope.init = function () {
      $scope.printcart_detail = printcart_detail;
      console.log( $scope.printcart_detail);
      $scope.product_sample = [];
      $scope.product_sample_checked = [];
      $scope.selectAll = false;
      if (angular.isDefined(printcart_detail?.product_sample?.length)) {
        $scope.selectAll = true;
        $scope.product_sample = printcart_detail.product_sample.map(function (
          product
        ) {
          return { ...product, checked: true };
        });
      }

      $scope.store = {};
      $scope.account = {};
      $scope.isConnected = false;
      $scope.shopUrl = $scope.printcart_detail.home_url;
      $scope.userName = $scope.printcart_detail.name;
      $scope.email = $scope.printcart_detail.user_email;
      $scope.storeName = $scope.printcart_detail.site_title;
      $scope.first_imported_product =
        $scope.printcart_detail.first_imported_product;
      $scope.isLoadingConnect = false;
      $scope.isLoadingChange = false;
      $scope.isLoadingStore = false;
      $scope.isLoadingSaveSetting = false;
      $scope.productImportedCount = 0;
      $scope.productImportedTotal = 1;
      $scope.default_font_subset = $scope.printcart_detail.default_font_subset;
      $scope.dimension_unit = $scope.printcart_detail.dimension_unit;
      $scope.create_your_own_page_id = printcart_detail.create_your_own_page_id;
      $scope.designer_page_id = printcart_detail.designer_page_id;
      $scope.gallery_page_id = printcart_detail.gallery_page_id;
      $scope.logged_page_id = printcart_detail.logged_page_id;

    };

    $scope.updateApp = function () {
      if (
        $scope.$root.$$phase !== "$apply" &&
        $scope.$root.$$phase !== "$digest"
      )
        $scope.$apply();
    };

    $scope.toastConfig = {
      message: "",
      title: "",
      status: "success",
    };

    $scope.showToast = function (toastConfig) {
      var toastLiveExample = document.getElementById("liveToast");
      const toastBootstrap =
        bootstrap.Toast.getOrCreateInstance(toastLiveExample);
      $scope.toastConfig = toastConfig;
      toastBootstrap.show();
    };

    $scope.getStore = function () {
      var data = {
        action: "printcart_get_store",
      };

      jQuery.ajax({
        url: printcart_detail.ajax_url,
        type: "POST",
        data: data,
        beforeSend: function () {
          $scope.isLoadingStore = true;
          $scope.updateApp();
        },
        success: function (response) {
          if (
            angular.isDefined(response?.data?.account) &&
            angular.isDefined(response?.data?.store) &&
            response?.data?.flag == 1
          ) {
            $scope.account = response.data.account;
            $scope.store = response.data.store;
            $scope.isConnected = true;
          } else {
            $scope.isConnected = false;
            $scope.account = {};
            $scope.store = {};
          }
        },
        error: function () {
          $scope.showToast({
            message: "Something went wrong",
            title: "Error",
            status: "danger",
          });
        },
        complete: function () {
          $scope.isLoadingStore = false;
          $scope.updateApp();
        },
      });
    };

    $scope.handleConnect = function () {
      var data = {
        action: "printcart_generate_key_api",
        userName: $scope.userName,
        email: $scope.email,
        storeName: $scope.storeName,
        shopUrl: $scope.shopUrl,
      };

      jQuery.ajax({
        url: printcart_detail.ajax_url,
        type: "POST",
        data: data,
        beforeSend: function () {
          $scope.isLoadingConnect = true;
          $scope.updateApp();
        },
        success: function (response) {
          if (response?.data?.flag == 1) {
            $scope.showToast({
              message: "API Key generated successfully",
              title: "Success",
              status: "success",
            });
            printcart_detail.sid = response?.data?.sid;
            printcart_detail.secret = response?.data?.secret;
            printcart_detail.token = response?.data?.unauth_token;
            jQuery("#connectDashboardModal .btn-close").trigger("click");
            $scope.getStore();
          } else {
            $scope.showToast({
              message: response?.data?.message,
              title: "Error",
              status: "danger",
            });
          }
        },
        error: function (error) {
          $scope.showToast({
            message: "Error generating API Key",
            title: "Error",
            status: "danger",
          });
        },
        complete: function () {
          $scope.isLoadingConnect = false;
          $scope.updateApp();
        },
      });
    };
    $scope.saveApiKey = function () {
      var data = {
        action: "printcart_save_api_key",
        sid: $scope.printcart_detail.sid,
        secret: $scope.printcart_detail.secret,
        unauth_token: $scope.printcart_detail.token,
      };

      jQuery.ajax({
        url: printcart_detail.ajax_url,
        type: "POST",
        data: data,
        beforeSend: function () {
          $scope.isLoadingChange = true;
          $scope.updateApp();
        },
        success: function () {
          $scope.showToast({
            message: "API Key saved successfully",
            title: "Success",
            status: "success",
          });
          jQuery("#manuallyModal .btn-close").trigger("click");
          $scope.getStore();
        },
        error: function (error) {
          $scope.showToast({
            message: "Error saving API Key",
            title: "Error",
            status: "danger",
          });
        },
        complete: function () {
          $scope.isLoadingChange = false;
          $scope.updateApp();
        },
      });
    };
    $scope.testApiKey = function () {
      var data = {
        action: "printcart_check_connection_dashboard",
        sid: $scope.printcart_detail.sid,
        secret: $scope.printcart_detail.secret,
        unauth_token: $scope.printcart_detail.token,
      };

      jQuery.ajax({
        url: printcart_detail.ajax_url,
        type: "POST",
        data: data,
        beforeSend: function () {
          $scope.isLoadingChange = true;
          $scope.updateApp();
        },
        success: function (response) {
          if (response?.data?.flag == 1) {
            $scope.showToast({
              message: response?.data?.message,
              title: "Success",
              status: "success",
            });
          } else {
            $scope.showToast({
              message: response?.data?.message,
              title: "Error",
              status: "danger",
            });
          }
        },
        error: function () {
          $scope.showToast({
            message: "Something went wrong",
            title: "Error",
            status: "danger",
          });
        },
        complete: function () {
          $scope.isLoadingChange = false;
          $scope.updateApp();
        },
      });
    };

    $scope.showModal = function (el) {
      var modalEl = document.getElementById(el);

      if (!modalEl) return;

      var modal = new bootstrap.Modal(modalEl, {
        keyboard: false,
        backdrop: "static",
      });
      modal.show();
    };

    $scope.hiddenModal = function (el) {
      var modalEl = document.getElementById(el);

      if (!modalEl) return;
      var modal = bootstrap.Modal.getInstance(modalEl);
      modal.hide();
    };
    $scope.redirecPageProduct = function(callback){
      window.location.href = "<?php echo admin_url('admin.php?page=nbdesigner_manager_product'); ?>";
    }

    $scope.importProducts = function (callback) {
      if ($scope.product_sample.length === 0) {
        $scope.showToast({
          message: "No products to import",
          title: "Warning",
          status: "warning",
        });
        return;
      }

      $scope.product_sample_checked = $scope.product_sample.filter(function (
        product
      ) {
        return product.checked;
      });

      $scope.productImportedTotal = $scope.product_sample_checked.length || 1;
      $scope.productImportedCount = 0;

      if ($scope.first_imported_product === "yes") {
        $scope.hiddenModal("confirmImportProductModal");
      }

      $scope.showModal("importProductModal");

      function importProduct(product_id) {
        var data = {
          action: "printcart_import_product",
          product_id: product_id,
        };

        jQuery.ajax({
          url: printcart_detail.ajax_url,
          type: "POST",
          data: data,
          success: function (response) {
            if (response?.flag == 1) {
              $scope.productImportedCount++;

              if (
                angular.isDefined(
                  $scope.product_sample_checked[$scope.productImportedCount]
                )
              ) {
                var _currentProduct =
                  $scope.product_sample_checked[$scope.productImportedCount];
                importProduct(_currentProduct?.id);
              }
            } else {
              $scope.hiddenModal("importProductModal");
              $scope.showToast({
                message: `Error importing product!`,
                title: "Error",
                status: "danger",
              });
            }
          },
          error: function () {
            $scope.hiddenModal("importProductModal");
            $scope.showToast({
              message: `Error importing product!`,
              title: "Error",
              status: "danger",
            });
          },
          complete: function () {
            if ($scope.productImportedCount === $scope.productImportedTotal) {
              $scope.hiddenModal("importProductModal");
              $scope.showModal("confirmNavigationModal");
              $scope.showToast({
                message: "All products imported",
                title: "Success",
                status: "success",
              });
              if (callback) callback();
            }
            $scope.updateApp();
          },
        });
      }

      if (
        angular.isDefined(
          $scope.product_sample_checked[$scope.productImportedCount]
        )
      ) {
        var currentProduct =
          $scope.product_sample_checked[$scope.productImportedCount];

        importProduct(currentProduct.id);
      }
    };

    $scope.toggleAllProducts = function (selectAll) {
      $scope.product_sample = $scope.product_sample.map(function (product) {
        return { ...product, checked: selectAll };
      });
    };

    $scope.changeUnit = function (unit) {
      $scope.dimension_unit = unit;
      $scope.updateApp();
    };

    $scope.changeSubnet = function (subnet) {
      $scope.default_font_subset = subnet;
      $scope.updateApp();
    };

    $scope.changePage = function (page, type) {
      if (type === "create_your_own") {
        $scope.create_your_own_page_id = page;
      } else if (type === "designer") {
        $scope.designer_page_id = page;
      } else if (type === "gallery") {
        $scope.gallery_page_id = page;
      } else if (type === "logged") {
        $scope.logged_page_id = page;
      }
    };

    $scope.saveSettings = function (callback) {
      var data = {
        action: "printcart_save_settings",
        create_your_own_page_id: $scope.create_your_own_page_id,
        designer_page_id: $scope.designer_page_id,
        gallery_page_id: $scope.gallery_page_id,
        logged_page_id: $scope.logged_page_id,
        default_font_subset: $scope.default_font_subset,
        dimension_unit: $scope.dimension_unit,
      };

      jQuery.ajax({
        url: printcart_detail.ajax_url,
        type: "POST",
        data: data,
        beforeSend: function () {
          $scope.isLoadingSaveSetting = true;
          $scope.updateApp();
        },
        success: function () {
          $scope.showToast({
            message: "Settings saved successfully",
            title: "Success",
            status: "success",
          });
        },
        error: function (error) {
          $scope.showToast({
            message: "Error saving settings",
            title: "Error",
            status: "danger",
          });
        },
        complete: function () {
          $scope.isLoadingSaveSetting = false;
          if (callback) callback();
          $scope.updateApp();
        },
      });
    };

    $scope.changeTab = function (isNext = false) {
      if (isNext) {
        if ($scope.first_imported_product === "no") {
          $scope.importProducts(function () {
            $scope.updateApp();
          });
          return;
        } else {
          $scope.showModal("confirmImportProductModal");
          return;
        }
      }
      $scope.updateApp();
    };

    $scope.init();
  },
]);
