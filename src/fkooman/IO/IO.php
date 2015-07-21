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

use RuntimeException;

class IO
{
    /**
     * Get the current time as a unix timestamp.
     *
     * @return int the current time as a unix timestamp
     */
    public function getTime()
    {
        return time();
    }

    /**
     * Get a random byte string.
     *
     * @param int  $byteLength the length of the random string in bytes
     * @param bool $rawBytes   return the random string hex encoded
     *
     * @return string the random string of specified length
     */
    public function getRandom($byteLength = 16, $rawBytes = false)
    {
        $strong = false;
        $randomBytes = openssl_random_pseudo_bytes($byteLength, $strong);
        if (false === $strong) {
            throw new RuntimeException('unable to generate secure random number');
        }

        if ($rawBytes) {
            return $randomBytes;
        }

        return bin2hex($randomBytes);
    }

    /**
     * Read a file from the file system.
     *
     * @param string $filePath the path of the file to read
     *
     * @return string the file contents
     *
     * @throws RuntimeException if the file could not be read
     */
    public function readFile($filePath)
    {
        if (false === $fileContent = @file_get_contents($filePath)) {
            throw new RuntimeException(
                sprintf('unable to read file "%s"', htmlentities($filePath, ENT_QUOTES, 'UTF-8'))
            );
        }

        return $fileContent;
    }

    /**
     * Write a file to the file system.
     *
     * @param string $filePath    the path of the file to write
     * @param string $fileContent the content to be written to the file
     *
     * @throws RuntimeException if the file could not be written
     */
    public function writeFile($filePath, $fileContent)
    {
        if (false === @file_put_contents($filePath, $fileContent)) {
            throw new RuntimeException(
                sprintf('unable to write file "%s"', htmlentities($filePath, ENT_QUOTES, 'UTF-8'))
            );
        }
    }
}
