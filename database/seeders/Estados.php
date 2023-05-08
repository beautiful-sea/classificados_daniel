<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Estados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Regex para selecionar todos os valores depois da sigla no insert abaixo

        $sql = "INSERT INTO estados (nome, sigla) VALUES
                ('Acre', 'AC'),
                ('Alagoas', 'AL'),
                ('Amazonas', 'AM'),
                ('Amapá', 'AP'),
                ('Bahia', 'BA'),
                ('Ceará', 'CE'),
                ('Distrito Federal', 'DF'),
                ('Espírito Santo', 'ES'),
                ('Goiás', 'GO'),
                ('Maranhão', 'MA'),
                ('Minas Gerais', 'MG'),
                ('Mato Grosso do Sul', 'MS'),
                ('Mato Grosso', 'MT'),
                ('Pará', 'PA'),
                ('Paraíba', 'PB'),
                ('Pernambuco', 'PE'),
                ('Piauí', 'PI'),
                ('Paraná', 'PR'),
                ('Rio de Janeiro', 'RJ'),
                ('Rio Grande do Norte', 'RN'),
                ('Rondônia', 'RO'),
                ('Roraima', 'RR'),
                ('Rio Grande do Sul', 'RS'),
                ('Santa Catarina', 'SC'),
                ('Sergipe', 'SE'),
                ('São Paulo', 'SP'),
                ('Tocantins', 'TO');" ;

        DB::insert($sql);
        echo "Estados inseridos com sucesso!";
    }
}
