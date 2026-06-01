#!/bin/bash
# 🌐 Commandes Utiles pour le Système de Changement de Langue

# ============================================
# 🚀 DÉMARRER L'APPLICATION
# ============================================

# Lancer le serveur Laravel
php artisan serve

# Serveur avec adresse personnalisée
php artisan serve --host=192.168.1.100 --port=8000

# ============================================
# 🧪 TESTER DANS LE SHELL INTERACTIF
# ============================================

# Accéder à la console Tinker
php artisan tinker

# Dans Tinker, tester les traductions :
# → app()->setLocale('en')
# → __('home')  // Affiche "Home"
# → __('books') // Affiche "Books"
# → app()->setLocale('fr')
# → __('home')  // Affiche "Accueil"

# ============================================
# 📝 AFFICHER LES LOCALES DISPONIBLES
# ============================================

# Voir la locale actuelle (depuis une route)
# Dans web.php:
Route::get('/test-locale', function() {
    return [
        'current_locale' => app()->getLocale(),
        'fallback' => config('app.fallback_locale'),
        'test_home' => __('home'),
        'test_books' => __('books'),
    ];
});

# ============================================
# 🔄 VIDER LE CACHE DE CONFIGURATION
# ============================================

# Clears all caches
php artisan cache:clear

# Clears route cache
php artisan route:clear

# Clears config cache
php artisan config:clear

# Clears view cache
php artisan view:clear

# Clear all caches à la fois
php artisan optimize:clear

# ============================================
# 📋 LISTE DES TRADUCTIONS DISPONIBLES
# ============================================

# Voir les traductions en JSON (avec cat ou Get-Content sur Windows)

# Linux/Mac:
cat lang/en.json
cat lang/fr.json

# Windows PowerShell:
Get-Content lang/en.json
Get-Content lang/fr.json

# ============================================
# 🔗 TESTER LES ROUTES
# ============================================

# Tester la route de changement de langue depuis le terminal
curl http://localhost:8000/locale/en
curl http://localhost:8000/locale/fr

# Avec référent (pour retour automatique)
curl -i http://localhost:8000/locale/en -H "Referer: http://localhost:8000/"

# ============================================
# 🎨 AJOUTER UNE NOUVELLE LANGUE
# ============================================

# 1. Créer le fichier de traduction
# lang/es.json

# 2. Ajouter les clés (copier depuis en.json ou fr.json et traduire)

# 3. Modifier LocaleController:
# Ajouter 'es' à $supported_locales

# 4. Recharger la page (cache:clear si nécessaire)

# ============================================
# 🧩 UTILISATION DANS LES VUES
# ============================================

# Syntaxe 1: Fonction helper __()
{{ __('home') }}
{{ __('books') }}

# Syntaxe 2: Fonction trans()
{{ trans('home') }}

# Syntaxe 3: Avec pluralisation
{{ trans_choice('messages.apples', 5) }}

# Syntaxe 4: Avec paramètres
{{ __('messages.welcome', ['name' => 'John']) }}

# ============================================
# 📊 DÉBOGER LA LOCALE
# ============================================

# Afficher toutes les infos de localisation
dd([
    'current' => app()->getLocale(),
    'fallback' => config('app.fallback_locale'),
    'session' => session('locale'),
    'home_en' => app('translator')->get('home', [], 'en'),
    'home_fr' => app('translator')->get('home', [], 'fr'),
]);

# Vérifier si une clé existe
if (__('key') === 'key') {
    // Clé de traduction non trouvée
}

# ============================================
# 🔐 CACHE DES TRADUCTIONS
# ============================================

# Pour boosted les performances en production,
# vous pouvez publier les traductions:

# php artisan lang:publish

# Cela copie lang/ en resources/lang/
# et permet la minification en production

# ============================================
# 📦 COMMANDES D'INSTALLATION
# ============================================

# Si vous n'avez pas les traductions (réinstaller)
# Elles sont automatiquement découvertes dans lang/

# Vérifier les fichiers de traduction
ls -la lang/
# ou sur Windows: dir lang

# ============================================
# 🚨 DÉPANNAGE
# ============================================

# Si la langue ne change pas:
# 1. Vérifier que le middleware SetLocale est enregistré
#    → bootstrap/app.php
# 2. Vider les caches
#    → php artisan optimize:clear
# 3. Vérifier les fichiers JSON
#    → json -v lang/en.json
#    → php -r "echo json_encode(json_decode(file_get_contents('lang/en.json')));"

# Si __('key') affiche 'key' au lieu de traduction:
# 1. Vérifier que la clé existe dans lang/{locale}.json
# 2. Vérifier que app()->getLocale() retourne la bonne locale
# 3. Vider route:clear + config:clear

# ============================================
# 🎯 PROCESSUS DE DÉVELOPPEMENT
# ============================================

# 1. Dans votre contrôleur ou vue, utiliser:
#    {{ __('nouvelle_cle') }}

# 2. Ajouter la clé à lang/en.json ET lang/fr.json

# 3. Relancer le serveur (généralement pas nécessaire)

# 4. Tester en changeant de langue avec le sélecteur 🌐

# ============================================
# 📱 BONUS: STOCKER LA LANGUE EN BASE DE DONNÉES
# ============================================

# Si vous voulez persister la langue par utilisateur:

# 1. Ajouter une colonne à la table users:
# $table->string('locale')->default('en');

# 2. Après login, stocker:
# auth()->user()->update(['locale' => 'fr']);

# 3. Dans SetLocale middleware:
# if (auth()->check()) {
#     app()->setLocale(auth()->user()->locale);
# }

# ============================================

echo "🌐 Système de traduction configuré !"
echo "Commencez par : php artisan serve"
