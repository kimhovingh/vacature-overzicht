<?php
namespace Src\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Src\Models\Vacancy;

class IndexController extends AbstractController
{

    public function indexAction(Request $request, Response $response, $args)
    {
        try {
            /** @var Vacancy $vacancy */
            $vacancy = $this->modelFactory->build('Vacancy');
            $vacancies = $vacancy->all();
        } catch (\Exception $e) {
            $this->logger->critical($e);
            // TODO render custom 500 page
            return $response->withStatus(500)->withHeader('Content-Type', 'text/html')->write('Er is iets fout gegaan!');
        }

        $params = [
          'vacancies' => $vacancies,
        ];

        $this->render($request, $response, 'index/index.html.twig', $params);
        return $response;
    }

}