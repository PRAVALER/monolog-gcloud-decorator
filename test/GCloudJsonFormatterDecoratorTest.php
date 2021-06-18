<?php

namespace MonologGCloudDecorator\Test;

use Monolog\Logger;
use Monolog\Formatter\JsonFormatter;
use Pravaler\MonologGCloudDecorator\GCloudJsonFormatterDecorator;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;


final class GCloudJsonFormatterDecoratorTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_format_records_as_expected()
    {
        $decorator = new GCloudJsonFormatterDecorator(new JsonFormatter());
        $record = $this->getRecord();

        $expectedFormat = $this->getFormattedRecord($record);

        self::assertEquals(
            json_encode($expectedFormat) . "\n",
            $decorator->format($record)
        );
    }

    protected function getRecord($level = Logger::WARNING, $message = 'my warning message')
    {
        return [
            'message' => $message,
            'level' => $level,
            'level_name' => Logger::getLevelName($level),
            'channel' => 'test',
        ];
    }

    protected function getFormattedRecord(array $record)
    {
        return array_merge([
            'message' => 'my warning message',
            'channel' => 'test',
            'severity' => Logger::getLevelName(Logger::WARNING),
        ]);
    }
}