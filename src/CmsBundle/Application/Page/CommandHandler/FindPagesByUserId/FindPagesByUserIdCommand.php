<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesByUserId;

use CmsBundle\Application\Common\CommandHandler\Command;

class FindPagesByUserIdCommand implements Command
{
    /** @var string  */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return FindPagesByUserIdCommand
     */
    public static function instance(string $id): FindPagesByUserIdCommand
    {
        return new self($id);
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}
