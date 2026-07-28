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
        $items = [
            [
                'label' => 'Accueil',
                'route' => 'app_home',
                'icon'  => 'home',   // identificador para el icono
            ],
            [
                'label' => 'Se connecter',
                'route' => 'app_login',
                'icon'  => 'shopping-bag',
            ],
            [
                'label' => "S'inscrire",
                'route' => 'app_register',
                'icon'  => 'mail',
            ],
        ];

        // Opciones adicionales según autenticación
        if ($this->security->getUser()) {
            $items[] = [
                'label' => 'Dashboard',
                'route' => 'app_dashboard',
                'icon'  => 'chart-bar',
            ];
            $items[] = [
                'label' => 'Perfil',
                'route' => 'app_perfil',
                'icon'  => 'user',
            ];
        }

        return $items;
    }
}