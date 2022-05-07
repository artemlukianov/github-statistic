<?php
declare(strict_types=1);

namespace App\Client;

use GuzzleHttp\Client;
use Webmozart\Assert\Assert;

final class GitHubClient extends Client
{
    public function __construct()
    {
        parent::__construct(['base_uri' => 'https://api.github.com/']);
    }

    /** @return array{stargazers_count: int, watchers_count:int, forks_count: int} */
    public function getRepoStats(string $name): array
    {
        $res = $this->get("repos/$name");
        $content = json_decode($res->getBody()->getContents(), true, JSON_THROW_ON_ERROR);

        Assert::notNull($content);
        return $content;
    }

    public function getLatestReleaseDate(string $name): string
    {
        $res = $this->get("repos/$name/releases?per_page=1");
        $content = json_decode($res->getBody()->getContents(), true, JSON_THROW_ON_ERROR);

        Assert::notNull($content);
        return isset($content[0]) ? $content[0]['published_at'] : 'null';
    }

    /**
     * @param string $name
     */
    public function getPullsCount(string $name, string $state = 'open'): int
    {
        $result = 0;
        $page = 1;
        do {
            $res = $this->get("repos/$name/pulls?state=$state&page=$page&per_page=100");
            $content = json_decode($res->getBody()->getContents(), true, JSON_THROW_ON_ERROR);

            Assert::notNull($content);
            $page++;
            $current = count($content);
            $result += $current;
            if ($page > 150) {
                dd('test');
            }
        } while ($current > 0);

        return $result;
    }
}