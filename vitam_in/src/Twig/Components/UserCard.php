<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\Bundle\SecurityBundle\Security;




#[AsTwigComponent]
final class UserCard
{
    public function __construct(
        private Security $security,
        
    ) {
    }
    
    /**
     * Nombre del usuario actual o null.
     */
    public function getUserName(): ?string
    {
        $user = $this->security->getUser();
        return $user ? $user->getUserIdentifier() : null;
    }
    public function getAvatarUrl(): ?string
    {
        $user = $this->security->getUser();
        if(!$user){
            return null;
        }
        
        $avatarUrl = $user->getAvatarUrl();
        
        return $avatarUrl;
    }
}
