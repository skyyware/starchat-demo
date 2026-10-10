# Install the demo

Use PHP 8.4 or newer with mbstring, PDO and SQLite FTS5, plus Composer. The
Starchat core is a private repository. Obtain authorized access separately and
supply Composer authentication through your protected environment or existing
user-level setup. Never commit auth.json, tokens or vendor/. The public demo
does not grant access to its dependency.

Run `composer install`, `composer check` and `vendor/bin/starchat index`.
The committed lock selects tested package versions. Configure HTTPS with
`public/` as the document root and route unknown paths to `public/index.php`.
Every request must match an explicit host in `installation.json`.

Set `STARCHAT_RUNTIME` to a private writable directory outside the web root.
Configure `STARCHAT_CODEX_BINARY`, `STARCHAT_CODEX_HOME` and
`STARCHAT_CODEX_WORK` for your approved connector. Keep authentication and
account controls outside the application. Provider access is not created by
installing this project. The full public setup guide is on
[stage.dev](https://stage.dev/resources/starchat-installation).

For an independent installation, replace the identity, hosts, scope, navigation,
interface copy, knowledge and legal texts. Remove the Stage-specific history
migration and use a new history key. Choose your own assets or explicitly
configure a trusted design origin. See [shared branding](design.md).
