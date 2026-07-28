<?php

namespace App\Twig\Components;
use App\Service\MenuService;
use Symfony\Bundle\SecurityBundle\Security;


use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class NavBarMobile
{
    public function __construct(
        private MenuService $menuService,
        private Security $security,

    ) {
    }

     public function getShowNavBar(): bool
    {
        // Mostrar título si el usuario está autenticado
        if ($this->security->getUser()) {
            return true;
        }
        
        // En cualquier otro caso (ej: inicio) no mostrar título
        return false;
    }

    public function getMenuItems(): array
    {
        return $this->menuService->getMenuItems();
    }
}
