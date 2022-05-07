<?php
declare(strict_types=1);

namespace App\Controller;

use App\Factory\StatisticDTOFactory;
use App\Form\RepoForm;
use App\Form\RepoItemsForm;
use App\Helper\RepoHelper;
use App\Service\GitHubResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class StatisticsController extends AbstractController
{
    public function __construct(
        private ValidatorInterface    $validator,
        private GitHubResponseService $responseService,
        private StatisticDTOFactory   $statisticFactory,
        private NormalizerInterface   $normalizer,
        private RepoHelper            $repoHelper
    ){
    }

    #[Route(path: "/api/statistics/compare", methods: ["GET"])]
    public function compare(Request $request): Response
    {
        $form = (new RepoItemsForm())->mapFromArray($request->get('items') ?? []);

        $errors = $this->validator->validate($form);
        if ($errors->count() > 0) {
            return new Response((string) $errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $form->getItems()->map(fn($item) => $item->setName($this->repoHelper->formatToName($item->getName())));

        $responses = [];
        foreach ($form->getItems()->toArray() as $item) {
            $responses[] = $this->responseService->createFromForm($item);
        }

        return $this->json([
            'data' => $this->normalizer->normalize($this->statisticFactory->createFromResponses($responses))
        ]);
    }


}