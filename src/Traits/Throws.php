<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 2019-12-18
 * Time: 19:32
 */

namespace Touge\AdminCommon\Traits;
use Touge\AdminCommon\Exceptions\ResponseFailedException;

trait Throws
{
    /**
     *
     * @param $message
     * @return ResponseFailedException
     * @throws ResponseFailedException
     */
    protected function throw_error($message): ResponseFailedException
    {
        throw new ResponseFailedException($message);
    }
}