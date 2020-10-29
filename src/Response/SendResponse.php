<?php

declare(strict_types=1);

namespace Kerox\Fcm\Response;

class SendResponse extends AbstractResponse
{
    public const ERROR_KEY = 'error_code';
    public const MESSAGE_KEY = 'name';

    public const ERROR_UNSPECIFIED_ERROR = 'UNSPECIFIED_ERROR';
    public const ERROR_INVALID_ARGUMENT = 'INVALID_ARGUMENT';
    public const ERROR_UNREGISTERED = 'UNREGISTERED';
    public const ERROR_SENDER_ID_MISMATCH = 'SENDER_ID_MISMATCH';
    public const ERROR_QUOTA_EXCEEDED = 'QUOTA_EXCEEDED';
    public const ERROR_APNS_AUTH_ERROR = 'APNS_AUTH_ERROR';
    public const ERROR_UNAVAILABLE = 'UNAVAILABLE';
    public const ERROR_INTERNAL = 'INTERNAL';

    public const ERROR_MESSAGE = [
        self::ERROR_UNSPECIFIED_ERROR => 'No more information is available about this error.',
        self::ERROR_INVALID_ARGUMENT => 'Request parameters were invalid. An extension of type google.rpc.BadRequest is returned to specify which field was invalid.',
        self::ERROR_UNREGISTERED => 'App instance was unregistered from FCM. This usually means that the token used is no longer valid and a new one must be used.',
        self::ERROR_SENDER_ID_MISMATCH => '	The authenticated sender ID is different from the sender ID for the registration token.',
        self::ERROR_QUOTA_EXCEEDED => 'Sending limit exceeded for the message target. An extension of type google.rpc.QuotaFailure is returned to specify which quota got exceeded.',
        self::ERROR_APNS_AUTH_ERROR => 'APNs certificate or auth key was invalid or missing.',
        self::ERROR_UNAVAILABLE => 'The server is overloaded.',
        self::ERROR_INTERNAL => 'An unknown internal error occurred.',
    ];

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $errorCode;

    /**
     * @var string|null
     */
    private $errorMessage;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMessageId(): ?string
    {
        if ($this->name !== null) {
            $parts = explode('/', $this->name);

            return end($parts) ?: null;
        }

        return null;
    }

    public function hasError(): bool
    {
        return $this->errorCode !== null;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * Parse the response.
     *
     * @return mixed
     */
    protected function parseResponse(array $response)
    {
        $this->name = $response[self::MESSAGE_KEY] ?? null;

        if (isset($response[self::ERROR_KEY])) {
            $this->errorCode = $response[self::ERROR_KEY];
            $this->errorMessage = self::ERROR_MESSAGE[$response[self::ERROR_KEY]] ?? null;
        }
    }
}
