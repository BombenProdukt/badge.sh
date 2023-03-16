# Badger

This project is a port of the popular [badgen/badgen.net](https://github.com/badgen/badgen.net) project by [amio](https://github.com/amio). The goal of this project is to reach feature parity with the original project and expand on it, but with a few differences:

- Use [Laravel](https://laravel.com) as the framework
- Use [Tailwind CSS](https://tailwindcss.com) for styling
- Use [Inertia](https://inertiajs.com) for the frontend
- Standardized development process by leveraging the Laravel ecosystem
- Standardized API to be more consistent and predictable
- Standardized color palette to be more consistent and predictable
- Standardized test suite to ensure functionality of all components

## Installation

We recommend deploying the project using [Laravel Forge](https://forge.laravel.com). Usage outside of Laravel Forge is the same as any other Laravel project.

## Usage

Check [badger.preem.studio](https://badger.preem.studio) for a list of all available badges. **We accept pull requests for new badges, so if you don't see one you need, feel free to add it!**

## Roadmap

This project is very much a work in progress. Here is a list of features we plan to implement:

- [ ] [apm](https://github.com/badgen/badgen.net/blob/master/api/apm.ts)
- [ ] [azure-pipelines](https://github.com/badgen/badgen.net/blob/master/api/azure-pipelines.ts)
- [ ] [gitlab](https://github.com/badgen/badgen.net/blob/master/api/gitlab.ts)
- [ ] [haxelib](https://github.com/badgen/badgen.net/blob/master/api/haxelib.ts)
- [ ] [jenkins](https://github.com/badgen/badgen.net/blob/master/api/jenkins.ts)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

If you've found a bug regarding security please mail [security@preem.studio](mailto:security@preem.studio) instead of using the issue tracker.

## Credits

- [Preem Studio](https://github.com/PreemStudio)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
