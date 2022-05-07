<?php
declare(strict_types=1);

namespace App\Service;

use App\Client\GitHubClient;
use App\Form\RepoForm;
use App\Response\GitHubResponse;

final class GitHubResponseService
{
    public function __construct(private GitHubClient $client)
    {
    }

    public function createFromForm(RepoForm $form): GitHubResponse
    {
        $stats = $this->client->getRepoStats($form->getName());
        return (new GitHubResponse())
            ->setRepoName($form->getName())
            ->setForksCount($stats['forks_count'])
            ->setWatchersCount($stats['watchers_count'])
            ->setStartsCount($stats['stargazers_count'])
            ->setLatestReleaseDate($this->client->getLatestReleaseDate($form->getName()))
            ->setClosedPullRequests($this->client->getPullsCount($form->getName()))
            ->setOpenPullRequests($this->client->getPullsCount($form->getName(), 'closed'));
    }
}