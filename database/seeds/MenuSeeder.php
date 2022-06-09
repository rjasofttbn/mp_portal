<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        DB::insert("


            INSERT INTO `menus` (`id`, `name`, `name_bn`, `parent`, `module_id`, `route`, `sort`, `icon`, `status`, `created_at`, `updated_at`) VALUES
            (1, 'Menu Management', 'মেনু ব্যবস্থাপনা', 0, 2, '', 1, '', 1, NULL, NULL),
            (2, 'Menu List', 'মেনু তালিকা', 1, 2, 'admin.menu-management.menu-info.list', 1, '', 1, NULL, NULL),
            (3, 'User Management', 'ব্যবহারকারী ব্যবস্থাপনা', 0, 2, '', 2, '', 1, NULL, NULL),
            (4, 'User Role', 'ব্যবহারকারী রোল', 3, 2, 'admin.user-management.role-info.list', 1, 'ion-arrow-expand', 1, NULL, '2021-03-30 18:34:20'),
            (5, 'Menu Permission', 'মেনু অনুমতি', 3, 2, 'admin.user-management.menu-permission-info.list', 2, '', 1, NULL, NULL),
            (6, 'Profile Management', 'প্রোফাইল ব্যবস্থাপনা', 0, 2, '', 3, '', 1, NULL, NULL),
            (7, 'Change Password', 'পাসওয়ার্ড পরিবর্তন', 6, 2, 'profile-management.change.password', 1, '', 1, NULL, NULL),
            (8, 'Module', 'মডিউল', 1, 2, 'admin.menu-management.module-info.list', 2, 'ion-arrow-right-c', 1, '2021-03-31 17:44:04', '2021-03-31 17:44:04');



    ");
    }
}
