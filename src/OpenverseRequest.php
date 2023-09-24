<?php

namespace OpenverseClient;

use OpenverseClient\Exceptions\OpenverseClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class OpenverseRequest
{
    private const HTTP_STATUS_CODE_OK = [200, 201];
    private string $url = 'https://api.openverse.engineering/v1';
    private Client $client;

    public function __construct(public readonly ?string $accessToken = null)
    {
        $this->client = $this->createClient();
    }

    /**
     * Makes post request.
     *
     * @param string $endpoint
     * @param array $params
     *
     * @return array
     *
     * @throws OpenverseClientException
     */
    public function post(string $endpoint, array $params): array
    {
        try {
            $response = $this->client->post("$this->url/$endpoint", ['form_params' => $params]);
        } catch (GuzzleException $exception) {
            throw new OpenverseClientException($exception);
        }

        return $this->parseResponse($response);
    }

    /**
     * Makes get request.
     *
     * @param string $endpoint
     * @param string $params
     *
     * @return array
     *
     * @throws OpenverseClientException
     */
    public function get(string $endpoint, string $params = ''): array
    {
        try {
            $response = $this->client->get("$this->url/$endpoint?" . $params);
        } catch (GuzzleException $exception) {
            throw new OpenverseClientException($exception);
        }

        return $this->parseResponse($response);
    }

    /**
     * Decodes the response and checks its status code. Returns decoded response.
     *
     * @param ResponseInterface $response
     *
     * @return array
     *
     * @throws OpenverseClientException
     */
    private function parseResponse(ResponseInterface $response): array
    {
        if (!in_array($response->getStatusCode(), static::HTTP_STATUS_CODE_OK)) {
            throw new OpenverseClientException("Invalid http status: {$response->getStatusCode()}");
        }

        $body = $response->getBody()->getContents();

        return $this->decodeBody($body);
    }

    /**
     * Decodes body.
     *
     * @param string $body
     *
     * @return array
     */
    private function decodeBody(string $body): array
    {
        $decoded_body = json_decode($body, true);

        if (!is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }

    private function createClient(): Client
    {
        if($this->accessToken){
            $client = new Client(['headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken
            ]]);
        }
        return $client ?? new Client();
    }
}
