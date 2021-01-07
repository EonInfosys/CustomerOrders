<?php

namespace EonInfosys\CustomerOrders\Api;

use EonInfosys\CustomerOrders\Api\Data\PointInterface;

interface OrderInterface
{
  /**
   * Find entities by customer ID
   * Accepts 'page' and 'show' GET params
   *
   * @param string $customerId
   * @return \Magento\Sales\Api\Data\OrderSearchResultInterface
   */
    public function getOrdertList($customerId);
}
