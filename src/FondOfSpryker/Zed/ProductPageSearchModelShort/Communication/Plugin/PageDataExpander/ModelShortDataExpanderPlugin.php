<?php

namespace FondOfSpryker\Zed\ProductPageSearchModelShort\Communication\Plugin\PageDataExpander;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

class ModelShortDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderInterface
{
    public const PLUGIN_NAME = 'ModelShortDataExpanderPlugin';

    /**
     * @param array $productData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return void
     */
    public function expandProductPageData(array $productData, ProductPageSearchTransfer $productAbstractPageSearchTransfer): void
    {
        if (!array_key_exists('attributes', $productData)) {
            return;
        }

        $productAttributeData = \json_decode($productData['attributes'], true);

        if (!array_key_exists(PageIndexMap::MODEL_SHORT, $productAttributeData)) {
            return;
        }

        if (!method_exists($productAbstractPageSearchTransfer, 'setModelShort')) {
            return;
        }

        $productAbstractPageSearchTransfer->setModelShort($productAttributeData[PageIndexMap::MODEL_SHORT] === null ?: '');
    }
}
