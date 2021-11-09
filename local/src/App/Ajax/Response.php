<?php

namespace InfoSystems\App\Ajax;

class Response
{
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var
     */
    protected $data;

    /**
     * @var \DateTime
     */
    protected $create_d;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    protected $error;

    protected $headers = [];

    public function __construct($code = 200, $status = self::STATUS_SUCCESS)
    {
        $this->code = $code;
        $this->status = $status;
        $this->create_d = new \DateTime();
    }

    private function setHeaders(): void
    {
        header('Content-Type: application/json');
        header('HTTP/1.1 ' . $this->getCode());
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function addError($error): void
    {
        $this->error = $error;
    }

    public function addHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    public function send(array $options = []): string
    {
        $this->setHeaders();

        if (!empty($this->headers)) {
            foreach ($this->headers as $header => $value) {
                header(sprintf('%s: %s', $header, $value));
            }
        }

        $response = [
            'code' => $this->code,
            'message' => $this->message,
            'status' => $this->status,
            'data' => $this->data
        ];

        if (!empty($this->error)) {
            $response['error'] = $this->error;
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
