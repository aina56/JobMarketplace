<?php

namespace App\Providers\Socialite;

use SocialiteProviders\Orcid\Provider as OrcidProvider;

class OrcidCustomProvider extends OrcidProvider
{
    /**
     * Override URLs to use production.
     */
    protected const BASE_ORCID_URL = 'https://orcid.org/';

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://orcid.org/oauth/authorize', $state
        );
    }

    protected function getTokenUrl()
    {
        return 'https://orcid.org/oauth/token';
    }
}
