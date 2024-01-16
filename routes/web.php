<?php

//Route::redirect('/', '/login');
use App\Http\Middleware\VerifyCsrfToken;

Route::get('/admin/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});


Route::group(['prefix' => 'admin','as' => 'admin.', 'namespace' => 'Admin'], function() {
    Auth::routes(['register' => false]);
});



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth:admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::any('dashboard/getdate', 'HomeController@getDate')->name('dashboard.getdate');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::get('roles/create/{guard_name}', 'RolesController@create')->name('roles.create.{guard_name}');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::get('merchants', 'UsersController@index')->name('users.merchants');
    Route::get('merchants/create', 'UsersController@create')->name('users.merchants.create');
    Route::post('merchants/store', 'UsersController@store')->name('users.merchants.store');
    Route::get('merchants/{user}', 'UsersController@show')->name('users.merchants.show');
    Route::get('merchants/{user}/edit', 'UsersController@edit')->name('users.merchants.edit');
    Route::get('agents', 'UsersController@index')->name('users.agents');
    Route::get('agents/create', 'UsersController@create')->name('users.agents.create');
    Route::post('agents/store', 'UsersController@store')->name('users.agents.store');
    Route::get('agents/{user}', 'UsersController@show')->name('users.agents.show');
    Route::get('agents/{user}/edit', 'UsersController@edit')->name('users.agents.edit');
    Route::get('vips', 'UsersController@index')->name('users.vips');
    Route::get('vips/create', 'UsersController@create')->name('users.vips.create');
    Route::post('vips/store', 'UsersController@store')->name('users.vips.store');
    Route::get('vips/{user}', 'UsersController@show')->name('users.vips.show');
    Route::get('vips/{user}/edit', 'UsersController@edit')->name('users.vips.edit');
    Route::post('vips/fetch_state', 'UsersController@fetchState')->name('users.fetch.state');
    Route::get('users/{user}/address-book-list', 'UsersController@addressBookList')->name('users.address-book.list');
    Route::post('users/{id}/set-as-default', 'UsersController@setAsDefault')->name('users.address-book.set-default-address');
    Route::get('users/{user}/address-book/create', 'UsersController@createAddressBook')->name('users.address-book.create');
    Route::post('users/address-book/store', 'UsersController@storeAddressBook')->name('users.address-book.store');
    Route::get('users/{id}/edit-address-book', 'UsersController@editAddressBook')->name('users.address-book.edit');
    Route::put('users/{id}/update-address-book', 'UsersController@updateAddressBook')->name('users.address-book.update');
    Route::post('users/to-account-verify', 'UsersController@toAccountVerify')->name('users.to-account-verify');
    Route::post('users/to-ssm-verify', 'UsersController@toSsmVerify')->name('users.to-ssm-verify');
    Route::post('users/to-first-payment', 'UsersController@toFirstPayment')->name('users.to-first-payment');
    Route::post('users/to-shop-verify', 'UsersController@toShopVerify')->name('users.to-shop-verify');
    Route::post('users/status-change', 'UsersController@statusChange')->name('users.status-change');
    Route::get('users/shipping-balance', 'UsersController@shippingBalance')->name('users.shipping-balance');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Admins
    Route::delete('admins/destroy', 'AdminsController@massDestroy')->name('admins.massDestroy');
    Route::post('admins/media', 'AdminsController@storeMedia')->name('admins.storeMedia');
    Route::post('admins/ckmedia', 'AdminsController@storeCKEditorImages')->name('admins.storeCKEditorImages');
    Route::resource('admins', 'AdminsController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::post('countries/change_status', 'CountriesController@changeStatus')->name('countries.change-status');
    Route::resource('countries', 'CountriesController');

    // Language
    Route::delete('languages/destroy', 'LanguageController@massDestroy')->name('languages.massDestroy');
    Route::post('languages/change_status', 'LanguageController@changeStatus')->name('languages.change-status');
    Route::resource('languages', 'LanguageController');

    // Banner
    Route::delete('banners/destroy', 'BannerController@massDestroy')->name('banners.massDestroy');
    Route::post('banners/media', 'BannerController@storeMedia')->name('banners.storeMedia');
    Route::post('banners/ckmedia', 'BannerController@storeCKEditorImages')->name('banners.storeCKEditorImages');
    Route::post('banners/change_status', 'BannerController@changeStatus')->name('banners.change-status');
    Route::resource('banners', 'BannerController');

    // Bank List
    Route::delete('bank-lists/destroy', 'BankListController@massDestroy')->name('bank-lists.massDestroy');
    Route::post('bank-list/change_status', 'BankListController@changeStatus')->name('bank-lists.change-status');
    Route::resource('bank-lists', 'BankListController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/change_status', 'ProductController@changeStatus')->name('products.change-status');
    Route::get('products/packageIndex', 'ProductController@packageIndex')->name('products.package-index');
    Route::get('products/package/create', 'ProductController@create')->name('products.package-create');
    Route::get('products/package/edit/{product}', 'ProductController@edit')->name('products.package-edit');
    Route::resource('products', 'ProductController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/change_status', 'ProductCategoryController@changeStatus')->name('product-categories.change-status');
    Route::resource('product-categories', 'ProductCategoryController');

    // Otp Log
    Route::delete('otp-logs/destroy', 'OtpLogController@massDestroy')->name('otp-logs.massDestroy');
    Route::get('otp-logs/test', 'OtpLogController@test')->name('otp-logs.test');
    Route::resource('otp-logs', 'OtpLogController');

    // Product Batch
    Route::delete('product-batches/destroy', 'ProductBatchController@massDestroy')->name('product-batches.massDestroy');
    Route::post('product-batches/to-in-stock', 'ProductBatchController@inStock')->name('product-batches.to-in-stock');
    Route::get('product-batches/{id}/qr-pdf', 'ProductBatchController@generateQrPdf')->name('product-batches.qr-pdf');
    Route::resource('product-batches', 'ProductBatchController');

    // Product Check Qr
    Route::delete('product-check-qrs/destroy', 'ProductCheckQrController@massDestroy')->name('product-check-qrs.massDestroy');
    Route::get('new/product-check-qrs', 'ProductCheckQrController@indexNew')->name('product-check-qrs.new');
    Route::resource('product-check-qrs', 'ProductCheckQrController');

    // Payout Limit
    Route::delete('payout-limits/destroy', 'PayoutLimitController@massDestroy')->name('payout-limits.massDestroy');
    Route::resource('payout-limits', 'PayoutLimitController');

    // Announcement
    Route::delete('announcements/destroy', 'AnnouncementController@massDestroy')->name('announcements.massDestroy');
    Route::post('announcements/media', 'AnnouncementController@storeMedia')->name('announcements.storeMedia');
    Route::post('announcements/ckmedia', 'AnnouncementController@storeCKEditorImages')->name('announcements.storeCKEditorImages');
    Route::post('announcements/change_status', 'AnnouncementController@changeStatus')->name('announcements.change-status');
    Route::resource('announcements', 'AnnouncementController');

    // Product Quantity
    Route::delete('product-quantities/destroy', 'ProductQuantityController@massDestroy')->name('product-quantities.massDestroy');
    Route::post('product-quantities/to-in-stock', 'ProductQuantityController@inStock')->name('product-quantities.to-in-stock');
    Route::get('product-quantities/{id}/qr-pdf', 'ProductQuantityController@generateQrPdf')->name('product-quantities.qr-pdf');
    Route::post('product-quantities/to-damage', 'ProductQuantityController@confirmDamage')->name('product-quantities.to-damage');
    Route::post('product-quantities/to-free', 'ProductQuantityController@confirmFree')->name('product-quantities.to-free');
    Route::post('product-quantities/to-sample', 'ProductQuantityController@confirmSample')->name('product-quantities.to-sample');
    Route::resource('product-quantities', 'ProductQuantityController');

    // Point Convert
    Route::delete('point-converts/destroy', 'PointConvertController@massDestroy')->name('point-converts.massDestroy');
    Route::resource('point-converts', 'PointConvertController');

    // Points
    Route::delete('points/destroy', 'PointsController@massDestroy')->name('points.massDestroy');
//     Route::get('points/balance', 'PointsController@redemption_balance')->name('points.balance');
     Route::get('points/topup_balance', 'PointsController@topup_balance_test')->name('points.topup-balance');
    Route::get('points/convert_balance', 'PointsController@convert_balance_test')->name('points.convert-balance');
    Route::get('points/redemption_balanceredemption_balance', 'PointsController@redemption_balance_test')->name('points.redemption-balance');
    // Route::get('points/vip_redemption_balance', 'PointsController@vip_redemption_balance')->name('points.vip_redemption_balance');
    Route::resource('points', 'PointsController');

    // Total Revenue
    Route::delete('total-revenues/destroy', 'TotalRevenueController@massDestroy')->name('total-revenues.massDestroy');
    Route::resource('total-revenues', 'TotalRevenueController');

    // Reports
    Route::get('reports/summary', 'ReportSummaryController@summary')->name('reports.summary');
    Route::get('reports/deposit-summary', 'ReportSummaryController@depositSummary')->name('reports.deposit-summary');
    Route::post('reports/deposit-summary/export', 'ReportSummaryController@depositSummaryExport')->name('reports.deposit-summary.export');
    Route::get('reports/deposit-balance', 'ReportSummaryController@depositBalance')->name('reports.deposit-balance');
    Route::get('reports/deposit-balance/{id}', 'ReportSummaryController@depositBalanceDetail')->name('reports.desposit-balance-detail');
    Route::post('reports/deposit-balance/export', 'ReportSummaryController@depositBalanceExport')->name('reports.deposit-balance.export');
    Route::get('reports/joining-fee', 'ReportSummaryController@joiningFee')->name('reports.joining-fee');
    Route::post('reports/joining-fee/export', 'ReportSummaryController@joiningFeeExport')->name('reports.joining-fee.export');

    Route::get('reports/stock-credit-summary', 'ReportSummaryController@stockCreditSummary')->name('reports.stock-credit-summary');
    Route::get('reports/stock-credit-summary/millionaire', 'ReportSummaryController@stockCreditBalance')->name('reports.stock-credit-summary-millionaire');
    Route::post('reports/stock-credit-summary/export', 'ReportSummaryController@stockCreditSummaryExport')->name('reports.stock-credit-summary.export');
    Route::get('reports/stock-credit-balance', 'ReportSummaryController@stockCreditBalance')->name('reports.stock-credit-balance');
    Route::get('reports/stock-credit-balance/millionaire', 'ReportSummaryController@stockCreditBalance')->name('reports.stock-credit-balance-millionaire');
    Route::get('reports/stock-credit-balance/{id}', 'ReportSummaryController@stockCreditBalanceDetail')->name('reports.stock-credit-balance-detail');
    Route::post('reports/stock-credit-balance/export', 'ReportSummaryController@stockCreditBalanceExport')->name('reports.stock-credit-balance.export');

    Route::get('reports/stock-credit-balance-topup/millionaire', 'ReportSummaryController@stockCreditBalanceTopupMillionaire')->name('reports.stock-credit-balance-millionaire-topup');
    Route::get('reports/stock-credit-balance-topup/millionaire/{id}', 'ReportSummaryController@stockCreditBalanceTopupMillionaireDetail')->name('reports.stock-credit-balance-topup-millionaire-detail');
    Route::post('reports/stock-credit-balance-topup/millionaire/export', 'ReportSummaryController@stockCreditBalanceTopupMillionaireExport')->name('reports.stock-credit-balance-millionaire-topup.export');
    Route::post('reports/stock-credit-balance-topup-detail/millionaire/export', 'ReportSummaryController@stockCreditBalanceTopupMillionaireDetailExport')->name('reports.stock-credit-balance-topup-millionaire-detail.export');

    Route::get('reports/stock-credit-balance-topup/agent', 'ReportSummaryController@stockCreditBalanceTopupAgent')->name('reports.stock-credit-balance-agent-topup');
    Route::get('reports/stock-credit-balance-topup/agent/{id}', 'ReportSummaryController@stockCreditBalanceTopupAgentDetail')->name('reports.stock-credit-balance-topup-agent-detail');
    Route::post('reports/stock-credit-balance-topup/agent/export', 'ReportSummaryController@stockCreditBalanceTopupAgentExport')->name('reports.stock-credit-balance-agent-topup.export');
    Route::post('reports/stock-credit-balance-topup-detail/agent/export', 'ReportSummaryController@stockCreditBalanceTopupAgentDetailExport')->name('reports.stock-credit-balance-topup-agent-detail.export');

    Route::get('reports/shipping-credit-summary', 'ReportSummaryController@shippingCreditSummary')->name('reports.shipping-credit-summary');
    Route::post('reports/shipping-credit-summary/export', 'ReportSummaryController@shippingCreditSummaryExport')->name('reports.shipping-credit-summary.export');
    Route::get('reports/shipping-credit-balance', 'ReportSummaryController@shippingCreditBalance')->name('reports.shipping-credit-balance');
    Route::get('reports/shipping-credit-balance/{id}', 'ReportSummaryController@shippingCreditBalanceDetail')->name('reports.shipping-credit-balance-detail');
    Route::post('reports/shipping-credit-balance/export', 'ReportSummaryController@shippingCreditBalanceExport')->name('reports.shipping-credit-balance.export');

    Route::get('reports/mbr', 'ReportSummaryController@mbrReport')->name('reports.mbr');
    Route::post('reports/mbr/export', 'ReportSummaryController@mbrExport')->name('reports.mbr.export');
    Route::get('reports/mbr-invoice/{id}', 'ReportSummaryController@MBRInvoicePdf')->name('reports.mbr-invoice-pdf');

    Route::get('reports/bonus-credit-summary', 'ReportSummaryController@bonusCreditSummary')->name('reports.bonus-credit-summary');
    Route::post('reports/bonus-credit-summary/export', 'ReportSummaryController@bonusCreditSummaryExport')->name('reports.bonus-credit-summary.export');
    Route::get('reports/bonus-credit-balance', 'ReportSummaryController@bonusCreditBalance')->name('reports.bonus-credit-balance');
    Route::get('reports/bonus-credit-balance/{id}', 'ReportSummaryController@bonusCreditBalanceDetail')->name('reports.bonus-credit-balance-detail');
    Route::post('reports/bonus-credit-balance/export', 'ReportSummaryController@bonusCreditBalanceExport')->name('reports.bonus-credit-balance.export');

    Route::get('reports/voucher-credit-summary', 'ReportSummaryController@voucherCreditSummary')->name('reports.voucher-credit-summary');
    Route::post('reports/voucher-credit-summary/export', 'ReportSummaryController@voucherCreditSummaryExport')->name('reports.voucher-credit-summary.export');
    Route::get('reports/voucher-credit-balance', 'ReportSummaryController@voucherCreditBalance')->name('reports.voucher-credit-balance');
    Route::get('reports/voucher-credit-balance/{id}', 'ReportSummaryController@voucherCreditBalanceDetail')->name('reports.voucher-credit-balance-detail');
    Route::post('reports/voucher-credit-balance/export', 'ReportSummaryController@voucherCreditBalanceExport')->name('reports.voucher-credit-balance.export');

    Route::get('reports/get-balances-rankings', 'ReportSummaryController@getBalancesRanking')->name('reports.get-balances-rankings');
    Route::post('reports/get-balances-rankings/export', 'ReportSummaryController@getBalancesRankingExport')->name('reports.get-balances-rankings.export');

    Route::get('reports/rearrange-record/stock-credit', 'ReportSummaryController@stockCreditRearrangeRecord')->name('reports.stock-credit.rearrange-record');
    Route::get('reports/rearrange-record/shipping-credit', 'ReportSummaryController@shippingCreditRearrangeRecord')->name('reports.shipping-credit.rearrange-record');
    Route::get('reports/rearrange-record/bonus-credit', 'ReportSummaryController@bonusCreditRearrangeRecord')->name('reports.bonus-credit.rearrange-record');
    Route::get('reports/rearrange-record/voucher-credit', 'ReportSummaryController@voucherCreditRearrangeRecord')->name('reports.voucher-credit.rearrange-record');

    Route::get('reports/test', 'ReportSummaryController@test')->name('reports.test');

    // Total Redemption
    Route::delete('total-redemptions/destroy', 'TotalRedemptionController@massDestroy')->name('total-redemptions.massDestroy');
    Route::post('total-redemptions/getdate', 'TotalRedemptionController@getDate')->name('total-redemptions.getdate');
    Route::resource('total-redemptions', 'TotalRedemptionController');

    // Total Point Balance
    Route::delete('total-point-balances/destroy', 'TotalPointBalanceController@massDestroy')->name('total-point-balances.massDestroy');
    Route::post('total-point-balances/getdate', 'TotalPointBalanceController@getDate')->name('total-point-balances.getdate');
    Route::resource('total-point-balances', 'TotalPointBalanceController');

    // Product Details
    Route::delete('product-details/destroy', 'ProductDetailsController@massDestroy')->name('product-details.massDestroy');
    Route::resource('product-details', 'ProductDetailsController');

    // Commission Report
    Route::delete('commission-reports/destroy', 'CommissionReportController@massDestroy')->name('commission-reports.massDestroy');
    Route::resource('commission-reports', 'CommissionReportController');

    // Company Profit Loss
    Route::delete('company-profit-losses/destroy', 'CompanyProfitLossController@massDestroy')->name('company-profit-losses.massDestroy');
    Route::resource('company-profit-losses', 'CompanyProfitLossController');

    // Enquiry
    Route::delete('enquiries/destroy', 'EnquiryController@massDestroy')->name('enquiries.massDestroy');
    Route::resource('enquiries', 'EnquiryController');

    // Enquiry Reply
    Route::delete('enquiry-replies/destroy', 'EnquiryReplyController@massDestroy')->name('enquiry-replies.massDestroy');
    Route::resource('enquiry-replies', 'EnquiryReplyController');

    // Payment Method
    Route::delete('payment-methods/destroy', 'PaymentMethodController@massDestroy')->name('payment-methods.massDestroy');
    Route::post('payment-methods/change_status', 'PaymentMethodController@changeStatus')->name('payment-methods.change-status');
    Route::resource('payment-methods', 'PaymentMethodController');

    // Point Packages
    Route::delete('point-packages/destroy', 'PointPackagesController@massDestroy')->name('point-packages.massDestroy');
    Route::post('point-packages/media', 'PointPackagesController@storeMedia')->name('point-packages.storeMedia');
    Route::post('point-packages/ckmedia', 'PointPackagesController@storeCKEditorImages')->name('point-packages.storeCKEditorImages');
    Route::post('point-packages/change_status', 'PointPackagesController@changeStatus')->name('point-packages.change-status');
    Route::resource('point-packages', 'PointPackagesController');

    // Voucher
    Route::delete('vouchers/destroy', 'VoucherController@massDestroy')->name('vouchers.massDestroy');
    Route::resource('vouchers', 'VoucherController');

    // Material
    Route::delete('materials/destroy', 'MaterialController@massDestroy')->name('materials.massDestroy');
    Route::post('materials/media', 'MaterialController@storeMedia')->name('materials.storeMedia');
    Route::post('materials/ckmedia', 'MaterialController@storeCKEditorImages')->name('materials.storeCKEditorImages');
    Route::resource('materials', 'MaterialController');

    // Address Book
    Route::delete('address-books/destroy', 'AddressBookController@massDestroy')->name('address-books.massDestroy');
    Route::resource('address-books', 'AddressBookController');

    // Transaction Id Log
    Route::delete('transaction-id-logs/destroy', 'TransactionIdLogController@massDestroy')->name('transaction-id-logs.massDestroy');
    Route::resource('transaction-id-logs', 'TransactionIdLogController');

    // Personal Code Log
    Route::delete('personal-code-logs/destroy', 'PersonalCodeLogController@massDestroy')->name('personal-code-logs.massDestroy');
    Route::resource('personal-code-logs', 'PersonalCodeLogController');

    // New Order
//    Route::delete('new-orders/destroy', 'NewOrderController@massDestroy')->name('new-orders.massDestroy');
//    Route::resource('new-orders', 'NewOrderController');

    // Transaction Redeem Product
    Route::delete('transaction-redeem-products/destroy', 'TransactionRedeemProductController@massDestroy')->name('transaction-redeem-products.massDestroy');
    Route::get('transaction-redeem-products/new', 'TransactionRedeemProductController@index')->name('transaction-redeem-products.new');
    Route::get('transaction-redeem-products/shipped', 'TransactionRedeemProductController@index')->name('transaction-redeem-products.shipped');
    Route::get('transaction-redeem-products/completed', 'TransactionRedeemProductController@index')->name('transaction-redeem-products.completed');
    Route::get('transaction-redeem-products/cancel', 'TransactionRedeemProductController@index')->name('transaction-redeem-products.cancel');
    Route::get('transaction-redeem-products/{id}/to-ship', 'TransactionRedeemProductController@toShip')->name('transaction-redeem-products.to-ship');
    Route::post('transaction-redeem-products/to-ship', 'TransactionRedeemProductController@confirmShip')->name('transaction-redeem-products.confirm-ship');
    Route::post('transaction-redeem-products/to-cancel', 'TransactionRedeemProductController@toCancel')->name('transaction-redeem-products.to-cancel');
    Route::post('transaction-redeem-products/to-complete', 'TransactionRedeemProductController@toComplete')->name('transaction-redeem-products.to-complete');
    Route::resource('transaction-redeem-products', 'TransactionRedeemProductController');

    // Shipping Company
    Route::delete('shipping-companies/destroy', 'ShippingCompanyController@massDestroy')->name('shipping-companies.massDestroy');
    Route::post('shipping-companies/change_status', 'ShippingCompanyController@changeStatus')->name('shipping-companies.change-status');
    Route::resource('shipping-companies', 'ShippingCompanyController');

    // Transaction Bonus
    Route::delete('transaction-bonus/destroy', 'TransactionBonusController@massDestroy')->name('transaction-bonus.massDestroy');
    Route::resource('transaction-bonus', 'TransactionBonusController');

    // Transaction Point Withdraw
    Route::delete('transaction-point-withdraws/destroy', 'TransactionPointWithdrawController@massDestroy')->name('transaction-point-withdraws.massDestroy');
    Route::post('transaction-point-withdraws/media', 'TransactionPointWithdrawController@storeMedia')->name('transaction-point-withdraws.storeMedia');
    Route::post('transaction-point-withdraws/ckmedia', 'TransactionPointWithdrawController@storeCKEditorImages')->name('transaction-point-withdraws.storeCKEditorImages');
    Route::get('transaction-point-withdraws/pending', 'TransactionPointWithdrawController@index')->name('transaction-point-withdraws.pending');
    Route::get('transaction-point-withdraws/processing', 'TransactionPointWithdrawController@index')->name('transaction-point-withdraws.processing');
    Route::get('transaction-point-withdraws/completed', 'TransactionPointWithdrawController@index')->name('transaction-point-withdraws.completed');
    Route::get('transaction-point-withdraws/rejected', 'TransactionPointWithdrawController@index')->name('transaction-point-withdraws.rejected');
    Route::get('transaction-point-withdraws/{id}/to-approve', 'TransactionPointWithdrawController@toApprove')->name('transaction-point-withdraws.to-approve');
    Route::post('transaction-point-withdraws/{id}/to-approve', 'TransactionPointWithdrawController@confirmApprove')->name('transaction-point-withdraws.confirm-approve');
    Route::post('transaction-point-withdraws/to-reject', 'TransactionPointWithdrawController@confirmReject')->name('transaction-point-withdraws.confirm-reject');
    Route::post('transaction-point-withdraws/export', 'TransactionPointWithdrawController@export')->name('transaction-point-withdraws.export');
    Route::resource('transaction-point-withdraws', 'TransactionPointWithdrawController');

    // Transaction Point Purchase
    Route::delete('transaction-point-purchases/destroy', 'TransactionPointPurchaseController@massDestroy')->name('transaction-point-purchases.massDestroy');
    Route::post('transaction-point-purchases/media', 'TransactionPointPurchaseController@storeMedia')->name('transaction-point-purchases.storeMedia');
    Route::post('transaction-point-purchases/ckmedia', 'TransactionPointPurchaseController@storeCKEditorImages')->name('transaction-point-purchases.storeCKEditorImages');
    Route::get('transaction-point-purchases/new', 'TransactionPointPurchaseController@index')->name('transaction-point-purchases.new');
    Route::get('transaction-point-purchases/verified', 'TransactionPointPurchaseController@index')->name('transaction-point-purchases.verified');
    Route::get('transaction-point-purchases/failed', 'TransactionPointPurchaseController@index')->name('transaction-point-purchases.failed');
    Route::get('user-upgrades', 'TransactionPointPurchaseController@index')->name('transaction-point-purchases.user-upgrade');
    Route::get('user-upgrades/new', 'TransactionPointPurchaseController@index')->name('transaction-point-purchases.user-upgrade-new');
    Route::get('user-upgrades/create', 'TransactionPointPurchaseController@create')->name('transaction-point-purchases.user-upgrade-create');
    Route::get('user-upgrades/{id}', 'TransactionPointPurchaseController@upgradeShow')->name('transaction-point-purchases.user-upgrade-show');
    Route::post('user-upgrades/to-verify', 'TransactionPointPurchaseController@upgradeVerify')->name('transaction-point-purchases.user-upgrade-verify');
    Route::post('transaction-point-purchases/to-verify', 'TransactionPointPurchaseController@toVerify')->name('transaction-point-purchases.to-verify');
    Route::post('transaction-point-purchases/to-reject', 'TransactionPointPurchaseController@toReject')->name('transaction-point-purchases.to-reject');
    Route::get('transaction-point-purchases/test', 'TransactionPointPurchaseController@test')->name('transaction-point-purchases.test');
    Route::get('transaction-point-purchases/test', 'TransactionPointPurchaseController@test')->name('transaction-point-purchases.test');
    Route::get('transaction-point-purchases/top-up-pdf/{id}', 'TransactionPointPurchaseController@transactionPointPurchaseReceiptPDF')->name('transaction-point-purchases.top-up-receipt');
    Route::get('transaction-point-purchases/test', 'TransactionPointPurchaseController@calculatePersonalTopUpBonusTest')->name('transaction-point-purchases.test');
    Route::resource('transaction-point-purchases', 'TransactionPointPurchaseController');

    // New Purchase
    Route::delete('new-purchases/destroy', 'NewPurchaseController@massDestroy')->name('new-purchases.massDestroy');
    Route::resource('new-purchases', 'NewPurchaseController');

    // Verified Purchase
    Route::delete('verified-purchases/destroy', 'VerifiedPurchaseController@massDestroy')->name('verified-purchases.massDestroy');
    Route::resource('verified-purchases', 'VerifiedPurchaseController');

    // Failed Purchase
    Route::delete('failed-purchases/destroy', 'FailedPurchaseController@massDestroy')->name('failed-purchases.massDestroy');
    Route::resource('failed-purchases', 'FailedPurchaseController');

    // Permissions Group
    Route::delete('permissions-groups/destroy', 'PermissionsGroupController@massDestroy')->name('permissions-groups.massDestroy');
    Route::resource('permissions-groups', 'PermissionsGroupController');

    // Point Balance
    Route::delete('point-balances/destroy', 'PointBalanceController@massDestroy')->name('point-balances.massDestroy');
    Route::post('point-balances/export', 'PointBalanceController@export')->name('point-balances.export');
    Route::resource('point-balances', 'PointBalanceController');

    // Ranking
    Route::delete('rankings/destroy', 'RankingController@massDestroy')->name('rankings.massDestroy');
    Route::resource('rankings', 'RankingController');

    // Bonus Join
    Route::delete('bonus-joins/destroy', 'BonusJoinController@massDestroy')->name('bonus-joins.massDestroy');
    Route::resource('bonus-joins', 'BonusJoinController');

    // Bonus Top Up Group
    Route::delete('bonus-top-up-groups/destroy', 'BonusTopUpGroupController@massDestroy')->name('bonus-top-up-groups.massDestroy');
    Route::resource('bonus-top-up-groups', 'BonusTopUpGroupController');

    // Bonus Top Up Personal
    Route::delete('bonus-top-up-personals/destroy', 'BonusTopUpPersonalController@massDestroy')->name('bonus-top-up-personals.massDestroy');
    Route::resource('bonus-top-up-personals', 'BonusTopUpPersonalController');

    // Bonus VIP
    Route::delete('bonus-vip/destroy', 'BonusVIPController@massDestroy')->name('bonus-vip.massDestroy');
    Route::resource('bonus-vip', 'BonusVIPController');

    // Bonus Team Car
    Route::put('bonus-team-car/{bonus_team_car}', 'BonusTeamCarController@update')->name('bonus-team-car.update');

    // Bonus Team House
    Route::put('bonus-team-house/{bonus_team_house}', 'BonusTeamHouseController@update')->name('bonus-team-house.update');

    // Bonus First Upline
    Route::delete('bonus-first-upline/destroy', 'BonusFirstUplineController@massDestroy')->name('bonus-first-upline.massDestroy');
    Route::get('bonus-first-upline/edit', 'BonusFirstUplineController@edit')->name('bonus-first-upline.edit');
    Route::post('bonus-first-upline/update', 'BonusFirstUplineController@update')->name('bonus-first-upline.update');
    Route::resource('bonus-first-upline', 'BonusFirstUplineController', ['except' => ['edit', 'update']]);

    // Transaction Agent Top Up
    Route::delete('transaction-agent-top-ups/destroy', 'TransactionAgentTopUpController@massDestroy')->name('transaction-agent-top-ups.massDestroy');
    Route::post('transaction-agent-top-ups/media', 'TransactionAgentTopUpController@storeMedia')->name('transaction-agent-top-ups.storeMedia');
    Route::post('transaction-agent-top-ups/ckmedia', 'TransactionAgentTopUpController@storeCKEditorImages')->name('transaction-agent-top-ups.storeCKEditorImages');
    Route::get('transaction-agent-top-ups/new', 'TransactionAgentTopUpController@index')->name('transaction-agent-top-ups.new');
    Route::get('transaction-agent-top-ups/approved', 'TransactionAgentTopUpController@index')->name('transaction-agent-top-ups.approved');
    Route::get('transaction-agent-top-ups/rejected', 'TransactionAgentTopUpController@index')->name('transaction-agent-top-ups.rejected');
    Route::get('transaction-agent-top-ups/manual', 'TransactionAgentTopUpController@manual')->name('transaction-agent-top-ups.manual');
    Route::post('transaction-agent-top-ups/manual', 'TransactionAgentTopUpController@manualTopup')->name('transaction-agent-top-ups.manual-topup');

    // Route::get('transaction-agent-top-ups/manual-without-point', 'TransactionAgentTopUpController@manualWithoutPoint')->name('transaction-agent-top-ups.manual-without-point');
    // Route::post('transaction-agent-top-ups/manual-without-point', 'TransactionAgentTopUpController@manualTopupWithoutPoint')->name('transaction-agent-top-ups.manual-topup-without-point');

    Route::resource('transaction-agent-top-ups', 'TransactionAgentTopUpController');

    // User Agreement
    Route::delete('user-agreements/destroy', 'UserAgreementController@massDestroy')->name('user-agreements.massDestroy');
    Route::post('user-agreements/media', 'UserAgreementController@storeMedia')->name('user-agreements.storeMedia');
    Route::post('user-agreements/ckmedia', 'UserAgreementController@storeCKEditorImages')->name('user-agreements.storeCKEditorImages');
    Route::resource('user-agreements', 'UserAgreementController');

    // User Entry
    Route::delete('user-entries/destroy', 'UserEntryController@massDestroy')->name('user-entries.massDestroy');
    Route::get('user-entries/deposit/receipt/{id}', 'UserEntryController@depositPrintReceipt')->name('user-entries.desposit-receipt');
    Route::get('user-entries/fee/invoice/{id}', 'UserEntryController@feePrintInvoice')->name('user-entries.fee-invoice');
    Route::resource('user-entries', 'UserEntryController');

    // Bonus Personal
    Route::delete('bonus-personals/destroy', 'BonusPersonalController@massDestroy')->name('bonus-personals.massDestroy');
    Route::resource('bonus-personals', 'BonusPersonalController');

    // Bonus Group
    Route::delete('bonus-groups/destroy', 'BonusGroupController@massDestroy')->name('bonus-groups.massDestroy');
    Route::resource('bonus-groups', 'BonusGroupController');

    // Point Transaction Log
    Route::delete('point-transaction-logs/destroy', 'PointTransactionLogController@massDestroy')->name('point-transaction-logs.massDestroy');
    Route::resource('point-transaction-logs', 'PointTransactionLogController');

    // Bonus Ref
    Route::delete('bonus-refs/destroy', 'BonusRefController@massDestroy')->name('bonus-refs.massDestroy');
    Route::resource('bonus-refs', 'BonusRefController');

    // Bonus Restock
    Route::delete('bonus-restocks/destroy', 'BonusRestockController@massDestroy')->name('bonus-restocks.massDestroy');
    Route::resource('bonus-restocks', 'BonusRestockController');

    // Bonus Annual Personal
    Route::delete('bonus-annual-personals/destroy', 'BonusAnnualPersonalController@massDestroy')->name('bonus-annual-personals.massDestroy');
    Route::resource('bonus-annual-personals', 'BonusAnnualPersonalController');

    // Bonus Annual Group
    Route::delete('bonus-annual-groups/destroy', 'BonusAnnualGroupController@massDestroy')->name('bonus-annual-groups.massDestroy');
    Route::resource('bonus-annual-groups', 'BonusAnnualGroupController');

    // Agent Agreement
    Route::delete('agent-agreements/destroy', 'AgentAgreementController@massDestroy')->name('agent-agreements.massDestroy');
    Route::resource('agent-agreements', 'AgentAgreementController');

    // Merchant Agreement
    Route::delete('merchant-agreements/destroy', 'MerchantAgreementController@massDestroy')->name('merchant-agreements.massDestroy');
    Route::resource('merchant-agreements', 'MerchantAgreementController');

    // Product Variant
    Route::delete('product-variants/destroy', 'ProductVariantController@massDestroy')->name('product-variants.massDestroy');
    Route::get('product-variants/create/{id}', 'ProductVariantController@create')->name('product-variants.create');
    Route::post('product-variants/media', 'ProductVariantController@storeMedia')->name('product-variants.storeMedia');
    Route::post('product-variants/ckmedia', 'ProductVariantController@storeCKEditorImages')->name('product-variants.storeCKEditorImages');
    Route::post('product-variants/status-change', 'ProductVariantController@statusChange')->name('product-variants.status-change');
    Route::resource('product-variants', 'ProductVariantController', ['except' => ['index','create']]);

    // Product Color
    Route::delete('product-colors/destroy', 'ProductColorController@massDestroy')->name('product-colors.massDestroy');
    Route::post('product-color/change_status', 'ProductColorController@changeStatus')->name('product-colors.change-status');
    Route::resource('product-colors', 'ProductColorController');

    // Product Size
    Route::delete('product-sizes/destroy', 'ProductSizeController@massDestroy')->name('product-sizes.massDestroy');
    Route::post('product-sizes/change_status', 'ProductSizeController@changeStatus')->name('product-sizes.change-status');
    Route::resource('product-sizes', 'ProductSizeController');

    // Cart
    Route::delete('carts/destroy', 'CartController@massDestroy')->name('carts.massDestroy');
    Route::post('carts/fetch_address_book', 'CartController@fetchAddressBook')->name('carts.fetch.addressBook');
    Route::post('carts/fetch_cart', 'CartController@fetchCart')->name('carts.fetch.cart');
    Route::resource('carts', 'CartController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::get('orders/new', 'OrderController@index')->name('orders.new');
    Route::get('orders/shipped', 'OrderController@index')->name('orders.shipped');
    Route::get('orders/picked-up', 'OrderController@index')->name('orders.picked-up');
    Route::get('orders/completed', 'OrderController@index')->name('orders.completed');
    Route::get('orders/cancelled', 'OrderController@index')->name('orders.cancelled');
    Route::get('orders/{id}/to-ship', 'OrderController@toShip')->name('orders.to-ship');
    Route::post('orders/to-ship', 'OrderController@confirmShip')->name('orders.confirm-ship');
    Route::post('orders/to-cancel', 'OrderController@toCancel')->name('orders.to-cancel');
    Route::post('orders/to-complete', 'OrderController@toComplete')->name('orders.to-complete');
    Route::post('orders/{id}/ready-to-pick', 'OrderController@readyToPick')->name('orders.ready-to-pick');
    Route::post('orders/to-pick-up', 'OrderController@toPickUp')->name('orders.to-pick-up');
    Route::post('orders/add-product', 'OrderController@orderAddProduct')->name('orders.add-product');
    Route::post('orders/release-product', 'OrderController@orderReleaseProduct')->name('orders.release-product');
    Route::post('orders/damage-product', 'OrderController@orderDamageProduct')->name('orders.damage-product');
    Route::post('orders/remove-product', 'OrderController@orderRemoveProduct')->name('orders.remove-product');
    Route::get('orders/order-invoice/{id}', 'OrderController@orderInvoicePdf')->name('orders.invoice-pdf');
    // Route::get('orders/mbr-order-invoice/{id}', 'OrderController@orderMBRInvoicePdf')->name('orders.mbr-invoice-pdf');
    Route::any('orders/add-order_item/{id}', 'OrderController@orderAddOrderItem')->name('orders.add-order-item');
    Route::get('orders/test', 'OrderController@test')->name('orders.test');
    Route::resource('orders', 'OrderController');

    // Order Item
    Route::delete('order-items/destroy', 'OrderItemController@massDestroy')->name('order-items.massDestroy');
    Route::resource('order-items', 'OrderItemController');

    // Bonus Self Topup
    Route::delete('bonus-self-topups/destroy', 'BonusSelfTopupController@massDestroy')->name('bonus-self-topups.massDestroy');
    Route::resource('bonus-self-topups', 'BonusSelfTopupController');

    // Bonus Team Topup
    Route::delete('bonus-team-topups/destroy', 'BonusTeamTopupController@massDestroy')->name('bonus-team-topups.massDestroy');
    Route::resource('bonus-team-topups', 'BonusTeamTopupController');

    // Point Bonus Balance
    Route::delete('point-bonus-balances/destroy', 'PointBonusBalanceController@massDestroy')->name('point-bonus-balances.massDestroy');
    Route::post('point-bonus-balances/export', 'PointBonusBalanceController@export')->name('point-bonus-balances.export');
    Route::resource('point-bonus-balances', 'PointBonusBalanceController');

    // Deposit Bank
    Route::delete('deposit-banks/destroy', 'DepositBankController@massDestroy')->name('deposit-banks.massDestroy');
    Route::post('deposit-banks/change_status', 'DepositBankController@changeStatus')->name('deposit-banks.change-status');
    Route::resource('deposit-banks', 'DepositBankController');

    // State
    Route::delete('states/destroy', 'StateController@massDestroy')->name('states.massDestroy');
    Route::post('states/change_status', 'StateController@changeStatus')->name('states.change-status');
    Route::resource('states', 'StateController');

    // Shipping Fee
    Route::delete('shipping-fees/destroy', 'ShippingFeeController@massDestroy')->name('shipping-fees.massDestroy');
    Route::post('shipping-fees/change_status', 'ShippingFeeController@changeStatus')->name('shipping-fees.change-status');
    Route::resource('shipping-fees', 'ShippingFeeController');

    // Transaction Bonus Given
    Route::delete('transaction-bonus-givens/destroy', 'TransactionBonusGivenController@massDestroy')->name('transaction-bonus-givens.massDestroy');
    Route::get('transaction-bonus-givens/referral', 'TransactionBonusGivenController@index')->name('transaction-bonus-givens.referral');
    Route::get('transaction-bonus-givens/personal-topup', 'TransactionBonusGivenController@index')->name('transaction-bonus-givens.personal-topup');
    Route::get('transaction-bonus-givens/team-topup', 'TransactionBonusGivenController@index')->name('transaction-bonus-givens.team-topup');
    Route::get('transaction-bonus-givens/personal-annual', 'TransactionBonusGivenController@index')->name('transaction-bonus-givens.personal-annual');
    Route::get('transaction-bonus-givens/team-annual', 'TransactionBonusGivenController@index')->name('transaction-bonus-givens.team-annual');
    Route::post('transaction-bonus-givens/export', 'TransactionBonusGivenController@export')->name('transaction-bonus-givens.export');
    Route::resource('transaction-bonus-givens', 'TransactionBonusGivenController');

    // Voucher Balance
    Route::delete('voucher-balances/destroy', 'VoucherBalanceController@massDestroy')->name('voucher-balances.massDestroy');
    Route::post('voucher-balances/export', 'VoucherBalanceController@export')->name('voucher-balances.export');
    Route::resource('voucher-balances', 'VoucherBalanceController');

    // Shipping Balance
    Route::delete('shipping-balances/destroy', 'ShippingBalanceController@massDestroy')->name('shipping-balances.massDestroy');
    Route::post('shipping-balances/export', 'ShippingBalanceController@export')->name('shipping-balances.export');
    Route::resource('shipping-balances', 'ShippingBalanceController');

    // User Agreement Log
    Route::delete('user-agreement-logs/destroy', 'UserAgreementLogController@massDestroy')->name('user-agreement-logs.massDestroy');
    Route::resource('user-agreement-logs', 'UserAgreementLogController');

    // Discount
    Route::delete('discounts/destroy', 'DiscountController@massDestroy')->name('discounts.massDestroy');
    Route::resource('discounts', 'DiscountController');

    // User Upgrade
//    Route::delete('user-upgrades/destroy', 'UserUpgradeController@massDestroy')->name('user-upgrades.massDestroy');
    Route::get('new-user-upgrades', 'UserUpgradeController@userUpgradeNewListing')->name('user-upgrades.new-listing');
    Route::get('new-user-upgrades/pending', 'UserUpgradeController@userUpgradeNewListing')->name('user-upgrades.new-listing.pending');
    Route::post('user-upgrades/approve-reject', 'UserUpgradeController@upgradeApproveReject')->name('user-upgrades.approve-reject');
//    Route::post('user-upgrades/ckmedia', 'UserUpgradeController@storeCKEditorImages')->name('user-upgrades.storeCKEditorImages');
//    Route::resource('user-upgrades', 'UserUpgradeController');

    // Shipping Package
    Route::delete('shipping-packages/destroy', 'ShippingPackageController@massDestroy')->name('shipping-packages.massDestroy');
    Route::post('shipping-packages/change_status', 'ShippingPackageController@changeStatus')->name('shipping-packages.change-status');
    Route::resource('shipping-packages', 'ShippingPackageController');

    // Transaction Shipping Purchase
    Route::delete('transaction-shipping-purchases/destroy', 'TransactionShippingPurchaseController@massDestroy')->name('transaction-shipping-purchases.massDestroy');
    Route::post('transaction-shipping-purchases/media', 'TransactionShippingPurchaseController@storeMedia')->name('transaction-shipping-purchases.storeMedia');
    Route::post('transaction-shipping-purchases/ckmedia', 'TransactionShippingPurchaseController@storeCKEditorImages')->name('transaction-shipping-purchases.storeCKEditorImages');
    Route::get('transaction-shipping-purchases/new', 'TransactionShippingPurchaseController@index')->name('transaction-shipping-purchases.new');
    Route::get('transaction-shipping-purchases/verified', 'TransactionShippingPurchaseController@index')->name('transaction-shipping-purchases.verified');
    Route::get('transaction-shipping-purchases/failed', 'TransactionShippingPurchaseController@index')->name('transaction-shipping-purchases.failed');
    Route::post('transaction-shipping-purchases/to-verify', 'TransactionShippingPurchaseController@toVerify')->name('transaction-shipping-purchases.to-verify');
    Route::post('transaction-shipping-purchases/to-reject', 'TransactionShippingPurchaseController@toReject')->name('transaction-shipping-purchases.to-reject');
    Route::get('transaction-shipping-purchases/top-up-pdf/{id}', 'TransactionShippingPurchaseController@transactionShippingPurchaseReceiptPDF')->name('transaction-shipping-purchases.top-up-receipt');
    Route::resource('transaction-shipping-purchases', 'TransactionShippingPurchaseController');

    // Point Manager Balance
    Route::delete('point-manager-balances/destroy', 'PointManagerBalanceController@massDestroy')->name('point-manager-balances.massDestroy');
    Route::post('point-manager-balances/export', 'PointManagerBalanceController@export')->name('point-manager-balances.export');
    Route::resource('point-manager-balances', 'PointManagerBalanceController');

    // Point Executive Balance
    Route::delete('point-executive-balances/destroy', 'PointExecutiveBalanceController@massDestroy')->name('point-executive-balances.massDestroy');
    Route::post('point-executive-balances/export', 'PointExecutiveBalanceController@export')->name('point-executive-balances.export');
    Route::resource('point-executive-balances', 'PointExecutiveBalanceController');

    // Bonus Setting
    Route::delete('bonus-settings/destroy', 'BonusSettingController@massDestroy')->name('bonus-settings.massDestroy');
    Route::resource('bonus-settings', 'BonusSettingController');

    // Pick Up Location
    Route::delete('pick-up-locations/destroy', 'PickUpLocationController@massDestroy')->name('pick-up-locations.massDestroy');
    Route::resource('pick-up-locations', 'PickUpLocationController');

    // Withdraw Excel
    Route::delete('withdraw-excels/destroy', 'WithdrawExcelController@massDestroy')->name('withdraw-excels.massDestroy');
    Route::post('withdraw-excels/media', 'WithdrawExcelController@storeMedia')->name('withdraw-excels.storeMedia');
    Route::post('withdraw-excels/ckmedia', 'WithdrawExcelController@storeCKEditorImages')->name('withdraw-excels.storeCKEditorImages');
    Route::resource('withdraw-excels', 'WithdrawExcelController');

    // Voucher Log
    Route::delete('voucher-logs/destroy', 'VoucherLogController@massDestroy')->name('voucher-logs.massDestroy');
    Route::post('voucher-logs/export', 'VoucherLogController@export')->name('voucher-logs.export');
    Route::resource('voucher-logs', 'VoucherLogController');

    // Cash Voucher Balance
    Route::delete('cash-voucher-balances/destroy', 'CashVoucherBalanceController@massDestroy')->name('cash-voucher-balances.massDestroy');
    Route::post('cash-voucher-balances/export', 'CashVoucherBalanceController@export')->name('cash-voucher-balances.export');
    Route::resource('cash-voucher-balances', 'CashVoucherBalanceController');

    // Pv Balance
    Route::delete('pv-balances/destroy', 'PvBalanceController@massDestroy')->name('pv-balances.massDestroy');
    Route::post('pv-balances/export', 'PvBalanceController@export')->name('pv-balances.export');
    Route::resource('pv-balances', 'PvBalanceController');

    Route::get('document/rearrange-invoice', 'DocumentManagementController@rearrangeInvoice')->name('document.rearrange.invoice');
    Route::get('document/rearrange-receipt', 'DocumentManagementController@rearrangeReceipt')->name('document.rearrange.receipt');
    Route::get('document/rearrange-shipping-invoice', 'DocumentManagementController@rearrangeShippingInvoice')->name('document.rearrange.shipping.invoice');
    Route::get('document/rearrange-payment-voucher', 'DocumentManagementController@rearrangePaymentVoucher')->name('document.rearrange.payment.voucher');
    Route::get('document/rearrange-mbr-invoice', 'DocumentManagementController@rearrangeMBRInvoice')->name('document.rearrange.mbr.invoice');

    // One Time Use Controlller (Hidden Route)
    Route::get('one-time-use', 'OneTimeUsageController@index')->name('one-time-use');
    Route::post('one-time-use/update-sign-required', 'OneTimeUsageController@updateSignRequired')->name('one-time-use.update-sign-required');
    Route::post('one-time-use/update-b2b-sign-required', 'OneTimeUsageController@updateB2BSignRequired')->name('one-time-use.update-b2b-sign-required');
    Route::post('one-time-use/give-upline2-bonus', 'OneTimeUsageController@giveUpline2Bonus')->name('one-time-use.give-bonus2-bonus');
    Route::post('one-time-use/give-user-upgrade-first-upline-bonus', 'OneTimeUsageController@giveUserUpgradeUpline1and2Bonus')->name('one-time-use.give-user-upgrade-first-upline-bonus');
    Route::post('one-time-use/store-user-upline-preserve-log', 'OneTimeUsageController@storeUplinePreserveLog')->name('one-time-use.store-user-upline-preserve-log');


    // Cron Job Controller (8/1/2022) (New Business Model)
    Route::get('cronjob/upgrade-millionaire-leader-status', 'CronJobController@upgradeMillionaireLeaderStatus')->name('cronjob.upgrade-millionaire-leader-status');
    Route::get('cronjob/team-car-and-house-bonus', 'CronJobController@teamCarAndHouseBonus')->name('cronjob.team-car-and-house-bonus');
    Route::get('cronjob/referral-bonus-first-generation', 'CronJobController@referralBonusFirstGeneration')->name('cronjob.referral-bonus-first-generation');
    Route::get('cronjob/topup-bonus-first-generation', 'CronJobController@topUpBonusFirstGeneration')->name('cronjob.topup-bonus-first-generation');
    Route::get('cronjob/onhold-topup-bonus-first-generation', 'CronJobController@onHoldTopUpBonusFirstGeneration')->name('cronjob.onhold-topup-bonus-first-generation');


});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Admin\Auth', 'middleware' => ['auth:admin']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Admin/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::get('/', 'LandingController@home')->name('landing.home');
Route::get('/our-product', 'LandingController@product')->name('landing.product');
Route::post('/product-list', 'LandingController@productList')->name('landing.product-list');
Route::get('/product/{id}', 'LandingController@productDetails')->name('landing.product-details');
Route::post('/getSizeVariant', 'LandingController@getSizeVariant')->name('landing.product-size-variant');
Route::post('/getQtyVariant', 'LandingController@getQtyVariant')->name('landing.product-qty-variant');
Route::get('/about-us', 'LandingController@about_us')->name('landing.aboutUs');
Route::get('/our-service', 'LandingController@ourService')->name('landing.our-service');
Route::get('/investment-relation', 'LandingController@investmentRelation')->name('landing.investment-relation');
Route::get('/faq', 'LandingController@faq')->name('landing.faq');
Route::get('/join-us', 'LandingController@join_us')->name('landing.joinUs');
Route::get('/product-qr-check', 'LandingController@product_qr_check')->name('landing.productQRCheck');
Route::post('/product-qr-check', 'LandingController@product_qr_check_action')->name('landing.productQRCheckAction');
Route::get('/contact-us', 'LandingController@contact_us')->name('landing.contactUs');
//Route::get('/contact-us-action', 'LandingController@contactUsAction')->name('contactUs-action');
Route::get('/privacy-policy', 'LandingController@privacyPolicy')->name('landing.privacy-policy');
Route::get('/terms-of-use', 'LandingController@termsOfUse')->name('landing.terms-of-use');
Route::get('/delivery-policy', 'LandingController@deliveryPolicy')->name('landing.delivery-policy');
Route::get('/refund-return-policy', 'LandingController@refundReturnPolicy')->name('landing.refund-return-policy');

Route::group([ 'namespace' => 'User'], function() {
    Auth::routes();
    Route::post('/password/send-otp', 'Auth\ResetPasswordController@sendOTPFromEmail')->name('password.send-otp-from-email');
    Route::post('/password/verify-otp', 'Auth\ResetPasswordController@verifyOTP')->name('password.verifyOTP');
    Route::post('/user/media', 'Auth\RegisterController@storeMedia')->name('user.storeMedia');

    Route::post('/states', 'Auth\RegisterController@getStates')->name('user.getStates');
});

Route::get('/payment/return-url', 'User\PaymentController@paymentReturn');
Route::post('/payment/callback-url', 'User\PaymentController@paymentCallback')->withoutMiddleware(VerifyCsrfToken::class);

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth:user']], function () {

    Route::get('/agreement', 'Auth\RegisterController@showAgreement')->name('register-agreement');
    Route::post('/agreement', 'Auth\RegisterController@agreeAgreement')->name('register-agreement-action');

    Route::get('/register-otp', 'Auth\VerifyOTPController@showRegistrationOTPForm')->name('registerOTP');
    Route::post('/send-otp', 'Auth\VerifyOTPController@sendOTP')->name('sendOTP');
    Route::post('/verify-otp', 'Auth\VerifyOTPController@verifyOTP')->name('verifyOTP');
    Route::get('/register-complete', 'Auth\RegisterController@registrationComplete')->name('registerComplete');

    Route::get('/register-vip', 'Auth\RegisterController@showRegisterVIPForm')->name('registerVipForm');
    Route::post('/register-vip-submit', 'Auth\RegisterController@registerVIP')->name('registerVip');

    Route::get('/upgrade-vip-executive',     'UserUpgradeController@upgradeAccountExecutiveShow')->name('upgrade-account-executive-form'); // only for VIP used
    Route::post('/upgrade-vip-executive-submit',     'UserUpgradeController@upgradeAccountExecutive')->name('upgrade-account-executive'); // only for VIP used

    Route::redirect('/home', '/');
    Route::get('/',     'HomeController@home')->name('home');
    Route::get('/edit',     'HomeController@editProfile')->name('edit-profile');
    Route::post('/edit',     'HomeController@updateProfile')->name('update-profile');
    Route::get('/view-agreement',     'HomeController@viewAgreement')->name('view-agreement');
    Route::get('/upgrade-account-select',     'UserUpgradeController@upgradeAccountSelect')->name('upgrade-account-select');
    Route::get('/upgrade-account/{type}',     'UserUpgradeController@upgradeAccount')->name('upgrade-account');
    Route::post('/upgrade-account-manager',     'UserUpgradeController@upgradeAccountManager')->name('upgrade-account-manager');
    Route::post('/upgrade-account-executive',     'UserUpgradeController@upgradeAccountExecutive2')->name('upgrade-account-executive2');
    Route::post('/upgrade-account-millionaire2',     'UserUpgradeController@upgradeAccountMillionaire')->name('upgrade-account-millionaire-old');
    Route::post('/upgrade-account-millionaire',     'UserUpgradeController@upgradeAccountMillionaireNew')->name('upgrade-account-millionaire');
    Route::get('/upgrade-account-complete',     'UserUpgradeController@upgradeComplete')->name('upgrade-account-complete');
    Route::get('/upgrade-account-failed',     'UserUpgradeController@upgradeFailed')->name('upgrade-account-failed');

    Route::get('/my-point', 'PointController@myPoint')->name('my-point');
    Route::get('/point-history', 'PointController@pointHistory')->name('my-point.point-history');
    Route::get('/point-history-manager', 'PointController@pointHistory')->name('my-point.point-history-manager');
    Route::get('/point-history-executive', 'PointController@pointHistory')->name('my-point.point-history-executive');

    Route::get('/top-up-executive', 'TopUpController@topUpExecutive')->name('top-up-executive'); //to executive wallet
    Route::get('/top-up-manager', 'TopUpController@topUpManager')->name('top-up-manager'); //to manager wallet
    Route::get('/top-up-millionaire', 'TopUpController@topUpMillionaire')->name('top-up-millionaire'); //to millionaire wallet

    Route::get('/top-up-checkout-executive/{id}', 'TopUpController@topUpCheckOut')->name('top-up.checkout-executive');
    Route::get('/top-up-checkout-manager/{id}', 'TopUpController@topUpCheckOut')->name('top-up.checkout-manager');

    Route::get('/top-up-history-manager', 'TopUpController@topUpHistory')->name('top-up-history-manager');
    Route::get('/top-up-history-executive', 'TopUpController@topUpHistory')->name('top-up-history-executive');
    Route::get('/top-up-history', 'TopUpController@topUpHistory')->name('top-up-history');
    Route::get('/top-up-pdf/{id}', 'TopUpController@topupReceiptPDF')->name('top-up-print-receipt');
    Route::get('/top-up-checkout/{id}', 'TopUpController@topUpCheckOut')->name('top-up.checkout');
    Route::post('/top-up-payment', 'TopUpController@topUpPayment')->name('top-up.payment');
    Route::post('/top-up-complete', 'TopUpController@topUpComplete')->name('top-up-complete');
    Route::get('/top-up-failed', 'TopUpController@topUpFailed')->name('top-up-failed');

    Route::get('/withdraw', 'WithdrawController@withdraw')->name('withdraw');
    Route::get('/withdraw-history', 'WithdrawController@withdrawHistory')->name('withdraw-history');
    Route::get('/withdraw-confirmation', 'WithdrawController@withdrawConfirmation')->name('withdraw.confirmation');
    Route::post('/withdraw-confirm', 'WithdrawController@withdrawConfirm')->name('withdraw.confirm');

    Route::get('/my-address-book', 'AddressBookController@index')->name('my-address-book');
    Route::get('/address-book', 'AddressBookController@getAddressBook')->name('getAddressBook');
    Route::get('/add-address', 'AddressBookController@create')->name('add-address');
    Route::post('/add-address/store', 'AddressBookController@store')->name('add-address.store');
    Route::get('/edit-address/{id}', 'AddressBookController@edit')->name('edit-address');
    Route::post('/update-address/{address_book}', 'AddressBookController@update')->name('update-address');
    Route::post('/set-as-default/{id}', 'AddressBookController@setAsDefault')->name('set-default-address');

    Route::get('/point-requests', 'PointController@pointRequests')->name('point-requests');
    Route::get('/proceed-point-request/{id}', 'PointController@proceedPointRequest')->name('proceed-point-request');
    Route::post('/point-transfer/{id}', 'PointController@pointTransfer')->name('point-transfer');
    Route::post('/point-transfer-reject/{id}', 'PointController@pointTransferReject')->name('point-transfer-reject');

    Route::get('/my-bonus', 'BonusController@myBonus')->name('my-bonus');
    Route::post('/bonus-member-list/{level}', 'BonusController@bonusMemberList')->name('bonus-member-list');
    Route::get('/bonus-point-history', 'BonusController@pointBonusHistory')->name('bonus-history');
    Route::get('/point-convert', 'PointController@showPointConvert')->name('point-convert-show');
    Route::post('/confirm-point-convert', 'PointController@pointConvert')->name('point-convert');
    Route::get('/point-convert-history', 'PointController@pointConvertHistory')->name('point-convert-history');
    Route::get('/shop',     'ShopController@shop')->name('shop');
    Route::get('/shop-redeem',     'ShopController@shopRedeem')->name('shop-redeem');
    Route::post('/product-list',     'ShopController@productList')->name('product-list');
    Route::get('/product-details/{id}',     'ShopController@productDetails')->name('product-details');
    Route::get('/redeem-product-details/{id}',     'ShopController@redeemProductDetails')->name('redeem-product-details');
    Route::post('/getSizeVariant',     'ShopController@getSizeVariant')->name('product-size-variant');
    Route::post('/getQtyVariant', 'ShopController@getQtyVariant')->name('product-qty-variant');
    Route::post('/add-to-cart', 'ShopController@addToCart')->name('product-add-to-cart');

    Route::get('/cart',     'OrderController@showCart2')->name('cart');
    Route::get('/cart2',     'OrderController@showCart')->name('cart2');
    Route::get('/checkout',     'OrderController@showCheckout')->name('cart.show.checkout');
    Route::get('/redeem-cart',     'OrderController@showRedeemCart')->name('redeem-cart');
    Route::post('/cart-update-quantity',     'OrderController@cartUpdateQuantity')->name('cart.update-quantity');
    Route::post('/checkout',     'OrderController@checkout')->name('cart.checkout');
    Route::post('/checkout-redeem',     'OrderController@checkoutRedeem')->name('cart.checkout-redeem');
    Route::get('/confirm-order',     'OrderController@confirmOrder')->name('confirm-order');
    Route::get('/confirm-order-redeem',     'OrderController@confirmOrderRedeem')->name('confirm-order-redeem');
    Route::get('/purchase-success',     'OrderController@purchaseSuccess')->name('purchase-success');
    Route::get('/purchase-success-redeem',     'OrderController@purchaseSuccessRedeem')->name('purchase-success-redeem');
    Route::post('/getShippingFee',     'OrderController@getShippingFee')->name('get-shipping-fee')->withoutMiddleware(VerifyCsrfToken::class);

    Route::get('/my-order', 'OrderController@myOrder')->name('my-order');
    Route::get('/order-details/{id}', 'OrderController@orderDetails')->name('order-details');
    Route::get('/order-print-invoice/{id}', 'OrderController@orderReceiptPDF')->name('order-invoice-print');
    Route::get('/tracking-order/{id}', 'OrderController@trackingOrder')->name('order-tracking');

    Route::get('/downline', 'MemberController@downline')->name('downline-index');
    Route::get('/downline/index', 'MemberController@index')->name('downline');
    Route::get('/downline/details/{id}', 'MemberController@downlineDetails')->name('downline-details');
    Route::get('/downline/downlines/{id}', 'MemberController@downlineDetailsDownline')->name('downline-dl');
    Route::get('/downlines/{id}', 'MemberController@downlineDownlines')->name('downline-downlines');
    Route::get('/deposit/print/{id}', 'MemberController@depositPrintReceipt')->name('deposit-print-receipt');
    Route::get('/join-fee/print', 'MemberController@joinFeePrintReceipt')->name('join-fee-print-receipt');

    Route::get('/upgrade-account-view/{id}',     'UserUpgradeController@viewUpgradeAccount')->name('view-upgrade-account');
    Route::post('/upgrade-account-action/{id}',     'UserUpgradeController@upgradeAccountManagerAction')->name('upgrade-account-manager-action');
    Route::post('/upgrade-account-reject/{id}',     'UserUpgradeController@upgradeAccountManagerReject')->name('upgrade-account-manager-reject');
    Route::get('/member-tree', 'HomeController@memberTree')->name('member-tree');

    Route::get('/shipping', 'ShippingController@view')->name('shipping');
    Route::get('/shipping-checkout/{id}', 'ShippingController@checkout')->name('shipping.checkout');
    Route::post('/shipping-payment', 'ShippingController@payment')->name('shipping.payment');
    Route::get('/shipping-history', 'ShippingController@history')->name('shipping-point-history');
    Route::get('/shipping-complete', 'ShippingController@complete')->name('shipping-complete');
    Route::get('/shipping-failed', 'ShippingController@failed')->name('shipping-failed');
    Route::get('/shipping-pdf/{id}', 'ShippingController@shippingInvoicePDF')->name('shipping-print-receipt');

    Route::get('/bank-setting', 'BankController@bankSetting')->name('bank-setting');
    Route::post('/bank-setting/submit', 'BankController@bankUpdate')->name('bank-setting.submit');

    Route::get('/password', 'Auth\ChangePasswordController@edit')->name('password.edit');
    Route::post('/password-update', 'Auth\ChangePasswordController@update')->name('password.update');

    Route::get('/view-finance', 'FinanceController@view')->name('finance.view');


    // For Manager and Executive who account created before 12/07/2022
    Route::get('/new-agreement-form', 'Auth\LoginController@showNewAgreementForm')->name('new-agreement-form');
    Route::get('/renew-agreement-form', 'Auth\LoginController@showRenewAgreementForm')->name('renew-agreement-form');
    Route::get('/quit-agreement-form', 'Auth\LoginController@showQuitAgreementForm')->name('quit-agreement-form');
    Route::post('/sign-new-agreement', 'Auth\LoginController@signNewAgreement')->name('sign-new-agreement-form');
    Route::post('/sign-renew-agreement', 'Auth\LoginController@signRenewAgreement')->name('sign-renew-agreement-form');
    Route::post('/sign-quit-agreement', 'Auth\LoginController@signQuitAgreement')->name('sign-quit-agreement-form');

});
