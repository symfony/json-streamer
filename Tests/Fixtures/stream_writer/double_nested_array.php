<?php

return static function (mixed $data, \Psr\Container\ContainerInterface $valueTransformers, array $options): \Traversable {
    try {
        yield '[';
        $prefix = '';
        foreach ($data as $value1) {
            yield $prefix;
            yield '{"dummies":{';
            $prefix = '';
            foreach ($value1->dummies as $key2 => $value2) {
                $key2 = is_int($key2) ? $key2 : \substr(\json_encode($key2), 1, -1);
                yield "{$prefix}\"{$key2}\":";
                yield '{"dummies":{';
                $prefix = '';
                foreach ($value2->dummies as $key3 => $value3) {
                    $key3 = is_int($key3) ? $key3 : \substr(\json_encode($key3), 1, -1);
                    yield "{$prefix}\"{$key3}\":";
                    yield '{"id":';
                    yield \json_encode($value3->id, \JSON_THROW_ON_ERROR, 506);
                    yield ',"name":';
                    yield \json_encode($value3->name, \JSON_THROW_ON_ERROR, 506);
                    yield '}';
                    $prefix = ',';
                }
                yield '},"customProperty":';
                yield \json_encode($value2->customProperty, \JSON_THROW_ON_ERROR, 508);
                yield '}';
                $prefix = ',';
            }
            yield '},"stringProperty":';
            yield \json_encode($value1->stringProperty, \JSON_THROW_ON_ERROR, 510);
            yield '}';
            $prefix = ',';
        }
        yield ']';
    } catch (\JsonException $e) {
        throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException($e->getMessage(), 0, $e);
    }
};
