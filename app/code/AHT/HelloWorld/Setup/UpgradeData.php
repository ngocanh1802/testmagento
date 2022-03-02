<?php
namespace AHT\HelloWorld\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use AHT\HelloWorld\Model\PostFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @param \AHT\HelloWorld\Model\PostFactory
     */
    private $postFactory;

    public function __construct(
        PostFactory $postFactory)
    {
        $this->postFactory = $postFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.4', '<')) {
			$data = [
				'user_name'         => "Magento2",
				'user_dob' => "2022-02-14",
				
			];

			$post = $this->postFactory->create();
			$post->addData($data)->save();
		}
        $setup->endSetup();
    }
}