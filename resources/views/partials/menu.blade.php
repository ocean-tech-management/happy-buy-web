<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">{{ trans('global.menu') }}</li>

                <li class="{{ request()->is("admin/dashboard*") ? "mm-active" : "" }}">
                    <a href="{{ route('admin.home') }}" class="waves-effect">
                        <i class="bx bx-bar-chart-alt-2"></i>
                        <span key="t-default">{{ trans('global.dashboard') }}</span>
                    </a>
                </li>

                @canany(['admin_access', 'merchant_access', 'agent_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user"></i>
                            <span key="t-dashboards">{{ trans('cruds.userManagement.title') }}
                                @if(getAllInactiveUserCount() > 0)<span class="badge rounded-pill bg-danger">{{ getAllInactiveUserCount() }}</span>@endif
                            </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            @can('admin_access')
                            <li class="{{ request()->is("admin/admins") || request()->is("admin/admins/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.admins.index") }}" key="t-saas">{{ trans('cruds.admin.title') }}</a>
                            </li>
                            @endcan
                            @can('merchant_access')
                                <li class="{{ request()->is("admin/merchants") || request()->is("admin/merchants/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.users.merchants") }}" key="t-default">{{ trans('cruds.user.fields.merchant') }}
                                        @if(getInactiveMerchantCount() > 0)<span class="badge rounded-pill bg-danger">{{ getInactiveMerchantCount() }}</span>@endif
                                    </a>
                                </li>
                            @endcan
                            @can('agent_access')
                                <li class="{{ request()->is("admin/agents") || request()->is("admin/agents/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.users.agents") }}" key="t-default">{{ trans('cruds.user.fields.agent') }}
                                        @if(getInactiveAgentCount() > 0)<span class="badge rounded-pill bg-danger">{{ getInactiveAgentCount() }}</span>@endif
                                    </a>
                                </li>
                            @endcan
                            @can('vip_access')
                            <li class="{{ request()->is("admin/vips") || request()->is("admin/vips/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.users.vips") }}" key="t-default">{{ trans('cruds.user.fields.vip') }}
                                    @if(getInactiveVIPCount() > 0)<span class="badge rounded-pill bg-danger">{{ getInactiveVIPCount() }}</span>@endif
                                </a>
                            </li>
                            @endcan
{{--                            @can('address_book_access')--}}
{{--                            <li class="{{ request()->is("admin/address-books") || request()->is("admin/address-books/*") ? "mm-active" : "" }}">--}}
{{--                                <a href="{{ route("admin.address-books.index") }}" key="t-crypto">{{ trans('cruds.addressBook.title') }}</a>--}}
{{--                            </li>--}}
{{--                            @endcan--}}
                        </ul>
                    </li>
                @endcanany
                @canany(['user_upgrade_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-upvote"></i>
                            <span key="t-dashboards">
                                {{ trans('cruds.userUpgrade.title') }}
                                @if(getNewUserUpgradeCount() > 0)<span class="badge rounded-pill bg-danger">{{ getNewUserUpgradeCount() }}</span>@endif
                            </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('user_upgrade_access')
                                <li class="{{ request()->is("admin/user-upgrades") || request()->is("admin/user-upgrades/create") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-purchases.user-upgrade") }}" key="t-default">{{ trans('cruds.userUpgrade.fields.all_upgrade') }}</a>
                                </li>
                            @endcan
                            @can('user_upgrade_access')
                                <li class="{{ request()->is("admin/user-upgrades/new") || request()->is("admin/user-upgrades/new/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-purchases.user-upgrade-new") }}" key="t-default">{{ trans('cruds.userUpgrade.fields.pending_upgrade') }}
                                        @if(getNewUserUpgradeCount() > 0)<span class="badge rounded-pill bg-danger">{{ getNewUserUpgradeCount() }}</span>@endif
                                    </a>
                                </li>
                            @endcan
                            {{--                            @can('address_book_access')--}}
                            {{--                            <li class="{{ request()->is("admin/address-books") || request()->is("admin/address-books/*") ? "mm-active" : "" }}">--}}
                            {{--                                <a href="{{ route("admin.address-books.index") }}" key="t-crypto">{{ trans('cruds.addressBook.title') }}</a>--}}
                            {{--                            </li>--}}
                            {{--                            @endcan--}}
                        </ul>
                    </li>
                @endcanany

                @canany(['user_upgrade_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-upvote"></i>
                            <span key="t-dashboards">
                                {{ trans('cruds.newUserUpgrade.title') }}
                                @if(getNewUserUpgradeCount2() > 0)<span class="badge rounded-pill bg-danger">{{ getNewUserUpgradeCount2() }}</span>@endif
                            </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('user_upgrade_access')
                                <li class="{{ request()->is("admin/new-user-upgrades") }}">
                                    <a href="{{ route("admin.user-upgrades.new-listing") }}" key="t-default">{{ trans('cruds.userUpgrade.fields.all_upgrade') }}</a>
                                </li>
                            @endcan
                            @can('user_upgrade_access')
                                <li class="{{ request()->is("admin/user-upgrades/pending") || request()->is("admin/user-upgrades/pending/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.user-upgrades.new-listing.pending") }}" key="t-default">{{ trans('cruds.userUpgrade.fields.pending_upgrade') }}
                                        @if(getNewUserUpgradeCount2() > 0)<span class="badge rounded-pill bg-danger">{{ getNewUserUpgradeCount2() }}</span>@endif
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @can('product_management_access')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cube-alt"></i>
                            <span key="t-dashboards">{{ trans('cruds.productManagement.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('product_access')
                                <li class="{{ request()->is("admin/products") || request()->is("admin/products/*") || request()->is("admin/product-variants/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.products.index") }}" key="t-default">{{ trans('cruds.product.title') }}</a>
                                </li>
                            @endcan
                                @can('product_access')
                                    <li class="{{ request()->is("admin/packageIndex") || request()->is("admin/packageIndex/*") || request()->is("admin/product-variants/*") ? "mm-active" : "" }}">
                                        <a href="{{ route("admin.products.package-index") }}" key="t-default">{{ trans('cruds.product.fields.product_package') }}</a>
                                    </li>
                                @endcan
                            @can('product_batch_access')
                                <li class="{{ request()->is("admin/product-batches") || request()->is("admin/product-batches/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.product-batches.index") }}" key="t-default">{{ trans('cruds.productBatch.title') }}</a>
                                </li>
                            @endcan
                            @can('product_check_qr_access')
                                <li class="{{ request()->is("admin/product-check-qrs") || request()->is("admin/product-check-qrs/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.product-check-qrs.index") }}" key="t-crypto">{{ trans('cruds.productCheckQr.title') }}</a>
                                </li>
                                    <li class="{{ request()->is("admin/new/product-check-qrs") || request()->is("admin/new/product-check-qrs/*") ? "mm-active" : "" }}">
                                        <a href="{{ route("admin.product-check-qrs.new") }}" key="t-crypto">{{ trans('cruds.productCheckQr.title') }} New</a>
                                    </li>
                            @endcan
{{--                            @can('product_quantity_access')--}}
{{--                                <li class="{{ request()->is("admin/product-quantities") || request()->is("admin/product-quantities/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.product-quantities.index") }}" key="t-default">{{ trans('cruds.productQuantity.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
                        </ul>
                    </li>
                @endcan

                @canany(['product_category_access', 'product_color_access', 'product_size_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cube"></i>
                            <span key="t-dashboards">{{ trans('cruds.productSetting.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('product_category_access')
                                <li class="{{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.product-categories.index") }}" key="t-default">{{ trans('cruds.productCategory.title') }}</a>
                                </li>
                            @endcan
                            @can('product_color_access')
                                <li class="{{ request()->is("admin/product-colors") || request()->is("admin/product-colors/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.product-colors.index") }}" key="t-default">{{ trans('cruds.productColor.title') }}</a>
                                </li>
                            @endcan
                            @can('product_size_access')
                                <li class="{{ request()->is("admin/product-sizes") || request()->is("admin/product-sizes/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.product-sizes.index") }}" key="t-default">{{ trans('cruds.productSize.title') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['new_order_access', 'shipped_order_access', 'completed_order_access', 'cancelled_order_access', 'picked_up_order_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cart-alt"></i>
                            <span key="t-dashboards">
                                {{ trans('cruds.productRedemption.title') }}
                                @if(getAllOrderCount() > 0)<span class="badge rounded-pill bg-danger">{{ getAllOrderCount() }}</span>@endif
                            </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @canany(['new_order_access', 'shipped_order_access', 'completed_order_access', 'cancelled_order_access', 'picked_up_order_access'])
                                <li class="{{ request()->is("admin/orders") || request()->is("admin/orders/create") || request()->is("admin/orders/*/edit") || request()->is("admin/orders/*/to-ship") || request()->is("admin/orders/{id}") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.orders.index") }}" key="t-default">{{ trans('cruds.order.fields.all_order') }} @if(getAllOrderCount() > 0)<span class="badge rounded-pill bg-danger">{{ getAllOrderCount() }}</span>@endif</a>
                                </li>
                            @endcanany
                            @can('new_order_access')
                                <li class="{{ request()->is("admin/orders/new") || request()->is("admin/orders/new/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.orders.new") }}" key="t-default">{{ trans('cruds.order.fields.new_order') }}  @if(getNewOrderCount() > 0)<span class="badge rounded-pill bg-danger">{{ getNewOrderCount() }}</span>@endif</a>

                                </li>
                            @endcan
                            @can('shipped_order_access')
                                <li class="{{ request()->is("admin/orders/shipped") || request()->is("admin/orders/shipped/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.orders.shipped") }}" key="t-default">{{ trans('cruds.order.fields.shipped_order') }} @if(getShippedOrderCount() > 0)<span class="badge rounded-pill bg-danger">{{ getShippedOrderCount() }}</span>@endif</a>
                                </li>
                            @endcan
                            @can('picked_up_order_access')
                                <li class="{{ request()->is("admin/orders/picked-up") || request()->is("admin/orders/picked-up/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.orders.picked-up") }}" key="t-default">{{ trans('cruds.order.fields.picked_up_order') }} @if(getPickedUpOrderCount() > 0)<span class="badge rounded-pill bg-danger">{{ getPickedUpOrderCount() }}</span>@endif</a>
                                </li>
                            @endcan
                            @can('completed_order_access')
                                <li class="{{ request()->is("admin/orders/completed") || request()->is("admin/orders/completed/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.orders.completed") }}" key="t-default">{{ trans('cruds.order.fields.completed_order') }}</a>
                                </li>
                            @endcan
                            @can('cancelled_order_access')
                                <li class="{{ request()->is("admin/orders/cancelled") || request()->is("admin/orders/cancelled/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.orders.cancelled") }}" key="t-default">{{ trans('cruds.order.fields.cancelled_order') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['new_purchase_access', 'verified_purchase_access', 'failed_purchase_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-money"></i>
                            <span key="t-dashboards">
                                {{ trans('cruds.pointManagement.title') }}
                                @if(getNewPurchaseCount() > 0)<span class="badge rounded-pill bg-danger">{{ getNewPurchaseCount() }}</span>@endif
                            </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @canany(['new_purchase_access', 'verified_purchase_access', 'failed_purchase_access'])
                                <li class="{{ request()->is("admin/transaction-point-purchases") || request()->is("admin/transaction-point-purchases/*/edit") || request()->is("admin/transaction-point-purchases/create") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-purchases.index") }}" key="t-default">{{ trans('cruds.transactionPointPurchase.fields.allPurchase') }}</a>
                                </li>
                            @endcanany
                            @can('new_purchase_access')
                                <li class="{{ request()->is("admin/transaction-point-purchases/new") || request()->is("admin/transaction-point-purchases/new/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-purchases.new") }}" key="t-default">{{ trans('cruds.transactionPointPurchase.fields.newPurchase') }}
                                        @if(getNewPurchaseCount() > 0)<span class="badge rounded-pill bg-danger">{{ getNewPurchaseCount() }}</span>@endif
                                    </a>
                                </li>
                            @endcan
                            @can('verified_purchase_access')
                                <li class="{{ request()->is("admin/transaction-point-purchases/verified") || request()->is("admin/transaction-point-purchases/verified/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-purchases.verified") }}" key="t-default">{{ trans('cruds.transactionPointPurchase.fields.verifiedPurchase') }}</a>
                                </li>
                            @endcan
                            @can('failed_purchase_access')
                                <li class="{{ request()->is("admin/transaction-point-purchases/failed") || request()->is("admin/transaction-point-purchases/failed/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-purchases.failed") }}" key="t-default">{{ trans('cruds.transactionPointPurchase.fields.failedPurchase') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['new_shipping_purchase_access', 'verified_shipping_purchase_access', 'failed_shipping_purchase_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-package"></i>
                            <span key="t-dashboards">
                                {{ trans('cruds.shippingPointManagement.title') }}
                            </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @canany(['new_shipping_purchase_access', 'verified_shipping_purchase_access', 'failed_shipping_purchase_access'])
                                <li class="{{ request()->is("admin/transaction-shipping-purchases") || request()->is("admin/transaction-shipping-purchases/*/edit") || request()->is("admin/transaction-shipping-purchases/create") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-shipping-purchases.index") }}" key="t-default">{{ trans('cruds.transactionShippingPurchase.fields.allPurchase') }}</a>
                                </li>
                            @endcanany
                            @can('new_shipping_purchase_access')
                                <li class="{{ request()->is("admin/transaction-shipping-purchases/new") || request()->is("admin/transaction-shipping-purchases/new/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-shipping-purchases.new") }}" key="t-default">{{ trans('cruds.transactionShippingPurchase.fields.newPurchase') }}
                                        @if(getNewShippingPurchaseCount() > 0)<span class="badge rounded-pill bg-danger">{{ getNewShippingPurchaseCount() }}</span>@endif
                                    </a>
                                </li>
                            @endcan
                            @can('verified_shipping_purchase_access')
                                <li class="{{ request()->is("admin/transaction-shipping-purchases/verified") || request()->is("admin/transaction-shipping-purchases/verified/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-shipping-purchases.verified") }}" key="t-default">{{ trans('cruds.transactionShippingPurchase.fields.verifiedPurchase') }}</a>
                                </li>
                            @endcan
                            @can('failed_shipping_purchase_access')
                                <li class="{{ request()->is("admin/transaction-shipping-purchases/failed") || request()->is("admin/transaction-shipping-purchases/failed/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-shipping-purchases.failed") }}" key="t-default">{{ trans('cruds.transactionShippingPurchase.fields.failedPurchase') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @can('point_convert_access')
                    <li class="{{ request()->is("admin/point-converts") || request()->is("admin/point-converts/*") ? "mm-active" : "" }}">
                        <a href="{{ route('admin.point-converts.index') }}" class="waves-effect">
                            <i class="bx bx-lock"></i>
                            <span key="t-default">{{ trans('cruds.pointConvert.title') }}</span>
                        </a>
                    </li>
                @endcan

                @canany(['transaction_point_withdraw_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-dollar"></i>
                            <span key="t-dashboards">
                                {{ trans('cruds.pointWithdrawManagement.title') }}
                                @if(getAllWithdrawCount() > 0)<span class="badge rounded-pill bg-danger">{{ getAllWithdrawCount() }}</span>@endif</a>
                            </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('transaction_point_withdraw_access')
                                <li class="{{ request()->is("admin/transaction-point-withdraws") || request()->is("admin/transaction-point-withdraws/create") || request()->is("admin/transaction-point-withdraws/*/edit") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-withdraws.index") }}" key="t-default">{{ trans('cruds.transactionPointWithdraw.fields.all_withdraw') }}</a>
                                </li>
                            @endcan
                            @can('transaction_point_withdraw_access')
                                <li class="{{ request()->is("admin/transaction-point-withdraws/pending") || request()->is("admin/transaction-point-withdraws/pending/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-withdraws.pending") }}" key="t-default">{{ trans('cruds.transactionPointWithdraw.fields.pending_withdraw') }}
                                        @if(getNewWithdrawCount() > 0)<span class="badge rounded-pill bg-danger">{{ getNewWithdrawCount() }}</span>@endif</a>
                                </li>
                            @endcan
                            @can('transaction_point_withdraw_access')
                                <li class="{{ request()->is("admin/transaction-point-withdraws/processing") || request()->is("admin/transaction-point-withdraws/processing/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-withdraws.processing") }}" key="t-default">{{ trans('cruds.transactionPointWithdraw.fields.processing_withdraw') }}
                                        @if(getProcessingWithdrawCount() > 0)<span class="badge rounded-pill bg-danger">{{ getProcessingWithdrawCount() }}</span>@endif</a>
                                </li>
                            @endcan
                            @can('transaction_point_withdraw_access')
                                <li class="{{ request()->is("admin/transaction-point-withdraws/completed") || request()->is("admin/transaction-point-withdraws/completed/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-withdraws.completed") }}" key="t-default">{{ trans('cruds.transactionPointWithdraw.fields.completed_withdraw') }}</a>
                                </li>
                            @endcan
                            @can('transaction_point_withdraw_access')
                                <li class="{{ request()->is("admin/transaction-point-withdraws/rejected") || request()->is("admin/transaction-point-withdraws/rejected/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-point-withdraws.rejected") }}" key="t-default">{{ trans('cruds.transactionPointWithdraw.fields.rejected_withdraw') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('withdraw_excel_access')
                    <li class="{{ request()->is("admin/withdraw-excels") || request()->is("admin/withdraw-excels/*") ? "mm-active" : "" }}">
                        <a href="{{ route('admin.withdraw-excels.index') }}" class="waves-effect">
                            <i class="bx bxs-file"></i>
                            <span key="t-default">{{ trans('cruds.withdrawExcel.title') }}</span>
                        </a>
                    </li>
                @endcan

                @canany(['new_top_up_access', 'approved_top_up_access', 'rejected_top_up_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-transfer"></i>
                            <span key="t-dashboards">{{ trans('cruds.pointTransferManagement.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @canany(['new_top_up_access', 'approved_top_up_access', 'rejected_top_up_access'])
                                <li class="{{ request()->is("admin/transaction-agent-top-ups") || request()->is("admin/transaction-agent-top-ups/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-agent-top-ups.index") }}" key="t-default">{{ trans('cruds.transactionAgentTopUp.fields.allTopUp') }}</a>
                                </li>
                            @endcanany
                            @can('new_top_up_access')
                                <li class="{{ request()->is("admin/transaction-agent-top-ups/new") || request()->is("admin/transaction-agent-top-ups/new/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-agent-top-ups.new") }}" key="t-default">{{ trans('cruds.transactionAgentTopUp.fields.newTopUp') }}</a>
                                </li>
                            @endcan
                            @can('approved_top_up_access')
                                <li class="{{ request()->is("admin/transaction-agent-top-ups/approved") || request()->is("admin/transaction-agent-top-ups/approved/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-agent-top-ups.approved") }}" key="t-default">{{ trans('cruds.transactionAgentTopUp.fields.approvedTopUp') }}</a>
                                </li>
                            @endcan
                            @can('rejected_top_up_access')
                                <li class="{{ request()->is("admin/transaction-agent-top-ups/rejected") || request()->is("admin/transaction-agent-top-ups/rejected/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-agent-top-ups.rejected") }}" key="t-default">{{ trans('cruds.transactionAgentTopUp.fields.rejectedTopUp') }}</a>
                                </li>
                            @endcan
                            @canany(['new_top_up_access', 'approved_top_up_access', 'rejected_top_up_access'])
                                <li class="{{ request()->is("admin/transaction-agent-top-ups/manual") || request()->is("admin/transaction-agent-top-ups/manual/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-agent-top-ups.manual") }}" key="t-default">{{ trans('cruds.transactionAgentTopUp.fields.manualTopUp') }}</a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcan

                @canany(['referral_bonus_given_access', 'approved_top_up_access', 'rejected_top_up_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-gift "></i>
                            <span key="t-dashboards">{{ trans('cruds.transactionBonusGiven.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('transaction_bonus_given_access')
                                <li class="{{ request()->is("admin/transaction-bonus-givens") || request()->is("admin/transaction-bonus-givens/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-bonus-givens.index") }}" key="t-default">{{ trans('cruds.transactionBonusGiven.fields.all_bonus') }}</a>
                                </li>
                            @endcan
                            @can('referral_bonus_given_access')
                                <li class="{{ request()->is("admin/transaction-bonus-givens/referral") || request()->is("admin/transaction-bonus-givens/referral/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-bonus-givens.referral") }}" key="t-default">{{ trans('cruds.transactionBonusGiven.fields.referral_bonus') }}</a>
                                </li>
                            @endcan
                            @can('personal_topup_bonus_given_access')
                                <li class="{{ request()->is("admin/transaction-bonus-givens/personal-topup") || request()->is("admin/transaction-bonus-givens/personal-topup/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-bonus-givens.personal-topup") }}" key="t-default">{{ trans('cruds.transactionBonusGiven.fields.personal_topup_bonus') }}</a>
                                </li>
                            @endcan
                            @can('team_topup_bonus_given_access')
                                <li class="{{ request()->is("admin/transaction-bonus-givens/team-topup") || request()->is("admin/transaction-bonus-givens/team-topup/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-bonus-givens.team-topup") }}" key="t-default">{{ trans('cruds.transactionBonusGiven.fields.team_topup_bonus') }}</a>
                                </li>
                            @endcan
                            @can('personal_annual_bonus_given_access')
                                <li class="{{ request()->is("admin/transaction-bonus-givens/personal-annual") || request()->is("admin/transaction-bonus-givens/personal-annual/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-bonus-givens.personal-annual") }}" key="t-default">{{ trans('cruds.transactionBonusGiven.fields.personal_annual_bonus') }}</a>
                                </li>
                            @endcan
                            @can('team_annual_bonus_given_access')
                                <li class="{{ request()->is("admin/transaction-bonus-givens/team-annual") || request()->is("admin/transaction-bonus-givens/team-annual/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-bonus-givens.team-annual") }}" key="t-default">{{ trans('cruds.transactionBonusGiven.fields.team_annual_bonus') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @canany(['cart_access'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cart"></i>
                            <span key="t-dashboards">{{ trans('cruds.ecommerceManagement.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            {{-- @can('transaction_agent_top_up_access')
                                <li class="{{ request()->is("admin/transaction-agent-top-ups") || request()->is("admin/transaction-agent-top-ups/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-agent-top-ups.index") }}" key="t-default">{{ trans('cruds.transactionAgentTopUp.title') }}</a>
                                </li>
                            @endcan                       --}}
                            @can('cart_access')
                                <li class="{{ request()->is("admin/carts") || request()->is("admin/carts/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.carts.index") }}" key="t-default">{{ trans('cruds.cart.title') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @can('report_access')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-report"></i>
                            <span key="t-dashboards">{{ trans('cruds.report.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('report_access')
                                <li class="{{ request()->is("admin/reports/summary") || request()->is("admin/reports/summary/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.reports.summary") }}" key="t-default">{{ trans('cruds.report.fields.summary') }}</a>
                                </li>
                            @endcan
                            @can('report_access')
                            <li class="{{ request()->is("admin/reports/mbr") || request()->is("admin/reports/mbr/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.mbr") }}" key="t-default">{{ trans('cruds.report.fields.mbr') }}</a>
                            </li>
                        @endcan
                            @can('report_access')
                                <li class="{{ request()->is("admin/reports/deposit-summary") || request()->is("admin/reports/deposit-summary/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.reports.deposit-summary") }}" key="t-default">{{ trans('cruds.report.fields.deposit_summary') }}</a>
                                </li>
                            @endcan
                            @can('report_access')
                                <li class="{{ request()->is("admin/reports/deposit-balance") || request()->is("admin/reports/deposit-balance/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.reports.deposit-balance") }}" key="t-default">{{ trans('cruds.report.fields.deposit_balance') }}</a>
                                </li>
                            @endcan
                            @can('report_access')
                                <li class="{{ request()->is("admin/reports/joining-fee") || request()->is("admin/reports/joining-fee/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.reports.joining-fee") }}" key="t-default">{{ trans('cruds.report.fields.joining_fee') }}</a>
                                </li>
                            @endcan
                            @can('report_access')
                                <li class="{{ request()->is("admin/reports/stock-credit-summary") || request()->is("admin/reports/stock-credit-summary/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.reports.stock-credit-summary") }}" key="t-default">{{ trans('cruds.report.fields.stock_credit_summary') }}</a>
                                </li>
                            @endcan
                            @can('report_access')
                            {{-- <li class="{{ request()->is("admin/reports/stock-credit-balance") || request()->is("admin/reports/stock-credit-balance/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.stock-credit-balance") }}" key="t-default">{{ trans('cruds.report.fields.stock_credit_balance') }}</a>
                            </li> --}}
                            <li class="{{ request()->is("admin/reports/stock-credit-balance-millionaire") || request()->is("admin/reports/stock-credit-balance-millionaire/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.stock-credit-balance-millionaire") }}" key="t-default">{{ trans('cruds.report.fields.stock_credit_balance_millionaire') }}</a>
                            </li>
                            @endcan
                            @can('report_access')
                            <li class="{{ request()->is("admin/reports/stock-credit-balance-millionaire-topup") || request()->is("admin/reports/stock-credit-balance-topup/millionaire/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.stock-credit-balance-millionaire-topup") }}" key="t-default">{{ trans('cruds.report.fields.stock_credit_balance_topup_millionaire') }}</a>
                            </li>
                            @endcan
                            @can('report_access')
                            <li class="{{ request()->is("admin/reports/stock-credit-balance-agent-topup") || request()->is("admin/reports/stock-credit-balance-topup/agent/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.stock-credit-balance-agent-topup") }}" key="t-default">{{ trans('cruds.report.fields.stock_credit_balance_topup_agent') }}</a>
                            </li>
                            @endcan
                            @can('report_access')
                                <li class="{{ request()->is("admin/reports/shipping-credit-summary") || request()->is("admin/reports/shipping-credit-summary/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.reports.shipping-credit-summary") }}" key="t-default">{{ trans('cruds.report.fields.shipping_credit_summary') }}</a>
                                </li>
                            @endcan
                            @can('report_access')
                            <li class="{{ request()->is("admin/reports/shipping-credit-balance") || request()->is("admin/reports/shipping-credit-balance/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.shipping-credit-balance") }}" key="t-default">{{ trans('cruds.report.fields.shipping_credit_balance') }}</a>
                            </li>
                            @endcan
                            @can('report_access')
                            <li class="{{ request()->is("admin/reports/bonus-credit-summary") || request()->is("admin/reports/bonus-credit-summary/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.bonus-credit-summary") }}" key="t-default">{{ trans('cruds.report.fields.bonus_credit_summary') }}</a>
                            </li>
                            @endcan
                            @can('report_access')
                            <li class="{{ request()->is("admin/reports/bonus-credit-balance") || request()->is("admin/reports/bonus-credit-balance/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.bonus-credit-balance") }}" key="t-default">{{ trans('cruds.report.fields.bonus_credit_balance') }}</a>
                            </li>
                            @endcan
                            @can('report_access')
                            <li class="{{ request()->is("admin/reports/voucher-credit-summary") || request()->is("admin/reports/voucher-credit-summary/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.voucher-credit-summary") }}" key="t-default">{{ trans('cruds.report.fields.voucher_credit_summary') }}</a>
                            </li>
                            @endcan
                            @can('report_access')
                            <li class="{{ request()->is("admin/reports/voucher-credit-balance") || request()->is("admin/reports/voucher-credit-balance/*") ? "mm-active" : "" }}">
                                <a href="{{ route("admin.reports.voucher-credit-balance") }}" key="t-default">{{ trans('cruds.report.fields.voucher_credit_balance') }}</a>
                            </li>
                            @endcan
                            @can('total_revenue_access')
                                <li class="{{ request()->is("admin/total-revenues") || request()->is("admin/total-revenues/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.total-revenues.index") }}" key="t-default">{{ trans('cruds.totalRevenue.title') }}</a>
                                </li>
                            @endcan
                            @can('total_redemption_access')
                                <li class="{{ request()->is("admin/total-redemptions") || request()->is("admin/total-redemptions/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.total-redemptions.index") }}" key="t-default">{{ trans('cruds.totalRedemption.title') }}</a>
                                </li>
                            @endcan
                            @can('total_point_balance_access')
                                <li class="{{ request()->is("admin/total-point-balances") || request()->is("admin/total-point-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.total-point-balances.index") }}" key="t-default">{{ trans('cruds.totalPointBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('product_detail_access')
                                <li class="{{ request()->is("admin/product-details") || request()->is("admin/product-details/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.product-details.index") }}" key="t-default">{{ trans('cruds.productDetail.title') }}</a>
                                </li>
                            @endcan
                            @can('commission_report_access')
                                <li class="{{ request()->is("admin/commission-reports") || request()->is("admin/commission-reports/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.commission-reports.index") }}" key="t-default">{{ trans('cruds.commissionReport.title') }}</a>
                                </li>
                            @endcan
                            @can('company_profit_loss_access')
                                <li class="{{ request()->is("admin/company-profit-losses") || request()->is("admin/company-profit-losses/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.company-profit-losses.index") }}" key="t-default">{{ trans('cruds.companyProfitLoss.title') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('enquiry_list_access')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-edit"></i>
                            <span key="t-dashboards">{{ trans('cruds.enquiryList.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('enquiry_access')
                                <li class="{{ request()->is("admin/enquiries") || request()->is("admin/enquiries/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.enquiries.index") }}" key="t-default">{{ trans('cruds.enquiry.title') }}</a>
                                </li>
                            @endcan
                            @can('enquiry_reply_access')
                                <li class="{{ request()->is("admin/enquiry-replies") || request()->is("admin/enquiry-replies/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.enquiry-replies.index") }}" key="t-default">{{ trans('cruds.enquiryReply.title') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

{{--                @can('voucher_management_access')--}}
{{--                    <li>--}}
{{--                        <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                            <i class="bx bx-home-circle"></i>--}}
{{--                            <span key="t-dashboards">{{ trans('cruds.voucherManagement.title') }}</span>--}}
{{--                        </a>--}}
{{--                        <ul class="sub-menu" aria-expanded="false">--}}
{{--                            @can('voucher_access')--}}
{{--                                <li class="{{ request()->is("admin/vouchers") || request()->is("admin/vouchers/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.vouchers.index") }}" key="t-default">{{ trans('cruds.voucher.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endcan--}}

                @can('setting_access')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-dashboards">{{ trans('cruds.setting.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('bonus_setting_access')
                                <li class="{{ request()->is("admin/bonus-settings") || request()->is("admin/bonus-settings/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.bonus-settings.index") }}" key="t-default">{{ trans('cruds.bonusSetting.title') }}</a>
                                </li>
                            @endcan
{{--                            @can('bonus_join_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-joins") || request()->is("admin/bonus-joins/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-joins.index") }}" key="t-default">{{ trans('cruds.bonusJoin.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('bonus_top_up_group_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-top-up-groups") || request()->is("admin/bonus-top-up-groups/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-top-up-groups.index") }}" key="t-default">{{ trans('cruds.bonusTopUpGroup.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('bonus_top_up_personal_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-top-up-personals") || request()->is("admin/bonus-top-up-personals/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-top-up-personals.index") }}" key="t-default">{{ trans('cruds.bonusTopUpPersonal.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('bonus_group_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-groups") || request()->is("admin/bonus-groups/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-groups.index") }}" key="t-default">{{ trans('cruds.bonusGroup.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}

{{--                            @can('bonus_personal_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-personals") || request()->is("admin/bonus-personals/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-personals.index") }}" key="t-default">{{ trans('cruds.bonusPersonal.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}

{{--                            @can('bonus_ref_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-refs") || request()->is("admin/bonus-refs/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-refs.index") }}" key="t-default">{{ trans('cruds.bonusRef.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('bonus_restock_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-restocks") || request()->is("admin/bonus-restocks/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-restocks.index") }}" key="t-default">{{ trans('cruds.bonusRestock.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('bonus_annual_personal_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-annual-personals") || request()->is("admin/bonus-annual-personals/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-annual-personals.index") }}" key="t-default">{{ trans('cruds.bonusAnnualPersonal.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('bonus_annual_group_access')--}}
{{--                                <li class="{{ request()->is("admin/bonus-annual-groups") || request()->is("admin/bonus-annual-groups/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.bonus-annual-groups.index") }}" key="t-default">{{ trans('cruds.bonusAnnualGroup.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
                            @can('payout_limit_access')
                                <li class="{{ request()->is("admin/payout-limits") || request()->is("admin/payout-limits/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.payout-limits.index") }}" key="t-default">{{ trans('cruds.payoutLimit.title') }}</a>
                                </li>
                            @endcan
                            @can('point_package_access')
                                <li class="{{ request()->is("admin/point-packages") || request()->is("admin/point-packages/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.point-packages.index") }}" key="t-default">{{ trans('cruds.pointPackage.title') }}</a>
                                </li>
                            @endcan
                            @can('shipping_package_access')
                                <li class="{{ request()->is("admin/shipping-packages") || request()->is("admin/shipping-packages/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.shipping-packages.index") }}" key="t-default">{{ trans('cruds.shippingPackage.title') }}</a>
                                </li>
                            @endcan
                                @can('shipping_package_access')
                                    <li class="{{ request()->is("admin/pick-up-locations") || request()->is("admin/pick-up-locations/*") ? "mm-active" : "" }}">
                                        <a href="{{ route("admin.pick-up-locations.index") }}" key="t-default">{{ trans('cruds.pickUpLocation.title') }}</a>
                                    </li>
                                @endcan
                        </ul>
                    </li>
                @endcan

                @can('user_agreement_log_access')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-file"></i>
                            <span key="t-dashboards">{{ trans('cruds.agreementManagement.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('user_agreement_log_access')
                                <li class="{{ request()->is("admin/user-agreement-logs") || request()->is("admin/user-agreement-logs/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.user-agreement-logs.index") }}" key="t-default">{{ trans('cruds.userAgreementLog.title') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('other_setting_access')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-adjust"></i>
                            <span key="t-dashboards">{{ trans('cruds.otherSetting.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('announcement_access')
                                <li class="{{ request()->is("admin/announcements") || request()->is("admin/announcements/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.announcements.index") }}" key="t-default">{{ trans('cruds.announcement.title') }}</a>
                                </li>
                            @endcan
                            @can('banner_access')
                                <li class="{{ request()->is("admin/banners") || request()->is("admin/banners/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.banners.index") }}" key="t-default">{{ trans('cruds.banner.title') }}</a>
                                </li>
                            @endcan
                            @can('bank_list_access')
                                <li class="{{ request()->is("admin/bank-lists") || request()->is("admin/bank-lists/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.bank-lists.index") }}" key="t-default">{{ trans('cruds.bankList.title') }}</a>
                                </li>
                            @endcan
                            @can('deposit_bank_access')
                                <li class="{{ request()->is("admin/deposit-banks") || request()->is("admin/deposit-banks/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.deposit-banks.index") }}" key="t-default">{{ trans('cruds.depositBank.title') }}</a>
                                </li>
                            @endcan
                            @can('material_access')
                                <li class="{{ request()->is("admin/materials") || request()->is("admin/materials/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.materials.index") }}" key="t-default">{{ trans('cruds.material.title') }}</a>
                                </li>
                            @endcan
                            @can('otp_log_access')
                                <li class="{{ request()->is("admin/otp-logs") || request()->is("admin/otp-logs/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.otp-logs.index") }}" key="t-default">{{ trans('cruds.otpLog.title') }}</a>
                                </li>
                            @endcan
                            @can('shipping_fee_access')
                                <li class="{{ request()->is("admin/shipping-fees") || request()->is("admin/shipping-fees/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.shipping-fees.index") }}" key="t-default">{{ trans('cruds.shippingFee.title') }}</a>
                                </li>
                            @endcan
                                @can('discount_access')
                                    <li class="{{ request()->is("admin/discounts") || request()->is("admin/discounts/*") ? "mm-active" : "" }}">
                                        <a href="{{ route("admin.discounts.index") }}" key="t-default">{{ trans('cruds.discount.title') }}</a>
                                    </li>
                                @endcan
                        </ul>
                    </li>
                @endcan

                @can('admin_setting_access')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-wrench"></i>
                            <span key="t-dashboards">{{ trans('cruds.adminSetting.title') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('point_access')
                                <li class="{{ request()->is("admin/points") || request()->is("admin/points/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.points.index") }}" key="t-default">{{ trans('cruds.point.title') }}</a>
                                </li>
                            @endcan
                            @can('point_bonus_balance_access')
                                <li class="{{ request()->is("admin/point-balances") || request()->is("admin/point-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.point-balances.index") }}" key="t-default">{{ trans('cruds.pointBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('point_manager_balance_access')
                                <li class="{{ request()->is("admin/point-manager-balances") || request()->is("admin/point-manager-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.point-manager-balances.index") }}" key="t-default">{{ trans('cruds.pointManagerBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('point_executive_balance_access')
                                <li class="{{ request()->is("admin/point-executive-balances") || request()->is("admin/point-executive-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.point-executive-balances.index") }}" key="t-default">{{ trans('cruds.pointExecutiveBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('point_balance_access')
                                <li class="{{ request()->is("admin/point-bonus-balances") || request()->is("admin/point-bonus-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.point-bonus-balances.index") }}" key="t-default">{{ trans('cruds.pointBonusBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('voucher_balance_access')
                                <li class="{{ request()->is("admin/voucher-balances") || request()->is("admin/voucher-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.voucher-balances.index") }}" key="t-default">{{ trans('cruds.voucherBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('shipping_balance_access')
                                <li class="{{ request()->is("admin/shipping-balances") || request()->is("admin/shipping-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.shipping-balances.index") }}" key="t-default">{{ trans('cruds.shippingBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('voucher_log_access')
                                <li class="{{ request()->is("admin/voucher-logs") || request()->is("admin/voucher-logs/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.voucher-logs.index") }}" key="t-default">{{ trans('cruds.voucherLog.title') }}</a>
                                </li>
                            @endcan
                            @can('cash_voucher_balance_access')
                                <li class="{{ request()->is("admin/cash-voucher-balances") || request()->is("admin/cash-voucher-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.cash-voucher-balances.index") }}" key="t-default">{{ trans('cruds.cashVoucherBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('pv_balance_access')
                                <li class="{{ request()->is("admin/pv-balances") || request()->is("admin/pv-balances/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.pv-balances.index") }}" key="t-default">{{ trans('cruds.pvBalance.title') }}</a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="{{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.audit-logs.index") }}" key="t-default">{{ trans('cruds.auditLog.title') }}</a>
                                </li>
                            @endcan
                            @can('permission_access')
                                <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.permissions.index") }}" key="t-default">{{ trans('cruds.permission.title') }}</a>
                                </li>
                            @endcan
                            @can('permissions_group_access')
                                <li class="{{ request()->is("admin/permissions-groups") || request()->is("admin/permissions-groups/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.permissions-groups.index") }}" key="t-default">{{ trans('cruds.permissionsGroup.title') }}</a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.roles.index") }}" key="t-default">{{ trans('cruds.role.title') }}</a>
                                </li>
                            @endcan
                            @can('country_access')
                                <li class="{{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.countries.index") }}" key="t-default">{{ trans('cruds.country.title') }}</a>
                                </li>
                            @endcan
                            @can('state_access')
                                <li class="{{ request()->is("admin/states") || request()->is("admin/states/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.states.index") }}" key="t-default">{{ trans('cruds.state.title') }}</a>
                                </li>
                            @endcan
                            @can('language_access')
                                <li class="{{ request()->is("admin/languages") || request()->is("admin/languages/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.languages.index") }}" key="t-default">{{ trans('cruds.language.title') }}</a>
                                </li>
                            @endcan
                            @can('personal_code_log_access')
                                <li class="{{ request()->is("admin/personal-code-logs") || request()->is("admin/personal-code-logs/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.personal-code-logs.index") }}" key="t-default">{{ trans('cruds.personalCodeLog.title') }}</a>
                                </li>
                            @endcan
                            @can('payment_method_access')
                                <li class="{{ request()->is("admin/payment-methods") || request()->is("admin/payment-methods/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.payment-methods.index") }}" key="t-default">{{ trans('cruds.paymentMethod.title') }}</a>
                                </li>
                            @endcan
                            @can('shipping_company_access')
                                <li class="{{ request()->is("admin/shipping-companies") || request()->is("admin/shipping-companies/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.shipping-companies.index") }}" key="t-default">{{ trans('cruds.shippingCompany.title') }}</a>
                                </li>
                            @endcan
                            @can('transaction_id_log_access')
                                <li class="{{ request()->is("admin/transaction-id-logs") || request()->is("admin/transaction-id-logs/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.transaction-id-logs.index") }}" key="t-default">{{ trans('cruds.transactionIdLog.title') }}</a>
                                </li>
                            @endcan
{{--                            @can('ranking_access')--}}
{{--                                <li class="{{ request()->is("admin/rankings") || request()->is("admin/rankings/*") ? "mm-active" : "" }}">--}}
{{--                                    <a href="{{ route("admin.rankings.index") }}" key="t-default">{{ trans('cruds.ranking.title') }}</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}

                            @can('user_agreement_access')
                                <li class="{{ request()->is("admin/user-agreements") || request()->is("admin/user-agreements/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.user-agreements.index") }}" key="t-default">{{ trans('cruds.userAgreement.title') }}</a>
                                </li>
                            @endcan
                            @can('user_entry_access')
                                <li class="{{ request()->is("admin/user-entries") || request()->is("admin/user-entries/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.user-entries.index") }}" key="t-default">{{ trans('cruds.userEntry.title') }}</a>
                                </li>
                            @endcan

                            @can('point_transaction_log_access')
                                <li class="{{ request()->is("admin/point-transaction-logs") || request()->is("admin/point-transaction-logs/*") ? "mm-active" : "" }}">
                                    <a href="{{ route("admin.point-transaction-logs.index") }}" key="t-default">{{ trans('cruds.pointTransactionLog.title') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

{{--                @if(file_exists(app_path('Http/Controllers/Admin/Auth/ChangePasswordController.php')))--}}
                    @can('profile_password_edit')
                        <li class="{{ request()->is("profile/password") || request()->is("profile/password/*") ? "mm-active" : "" }}">
                            <a href="{{ route('profile.password.edit') }}" class="waves-effect">
                                <i class="bx bx-lock"></i>
                                <span key="t-default">{{ trans('global.change_password') }}</span>
                            </a>
                        </li>
                    @endcan
{{--                @endif--}}
{{--                <li>--}}
{{--                    <a href="" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="waves-effect">--}}
{{--                        <i class="bx bx-log-out"></i>--}}
{{--                        <span key="t-default">{{ trans('global.logout') }}</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
