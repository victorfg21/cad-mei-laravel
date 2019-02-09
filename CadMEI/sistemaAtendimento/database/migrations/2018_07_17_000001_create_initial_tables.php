<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 150);
            $table->timestamps();
        });

        Schema::create('setores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 150);
            $table->timestamps();
        });

        Schema::create('empresarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('rg', 30);
            $table->string('cpf', 11);
            $table->string('titulo_eleitor', 12);
            $table->date('nascimento');
            $table->string('sexo', 1);
            $table->string('email', 200)->nullable();
            $table->string('celular', 11);
            $table->integer('numero');
            $table->string('endereco', 150);
            $table->string('complemento', 150)->nullable();
            $table->string('bairro', 150);
            $table->string('cidade', 150);
            $table->string('estado', 2);
            $table->string('cep', 8)->nullable();
            $table->timestamps();
        });

        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('nome', 200);
            $table->unsignedInteger('empresario_id');            
            $table->unsignedInteger('setor_id');            
            $table->date('abertura');
            $table->string('cnpj', 14);
            $table->string('cnae', 7);
            $table->string('senha_nfse', 200);
            $table->string('senha_simples_nacional', 200);
            $table->string('outros', 500)->nullable();
            $table->integer('numero');
            $table->string('endereco', 150);
            $table->string('complemento', 150)->nullable();
            $table->string('bairro', 150);
            $table->string('cidade', 150);
            $table->string('estado', 2);
            $table->string('cep', 8);
            $table->timestamps();

            $table->foreign('empresario_id')->references('id')->on('empresarios')->onDelete('set null');
            $table->foreign('setor_id')->references('id')->on('setores')->onDelete('set null');
        });

        Schema::create('atendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('empresa_id');
            $table->string('data', 10);
            $table->string('hora', 8);
            $table->string('ano_declaracao', 4)->nullable();
            $table->decimal('valor_total', 20, 2)->nullable();
            $table->string('observacao', 500)->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('set null');
        });

        Schema::create('atendimento_servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('servico_id');
            $table->unsignedInteger('atendimento_id');

            $table->foreign('servico_id')->references('id')->on('servicos');
            $table->foreign('atendimento_id')->references('id')->on('atendimentos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            'atendimento_servicos',
            'atendimentos',            
            'empresas',
            'empresarios',            
            'servicos',
            'setores',
        ];

        foreach($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
}
