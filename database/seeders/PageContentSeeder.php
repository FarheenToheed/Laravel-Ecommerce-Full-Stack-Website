<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageContent;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'page_name' => 'Exchange & Return',
                'page_link' => 'exchange-return',
                'content' => '<p>Our exchange and return policy allows you to return products within 7 days of delivery, provided they are unused and in original packaging.</p>',
            ],
            [
                'page_name' => 'About Us',
                'page_link' => 'about',
                'content' => '<p>Sapphire is a leading fashion brand offering premium quality clothing for men, women, and kids.</p>',
            ],
            [
                'page_name' => 'Privacy Policy',
                'page_link' => 'privacy-policy',
                'content' => '<p>We value your privacy. Your personal information is collected and used only to process your orders and improve our services.</p>',
            ],
            [
                'page_name' => 'Payments',
                'page_link' => 'payments',
                'content' => '<p>We accept payments via credit/debit cards, bank transfer, and cash on delivery.</p>',
            ],
        ];

        foreach ($pages as $page) {
            PageContent::firstOrCreate(
                ['page_link' => $page['page_link']],
                $page
            );
        }
    }
}
