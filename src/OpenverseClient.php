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

    private array $instances = [];

    public function __construct(string $accessToken = null)
    {
        $this->request = new OpenverseRequest($accessToken);
    }

    /**
     * @param string $name
     * @param array<array-key, mixed> $_
     * @return ActionInterface
     * @throws OpenverseClientException
     */
    public function __call(string $name, array $_): ActionInterface
    {
        $class = '\\App\\Openverse\\Actions\\' . ucfirst($name);
        if (!class_exists($class)) {
            throw new OpenverseClientException("Class $class not found");
        }

        if (!array_key_exists($name, $this->instances)) {
            $this->instances[$name] = new $class($this->request);
        }
        return $this->instances[$name];
    }
}
