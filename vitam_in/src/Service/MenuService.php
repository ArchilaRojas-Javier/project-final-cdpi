<?php
namespace App\Service;

use Symfony\Bundle\SecurityBundle\Security;

class MenuService
{
    public function __construct(
        private Security $security,
    ) {
    }

    /**
     * Devuelve los items del menú comunes para header y navbar móvil.
     * Cada item incluye: label, route, icon (nombre de un icono SVG o clase).
     */
    public function getMenuItems(): array
    {
        if ($this->security->getUser()) {
        // Usuario CONECTADO: solo estos enlaces
        return [
            ['label' => 'Dashboard',  'route' => 'app_dashboard', 'icon' => 'chart-bar'],
            // ['label' => 'Mi Perfil',  'route' => 'app_perfil',    'icon' => 'user'],
            ['label' => 'Cerrar sesión', 'route' => 'app_logout', 'icon' => 'logout'],
        ];
            
    }elseif ($this->security->isGranted('ROLE_ADMIN')) {

    //Usuario conectado con roll admin
        return [
            ['label' => 'Admin', 'route' => 'admin', 'icon' => 'shield'],
        ];
    }else{
        // Usuario NO CONECTADO: enlaces públicos
        return [
            ['label' => 'Accueil',    'route' => 'app_home',     'icon' => 'home'],
            ['label' => 'Se connecter', 'route' => 'app_login', 'icon' => 'login'],
            ['label' => "S'inscrire", 'route' => 'app_register', 'icon' => 'login'],

        ];
        }
        
    }
}