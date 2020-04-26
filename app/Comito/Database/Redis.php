<?php

namespace Comito\Database;

use Comito\GenericSingleton;
use Predis\Client;

class Redis extends GenericSingleton implements IDatabase
{
    private $db;

    // En mettant le constructeur en visibilité protected on s'assure
    // que nous ne pourrons pas instancier cette classe depuis l'extérieur
    protected function __construct() 
    {
        $config = include dirname(__DIR__, 2).'/config.php';
        $this->db = new Client($config['redis']['host'], [
            'parameters' => [
                'password' => $config['redis']['password']
            ]
        ]);
    }

    public function getDatabase()
    {
        return $this->db;
    }
    
}