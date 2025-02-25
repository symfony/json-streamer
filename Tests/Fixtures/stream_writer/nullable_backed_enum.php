<?php

return static function (mixed $data, \Psr\Container\ContainerInterface $valueTransformers, array $options): \Traversable {
    if ($data instanceof \Symfony\Component\JsonStreamer\Tests\Fixtures\Enum\DummyBackedEnum) {
        yield \json_encode($data->value);
    } elseif (null === $data) {
        yield 'null';
    } else {
        throw new \Symfony\Component\JsonStreamer\Exception\UnexpectedValueException(\sprintf('Unexpected "%s" value.', \get_debug_type($data)));
    }
};
