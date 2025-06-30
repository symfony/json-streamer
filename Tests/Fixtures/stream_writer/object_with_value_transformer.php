<?php

/**
 * @param Symfony\Component\JsonStreamer\Tests\Fixtures\Model\DummyWithValueTransformerAttributes $data
 */
return static function (mixed $data, \Psr\Container\ContainerInterface $valueTransformers, array $options): \Traversable {
    try {
        yield '{"id":';
        yield \json_encode($valueTransformers->get('Symfony\Component\JsonStreamer\Tests\Fixtures\ValueTransformer\DoubleIntAndCastToStringValueTransformer')->transform($data->id, ['_current_object' => $data] + $options), \JSON_THROW_ON_ERROR, 511);
        yield ',"active":';
        yield \json_encode($valueTransformers->get('Symfony\Component\JsonStreamer\Tests\Fixtures\ValueTransformer\BooleanToStringValueTransformer')->transform($data->active, ['_current_object' => $data] + $options), \JSON_THROW_ON_ERROR, 511);
        yield ',"name":';
        yield \json_encode(strtolower($data->name), \JSON_THROW_ON_ERROR, 511);
        yield ',"range":';
        yield \json_encode(Symfony\Component\JsonStreamer\Tests\Fixtures\Model\DummyWithValueTransformerAttributes::concatRange($data->range, ['_current_object' => $data] + $options), \JSON_THROW_ON_ERROR, 511);
        yield '}';
    } catch (\JsonException $e) {
        throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException($e->getMessage(), 0, $e);
    }
};
