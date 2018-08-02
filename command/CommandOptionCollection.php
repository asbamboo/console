<?php
namespace asbamboo\console\command;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
class CommandOptionCollection implements CommandOptionCollectionInterface
{
    /**
     *
     * @var array
     */
    private $CommandOptions = [];

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandOptionCollectionInterface::append()
     */
    public function append(CommandOptionInterface $CommandOption) : CommandOptionCollectionInterface
    {
        $this->CommandOptions[] = $CommandOption;
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->CommandOptions);
    }
}