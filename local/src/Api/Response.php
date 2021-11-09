<?php

namespace InfoSystems\Api;


use Bitrix\Main\Web\Json;

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
     * @var array
     */
    protected $errors;

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
        $this->errors = $error;
    }

    public function addHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    public function get(array $options = []): string
    {
        $this->setHeaders();

        if (!empty($this->headers)) {
            foreach ($this->headers as $header => $value) {
                header(sprintf('%s: %s', $header, $value));
            }
        }

        $response = [
            'code' => $this->code,
            'status' => $this->status,
            'data' => $this->data
        ];

        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }


        return Json::encode($response, JSON_UNESCAPED_UNICODE);
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

    public function __toString()
    {
        return $this->get();
    }
}
