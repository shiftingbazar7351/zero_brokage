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
            ['name' => 'user-status', 'title' => 'User Status', 'guard_name' => 'web'],

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
            ['name' => 'menus-status', 'title' => 'Menu Status', 'guard_name' => 'web'],

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

            ['name' => 'employee-product-list', 'title' => 'Employee-product List', 'guard_name' => 'web'],
            ['name' => 'employee-product-create', 'title' => 'Employee-product Create', 'guard_name' => 'web'],
            ['name' => 'employee-product-edit', 'title' => 'Employee-product Edit', 'guard_name' => 'web'],
            ['name' => 'employee-product-status', 'title' => 'Employee-product Status', 'guard_name' => 'web'],
            ['name' => 'employee-product-show', 'title' => 'Employee-product Show', 'guard_name' => 'web'],
            ['name' => 'employee-product-delete', 'title' => 'Employee-product Delete', 'guard_name' => 'web'],

            ['name' => 'employee-headoffice-list', 'title' => 'Employee-headoffice List', 'guard_name' => 'web'],
            ['name' => 'employee-headoffice-create', 'title' => 'Employee-headoffice Create', 'guard_name' => 'web'],
            ['name' => 'employee-headoffice-edit', 'title' => 'Employee-headoffice Edit', 'guard_name' => 'web'],
            ['name' => 'employee-headoffice-status', 'title' => 'Employee-headoffice Status', 'guard_name' => 'web'],
            ['name' => 'employee-headoffice-show', 'title' => 'Employee-headoffice Show', 'guard_name' => 'web'],
            ['name' => 'employee-headoffice-delete', 'title' => 'Employee-headoffice Delete', 'guard_name' => 'web'],

            ['name' => 'employee-branch-list', 'title' => 'Employee-branch List', 'guard_name' => 'web'],
            ['name' => 'employee-branch-create', 'title' => 'Employee-branch Create', 'guard_name' => 'web'],
            ['name' => 'employee-branch-edit', 'title' => 'Employee-branch Edit', 'guard_name' => 'web'],
            ['name' => 'employee-branch-status', 'title' => 'Employee-branch Status', 'guard_name' => 'web'],
            ['name' => 'employee-branch-show', 'title' => 'Employee-branch Show', 'guard_name' => 'web'],
            ['name' => 'employee-branch-delete', 'title' => 'Employee-branch Delete', 'guard_name' => 'web'],

            ['name' => 'employee-department-list', 'title' => 'Employee-department List', 'guard_name' => 'web'],
            ['name' => 'employee-department-create', 'title' => 'Employee-department Create', 'guard_name' => 'web'],
            ['name' => 'employee-department-edit', 'title' => 'Employee-department Edit', 'guard_name' => 'web'],
            ['name' => 'employee-department-status', 'title' => 'Employee-department Status', 'guard_name' => 'web'],
            ['name' => 'employee-department-show', 'title' => 'Employee-department Show', 'guard_name' => 'web'],
            ['name' => 'employee-department-delete', 'title' => 'Employee-department Delete', 'guard_name' => 'web'],

            ['name' => 'employee-list', 'title' => 'Employee List', 'guard_name' => 'web'],
            ['name' => 'employee-create', 'title' => 'Employee Create', 'guard_name' => 'web'],
            ['name' => 'employee-edit', 'title' => 'Employee Edit', 'guard_name' => 'web'],
            ['name' => 'employee-status', 'title' => 'Employee Status', 'guard_name' => 'web'],
            ['name' => 'employee-show', 'title' => 'Employee Show', 'guard_name' => 'web'],
            ['name' => 'employee-delete', 'title' => 'Employee Delete', 'guard_name' => 'web'],

            ['name' => 'employee-company-list', 'title' => 'Employee Company List', 'guard_name' => 'web'],
            ['name' => 'employee-company-create', 'title' => 'Employee Company Create', 'guard_name' => 'web'],
            ['name' => 'employee-company-edit', 'title' => 'Employee Company Edit', 'guard_name' => 'web'],
            ['name' => 'employee-company-status', 'title' => 'Employee Company Status', 'guard_name' => 'web'],
            ['name' => 'employee-company-show', 'title' => 'Employee Company Show', 'guard_name' => 'web'],
            ['name' => 'employee-company-delete', 'title' => 'Employee Company Delete', 'guard_name' => 'web'],

            ['name' => 'employee-salary-list', 'title' => 'Employee-salary List', 'guard_name' => 'web'],
            ['name' => 'employee-salary-create', 'title' => 'Employee-salary Create', 'guard_name' => 'web'],
            ['name' => 'employee-salary-edit', 'title' => 'Employee-salary Edit', 'guard_name' => 'web'],
            ['name' => 'employee-salary-status', 'title' => 'Employee-salary Status', 'guard_name' => 'web'],
            ['name' => 'employee-salary-show', 'title' => 'Employee-salary Show', 'guard_name' => 'web'],
            ['name' => 'employee-salary-delete', 'title' => 'Employee-salary Delete', 'guard_name' => 'web'],

            ['name' => 'employee-bank-list', 'title' => 'Employee-bank List', 'guard_name' => 'web'],
            ['name' => 'employee-bank-create', 'title' => 'Employee-bank Create', 'guard_name' => 'web'],
            ['name' => 'employee-bank-edit', 'title' => 'Employee-bank Edit', 'guard_name' => 'web'],
            ['name' => 'employee-bank-status', 'title' => 'Employee-bank Status', 'guard_name' => 'web'],
            ['name' => 'employee-bank-show', 'title' => 'Employee-bank Show', 'guard_name' => 'web'],
            ['name' => 'employee-bank-delete', 'title' => 'Employee-bank Delete', 'guard_name' => 'web'],


            ['name' => 'employee-hr-list', 'title' => 'Employee-hr List', 'guard_name' => 'web'],
            ['name' => 'employee-hr-create', 'title' => 'Employee-hr Create', 'guard_name' => 'web'],
            ['name' => 'employee-hr-edit', 'title' => 'Employee-hr Edit', 'guard_name' => 'web'],
            ['name' => 'employee-hr-status', 'title' => 'Employee-hr Status', 'guard_name' => 'web'],
            ['name' => 'employee-hr-show', 'title' => 'Employee-hr Show', 'guard_name' => 'web'],
            ['name' => 'employee-hr-delete', 'title' => 'Employee-hr Delete', 'guard_name' => 'web'],


            ['name' => 'vendor-task-list', 'title' => 'Vendor-task List', 'guard_name' => 'web'],
            ['name' => 'vendor-task-create', 'title' => 'Vendor-task Create', 'guard_name' => 'web'],
            ['name' => 'vendor-task-edit', 'title' => 'Vendor-task Edit', 'guard_name' => 'web'],
            ['name' => 'vendor-task-status', 'title' => 'Vendor-task Status', 'guard_name' => 'web'],
            ['name' => 'vendor-task-show', 'title' => 'Vendor-task Show', 'guard_name' => 'web'],
            ['name' => 'vendor-task-delete', 'title' => 'Vendor-task Delete', 'guard_name' => 'web'],

            ['name' => 'holiday-list', 'title' => 'Holiday List', 'guard_name' => 'web'],
            ['name' => 'holiday-create', 'title' => 'Holiday Create', 'guard_name' => 'web'],
            ['name' => 'holiday-edit', 'title' => 'Holiday Edit', 'guard_name' => 'web'],
            ['name' => 'holiday-status', 'title' => 'Holiday Status', 'guard_name' => 'web'],
            ['name' => 'holiday-show', 'title' => 'Holiday Show', 'guard_name' => 'web'],
            ['name' => 'holiday-delete', 'title' => 'Holiday Delete', 'guard_name' => 'web'],

            ['name' => 'package-list', 'title' => 'Package List', 'guard_name' => 'web'],
            ['name' => 'package-create', 'title' => 'Package Create', 'guard_name' => 'web'],
            ['name' => 'package-edit', 'title' => 'Package Edit', 'guard_name' => 'web'],
            ['name' => 'package-status', 'title' => 'Package Status', 'guard_name' => 'web'],
            ['name' => 'package-show', 'title' => 'Package Show', 'guard_name' => 'web'],
            ['name' => 'package-delete', 'title' => 'Package Delete', 'guard_name' => 'web'],

        ];
        Permission::insert($permissions);
    }
}
