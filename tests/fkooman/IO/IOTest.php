<?php

/**
 * Copyright 2015 François Kooman <fkooman@tuxed.net>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace fkooman\IO;

use PHPUnit_Framework_TestCase;

class IOTest extends PHPUnit_Framework_TestCase
{
    public function testGetRandom()
    {
        $randomStr = IO::getRandom(16);
        $this->assertSame(16, strlen($randomStr));
    }

    public function testGetTime()
    {
        $unixTime = IO::getTime();
        $this->assertSame('integer', gettype($unixTime));
        $this->assertGreaterThan(0, $unixTime);
    }

    public function testReadFile()
    {
        $fileContent = IO::readFile(__DIR__.'/data/file.txt');
        $this->assertSame('Hello World', $fileContent);
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage unable to read file
     */
    public function testReadMissingFile()
    {
        $fileContent = IO::readFile(__DIR__.'/data/missing_file.txt');
    }

    public function testWriteFile()
    {
        $this->assertNull(IO::writeFile('/dev/null', 'Hello World'));
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage unable to write file
     */
    public function testWriteNotAllowedFile()
    {
        IO::writeFile('/tmp/tmp/tmp/tmp', 'Hello World');
    }
}
