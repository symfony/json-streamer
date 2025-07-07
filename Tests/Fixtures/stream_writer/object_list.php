<?php

/**
 * @param array<int,Symfony\Component\JsonStreamer\Tests\Fixtures\Model\DummyWithNameAttributes> $data
 */
return static function (mixed $data, \Psr\Container\ContainerInterface $valueTransformers, array $options): \Traversable {
    try {
        yield '[';
        $prefix = '';
        foreach ($data as $value1) {
            yield $prefix;
            yield '{"@id":';
            yield \json_encode($value1->id, \JSON_THROW_ON_ERROR, 510);
            yield ',"name":';
            yield \json_encode($value1->name, \JSON_THROW_ON_ERROR, 510);
            yield '}';
            $prefix = ',';
        }
        yield ']';
    } catch (\JsonException $e) {
        throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException($e->getMessage(), 0, $e);
    }
};
