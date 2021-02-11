# CHANGELOG

The Fcm library follows [SemVer](http://semver.org/).

## 2.x

Version `2.x` of this library is a full rewrite to be compliant with [HTTP v1 API](https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages). If
you are on Legacy HTTP API, then you should consider using version `1.x`

**Changelog** (since [`2.2.0`](https://github.com/ker0x/fcm/compare/2.2.0...2.3.0))

- 2.3.0 (2021-02)
    - Bump minimal PHP version to `7.3`
    - Bump Guzzle version to `7.2`
    - Bump PHPUnit version to `8.`
    - Update `.gitattributes`
    - Update CI workflow

**Changelog** (since [`2.1.0`](https://github.com/ker0x/fcm/compare/2.1.0...2.2.0))

- 2.2.0 (2020-10)
    - Add direct_book_ok parameter for Android configuration.
    - Change test namespace from `Tests\Kerox\Fcm` to `Kerox\Fcm\Tests`
    - Update PHPStan to `0.12`

**Changelog** (since [`2.0.0`](https://github.com/ker0x/fcm/compare/2.0.0...2.1.0))

- 2.1.0 (2020-01)
    - Change class properties visibility from `protected` to `private`.
    - Add new configurations classes
        * `Kerox\Fcm\Model\Message\Notification\AndroidNotification\Color::class`
        * `Kerox\Fcm\Model\Message\Notification\AndroidNotification\LightSettings::class`
        * `Kerox\Fcm\Model\Message\Notification\ApnsNotification\Sound::class`
    - Add new options classes
        * `Kerox\Fcm\Model\Message\Options\AndroidOptions::class`
        * `Kerox\Fcm\Model\Message\Options\ApnsOptions::class`
        * `Kerox\Fcm\Model\Message\Options\WebpushOptions::class`
    - `Kerox\Fcm\Model\Message\Notification\AndroidNotification::class`: add new properties
        * `$channelId`
        * `$ticker`
        * `$sticky`
        * `$eventTime`
        * `$localOnly`
        * `$notificationPriority`
        * `$defaultSound`
        * `$defaultVibrateTimings`
        * `$defaultLightSettings`
        * `$vibrateTimings`
        * `$visibility`
        * `$lightSettings`
        * `$image`
    - `Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert::class`: add new properties
        * `$subTitle`
        * `$subTitleLocKey`
        * `$subTitleLocArgs`
    - `Kerox\Fcm\Model\Message\Android::class`: add new property `$options`.
    - `Kerox\Fcm\Model\Message\Apns::class`: add new property `$options`.
    - Method `Kerox\Fcm\Model\Message\Webpush::setOptions()`, type `array` is deprecated, use class `Kerox\Fcm\Model\Message\Options\WebpushOptions::class`
      instead.
    - Method `Kerox\Fcm\Model\Message\AbstractNotification\Alert::setActionLocKey()` is deprecated and will be removed in 3.0 with no replacement.

**Changelog** (since [`1.0.1`](https://github.com/ker0x/fcm/compare/1.0.1...2.0.0))

- 2.0.0 (2018-09)
    - Rewrite library to be compatible with [HTTP v1 API](https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages)
    - Improve tests
    - Refactor code
    - Move documentation to the [Wiki](https://github.com/ker0x/fcm/wiki) section of the repo
