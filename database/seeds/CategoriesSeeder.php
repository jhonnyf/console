<?php

use App\Models\Categories;
use App\Models\ContentsCategories;
use App\Models\Languages;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{

    public function run()
    {
        $this->create('Root'); // 1

        /**
         * Nivel 0
         */

        $response = $this->create('Usuários'); // 2
        Categories::find($response)->categoryPrimary()->attach(1);

        $response = $this->create('Páginas'); // 3
        Categories::find($response)->categoryPrimary()->attach(1);

        /**
         * Nivel 1
         */

        $response = $this->create('Root');
        Categories::find($response)->categoryPrimary()->attach(2);

        $response = $this->create('Administrador');
        Categories::find($response)->categoryPrimary()->attach(2);

        $response = $this->create('Cliente');
        Categories::find($response)->categoryPrimary()->attach(2);

        $response = $this->create('Home');
        Categories::find($response)->categoryPrimary()->attach(3);
    }

    private function create(string $name): int
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

        return $response->id;
    }
}
