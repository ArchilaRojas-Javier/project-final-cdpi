<?php
namespace App\DataFixtures;

use App\Entity\Supplement;
use App\Entity\SupplementType;
use App\Entity\Benefit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SupplementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Crear algunos tipos de suplemento (necesarios porque supplementtype no es nullable)
        $typeVitamine = new SupplementType();
        $typeVitamine->setName('Vitamines');
        $manager->persist($typeVitamine);

        $typeMineral = new SupplementType();
        $typeMineral->setName('Minéraux');
        $manager->persist($typeMineral);

        $typePlante = new SupplementType();
        $typePlante->setName('Plantes');
        $manager->persist($typePlante);

        // 2. Crear algunos beneficios (opcional pero enriquece la prueba)
        $benefitImmunite = new Benefit();
        $benefitImmunite->setName('Immunité');
        $manager->persist($benefitImmunite);

        $benefitEnergie = new Benefit();
        $benefitEnergie->setName('Énergie');
        $manager->persist($benefitEnergie);

        $benefitDigestion = new Benefit();
        $benefitDigestion->setName('Digestion');
        $manager->persist($benefitDigestion);

        // Guardar tipos y beneficios primero (flush parcial para evitar dependencias)
        $manager->flush();

        // 3. Crear los suplementos de ejemplo
        $supplementsData = [
            [
                'name' => 'Vitamine C 1000 mg',
                'description' => 'Soutient le système immunitaire et réduit la fatigue.',
                'on_duration_days' => 21,
                'off_duration_days' => 7,
                'precautions' => 'Ne pas dépasser la dose journalière recommandée.',
                'dosage_schedule' => [
                    'male' => [
                        'dose' => 1000,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 1]
                    ],
                    'female' => [
                        'dose' => 800,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 1]
                    ],
                    'general' => [
                        'dose' => 900,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 1]
                    ]
                ],
                'type' => $typeVitamine,
                'benefits' => [$benefitImmunite, $benefitEnergie],
            ],
            [
                'name' => 'Magnésium Marin',
                'description' => 'Aide à réduire la fatigue et contribue au bon fonctionnement musculaire.',
                'on_duration_days' => 30,
                'off_duration_days' => 10,
                'precautions' => 'Consultez un médecin en cas d’insuffisance rénale.',
                'dosage_schedule' => [
                    'male' => [
                        'dose' => 1000,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ],
                    'female' => [
                        'dose' => 800,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ],
                    'general' => [
                        'dose' => 900,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ]
                ],
                'type' => $typeMineral,
                'benefits' => [$benefitEnergie],
            ],
            [
                'name' => 'Curcuma Bio',
                'description' => 'Propriétés antioxydantes et anti-inflammatoires naturelles.',
                'on_duration_days' => 42,
                'off_duration_days' => 14,
                'precautions' => 'Déconseillé en cas d’obstruction des voies biliaires.',
                'dosage_schedule' => [
                    'male' => [
                        'dose' => 1000,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ],
                    'female' => [
                        'dose' => 800,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ],
                    'general' => [
                        'dose' => 900,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ]
                ],
                'type' => $typePlante,
                'benefits' => [$benefitDigestion],
            ],
            [
                'name' => 'Probiotiques Flore Intestinale',
                'description' => 'Favorise l’équilibre de la flore intestinale et la digestion.',
                'on_duration_days' => 14,
                'off_duration_days' => 14,
                'precautions' => 'À conserver au réfrigérateur après ouverture.',
                'dosage_schedule' => [
                    'male' => [
                        'dose' => 1000,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ],
                    'female' => [
                        'dose' => 800,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ],
                    'general' => [
                        'dose' => 900,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ]
                ],
                'type' => $typeVitamine,
                'benefits' => [$benefitDigestion],
            ],
            [
                'name' => 'Oméga 3 EPA/DHA',
                'description' => 'Acides gras essentiels pour le cœur et le cerveau.',
                'on_duration_days' => 60,
                'off_duration_days' => 0,
                'precautions' => 'Sans danger en usage prolongé.',
                'dosage_schedule' => [
                    'male' => [
                        'dose' => 1000,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ],
                    'female' => [
                        'dose' => 800,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ],
                    'general' => [
                        'dose' => 900,
                        'unit' => 'mg',
                        'moments' => ['morning' => 1, 'evening' => 1]
                    ]
                ],
                'type' => $typeVitamine,
                'benefits' => [$benefitEnergie],
            ],
        ];

        foreach ($supplementsData as $data) {
            $supplement = new Supplement();
            $supplement->setName($data['name']);
            $supplement->setDescription($data['description']);
            $supplement->setOnDurationDays($data['on_duration_days']);
            $supplement->setOffDurationDays($data['off_duration_days']);
            $supplement->setPrecautions($data['precautions']);
            $supplement->setDosageSchedule($data['dosage_schedule']);
            $supplement->setSupplementtype($data['type']);

            foreach ($data['benefits'] as $benefit) {
                $supplement->addSupplementbenefit($benefit);
            }

            $manager->persist($supplement);
        }

        $manager->flush();
    }
}