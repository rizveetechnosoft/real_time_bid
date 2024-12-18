# RTB Campaign Matching System

## Overview

The **RTB Campaign Matching System** is designed to match real-time bid requests with eligible ad campaigns based on various parameters such as device information, geographic location, operating system, and ad formats. The system processes incoming bid requests and returns the most suitable campaign in JSON format, which includes details like the ad image, creative ID, price, and campaign ID.

## Features

- **Campaign Matching**: Filters campaigns based on device, location, operating system, and ad format.
- **JSON Response**: Returns a bidding response with the selected campaign’s details.
- **Error Handling**: Displays error messages if there is missing or invalid data in the request or campaigns.
- **Customizable**: Easily extendable to add more filtering conditions or match different bid parameters.

## Project Structure


- **campaign.json**: Contains a list of campaigns with details such as price, size, and supported operating systems.
- **bid_request.json**: Contains the bid request data, including device details, geo-location, and requested bid price.
- **rtb_handler.php**: The PHP script that processes the bid request and matches it with eligible campaigns.

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

## Setup Project Files

Ensure that `campaign.json` and `bid_request.json` are in the same directory as `rtb_handler.php`.

## Start a Local Server

If using XAMPP, start the Apache server. Or you can use PHP’s built-in server:

```bash
php -S localhost:8080
http://localhost:8080/rtb_handler.php

## Example Output
A successful bid response will look like this:
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
nvalid or missing bid request or campaign data will result in a JSON error message, such as:


{
    "error": "Invalid campaign data."
}

