<?php

namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait

{
	public function apiException($request,$exception)
	{

		     if($this->isModel($exception)) 
         {
			return	$this->ModelResponse($exception);
      

        }

        if($this->isHttp($exception)) 
         {
			return $this->HttpResponse($exception);        
        	
		

         }


	}

	protected function isModel($exception)
	{

		return $exception instanceof ModelNotFoundException;
	}

	protected function isHttp($exception)
	{

		return $exception instanceof NotFoundHttpException;

	}
	
	protected function ModelResponse($exception)
			{
				  return response()->json([
			                'errors' => 'Product Model not found'
			            				],Response::HTTP_NOT_FOUND);
				
			}
	

	protected function HttpResponse($exception)
			{
					return response()->json([
			                'errors' => 'Incorrect Route'
											],Response::HTTP_NOT_FOUND);
        
			}
}