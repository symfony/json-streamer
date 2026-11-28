<?php

/**
 * @param Symfony\Component\JsonStreamer\Tests\Fixtures\Model\SelfReferencingDummyWithCollections $data
 */
return static function (mixed $data, \Psr\Container\ContainerInterface $transformers, array $options): \Traversable {
    $generators['Symfony\\Component\\JsonStreamer\\Tests\\Fixtures\\Model\\SelfReferencingDummyWithCollections'] = static function ($data, $depth, &$buffer) use ($transformers, $options, &$generators) {
        if ($depth >= 512) {
            throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
        }
        $buffer .= "{";
        $prefix1 = '';
        if (null === $data->self && ($options['include_null_properties'] ?? false)) {
            $buffer .= "{$prefix1}\"self\":null";
            $prefix1 = ',';
        }
        if (null !== $data->self) {
            $buffer .= "{$prefix1}\"self\":";
            yield from $generators['Symfony\\Component\\JsonStreamer\\Tests\\Fixtures\\Model\\SelfReferencingDummyWithCollections']($data->self, $depth + 1, $buffer);
            $prefix1 = ',';
        }
        $encoded = \json_encode($data->mixed, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE, \max(1, 511 - $depth));
        if ($depth >= 511 && ('[' === $encoded[0] || '{' === $encoded[0])) {
            throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
        }
        $buffer .= "{$prefix1}\"mixed\":".$encoded;
        unset($encoded);
        $encoded = \json_encode($data->otherMixed, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE, \max(1, 511 - $depth));
        if ($depth >= 511 && ('[' === $encoded[0] || '{' === $encoded[0])) {
            throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
        }
        $buffer .= ",\"otherMixed\":".$encoded;
        unset($encoded);
        if (null === $data->dict && ($options['include_null_properties'] ?? false)) {
            $buffer .= ",\"dict\":null";
        }
        if (null !== $data->dict) {
            $encoded = \json_encode(\array_is_list($dict = $data->dict) ? (object) $dict : $dict, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE, \max(1, 511 - $depth));
            if ($depth >= 511 && ('[' === $encoded[0] || '{' === $encoded[0])) {
                throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
            }
            $buffer .= ",\"dict\":".$encoded;
            unset($encoded);
        }
        if (null === $data->listOfDicts && ($options['include_null_properties'] ?? false)) {
            $buffer .= ",\"listOfDicts\":null";
        }
        if (null !== $data->listOfDicts) {
            if ($depth + 1 >= 512) {
                throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
            }
            $buffer .= ",\"listOfDicts\":[";
            $prefix2 = '';
            foreach ($data->listOfDicts as $value1) {
                $encoded = \json_encode($value1, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE | \JSON_FORCE_OBJECT, \max(1, 510 - $depth));
                if ($depth >= 510 && ('[' === $encoded[0] || '{' === $encoded[0])) {
                    throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
                }
                $buffer .= "{$prefix2}".$encoded;
                unset($encoded);
                $prefix2 = ',';
                if (\strlen($buffer) >= 8192) {
                    yield $buffer;
                    $buffer = '';
                }
            }
            $buffer .= "]";
        }
        if (null === $data->listsOfObjects && ($options['include_null_properties'] ?? false)) {
            $buffer .= ",\"listsOfObjects\":null";
        }
        if (null !== $data->listsOfObjects) {
            if ($depth + 1 >= 512) {
                throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
            }
            $buffer .= ",\"listsOfObjects\":[";
            $prefix2 = '';
            foreach ($data->listsOfObjects as $value1) {
                if ($depth + 2 >= 512) {
                    throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
                }
                $buffer .= "{$prefix2}[";
                $prefix3 = '';
                foreach ($value1 as $value2) {
                    if ($depth + 3 >= 512) {
                        throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Maximum stack depth exceeded');
                    }
                    $buffer .= "{$prefix3}{\"id\":".\json_encode($value2->id, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE, 508).",\"name\":".\json_encode($value2->name, \JSON_THROW_ON_ERROR | \JSON_PRESERVE_ZERO_FRACTION | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE, 508)."}";
                    $prefix3 = ',';
                    if (\strlen($buffer) >= 8192) {
                        yield $buffer;
                        $buffer = '';
                    }
                }
                $buffer .= "]";
                $prefix2 = ',';
                if (\strlen($buffer) >= 8192) {
                    yield $buffer;
                    $buffer = '';
                }
            }
            $buffer .= "]";
        }
        $buffer .= "}";
        if (\strlen($buffer) >= 8192) {
            yield $buffer;
            $buffer = '';
        }
    };
    try {
        $buffer = '';
        yield from $generators['Symfony\\Component\\JsonStreamer\\Tests\\Fixtures\\Model\\SelfReferencingDummyWithCollections']($data, 0, $buffer);
        if ('' !== $buffer) {
            yield $buffer;
        }
    } catch (\JsonException $e) {
        throw new \Symfony\Component\JsonStreamer\Exception\NotEncodableValueException('Cannot encode "Symfony\\Component\\JsonStreamer\\Tests\\Fixtures\\Model\\SelfReferencingDummyWithCollections" to JSON: '.$e->getMessage(), 0, $e);
    }
};
