<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsGroupsTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            AdminsTableSeeder::class,
            CountriesTableSeeder::class,
        ]);
//        $this->call(RolesTableSeeder::class);
//        $this->call(PermissionsTableSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(PayoutLimitsTableSeeder::class);
        $this->call(PointPackagesTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductColorsTableSeeder::class);
        $this->call(ProductSizesTableSeeder::class);
        $this->call(ProductVariantsTableSeeder::class);

        $this->call(PointPackageRoleTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);

        $this->call(ShippingCompaniesTableSeeder::class);
        $this->call(BankListsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(AddressBooksTableSeeder::class);
        $this->call(BonusJoinsTableSeeder::class);
        $this->call(ShippingFeesTableSeeder::class);
        $this->call(ShippingFeeStateTableSeeder::class);
        $this->call(BonusTopUpGroupsTableSeeder::class);
        $this->call(BonusTopUpPersonalsTableSeeder::class);
        $this->call(UserAgreementsTableSeeder::class);
        $this->call(UserAgreementLogsTableSeeder::class);
        $this->call(UserEntryTableSeeder::class);
        $this->call(ShippingPackagesTableSeeder::class);
        $this->call(DepositBankTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        $this->call(BonusPersonalsTableSeeder::class);
        $this->call(BonusGroupsTableSeeder::class);
        $this->call(BonusVIPTableSeeder::class);
        $this->call(PickUpLocationsTableSeeder::class);
        $this->call(ProductBatchesTableSeeder::class);

        $this->call(CashVoucherBalancesTableSeeder::class);
        $this->call(PointBalancesTableSeeder::class);
        $this->call(PointBonusBalancesTableSeeder::class);
        $this->call(PointExecutiveBalancesTableSeeder::class);
        $this->call(PointManagerBalancesTableSeeder::class);
        // $this->call(PointMillionaireBalancesTableSeeder::class);
        // $this->call(PointsTableSeeder::class);
        $this->call(PVBalancesTableSeeder::class);
        $this->call(ShippingBalancesTableSeeder::class);
        $this->call(VoucherBalancesTableSeeder::class);

        $this->call(CartsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class);
        $this->call(ProductQuantitiesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(BonusTeamCarTableSeeder::class);
        $this->call(BonusTeamHouseTableSeeder::class);
    }
}