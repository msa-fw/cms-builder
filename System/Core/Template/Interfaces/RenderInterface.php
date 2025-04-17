<?php

namespace System\Core\Template\Interfaces;

use System\Helpers\Classes\ArrayManager;

interface RenderInterface
{
    public function renderContent();

    /**
     * @param ArrayManager|null $manager
     * @return RenderInterface
     */
    public function renderController(ArrayManager $manager = null);

    public function getDataContentResult();

    public function setDataContentResult($content);

    public function getControllerContentResult();

    public function setControllerContentResult($content);
}