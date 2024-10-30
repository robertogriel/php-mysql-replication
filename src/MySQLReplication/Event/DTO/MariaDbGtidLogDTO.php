<?php

declare(strict_types=1);

namespace MySQLReplication\Event\DTO;

use MySQLReplication\Definitions\ConstEventsNames;
use MySQLReplication\Event\EventInfo;

class MariaDbGtidLogDTO extends EventDTO
{
    private ConstEventsNames $type = ConstEventsNames::MARIADB_GTID;

    public function __construct(
        EventInfo $eventInfo,
        public readonly int $flag,
        public readonly int $domainId,
        public readonly string $mariaDbGtid
    ) {
        parent::__construct($eventInfo);
    }

    public function __toString(): string
    {
        return PHP_EOL .
            '=== Event ' . $this->getType() . ' === ' . PHP_EOL .
            'Date: ' . $this->eventInfo->getDateTime() . PHP_EOL .
            'Log position: ' . $this->eventInfo->pos . PHP_EOL .
            'Event size: ' . $this->eventInfo->size . PHP_EOL .
            'Flag: ' . var_export($this->flag, true) . PHP_EOL .
            'Domain Id: ' . $this->domainId . PHP_EOL .
            'Sequence Number: ' . $this->mariaDbGtid . PHP_EOL;
    }

    public function getType(): string
    {
        return $this->type->value;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
