<?php

declare(strict_types=1);

namespace Core\Request;

use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    protected string $scheme;
    protected string $host;
    protected ?int $port;
    protected string $user;
    protected ?string $password;
    protected string $path;
    protected string $query;
    protected string $fragment;

    public function __construct(string $uri = '')
    {
        $this->parseUrl($uri);
    }

    /**
     * This method splits the uri into parts and return an instance that contains the specified all parts.
     * 
     * @param string $uri
     * 
     * @return UriInterface
     */
    public function parseUrl(string $uri): UriInterface
    {
        $parts = parse_url($uri);

        $this->withScheme($parts['scheme'] ?? '');
        $this->withHost($parts['host'] ?? '');
        $this->withPort($parts['port'] ?? null);
        $this->withUserInfo($parts['user'] ?? '', $parts['pass'] ?? '');
        $this->withPath($parts['path'] ?? '');
        $this->withQuery($parts['query'] ?? '');
        $this->withFragment($parts['fragment'] ?? '');

        return $this;
    }

    /**
     * Return the string representation as a URI reference.
     * 
     * @return string
     */
    public function __toString(): string
    {
        $uri = $this->scheme ?? '';
        $uri .= '://';
        $uri .= $this->getAuthority();
        $uri .= $this->path ?? '';

        if (isset($this->query) && $this->query !== '') {
            $uri .= '?'.$this->query;
        }

        if (isset($this->fragment) && $this->fragment !== '') {
            $uri .= '#'.$this->fragment;
        }

        return $uri;
    }

    /**
     * This method retain the state of the current instance, and return an instance that contains the specified scheme.
     * 
     * @param string $scheme
     * 
     * @return UriInterface
     */
    public function withScheme(string $scheme): UriInterface
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * Retrieve the scheme component of the URI.
     * 
     * @return string
     */
    public function getScheme(): string
    {
        return trim($this->scheme, ':') ?? '';
    }

    /**
     * This method retain the state of the current instance, and return an instance that contains the specified host.
     * 
     * @param string $host
     * 
     * @return UriInterface
     */
    public function withHost(string $host): UriInterface
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Retrieve the host component of the URI.
     * If no host is present, this method return an empty string.
     * 
     * @return string
     */
    public function getHost(): string
    {
        return strtolower($this->host) ?? '';
    }

    /**
     * Return an instance with the specified port.
     * 
     * @param int|null $port
     * 
     * @return UriInterface
     */
    public function withPort(?int $port): UriInterface
    {
        $this->port = $port;
        return $this;
    }

    /**
     * Retrieve the port component of the URI.
     * 
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * Return an instance with the specified user information.
     * 
     * @param string $user
     * @param string|null $password
     * 
     * @return UriInterface
     */
    public function withUserInfo(string $user, ?string $password = null): UriInterface
    {
        $this->user = $user;
        $this->password = $password;
        return $this;
    }
    
    /**
     * Retrieve the user information component of the URI.
     * 
     * @return string
     */
    public function getUserInfo(): string
    {
        $info = $this->user ?? '';
        $info .= isset($this->password) ? ':['.$this->password.']' : '';
        return $info;
    }

    /**
     * This method retain the state of the current instance, and return an instance that contains the specified path.
     * 
     * @param string $path
     * 
     * @return UriInterface
     */
    public function withPath(string $path): UriInterface
    {
        $this->path = $path;
        return $this;
    }
    
    /**
     * Retrieve the path component of the URI.
     * The path can either be empty or absolute (starting with a slash) or rootless (not starting with a slash).
     * 
     * @return string
     */
    public function getPath(): string
    {
        return $this->path ?? '';
    }

    /**
     * This method retain the state of the current instance, and return an instance that contains the specified query string
     * 
     * @param string $query
     * 
     * @return UriInterface
     */
    public function withQuery(string $query): UriInterface
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Retrieve the query string of the URI.
     * If no query string is present, this method MUST return an empty string.
     * 
     * @return string
     */
    public function getQuery(): string
    {
        return trim($this->query, '?') ?? '';
    }

    /**
     * This method MUST retain the state of the current instance, and return an instance that contains the specified URI fragment.
     * 
     * @param string $fragment
     * 
     * @return UriInterface
     */
    public function withFragment(string $fragment): UriInterface
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * Retrieve the fragment component of the URI.
     * 
     * @return string
     */
    public function getFragment(): string
    {
        return trim($this->fragment, '#') ?? '';
    }

    /**
     * This method is empty.
     */
    public function getAuthority(): string
    {
        return '';
    }
}