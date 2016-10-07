<?php
namespace ker0x\Fcm\Response;


use GuzzleHttp\Psr7\Response;

class TopicResponse extends BaseResponse
{

    const LIMIT_RATE_TOPICS_EXCEEDED = "TopicsMessageRateExceeded";

    /**
     * @var
     */
    protected $topic;

    /**
     * @var string
     */
    protected $messageId;

    /**
     * @var bool
     */
    protected $needRetry = false;

    /**
     * @var string
     */
    protected $error;

    /**
     * TopicResponse constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     * @param $topic
     */
    public function __construct(Response $response, $topic)
    {
        $this->topic = $topic;

        parent::__construct($response);
    }

    /**
     * Return true if topic was sent with success.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return (bool)$this->messageId;
    }

    /**
     * Return the error message if topic couldn't be sent.
     *
     * @return null|string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Return true if topic must be resent.
     *
     * @return bool
     */
    public function shouldRetry(): bool
    {
        return $this->needRetry;
    }

    /**
     * Parse the response of the request.
     *
     * @param array $response Response of the request.
     * @return void
     */
    protected function parseResponse(array $response)
    {
        if (!$this->parseSuccess($response)) {
            $this->parseError($response);
        }
    }

    /**
     * Check if the topic was successfully sent.
     *
     * @param $response
     */
    private function parseSuccess($response)
    {
        if (isset($response[self::MESSAGE_ID])) {
            $this->messageId = $response[self::MESSAGE_ID];
        }
    }

    /**
     * Parse the response of the request if topic couldn't be sent.
     *
     * @param $response
     */
    protected function parseError($response)
    {
        if (isset($response[self::ERROR])) {
            if (in_array(self::LIMIT_RATE_TOPICS_EXCEEDED, $response)) {
                $this->needRetry = true;
            }

            $this->error = $response[self::ERROR];
        }
    }
}