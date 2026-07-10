<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class GoogleController extends AbstractController
{
    #[Route('/connect/google', name: 'connect_google_start')]
    public function connectAction(ClientRegistry $clientRegistry): Response
    {
        return $clientRegistry
            ->getClient('google') // key used in config/packages/knpu_oauth2_client.yaml
            ->redirect(['openid', 'profile', 'email'],[]); // the scopes you want to access
    }

    #[Route('/connect/google/check', name: 'connect_google_check')]
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry): Response
    {
        // // // ** if you want to *authenticate* the user, then
        // // // leave this method blank and create a Guard authenticator
        // // // (read below)

        //  /** @var \KnpU\OAuth2ClientBundle\Client\Provider\GoogleClient $client */
        //  $client = $clientRegistry->getClient('google');

        // try {
        //     // the exact class depends on which provider you're using
        //     /** @var \League\OAuth2\Client\Provider\GoogleUser $user */
        //     $user = $client->fetchUser();

        //     // do something with all this new power!
        //     // e.g. $name = $user->getFirstName();
        //     var_dump($user); die;
        //     // ...
        // } catch (IdentityProviderException $e) {
        //     // something went wrong!
        //     // probably you should return the reason to the user
        //     var_dump($e->getMessage()); die;
        // }

        //         //         // get the user directly
        //         // $user = $client->fetchUser();

        //         // // OR: get the access token and then user
        //         // $accessToken = $client->getAccessToken();
        //         // $user = $client->fetchUserFromToken($accessToken);

        //         // // access the underlying "provider" from league/oauth2-client
        //         // $provider = $client->getOAuth2Provider();
        //         // // if you're using Facebook, then this works:
        //         // $longLivedToken = $provider->getLongLivedAccessToken($accessToken);
    }
}
