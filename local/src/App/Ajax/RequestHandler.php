<?php

namespace InfoSystems\App\Ajax;

use Bitrix\Main\HttpRequest;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\DateTime;
use Infosystems\Recaptcha\RecaptchaManager;

/**
 * Class RequestHandler
 * @package InfoSystems\App\Ajax
 */
class RequestHandler extends AbstractRequestHandler
{
    /**
     * RequestHandler constructor.
     *
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        parent::__construct($request);
    }


    public function handleFeedback(): void
    {
        $response = new Response();

        try {
            $this->save($this->request);

            $response->setMessage('Заявка успешно отправлена');
        } catch (\Exception $exception) {
            $response->setStatus($response::STATUS_ERROR);
            $response->setMessage($exception->getMessage());
        }

        $response->send();
    }

    /**
     * @return string
     */
    public function getRecaptchaSiteKey(): string
    {
        $response = new Response();
        $response->setData([
            'sitekey' => RecaptchaManager::getSiteKey()
        ]);
        $response->send();
    }

    /**
     * @param $data
     * @throws SystemException
     */
    protected function validate(&$data)
    {
        /**
         * Защита от автоматический действий
         */
        if ($data['token']) {

            $result = (new RecaptchaManager())->isValid($data['token']);

            if (!$result) {
                throw new \Bitrix\Main\SystemException('Защита от автоматических действий не пройдена!');
            }
        } else {
            throw new \Bitrix\Main\SystemException('Отсутствует токен, попробуйте позже');
        }
    }

    /**
     * @param HttpRequest $request
     */
    protected function save(HttpRequest $request)
    {
        if (!$this->request->isAjaxRequest()) {
            throw new \Bitrix\Main\SystemException('Некорректный запрос');
        }

        $data = $request->getPostList();

        $errors = \CForm::Check($data['WEB_FORM_ID'], $data, false, 'Y', 'Y');

        if ($errors) {
            throw new \Bitrix\Main\SystemException(implode('<br/> ', $errors));
        }

        if ($result = \CFormResult::Add($data['WEB_FORM_ID'], $data)) {
            \CFormCRM::onResultAdded($data['WEB_FORM_ID'], $result);
            \CFormResult::SetEvent($result);
            \CFormResult::Mail($result);
        }
    }
}
