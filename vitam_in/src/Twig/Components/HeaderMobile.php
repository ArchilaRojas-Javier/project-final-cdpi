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
        
    ) {
    }

        /**
     * Devuelve true si se debe mostrar el título de la app.
     * Condiciones: usuario autenticado 
     */
    public function getShowTitle(): bool
    {
        // Pour afficher le titre si l'utilisateur est authentifié
        if ($this->security->getUser()) {
            return true;
        }
        // Dans tous les autres cas, ne pas afficher le titre.
        return false;
    }

    /**
     * Renvoie les éléments de menu qui seront affichés dans le header.
     */
    public function getMenuItems(): array
    {
        return $this->menuService->getMenuItems();
    }

}
