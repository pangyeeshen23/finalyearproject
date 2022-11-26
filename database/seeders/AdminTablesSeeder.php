<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        \Encore\Admin\Auth\Database\Menu::truncate();
        \Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "icon" => "fa-bar-chart",
                    "order" => 1,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "Dashboard",
                    "uri" => "/"
                ],
                [
                    "icon" => "fa-tasks",
                    "order" => 2,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "Admin",
                    "uri" => ""
                ],
                [
                    "icon" => "fa-users",
                    "order" => 3,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Users",
                    "uri" => "auth/users"
                ],
                [
                    "icon" => "fa-user",
                    "order" => 4,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Roles",
                    "uri" => "auth/roles"
                ],
                [
                    "icon" => "fa-ban",
                    "order" => 5,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Permission",
                    "uri" => "auth/permissions"
                ],
                [
                    "icon" => "fa-bars",
                    "order" => 6,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Menu",
                    "uri" => "auth/menu"
                ],
                [
                    "icon" => "fa-history",
                    "order" => 7,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Operation log",
                    "uri" => "auth/logs"
                ],
                [
                    "icon" => "fa-map",
                    "order" => 11,
                    "parent_id" => 0,
                    "permission" => "plans",
                    "title" => "Travel Plans",
                    "uri" => "plans"
                ],
                [
                    "icon" => "fa-tasks",
                    "order" => 8,
                    "parent_id" => 0,
                    "permission" => "*",
                    "title" => "User",
                    "uri" => NULL
                ],
                [
                    "icon" => "fa-user",
                    "order" => 9,
                    "parent_id" => 9,
                    "permission" => "*",
                    "title" => "Users",
                    "uri" => "users"
                ],
                [
                    "icon" => "fa-bars",
                    "order" => 10,
                    "parent_id" => 9,
                    "permission" => "*",
                    "title" => "User Roles",
                    "uri" => "user-roles"
                ],
                [
                    "icon" => "fa-car",
                    "order" => 12,
                    "parent_id" => 0,
                    "permission" => "*",
                    "title" => "Drivers",
                    "uri" => "drivers"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Permission::truncate();
        \Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "http_method" => "",
                    "http_path" => "*",
                    "name" => "All permission",
                    "slug" => "*"
                ],
                [
                    "http_method" => "GET",
                    "http_path" => "/",
                    "name" => "Dashboard",
                    "slug" => "dashboard"
                ],
                [
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout",
                    "name" => "Login",
                    "slug" => "auth.login"
                ],
                [
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting",
                    "name" => "User setting",
                    "slug" => "auth.setting"
                ],
                [
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
                    "name" => "Auth management",
                    "slug" => "auth.management"
                ],
                [
                    "http_method" => "",
                    "http_path" => "/plans*",
                    "name" => "Plans",
                    "slug" => "plans"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Role::truncate();
        \Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "name" => "Administrator",
                    "slug" => "administrator"
                ],
                [
                    "name" => "Driver",
                    "slug" => "driver"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "menu_id" => 2,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 8,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 9,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 10,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 11,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 12,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 8,
                    "role_id" => 2
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "permission_id" => 1,
                    "role_id" => 1
                ],
                [
                    "permission_id" => 2,
                    "role_id" => 2
                ],
                [
                    "permission_id" => 3,
                    "role_id" => 2
                ],
                [
                    "permission_id" => 6,
                    "role_id" => 2
                ]
            ]
        );

        // finish
    }
}
