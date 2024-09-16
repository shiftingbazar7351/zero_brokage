<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'role', 'title' => 'Role', 'guard_name' => 'web'],
            ['name' => 'role-add', 'title' => 'Role Add', 'guard_name' => 'web'],
            ['name' => 'role-list', 'title' => 'Role List', 'guard_name' => 'web'],
            ['name' => 'permission', 'title' => 'Permission', 'guard_name' => 'web'],
            ['name' => 'permission-add', 'title' => 'Permission Add', 'guard_name' => 'web'],
            ['name' => 'permission-list', 'title' => 'Permission List', 'guard_name' => 'web'],

            ['name' => 'user-list', 'title' => 'User List', 'guard_name' => 'web'],
            ['name' => 'user-create', 'title' => 'User Create', 'guard_name' => 'web'],
            ['name' => 'user-edit', 'title' => 'User Edit', 'guard_name' => 'web'],
            ['name' => 'user-delete', 'title' => 'User Delete', 'guard_name' => 'web'],
            ['name' => 'user-show', 'title' => 'User Show', 'guard_name' => 'web'],

            ['name' => 'categories-list', 'title' => 'Categories List', 'guard_name' => 'web'],
            ['name' => 'categories-create', 'title' => 'Categories Create', 'guard_name' => 'web'],
            ['name' => 'categories-edit', 'title' => 'Categories Edit', 'guard_name' => 'web'],
            ['name' => 'categories-show', 'title' => 'Categories Show', 'guard_name' => 'web'],
            ['name' => 'categories-delete', 'title' => 'Categories Delete', 'guard_name' => 'web'],
            ['name' => 'categories-status', 'title' => 'Categories Status', 'guard_name' => 'web'],

            ['name' => 'subcategory-list', 'title' => 'Sub Category List', 'guard_name' => 'web'],
            ['name' => 'subcategory-create', 'title' => 'Sub Category Create', 'guard_name' => 'web'],
            ['name' => 'subcategory-edit', 'title' => 'Sub Category Edit', 'guard_name' => 'web'],
            ['name' => 'subcategory-show', 'title' => 'Sub Category Show', 'guard_name' => 'web'],
            ['name' => 'subcategory-delete', 'title' => 'Sub Category Delete', 'guard_name' => 'web'],
            ['name' => 'subcategories-status', 'title' => 'Sub Category Status', 'guard_name' => 'web'],

            ['name' => 'menus-list', 'title' => 'Menu List', 'guard_name' => 'web'],
            ['name' => 'menus-create', 'title' => 'Menu Create', 'guard_name' => 'web'],
            ['name' => 'menus-edit', 'title' => 'Menu Edit', 'guard_name' => 'web'],
            ['name' => 'menus-show', 'title' => 'Menu Show', 'guard_name' => 'web'],
            ['name' => 'menus-delete', 'title' => 'Menu Delete', 'guard_name' => 'web'],
            ['name' => 'menus-status', 'title' => 'Menu Delete', 'guard_name' => 'web'],

            ['name' => 'submenu-list', 'title' => 'Sub Menu List', 'guard_name' => 'web'],
            ['name' => 'submenu-create', 'title' => 'Sub Menu Create', 'guard_name' => 'web'],
            ['name' => 'submenu-edit', 'title' => 'Sub Menu Edit', 'guard_name' => 'web'],
            ['name' => 'submenu-show', 'title' => 'Sub Menu Show', 'guard_name' => 'web'],
            ['name' => 'submenu-delete', 'title' => 'Sub Menu Delete', 'guard_name' => 'web'],
            ['name' => 'submenu-status', 'title' => 'Sub Menu Status', 'guard_name' => 'web'],

            ['name' => 'enquiry-list', 'title' => 'Enquiry List', 'guard_name' => 'web'],
            ['name' => 'enquiry-create', 'title' => 'Enquiry Create', 'guard_name' => 'web'],
            ['name' => 'enquiry-edit', 'title' => 'Enquiry Edit', 'guard_name' => 'web'],
            ['name' => 'enquiry-show', 'title' => 'Enquiry Show', 'guard_name' => 'web'],
            ['name' => 'enquiry-delete', 'title' => 'Enquiry Delete', 'guard_name' => 'web'],
            ['name' => 'enquiry-status', 'title' => 'Enquiry Status', 'guard_name' => 'web'],

            ['name' => 'service-detail-list', 'title' => 'Service Detail List', 'guard_name' => 'web'],
            ['name' => 'service-detail-create', 'title' => 'Service Detail Create', 'guard_name' => 'web'],
            ['name' => 'service-detail-edit', 'title' => 'Service Detail Edit', 'guard_name' => 'web'],
            ['name' => 'service-detail-show', 'title' => 'Service Detail Show', 'guard_name' => 'web'],
            ['name' => 'service-detail-delete', 'title' => 'Service Detail Delete', 'guard_name' => 'web'],

            ['name' => 'meta-list', 'title' => 'Meta List', 'guard_name' => 'web'],
            ['name' => 'meta-create', 'title' => 'Meta Create', 'guard_name' => 'web'],
            ['name' => 'meta-edit', 'title' => 'Meta Edit', 'guard_name' => 'web'],
            ['name' => 'meta-show', 'title' => 'Meta Show', 'guard_name' => 'web'],
            ['name' => 'meta-delete', 'title' => 'Meta Delete', 'guard_name' => 'web'],

            ['name' => 'verified-list', 'title' => 'Verified List', 'guard_name' => 'web'],
            ['name' => 'verified-create', 'title' => 'Verified Create', 'guard_name' => 'web'],
            ['name' => 'verified-edit', 'title' => 'Verified Edit', 'guard_name' => 'web'],
            ['name' => 'verified-show', 'title' => 'Verified Show', 'guard_name' => 'web'],
            ['name' => 'verified-delete', 'title' => 'Verified Delete', 'guard_name' => 'web'],
            ['name' => 'verified-status', 'title' => 'Verified Status', 'guard_name' => 'web'],

            ['name' => 'vendors-list', 'title' => 'Vendor List', 'guard_name' => 'web'],
            ['name' => 'vendors-create', 'title' => 'Vendor Create', 'guard_name' => 'web'],
            ['name' => 'vendors-edit', 'title' => 'Vendor Edit', 'guard_name' => 'web'],
            ['name' => 'vendors-show', 'title' => 'Vendor Show', 'guard_name' => 'web'],
            ['name' => 'vendors-delete', 'title' => 'Vendor Delete', 'guard_name' => 'web'],
            ['name' => 'vendors-status', 'title' => 'Vendor Status', 'guard_name' => 'web'],

            ['name' => 'product-list', 'title' => 'Product List', 'guard_name' => 'web'],
            ['name' => 'product-create', 'title' => 'Product Create', 'guard_name' => 'web'],
            ['name' => 'product-edit', 'title' => 'Product Edit', 'guard_name' => 'web'],
            ['name' => 'product-show', 'title' => 'Product Show', 'guard_name' => 'web'],
            ['name' => 'product-delete', 'title' => 'Product Delete', 'guard_name' => 'web'],

            ['name' => 'ipaddress-list', 'title' => 'IP Address List', 'guard_name' => 'web'],
            ['name' => 'ipaddress-create', 'title' => 'IP Address Create', 'guard_name' => 'web'],
            ['name' => 'ipaddress-edit', 'title' => 'IP Address Edit', 'guard_name' => 'web'],
            ['name' => 'ipaddress-delete', 'title' => 'IP Address Delete', 'guard_name' => 'web'],
            ['name' => 'ipaddress-show', 'title' => 'IP Address Show', 'guard_name' => 'web'],
            ['name' => 'ipaddress-status', 'title' => 'IP Address Status', 'guard_name' => 'web'],

            ['name' => 'reviews-list', 'title' => 'Reviews List', 'guard_name' => 'web'],
            ['name' => 'reviews-create', 'title' => 'Reviews Create', 'guard_name' => 'web'],
            ['name' => 'reviews-edit', 'title' => 'Reviews Edit', 'guard_name' => 'web'],
            ['name' => 'reviews-show', 'title' => 'Reviews Show', 'guard_name' => 'web'],
            ['name' => 'reviews-delete', 'title' => 'Reviews Delete', 'guard_name' => 'web'],

            ['name' => 'faq-list', 'title' => 'Faq List', 'guard_name' => 'web'],
            ['name' => 'faq-create', 'title' => 'Faq Create', 'guard_name' => 'web'],
            ['name' => 'faq-edit', 'title' => 'Faq Edit', 'guard_name' => 'web'],
            ['name' => 'faq-show', 'title' => 'Faq Show', 'guard_name' => 'web'],
            ['name' => 'faq-delete', 'title' => 'Faq Delete', 'guard_name' => 'web'],
            ['name' => 'faq-status', 'title' => 'Faq Status', 'guard_name' => 'web'],


            ['name' => 'india-services-list', 'title' => 'India Services List', 'guard_name' => 'web'],
            ['name' => 'india-services-create', 'title' => 'India Services Create', 'guard_name' => 'web'],
            ['name' => 'india-services-edit', 'title' => 'India Services Edit', 'guard_name' => 'web'],
            ['name' => 'india-services-show', 'title' => 'India Services Show', 'guard_name' => 'web'],
            ['name' => 'india-services-delete', 'title' => 'India Services Delete', 'guard_name' => 'web'],

            ['name' => 'transaction-list', 'title' => 'Transaction List', 'guard_name' => 'web'],
            ['name' => 'transaction-create', 'title' => 'Transaction Create', 'guard_name' => 'web'],
            ['name' => 'transaction-edit', 'title' => 'Transaction Edit', 'guard_name' => 'web'],
            ['name' => 'transaction-status', 'title' => 'Transaction Status', 'guard_name' => 'web'],
            ['name' => 'transaction-show', 'title' => 'Transaction Show', 'guard_name' => 'web'],
            ['name' => 'transaction-delete', 'title' => 'Transaction Delete', 'guard_name' => 'web'],
            ['name' => 'transaction-approvals', 'title' => 'Transaction Approvals', 'guard_name' => 'web'],

            ['name' => 'invoice-list', 'title' => 'Invoice List', 'guard_name' => 'web'],
            ['name' => 'invoice-create', 'title' => 'Invoice Create', 'guard_name' => 'web'],
            ['name' => 'invoice-edit', 'title' => 'Invoice Edit', 'guard_name' => 'web'],
            ['name' => 'invoice-show', 'title' => 'Invoice Show', 'guard_name' => 'web'],
            ['name' => 'invoice-delete', 'title' => 'Invoice Delete', 'guard_name' => 'web'],

            ['name' => 'newsletter-list', 'title' => 'Newsletter List', 'guard_name' => 'web'],

        ];
        Permission::insert($permissions);
    }
}
