<?php

// This file is auto-generated, don't edit it. Thanks.

namespace AlibabaCloud\SDK\Imagerecog\V20190930\Models;

use AlibabaCloud\Tea\Model;
use GuzzleHttp\Psr7\Stream;

class RecognizeImageColorAdvanceRequest extends Model
{
    /**
     * @var Stream
     */
    public $urlObject;

    /**
     * @var int
     */
    public $colorCount;
    protected $_name = [
        'urlObject'  => 'UrlObject',
        'colorCount' => 'ColorCount',
    ];

    public function validate()
    {
        Model::validateRequired('urlObject', $this->urlObject, true);
    }

    public function toMap()
    {
        $res = [];
        if (null !== $this->urlObject) {
            $res['UrlObject'] = $this->urlObject;
        }
        if (null !== $this->colorCount) {
            $res['ColorCount'] = $this->colorCount;
        }

        return $res;
    }

    /**
     * @param array $map
     *
     * @return RecognizeImageColorAdvanceRequest
     */
    public static function fromMap($map = [])
    {
        $model = new self();
        if (isset($map['UrlObject'])) {
            $model->urlObject = $map['UrlObject'];
        }
        if (isset($map['ColorCount'])) {
            $model->colorCount = $map['ColorCount'];
        }

        return $model;
    }
}
