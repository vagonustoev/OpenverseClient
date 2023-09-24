<?php

namespace OpenverseClient\Actions;

use OpenverseClient\Enums\Image\AspectRatio;
use OpenverseClient\Enums\Image\Category;
use OpenverseClient\Enums\Image\Size;
use OpenverseClient\Enums\License;
use OpenverseClient\Enums\LicenseType;
use OpenverseClient\Exceptions\OpenverseClientException;
use OpenverseClient\OpenverseRequest;

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
 * @method $this category(Category $category) A comma separated list of categories; available categories include: digitized_artwork, illustration, and photograph.
 * @method $this aspect_ratio(AspectRatio $category) A comma separated list of aspect ratios; available aspect ratios include: square, tall, and wide.
 * @method $this size(Size $size) A comma separated list of image sizes; available image sizes include: large, medium, and small.
 */
class ImageSearch implements ActionInterface
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
     *      aspect_ratio?: string,
     *      size?: string
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
        'aspect_ratio',
        'size',
    ];

    public function __construct(OpenverseRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Search image
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
        return $this->request->get('images', $params);
    }

    /**
     * Set params in custom array
     *
     * @param array{
     *     page: integer,
     *     page_size: integer,
     *     q: string,
     *     source: string,
     *     excluded_source: string,
     *     license: string,
     *     license_type: string,
     *     creator: string,
     *     tags: string,
     *     title: string,
     *     filter_dead: boolean,
     *     extension: string,
     *     mature: string,
     *     category: string,
     *     aspect_ratio: string,
     *     size: string
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
     * @return ImageSearch
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
