<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // Banner
    Route::post('banners/media', 'BannerApiController@storeMedia')->name('banners.storeMedia');
    Route::apiResource('banners', 'BannerApiController');

    // Bank List
    Route::apiResource('bank-lists', 'BankListApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Product Category
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Otp Log
    Route::apiResource('otp-logs', 'OtpLogApiController');

    // Product Batch
    Route::apiResource('product-batches', 'ProductBatchApiController');

    // Payout Limit
    Route::apiResource('payout-limits', 'PayoutLimitApiController');

    // Announcement
    Route::post('announcements/media', 'AnnouncementApiController@storeMedia')->name('announcements.storeMedia');
    Route::apiResource('announcements', 'AnnouncementApiController');

    // Product Quantity
    Route::apiResource('product-quantities', 'ProductQuantityApiController');

    // Point Convert
    Route::apiResource('point-converts', 'PointConvertApiController');

    // Points
    Route::apiResource('points', 'PointsApiController');

    // Enquiry
    Route::apiResource('enquiries', 'EnquiryApiController');

    // Enquiry Reply
    Route::apiResource('enquiry-replies', 'EnquiryReplyApiController');

    // Payment Method
    Route::apiResource('payment-methods', 'PaymentMethodApiController');

    // Point Packages
    Route::post('point-packages/media', 'PointPackagesApiController@storeMedia')->name('point-packages.storeMedia');
    Route::apiResource('point-packages', 'PointPackagesApiController');

    // Voucher
    Route::apiResource('vouchers', 'VoucherApiController');

    // Material
    Route::post('materials/media', 'MaterialApiController@storeMedia')->name('materials.storeMedia');
    Route::apiResource('materials', 'MaterialApiController');

    // Address Book
    Route::apiResource('address-books', 'AddressBookApiController');

    // Transaction Id Log
    Route::apiResource('transaction-id-logs', 'TransactionIdLogApiController');

    // Personal Code Log
    Route::apiResource('personal-code-logs', 'PersonalCodeLogApiController');

    // Transaction Redeem Product
    Route::apiResource('transaction-redeem-products', 'TransactionRedeemProductApiController');

    // Shipping Company
    Route::apiResource('shipping-companies', 'ShippingCompanyApiController');

    // Transaction Bonus
    Route::apiResource('transaction-bonus', 'TransactionBonusApiController');

    // Transaction Point Withdraw
    Route::post('transaction-point-withdraws/media', 'TransactionPointWithdrawApiController@storeMedia')->name('transaction-point-withdraws.storeMedia');
    Route::apiResource('transaction-point-withdraws', 'TransactionPointWithdrawApiController');

    // Transaction Point Purchase
    Route::post('transaction-point-purchases/media', 'TransactionPointPurchaseApiController@storeMedia')->name('transaction-point-purchases.storeMedia');
    Route::apiResource('transaction-point-purchases', 'TransactionPointPurchaseApiController');

    // Permissions Group
    Route::apiResource('permissions-groups', 'PermissionsGroupApiController');

    // Point Balance
    Route::apiResource('point-balances', 'PointBalanceApiController');

    // Ranking
    Route::apiResource('rankings', 'RankingApiController');

    // Bonus Join
    Route::apiResource('bonus-joins', 'BonusJoinApiController');

    // Bonus Top Up Group
    Route::apiResource('bonus-top-up-groups', 'BonusTopUpGroupApiController');

    // Bonus Top Up Personal
    Route::apiResource('bonus-top-up-personals', 'BonusTopUpPersonalApiController');

    // Transaction Agent Top Up
    Route::post('transaction-agent-top-ups/media', 'TransactionAgentTopUpApiController@storeMedia')->name('transaction-agent-top-ups.storeMedia');
    Route::apiResource('transaction-agent-top-ups', 'TransactionAgentTopUpApiController');

    // User Agreement
    Route::post('user-agreements/media', 'UserAgreementApiController@storeMedia')->name('user-agreements.storeMedia');
    Route::apiResource('user-agreements', 'UserAgreementApiController');

    // User Entry
    Route::apiResource('user-entries', 'UserEntryApiController');

    // Bonus Personal
    Route::apiResource('bonus-personals', 'BonusPersonalApiController');

    // Bonus Group
    Route::apiResource('bonus-groups', 'BonusGroupApiController');

    // Point Transaction Log
    Route::apiResource('point-transaction-logs', 'PointTransactionLogApiController');
});
