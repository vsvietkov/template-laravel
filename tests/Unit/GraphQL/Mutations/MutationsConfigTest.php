<?php

namespace Tests\Unit\GraphQL\Mutations;

use Tests\GraphQLConfigTestCase;

class MutationsConfigTest extends GraphQLConfigTestCase
{
    private const string ROOT_DIRECTORY = 'GraphQL/Mutations';

    public function testMutationsRequiredAttributesArePresentAndCorrect(): void
    {
        $directories = $this->getDirectories(app_path(self::ROOT_DIRECTORY));

        foreach ($directories as $directory) {
            $files = $this->getFilesWithSuffix($directory, 'Mutation');
            $names = [];

            foreach ($files as $file) {
                $attributes = $this->getAttributesFromFile($file);
                $this->assertNotEmpty($attributes, "Attributes should not be empty in file: {$file}");

                // Check name is present and unique in current directory.
                $this->assertArrayHasKey('name', $attributes, "'name' attribute is missing in file: {$file}");
                $name = $attributes['name'];
                $this->assertNotContains($name, $names, "Duplicate 'name' attribute found: {$name} in file: {$file}");
                $names[] = $name;
            }
        }
    }
}
