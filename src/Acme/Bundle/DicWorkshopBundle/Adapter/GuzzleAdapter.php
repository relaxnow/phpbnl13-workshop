<?php

namespace Acme\Bundle\DicWorkshopBundle\Adapter;

use Guzzle\Http\ClientInterface;

class GuzzleAdapter implements AdapterInterface
{
    private $httpAdapter;
    private $endpointUrl;

    public function __construct(ClientInterface $httpAdapter, $endpointUrl)
    {
        $this->httpAdapter = $httpAdapter;
        $this->endpointUrl = $endpointUrl;
    }

    /**
     * @{inheritdoc}
     */
    public function getRawData()
    {
        $request = $this->httpAdapter->get($this->endpointUrl);
        $request->addCacheControlDirective('must-revalidate');
        $response = $request->send();

        return $response->getBody(true);
    }
}
