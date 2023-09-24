<?php

namespace OpenverseClient\Actions;

use OpenverseClient\Exceptions\OpenverseClientException;
use OpenverseClient\OpenverseRequest;

class Auth implements ActionInterface
{
    private OpenverseRequest $request;

    public function __construct(OpenverseRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Register new user
     *
     * @param string $name
     * @param string $description
     * @param string $email
     *
     * @return array
     * @throws OpenverseClientException
     */
    public function register(string $name, string $description, string $email): array
    {
        $params = [
            'name' => $name,
            'description' => $description,
            'email' => $email
        ];
        return $this->request->post('auth_tokens/register/', $params);
    }

    /**
     * Create a new token valid for 12 hours.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $grantType
     *
     * @return array
     * @throws OpenverseClientException
     */
    public function createToken(string $clientId, string $clientSecret, string $grantType = 'client_credentials'): array
    {
        $params = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => $grantType
        ];
        return $this->request->post('auth_tokens/token/', $params);
    }

    /**
     * Get information about your API key.
     *
     * @return array
     * @throws OpenverseClientException
     */
    public function tokenInfo(): array
    {
        if(!$this->request->accessToken){
            throw new OpenverseClientException('Access token not set');
        }
        return $this->request->get('rate_limit/');
    }

}
