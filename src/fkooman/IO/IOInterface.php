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

interface IOInterface
{
    public function getTime();
    public function getRandom($byteLength = 16, $rawBytes = false);
    public function isFile($filePath);
    public function readFile($filePath);
    public function readFolder($folderPath, $fileFilter = '*');
    public function writeFile($filePath, $fileContent, $createParentDir = false, $dirMask = 0750);
    public function deleteFile($filePath);
}
