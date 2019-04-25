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

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://keinegrenzen.org/artist-count');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $artistCount = intval($output);

        return $this->render(
            'index.html.twig',
            [
                'name'        => $parsedName,
                'artistCount' => $artistCount,
            ]
        );
    }
}
