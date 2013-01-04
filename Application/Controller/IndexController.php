<?php
/**
* @author M.Paraiso
*/
namespace Application\Controller{

    use Silex\Application;
    use Application\BusinessLogicLayer\PersonManager;

    class IndexController
    {

        function Index(Application $app,$name){
            $persons = $app["personManager"]->get();
            return $app["twig"]->render("index.html.twig",
                array("name"=>$name,"persons"=>$persons)
                );
        }
    }
}