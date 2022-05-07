<?php
declare(strict_types=1);

namespace App\Response;

final class GitHubResponse
{
    private string $repoName = '';

    private int $forksCount = 0;

    private int $watchersCount = 0;

    private int $startsCount = 0;

    private int $openPullRequests = 0;

    private int $closedPullRequests = 0;

    private string $latestReleaseDate = '';

    public function getRepoName(): string
    {
        return $this->repoName;
    }

    public function setRepoName(string $repoName): self
    {
        $this->repoName = $repoName;

        return $this;
    }

    public function getForksCount(): int
    {
        return $this->forksCount;
    }

    public function setForksCount(int $forksCount): self
    {
        $this->forksCount = $forksCount;

        return $this;
    }

    public function getWatchersCount(): int
    {
        return $this->watchersCount;
    }

    public function setWatchersCount(int $watchersCount): self
    {
        $this->watchersCount = $watchersCount;

        return $this;
    }

    public function getStartsCount(): int
    {
        return $this->startsCount;
    }

    public function setStartsCount(int $startsCount): self
    {
        $this->startsCount = $startsCount;

        return $this;
    }
    public function getOpenPullRequests(): int
    {
        return $this->openPullRequests;
    }

    public function setOpenPullRequests(int $openPullRequests): self
    {
        $this->openPullRequests = $openPullRequests;

        return $this;
    }

    public function getClosedPullRequests(): int
    {
        return $this->closedPullRequests;
    }

    public function setClosedPullRequests(int $closedPullRequests): self
    {
        $this->closedPullRequests = $closedPullRequests;

        return $this;
    }

    public function getLatestReleaseDate(): string
    {
        return $this->latestReleaseDate;
    }

    public function setLatestReleaseDate(string $latestReleaseDate): self
    {
        $this->latestReleaseDate = $latestReleaseDate;

        return $this;
    }
}