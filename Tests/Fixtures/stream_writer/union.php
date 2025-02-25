<?php

return static function (mixed $data, \Psr\Container\ContainerInterface $valueTransformers, array $options): \Traversable {
    if (\is_array($data)) {
        yield '[';
        $prefix = '';
        foreach ($data as $value) {
            yield $prefix;
            yield \json_encode($value->value);
            $prefix = ',';
        }
        yield ']';
    } elseif ($data instanceof \Symfony\Component\JsonStreamer\Tests\Fixtures\Model\DummyWithNameAttributes) {
        yield '{"@id":';
        yield \json_encode($data->id);
        yield ',"name":';
        yield \json_encode($data->name);
        yield '}';
    } elseif (\is_int($data)) {
        yield \json_encode($data);
    } else {
        throw new \Symfony\Component\JsonStreamer\Exception\UnexpectedValueException(\sprintf('Unexpected "%s" value.', \get_debug_type($data)));
    }
};
