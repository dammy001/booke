<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRatingAPIRequest;
use App\Http\Requests\API\UpdateRatingAPIRequest;
use App\Models\Rating;
use App\Repositories\RatingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RatingController
 * @package App\Http\Controllers\API
 */

class RatingAPIController extends AppBaseController
{
    /** @var  RatingRepository */
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepo)
    {
        $this->ratingRepository = $ratingRepo;
    }

    /**
     * Display a listing of the Rating.
     * GET|HEAD /ratings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $ratings = $this->ratingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ratings->toArray(), 'Ratings retrieved successfully');
    }

    /**
     * Store a newly created Rating in storage.
     * POST /ratings
     *
     * @param CreateRatingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRatingAPIRequest $request)
    {
        $input = $request->all();

        $rating = $this->ratingRepository->create($input);

        return $this->sendResponse($rating->toArray(), 'Rating saved successfully');
    }

    /**
     * Display the specified Rating.
     * GET|HEAD /ratings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        return $this->sendResponse($rating->toArray(), 'Rating retrieved successfully');
    }

    /**
     * Update the specified Rating in storage.
     * PUT/PATCH /ratings/{id}
     *
     * @param int $id
     * @param UpdateRatingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRatingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating = $this->ratingRepository->update($input, $id);

        return $this->sendResponse($rating->toArray(), 'Rating updated successfully');
    }

    /**
     * Remove the specified Rating from storage.
     * DELETE /ratings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating->delete();

        return $this->sendSuccess('Rating deleted successfully');
    }
}
