<?php

use App\Models\Image;
use App\Models\Technologie;
use Database\Factories\TechnologieFactory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projet', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description_courte');
            $table->text('description_longue')->nullable();
            $table->string('type');
            $table->string('statut');
            $table->date('date');
            $table->string('client');
            $table->string('contexte');
            $table->string('duree')->nullable();
            $table->string('role')->nullable();
            $table->string('projet_url');
            $table->string('github_url')->nullable();
            $table->integer('ordre_affichage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projet');
    }
};
