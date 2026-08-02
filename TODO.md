# TODO — Correction des Modèles & Migrations

## Étapes (terminées)

- [x] **Étape 0** : Analyse des modèles et migrations existants
- [x] **Étape 1** : Supprimer les anciennes migrations (dupliquées / erronées)
- [x] **Étape 2** : Créer la migration `users` manquante
- [x] **Étape 3** : Réécrire et réordonner les migrations
- [x] **Étape 4** : Corriger les modèles (TypeConge, DemandeConge, Employee, StatutConge)
- [x] **Étape 5** : Vérification finale + `php artisan migrate` → OK

## Gestion des Services (terminée)

- [x] Nettoyer `EmployeeController` (suppression des méthodes cassées `creat()` et `storeService()`)
- [x] Créer `ServiceController` avec CRUD complet (index, create, store, show, edit, update, destroy)
- [x] Ajouter `Route::resource('services', ServiceController::class)` dans `web.php`
- [x] Créer les vues services : `index`, `create`, `edit`, `show`
- [x] Ajouter le lien "Services" dans la navigation (`layouts/app.blade.php`)
- [x] Lier les employés aux services (champ `service_id` dans les formulaires create/edit)
- [x] Afficher le service de chaque employé (index + show)
- [x] `withCount('employees')` pour le nombre d'employés par service

## ✅ Validation finale

- `php artisan route:list --path=services` → 7 routes services enregistrées
- `php -l` → aucune erreur de syntaxe sur les contrôleurs et modèles
- `php artisan view:cache` → toutes les vues Blade compilées avec succès

