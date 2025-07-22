<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Package;

class FrenchTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Service translations based on common gym services
        $serviceTranslations = [
            'Personal Training' => [
                'name_fr' => 'Entraînement Personnel',
                'description_fr' => 'Séances d\'entraînement individuelles avec des entraîneurs certifiés. Plans d\'entraînement personnalisés et conseils nutritionnels.'
            ],
            'Group Fitness Classes' => [
                'name_fr' => 'Cours de Fitness de Groupe',
                'description_fr' => 'Entraînements de groupe à haute énergie incluant Zumba, HIIT, Yoga, et plus. Environnement amusant et motivant.'
            ],
            'Yoga Classes' => [
                'name_fr' => 'Cours de Yoga',
                'description_fr' => 'Séances de yoga relaxantes et renforçantes pour tous les niveaux. Améliorez la flexibilité et la pleine conscience.'
            ],
            'Nutrition Consultation' => [
                'name_fr' => 'Consultation Nutritionnelle',
                'description_fr' => 'Conseils nutritionnels professionnels et planification de repas pour compléter vos objectifs de fitness.'
            ],
            'Body Composition Analysis' => [
                'name_fr' => 'Analyse de Composition Corporelle',
                'description_fr' => 'Analyse corporelle complète incluant IMC, masse musculaire et mesure du pourcentage de graisse corporelle.'
            ],
            'Strength Training Bootcamp' => [
                'name_fr' => 'Bootcamp d\'Entraînement en Force',
                'description_fr' => 'Séances d\'entraînement en force intensives conçues pour développer les muscles et augmenter la puissance.'
            ],
        ];

        // Update services with French translations
        foreach ($serviceTranslations as $englishName => $translations) {
            $service = Service::where('name', 'LIKE', "%{$englishName}%")->first();
            if ($service) {
                $service->update($translations);
            }
        }

        // Package translations
        $packageTranslations = [
            'Basic Monthly' => [
                'name_fr' => 'Mensuel de Base',
                'description_fr' => 'Parfait pour les débutants qui cherchent à commencer leur parcours fitness. Accès à tous les équipements de base et installations.',
                'features_fr' => [
                    'Accès complet à la salle',
                    'Accès aux vestiaires',
                    'Utilisation des équipements de base',
                    'Wi-Fi gratuit'
                ]
            ],
            'Premium 6 Months' => [
                'name_fr' => 'Premium 6 Mois',
                'description_fr' => 'Notre forfait le plus populaire! Économisez de l\'argent avec un engagement de 6 mois et obtenez des avantages supplémentaires.',
                'features_fr' => [
                    'Accès complet à la salle',
                    'Cours de groupe illimités',
                    'Consultation d\'entraîneur personnel',
                    'Conseils nutritionnels',
                    'Accès prioritaire aux équipements',
                    'Laissez-passer invités (2 par mois)',
                    '10% de réduction sur les suppléments'
                ]
            ],
            'Elite Annual' => [
                'name_fr' => 'Élite Annuel',
                'description_fr' => 'Expérience fitness ultime pour les athlètes sérieux et les passionnés de fitness.',
                'features_fr' => [
                    'Accès complet à la salle',
                    'Cours de groupe illimités',
                    'Séances d\'entraînement personnel mensuelles',
                    'Consultation nutritionnelle',
                    'Analyse de composition corporelle',
                    'Accès à la salle 24h/7j',
                    'Marchandises de salle gratuites',
                    'Laissez-passer invités (5 par mois)',
                    '20% de réduction sur tous les services'
                ]
            ],
        ];

        // Update packages with French translations
        foreach ($packageTranslations as $englishName => $translations) {
            $package = Package::where('name', 'LIKE', "%{$englishName}%")->first();
            if ($package) {
                $package->update($translations);
            }
        }

        // If no exact matches, update by common patterns
        $this->updateByPatterns();
    }

    private function updateByPatterns()
    {
        // Update any remaining services
        $services = Service::whereNull('name_fr')->get();
        foreach ($services as $service) {
            if (stripos($service->name, 'training') !== false) {
                $service->update([
                    'name_fr' => str_replace(['Training', 'training'], 'Entraînement', $service->name),
                    'description_fr' => 'Service d\'entraînement professionnel.'
                ]);
            } elseif (stripos($service->name, 'class') !== false) {
                $service->update([
                    'name_fr' => str_replace(['Classes', 'Class', 'classes', 'class'], 'Cours', $service->name),
                    'description_fr' => 'Cours de fitness professionnel.'
                ]);
            }
        }

        // Update any remaining packages
        $packages = Package::whereNull('name_fr')->get();
        foreach ($packages as $package) {
            if (stripos($package->name, 'basic') !== false) {
                $package->update([
                    'name_fr' => str_replace(['Basic', 'basic'], 'De Base', $package->name),
                    'description_fr' => 'Forfait d\'adhésion de base.',
                    'features_fr' => ['Accès de base à la salle', 'Vestiaires', 'Équipements standard']
                ]);
            } elseif (stripos($package->name, 'premium') !== false) {
                $package->update([
                    'name_fr' => str_replace(['Premium', 'premium'], 'Premium', $package->name),
                    'description_fr' => 'Forfait d\'adhésion premium avec avantages supplémentaires.',
                    'features_fr' => ['Accès complet', 'Cours de groupe', 'Services premium']
                ]);
            }
        }
    }
}
