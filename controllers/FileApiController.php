<?php

namespace controllers;

use code\applications\ApiAppFactory;
use code\controllers\AppController;
use code\service\ServiceTypes;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FileApiController extends AppController {

    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function stream(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        try {
            $this->setRequest($request)->setResponse($response);
            $params = $request->getQueryParams();
            $type = isset($params['type']) && $params['type'] == '2' ? 'attachment' : 'inline';
            $fileSystem = ApiAppFactory::getApp()->getService(ServiceTypes::FILESYSTEM);
            $file = $fileSystem->getFile($params['file']);
            if ($this->ifModifiedSinceRequest($file)) {
                $file_stream = $file->stream();
                $expireOffset = ApiAppFactory::getApp()->getService(ServiceTypes::CONFIGURATIONS)->get('env.web.streamExpirationOffset', 0);
                return $response->withHeader('Cache-Control', 'public')
                                ->withHeader('Content-Type', $file->mime_content_type())
                                ->withHeader('Content-Length', $file->filesize()->filesize())
                                ->withHeader('Content-Disposition', $type . '; filename=' . $file->basename())
                                ->withHeader('Accept-Ranges', $file->filesize()->filesize())
                                ->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->filemtime()))
                                ->withHeader('Expires', gmdate("D, d M Y H:i:s", time() + $expireOffset) . " GMT")
                                ->withBody($file_stream);
            }
        } catch (Exception $ex) {
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getMessage());
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getTraceAsString());
        }
        return $response;
    }

    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function js(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $this->setRequest($request)->setResponse($response);
            $fileSystem = ApiAppFactory::getApp()->getService(ServiceTypes::FILESYSTEM);
            $params = $request->getQueryParams();
            if (isset($params['file'])) {
                $file = $fileSystem->getJs($params['file']);
            } else {
                $file = $fileSystem->getJs($request->getAttribute('path'));
            }

            if ($this->ifModifiedSinceRequest($file)) {
                $file_stream = $file->stream();
                $expireOffset = ApiAppFactory::getApp()->getService(ServiceTypes::CONFIGURATIONS)->get('env.web.jsExpirationOffset', 0);
                return $response
                                ->withHeader('Content-Type', 'x-javascript')
                                ->withHeader('Content-Length', $file->filesize()->filesize())
                                ->withHeader('Cache-Control', 'max-age=' . $expireOffset . ', must-revalidate')
                                ->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->filemtime()))
                                ->withHeader('Expires', gmdate("D, d M Y H:i:s", time() + $expireOffset) . " GMT")
                                ->withHeader('Pragma', "public")
                                ->withBody($file_stream);
            }
        } catch (Exception $ex) {
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getMessage());
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getTraceAsString());
        }
        return $response;
    }

    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function css(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $this->setRequest($request)->setResponse($response);
            $fileSystem = ApiAppFactory::getApp()->getService(ServiceTypes::FILESYSTEM);
            $params = $request->getQueryParams();
            if (isset($params['file'])) {
                $file = $fileSystem->getCss($params['file']);
            } else {
                $file = $fileSystem->getCss($request->getAttribute('path'));
            }
            if ($this->ifModifiedSinceRequest($file)) {
                $file_stream = $file->stream();
                $expireOffset = ApiAppFactory::getApp()->getService(ServiceTypes::CONFIGURATIONS)->get('env.web.cssExpirationOffset', 0);
                return $response->withHeader('Content-Type', 'text/css')
                                ->withHeader('Content-Length', $file->filesize()->filesize())
                                ->withHeader('Cache-Control', 'max-age=' . $expireOffset . ', must-revalidate')
                                ->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->filemtime()))
                                ->withHeader('Expires', gmdate("D, d M Y H:i:s", time() + $expireOffset) . " GMT")
                                ->withHeader('Pragma', "public")
                                ->withBody($file_stream);
            }
        } catch (Exception $ex) {
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getMessage());
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getTraceAsString());
        }
        return $response;
    }

    /**
     * 
     * @param File $file
     * @return bool
     */
    private function ifModifiedSinceRequest($file): bool {
        $ret = true;
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) &&
                strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $file->filemtime()) {
            $this->response->withStatus(304)->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->filemtime()));
            $ret = false;
        }
        return $ret;
    }

}
