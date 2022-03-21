# Description
> This is a PHP wrapper for the unofficial [Xbox API](https://xapi.us/)

## Requirements
PHP 8.0 or higher with curl extension

## Installation
```sh
composer require bazzastyle/xapi
```

## Usage
1. Create an account at https://xapi.us/
2. Link your Xbox account
3. Generate an API key
4. Copy API key
```php
require_once __DIR__ . "/vendor/autoload.php";

use xApi\Xbox;

$xbox = new Xbox("API KEY", "language");
```

## Example
```php
require_once __DIR__ . "/vendor/autoload.php";

use xApi\Xbox;

$xbox = new Xbox("f787fbc2c7167053ebcc4ff572302131cb61691f", "it-IT");

$account = $xbox->account_xuid();
echo $account->gamertag;
```

The client also respond to #calls_remaining
```php
echo json_encode($xbox->calls_remaining());
#=> {"Limit": "60", "Remaining": "58", "Reset": "1055"}
```

## RateLimits

![Ratelimit](https://telegra.ph/file/1bc0bf027841c07509a41.jpg)

API requests are limited on a per API Key basis.
When making a request to the API, your limit information will be returned in the headers.

## Ratelimit Headers:
- I do not include ratelimits in the responses.
- X-RateLimit-Limit: Maximum usage allowed per timeframe
- X-Ratelimit-Remaining: Remaining requests that can be made during the timeframe
- X-RateLimit-Reset: Timestamp indicating when the ratelimit will reset in milliseconds.

## API Docs
**[Click Here](https://xapi.us/documentation)**

### Currently Supported Endpoints

| Method | Endpoint | Name |
|---|---|---|
| account_profile | /v2/profile | Account Profile |
| account_xuid | /v2/accountXuid | Account XUID |
| account_messages | /v2/messages | Account Messages |
| account_conversations | /v2/conversations | Account Conversations |
| gamertag_xuid | /v2/xuid/{gamertag} | Gamertag XUID |
| xuid_gamertag | /v2/gamertag/{xuid} | XUID Gamertag |
| new_profile | /v2/{xuid}/new-profile | [NEW] Profile |
| gamercard | /v2/{xuid}/gamercard | Gamercard |
| presence | /v2/{xuid}/presence | Presence |
| activity | /v2/{xuid}/activity | Activity |
| recent_activity | /v2/{xuid}/activity/recent | Recent Activity |
| friends | /v2/{xuid}/friends | Friends |
| followers | /v2/{xuid}/followers | Followers |
| recent_players | /v2/recent-players | Recent Players |
| friends_playing_specified_game | /v2/{xuid}/friends-playing/{titleId} | Friends Playing Specified Game |
| users_game_clips | /v2/{xuid}/game-clips | Users Game Clips |
| users_saved_game_clips | /v2/{xuid}/game-clips/saved | Users Saved Game Clips |
| users_game_clips_for_specified_game | /v2/{xuid}/game-clips/{titleId} | Users Game Clips For Specified Game |
| game_clips_for_specified_game | /v2/game-clips/{titleId} | Game Clips For Specified Game |
| users_screenshots | /v2/{xuid}/screenshots | Users Screenshots |
| users_screenshots_for_specified_game | /v2/{xuid}/screenshots/{titleId} | Users Screenshots For Specified Game |
| screenshots_for_specified_game | /v2/screenshots/{titleId} | Screenshots For Specified Game |
| game_stats | /v2/{xuid}/game-stats/{titleId} | Game Stats |
| xbox_360_games | /v2/{xuid}/xbox360games | Xbox 360 Games |
| xbox_one_games | /v2/{xuid}/xboxonegames | Xbox ONE Games |
| xbox_game_achievements | /v2/{xuid}/achievements/{titleId} | Xbox Game Achievements |
| xbox_game_information_hex | /v2/game-details-hex/{game_id} | Xbox Game Information (Game ID in HEX) |
| xbox_game_information_id | /v2/game-details/{product_id} | Xbox Game Information (Product ID) |
| xbox_game_addon_information | /v2/game-details/{product_id}/addons/1 | Xbox Game Addon (DLC) Information (Product ID) |
| xbox_related_game_information | /v2/game-details/{product_id}/related | Xbox Related Game Information (Product ID) |
| latest_xbox_360_games | /v2/latest-xbox360-games | Latest Xbox 360 Games |
| browse_xbox_360_marketplace | /v2/browse-marketplace/xbox360/1?sort=releaseDate | Browse Xbox 360 Marketplace |
| activity_feed | /v2/activity-feed | Activity Feed |
| titleHub_achievements_list | /v2/{xuid}/titlehub-achievement-list | TitleHub Achievements List |
| clubs_i_own | /v2/clubs/owned | Clubs I Own |
| clubs_i_have_joined | /v2/clubs/joined/{xuid} | Clubs I Have Joined |
| club_details | /v2/clubs/details/{club_id} | Club Details |
| search_for_club_by_name | /v2/clubs/search/name/{search_query} | Search For Club By Name |
| search_for_club_by_titles | /v2/clubs/search/titles/{search_query} | Search For Club By Titles |
| search_for_club_by_tags | /v2/clubs/search/tags/{search_query} | Search For Club By Tags |
| xbox_sponsored_activity_feed | /v2/xbox-activity-feed | Xbox Sponsored Activity Feed |
| add_friend | /v2/{xuid}/add-as-friend | Add Friend |
| add_favourite_friend | /v2/{xuid}/add-as-favourite | Add Favourite Friend |
| remove_friend | /v2/{xuid}/remove-friend | Remove Friend |
| profile_title_history | /v2/{xuid}/title-history | Profile Title History |
| alternative_game_clips | /v2/{xuid}/alternative-game-clips | Alternative Game Clips |
| alternative_screenshots | /v2/{xuid}/alternative-screenshots | Alternative Screenshots |
| marketplace_search | /v2/marketplace/search/{query} | [NEW] Marketplace Search |
| marketplace_show | /v2/marketplace/show/{id} | [NEW] Marketplace Show (title id) |
| marketplace_games_with_gold | /v2/marketplace/games-with-gold | [NEW] Marketplace Games With Gold |
| marketplace_deals_with_gold | /v2/marketplace/deals-with-gold | [NEW] Marketplace Deals With Gold |
| latest_games_in_the_marketplace | /v2/marketplace/latest-games | [NEW] Latest Games in the Marketplace |
| featured_games_in_the_marketplace | /v2/marketplace/featured-games | [NEW] Featured Games in the Marketplace |
| games_coming_soon_to_the_marketplace | /v2/marketplace/games-coming-soon | [NEW] Games Coming Soon to the Marketplace |
| most_played_games_in_the_marketplace | /v2/marketplace/most-played-games | [NEW] Most Played Games in the Marketplace |
|  |