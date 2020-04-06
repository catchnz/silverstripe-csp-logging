<?php

namespace Camspiers\CSP;

use Psr\Log\LoggerInterface;
use SilverStripe\Control\Controller as SilverStripeController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;

/**
 * Class Controller
 * @package Camspiers\CSP
 */
class Controller extends SilverStripeController
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * @param HTTPRequest $request
     * @return HTTPResponse
     */
    public function index(HTTPRequest $request)
    {
        $this->response->setStatusCode(204);
        $this->response->setBody('');

        $report = json_decode($request->getBody(), true);

        if ($report && isset($report['csp-report'])) {

            $this->logger->info(
                'Content-Security-Policy violation',
                $report['csp-report']
            );
        }

        return $this->response;
    }
}
