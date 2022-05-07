<?php
declare(strict_types=1);

namespace App\DTO;

final class GitHubStatisticDTO
{
    private string $closedPullRequestsDiff = '';
    private string $openPullRequestsDiff = '';
    private string $starsDiff = '';
    private string $forksDiff = '';
    private string $watchersDiff = '';
    private string $releaseDateDiff = '';

    public function getClosedPullRequestsDiff(): string
    {
        return $this->closedPullRequestsDiff;
    }

    public function setClosedPullRequestsDiff(string $closedPullRequestsDiff): self
    {
        $this->closedPullRequestsDiff = $closedPullRequestsDiff;

        return $this;
    }

    public function getOpenPullRequestsDiff(): string
    {
        return $this->openPullRequestsDiff;
    }

    public function setOpenPullRequestsDiff(string $openPullRequestsDiff): self
    {
        $this->openPullRequestsDiff = $openPullRequestsDiff;

        return $this;
    }

    public function getStarsDiff(): string
    {
        return $this->starsDiff;
    }

    public function setStarsDiff(string $starsDiff): self
    {
        $this->starsDiff = $starsDiff;

        return $this;
    }

    public function getForksDiff(): string
    {
        return $this->forksDiff;
    }

    public function setForksDiff(string $forksDiff): self
    {
        $this->forksDiff = $forksDiff;

        return $this;
    }

    public function getWatchersDiff(): string
    {
        return $this->watchersDiff;
    }

    public function setWatchersDiff(string $watchersDiff): self
    {
        $this->watchersDiff = $watchersDiff;

        return $this;
    }

    public function getReleaseDateDiff(): string
    {
        return $this->releaseDateDiff;
    }

    public function setReleaseDateDiff(string $releaseDateDiff): self
    {
        $this->releaseDateDiff = $releaseDateDiff;

        return $this;
    }
}