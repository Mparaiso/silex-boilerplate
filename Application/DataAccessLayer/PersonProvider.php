<?php

namespace Application\DataAccessLayer{

    use Doctrine\DBAL\Connection;
    use Application\DataTransferObject\PersonEntity;

    class PersonProvider implements IPersonProvider
    {
        /**
         * @var Doctrine\DBAL\Connection $connection
         */
        protected $connection;

        /**
         * @var string $tableName
         */
        protected $tableName ;
        
        function __construct(Connection $connection,$tableName="Persons")
        {
            $this->connection = $connection;
            $this->tableName = $tableName;
        }

        /**
         * get all persons
         * @return array an array of PersonEntity
         */
        function get(){
            $persons =  $this->connection->fetchAll(" SELECT * FROM $this->tableName ");
            return array_map(function($person){
                $p = new PersonEntity();
                $p->firstName = $person["firstname"];
                $p->lastName = $person["lastname"];
                $p->id = $person["id"];
                return $p;
            }, $persons);
        }
    }
}