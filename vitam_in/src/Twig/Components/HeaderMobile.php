<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Service\MenuService;
use Symfony\Bundle\SecurityBundle\Security;

#[AsTwigComponent]
final class HeaderMobile
{
    public function __construct(
        private Security $security,
        private MenuService $menuService
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
        return $this->menuService->getMenuItems();
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
