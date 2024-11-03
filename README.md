### SET UP

1. `make env`
2. `make build`
3. `make start`
4. `make generate-key`
5. `make composer-install`
6. `make migrate`
7. `make seed`

Now you can access the project at `http://localhost`

**For non-local environment, do not forget to cache config** via `make config-cache` in order to load graphql schemas
content only once and not on every request.

### GraphQL

Default schema is accessible at `http://localhost/graphql`

To create a new schema, create a new schema file in `app/GraphQL/Schemas`. It will be automatically loaded
(see 'config/graphql.php' file's 'schemas' element). For example, you create "AdminSchema" class and your schema will
be accessible at `http://localhost/graphql/admin`.

**Types under 'app/GraphQL/Types' directory are automatically loaded** to be global. Create a subdirectory with the name of
a schema (without "Schema" suffix) to make the type available only in that schema (for example, you have "AdminSchema"
class, so you create an "Admin" directory in 'app/GraphQL/Types' and put your types there).

For queries and mutations you need to **always** create subdirectories.
