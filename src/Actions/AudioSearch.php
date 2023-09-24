<?php

namespace OpenverseClient\Actions;

use OpenverseClient\Enums\Audio\Category;
use OpenverseClient\Enums\Audio\Length;
use OpenverseClient\Enums\License;
use OpenverseClient\Enums\LicenseType;
use OpenverseClient\Exceptions\OpenverseClientException;
use OpenverseClient\OpenverseRequest;
use OpenverseClient\Traits\EnumTrait;

/**
 * @method $this page(integer $page) The page of results to retrieve.
 * @method $this page_size(integer $page_size) Number of results to return per page.
 * @method $this q(string $q) A query string that should not exceed 200 characters in length.
 * @method $this source(string $source) A comma separated list of data sources.
 * @method $this excluded_source(string $excluded_source) A comma separated list of data sources.
 * @method $this license(License $license) A comma separated list of licenses.
 * @method $this license_type(LicenseType $license_type) comma separated list of license types.
 * @method $this creator(string $creator) Search by creator only. Cannot be used with q.
 * @method $this tags(string $tags) Search by tag only. Cannot be used with q.
 * @method $this title(string $title) Search by title only. Cannot be used with q.
 * @method $this filter_dead(boolean $filter_dead) Control whether 404 links are filtered out.
 * @method $this extension(string $extension) A comma separated list of desired file extensions.
 * @method $this mature(boolean $mature) Whether to include content for mature audiences.
 * @method $this category(Category $category) A comma separated list of categories; available categories include: audiobook, music, news, podcast, pronunciation, and sound_effect.
 * @method $this length(Length $length) A comma separated list of lengths; available lengths include: long, medium, short, and shortest.
 * @method $this peaks(boolean $peaks) Whether to include the waveform peaks or not.
 */
class AudioSearch implements ActionInterface
{
    private OpenverseRequest $request;
    /**
     * @var array{
     *      page?: integer,
     *      page_size?: integer,
     *      q?: string,
     *      source?: string,
     *      excluded_source?: string,
     *      license?: string,
     *      license_type?: string,
     *      creator?: string,
     *      tags?: string,
     *      title?: string,
     *      filter_dead?: boolean,
     *      extension?: string,
     *      mature?: string,
     *      category?: string,
     *      length?: string,
     *      peaks?: boolean
     * } $params
     */
    public array $params = array();

    private array $methods = [
        'page',
        'page_size',
        'q',
        'source',
        'excluded_source',
        'license',
        'license_type',
        'creator',
        'tags',
        'title',
        'filter_dead',
        'mature',
        'mature',
        'category',
        'length',
        'peaks',
    ];

    public function __construct(OpenverseRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Search audio
     * @return array<mixed>
     *
     * @throws OpenverseClientException
     */
    public function get(): array
    {
        $params = '';
        foreach ($this->params as $param){
            $params .= http_build_query($param) . "&";
        }
        return $this->request->get('audio', $params);
    }

    /**
     * @param array{
     *     page?: integer,
     *     page_size?: integer,
     *     q?: string,
     *     source?: string,
     *     excluded_source?: string,
     *     license?: string,
     *     license_type?: string,
     *     creator?: string,
     *     tags?: string,
     *     title?: string,
     *     filter_dead?: boolean,
     *     extension?: string,
     *     mature?: string,
     *     category?: string,
     *     length?: string,
     *     peaks?: boolean
     * } $params
     * @return $this
     */
    public function setParams(array $params): static
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param string $name
     * @param array<array-key, mixed> $arg
     * @return AudioSearch
     * @throws OpenverseClientException
     */
    public function __call(string $name, array $arg): self
    {
        if(!in_array($name, $this->methods)){
            throw new OpenverseClientException("Class $name not found");
        }
        $value = $arg[0];
        if(gettype($value) == 'object'){
            $value = $value->toString();
        }
        $this->params[] = [$name => $value];
        return $this;
    }

}
