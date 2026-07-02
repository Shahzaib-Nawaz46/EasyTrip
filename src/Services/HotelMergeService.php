<?php

declare(strict_types=1);

namespace App\Services;

/**
 * HotelMergeService
 * 
 * Responsible for merging local Admin hotels and Travelpayouts hotels.
 * Enforces the rule that Local hotels MUST appear first.
 */
class HotelMergeService {

    public function __construct(
        // private LocalHotelRepository $localHotelRepo,
        // private TravelpayoutsService $tpService
    ) {}

    /**
     * Fetch and merge hotels from both sources based on search criteria.
     */
    public function getMergedHotels(array $searchParams): array {
        
        $mergedResults = [];

        // 1. Fetch Local Hotels First (Highest Priority)
        // $localHotels = $this->localHotelRepo->search($searchParams);
        $localHotels = []; // Placeholder

        // 2. Fetch Travelpayouts Hotels (Secondary Priority)
        // $tpHotels = $this->tpService->search($searchParams);
        $tpHotels = []; // Placeholder

        // Merge logic ensuring local is at the top
        $mergedResults = array_merge($localHotels, $tpHotels);

        return $mergedResults;
    }
}
