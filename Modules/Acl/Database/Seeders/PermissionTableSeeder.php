<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Acl\Entities\Permission;
use Illuminate\Support\Facades\Hash;

// class PermissionTableSeeder extends Seeder
// {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     Model::unguard();

    //    $user = User::create([
    //                 'name' => 'Super',
    //                 'prenom' => 'Formation',
    //                 'email' => 'super@formation.com',
    //                 'password' => Hash::make('MotDePasse'),
    //                 'email_verified_at' => now()->toDateTimeString(),
    //     ]);
    // }

    class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $modules = [
            'Patient' => [
                'Créer un patient',
                'Voir détail patient',
                'Modifier patient',
                'Voir facture et paiement',
                'Voir dossier médical',
                'Créer une venue',
            ],
            'Mouvement' => [
                'Ajouter mouvement',
                'Voir historique mouvement',
                'Modifier mouvement',
                'Supprimer mouvement',
            ],
            'Service' => [
                'Ajouter service',
                'Voir détails service',
                'Modifier service',
                'Supprimer service',
            ],
            'Pharmacie' => [
                'Ajouter médicament',
                'Voir stock médicament',
                'Modifier médicament',
                'Supprimer médicament',
            ],
            'Caisse' => [
                'Ajouter transaction',
                'Voir historique transactions',
                'Modifier transaction',
                'Supprimer transaction',
            ],
            'Facturation' => [
                'Créer facture',
                'Voir facture détaillée',
                'Modifier facture',
                'Supprimer facture',
            ],
            'Hospitalisation' => [
                'Admettre patient',
                'Voir historique hospitalisation',
                'Modifier statut patient',
                'Décharger patient',
            ],
            'Recouvrement' => [
                'Enregistrer paiement',
                'Voir historique paiements',
                'Modifier paiement',
                'Supprimer paiement',
            ],
            'Stock' => [
                'Ajouter produit au stock',
                'Voir stock détaillé',
                'Modifier produit du stock',
                'Supprimer produit du stock',
            ],
            'Ressources' => [
                'Gérer utilisateurs',
                'Gérer rôles',
                'Voir activité système',
            ],
            'Assurance' => [
                'Ajouter assurance',
                'Voir détails assurance',
                'Modifier assurance',
                'Supprimer assurance',
            ],
            'Rendezvous' => [
                'Planifier rendez-vous',
                'Voir calendrier rendez-vous',
                'Modifier rendez-vous',
                'Annuler rendez-vous',
            ],
            'Profil' => [
                'Voir profil utilisateur',
                'Modifier profil utilisateur',
                'Changer mot de passe',
            ],
            'Petite' => [
                'Ajouter petite action',
                'Voir détails petite action',
                'Modifier petite action',
                'Supprimer petite action',
            ],
            'Rapport' => [
                'Générer rapport',
                'Voir historique rapports',
                'Modifier rapport',
                'Supprimer rapport',
            ],
            'Configuration' => [
                'Configurer système',
                'Modifier paramètres système',
                'Gérer modules',
                'Gérer permissions',
            ],
            'Utilisateur' => [
                'créer un utilisateur',
                'Modifier un utilisateur',
                'Supprimer un utilisateur',
            ],
        ];

        foreach ($modules as $module => $permissions) {
            // Création d'une permission pour voir le module
            Permission::create([
                'uuid' => (string) Str::uuid(),
                'name' => "Voir_module_$module",
                'display_name' => "Voir $module",
                'guard_name' => 'api', // Assurez-vous d'ajuster le gardien si nécessaire
                'groupe' => $module,
            ]);

            // Création des sous-permissions pour chaque module
            foreach ($permissions as $permissionName) {
                Permission::create([
                    'uuid' => (string) Str::uuid(),
                    'name' =>  Str::slug("$permissionName"),
                    'display_name' => $permissionName,
                    'guard_name' => 'api', // Assurez-vous d'ajuster le gardien si nécessaire
                    'groupe' => $module,
                ]);
            }
        }
    }
}
// }
