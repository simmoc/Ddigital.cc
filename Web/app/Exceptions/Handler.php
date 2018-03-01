<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    // public function render($request, Exception $exception)
    // {
    //     return parent::render($request, $exception);
    // }

    public function render($request, Exception $e)
    {


        
    if(get_class($e) == 'Illuminate\Session\TokenMismatchException'){
        
        flash('Ooops...!','It seems your session got experied, please try again later','error');
        return back();
    }

    else if(get_class($e) == "Symfony\Component\Debug\Exception\FatalThrowableError"){
        
        flash('Ooops...!','Some error with the data, please contact admin','error');
        return back();
    }



    else if(get_class($e) == "Illuminate\Database\QueryException")
    {
        flash('Ooops...!','It seems some issue with the data, please contact admin regarding this..','error');
        return back();   
    }
    
    if ($this->isHttpException($e))
    {       
        if($e instanceof NotFoundHttpException)
        {
            return response()->view('errors.404', [], 404);
        }
        return $this->renderHttpException($e);
    }
    return parent::render($request, $e);
}

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
