# API Forméact

![Forméact](screenshot.png)

## [WordPress Coding standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards)

**Step 1:** Run `make create_project` to install `wp-coding-standards/wpcs`.

**Step 2:** Run `composer config-set` to set path for `wpcs`.

You are now able to lint PHP files using WordPress Coding standards, for example with `functions.php`:

```bash
composer lint functions.php
```
