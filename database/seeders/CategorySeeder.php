<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;

class CategorySeeder extends Seeder
{
    /**
     * Categories, SubCategories aur ChildCategories seed karta hai.
     */
    public function run(): void
    {
        $data = [
            'Woman' => [
                'Kurtas' => ['Printed Kurtas', 'Plain Kurtas'],
                'Lawn Suits' => ['Stitched', 'Unstitched'],
            ],
            'Man' => [
                'Shirts' => ['Formal Shirts', 'Casual Shirts'],
                'Kurta Shalwar' => ['Plain', 'Embroidered'],
            ],
            'Kids' => [
                'T-Shirts' => ['Printed T-Shirts', 'Plain T-Shirts'],
            ],
        ];

        foreach ($data as $categoryName => $subCategories) {

            $category = Category::create(['name' => $categoryName]);

            foreach ($subCategories as $subCategoryName => $childCategories) {

                $subCategory = SubCategory::create([
                    'name' => $subCategoryName,
                    'category_id' => $category->id,
                ]);

                foreach ($childCategories as $childCategoryName) {
                    ChildCategory::create([
                        'name' => $childCategoryName,
                        'subcategory_id' => $subCategory->id,
                    ]);
                }
            }
        }
    }
}
