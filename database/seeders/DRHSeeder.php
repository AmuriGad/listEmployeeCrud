<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DRHSeeder extends Seeder
{
    /**
     * Insère le compte DRH par défaut.
     */
    public function run(): void
    {
        Employee::updateOrCreate(
            ['email' => 'drh@entreprise.com'],
            [
                'nom'          => 'Administrateur',
                'prenom'       => 'DRH',
                'postnom'      => null,
                'email'        => 'drh@entreprise.com',
                'telephone'    => null,
                'poste'        => 'DRH',
                'departement'  => 'Direction des Ressources Humaines',
                'date_embauche'=> now()->toDateString(),
                'password'     => Hash::make('DRH@2026!'),
                'service_id'   => null,
            ]
        );

        $this->command->info('✅ Compte DRH créé : drh@entreprise.com / DRH@2026!');
    }
}
