<?php
    /**
     * General functions for database
     */
    function loadDB() {
        $GLOBALS['db'] = json_decode(file_get_contents("db/db.json"), true);

        if (!isset($GLOBALS['db']['books'])) {
            $GLOBALS['db']['books'] = array();
        }
        $GLOBALS['books'] = $GLOBALS['db']['books'];

        if (!isset($GLOBALS['db']['users'])) {
            $GLOBALS['db']['users'] = array();
        }
        $GLOBALS['users'] = $GLOBALS['db']['users'];

        if (!isset($GLOBALS['db']['userbooks'])) {
            $GLOBALS['db']['userbooks'] = array();
        }
        $GLOBALS['userbooks'] = $GLOBALS['db']['userbooks'];

        if (!isset($GLOBALS['db']['comments'])) {
            $GLOBALS['db']['comments'] = array();
        }
        $GLOBALS['comments'] = $GLOBALS['db']['comments'];
    }

    /**
     * Function which saving database
     */
    function saveDB() {
        file_put_contents("db/db.json", json_encode($GLOBALS['db'], JSON_PRETTY_PRINT));
        loadDB();
    }

    // Books functions
    /**
     * Filtr books by category
     * 
     * @param $category category of book
     * 
     */
    function getBooksByCategory($category) {
        return array_filter($GLOBALS['books'], function ($book) use ($category) {
            return $book['category'] == $category;
        });
    }

    /**
     * Return books which has user
     * 
     * @param $userEmail users email
     * 
     */
    function getBooksByUser($userEmail) {
        $userbooks = array_filter($GLOBALS['userbooks'], function ($userbook) use ($userEmail) {
            return $userbook['userEmail'] == $userEmail;
        });

        $bookIds = array_map(function ($userbook) {
            return $userbook['bookId'];
        }, $userbooks);

        return array_filter($GLOBALS['books'], function ($book) use ($bookIds) {
            return in_array($book['id'], $bookIds);
        });
    }

    /**
     * Return books by ids
     * 
     * @param $id id of the book
     */
    function getBookById($id) {
        foreach($GLOBALS['books'] as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }

        return NULL;
    }

    // UserBook functions

    /**
     * Add book in user books by id
     * 
     * @param $userEmail users email
     * @param $bookId book id
     */
    function addUserBook($userEmail, $bookId){
        array_push($GLOBALS['db']['userbooks'], array(
            'userEmail' => $userEmail,
            'bookId' => $bookId
        ));
        saveDB();
    }

    /**
     * Delete book from user books by id
     * 
     * @param $userEmail users email
     * @param $bookId book id
     */
    function deleteUserBook($userEmail, $bookId){
        $GLOBALS['db']['userbooks'] = array_filter($GLOBALS['userbooks'], function ($userbook) use ($userEmail, $bookId) {
            return $userbook['userEmail'] != $userEmail || $userbook['bookId'] != $bookId;
        });
        saveDB();
    }

    /**
     * Return all users ids books
     * 
     * @param $userEmail users email
     */
    function getUserBooksIds($userEmail) {
        $userbooks = array_filter($GLOBALS['userbooks'], function ($userbook) use ($userEmail) {
            return $userbook['userEmail'] == $userEmail;
        });

        return array_map(function ($userbook) {
            return $userbook['bookId'];
        }, $userbooks);
    }


    // Users function
    /**
     * Inset user in database
     * 
     * @param $user user
     */
    function insertUser($user) {
        array_push($GLOBALS['db']['users'], $user);
        saveDB();
    }

    /**
     * Check if email is already exist
     * 
     * @param $userEmail users email
     */
    function checkDublicateEmail($userEmail) {
        foreach($GLOBALS['users'] as $user) {
            if ($user['email'] == $userEmail) {
                return true;
            }
        }
        return false; 
    }


    function addComment($name, $text) {
        array_push($GLOBALS['db']['comments'], array(
            'name' => $name,
            'text' => $text
        ));
        saveDB();
    }

    // Init

    loadDB();
