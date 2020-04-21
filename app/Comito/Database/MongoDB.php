<?php

namespace Comito\Database;

use Comito\GenericSingleton;
use MongoDB\Client;

class MongoDB extends GenericSingleton implements IDatabase
{
    private $db;

    // En mettant le constructeur en visibilité protected on s'assure
    // que nous ne pourrons pas instancier cette classe depuis l'extérieur
    protected function __construct() 
    {
        $config = include dirname(__DIR__, 2).'/config.php';
        $client = new Client($config['mongodb']['host']);
        $this->db = $client->selectDatabase($config['mongodb']['dbname']);
    }

    public function getDatabase()
    {
        return $this->db;
    }
}