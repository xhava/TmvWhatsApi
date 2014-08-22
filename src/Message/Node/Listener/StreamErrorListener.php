<?php

namespace Tmv\WhatsApi\Message\Node\Listener;

use Tmv\WhatsApi\Message\Node\NodeInterface;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use RuntimeException;

class StreamErrorListener extends AbstractListener
{

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('received.node.stream:error', array($this, 'onReceivedNode'));
    }

    public function onReceivedNode(Event $e)
    {
        /** @var NodeInterface $node */
        $node = $e->getParam('node');
        if ($node->hasChild("system-shutdown")) {
            throw new RuntimeException('Error system-shutdown');
        }
    }
}