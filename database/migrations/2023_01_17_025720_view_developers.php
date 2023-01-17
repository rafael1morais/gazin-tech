<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE VIEW view_developers
            AS
            SELECT d.id as id,
                    l.nivel as nivel,
                    d.nome as nome,
                    CASE WHEN d.sexo = 'F' THEN 'Feminino' 
                        ELSE 'Masculino'
                    END as sexo,
                    DATE_FORMAT(STR_TO_DATE(d.datanascimento, '%Y-%m-%d'), '%d/%m/%Y') as data_nascimento,
                    d.datanascimento as datanascimento,
                    d.idade as idade,
                    d.hobby as hobby
            FROM developers d
            INNER JOIN levels l on l.id = d.nivel;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
