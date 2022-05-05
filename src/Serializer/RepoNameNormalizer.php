<?php

namespace App\Serializer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class RepoNameNormalizer implements ContextAwareNormalizerInterface
{
    public function __construct(private ObjectNormalizer $normalizer) {
    }

    /**
     * @param array<string, mixed> $data
     * @param string|null $format
     * @phpstan-param  array<mixed> $context
     * @return array|\ArrayObject|bool|float|int|mixed|string|null
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function normalize($data, string $format = null, array $context = []): mixed
    {
        $data = $this->normalizer->normalize($data, $format, $context);
        return $this->getNameFromUrl($data ?? '');
    }

    /**
     * @param mixed $data
     * @param string|null $format
     * @phpstan-param  array<mixed> $context
     * @return bool
     */
    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return (bool) filter_var($data, FILTER_VALIDATE_URL);
    }

    // format from repo github url to repo name https://github.com/{owner}/{repo} -> {owner}/{repo}
    private function getNameFromUrl(string $url): string
    {
        return array_slice(explode('/', $url), -2)[0];
    }
}