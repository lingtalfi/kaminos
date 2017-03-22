<?php


use Architecture\Request\Web\HttpRequest;

require_once __DIR__ . "/../init.php";



$r = HttpRequest::create();
a($r->uri());
a($r->uri(false));
a($r->queryString());
a($r->isHttps());
a($r->method());
a($r->host());
a($r->port());
a($r->protocol());
a($r->remoteAddress());
a($r->remotePort());
a($r->header("host"));
a($r->header("user-agent"));
a($r->header("accept"));
a($r->header("accept-language"));
a($r->header("accept-encoding"));
a($r->header("connection"));
a($r->header("upgrade-insecure-requests"));


