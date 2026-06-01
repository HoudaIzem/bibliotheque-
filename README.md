# Bibliothèque en Ligne

Un système de gestion de bibliothèque moderne construit avec Laravel 12 et Tailwind CSS.

## Fonctionnalités

- **Recherche et filtrage des livres** : Recherche avancée avec filtres par catégorie et type
- **Gestion des livres** : CRUD complet pour les administrateurs
- **Authentification** : Système de connexion/inscription avec Laravel Breeze
- **Multilingue** : Support français et anglais
- **Interface responsive** : Design mobile-first avec Tailwind CSS
- **Gestion des catégories et types** : Organisation structurée des livres

## Technologies utilisées

- **Laravel 12** : Framework PHP moderne
- **Tailwind CSS** : Framework CSS utilitaire
- **SQLite** : Base de données légère
- **Laravel Breeze** : Authentification simple

## Installation

1. Cloner le repository
2. Installer les dépendances : `composer install`
3. Copier le fichier .env : `cp .env.example .env`
4. Générer la clé : `php artisan key:generate`
5. Migrer la base de données : `php artisan migrate`
6. Installer les dépendances JS : `npm install`
7. Compiler les assets : `npm run build`
8. Démarrer le serveur : `php artisan serve`

## Structure du projet

- `app/Http/Controllers/` : Contrôleurs de l'application
- `resources/views/` : Templates Blade
- `routes/web.php` : Routes de l'application
- `lang/` : Fichiers de traduction
- `database/migrations/` : Migrations de base de données

## Développement

Ce projet a été développé comme exemple d'application Laravel moderne, mettant l'accent sur :
- Code propre et maintenable
- Interface utilisateur intuitive
- Performance optimisée
- Sécurité des données

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
