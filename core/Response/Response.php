<?php

declare(strict_types=1);

namespace Core\Response;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface
{
    protected int $statusCode = 200;
    protected string $reasonPhrase = '';
    protected StreamInterface $body = '';
    protected string $protocolVersion = '1.1';
    protected array $headers = [];


    /**
     * Retrieves a comma-separated string of the values for a single header.
     * 
     * @param string $name
     * 
     * @return string
     */
    public function getHeaderLine(string $name): string
    {
        return implode(',', $this->headers[$name] ?? []);
    }

    /**
     * Return an instance with the specified header appended with the given value.
     * 
     * @param string $name
     * @param mixed $value
     * 
     * @return MessageInterface
     */
    public function withAddedHeader(string $name, $value): MessageInterface
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Retrieves a message header value by the given case-insensitive name.
     * 
     * @param string $name
     * 
     * @return array
     */
    public function getHeader(string $name): array
    {
        return $this->headers[$name] ?? [];
    }

    /**
     * Retrieves all message header values.
     * 
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Checks if a header exists by the given case-insensitive name.
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function hasHeader(string $name): bool
    {
        return array_key_exists($name, $this->headers);
    }

    /**
     * Return an instance with the provided value replacing the specified header.
     * 
     * @param string $name
     * @param mixed $value
     * 
     * @return MessageInterface
     */
    public function withHeader(string $name, $value): MessageInterface
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Return an instance without the specified header.
     * 
     * @param string $name
     * 
     * @return MessageInterface
     */
    public function withoutHeader(string $name): MessageInterface
    {
        unset($this->headers[$name]);
        return $this;
    }

    /**
     * Gets the response reason phrase associated with the status code.
     * 
     * @return string
     */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    /**
     * Gets the response status code.
     * 
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Return an instance with the specified status code and, optionally, reason phrase.
     * 
     * @param int $code
     * @param string $reasonPhrase
     * 
     * @return ResponseInterface
     */
    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
    {
        $this->statusCode = $code;
        $this->reasonPhrase = $reasonPhrase;
        return $this;
    }

    /**
     * Retrieves the HTTP protocol version as a string.
     * 
     * @return string
     */
    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    /**
     * Return an instance with the specified HTTP protocol version.
     * 
     * @param string $version
     * 
     * @return MessageInterface
     */
    public function withProtocolVersion(string $version): MessageInterface
    {
        $this->protocolVersion = $version;
        return $this;
    }

    /**
     * Gets the body of the message.
     * 
     * @return StreamInterface
     */
    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    /**
     * Return an instance with the specified message body.
     * 
     * @param StreamInterface $body
     * 
     * @return MessageInterface
     */
    public function withBody(StreamInterface $body): MessageInterface
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Redirects to the previous page and sets the request code.
     * 
     * @return ResponseInterface
     */
    public function back(): ResponseInterface
    {
        http_response_code($this->getStatusCode());

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        return $this;
    }

    /**
     * Returns status code and body in json format.
     * 
     * @return ResponseInterface
     */
    public function json(): ResponseInterface
    {
        http_response_code($this->getStatusCode());

        echo json_encode([
            'message' => $this->getReasonPhrase(),
            'status' => $this->getStatusCode(),
        ]);

        return $this;
    }
}
