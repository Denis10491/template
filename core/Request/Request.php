<?php

declare(strict_types=1);

namespace Core\Request;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements RequestInterface
{
    protected UriInterface $uri;
    protected string $method;
    protected string $protocolVersion = '1.1';
    protected string $requestTarget;
    protected array $headers = [];
    protected StreamInterface $body;

    /**
     * Retrieves the HTTP method of the request.
     * 
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Return an instance with the provided HTTP method.
     * 
     * @param string $method
     * 
     * @return RequestInterface
     */
    public function withMethod(string $method): RequestInterface
    {
        $this->method = $method;
        return $this;
    }

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
     * Retrieves the URI instance.
     * 
     * @return UriInterface
     */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    /**
     * Returns an instance with the provided URI.
     * 
     * @param UriInterface $uri
     * @param bool $preserveHost
     * 
     * @return RequestInterface
     */
    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        $this->uri = $uri;
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
     * Retrieves the message's request target.
     * 
     * @return string
     */
    public function getRequestTarget(): string
    {
        return $this->requestTarget;
    }

    /**
     * Return an instance with the specific request-target.
     * 
     * @param string $requestTarget
     * 
     * @return RequestInterface
     */
    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        $this->requestTarget = $requestTarget;
        return $this;
    }
}