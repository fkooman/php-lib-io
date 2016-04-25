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
        $io = new IO();
        $length = 16;
        $this->assertSame(2 * $length, strlen($io->getRandom($length)));
        $this->assertSame($length, strlen($io->getRandom($length, true)));
    }

    public function testGetTime()
    {
        $io = new IO();
        $unixTime = $io->getTime();
        $this->assertSame('integer', gettype($unixTime));
        $this->assertGreaterThan(0, $unixTime);
    }

    public function testReadFile()
    {
        $io = new IO();
        $fileContent = $io->readFile(__DIR__.'/data/file.txt');
        $this->assertSame('Hello World', $fileContent);
    }

    public function testIsFile()
    {
        $io = new IO();
        $this->assertTrue($io->isFile('/etc/passwd'));
        $this->assertFalse($io->isFile('/'));
        $this->assertTrue($io->isFile(__DIR__.'/data/file.txt'));
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage unable to read file
     */
    public function testReadMissingFile()
    {
        $io = new IO();
        $fileContent = $io->readFile(__DIR__.'/data/missing_file.txt');
    }

    public function testReadFolder()
    {
        $io = new IO();
        $folderPath = __DIR__.'/data/';
        $fileList = $io->readFolder($folderPath, '*', false);
        $this->assertSame(
            [
                'bar',
                'baz',
                'directory/',
                'file.txt',
                'foo',
            ],
            $fileList
        );
    }

    public function testReadFolderFullPath()
    {
        $io = new IO();
        $folderPath = __DIR__.'/data/';
        $fileList = $io->readFolder($folderPath, '*', true);
        $this->assertSame(
            [
                $folderPath.'bar',
                $folderPath.'baz',
                $folderPath.'directory/',
                $folderPath.'file.txt',
                $folderPath.'foo',
            ],
            $fileList
        );
    }

    public function testReadFolderCustomPattern()
    {
        $io = new IO();
        $folderPath = __DIR__.'/data/';
        $fileList = $io->readFolder($folderPath, '*.txt', false);
        $this->assertSame(
            [
                'file.txt',
            ],
            $fileList
        );
    }

    public function testReadFolderCustomPatternNonTrailingSlash()
    {
        $io = new IO();
        $folderPath = __DIR__.'/data';
        $fileList = $io->readFolder($folderPath, '*.txt', false);
        $this->assertSame(
            [
                'file.txt',
            ],
            $fileList
        );
    }

    public function testReadNonExistingFolder()
    {
        $io = new IO();
        $folderPath = __DIR__.'/non_existing_data/';
        $fileList = $io->readFolder($folderPath);
        $this->assertSame(
            [
            ],
            $fileList
        );
    }

    public function testReadRootFolder()
    {
        $io = new IO();
        $folderPath = '/root/';
        $fileList = $io->readFolder($folderPath);
        $this->assertSame(
            [
            ],
            $fileList
        );
    }

    public function testWriteFile()
    {
        $io = new IO();
        $this->assertNull($io->writeFile('/dev/null', 'Hello World'));
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage unable to write file
     */
    public function testWriteNotAllowedFile()
    {
        $io = new IO();
        $io->writeFile('/tmp/tmp/tmp/tmp', 'Hello World');
    }
}
