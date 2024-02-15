# CHANGELOG

The Fcm library follows [SemVer](http://semver.org/).

## 3.x

> [!NOTE]
> Version `3.x` of this library is a full rewrite using [PSR-18 HTTP Client](https://www.php-fig.org/psr/psr-18/) interface,
> which means that **no** HTTP Client, like [Guzzle](https://github.com/guzzle/guzzle) or [httplug](https://github.com/php-http/httplug),
> are provided within. If you already have one in your project, the package will **automatically discover it** and use it.
> Otherwise You will need to require one separately.

### 3.2

> [!WARNING]
> Version `3.2` introduce a BC break.
> The signature of the `__construct()` method of the `Kerox\Fcm\Model\Message` class has changed, with the `$notification` parameter becoming the third argument and being optional.

```diff
final class Message
{
-   public Notification $notification;
+   public ?Notification $notification = null;
    public ?string $token = null;
    public ?string $topic = null;
    public ?string $condition = null;

    /**
     * @param array<string, string> $data
     */
    public function __construct(
-       Notification|string $notification,
        Token|Topic|Condition $target,
        public array $data = [],
+       Notification|string|null $notification = null,
        public ?AndroidConfig $android = null,
        public ?WebpushConfig $webpush = null,
        public ?ApnsConfig $apns = null,
        public ?FcmOptions $fcmOptions = null,
    ) {
 +      if (null !== $notification) {
            $this->notification = \is_string($notification)
                ? new Notification($notification)
                : $notification
            ;
+       }

        match (true) {
            $target instanceof Token => $this->token = $target->__toString(),
            $target instanceof Topic => $this->topic = $target->__toString(),
            $target instanceof Condition => $this->condition = $target->__toString(),
        };
    }
}
```
#### Before

````php
$message = new Message(
    notification: 'Breaking News',
    target: new Topic('TopicA'),
    data: [
        'story_id' => 'story_12345',
    ],
);
````

#### After

````php
$message = new Message(
    target: new Topic('TopicA'),
    data: [
        'story_id' => 'story_12345',
    ],
    notification: 'Breaking News',
);
````

### 3.1

#### What's Changed
* :bug: Fix README by @ker0x in https://github.com/ker0x/fcm/pull/23 and https://github.com/ker0x/fcm/pull/25
* :bug: Fix .gitattributes by @ker0x in https://github.com/ker0x/fcm/pull/24
* :arrow_up: Bump Symfony components to `6.4`, allow Symfony 7 by @ker0x in https://github.com/ker0x/fcm/pull/25
* :green_heart: Update CI workflow by @ker0x in https://github.com/ker0x/fcm/pull/25
* :rotating_light: Fix PHP-CS-Fixer and PHPStan warning  by @ker0x in https://github.com/ker0x/fcm/pull/25

**Full Changelog**: https://github.com/ker0x/fcm/compare/3.0.0...3.1.0

### 3.0

#### What's Changed
* :art: Full package refactoring by @ker0x in https://github.com/ker0x/fcm/pull/21
* :memo: Update README by @ker0x in https://github.com/ker0x/fcm/pull/22

**Full Changelog**: https://github.com/ker0x/fcm/compare/2.4.0...3.0.0

## 2.x

> [!NOTE]
> Version `2.x` of this library is a full rewrite to be compliant with [HTTP v1 API](https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages). If
> you are on Legacy HTTP API, then you should consider using version `1.x`

### 2.4

#### What's Changed
* Typo by @tin-cat in https://github.com/ker0x/fcm/pull/17
* Add PHP 8.1 to CI by @ker0x in https://github.com/ker0x/fcm/pull/18
* fix: setBadge var type by @demmmmios in https://github.com/ker0x/fcm/pull/19
* Fix tests by @ker0x in https://github.com/ker0x/fcm/pull/20

**Full Changelog**: https://github.com/ker0x/fcm/compare/2.3.0...2.4.0
