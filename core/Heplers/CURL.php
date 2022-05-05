<?php

namespace Core\Helpers;

use Core\Exceptions\RemoteServiceException;

class CURL
{
    /**
     * @throws RemoteServiceException
     */
    public static function post(string $link, array $data = []): string{
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30000,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_HTTPHEADER     => array(
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));
        $res = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if(!$err){
            throw new RemoteServiceException($err);
        }
        return $res;
    }
}
