<?php

namespace Database\Seeders;

use App\Models\TypeConge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCongeSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Insérer les types de congé par défaut.
     */
    public function run(): void
    {
        $types = [
            [
                'libelle'     => 'Congé de maladie',
                'description' => 'Congé accordé pour raison de santé (maladie, hospitalisation, etc.).',
            ],
            [
                'libelle'     => 'Congé annuel',
                'description' => 'Congé payé annuel accordé à chaque employé.',
            ],
            [
                'libelle'     => 'Congé de maternité',
                'description' => 'Congé accordé à une employée avant et après l\'accouchement.',
            ],
            [
                'libelle'     => 'Congé de paternité',
                'description' => 'Congé accordé au père à la naissance de son enfant.',
            ],
            [
                'libelle'     => 'Congé sans solde',
                'description' => 'Congé non rémunéré accordé pour des raisons personnelles.',
            ],
            [
                'libelle'     => 'Congé de circonstance',
                'description' => 'Congé pour événements familiaux (mariage, deuil, naissance, etc.).',
            ],
            [
                'libelle'     => 'Congé de formation',
                'description' => 'Congé pour suivre une formation professionnelle.',
            ],
        ];

        foreach ($types as $type) {
            TypeConge::firstOrCreate(['libelle' => $type['libelle']], $type);
        }
    }
}

