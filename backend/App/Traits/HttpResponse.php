<?php

namespace App\Traits;

use App\Constants\HttpStatus;

trait HttpResponse
{
    /**
     * Send Success API Response
     *
     * @param $data
     * @param string $message
     * @param int $status
     * @return void
     */
    public function sendSuccess($data, string $message = 'Data Fetched Successfully', int $status = HttpStatus::OK)
    {
        $this->headers($status);

        echo json_encode(array(
            'response' => $data,
            'message' => $message,
            'code' => $status,
        ));
    }

    /**
     * Send Failed API Response
     *
     * @param string $message
     * @param int $status
     * @param array|null $data
     */
    public function sendError(string $message = 'Data Fetch Failed', int $status = HttpStatus::BAD_REQUEST, ?array $data = [])
    {
        $this->headers($status);

        echo json_encode(array(
            'errors' => $data,
            'message' => $message,
            'code' => $status,
        ));
    }

    /**
     * Send Validation Failed API Response
     *
     * @param array|null $data
     */
    public function sendValidationError(array $data = [])
    {
        $status = HttpStatus::UNPROCESSABLE_ENTITY;

        $this->headers($status);

        echo json_encode(array(
            'errors' => $data,
            'message' => 'Data Validation Error',
            'code' => $status,
        ));
    }


    private function headers($status)
    {
        // clear the old headers
        header_remove();
        // set the actual code
        http_response_code($status);
        // set the header to make sure cache is forced
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        // treat this as json
        header('Content-Type: application/json');
        // validation error, or failure
        header('Status: ' . HttpStatus::getLabel($status));
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    }
}