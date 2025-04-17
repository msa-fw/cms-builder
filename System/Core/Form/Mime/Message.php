<?php

namespace System\Core\Form\Mime;

/**
 * Class Message
 * @package System\Core\Form\Mime
 * @method Message dispositionNotification()
 * @method Message global()
 * @method Message globalDeliveryStatus()
 * @method Message globalDispositionNotification()
 * @method Message globalHeaders()
 * @method Message rfc822()
 * @method Message vndWfaWsc()
 */
class Message extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'dispositionnotification' => 'disposition-notification',
        'global' => 'global',
        'globaldeliverystatus' => 'global-delivery-status',
        'globaldispositionnotification' => 'global-disposition-notification',
        'globalheaders' => 'global-headers',
        'rfc822' => 'rfc822',
        'vndwfawsc' => 'vnd.wfa.wsc',
    );
}