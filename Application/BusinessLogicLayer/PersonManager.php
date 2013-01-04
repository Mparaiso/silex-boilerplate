<?php

namespace Application\BusinessLogicLayer{
    use Silex\Application;
    use Application\DataAccessLayer\IPersonProvider;
    use Application\DataTransferObject\PersonEntity;

    class PersonManager
    {
        /**
         * @var Application\DataAccessLayer\IPersonProvider $provider
         */
        public $provider;

        /**
         * @var string $tableName
         */
        protected $tableName = "Persons";

        function __construct(IPersonProvider $provider)
        {
            $this->provider = $provider;
        }

        /**
         * get all persons
         * @return array an array of PersonEntity
         */
        function get(){
            return $this->provider->get();
        }
    }
}