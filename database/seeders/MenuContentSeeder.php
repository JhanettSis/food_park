<?php

namespace Database\Seeders;

use Bdacademy\LaravelMenu\Models\MenuItems;
use Bdacademy\LaravelMenu\Models\Menus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert menus
        $mainMenu = Menus::create(['name' => 'main_menu']);
        $footerMenuOne = Menus::create(['name' => 'footer_menu_one']);
        $footerMenuTwo = Menus::create(['name' => 'footer_menu_two']);
        $footerMenuThree = Menus::create(['name' => 'footer_menu_three']);

        // Insert menu items for main_menu
        MenuItems::insert([
            ['label' => 'Home',                 'link' => '/',          'parent' => 0, 'sort' => 0, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 0],
            ['label' => 'About',                'link' => '/about',     'parent' => 0, 'sort' => 1, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 0],
            ['label' => 'Menu',                 'link' => '/menu-food',      'parent' => 0, 'sort' => 2, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 0],
            ['label' => 'Chefs',                'link' => '/chef',      'parent' => 0, 'sort' => 3, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 0],

            ['label' => 'Pages',                'link' => '',           'parent' => 0, 'sort' => 4, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 0],
            ['label' => 'All Products',         'link' => '/products',      'parent' => 5, 'sort' => 0, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 1],
            ['label' => 'Terms & Conditions',   'link' => '/terms-conditions', 'parent' => 5, 'sort' => 1, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 1],
            ['label' => 'Privacy Policy',       'link' => '/privacy-policy', 'parent' => 5, 'sort' => 2, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 1],
            ['label' => 'Testimonials',         'link' => '/testimonials', 'parent' => 5, 'sort' => 3, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 1],

            ['label' => 'Blog',                 'link' => '/blogs',     'parent' => 0, 'sort' => 5, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 0],
            ['label' => 'Contact Us',           'link' => '/contact',   'parent' => 0, 'sort' => 6, 'class' => '', 'menu' => $mainMenu->id, 'depth' => 0],
        ]);

        // Insert menu items for footer_menu_one
        MenuItems::insert([
            ['label' => 'Home', 'link' => '/', 'parent' => 0, 'sort' => 0, 'class' => '', 'menu' => $footerMenuOne->id, 'depth' => 0],
            ['label' => 'About Us', 'link' => '/about', 'parent' => 0, 'sort' => 1, 'class' => '', 'menu' => $footerMenuOne->id, 'depth' => 0],
            ['label' => 'Contact Us', 'link' => '/contact', 'parent' => 0, 'sort' => 2, 'class' => '', 'menu' => $footerMenuOne->id, 'depth' => 0],
            ['label' => 'All Products', 'link' => '/products', 'parent' => 0, 'sort' => 3, 'class' => '', 'menu' => $footerMenuOne->id, 'depth' => 0],
        ]);

        // Insert menu items for footer_menu_two
        MenuItems::insert([
            ['label' => 'Blog', 'link' => '/blogs', 'parent' => 0, 'sort' => 0, 'class' => '', 'menu' => $footerMenuTwo->id, 'depth' => 0],
            ['label' => 'Testimonials', 'link' => '/testimonials', 'parent' => 0, 'sort' => 1, 'class' => '', 'menu' => $footerMenuTwo->id, 'depth' => 0],
        ]);

        // Insert menu items for footer_menu_three
        MenuItems::insert([
            ['label' => 'Terms & Conditions', 'link' => '/terms-conditions', 'parent' => 0, 'sort' => 0, 'class' => '', 'menu' => $footerMenuThree->id, 'depth' => 0],
            ['label' => 'Privacy Policy', 'link' => '/privacy-policy', 'parent' => 0, 'sort' => 1, 'class' => '', 'menu' => $footerMenuThree->id, 'depth' => 0],
        ]);
    }
}
