<?php

namespace App\Controllers;

use App\Traits\HttpResponse;
use App\Requests\BookRequest;

class BookController extends BaseController
{
    use HttpResponse;

    public function index()
    {
        $response = file_get_contents('https://www.anapioficeandfire.com/api/books');
        if($response){
            return $this->sendSuccess(json_decode($response, true));
        }
        return $this->sendError('Sorry, an error has just occured. Please try again');
        
    }
    public function show()
    {
        $this->bookRequest = new BookRequest();
        $request = $this->bookRequest->getBody();
        $bookId = $request['bookId'];

        $response = file_get_contents("https://www.anapioficeandfire.com/api/books/{$bookId}");
        if($response){
            return $this->sendSuccess(json_decode($response, true));
        }
        return $this->sendError('Sorry, an error has just occured. Please try again');
        
    }
}