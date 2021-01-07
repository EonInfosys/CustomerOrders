<?php

namespace EonInfosys\CustomerOrders\Model;

use EonInfosys\CustomerOrders\Api\OrderInterface;

/**
* Defines the implementaiton class of the calculator service contract.
*/
class Order implements OrderInterface
{


  /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    public $_orderRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    public $_searchCriteriaBuilder;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    public $_filterBuilder;

    /**
     * @var \Magento\Framework\Webapi\Rest\Request
     */
    public $_request;

    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Webapi\Rest\Request $request
    ) {
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_filterBuilder = $filterBuilder;
        $this->_request = $request;
    }

    /**
     * Find entities by customer ID
     * Accepts 'page' and 'show' GET params
     *
     * @param string $customerId
     * @return \Magento\Sales\Api\Data\OrderSearchResultInterface
     */
    public function getOrdertList($customerId) {
           if(empty($customerId) || !isset($customerId) || $customerId == ""){
           throw new InputException(__('Id required'));
          }
          else{
        $filters = [
            $this->_filterBuilder->setField('customer_id')->setValue($customerId)->create()
        ];
        $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filters)->create();
        $searchCriteria->setCurrentPage( $this->_request->getParam('page', 1) );
        $searchCriteria->setPageSize( $this->_request->getParam('show', 20) );
        return $this->_orderRepository->getList($searchCriteria);


    //      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    //      $orders = $objectManager->create('Magento\Sales\Model\Order')->getCollection()->addFieldToFilter('customer_id',$customerId);
    //      $orderData = array();
    //       if(count($orders)){
    //        //foreach ($orders as $order){
    //        foreach ($orders->getItems() as $order){
    //        $data = array(
    //          "order_id"=>$order->getEntityId()/*,
    //          "status"=>$order->getStatus(),
    //          "amount"=>$order->getBaseGrandTotal(),
    //          "order_date"=>$order->getUpdatedAt()*/
    //       );
    //        $orderData[] = $data;
    //       }
    //       return $orderData;
    //      }
    //      else{
    //       return $orderData;
    //      }
       }
    }
}
