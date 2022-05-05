<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class StatisticsController extends AbstractController
{
    public function __construct(private NormalizerInterface $normalizer)
    {
    }

    #[Route(path: "/api/statistics/compare", methods: ["GET"])]
    public function compare(Request $request): Response
    {
        dd($this->getNameFromUrl($request->get('items')[0]));
        return $this->json(['test']);
    }

    // format from repo github url to repo name https://github.com/{owner}/{repo} -> {owner}/{repo}
    private function getNameFromUrl(string $url): mixed
    {
        return implode('/', array_slice(explode('/', $url), -2, 2));
    }
}