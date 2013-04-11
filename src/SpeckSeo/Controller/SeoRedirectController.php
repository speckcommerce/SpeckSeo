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
        $url    = $this->addQueryToUrl($url);

        return $this->redirect()->toUrl($url);
    }

    public function addQueryToUrl($urlString)
    {
        if ($this->params()->fromQuery()) {
            $urlString .= '?' . http_build_query($this->params()->fromQuery());
        }
        return $urlString;
    }


    public function categoryByIdAction()
    {
        $helper = $this->getSeoUrlHelper();
        $url    = $helper->categoryById($this->params('id'));
        $url    = $this->addQueryToUrl($url);

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
