<?php

namespace Pravaler\MonologGCloudDecorator;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\JsonFormatter;

class GCloudJsonFormatterDecorator implements FormatterInterface
{
    private JsonFormatter $_jsonFormatter;

    public function __construct(
        JsonFormatter $jsonFormatter
    ) {
        $this->_jsonFormatter = $jsonFormatter;
    }

    public function format(array $record): string
    {
        if (isset($record["level_name"])) {
            $record["severity"] = $record["level_name"];
            unset($record["level_name"]);
            unset($record["level"]);
        }
        return $this->_jsonFormatter->format($record);
    }

    public function formatBatch(array $records)
    {
        $this->jsonFormatter->formatBatch($records);
    }
}
