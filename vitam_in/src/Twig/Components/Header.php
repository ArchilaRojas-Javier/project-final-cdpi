<?php

namespace App\Twig\Components;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Header')]
final class Header
{
    public function __construct(
        private Security $security,
        // Podrías inyectar un repositorio si quisieras cargar categorías, etc.
    ) {
    }

        /**
     * Devuelve true si se debe mostrar el título de la app.
     * Condiciones: usuario autenticado O estamos en rutas de dashboard.
     */
    public function getShowTitle(): bool
    {
        // Mostrar título si el usuario está autenticado
        if ($this->security->getUser()) {
            return true;
        }
        
        // En cualquier otro caso (ej: inicio) no mostrar título
        return false;
    }

    /**
     * Devuelve los items del menú que se mostrarán en el header.
     */
    public function getMenuItems(): array
    {
        $items = [
            ['label' => 'Inicio', 'route' => 'app_home']
        ];

        

        // Si el usuario está autenticado, añadimos más opciones de rutas
        if ($this->security->getUser()) {
            $items[] = ['label' => 'Mi Perfil', 'route' => 'app_perfil'];
            $items[] = ['label' => 'Cerrar sesión', 'route' => 'app_logout'];
        } else {
            $items[] = ['label' => 'Iniciar sesión', 'route' => 'app_login'];
        }

        return $items;
    }

    /**
     * Nombre del usuario actual o null.
     */
    public function getUserName(): ?string
    {
        $user = $this->security->getUser();
        return $user ? $user->getUserIdentifier() : null;
    }
}
