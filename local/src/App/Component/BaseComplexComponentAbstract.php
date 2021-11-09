<?php

namespace InfoSystems\App\Component;

use CBitrixComponent;
use CComponentEngine;

abstract class BaseComplexComponentAbstract extends CBitrixComponent
{
    /** @var CComponentEngine */
    protected $componentEngine;

    /** @var array */
    protected $resultUrlTemplates;

    /** @var array */
    protected $resultVariableAliases;

    /** @var array */
    protected $guessedVariables;

    /** @var string */
    protected $guessedComponentPageName;

    /**
     * @return string
     */
    abstract protected function getComponentDir(): string;

    /**
     * Подключаемая страница, если компоненту не удалось сопоставить путь
     *
     * @return string
     */
    abstract protected function getNotFoundComponentPageName(): string;

    /**
     * Массив переменных, обрабатываемых компонентом
     *
     * @return array
     */
    abstract protected function getComponentVariables(): array;

    /**
     * Массив SEF_URL_TEMPLATES по умолчанию
     *
     * @return array
     */
    protected function getDefaultSefUrlTemplates(): array
    {
        return [];
    }

    /**
     * Массив VARIABLE_ALIASES по умолчанию (не для режима SEF)
     *
     * @return array
     */
    protected function getDefaultVariableAliases(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getSefUrlTemplates(): array
    {
        if (isset($this->arParams['SEF_URL_TEMPLATES']) && \is_array($this->arParams['SEF_URL_TEMPLATES'])) {
            return $this->arParams['SEF_URL_TEMPLATES'];
        }

        return [];
    }

    /**
     * Возвращает массив шаблонов разбираемых путей
     *
     * @return array
     */
    protected function getResultUrlTemplates(): array
    {
        if ($this->resultUrlTemplates === null) {
            $defaultSefUrlTemplates = $this->getDefaultSefUrlTemplates();
            $sefUrlTemplates = $this->getSefUrlTemplates();
            $this->resultUrlTemplates = \CComponentEngine::makeComponentUrlTemplates(
                $defaultSefUrlTemplates,
                $sefUrlTemplates
            );
        }

        return $this->resultUrlTemplates ?? [];
    }

    /**
     * @return array
     */
    protected function getVariableAliases(): array
    {
        if (isset($this->arParams['VARIABLE_ALIASES']) && \is_array($this->arParams['VARIABLE_ALIASES'])) {
            return $this->arParams['VARIABLE_ALIASES'];
        }

        return [];
    }

    /**
     * @return array
     */
    protected function getResultVariableAliases(): array
    {
        if ($this->resultVariableAliases === null) {
            $defaultVariableAliases = $this->getDefaultVariableAliases();
            $variableAliases = $this->getVariableAliases();
            $this->resultVariableAliases = \CComponentEngine::makeComponentVariableAliases(
                $defaultVariableAliases,
                $variableAliases
            );
        }

        return $this->resultVariableAliases ?? [];
    }

    /**
     * @return string
     */
    protected function getSefFolder(): string
    {
        if (isset($this->arParams['SEF_FOLDER'])) {
            return trim($this->arParams['SEF_FOLDER']);
        }

        return '';
    }

    /**
     * @return string
     */
    public function getRequestedPage(): string
    {
        return $this->request->getRequestedPage();
    }

    /**
     * @return \CComponentEngine
     */
    protected function getComponentEngine(): \CComponentEngine
    {
        if (!$this->componentEngine) {
            $this->componentEngine = new \CComponentEngine($this);
        }

        return $this->componentEngine;
    }

    /**
     * @return void
     */
    protected function guessComponentPath(): void
    {
        $guessedVariables = [];
        $componentPage = $this->getComponentEngine()->guessComponentPath(
            $this->getSefFolder(),
            $this->getResultUrlTemplates(),
            $guessedVariables,
            $this->getRequestedPage()
        );
        $this->guessedVariables = $guessedVariables;
        $this->guessedComponentPageName = $componentPage && \is_string($componentPage) ? $componentPage : '';
    }

    /**
     * @return array
     */
    protected function getGuessedVariables(): array
    {
        if ($this->guessedVariables === null) {
            $this->guessComponentPath();
        }

        return $this->guessedVariables ?? [];
    }

    /**
     * @return string
     */
    protected function getGuessedComponentPageName(): string
    {
        if ($this->guessedComponentPageName === null) {
            $this->guessComponentPath();
        }

        return $this->guessedComponentPageName;
    }

    /**
     * @param string $componentPageName
     * @return array
     */
    protected function getResultVariables(string $componentPageName): array
    {
        $resultVariables = $this->getGuessedVariables();

        \CComponentEngine::initComponentVariables(
            $componentPageName,
            $this->getComponentVariables(),
            $this->getResultVariableAliases(),
            $resultVariables
        );

        return $resultVariables;
    }

    /**
     * @return string
     */
    public function getComponentPageName(): string
    {
        $componentPageName = $this->getGuessedComponentPageName();
        if (!$componentPageName) {
            $componentPageName = $this->getNotFoundComponentPageName();
        }

        return $componentPageName;
    }

    /**
     * @return static
     */
    public function executeComponent(): self
    {
        $componentPageName = $this->getComponentPageName();

        $this->arResult = [
            'PAGE_NAME' => $componentPageName,
            'FOLDER' => $this->getSefFolder(),
            'URL_TEMPLATES' => $this->getResultUrlTemplates(),
            'VARIABLES' => $this->getResultVariables($componentPageName),
            'ALIASES' => $this->getResultVariableAliases(),
        ];

        $this->includeComponentTemplate($componentPageName);

        return $this->componentReturn();
    }

    /**
     * @return static
     */
    protected function componentReturn()
    {
        return $this;
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
}
