<?php

namespace NinetyNine\KumiteBundle\Kumite;

use DateTime;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CookieAdapter implements \Kumite\Adapters\CookieAdapter
{
    private $requestStack;
    private $cookies = array();

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getCookies()
    {
        return $this->requestStack->getCurrentRequest()->cookies->all();
    }

    public function getCookie($name)
    {
        return $this->requestStack->getCurrentRequest()->cookies->get($name);
    }

    public function setCookie($name, $data)
    {
        $this->cookies[$name] = $data;
    }

    public function onResponse(FilterResponseEvent $event)
    {
        foreach ($this->cookies as $name => $value) {
            $event->getResponse()->headers->setCookie(new Cookie($name, $value, new DateTime('+10 years')));
        }
    }
}
