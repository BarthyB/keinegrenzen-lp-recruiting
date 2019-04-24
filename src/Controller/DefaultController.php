<?php

namespace App\Controller;

use App\Service\NameParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/{name}", name="index", defaults={"name" = "Musik"})
     * @param string     $name
     * @param NameParser $nameParser
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function index(string $name, NameParser $nameParser): Response
    {
        $parsedName = $nameParser->parseName($name);

        return $this->render(
            'index.html.twig',
            [
                'name' => $parsedName,
            ]
        );
    }
}
