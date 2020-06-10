<?php

namespace HMS\Repositories\Gatekeeper;

use Carbon\Carbon;
use HMS\Entities\User;
use HMS\Entities\Gatekeeper\Building;
use HMS\Entities\Gatekeeper\BookableArea;
use HMS\Entities\Gatekeeper\TemporaryAccessBooking;

interface TemporaryAccessBookingRepository
{
    /**
     * @param $id
     *
     * @return null|TemporaryAccessBooking
     */
    public function findOneById($id);

    /**
     * Count future bookings for a User on a given Building.
     *
     * @param Building $building
     * @param User $user
     *
     * @return int
     */
    public function countFutureForBuildingAndUser(Building $building, User $user): int;

    /**
     * Count future bookings for a User grouped by Building id's.
     *
     * @param User $user
     *
     * @return array
     */
    public function countFutureForUserByBuildings(User $user);

    /**
     * Find the latest booking for a User grouped by Building id's.
     *
     * @param User     $user
     *
     * @return array
     */
    public function latestBookingForUserByBuildings(User $user);

    /**
     * @param Carbon $start
     * @param Carbon $end
     *
     * @return TemporaryAccessBooking[]
     */
    public function findBetween(Carbon $start, Carbon $end);

    /**
     * @param Carbon $start
     * @param Carbon $end
     *
     * @return TemporaryAccessBooking[]
     */
    // public function findBetweenWhereApproved(Carbon $start, Carbon $end);

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @param Building $building
     *
     * @return TemporaryAccessBooking[]
     */
    public function findBetweenForBuilding(Carbon $start, Carbon $end, Building $building);

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @param Building $building
     * @param User $user
     *
     * @return TemporaryAccessBooking[]
     */
    public function findBetweenForBuildingAndUser(Carbon $start, Carbon $end, Building $building, User $user);

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @param BookableArea $bookableArea
     *
     * @return TemporaryAccessBooking[]
     */
    public function findBetweenForBookableArea(Carbon $start, Carbon $end, BookableArea $bookableArea);

    /**
     * Save TemporaryAccessBooking to the DB.
     *
     * @param TemporaryAccessBooking $temporaryAccessBooking
     */
    public function save(TemporaryAccessBooking $temporaryAccessBooking);

    /**
     * Remove a TemporaryAccessBooking.
     *
     * @param TemporaryAccessBooking $temporaryAccessBooking
     */
    public function remove(TemporaryAccessBooking $temporaryAccessBooking);
}
