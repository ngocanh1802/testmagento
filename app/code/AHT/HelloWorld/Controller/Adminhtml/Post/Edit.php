<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\HelloWorld\Controller\Adminhtml\Post;

class Edit extends \AHT\HelloWorld\Controller\Adminhtml\Post
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // echo "ta"; die;
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('user_id');
        echo $id; die;
        $model = $this->_objectManager->create(\AHT\HelloWorld\Model\Post::class);

        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            // var_dump($model->getData());die;
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This user no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('helloworld', $model);
                                        // tên bảng
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit User_Name') : __('New User_Name'),
            $id ? __('Edit User_DOB') : __('New User_DOB')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Users'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Users %1', $model->getId()) : __('New User'));
        return $resultPage;
    }
}
