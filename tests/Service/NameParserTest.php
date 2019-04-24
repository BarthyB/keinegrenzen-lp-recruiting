<?php

namespace App\Tests\Service;

use App\Service\NameParser;
use Exception;
use PHPUnit\Framework\TestCase;

class NameParserTest extends TestCase
{

    /**
     * @var \App\Service\NameParser
     */
    private $nameParser;

    protected function setUp(): void
    {
        $this->nameParser = new NameParser();
    }

    /**
     * @throws \Exception
     */
    public function testExceptions()
    {
        $this->expectException(Exception::class);

        $this->nameParser->getNameForRendering();
    }

    /**
     * @throws \Exception
     */
    public function testParseName()
    {
        $this->nameParser->parseName('Johnny');
        $this->assertEquals('Johnny', $this->nameParser->getNameForRendering());

        $this->nameParser->parseName('Johnny Be Good Or Even Better');
        $this->assertEquals('Johnny Be<br/>Good Or Even<br/>Better', $this->nameParser->getNameForRendering());
    }
}
