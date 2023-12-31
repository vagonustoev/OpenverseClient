<?php

namespace OpenverseClient;

use OpenverseClient\Actions\ActionInterface;
use OpenverseClient\Actions\AudioSearch;
use OpenverseClient\Actions\Auth;
use OpenverseClient\Actions\ImageSearch;
use OpenverseClient\Exceptions\OpenverseClientException;

/**
 * @method Auth auth()
 * @method ImageSearch imageSearch()
 * @method AudioSearch audioSearch()
 */
class OpenverseClient
{
    private OpenverseRequest $request;

    /**
     * @var array<mixed>
     */
    private array $instances = [];

    public function __construct(public ?string $accessToken = null)
    {
        $this->request = new OpenverseRequest($accessToken);
    }

    public  function withAccessToken(): static
    {
        $this->accessToken = config('openverse.accessToken') ?? null;
        return $this;
    }

    /**
     * @param string $name
     * @param array<array-key, mixed> $_
     * @return ActionInterface
     * @throws OpenverseClientException
     */
    public function __call(string $name, array $_): ActionInterface
    {
        $class = 'OpenverseClient\\Actions\\' . ucfirst($name);
        if (!class_exists($class)) {
            throw new OpenverseClientException("Class $class not found");
        }

        if (!array_key_exists($name, $this->instances)) {
            $this->instances[$name] = new $class($this->request);
        }
        return $this->instances[$name];
    }
}
