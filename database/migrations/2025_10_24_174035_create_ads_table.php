<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();

            // Chave estrangeira: Qual usuário postou?
            // constrained() -> liga com a tabela 'users' (na coluna 'id')
            // onDelete('cascade') -> Se um usuário for deletado, seus anúncios também serão.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Chave estrangeira: Qual categoria?
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->string('slug')->unique(); // URL amigável (ex: "vende-se-fusca-azul")
            $table->text('description');
            $table->decimal('price', 10, 2); // 10 dígitos no total, 2 depois da vírgula
            $table->string('location');
            $table->string('image_path')->nullable(); // Caminho da imagem (opcional por enquanto)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
};
