<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;


    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $has_categoria_pai = rand(0, 1);
        $categoria_pai = Categoria::find(rand(1, Categoria::max('id') - 1 ));
        //nome da categoria com Primeira letra maiuscula
        $nome = ucfirst($this->faker->word());
        return [
            'nome' =>$nome ,
            'categoria_pai_id' => $has_categoria_pai ? $categoria_pai->id : null
        ];
    }
}
