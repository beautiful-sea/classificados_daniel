<?php

namespace Database\Factories;

use App\Models\Anunciante;
use App\Models\Cidade;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;


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
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'photo_path' =>  null,
            'phone' => $this->faker->phoneNumber,
            'remember_token' => null,
            'role' => 'visitante',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            DB:: beginTransaction();
            try{
                $name = $user->id . '_' . Str::slug($user->name, '_'). '.jpg';
                $foto_path = UploadedFile::fake()->image($name, 200, 200)->storeAs('users', $name, 'public');
                $user->photo_path = $foto_path;
                $user->save();

                //Foto principal é uma imagem 240x160 com o nome  'anunciantes/foto_principal_' . $id.$extension  relacionada a categoria da profissao do anunciante
                $foto_principal =  UploadedFile::fake()->image('foto_principal', 240, 160)->storeAs('anunciantes', 'foto_principal_' . $user->id . '.jpg', 'public');

                $slug = Str::slug($user->name); //gera o slug
                //verifica se o slug já existe no banco de dados
                if (Anunciante::where('slug', $slug)->exists()) {
                    //se já existe, adiciona um número aleatório ao final
                    $slug .= '-' . rand(1, 9999);
                }
                $user->anunciante()->create([
                    'subcategoria_id' => rand(1, 10),
                    'titulo' => $this->faker->sentence(),
                    'descricao' => $this->faker->text(),
                    'valor_hora' => rand(50, 200),
                    'slug' => $slug,
                    'foto_principal' => $foto_principal
                ]);

                $cidade = Cidade::find(rand(1, 10));
                $user->endereco()->create([
                    'cep' => $this->faker->postcode,
                    'logradouro' => $this->faker->streetAddress,
                    'cidade_id' => $cidade->id,
                    'estado_id' => $cidade->estado_id,
                ]);
                DB::commit();
            }catch (\Exception $e){
                echo $e->getMessage();
                DB::rollBack();
            }
        });
    }
}
