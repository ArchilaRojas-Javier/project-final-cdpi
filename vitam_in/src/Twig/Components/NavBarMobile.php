<?php

namespace App\Twig\Components;
use App\Service\MenuService;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class NavBarMobile
{
    public function __construct(
        private MenuService $menuService,
    ) {
    }

    public function getMenuItems(): array
    {
        return $this->menuService->getMenuItems();
    }
}
