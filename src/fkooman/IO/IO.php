<?php

/**
 * Copyright 2016 François Kooman <fkooman@tuxed.net>.
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

class IO implements IOInterface
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
     * @param bool $rawBytes   return the raw random string if true or hex
     *                         encoded when false (default)
     *
     * @return string the random string of specified length
     */
    public function getRandom($byteLength = 16, $rawBytes = false)
    {
        $randomBytes = random_bytes($byteLength);

        if ($rawBytes) {
            return $randomBytes;
        }

        return bin2hex($randomBytes);
    }

    public function isFile($filePath)
    {
        return @file_exists($filePath) && @is_file($filePath);
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
                sprintf('unable to read file "%s"', $filePath)
            );
        }

        return $fileContent;
    }

    /**
     * Read a folder and return a list of files in that folder.
     *
     * @param string $folderPath the path to the folder
     * @param string $fileFilter the filter to apply, defaults to '*'
     *
     * @return array an array of files and directories in the folder requested,
     *               entries ending in a '/' are folders. If a directory does not exist, is
     *               empty or no there is no permission to read it an empty array is returned.
     */
    public function readFolder($folderPath, $fileFilter = '*')
    {
        // make sure folderPath ends with '/'
        if ('/' !== substr($folderPath, -1)) {
            $folderPath .= '/';
        }
        $searchPattern = $folderPath.$fileFilter;
        $fileList = @glob($searchPattern, GLOB_MARK | GLOB_ERR);
        if (false === $fileList) {
            return [];
        }

        return $fileList;
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
                sprintf('unable to write file "%s"', $filePath)
            );
        }
    }
}
