<?php

namespace Core\Rest\Response;

enum ResponseType: string
{
	case OK = 'OK';
	case BAD_REQUEST = 'BAD_REQUEST';
}