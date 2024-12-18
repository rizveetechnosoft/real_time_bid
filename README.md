# RTB Campaign Matching System

## Overview

The **RTB Campaign Matching System** is designed to match real-time bid requests with eligible ad campaigns based on various parameters such as device information, geographic location, operating system, and ad formats. The system processes incoming bid requests and returns the most suitable campaign in JSON format, which includes details like the ad image, creative ID, price, and campaign ID.

## Features

- **Campaign Matching**: Filters campaigns based on device, location, operating system, and ad format.
- **JSON Response**: Returns a bidding response with the selected campaign’s details.
- **Error Handling**: Displays error messages if there is missing or invalid data in the request or campaigns.
- **Customizable**: Easily extendable to add more filtering conditions or match different bid parameters.

## Project Structure

/rtb_campaign_matching_system
|-- campaign.json        // Example campaigns to match with bid requests
|-- bid_request.json     // Example bid request JSON
|-- rtb_handler.php      // PHP script that processes the bid request and matches with campaigns
|-- README.md            // Project documentation
## Installation & Setup

### Requirements

- PHP version 7.4 or higher
- A web server such as Apache or Nginx (or use PHP’s built-in server)
- Optional: XAMPP or similar local server setup

### Steps to Run

1. **Clone the Repository**:
   Clone the repository to your local system:
   ```bash
   git clone https://github.com/yourusername/rtb-campaign-matching.git

Start a Local Server: If using XAMPP, start the Apache server. Or you can use PHP’s built-in server:

bash
Copy code
php -S localhost:8080
Access the Script: Open the following URL in your browser to test the functionality:

bash
Copy code
http://localhost:8080/rtb_handler.php
How It Works
Bid Request: A JSON object with bid details is sent to the rtb_handler.php script.
Campaign Matching: The script loads campaign.json and filters campaigns based on the bid request.
Response: The script sends back a JSON response containing the selected campaign, including the creative, campaign ID, and price.
Example Output
A successful bid response will look like this:

json
Copy code
{
    "id": "myB92gUhMdC5DUxndq3yAg",
    "seatbid": [
        {
            "bid": [
                {
                    "impid": "1",
                    "price": 0.1,
                    "adid": "crea457",
                    "nurl": "https://example.com/click",
                    "adm": "<img src='https://example.com/ad2.jpg' alt='Ad'>",
                    "cid": "Campaign 2",
                    "crid": "crea457"
                }
            ]
        }
    ]
}
Error Handling
Invalid or missing bid request or campaign data will result in a JSON error message, such as:
json
Copy code
{
    "error": "Invalid campaign data."
}
Contributing
Feel free to fork the repository, make changes, and submit a pull request. Please ensure that your code follows the existing project structure and style.
