<?php

namespace InfoSystems\App\Component;

use CBitrixComponent;
use Throwable;

abstract class BaseComponentAbstract extends CBitrixComponent
{

    /**
     * @param CBitrixComponent|null $parentComponent
     */
    public function __construct($parentComponent = null)
    {
        $this->init($parentComponent);

        parent::__construct($parentComponent);
    }

    /**
     * @param CBitrixComponent|null $parentComponent
     */
    protected function init(CBitrixComponent $parentComponent = null)
    {
    }

    /**
     * @return static
     */
    public function executeComponent()
    {
        $this->componentProlog();

        $this->doComponent();

        $this->componentEpilog();

        return $this->componentReturn();
    }

    protected function doComponent()
    {
        try {
            $this->componentBody();
        } catch (\Throwable $e) {
            $this->componentBodyException($e);
        }

        $this->showTemplate();
    }

    protected function componentProlog()
    {
    }

    protected function componentEpilog()
    {
        $this->processMetaData();
        $this->processNavChain();
    }

    protected function processMetaData()
    {
        /** global \CMain $APPLICATION */
        global $APPLICATION;
        if (isset($this->arResult['META_TAGS'])) {
            if (isset($this->arResult['META_TAGS']['TITLE'])) {
                $APPLICATION->SetTitle($this->arResult['META_TAGS']['TITLE']);
            }
            if (isset($this->arResult['META_TAGS']['BROWSER_TITLE'])) {
                $APPLICATION->SetPageProperty('title', $this->arResult['META_TAGS']['BROWSER_TITLE']);
            }
            if (isset($this->arResult['META_TAGS']['KEYWORDS'])) {
                $APPLICATION->SetPageProperty('keywords', $this->arResult['META_TAGS']['KEYWORDS']);
            }
            if (isset($this->arResult['META_TAGS']['DESCRIPTION'])) {
                $APPLICATION->SetPageProperty('description', $this->arResult['META_TAGS']['DESCRIPTION']);
            }
        }
    }

    protected function processNavChain()
    {
        /** global \CMain $APPLICATION */
        global $APPLICATION;
        if (isset($this->arResult['NAV_CHAIN'])) {
            foreach ($this->arResult['NAV_CHAIN'] as $chainItem) {
                $APPLICATION->AddChainItem($chainItem['TITLE'] ?? '', $chainItem['LINK'] ?? '');
            }
        }
    }

    /**
     * @return string
     */
    public function getCurUri(): string
    {
        return trim($this->request->getRequestUri());
    }

    /**
     * @return static
     */
    protected function componentReturn()
    {
        return $this;
    }

    /**
     * @param Throwable $e
     * @throws Throwable
     */
    protected function componentBodyException(Throwable $e)
    {
    }

    /**
     * @return void
     */
    public function define404(): void
    {
        if (!\defined('ERROR_404')) {
            \define('ERROR_404', 'Y');
        }
    }

    /**
     * @return void
     */
    protected function showTemplate(): void
    {
        if ($this->canShowTemplate()) {
            $this->includeComponentTemplate();
        }
    }

    /**
     * @return bool
     */
    protected function canShowTemplate(): bool
    {
        return true;
    }

    abstract protected function componentBody();
}
