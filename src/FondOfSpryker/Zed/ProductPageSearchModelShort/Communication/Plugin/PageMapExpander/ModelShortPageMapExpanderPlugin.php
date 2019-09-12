<?php

namespace FondOfSpryker\Zed\ProductPageSearchModelShort\Communication\Plugin\PageMapExpander;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageMapExpanderInterface;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class ModelShortPageMapExpanderPlugin extends AbstractPlugin implements ProductPageMapExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandProductPageMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $productData, LocaleTransfer $localeTransfer): PageMapTransfer
    {
        if (!array_key_exists(PageIndexMap::MODEL_SHORT, $productData)) {
            return $pageMapTransfer;
        }

        if (!method_exists($pageMapTransfer, 'setModelShort')) {
            return $pageMapTransfer;
        }

        $this->addModelShortToPageMapTransfer($pageMapTransfer, $productData);
        $this->addModelShortToSearchResult($pageMapTransfer, $pageMapBuilder, $productData);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param array $productData
     *
     * @return void
     */
    protected function addModelShortToPageMapTransfer(PageMapTransfer $pageMapTransfer, array $productData): void
    {
        $pageMapTransfer->setModelShort($productData[PageIndexMap::MODEL_SHORT]);
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     *
     * @return void
     */
    protected function addModelShortToSearchResult(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $productData): void
    {
        $pageMapBuilder->addSearchResultData($pageMapTransfer, PageIndexMap::MODEL_SHORT, $productData[PageIndexMap::MODEL_SHORT]);
    }
}
