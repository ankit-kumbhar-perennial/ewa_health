<?php

namespace App\Traits;

use \Illuminate\Contracts\Support\MessageProvider;
use \Illuminate\Support\MessageBag;

trait ResponseTrait {
    
    /**
     * Formatted error message
     * 
     * @param string $message
     * @param integer $statusCode
     * @return object
     */
    protected function respondWithError($message, $statusCode)
    {
        if(!is_object($message)) {
            $message = [
                'other' => array($message)
            ];
        }
        
        return response()->json([
            'success' => false,
            'errors' => $message
        ])->setStatusCode($statusCode);
    }
    
    /**
     * Formatted success message
     * 
     * @param array $data
     * @param string $message
     * @param integer $statusCode
     * @return object
     */
    protected function respondWithSuccess($data, $message = 'Success', $statusCode)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ])->setStatusCode($statusCode);
    }
    
    /**
     * Formatted success message with pagination
     * 
     * @param object $response
     * @param string $message
     * @param integer $statusCode
     * @param string $entity
     * @return object
     */
    protected function responseWithSuccessAndPagination($response, $message, $statusCode, $entity, $additional_data = null)
    {
        $data = [
            "$entity" => $response->data,
            "additional_data" => $additional_data,
            "paging" => [
                "links" => $response->meta->paging->links,
                "total" => $response->meta->paging->total
            ]
        ];
        return $this->respondWithSuccess($data, $message, $statusCode);
    }
    
     /**
     * Parse the given errors into an array
     * 
     * @param \Illuminate\Contracts\Support\MessageProvider $provider
     * @return \Illuminate\Support\MessageBag
     */
    protected function parseErrors($provider)
    {
        if ($provider instanceof MessageProvider) {
            return $provider->getMessageBag();
        }

        return new MessageBag((array) $provider);
    }
}