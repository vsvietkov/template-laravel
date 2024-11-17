<?php

namespace Tests;

use Illuminate\Filesystem\Filesystem;

abstract class GraphQLConfigTestCase extends TestCase
{
    /**
     * Get an array of subdirectories from the root path. Including the root one.
     */
    protected function getDirectories(string $rootPath): array
    {
        $filesystem = new Filesystem();
        $directories = $filesystem->directories($rootPath);
        array_unshift($directories, $rootPath); // Add the root directory itself.
        return $directories;
    }

    /**
     * Get files which name ends on the specified suffix substring.
     */
    protected function getFilesWithSuffix(string $directory, string $suffix): array
    {
        return glob($directory . '/*' . $suffix . '.php');
    }

    protected function getAttributesFromFile(string $filePath): ?array
    {
        require_once $filePath;
        $className = $this->getClassNameFromFilePath($filePath);

        if (class_exists($className)) {
            $instance = new $className();
            if (method_exists($instance, 'getAttributes')) {
                return $instance->getAttributes();
            }
        }

        return null;
    }

    protected function getClassNameFromFilePath(string $filePath): string
    {
        $relativePath = str_replace([base_path() . '/', '.php'], '', $filePath);
        return str_replace('/', '\\', $relativePath);
    }
}
