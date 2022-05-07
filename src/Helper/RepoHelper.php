<?php
declare(strict_types=1);

namespace App\Helper;

final class RepoHelper
{
    // https://github.com/{owner}/{repo} -> {owner}/{repo}
    public function formatToName(string $value): string
    {
        return implode('/', array_slice(explode('/', $value), -2, 2));
    }
}