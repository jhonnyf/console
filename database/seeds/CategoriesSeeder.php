<?php

use App\Models\Categories;
use App\Models\CategoriesCategories;
use App\Models\ContentsCategories;
use App\Models\Languages;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{

    public function run()
    {
        $this->create('Root'); // 1

        $this->create('Usuários'); // 2
        CategoriesCategories::create(['primary_id' => 1, 'secondary_id' => 2]);
        $this->create('Páginas'); // 3
        CategoriesCategories::create(['primary_id' => 1, 'secondary_id' => 3]);

        $this->create('Root'); // 4
        CategoriesCategories::create(['primary_id' => 2, 'secondary_id' => 4]);
        $this->create('Administrador'); // 5
        CategoriesCategories::create(['primary_id' => 2, 'secondary_id' => 5]);
        $this->create('Cliente'); // 6
        CategoriesCategories::create(['primary_id' => 2, 'secondary_id' => 6]);

        $this->create('Home'); // 7
        CategoriesCategories::create(['primary_id' => 3, 'secondary_id' => 7]);
    }

    private function create(string $name): void
    {

        $response = Categories::create(['default' => true]);

        $languages = Languages::where('active', '<>', 2)->orderBy('default', 'desc');
        if ($languages->exists()) {
            $reference_id = null;
            foreach ($languages->get() as $key => $language) {
                $insert = [
                    'language_id'   => $language->id,
                    'categories_id' => $response->id,
                    'reference_id'  => $reference_id,
                    'title'         => $name,
                ];

                $responseContentsCategories = ContentsCategories::create($insert);
                if (is_null($reference_id)) {
                    $reference_id = $responseContentsCategories->id;
                }

            }
        }

    }
}
