<?php

return static function (mixed $data, \Psr\Container\ContainerInterface $valueTransformers, array $options): \Traversable {
    try {
        yield '[';
        $prefix = '';
        foreach ($data as $value1) {
            yield $prefix;
            yield '{"dummies":[';
            $prefix = '';
            foreach ($value1->dummies as $value2) {
                yield $prefix;
                yield '{"dummies":[';
                $prefix = '';
                foreach ($value2->dummies as $value3) {
                    yield $prefix;
                    yield '{"id":';
                    yield \json_encode($value3->id, \JSON_THROW_ON_ERROR, 506);
                    yield ',"name":';
                    yield \json_encode($value3->name, \JSON_THROW_ON_ERROR, 506);
                    yield '}';
                    $prefix = ',';
                }
                yield '],"customProperty":';
                yield \json_encode($value2->customProperty, \JSON_THROW_ON_ERROR, 508);
                yield '}';
                $prefix = ',';
            }
            yield '],"stringProperty":';
            yield \json_encode($value1->stringProperty, \JSON_THROW_ON_ERROR, 510);
            yield '}';
            $prefix = ',';
        }
        yield ']';
    } catch (\JsonException $e) {
        throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException($e->getMessage(), 0, $e);
    }
};
