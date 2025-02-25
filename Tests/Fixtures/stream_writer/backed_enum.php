<?php

return static function (mixed $data, \Psr\Container\ContainerInterface $valueTransformers, array $options): \Traversable {
    yield \json_encode($data->value);
};
