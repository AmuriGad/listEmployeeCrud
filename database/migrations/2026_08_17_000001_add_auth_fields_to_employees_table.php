<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter les champs d'authentification à la table employees.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Ajoute password s'il n'existe pas déjà
            if (!Schema::hasColumn('employees', 'password')) {
                $table->string('password')->nullable()->after('date_embauche');
            }
            // Ajoute remember_token pour l'auth Laravel
            if (!Schema::hasColumn('employees', 'remember_token')) {
                $table->rememberToken()->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['remember_token']);
        });
    }
};
