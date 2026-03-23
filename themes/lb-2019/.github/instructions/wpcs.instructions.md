---
applyTo: \*\*/\*.php
description: WordPress PHP Coding Standards (WPCS) for plugin and theme development
---

# WordPress Coding Standards (WPCS)

## General Principles

-   Write code assuming it will be validated with PHP_CodeSniffer
    (PHPCS) using the WordPress ruleset.
-   Prioritize: readability, compatibility, security, and consistency
    with WordPress core.
-   Do not follow PSR standards if they conflict with WPCS.

## PHP Syntax

-   Always use \<?php, never \<? or \<?=.
-   Avoid mixing HTML and PHP on the same line for complex structures.

``` php
if ( $condition ) :
    ?>
    <div></div>
    <?php
endif;
```

## Naming Conventions

-   Variables, functions, methods, and hooks:
    -   lowercase + snake_case
    -   no camelCase

``` php
$my_variable = 1;
function my_function_name() {}
```

-   Classes:
    -   PascalCase (underscores allowed)

``` php
class My_Class_Name {}
```

-   Files:
    -   lowercase + hyphens (class-my-class.php)
-   Constants:
    -   UPPERCASE + \_

## Indentation and Formatting
-   Use tabs, not spaces.
-   Required spacing:
    -   Inside parentheses: ( \$var )
    -   After commas
    -   Around operators

``` php
if ( $a === $b ) {
    $result = $a + $b;
}
```

## Strings
-   Use single quotes by default
-   Use double quotes only for interpolation

``` php
$name = 'John';
echo "Hello $name";
```

## Arrays
-   Use long syntax:
``` php
$array = array( 1, 2, 3 );
```
-   Do not use \[\]

## Control Structures

Yoda Conditions:

``` php
if ( true === $is_valid ) {}
if ( 10 === $count ) {}
```

elseif:

``` php
elseif ( $condition ) {}
```

## Functions and Classes

``` php
function my_function( $arg ) {}
class My_Class {}
public function my_method() {}
$object = new My_Class();
```

## Includes
``` php
require_once 'file.php';
include 'file.php';
```

## Hooks
``` php
do_action( "{$status}_{$type}" );
```

## Database
``` php
$wpdb->prepare( "SELECT * FROM table WHERE id = %d", $id );
```

## Security
-   esc_html()
-   esc_attr()
-   esc_url()
-   sanitize_text_field()
-   intval()

## Forbidden Code
-   eval()
-   create_function()
-   backticks
-   extract()

## Comments
``` php
/**
 * Short description.
 *
 * @param int $id User ID.
 * @return string
 */
```

## Additional Best Practices
-   One class per file
-   Avoid complex logic in templates
-   Do not assume strict typing
-   Minimize dependencies

## Line Length
-   80--120 characters

## Tooling
-   PHP_CodeSniffer (PHPCS)

## Copilot Rule
-   Generate code like WordPress core
-   Prefer compatibility over modern PHP
