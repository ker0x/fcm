# CHANGELOG

The Fcm library follows [SemVer](http://semver.org/).

## 2.x

Version `2.x` of this library is a full rewrite to be compliant with [HTTP v1 API](https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages). If you are on Legacy HTTP API, then you should consider using version `1.x`

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
    - Method `Kerox\Fcm\Model\Message\Webpush::setOptions()`, type `array` is deprecated, use class `Kerox\Fcm\Model\Message\Options\WebpushOptions::class` instead.
    - Method `Kerox\Fcm\Model\Message\AbstractNotification\Alert::setActionLocKey()` is deprecated and will be removed in 3.0 with no replacement.

- 2.0.0 (2018-09)
    - Rewrite library to be compatible with [HTTP v1 API](https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages)
    - Improve tests
    - Refactor code
    - Move documentation to the [Wiki](https://github.com/ker0x/fcm/wiki) section of the repo
