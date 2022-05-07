<?php
declare(strict_types=1);

namespace App\Factory;

use App\DTO\GitHubStatisticDTO;
use App\Response\GitHubResponse;

final class StatisticDTOFactory
{
    /**
     * @param array<GitHubResponse> $responses
     * @return GitHubStatisticDTO
     */
    public function createFromResponses(array $responses): GitHubStatisticDTO
    {
        $dto = new GitHubStatisticDTO();
        foreach ($responses as $response) {
            $dto->setForksDiff($this->format($response->getRepoName(), $dto->getForksDiff(), $response->getForksCount()))
                ->setStarsDiff($this->format($response->getRepoName(), $dto->getStarsDiff(), $response->getStartsCount()))
                ->setWatchersDiff($this->format($response->getRepoName(), $dto->getWatchersDiff(), $response->getWatchersCount()))
                ->setReleaseDateDiff($this->format($response->getRepoName(), $dto->getReleaseDateDiff(), $response->getLatestReleaseDate()))
                ->setClosedPullRequestsDiff($this->format($response->getRepoName(), $dto->getClosedPullRequestsDiff(), $response->getClosedPullRequests()))
                ->setOpenPullRequestsDiff($this->format($response->getRepoName(), $dto->getOpenPullRequestsDiff(), $response->getOpenPullRequests()));
        }

        return $dto;
    }

    private function format(string $repoName, string $origin, $value):string
    {
        if (strlen($origin) > 0) {
            return sprintf('%s vs (%s) %s', $origin, $repoName, $value);
        }

        return sprintf('(%s) %s', $repoName, $value);
    }
}