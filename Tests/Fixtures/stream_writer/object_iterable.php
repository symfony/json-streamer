<?php

/**
 * @param iterable<int|string,Symfony\Component\JsonStreamer\Tests\Fixtures\Model\ClassicDummy> $data
 */
return static function (mixed $data, \Psr\Container\ContainerInterface $valueTransformers, array $options): \Traversable {
    try {
        yield '{';
        $prefix = '';
        foreach ($data as $key1 => $value1) {
            $key1 = is_int($key1) ? $key1 : \substr(\json_encode($key1), 1, -1);
            yield "{$prefix}\"{$key1}\":";
            yield '{"id":';
            yield \json_encode($value1->id, \JSON_THROW_ON_ERROR, 510);
            yield ',"name":';
            yield \json_encode($value1->name, \JSON_THROW_ON_ERROR, 510);
            yield '}';
            $prefix = ',';
        }
        yield '}';
    } catch (\JsonException $e) {
        throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException($e->getMessage(), 0, $e);
    }
};
