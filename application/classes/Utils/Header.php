<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 02.04.2014
 * Time: 14:07
 */

namespace Utils;


class Header
{
	const Continue_ = 100;
	const Switching_Protocols = 101;
	const Processing = 102;
	const OK = 200;
	const Created = 201;
	const Accepted = 202;
	const Non_Authoritative_Information = 203;
	const No_Content = 204;
	const Reset_Content = 205;
	const Partial_Content = 206;
	const Multi_Status = 207;
	const Multiple_Choices = 300;
	const Moved_Permanently = 301;
	const Found = 302;
	const See_Other = 303;
	const Not_Modified = 304;
	const Use_Proxy = 305;
	const Temporary_Redirect = 307;
	const Bad_Request = 400;
	const Unauthorized = 401;
	const Payment_Required = 402;
	const Forbidden = 403;
	const Not_Found = 404;
	const Method_Not_Allowed = 405;
	const Not_Acceptable = 406;
	const Proxy_Authentication_Required = 407;
	const Request_Timeout = 408;
	const Conflict = 409;
	const Gone = 410;
	const Length_Required = 411;
	const Precondition_Failed = 412;
	const Request_Entity_Too_Large = 413;
	const Request_URI_Too_Long = 414;
	const Unsupported_Media_Type = 415;
	const Requested_Range_Not_Satisfiable = 416;
	const Expectation_Failed = 417;
	const Unprocessable_Entity = 422;
	const Locked = 423;
	const Failed_Dependency = 424;
	const Upgrade_Required = 426;
	const Internal_Server_Error = 500;
	const Not_Implemented = 501;
	const Bad_Gateway = 502;
	const Service_Unavailable = 503;
	const Gateway_Timeout = 504;
	const HTTP_Version_Not_Supported = 505;
	const Variant_Also_Negotiates = 506;
	const Insufficient_Storage = 507;
	const Bandwidth_Limit_Exceeded = 509;
	const Not_Extended = 510;





	public static function header_status($statusCode) {
		static $status_codes = null;

		if ($status_codes === null) {
			$status_codes = array (
				100 => 'Continue',
				101 => 'Switching Protocols',
				102 => 'Processing',
				200 => 'OK',
				201 => 'Created',
				202 => 'Accepted',
				203 => 'Non-Authoritative Information',
				204 => 'No Content',
				205 => 'Reset Content',
				206 => 'Partial Content',
				207 => 'Multi-Status',
				300 => 'Multiple Choices',
				301 => 'Moved Permanently',
				302 => 'Found',
				303 => 'See Other',
				304 => 'Not Modified',
				305 => 'Use Proxy',
				307 => 'Temporary Redirect',
				400 => 'Bad Request',
				401 => 'Unauthorized',
				402 => 'Payment Required',
				403 => 'Forbidden',
				404 => 'Not Found',
				405 => 'Method Not Allowed',
				406 => 'Not Acceptable',
				407 => 'Proxy Authentication Required',
				408 => 'Request Timeout',
				409 => 'Conflict',
				410 => 'Gone',
				411 => 'Length Required',
				412 => 'Precondition Failed',
				413 => 'Request Entity Too Large',
				414 => 'Request-URI Too Long',
				415 => 'Unsupported Media Type',
				416 => 'Requested Range Not Satisfiable',
				417 => 'Expectation Failed',
				422 => 'Unprocessable Entity',
				423 => 'Locked',
				424 => 'Failed Dependency',
				426 => 'Upgrade Required',
				500 => 'Internal Server Error',
				501 => 'Not Implemented',
				502 => 'Bad Gateway',
				503 => 'Service Unavailable',
				504 => 'Gateway Timeout',
				505 => 'HTTP Version Not Supported',
				506 => 'Variant Also Negotiates',
				507 => 'Insufficient Storage',
				509 => 'Bandwidth Limit Exceeded',
				510 => 'Not Extended'
			);
		}

		if ($status_codes[$statusCode] !== null) {
			$status_string = $statusCode . ' ' . $status_codes[$statusCode];
			header($_SERVER['SERVER_PROTOCOL'] . ' ' . $status_string, true, $statusCode);
		}
	}
} 