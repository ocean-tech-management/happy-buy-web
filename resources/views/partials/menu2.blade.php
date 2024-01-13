<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/admins*") ? "c-show" : "" }} {{ request()->is("admin/address-books*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('admin_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.admins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/admins") || request()->is("admin/admins/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.admin.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('merchant_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.merchants") }}" class="c-sidebar-nav-link {{ request()->is("admin/merchants") || request()->is("admin/merchants/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.fields.merchant') }}
                            </a>
                        </li>
                    @endcan
                    @can('agent_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.agents") }}" class="c-sidebar-nav-link {{ request()->is("admin/agents") || request()->is("admin/agents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.fields.agent') }}
                            </a>
                        </li>
                    @endcan
                    @can('address_book_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.address-books.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/address-books") || request()->is("admin/address-books/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.addressBook.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('product_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/products*") ? "c-show" : "" }} {{ request()->is("admin/product-batches*") ? "c-show" : "" }} {{ request()->is("admin/product-check-qrs*") ? "c-show" : "" }} {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/product-quantities*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fab fa-product-hunt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.product.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_batch_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-batches.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-batches") || request()->is("admin/product-batches/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productBatch.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_check_qr_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-check-qrs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-check-qrs") || request()->is("admin/product-check-qrs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCheckQr.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_quantity_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-quantities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-quantities") || request()->is("admin/product-quantities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productQuantity.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('product_redemption_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/new-orders*") ? "c-show" : "" }} {{ request()->is("admin/shipped-orders*") ? "c-show" : "" }} {{ request()->is("admin/completed-orders*") ? "c-show" : "" }} {{ request()->is("admin/cancelled-orders*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-exchange-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productRedemption.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('new_order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.new-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/new-orders") || request()->is("admin/new-orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.newOrder.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('shipped_order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.shipped-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/shipped-orders") || request()->is("admin/shipped-orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.shippedOrder.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('completed_order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.completed-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/completed-orders") || request()->is("admin/completed-orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.completedOrder.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cancelled_order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cancelled-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cancelled-orders") || request()->is("admin/cancelled-orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cancelledOrder.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('point_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/new-purchases*") ? "c-show" : "" }} {{ request()->is("admin/verified-purchases*") ? "c-show" : "" }} {{ request()->is("admin/failed-purchases*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-dice-five c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pointManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('new_purchase_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.new-purchases.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/new-purchases") || request()->is("admin/new-purchases/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.newPurchase.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('verified_purchase_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.verified-purchases.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/verified-purchases") || request()->is("admin/verified-purchases/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.verifiedPurchase.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('failed_purchase_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.failed-purchases.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/failed-purchases") || request()->is("admin/failed-purchases/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.failedPurchase.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('point_convert_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/point-converts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pointConvertManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('point_convert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.point-converts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/point-converts") || request()->is("admin/point-converts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pointConvert.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('point_transfer_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/transaction-agent-top-ups*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pointTransferManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('transaction_agent_top_up_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.transaction-agent-top-ups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transaction-agent-top-ups") || request()->is("admin/transaction-agent-top-ups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.transactionAgentTopUp.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('report_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/total-revenues*") ? "c-show" : "" }} {{ request()->is("admin/total-redemptions*") ? "c-show" : "" }} {{ request()->is("admin/total-point-balances*") ? "c-show" : "" }} {{ request()->is("admin/product-details*") ? "c-show" : "" }} {{ request()->is("admin/commission-reports*") ? "c-show" : "" }} {{ request()->is("admin/company-profit-losses*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.report.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('total_revenue_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.total-revenues.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/total-revenues") || request()->is("admin/total-revenues/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.totalRevenue.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('total_redemption_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.total-redemptions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/total-redemptions") || request()->is("admin/total-redemptions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.totalRedemption.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('total_point_balance_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.total-point-balances.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/total-point-balances") || request()->is("admin/total-point-balances/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.totalPointBalance.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-details") || request()->is("admin/product-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('commission_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.commission-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/commission-reports") || request()->is("admin/commission-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.commissionReport.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('company_profit_loss_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.company-profit-losses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/company-profit-losses") || request()->is("admin/company-profit-losses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.companyProfitLoss.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('enquiry_list_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/enquiries*") ? "c-show" : "" }} {{ request()->is("admin/enquiry-replies*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-hands-helping c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.enquiryList.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('enquiry_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.enquiries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/enquiries") || request()->is("admin/enquiries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.enquiry.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('enquiry_reply_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.enquiry-replies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/enquiry-replies") || request()->is("admin/enquiry-replies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.enquiryReply.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('voucher_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/vouchers*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-ticket-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.voucherManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('voucher_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.vouchers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/vouchers") || request()->is("admin/vouchers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.voucher.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/bonus-refs*") ? "c-show" : "" }} {{ request()->is("admin/bonus-restocks*") ? "c-show" : "" }} {{ request()->is("admin/bonus-annual-personals*") ? "c-show" : "" }} {{ request()->is("admin/bonus-annual-groups*") ? "c-show" : "" }} {{ request()->is("admin/payout-limits*") ? "c-show" : "" }} {{ request()->is("admin/point-packages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('bonus_ref_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-refs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-refs") || request()->is("admin/bonus-refs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusRef.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bonus_restock_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-restocks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-restocks") || request()->is("admin/bonus-restocks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusRestock.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bonus_annual_personal_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-annual-personals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-annual-personals") || request()->is("admin/bonus-annual-personals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusAnnualPersonal.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bonus_annual_group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-annual-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-annual-groups") || request()->is("admin/bonus-annual-groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusAnnualGroup.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payout_limit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payout-limits.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payout-limits") || request()->is("admin/payout-limits/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.payoutLimit.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('point_package_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.point-packages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/point-packages") || request()->is("admin/point-packages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pointPackage.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('agreement_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/agent-agreements*") ? "c-show" : "" }} {{ request()->is("admin/merchant-agreements*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-file-signature c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.agreementManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('agent_agreement_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.agent-agreements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/agent-agreements") || request()->is("admin/agent-agreements/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.agentAgreement.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('merchant_agreement_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.merchant-agreements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/merchant-agreements") || request()->is("admin/merchant-agreements/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.merchantAgreement.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('other_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/announcements*") ? "c-show" : "" }} {{ request()->is("admin/banners*") ? "c-show" : "" }} {{ request()->is("admin/bank-lists*") ? "c-show" : "" }} {{ request()->is("admin/materials*") ? "c-show" : "" }} {{ request()->is("admin/otp-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-infinity c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.otherSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('announcement_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.announcements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/announcements") || request()->is("admin/announcements/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.announcement.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('banner_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.banners.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/banners") || request()->is("admin/banners/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.banner.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bank_list_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bank-lists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bank-lists") || request()->is("admin/bank-lists/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bankList.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('material_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.materials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/materials") || request()->is("admin/materials/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.material.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('otp_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.otp-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/otp-logs") || request()->is("admin/otp-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.otpLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('admin_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/points*") ? "c-show" : "" }} {{ request()->is("admin/point-balances*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }} {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/permissions-groups*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/countries*") ? "c-show" : "" }} {{ request()->is("admin/languages*") ? "c-show" : "" }} {{ request()->is("admin/personal-code-logs*") ? "c-show" : "" }} {{ request()->is("admin/payment-methods*") ? "c-show" : "" }} {{ request()->is("admin/shipping-companies*") ? "c-show" : "" }} {{ request()->is("admin/transaction-id-logs*") ? "c-show" : "" }} {{ request()->is("admin/transaction-redeem-products*") ? "c-show" : "" }} {{ request()->is("admin/transaction-bonus*") ? "c-show" : "" }} {{ request()->is("admin/transaction-point-withdraws*") ? "c-show" : "" }} {{ request()->is("admin/transaction-point-purchases*") ? "c-show" : "" }} {{ request()->is("admin/rankings*") ? "c-show" : "" }} {{ request()->is("admin/bonus-joins*") ? "c-show" : "" }} {{ request()->is("admin/bonus-top-up-groups*") ? "c-show" : "" }} {{ request()->is("admin/bonus-top-up-personals*") ? "c-show" : "" }} {{ request()->is("admin/user-agreements*") ? "c-show" : "" }} {{ request()->is("admin/user-entries*") ? "c-show" : "" }} {{ request()->is("admin/bonus-personals*") ? "c-show" : "" }} {{ request()->is("admin/bonus-groups*") ? "c-show" : "" }} {{ request()->is("admin/point-transaction-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.adminSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('point_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.points.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/points") || request()->is("admin/points/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.point.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('point_balance_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.point-balances.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/point-balances") || request()->is("admin/point-balances/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pointBalance.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('permissions_group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions-groups") || request()->is("admin/permissions-groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permissionsGroup.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('language_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.languages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/languages") || request()->is("admin/languages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.language.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('personal_code_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.personal-code-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/personal-code-logs") || request()->is("admin/personal-code-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.personalCodeLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_method_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-methods.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-methods") || request()->is("admin/payment-methods/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentMethod.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('shipping_company_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.shipping-companies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/shipping-companies") || request()->is("admin/shipping-companies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.shippingCompany.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('transaction_id_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.transaction-id-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transaction-id-logs") || request()->is("admin/transaction-id-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.transactionIdLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('transaction_redeem_product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.transaction-redeem-products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transaction-redeem-products") || request()->is("admin/transaction-redeem-products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.transactionRedeemProduct.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('transaction_bonu_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.transaction-bonus.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transaction-bonus") || request()->is("admin/transaction-bonus/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.transactionBonu.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('transaction_point_withdraw_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.transaction-point-withdraws.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transaction-point-withdraws") || request()->is("admin/transaction-point-withdraws/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.transactionPointWithdraw.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('transaction_point_purchase_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.transaction-point-purchases.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transaction-point-purchases") || request()->is("admin/transaction-point-purchases/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.transactionPointPurchase.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('ranking_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.rankings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/rankings") || request()->is("admin/rankings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.ranking.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bonus_join_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-joins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-joins") || request()->is("admin/bonus-joins/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusJoin.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bonus_top_up_group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-top-up-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-top-up-groups") || request()->is("admin/bonus-top-up-groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusTopUpGroup.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bonus_top_up_personal_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-top-up-personals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-top-up-personals") || request()->is("admin/bonus-top-up-personals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusTopUpPersonal.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_agreement_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-agreements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-agreements") || request()->is("admin/user-agreements/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAgreement.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_entry_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-entries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-entries") || request()->is("admin/user-entries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userEntry.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bonus_personal_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-personals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-personals") || request()->is("admin/bonus-personals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusPersonal.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bonus_group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bonus-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bonus-groups") || request()->is("admin/bonus-groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bonusGroup.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('point_transaction_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.point-transaction-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/point-transaction-logs") || request()->is("admin/point-transaction-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pointTransactionLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
