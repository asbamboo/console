<?php
namespace asbamboo\console;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
class Finder implements FinderInterface
{
    /**
     *
     * @var CommandCollectionInterface
     */
    private $CommandCollection;

    /**
     *
     * @param CommandCollectionInterface $CommandCollection
     */
    public function __construct(CommandCollectionInterface $CommandCollection = null)
    {
        if(is_null($CommandCollection)){
            $CommandCollection  = new CommandCollection();
        }
        $this->CommandCollection    = $CommandCollection;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\FinderInterface::find()
     */
    public function find(string $name) : callable
    {
        return $this->CommandCollection->get($name);
    }
}