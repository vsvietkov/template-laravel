<?php

namespace Tests\Unit\GraphQL\Types;

use Tests\GraphQLConfigTestCase;

class TypesConfigTest extends GraphQLConfigTestCase
{
    private const string ROOT_DIRECTORY = 'GraphQL/Types';

    public function testTypesRequiredAttributesArePresentAndCorrect(): void
    {
        $directories = $this->getDirectories(app_path(self::ROOT_DIRECTORY));

        foreach ($directories as $directory) {
            $files = $this->getFilesWithSuffix($directory, 'Type');
            $names = [];

            foreach ($files as $file) {
                $attributes = $this->getAttributesFromFile($file);
                $this->assertNotEmpty($attributes, "Attributes should not be empty in file: {$file}");

                // Check name is present and unique in current directory.
                $this->assertArrayHasKey('name', $attributes, "'name' attribute is missing in file: {$file}");
                $name = $attributes['name'];
                $this->assertNotContains($name, $names, "Duplicate 'name' attribute found: {$name} in file: {$file}");
                $names[] = $name;

                // Check model is present.
                $this->assertArrayHasKey('model', $attributes, "'model' attribute is missing in file: {$file}");
            }
        }
    }
}
