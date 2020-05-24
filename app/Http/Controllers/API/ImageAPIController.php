<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateImageAPIRequest;
use App\Http\Requests\API\UpdateImageAPIRequest;
use App\Models\Image;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ImageController
 * @package App\Http\Controllers\API
 */

class ImageAPIController extends AppBaseController
{
    /** @var  ImageRepository */
    private $imageRepository;

    public function __construct(ImageRepository $imageRepo)
    {
        $this->imageRepository = $imageRepo;
    }

    /**
     * Display a listing of the Image.
     * GET|HEAD /images
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $images = $this->imageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($images->toArray(), 'Images retrieved successfully');
    }
}
