<?php

declare(strict_types=1);

namespace Kerox\Fcm\Api;

use Fig\Http\Message\RequestMethodInterface;
use Http\Discovery\Psr18Client;
use Kerox\Fcm\Fcm;
use Kerox\Fcm\Model\Message;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class Send
{
    private SerializerInterface $serializer;

    public function __construct(
        private string $oauthToken,
        private string $projectId,
        private Psr18Client $client
    ) {
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory, new CamelCaseToSnakeCaseNameConverter());

        $this->serializer = new Serializer(
            [
                new BackedEnumNormalizer(),
                new ObjectNormalizer(nameConverter: $metadataAwareNameConverter),
            ],
            [
                new JsonEncoder(),
            ]
        );
    }

    public function message(Message $message, bool $validateOnly = false): ResponseInterface
    {
        $content = new class($message, $validateOnly) {
            public function __construct(
                public Message $message,
                public bool $validateOnly,
            ) {
            }
        };

        $body = $this->client->createStream($this->serializer->serialize($content, 'json', [AbstractObjectNormalizer::SKIP_NULL_VALUES => true]));
        $uri = $this->client->createUri(sprintf('%s/%s/projects/%s/messages:send', Fcm::API_URL, Fcm::API_VERSION, $this->projectId));
        $request = $this->client->createRequest(RequestMethodInterface::METHOD_POST, $uri)
            ->withBody($body)
            ->withHeader('Authorization', sprintf('Bearer %s', $this->oauthToken))
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json')
        ;

        return $this->client->sendRequest($request);
    }
}
