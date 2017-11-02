<?php

namespace App;

use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;

class ClaveUnicaProvider extends AbstractProvider implements ProviderInterface
{


    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://accounts.claveunica.gob.cl/openid/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://accounts.claveunica.gob.cl/openid/token';
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return array_add(
            parent::getTokenFields($code), 'grant_type', 'authorization_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(env('OAUTH_URL', 'https://accounts.gtd.asimov.cl') . '/api/user', [
            'query' => [
                'prettyPrint' => 'false',
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'rut' => $user['rut'],
            'dv' => $user['dv'],
            'extra' => $user['extra']
        ]);
    }
}
