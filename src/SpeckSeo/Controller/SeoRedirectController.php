<?php

namespace SpeckSeo\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class SeoRedirectController extends AbstractActionController
{
    protected $seoUrlHelper;

    public function productByIdAction()
    {
        $helper = $this->getSeoUrlHelper();
        $url    = $helper->productById($this->params('id'));

        return $this->redirect()->toUrl($url);
    }

    public function categoryByIdAction()
    {
        $helper = $this->getSeoUrlHelper();
        $url    = $helper->categoryById($this->params('id'));

        return $this->redirect()->toUrl($url);
    }

    public function getSeoUrlHelper()
    {
        if (null === $this->seoUrlHelper) {
            $this->seoUrlHelper = $this->getServiceLocator()->get('seoUrl');
        }
        return $this->seoUrlHelper;
    }

    public function setSeoUrlhelper($seoUrlHelper)
    {
        $this->seoUrlHelper = $seoUrlHelper;
        return $this;
    }
}
