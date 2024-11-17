<?php

namespace App\GraphQL\Schemas;

use Illuminate\Support\Str;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

abstract class Base implements ConfigConvertible
{
    /**
     * Load queries from the app/GraphQL/Queries subfolders
     */
    protected function loadQueries(): array
    {
        return $this->loadClasses('Queries', '*Query.php');
    }

    /**
     * Load mutations from the app/GraphQL/Mutations subfolders
     */
    protected function loadMutations(): array
    {
        return $this->loadClasses('Mutations', '*Mutation.php');
    }

    /**
     * Load types from the app/GraphQL/Types subfolders
     */
    protected function loadTypes(): array
    {
        return $this->loadClasses('Types', '*Type.php');
    }

    private function loadClasses(string $folder, string $fileNamePattern): array
    {
        // $schemaName - From "DefaultSchema" to "Default"
        $schemaName = Str::replaceLast('Schema', '', class_basename(static::class));
        $classNamespace = $folder . '\\' . $schemaName;
        $classDirectory = $folder . '/' . $schemaName;

        return array_map(
            fn ($file) => 'App\\GraphQL\\' . $classNamespace . '\\' . pathinfo($file, PATHINFO_FILENAME),
            glob(app_path('GraphQL/' . $classDirectory . '/' . $fileNamePattern))
        );
    }
}
