<?php

header('Content-Type: application/json');

try {
    // Load campaign data from the file
     $campaigns = json_decode(file_get_contents('campaigns.json'), true);
	//$campaigns = json_decode(file_get_contents('test.json'), true);//second json file
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid campaign data.");
    }

    // Load bid request data from the file
    $bidRequest = json_decode(file_get_contents('bid_request.json'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid bid request data.");
    }

    // Validate the bid request
    if (!$bidRequest || !isset($bidRequest['imp']) || empty($bidRequest['imp'])) {
        throw new Exception("Invalid or missing bid request JSON.");
    }

    // Extract parameters from the bid request
    $device = $bidRequest['device'] ?? [];
    $geo = $device['geo'] ?? [];
    $country = $geo['country'] ?? null;
    $os = $device['os'] ?? null;
    $bidFloor = $bidRequest['imp'][0]['bidfloor'] ?? 0;
    $adFormat = $bidRequest['imp'][0]['banner']['format'] ?? [];

    // Filter campaigns based on criteria
    $eligibleCampaigns = array_filter($campaigns, function ($campaign) use ($os, $country, $adFormat, $bidFloor) {
        $campaignDimensions = explode('x', $campaign['dimension']);

        return in_array($os, explode(',', $campaign['hs_os'])) &&
               $campaign['country'] === $country &&
               array_filter($adFormat, fn($format) => $format['w'] == $campaignDimensions[0] && $format['h'] == $campaignDimensions[1]) &&
               $campaign['price'] >= $bidFloor;
    });

    // Select the best campaign (highest price)
    if (!empty($eligibleCampaigns)) {
        usort($eligibleCampaigns, fn($a, $b) => $b['price'] <=> $a['price']);
        $selectedCampaign = $eligibleCampaigns[0];

        // Generate RTB response
        $response = [
            "id" => $bidRequest['id'],
            "seatbid" => [
                [
                    "bid" => [
                        [
                            "impid" => $bidRequest['imp'][0]['id'],
                            "price" => $selectedCampaign['price'],
                            "adid" => $selectedCampaign['creative_id'],
                            "nurl" => isset($selectedCampaign['url']) ? $selectedCampaign['url'] : null, // Check if url exists
                            "adm" => "<img src='{$selectedCampaign['image_url']}' alt='Ad'>",
                            "cid" => $selectedCampaign['campaignname'],
                            "crid" => $selectedCampaign['creative_id'],
                        ]
                    ]
                ]
            ]
        ];

        echo json_encode($response, JSON_PRETTY_PRINT);
    } else {
        throw new Exception("No eligible campaigns found.");
    }
} catch (Exception $e) {
    // Handle errors
    echo json_encode(["error" => $e->getMessage()]);
}
