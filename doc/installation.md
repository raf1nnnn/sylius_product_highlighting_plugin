## Installation

1. Run `composer require dotit/sylius-highlighting-plugin --no-scripts`

2. Enable the plugin in bundles.php

```php
<?php
// config/bundles.php

return [
    // ...
    Dotit\SyliusStorePlugin\SyliusHighlightingPlugin::class => ['all' => true],
];
```

3. Import the plugin configurations

```yml
# config/packages/_sylius.yaml
imports:
    # ...
    - { resource: "@DotitSyliusHighlightingPlugin/Resources/config/config.yaml" }
```

4. Add the shop and admin routes

```yml
# config/routes.yaml
dotit_sylius_highlighting_plugin_admin:
    resource: "@DotitSyliusHighlightingPlugin/Resources/config/routing/admin.yaml"
    prefix: /admin


```


```php

5. Finish the installation updating the database schema and installing assets

```
php bin/console d:s:u -f

php bin/console sylius:theme:assets:install

php bin/console cache:clear
```
