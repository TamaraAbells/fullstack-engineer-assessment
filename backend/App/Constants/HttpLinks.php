<?php

namespace App\Constants;

class HttpLinks
{
    const GET_BOOKS = 'https://www.anapioficeandfire.com/api/books';

    /**
     * List Of All Links
     * @return array
     */
    function getBooks()
    {
        return self::GET_BOOKS;
    }
}