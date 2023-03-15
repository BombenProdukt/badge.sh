# Badger

This project is a port of the popular [badgen/badgen.net](https://github.com/badgen/badgen.net) project by [amio](https://github.com/amio). The goal of this project is to reach feature parity with the original project and expand on it, but with a few differences:

- Use [Laravel](https://laravel.com) as the framework
- Use [Tailwind CSS](https://tailwindcss.com) for styling
- Use [Inertia](https://inertiajs.com) for the frontend
- Leverage the Laravel ecosystem to provide a more robust and streamlined development process

## Installation

We recommend deploying the project using [Laravel Forge](https://forge.laravel.com). Usage outside of Laravel Forge is the same as any other Laravel project.

## Usage

Check [badger.preem.studio](https://badger.preem.studio) for a list of all available badges. **We accept pull requests for new badges, so if you don't see one you need, feel free to add it!**

## Roadmap

This project is very much a work in progress. Here is a list of features we plan to implement:

- [ ] [elm-package](https://github.com/badgen/badgen.net/blob/master/api/elm-package.ts)
- [ ] [amo](https://github.com/badgen/badgen.net/blob/master/api/amo.ts)
- [ ] [apm](https://github.com/badgen/badgen.net/blob/master/api/apm.ts)
- [ ] [appveyor](https://github.com/badgen/badgen.net/blob/master/api/appveyor.ts)
- [ ] [azure-pipelines](https://github.com/badgen/badgen.net/blob/master/api/azure-pipelines.ts)
- [x] [badge](https://github.com/badgen/badgen.net/blob/master/api/badge.ts)
- [ ] [badgesize](https://github.com/badgen/badgen.net/blob/master/api/badgesize.ts)
- [x] [bundlephobia](https://github.com/badgen/badgen.net/blob/master/api/bundlephobia.ts)
- [ ] [chrome-web-store](https://github.com/badgen/badgen.net/blob/master/api/chrome-web-store.ts)
- [x] [circleci](https://github.com/badgen/badgen.net/blob/master/api/circleci.ts)
- [x] [cocoapods](https://github.com/badgen/badgen.net/blob/master/api/cocoapods.ts)
- [x] [codacy](https://github.com/badgen/badgen.net/blob/master/api/codacy.ts)
- [ ] [codeclimate](https://github.com/badgen/badgen.net/blob/master/api/codeclimate.ts)
- [x] [codecov](https://github.com/badgen/badgen.net/blob/master/api/codecov.ts)
- [x] [coveralls](https://github.com/badgen/badgen.net/blob/master/api/coveralls.ts)
- [ ] [cpan](https://github.com/badgen/badgen.net/blob/master/api/cpan.ts)
- [ ] [cran](https://github.com/badgen/badgen.net/blob/master/api/cran.ts)
- [x] [crates](https://github.com/badgen/badgen.net/blob/master/api/crates.ts)
- [ ] [ctan](https://github.com/badgen/badgen.net/blob/master/api/ctan.ts)
- [ ] [david](https://github.com/badgen/badgen.net/blob/master/api/david.ts)
- [ ] [deepscan](https://github.com/badgen/badgen.net/blob/master/api/deepscan.ts)
- [x] [dependabot](https://github.com/badgen/badgen.net/blob/master/api/dependabot.ts)
- [ ] [devrant](https://github.com/badgen/badgen.net/blob/master/api/devrant.ts)
- [ ] [discord](https://github.com/badgen/badgen.net/blob/master/api/discord.ts)
- [ ] [docker](https://github.com/badgen/badgen.net/blob/master/api/docker.ts)
- [ ] [dub](https://github.com/badgen/badgen.net/blob/master/api/dub.ts)
- [x] [f-droid](https://github.com/badgen/badgen.net/blob/master/api/f-droid.ts)
- [x] [github](https://github.com/badgen/badgen.net/blob/master/api/github.ts)
- [ ] [gitlab](https://github.com/badgen/badgen.net/blob/master/api/gitlab.ts)
- [ ] [gitter](https://github.com/badgen/badgen.net/blob/master/api/gitter.ts)
- [ ] [hackage](https://github.com/badgen/badgen.net/blob/master/api/hackage.ts)
- [ ] [haxelib](https://github.com/badgen/badgen.net/blob/master/api/haxelib.ts)
- [ ] [homebrew](https://github.com/badgen/badgen.net/blob/master/api/homebrew.ts)
- [ ] [https](https://github.com/badgen/badgen.net/blob/master/api/https.ts)
- [ ] [jenkins](https://github.com/badgen/badgen.net/blob/master/api/jenkins.ts)
- [x] [jsdelivr](https://github.com/badgen/badgen.net/blob/master/api/jsdelivr.ts)
- [ ] [keybase](https://github.com/badgen/badgen.net/blob/master/api/keybase.ts)
- [ ] [lgtm](https://github.com/badgen/badgen.net/blob/master/api/lgtm.ts)
- [ ] [liberapay](https://github.com/badgen/badgen.net/blob/master/api/liberapay.ts)
- [ ] [mastodon](https://github.com/badgen/badgen.net/blob/master/api/mastodon.ts)
- [ ] [matrix](https://github.com/badgen/badgen.net/blob/master/api/matrix.ts)
- [ ] [maven](https://github.com/badgen/badgen.net/blob/master/api/maven.ts)
- [ ] [melpa](https://github.com/badgen/badgen.net/blob/master/api/melpa.ts)
- [ ] [memo](https://github.com/badgen/badgen.net/blob/master/api/memo.ts)
- [ ] [npm](https://github.com/badgen/badgen.net/blob/master/api/npm.ts)
- [x] [nuget](https://github.com/badgen/badgen.net/blob/master/api/nuget.ts)
- [x] [opam](https://github.com/badgen/badgen.net/blob/master/api/opam.ts)
- [ ] [open-vsx](https://github.com/badgen/badgen.net/blob/master/api/open-vsx.ts)
- [ ] [opencollective](https://github.com/badgen/badgen.net/blob/master/api/opencollective.ts)
- [x] [packagephobia](https://github.com/badgen/badgen.net/blob/master/api/packagephobia.ts)
- [x] [packagist](https://github.com/badgen/badgen.net/blob/master/api/packagist.ts)
- [ ] [peertube](https://github.com/badgen/badgen.net/blob/master/api/peertube.ts)
- [ ] [pub](https://github.com/badgen/badgen.net/blob/master/api/pub.ts)
- [ ] [pypi](https://github.com/badgen/badgen.net/blob/master/api/pypi.ts)
- [x] [reddit](https://github.com/badgen/badgen.net/blob/master/api/reddit.ts)
- [ ] [rubygems](https://github.com/badgen/badgen.net/blob/master/api/rubygems.ts)
- [ ] [runkit](https://github.com/badgen/badgen.net/blob/master/api/runkit.ts)
- [ ] [scoop](https://github.com/badgen/badgen.net/blob/master/api/scoop.ts)
- [ ] [shards](https://github.com/badgen/badgen.net/blob/master/api/shards.ts)
- [ ] [snapcraft](https://github.com/badgen/badgen.net/blob/master/api/snapcraft.ts)
- [x] [snyk](https://github.com/badgen/badgen.net/blob/master/api/snyk.ts)
- [x] [tidelift](https://github.com/badgen/badgen.net/blob/master/api/tidelift.ts)
- [ ] [travis](https://github.com/badgen/badgen.net/blob/master/api/travis.ts)
- [ ] [twitter](https://github.com/badgen/badgen.net/blob/master/api/twitter.ts)
- [ ] [uptime-robot](https://github.com/badgen/badgen.net/blob/master/api/uptime-robot.ts)
- [ ] [vs-marketplace](https://github.com/badgen/badgen.net/blob/master/api/vs-marketplace.ts)
- [ ] [wapm](https://github.com/badgen/badgen.net/blob/master/api/wapm.ts)
- [ ] [winget](https://github.com/badgen/badgen.net/blob/master/api/winget.ts)
- [x] [xo](https://github.com/badgen/badgen.net/blob/master/api/xo.ts)

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
