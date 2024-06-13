<?php

namespace WebDirectory\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class AbstractAction{

    public abstract function __invoke(Request $rq, Response $rs, array $args): Response ;


}