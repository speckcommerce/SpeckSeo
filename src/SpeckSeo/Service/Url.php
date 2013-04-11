<?php

namespace SpeckSeo\Service;

use BaconStringUtils\Slugifier;
use Zend\View\Helper\AbstractHelper;
use Zend\View\HelperPluginManager;
use Zend\ServiceManager\ServiceManager;

class Url extends AbstractHelper
{
    protected $productService;
    protected $categoryService;
    protected $companyService;
    protected $urlHelper;
    protected $serviceManager;
    protected $helperManager;

    protected $routes = array(
        'brand'    => 'brand/seo',
        'product'  => 'product/seo',
        'category' => 'category/seo',
    );

    public function productById($id)
    {
        $product = $this->getProductService()->find(array('product_id' => $id));
        if (!$product) {
            throw new \Exception('product not found by id - ' . $id);
        }
        return $this->product($product);
    }

    public function product($product)
    {
        return $this->productString($product->getName(), $product->getProductId());
    }

    protected function productString($string, $id)
    {
        $helper = $this->getUrlHelper();

        $slug   = $this->slugify($string);
        $params = array('slug' => $slug, 'id' => $id);

        return $helper($this->routes['product'], $params);
    }

    public function categoryById($id)
    {
        $category = $this->getCategoryService()->find(array('category_id' => $id));
        if (!$category) {
            throw new \Exception('category not found by id - ' . $id);
        }
        return $this->category($category);
    }

    public function category($category)
    {
        return $this->categoryString($category->getName(), $category->getCategoryId());
    }

    protected function categoryString($string, $id)
    {
        $helper = $this->getUrlHelper();

        $slug   = $this->slugify($string);
        $params = array('slug' => $slug, 'id' => $id);

        return $helper($this->routes['category'], $params);
    }

    public function slugify($string)
    {
        $slugifier = new Slugifier();
        return $slugifier->slugify($string);
    }

    /**
     * @return productService
     */
    public function getProductService()
    {
        if (null === $this->productService) {
            $this->productService = $this->getServiceManager()->get('speckcatalog_product_service');
        }
        return $this->productService;
    }

    /**
     * @param $productService
     * @return self
     */
    public function setProductService($productService)
    {
        $this->productService = $productService;
        return $this;
    }

    /**
     * @return categoryService
     */
    public function getCategoryService()
    {
        if (null === $this->categoryService) {
            $this->categoryService = $this->getServiceManager()->get('speckcatalog_category_service');
        }
        return $this->categoryService;
    }

    /**
     * @param $categoryService
     * @return self
     */
    public function setCategoryService($categoryService)
    {
        $this->categoryService = $categoryService;
        return $this;
    }

    /**
     * @return companyService
     */
    public function getCompanyService()
    {
        if (null === $this->companyService) {
            $this->companyService = $this->getServiceManager()->get('speckcatalog_company_service');
        }
        return $this->companyService;
    }

    /**
     * @param $companyService
     * @return self
     */
    public function setCompanyService($companyService)
    {
        $this->companyService = $companyService;
        return $this;
    }

    /**
     * @return urlHelper
     */
    public function getUrlHelper()
    {
        if (null === $this->urlHelper) {
            $hm = $this->getHelperManager();
            $this->urlHelper = $hm->get('url');
        }
        return $this->urlHelper;
    }

    /**
     * @param $urlHelper
     * @return self
     */
    public function setUrlHelper($urlHelper)
    {
        $this->urlHelper = $urlHelper;
        return $this;
    }

    /**
     * @return serviceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @param $serviceManager
     * @return self
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * @return helperManager
     */
    public function getHelperManager()
    {
        return $this->helperManager;
    }

    /**
     * @param $helperManager
     * @return self
     */
    public function setHelperManager(HelperPluginManager $helperManager)
    {
        $this->helperManager = $helperManager;
        return $this;
    }
}
