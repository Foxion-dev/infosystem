<?php

namespace InfoSystems\App\Component;

use Throwable;

abstract class BaseComponentCachedAbstract extends BaseComponentAbstract
{
    /** Тип кеширования по умолчанию (следует иметь в виду, что CACHE_TYPE у компонента всегда задан, по умолчанию - А) */
    protected const DEFAULT_CACHE_TYPE = 'A';

    /** Время кеширования по умолчанию */
    protected const DEFAULT_CACHE_TIME = 43200;

    /** Флаг кеширования шаблона по умолчанию */
    protected const DEFAULT_CACHE_TEMPLATE = 'Y';

    /**
     * @param array $params
     * @return array
     */
    public function onPrepareComponentParams($params): array
    {
        $params['CACHE_TIME'] = isset($params['CACHE_TIME'])
            ? (int)$params['CACHE_TIME']
            : static::DEFAULT_CACHE_TIME;
        $params['CACHE_TYPE'] = $params['CACHE_TYPE'] ?? static::DEFAULT_CACHE_TYPE;

        if (isset($params['CACHE_TEMPLATE']) && $params['CACHE_TEMPLATE'] !== '') {
            $params['CACHE_TEMPLATE'] = $params['CACHE_TEMPLATE'] === 'Y' ? 'Y' : 'N';
        } else {
            $params['CACHE_TEMPLATE'] = static::DEFAULT_CACHE_TEMPLATE;
        }

        return $params;
    }

    protected function doComponent()
    {
        $cacheTime = $this->getComponentCacheTime();
        $cacheId = $this->getComponentCacheId();
        $cachePath = $this->getComponentCachePath();
        if ($this->startResultCache($cacheTime, $cacheId, $cachePath)) {
            try {
                $this->componentBody();
            } catch (Throwable $e) {
                $this->abortResultCache();
                $this->componentBodyException($e);
            }
            $this->setTaggedCache();

            if ($this->isCachedTemplate()) {
                $cacheKeys = [];
                if (isset($this->arResult['META_TAGS'])) {
                    $cacheKeys[] = 'META_TAGS';
                }
                if (isset($this->arResult['NAV_CHAIN'])) {
                    $cacheKeys[] = 'NAV_CHAIN';
                }
                $this->setResultCacheKeys($cacheKeys);
                $this->showTemplate();
            }

            $this->endResultCache();
        }

        if (!$this->isCachedTemplate()) {
            $this->showTemplate();
        }
    }

    /**
     * @return void
     */
    protected function showTemplate(): void
    {
        if ($this->canShowTemplate()) {
            $this->includeComponentTemplate();
        } else {
            $this->endResultCache();
        }
    }

    /**
     * @return int
     */
    protected function getComponentCacheTime(): int
    {
        return (int)$this->arParams['CACHE_TIME'];
    }

    /**
     * @return string
     */
    protected function getComponentCacheType(): string
    {
        return trim($this->arParams['CACHE_TYPE']);
    }

    /**
     * @return string
     */
    protected function getComponentCachePath(): string
    {
        $cacheDir = SITE_ID.'/'.basename($this->getComponentDir());
        $cacheDir = '/'.ltrim($cacheDir, '/');

        return $cacheDir;
    }

    /**
     * @return string
     */
    protected function getComponentCacheId(): string
    {
        return md5(serialize([$this->getCacheNavParams(), 'v1']));
    }

    /**
     * @return array
     */
    protected function getCacheNavParams(): array
    {
        return [];
    }

    /**
     * @return bool
     */
    protected function isCachedTemplate(): bool
    {
        return $this->arParams['CACHE_TEMPLATE'] === 'Y';
    }

    abstract protected function setTaggedCache();
}
