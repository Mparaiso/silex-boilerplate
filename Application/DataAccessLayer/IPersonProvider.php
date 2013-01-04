<?php

namespace Application\DataAccessLayer{

    use Doctrine\DBAL\Connection;
    use Application\DataTransferObject\PersonEntity;
    
    interface IPersonProvider
    {
        /**
         * get all persons
         * @return array an array of PersonEntity
         */
        function get();
    }
}