<?php

namespace PHPMinds\Unit\Transformer;

use PHPUnit\Framework\TestCase;
use App\Transformer\EventTransformer;

class EventTransformerTest extends TestCase
{
    /**
     * @test
     * @dataProvider emptySetDataProvider
     *
     * @param array|null $data
     */
    public function null_or_empty_data_return_empty_array(?array $data): void
    {
        $transformer = new EventTransformer();

        $this->assertSame([], $transformer->transform($data));
    }

    public function emptySetDataProvider(): array
    {
        return [
            [null],
            [[]],
        ];
    }
}
