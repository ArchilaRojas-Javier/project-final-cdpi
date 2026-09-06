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
        
        $typeVitamine = new SupplementType();
        $typeVitamine->setName('Vitamines');
        $manager->persist($typeVitamine);

        $typeMineral = new SupplementType();
        $typeMineral->setName('Mineraux');
        $manager->persist($typeMineral);

        $typePlante = new SupplementType();
        $typePlante->setName('Plantes');
        $manager->persist($typePlante);

        $typeOligoElement = new SupplementType();
        $typeOligoElement->setName('Oligo-element');
        $manager->persist($typeOligoElement);

        $typeAcideAmine = new SupplementType();
        $typeAcideAmine->setName('Acide amine');
        $manager->persist($typeAcideAmine);

        $typeAcideGrasEssentiel = new SupplementType();
        $typeAcideGrasEssentiel->setName('Acide gras essentiel');
        $manager->persist($typeAcideGrasEssentiel);

        $typeOméga3 = new SupplementType();
        $typeOméga3->setName('Omega-3');
        $manager->persist($typeOméga3);

        $typeExtraitPlante = new SupplementType();
        $typeExtraitPlante->setName('Extrait de plante');
        $manager->persist($typeExtraitPlante);

        $typeProbiotique = new SupplementType();
        $typeProbiotique->setName('Probiotique');
        $manager->persist($typeProbiotique);

        $typeEnzyme = new SupplementType();
        $typeEnzyme->setName('Enzyme digestive');
        $manager->persist($typeEnzyme);

        $typeAntioxydant = new SupplementType();
        $typeAntioxydant->setName('Antioxydant');
        $manager->persist($typeAntioxydant);

        $typeProteine = new SupplementType();
        $typeProteine->setName('Proteine');
        $manager->persist($typeProteine);

        $typeBCAA = new SupplementType();
        $typeBCAA->setName('Acide amine ramifie (BCAA)');
        $manager->persist($typeBCAA);

        $typePhospholipide = new SupplementType();
        $typePhospholipide->setName('Phospholipide');
        $manager->persist($typePhospholipide);

        $typeNutrimentEssentiel = new SupplementType();
        $typeNutrimentEssentiel->setName('Nutriment essentiel');
        $manager->persist($typeNutrimentEssentiel);

        
       

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

        // 1. Renforce le système immunitaire
        $benefitImmunitaire = new Benefit();
        $benefitImmunitaire->setName('Immunitaire');
        $manager->persist($benefitImmunitaire);

        // 2. Réduit la fatigue physique et mentale
        $benefitFatigue = new Benefit();
        $benefitFatigue->setName('Fatigue');
        $manager->persist($benefitFatigue);

        // 3. Améliore la concentration et la mémoire
        $benefitconcentrationMemoire = new Benefit();
        $benefitconcentrationMemoire->setName('ConcentrationMemoire');
        $manager->persist($benefitconcentrationMemoire);

        // 4. Soutient la santé des os et des dents
        $benefitOsDents = new Benefit();
        $benefitOsDents->setName('OsDents');
        $manager->persist($benefitOsDents);

        // 5. Favorise une digestion saine
        $benefitDigestion = new Benefit();
        $benefitDigestion->setName('Digestion');
        $manager->persist($benefitDigestion);

        // 6. Protège les cellules contre le stress oxydatif
        $benefitFatigueOxydatif = new Benefit();
        $benefitFatigueOxydatif->setName('StressOxydatif');
        $manager->persist($benefitFatigueOxydatif);

        // 7. Contribue à une peau éclatante et saine
        $benefitPeau = new Benefit();
        $benefitPeau->setName('Peau');
        $manager->persist($benefitPeau);

        // 8. Améliore l'humeur et réduit le stress
        $benefitHumeur = new Benefit();
        $benefitHumeur->setName('Humeur');
        $manager->persist($benefitHumeur);

        // 9. Régule le cycle du sommeil
        $benefitSommeil = new Benefit();
        $benefitSommeil->setName('Sommeil');
        $manager->persist($benefitSommeil);

        // 10. Soutient la fonction musculaire et la contraction
        $benefitMusculaire = new Benefit();
        $benefitMusculaire->setName('Musculaire');
        $manager->persist($benefitMusculaire);

        // 11. Aide à la gestion du poids
        $benefitPoids = new Benefit();
        $benefitPoids->setName('Poids');
        $manager->persist($benefitPoids);

        // 12. Réduit l'inflammation chronique
        $benefitInflammation = new Benefit();
        $benefitInflammation->setName('Inflammation');
        $manager->persist($benefitInflammation);

        // 13. Favorise la santé cardiovasculaire
        $benefitCardiovasculaire = new Benefit();
        $benefitCardiovasculaire->setName('Cardiovasculaire');
        $manager->persist($benefitCardiovasculaire);

        // 14. Améliore la vision et la santé oculaire
        $benefitVision = new Benefit();
        $benefitVision->setName('Vision');
        $manager->persist($benefitVision);

        // 15. Soutient la santé des articulations et du cartilage
        $benefitArticulations = new Benefit();
        $benefitArticulations->setName('Articulations');
        $manager->persist($benefitArticulations);

        // 16. Stimule la production d'énergie cellulaire
        $benefitEnergieCellulaire = new Benefit();
        $benefitEnergieCellulaire->setName('EnergieCellulaire');
        $manager->persist($benefitEnergieCellulaire);

        // 17. Favorise la croissance et la force des cheveux
        $benefitCheveux = new Benefit();
        $benefitCheveux->setName('Cheveux');
        $manager->persist($benefitCheveux);

        // 18. Renforce les ongles fragiles
        $benefitOngles = new Benefit();
        $benefitOngles->setName('Ongles');
        $manager->persist($benefitOngles);

        // 19. Améliore la mémoire à long terme
        $benefitMemoire = new Benefit();
        $benefitMemoire->setName('Memoire');
        $manager->persist($benefitMemoire);

        // 20. Réduit les symptômes d'anxiété et de tension
        $benefitAnxiete = new Benefit();
        $benefitAnxiete->setName('Anxiete');
        $manager->persist($benefitAnxiete);

        // 21. Favorise un microbiote intestinal équilibré
        $benefitMicrobiote = new Benefit();
        $benefitMicrobiote->setName('Microbiote');
        $manager->persist($benefitMicrobiote);

        // 22. Régule la glycémie et l'appétit
        $benefitGlycemie = new Benefit();
        $benefitGlycemie->setName('Glycemie');
        $manager->persist($benefitGlycemie);

        // 23. Abaisse le taux de cholestérol LDL
        $benefitCholesteroLDL = new Benefit();
        $benefitCholesteroLDL->setName('CholesteroLDL');
        $manager->persist($benefitCholesteroLDL);

        // 24. Protège les cellules hépatiques
        $benefitHepatique = new Benefit();
        $benefitHepatique->setName('Hepatique');
        $manager->persist($benefitHepatique);

        // 25. Améliore les performances sportives
        $benefitPerformancesSportives = new Benefit();
        $benefitPerformancesSportives->setName('PerformancesSportives');
        $manager->persist($benefitPerformancesSportives);

        // 26. Accélère la récupération après l'effort
        $benefitRecuperation = new Benefit();
        $benefitRecuperation->setName('Recuperation');
        $manager->persist($benefitRecuperation);

        // 27. Augmente la libido et la vitalité
        $benefitLibido = new Benefit();
        $benefitLibido->setName('Libido');
        $manager->persist($benefitLibido);

        // 28. Soutient la fonction thyroïdienne
        $benefitThyroidienne = new Benefit();
        $benefitThyroidienne->setName('Thyroidienne');
        $manager->persist($benefitThyroidienne);

        // 29. Détoxifie l'organisme des métaux lourds
        $benefitMetauxLourds = new Benefit();
        $benefitMetauxLourds->setName('MetauxLourds');
        $manager->persist($benefitMetauxLourds);

        // 30. Améliore la circulation sanguine périphérique
        $benefitCirculationSanguine = new Benefit();
        $benefitCirculationSanguine->setName('CirculationSanguine');
        $manager->persist($benefitCirculationSanguine);

        // Guardar tipos y beneficios primero (flush parcial para evitar dependencias)
        $manager->flush();

        // 3. Crear los suplementos de ejemplo
        $supplementsData = [
            [
                'name' => 'Vitamine C 1000 mg',
                'description' => 'Soutient le système immunitaire et réduit la fatigue. La vitamina C es un antioxidante esencial 
                que contribuye a la protección de las células contra el estrés oxidativo, favorece la absorción de hierro y mantiene 
                la función inmunitaria. Esta presentación de 1000 mg por dosis es ideal para reforzar las defensas.',
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
                'benefits' => [$benefitImmunite, $benefitEnergie, $benefitPeau],
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

        // ];

    
    [
        'name' => 'Magnesio 300 mg (citrato)',
        'description' => 'El magnesio es un mineral crucial para más de 300 reacciones enzimáticas, incluyendo la producción de energía,
         la función muscular y nerviosa. El citrato de magnesio tiene buena absorción y es suave para el estómago.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede tener efecto laxante en dosis altas. No tomar con calcio en exceso.',
        'dosage_schedule' => [
            'male' => ['dose' => 300, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 2]],
            'female' => ['dose' => 250, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 2]],
            'general' => ['dose' => 280, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 2]]
        ],
        'type' => $typeMineral,
        'benefits' => [$benefitEnergie, $benefitSommeil]
    ],
    [
        'name' => 'Zinc 15 mg (picolinato)',
        'description' => 'El zinc es esencial para el sistema inmunológico, la síntesis de proteínas y la cicatrización de heridas. 
        El picolinato de zinc es una forma altamente biodisponible.',
        'on_duration_days' => 28,
        'off_duration_days' => 7,
        'precautions' => 'No superar los 40 mg al día. Tomar con alimentos para evitar náuseas.',
        'dosage_schedule' => [
            'male' => ['dose' => 15, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 12, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 13, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeMineral,
        'benefits' => [$benefitImmunite, $benefitPeau, $benefitCheveux, $benefitOngles]
    ],
    [
        'name' => 'Vitamina D3 2000 UI',
        'description' => 'La vitamina D3 (colecalciferol) es fundamental para la absorción de calcio y fósforo, manteniendo la salud ósea y muscular. También modula el sistema inmunológico. Dosis de 2000 UI para mantenimiento en adultos con deficiencia leve.',
        'on_duration_days' => 90,
        'off_duration_days' => 10,
        'precautions' => 'No exceder 4000 UI al día sin supervisión médica. Toxicidad posible a largo plazo.',
        'dosage_schedule' => [
            'male' => ['dose' => 2000, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 2000, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 2000, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitOsDents, $benefitImmunite]
    ],
    [
        'name' => 'Calcio 500 mg (carbonato)',
        'description' => 'El calcio es el mineral más abundante en el cuerpo, necesario para la formación de huesos y dientes, coagulación sanguínea y transmisión nerviosa. El carbonato de calcio es una fuente común y económica, mejor absorbida con alimentos.',
        'on_duration_days' => 60,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar estreñimiento. Tomar con vitamina D para mejorar absorción.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]]
        ],
        'type' => $typeMineral,
        'benefits' => [$benefitOsDents, $benefitMusculaire, $benefitCardiovasculaire]
    ],
    [
        'name' => 'Hierro 18 mg (bisglicinato)',
        'description' => 'El hierro es componente de la hemoglobina y mioglobina, transportando oxígeno. El bisglicinato quelado es suave para el estómago y de alta absorción.',
        'on_duration_days' => 42,
        'off_duration_days' => 14,
        'precautions' => 'No tomar con calcio o té. Puede oscurecer las heces. Peligro de sobredosis en niños.',
        'dosage_schedule' => [
            'male' => ['dose' => 10, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 18, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 15, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeMineral,
        'benefits' => [$benefitEnergie, $benefitImmunite, $benefitconcentrationMemoire]
    ],
    [
        'name' => 'Potasio 99 mg (citrato)',
        'description' => 'El potasio es un electrolito clave para la función nerviosa, contracción muscular y equilibrio de fluidos. El citrato de potasio es bien tolerado.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'No tomar si tiene problemas renales o está tomando diuréticos ahorradores de potasio.',
        'dosage_schedule' => [
            'male' => ['dose' => 99, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 1]],
            'female' => ['dose' => 99, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 1]],
            'general' => ['dose' => 99, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 1]]
        ],
        'type' => $typeMineral,
        'benefits' => [$benefitCardiovasculaire, $benefitMusculaire, $benefitCirculationSanguine]
    ],
    [
        'name' => 'Complejo B (B1, B2, B3, B5, B6, B12, Ácido fólico, Biotina)',
        'description' => 'El complejo de vitaminas B es esencial para el metabolismo energético, la síntesis de neurotransmisores, la formación de glóbulos rojos y la salud de la piel y nervios. Fórmula completa con todas las B.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'La vitamina B3 puede causar rubor. Tomar con alimentos.',
        'dosage_schedule' => [
            'male' => ['dose' => 1, 'unit' => 'comp', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 1, 'unit' => 'comp', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 1, 'unit' => 'comp', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitEnergie, $benefitCholesteroLDL, $benefitHumeur, $benefitPeau, $benefitCheveux]
    ],
    [
        'name' => 'Vitamina E 400 UI (d-alfa tocoferol)',
        'description' => 'La vitamina E es un antioxidante liposoluble que protege las membranas celulares del daño oxidativo. También apoya la función inmunológica y la salud de la piel.',
        'on_duration_days' => 45,
        'off_duration_days' => 15,
        'precautions' => 'Puede aumentar el riesgo de sangrado en dosis altas. No tomar con anticoagulantes sin supervisión.',
        'dosage_schedule' => [
            'male' => ['dose' => 400, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 400, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 400, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [ $benefitPeau, $benefitImmunite]
    ],
    [
        'name' => 'Selenio 200 mcg (levadura)',
        'description' => 'El selenio es un oligoelemento antioxidante que forma parte de las selenoproteínas, protegiendo contra el daño oxidativo y apoyando la función tiroidea.',
        'on_duration_days' => 30,
        'off_duration_days' => 10,
        'precautions' => 'No superar 400 mcg al día. Toxicidad con dosis altas prolongadas.',
        'dosage_schedule' => [
            'male' => ['dose' => 200, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 200, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 200, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeMineral,
        'benefits' => [$benefitImmunite]
    ],
    [
        'name' => 'Cromo 200 mcg (picolinato)',
        'description' => 'El cromo es un mineral que potencia la acción de la insulina y ayuda a regular el metabolismo de los carbohidratos y lípidos.',
        'on_duration_days' => 42,
        'off_duration_days' => 7,
        'precautions' => 'Puede interferir con medicamentos para la diabetes. Controlar niveles de glucosa.',
        'dosage_schedule' => [
            'male' => ['dose' => 200, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 200, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 200, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeMineral,
        'benefits' => [$benefitAnxiete, $benefitPoids]
    ],
    [
        'name' => 'Omega-3 EPA/DHA 1000 mg (aceite de pescado)',
        'description' => 'Los ácidos grasos omega-3 EPA y DHA son esenciales para la salud cardiovascular, cerebral y ocular. Este suplemento proporciona 300 mg de EPA y 200 mg de DHA por cápsula.',
        'on_duration_days' => 90,
        'off_duration_days' => 10,
        'precautions' => 'Puede aumentar el riesgo de sangrado. No tomar con anticoagulantes. Olor a pescado.',
        'dosage_schedule' => [
            'male' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 0]],
            'female' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 0]],
            'general' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 1, 'evening' => 0]]
        ],
        'type' => $typeAcideAmine,
        'benefits' => [$benefitCardiovasculaire, $benefitconcentrationMemoire, $benefitVision, $benefitArticulations]
    ],
    [
        'name' => 'Coenzima Q10 100 mg (ubiquinona)',
        'description' => 'La CoQ10 es un antioxidante liposoluble producido en el cuerpo, esencial para la producción de energía mitocondrial. Apoya la salud cardíaca y reduce el daño oxidativo.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'Puede interactuar con anticoagulantes y medicamentos para la presión arterial.',
        'dosage_schedule' => [
            'male' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeProbiotique,
        'benefits' => [$benefitEnergie, $benefitCardiovasculaire, $benefitAnxiete]
    ],
    [
        'name' => 'Probióticos 50 mil millones (cepas múltiples)',
        'description' => 'Combinación de Lactobacillus, Bifidobacterium y otras cepas probióticas que favorecen el equilibrio de la microbiota intestinal y la función digestiva.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Conservar en refrigeración. Puede causar gases al inicio.',
        'dosage_schedule' => [
            'male' => ['dose' => 1, 'unit' => 'cápsula', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 1, 'unit' => 'cápsula', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 1, 'unit' => 'cápsula', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeProbiotique,
        'benefits' => [$benefitDigestion, $benefitEnergieCellulaire, $benefitImmunite]
    ],
    [
        'name' => 'Extracto de té verde 500 mg (estandarizado 50% EGCG)',
        'description' => 'El té verde es rico en catequinas, especialmente EGCG, con potentes propiedades antioxidantes y termogénicas que ayudan al metabolismo y la pérdida de peso.',
        'on_duration_days' => 28,
        'off_duration_days' => 7,
        'precautions' => 'Contiene cafeína. Puede interactuar con anticoagulantes.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitAnxiete, $benefitDigestion, $benefitPoids]
    ],
    [
        'name' => 'Ginseng (Panax) 500 mg',
        'description' => 'El ginseng es una adaptógeno que ayuda a combatir el estrés, mejorar la energía y la función cognitiva. Contiene ginsenósidos.',
        'on_duration_days' => 42,
        'off_duration_days' => 14,
        'precautions' => 'Puede causar insomnio o nerviosismo. No tomar con estimulantes.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitEnergie, $benefitFatigueOxydatif, $benefitconcentrationMemoire, $benefitLibido]
    ],
    [
        'name' => 'Ginkgo biloba 120 mg (estandarizado 24% glicósidos)',
        'description' => 'El Ginkgo biloba mejora la circulación cerebral y periférica, apoyando la memoria y la concentración. Antioxidante.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'Puede aumentar el riesgo de sangrado. No tomar con anticoagulantes.',
        'dosage_schedule' => [
            'male' => ['dose' => 120, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 120, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 120, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitconcentrationMemoire, $benefitCirculationSanguine, $benefitconcentrationMemoire]
    ],
    [
        'name' => 'Curcumina 1000 mg (con piperina)',
        'description' => 'La curcumina, principio activo de la cúrcuma, tiene potentes propiedades antiinflamatorias y antioxidantes. La piperina (negra) aumenta su biodisponibilidad.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede irritar el estómago. No tomar con anticoagulantes.',
        'dosage_schedule' => [
            'male' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'female' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'general' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitAnxiete, $benefitMetauxLourds, $benefitArticulations]
    ],
    [
        'name' => 'Glucosamina 1500 mg + Condroitina 1200 mg',
        'description' => 'Combinación de glucosamina y condroitina, componentes del cartílago, que ayudan a mantener la salud articular y reducir el dolor en osteoartritis.',
        'on_duration_days' => 90,
        'off_duration_days' => 15,
        'precautions' => 'Puede elevar el azúcar en sangre. No tomar si alergia a mariscos (glucosamina de origen marino).',
        'dosage_schedule' => [
            'male' => ['dose' => 1, 'unit' => 'tableta', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 1, 'unit' => 'tableta', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 1, 'unit' => 'tableta', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typeAcideAmine,
        'benefits' => [$benefitArticulations, $benefitAnxiete]
    ],
    [
        'name' => 'MSM (Metilsulfonilmetano) 1000 mg',
        'description' => 'El MSM es una fuente de azufre orgánico, importante para la formación de colágeno y tejidos conjuntivos. Ayuda a reducir inflamación y mejorar la flexibilidad articular.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar molestias digestivas. No superar dosis.',
        'dosage_schedule' => [
            'male' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typeBCAA,
        'benefits' => [$benefitArticulations, $benefitPeau, $benefitCheveux]
    ],
    [
        'name' => 'L-Teanina 200 mg',
        'description' => 'La L-teanina es un aminoácido presente en el té verde que promueve la relajación sin somnolencia, mejora la atención y modula el estrés.',
        'on_duration_days' => 21,
        'off_duration_days' => 7,
        'precautions' => 'Segura en general. Puede potenciar efectos de cafeína.',
        'dosage_schedule' => [
            'male' => ['dose' => 200, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 200, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 200, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeAcideAmine,
        'benefits' => [$benefitFatigueOxydatif, $benefitSommeil, $benefitconcentrationMemoire]
    ],
    [
        'name' => 'Creatina monohidrato 5 g',
        'description' => 'La creatina es un compuesto que aumenta la fuerza y la masa muscular, mejora el rendimiento en ejercicios de alta intensidad y favorece la recuperación.',
        'on_duration_days' => 56,
        'off_duration_days' => 14,
        'precautions' => 'Puede causar retención de líquidos. Beber suficiente agua.',
        'dosage_schedule' => [
            'male' => ['dose' => 5, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 3, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 4, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typeAcideAmine,
        'benefits' => [$benefitMusculaire, $benefitEnergieCellulaire, $benefitEnergie]
    ],
    [
        'name' => 'BCAA (2:1:1) 1000 mg',
        'description' => 'Los aminoácidos de cadena ramificada (leucina, isoleucina, valina) son esenciales para la síntesis de proteínas musculares, reducen la fatiga durante el ejercicio y ayudan a la recuperación.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Tomar antes o durante el entrenamiento. Sin efectos adversos graves.',
        'dosage_schedule' => [
            'male' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'female' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'general' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]]
        ],
        'type' => $typeAcideAmine,
        'benefits' => [$benefitMusculaire, $benefitEnergieCellulaire, $benefitRecuperation] 
    ],
    
    [
        'name' => 'L-Glutamina 5 g',
        'description' => 'La glutamina es el aminoácido más abundante en el músculo, apoya la recuperación muscular, la salud intestinal y el sistema inmunológico.',
        'on_duration_days' => 28,
        'off_duration_days' => 7,
        'precautions' => 'Segura en dosis normales.',
        'dosage_schedule' => [
            'male' => ['dose' => 5, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 4, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 4.5, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typeAcideAmine,
        'benefits' => [$benefitMusculaire, $benefitDigestion, $benefitImmunite]
    ],
    [
        'name' => 'L-Arginina 1000 mg',
        'description' => 'La arginina es un precursor del óxido nítrico, mejorando la circulación y la vasodilatación, útil para el rendimiento deportivo y la salud cardiovascular.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar molestias gástricas. No tomar con medicamentos para la presión.',
        'dosage_schedule' => [
            'male' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'female' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'general' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]]
        ],
        'type' => $typeAcideAmine,
        'benefits' => [$benefitCirculationSanguine, $benefitMusculaire, $benefitLibido]
    ],
    [
        'name' => 'Beta-Alanina 2 g',
        'description' => 'La beta-alanina es un aminoácido que aumenta los niveles de carnosina en el músculo, reduciendo la fatiga muscular y mejorando el rendimiento en ejercicios de alta intensidad.',
        'on_duration_days' => 42,
        'off_duration_days' => 7,
        'precautions' => 'Puede causar parestesia (hormigueo) benigna.',
        'dosage_schedule' => [
            'male' => ['dose' => 2, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 1.6, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 1.8, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typeAcideAmine,
        'benefits' => [$benefitHepatique, $benefitMusculaire]
    ],
    [
        'name' => 'L-Carnitina 500 mg',
        'description' => 'La L-carnitina transporta ácidos grasos a la mitocondria para su oxidación, promoviendo la quema de grasa y la energía, especialmente en el músculo cardíaco.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar náuseas en ayunas.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeAcideGrasEssentiel,
        'benefits' => [$benefitEnergie, $benefitPoids, $benefitCardiovasculaire]
    ],
    [
        'name' => 'Ácido Hialurónico 100 mg',
        'description' => 'El ácido hialurónico es un componente del tejido conectivo, piel y articulaciones. Atrae agua y mantiene la hidratación y elasticidad.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'Seguro en general.',
        'dosage_schedule' => [
            'male' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeBCAA,
        'benefits' => [$benefitPeau, $benefitArticulations, $benefitFatigue]
    ],
    [
        'name' => 'Colágeno hidrolizado 10 g (tipo I y III)',
        'description' => 'El colágeno es la proteína más abundante, proporciona estructura a la piel, huesos, tendones y ligamentos. El hidrolizado es fácilmente absorbible.',
        'on_duration_days' => 84,
        'off_duration_days' => 14,
        'precautions' => 'Tomar con vitamina C para mejor síntesis.',
        'dosage_schedule' => [
            'male' => ['dose' => 10, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 10, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 10, 'unit' => 'g', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typeBCAA,
        'benefits' => [$benefitPeau, $benefitOsDents, $benefitArticulations, $benefitOngles]
    ],
    [
        'name' => 'Vitamina K2 (MK-7) 100 mcg',
        'description' => 'La vitamina K2 activa proteínas que regulan el calcio en los huesos y arterias, previniendo la calcificación vascular y fortaleciendo los huesos.',
        'on_duration_days' => 90,
        'off_duration_days' => 15,
        'precautions' => 'Puede interactuar con anticoagulantes (warfarina).',
        'dosage_schedule' => [
            'male' => ['dose' => 100, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 100, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 100, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitOsDents, $benefitCholesteroLDL]
    ],
    [
        'name' => 'Vitamina A (retinol) 10000 UI',
        'description' => 'La vitamina A es esencial para la visión, la piel, el sistema inmunológico y el crecimiento celular. El retinol es la forma activa.',
        'on_duration_days' => 30,
        'off_duration_days' => 10,
        'precautions' => 'Toxicidad en dosis altas (teratogénica). No exceder 10000 UI diarias.',
        'dosage_schedule' => [
            'male' => ['dose' => 10000, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 8000, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 9000, 'unit' => 'UI', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitVision, $benefitPeau, $benefitImmunite]
    ],
    [
        'name' => 'Niacina (Vitamina B3) 500 mg (liberación prolongada)',
        'description' => 'La niacina es una vitamina B que ayuda a reducir el colesterol LDL y triglicéridos, mejora la circulación y la función cerebral.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar enrojecimiento cutáneo (flush). Tomar con alimentos.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitCardiovasculaire, $benefitCirculationSanguine, $benefitconcentrationMemoire]
    ],
    [
        'name' => 'Ácido Fólico 400 mcg',
        'description' => 'El ácido fólico (vitamina B9) es crucial para la síntesis de ADN, división celular y formación de glóbulos rojos. Esencial en el embarazo.',
        'on_duration_days' => 90,
        'off_duration_days' => 10,
        'precautions' => 'Puede enmascarar deficiencia de B12.',
        'dosage_schedule' => [
            'male' => ['dose' => 400, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 600, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitPoids, $benefitEnergie, $benefitconcentrationMemoire]
    ],
    [
        'name' => 'Vitamina B12 (metilcobalamina) 1000 mcg',
        'description' => 'La B12 es esencial para la formación de glóbulos rojos, función neurológica y síntesis de ADN. La metilcobalamina es una forma activa.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'Segura, se excreta el exceso.',
        'dosage_schedule' => [
            'male' => ['dose' => 1000, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 1000, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 1000, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitEnergie, $benefitconcentrationMemoire, $benefitHumeur]
    ],
    [
        'name' => 'Biotina 10000 mcg',
        'description' => 'La biotina (vitamina B7) es importante para el metabolismo de grasas y carbohidratos, y favorece la salud del cabello, piel y uñas.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'Puede interferir con pruebas de laboratorio (tiroides).',
        'dosage_schedule' => [
            'male' => ['dose' => 10000, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 10000, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 10000, 'unit' => 'mcg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitCheveux, $benefitPeau, $benefitOngles, $benefitMetauxLourds]
    ],
    [
        'name' => 'Vitamina B6 (piridoxina) 50 mg',
        'description' => 'La vitamina B6 participa en el metabolismo de aminoácidos, síntesis de neurotransmisores y producción de hemoglobina.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Dosis altas prolongadas pueden causar neuropatía.',
        'dosage_schedule' => [
            'male' => ['dose' => 50, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 50, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 50, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typeVitamine,
        'benefits' => [$benefitHumeur, $benefitEnergie, $benefitImmunite]
    ],
    [
        'name' => 'Melatonina 5 mg',
        'description' => 'La melatonina es una hormona que regula el ciclo sueño-vigilia. Ayuda a conciliar el sueño y mejora la calidad del descanso.',
        'on_duration_days' => 14,
        'off_duration_days' => 7,
        'precautions' => 'Puede causar somnolencia diurna. No tomar con alcohol.',
        'dosage_schedule' => [
            'male' => ['dose' => 5, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 5, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 5, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typeMineral,
        'benefits' => [$benefitSommeil]
    ],
    [
        'name' => 'Extracto de cardo mariano 300 mg (estandarizado 80% silimarina)',
        'description' => 'El cardo mariano es conocido por sus propiedades hepatoprotectoras, ayudando a desintoxicar el hígado y regenerar células hepáticas.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'Puede causar efectos laxantes. No tomar con ciertos medicamentos.',
        'dosage_schedule' => [
            'male' => ['dose' => 300, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 300, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 300, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [ $benefitDigestion]
    ],
    [
        'name' => 'Extracto de raíz de maca 500 mg',
        'description' => 'La maca es una planta adaptógena peruana que aumenta la energía, la libido y el equilibrio hormonal.',
        'on_duration_days' => 42,
        'off_duration_days' => 14,
        'precautions' => 'Puede afectar la tiroides por su contenido de goitrógenos.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitEnergie, $benefitLibido, $benefitHumeur]
    ],
    [
        'name' => 'Extracto de ashwagandha 500 mg (raíz)',
        'description' => 'La ashwagandha es un adaptógeno ayurvédico que reduce el estrés, mejora la función cognitiva y aumenta la resistencia física.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'Puede causar somnolencia. No tomar con medicamentos para la tiroides.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitFatigue, $benefitSommeil, $benefitMusculaire]
    ],
    [
        'name' => 'Rhodiola rosea 200 mg (estandarizado 3% rosavinas)',
        'description' => 'La rhodiola es un adaptógeno que combate la fatiga, mejora el rendimiento mental y la resistencia al estrés.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar insomnio si se toma tarde.',
        'dosage_schedule' => [
            'male' => ['dose' => 200, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 200, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 200, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitEnergie, $benefitFatigue, $benefitconcentrationMemoire]
    ],
    [
        'name' => 'Extracto de cúrcuma (sin piperina) 500 mg',
        'description' => 'Cúrcuma con 95% de curcuminoides, antioxidante y antiinflamatorio natural. (Sin piperina para quienes no toleran pimienta).',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede manchar los dientes. Tomar con comidas grasas para absorción.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitInflammation, $benefitEnergie]
    ],
    [
        'name' => 'Equinácea 400 mg (extracto)',
        'description' => 'La equinácea estimula el sistema inmunológico y puede reducir la duración de los resfriados.',
        'on_duration_days' => 14,
        'off_duration_days' => 14,
        'precautions' => 'No usar en enfermedades autoinmunes.',
        'dosage_schedule' => [
            'male' => ['dose' => 400, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 400, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 400, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitImmunite, $benefitImmunitaire]
    ],
    [
        'name' => 'Extracto de arándano 500 mg (proantocianidinas)',
        'description' => 'El arándano ayuda a prevenir infecciones urinarias al impedir la adherencia de bacterias a la vejiga.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede interactuar con anticoagulantes.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitEnergie, $benefitImmunite]
    ],
    [
        'name' => 'Extracto de uva (semilla) 100 mg (95% OPC)',
        'description' => 'Los oligómeros proantocianidínicos (OPC) de la semilla de uva son potentes antioxidantes que protegen los vasos sanguíneos y la piel.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Seguro, puede interactuar con anticoagulantes.',
        'dosage_schedule' => [
            'male' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 100, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitEnergie, $benefitCardiovasculaire, $benefitPeau]
    ],
    [
        'name' => 'Extracto de hongo Reishi 500 mg',
        'description' => 'El Reishi es un hongo medicinal adaptógeno que fortalece el sistema inmunológico, reduce el estrés y promueve la longevidad.',
        'on_duration_days' => 60,
        'off_duration_days' => 10,
        'precautions' => 'Puede causar mareos en dosis altas.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 0, 'evening' => 1]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitImmunite, $benefitSommeil]
    ],
    [
        'name' => 'Extracto de hongo Cordyceps 500 mg',
        'description' => 'Cordyceps mejora el rendimiento deportivo, la resistencia y la función respiratoria, además de tener propiedades antioxidantes.',
        'on_duration_days' => 42,
        'off_duration_days' => 7,
        'precautions' => 'Puede interactuar con inmunosupresores.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitFatigue, $benefitEnergie]
    ],
    [
        'name' => 'Extracto de espirulina 1000 mg',
        'description' => 'La espirulina es un alga rica en proteínas, vitaminas y minerales, con efectos antioxidantes y desintoxicantes.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede contaminarse con toxinas si no es de calidad.',
        'dosage_schedule' => [
            'male' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 1000, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitEnergie, $benefitEnergie]
    ],
    [
        'name' => 'Fibra de acacia 5 g (prebiótico)',
        'description' => 'Fibra soluble que alimenta las bacterias beneficiosas del intestino, mejorando la digestión y el tránsito intestinal.',
        'on_duration_days' => 60,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar gases iniciales. Aumentar ingesta de agua.',
        'dosage_schedule' => [
            'male' => ['dose' => 5, 'unit' => 'g', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 5, 'unit' => 'g', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 5, 'unit' => 'g', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitDigestion]
    ],
    [
        'name' => 'Inulina 3 g (prebiótico)',
        'description' => 'La inulina es una fibra prebiótica que estimula el crecimiento de bifidobacterias y mejora la salud digestiva.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar flatulencia.',
        'dosage_schedule' => [
            'male' => ['dose' => 3, 'unit' => 'g', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 3, 'unit' => 'g', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 3, 'unit' => 'g', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitDigestion]
    ],
    [
        'name' => 'Extracto de aloe vera 500 mg (concentrado)',
        'description' => 'El aloe vera tiene propiedades antiinflamatorias y digestivas, ayuda a la cicatrización y alivia el estreñimiento.',
        'on_duration_days' => 21,
        'off_duration_days' => 7,
        'precautions' => 'Puede tener efecto laxante. No usar en embarazo.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitDigestion, $benefitPeau]
    ],
    [
        'name' => 'Extracto de jengibre 250 mg (gingeroles)',
        'description' => 'El jengibre es antiinflamatorio, alivia náuseas y mejora la digestión. También tiene propiedades antioxidantes.',
        'on_duration_days' => 14,
        'off_duration_days' => 7,
        'precautions' => 'Puede interactuar con anticoagulantes.',
        'dosage_schedule' => [
            'male' => ['dose' => 250, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 250, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 250, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [ $benefitDigestion]
    ],
    [
        'name' => 'Extracto de hoja de olivo 500 mg (oleuropeína)',
        'description' => 'El extracto de hoja de olivo tiene propiedades antimicrobianas, antioxidantes y ayuda a mantener la presión arterial saludable.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede causar malestar estomacal.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitCardiovasculaire, $benefitImmunite, $benefitEnergie]
    ],
    [
        'name' => 'Extracto de cúrcuma (con piperina) 400 mg',
        'description' => 'Cúrcuma con piperina para mejorar la absorción, ideal para inflamación crónica y artritis.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede irritar el estómago en ayunas.',
        'dosage_schedule' => [
            'male' => ['dose' => 400, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'female' => ['dose' => 400, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]],
            'general' => ['dose' => 400, 'unit' => 'mg', 'moments' => ['morning' => 0, 'noon' => 1, 'evening' => 1]]
        ],
        'type' => $typePlante,
        'benefits' => [ $benefitArticulations]
    ],
    [
        'name' => 'Extracto de romero 300 mg (ácido rosmarínico)',
        'description' => 'El romero es antioxidante y mejora la memoria y la circulación cerebral.',
        'on_duration_days' => 21,
        'off_duration_days' => 7,
        'precautions' => 'Puede aumentar la presión arterial.',
        'dosage_schedule' => [
            'male' => ['dose' => 300, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 300, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 300, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [ $benefitEnergie]
    ],
    [
        'name' => 'Extracto de ginseng siberiano 500 mg (eleuterococo)',
        'description' => 'El ginseng siberiano es un adaptógeno que aumenta la resistencia al estrés y la energía.',
        'on_duration_days' => 42,
        'off_duration_days' => 14,
        'precautions' => 'Puede causar insomnio.',
        'dosage_schedule' => [
            'male' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 500, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitEnergie, $benefitFatigue]
    ],
    [
        'name' => 'Extracto de pimienta negra (piperina) 5 mg',
        'description' => 'La piperina mejora la biodisponibilidad de muchos nutrientes y fármacos, reduciendo el metabolismo hepático.',
        'on_duration_days' => 30,
        'off_duration_days' => 5,
        'precautions' => 'Puede interactuar con medicamentos.',
        'dosage_schedule' => [
            'male' => ['dose' => 5, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'female' => ['dose' => 5, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]],
            'general' => ['dose' => 5, 'unit' => 'mg', 'moments' => ['morning' => 1, 'noon' => 0, 'evening' => 0]]
        ],
        'type' => $typePlante,
        'benefits' => [$benefitDigestion]
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