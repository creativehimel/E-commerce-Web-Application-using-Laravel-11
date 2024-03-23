<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPagesRecords = [
            [
                "id" => 1,
                "title" => "About Us",
                "slug" => "about-us",
                "description" => "Content is coming soon",
                "meta_title" => "About Us",
                "meta_description" => "Content is coming soon",
                "meta_keywords" => "about us, about",
                "status" => 1
            ],
            [
                "id" => 2,
                "title" => "Privacy Policy",
                "slug" => "privacy-policy",
                "description" => "Content is coming soon",
                "meta_title" => "Privacy Policy",
                "meta_description" => "Content is coming soon",
                "meta_keywords" => "privacy policy, privacy",
                "status" => 1
            ],
            [
                "id" => 3,
                "title" => "Terms & Conditions",
                "slug" => "terms-and-conditions",
                "description" => "Content is coming soon",
                "meta_title" => "Terms & Conditions",
                "meta_description" => "Content is coming soon",
                "meta_keywords" => "terms and conditions, terms",
                "status" => 1
            ],
            [
                "id" => 4,
                "title" => "Contact Us",
                "slug" => "contact-us",
                "description" => "Content is coming soon",
                "meta_title" => "Contact Us",
                "meta_description" => "Content is coming soon",
                "meta_keywords" => "contact us, contact",
                "status" => 1
            ],
            [
                "id" => 5,
                "title" => "FAQ",
                "slug" => "faq",
                "description" => "Content is coming soon",
                "meta_title" => "FAQ",
                "meta_description" => "Content is coming soon",
                "meta_keywords" => "faq, faq",
                "status" => 1
            ],
            [
                "id" => 6,
                "title" => "Blog",
                "slug" => "blog",
                "description" => "Content is coming soon",
                "meta_title" => "Blog",
                "meta_description" => "Content is coming soon",
                "meta_keywords" => "blog, blog",
                "status" => 1
            ]
        ];

        foreach ($cmsPagesRecords as $record) {
            CmsPage::create($record);
        }
    }
}
