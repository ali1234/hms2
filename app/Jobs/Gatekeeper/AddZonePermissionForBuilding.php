<?php

namespace App\Jobs\Gatekeeper;

use HMS\Entities\Role;
use Illuminate\Bus\Queueable;
use HMS\Repositories\RoleRepository;
use HMS\Entities\Gatekeeper\Building;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use HMS\Repositories\PermissionRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use HMS\Repositories\Gatekeeper\BuildingRepository;

class AddZonePermissionForBuilding implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Building
     */
    protected $buildingId;

    /**
     * Create a new job instance.
     *
     * @param Building $building
     *
     * @return void
     */
    public function __construct(Building $building)
    {
        // we are just going ot have to pull a fresh copy from the db anyway
        $this->buildingId = $building->getId();
    }

    /**
     * Given a building with zones add there permission to Role::MEMBER_CURRENT to allow User access.
     *
     * @param BuildingRepository $buildingRepository
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return void
     */
    public function handle(
        BuildingRepository $buildingRepository,
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    ) {
        $building = $buildingRepository->findOneById($this->buildingId);
        $currentRole = $roleRepository->findOneByName(Role::MEMBER_CURRENT);

        foreach ($building->getZones() as $zone) {
            if ($zone->isRestricted()) {
                continue;
            }

            $zonePermission = $permissionRepository->findOneByName($zone->getPermissionCode());
            $currentRole->addPermission($zonePermission);
        }

        $roleRepository->save($currentRole);
    }
}
