<?php
declare(strict_types=1);

namespace App\Controller;

use App\Factory\StatisticDTOFactory;
use OpenApi\Annotations as OA;
use App\Form\RepoItemsForm;
use App\Helper\RepoHelper;
use App\Service\GitHubResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\DTO\GitHubStatisticDTO;
use Nelmio\ApiDocBundle\Annotation\Model;

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

    /**
     * @Route("/api/statistics/compare", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Comparing two repositories",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=GitHubStatisticDTO::class))
     *     )
     * )
     * @OA\Parameter(
     *     name="items",
     *     in="query",
     *     description="Urls/names of repositories",
     *     @OA\Schema(type="array", @OA\Items(type="string"))
     * )
     * @OA\Tag(name="compare")
     */
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