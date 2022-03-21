<?php
	namespace xApi;

	abstract class Endpoints implements ApiInterface {
		#This is your profile information
		public function account_profile () {
			return $this->Request("profile");
		}

		# This is your account XUID (Xbox Account User ID)
		public function account_xuid () {
			return $this->Request("accountXuid");
		}

		# Get limit request
		public function calls_remaining () {
			return $this->Request("accountXuid", limit: true);
		}

		# These are your message with full preview…
		public function account_messages () {
			return $this->Request("messages");
		}
		
		# Sending Messages (Paid Subscription Required)
		public function sending_messages (int $to, string $message) {
			return $this->Request("messages", ["to" => [$to], "message" => $message], 'POST');
		}

		# These are your conversations with full preview of the last message sent/recieved…
		public function account_conversations () {
			return $this->Request("conversations");
		}

		# This is the XUID for a specified Gamertag (Xbox Account User ID)
		public function gamertag_xuid (string $gamertag) {
			return $this->Request("xuid/" . $gamertag);
		}

		# This is the Gamertag for a specified XUID (Xbox Account User ID)
		public function xuid_gamertag (int $xuid) {
			return $this->Request("gamertag/" . $xuid);
		}

		# This is the NEW Profile endpoint for a specified XUID. This gives you the new unique gamertag information etc.
		public function new_profile (int $xuid) {
			return $this->Request($xuid . "/new-profile");
		}

		# This is the Gamercard information for a specified XUID
		public function gamercard (int $xuid) {
			return $this->Request($xuid . "/gamercard");
		}

		# This is the current presence information for a specified XUID
		public function presence (int $xuid) {
			return $this->Request($xuid . "/presence");
		}

		# This is the current activity information for a specified XUID
		public function activity (int $xuid) {
			return $this->Request($xuid . "/activity");
		}

		# This is the current activity information for a specified XUID
		public function recent_activity (int $xuid) {
			return $this->Request($xuid . "/activity/recent");
		}

		# This is the friends information for a specified XUID
		public function friends (int $xuid) {
			return $this->Request($xuid . "/friends");
		}

		# This is the followers information for a specified XUID
		public function followers (int $xuid) {
			return $this->Request($xuid . "/followers");
		}

		# This is accounts recent players information
		public function recent_players (int $xuid) {
			return $this->Request($xuid . "/recent-players");
		}

		# This is the friends information for a specified XUID, playing a specified game
		public function friends_playing_specified_game (int $xuid, int $titleId, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request($xuid . "/friends-playing/" . $titleId, $args);
		}

		# This is the game clips for a specified XUID
		public function users_game_clips (int $xuid, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request($xuid . "/game-clips", $args);
		}

		# This is the saved game clips for a specified XUID
		public function users_saved_game_clips (int $xuid, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request($xuid . "/game-clips/saved", $args);
		}

		# This is the saved game clips for a specified XUID, and Game (titleId)
		public function users_game_clips_for_specified_game (int $xuid, int $titleId, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request($xuid . "/game-clips/" . $titleId, $args);
		}

		# This is the saved game clips for a specified Game (titleId)
		public function game_clips_for_specified_game (int $titleId, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request("game-clips/" . $titleId, $args);
		}

		# This is the screenshots for a specified XUID
		public function users_screenshots (int $xuid, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request($xuid . "/screenshots", $args);
		}

		# This is the saved screenshots for a specified XUID, and Game (titleId)
		public function users_screenshots_for_specified_game (int $xuid, int $titleId, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request($xuid . "/screenshots/" . $titleIdm, $args);
		}

		# This is the saved screenshots for a specified Game (titleId)
		public function screenshots_for_specified_game (int $xuid, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request("screenshots/" . $titleId, $args);
		}

		# This is the game stats for a specified XUID, on a specified game. (i.e. Driver Level on Forza etc.)
		public function game_stats (int $xuid, int $titleId) {
			return $this->Request($xuid . "/game-stats/" . $titleId);
		}

		# This is the Xbox 360 Games List for a specified XUID
		public function xbox_360_games (int $xuid, string $continuationToken = null) {
			$args = [];
			if ($continuationToken !== null) $args['continuationToken'] = $continuationToken;
			return $this->Request($xuid . "/xbox360games", $args);
		}

		# This is the Xbox One Games List for a specified XUID
		public function xbox_one_games (int $xuid) {
			return $this->Request($xuid . "/xboxonegames");
		}

		# This is the Xbox Games Achievements for a specified XUID
		public function xbox_game_achievements (int $xuid, int $titleId) {
			return $this->Request($xuid . "/achievements/" . $titleId);
		}

		# This is the Xbox Game Information (using the game id in hex format)
		public function xbox_game_information_hex (string $game_id) {
			return $this->Request("game-details-hex/" . $game_id);
		}

		# This is the Xbox Game Information (using the product id)
		public function xbox_game_information_id (string $product_id) {
			return $this->Request("game-details/" . $product_id);
		}

		# This is the Xbox Game Information (using the product id)
		public function xbox_game_addon_information (string $product_id) {
			return $this->Request("game-details/" . $product_id . "/addons/1");
		}

		# This is the Xbox Game Information (using the product id)
		public function xbox_related_game_information (string $product_id) {
			return $this->Request("game-details/" . $product_id . "/related");
		}

		# This gets the latest Xbox 360 Games from the Xbox LIVE marketplace
		public function latest_xbox_360_games () {
			return $this->Request("latest-xbox360-games");
		}

		# Browse the Xbox LIVE marketplace for Xbox 360 content.
		public function browse_xbox_360_marketplace (int $sort = 13) {
			$list_sort = [
				"1" => "allTimeAverageRating", # All Time Average Rating
				"2" => "allTimePlayCount", # All Time Play Count
				"3" => "allTimePurchaseCount", # All Time Purchase Count
				"4" => "allTimeRatingCount", # All Time Rating Count
				"5" => "allTimeRentalCount", # All Time Rental Count
				"6" => "allTimeUserRating", # All Time User Rating
				"7" => "criticRating", # Critic Rating
				"8" => "digitalReleaseDate", # Digital Release Date
				"9" => "freeAndPaidCountDaily", # Free And Paid Count Daily
				"10" => "MostPopular", # Most Popular
				"11" => "paidCountAllTime", # Paid Count All Time
				"12" => "paidCountDaily", # Paid Count Daily
				"13" => "releaseDate", # Release Date
				"14" => "sevenDaysAverageRating", # Seven Days Average Rating
				"15" => "sevenDaysPlayCount", # Seven Days Play Count
				"16" => "sevenDaysPurchaseCount", # Seven Days Purchase Count
				"17" => "sevenDaysRentalCount", # Seven Days Rental Count
				"18" => "sevenDaysRatingCount", # Seven Days Rating Count
				"19" => "userRating", # User Rating
				"20" => "numberAscending", # Number Ascending
				"21" => "numberDescending" # Number Descending
			];

			return in_array($sort, range(1, 21)) ? $this->Request("browse-marketplace/xbox360/1", ["sort" => $list_sort[$sort]]) : false;
		}

		# Show your activity feed.
		public function activity_feed () {
			return $this->Request("activity-feed");
		}
		
		# Posting to your Activity Feed
		public function post_activity_feed (string $message) {
			return $this->Request("activity-feed", ['message' => $message], 'POST');
		}

		# Show your achievements list by game with friends who also play. (New TitleHub endpoint)
		public function titleHub_achievements_list (int $xuid) {
			return $this->Request($xuid . "/titlehub-achievement-list");
		}

		# Show clubs that you are an owner of
		public function clubs_i_own () {
			return $this->Request("clubs/owned");
		}

		# Show clubs that you have joined - Note that the XUID is optional
		public function clubs_i_have_joined (int $xuid) {
			return $this->Request("clubs/joined/" . $xuid);
		}

		# Show all information about a club
		public function club_details (int $club_id) {
			return $this->Request("clubs/details/" . $club_id);
		}

		# You search for clubs by name
		public function search_for_club_by_name (string $search_query) {
			return $this->Request("clubs/search/name/" . $search_query);
		}

		# You search for clubs by title id's (comma seperated for multiple)
		public function search_for_club_by_titles (string $search_query) {
			return $this->Request("clubs/search/titles/" . $search_query);
		}

		# You search for clubs by tag's (comma seperated for multiple) - Note that not all tags are known
		public function search_for_club_by_tags (string $search_query) {
			return $this->Request("clubs/search/tags/" . $search_query);
		}

		# This is the Xbox sponsored activity feed
		public function xbox_sponsored_activity_feed () {
			return $this->Request("xbox-activity-feed");
		}

		# This XUID will be added as a friend (NOTE: This is a GET request, and will add djekl as a friend)
		public function add_friend (int $xuid) {
			return $this->Request($xuid . "/add-as-friend");
		}

		# This XUID will be added as a favourite (NOTE: This is a GET request, and will add djekl as a favourite)
		public function add_favourite_friend (int $xuid) {
			return $this->Request($xuid . "/add-as-favourite");
		}

		# This XUID will be removed as a friend (NOTE: This is a DELETE request, and will remove djekl as a friend)
		public function remove_friend (int $xuid) {
			return $this->Request($xuid . "/remove-friend");
		}

		# Use this endpoint with an XUID to find the title history of a user
		public function profile_title_history (int $xuid) {
			return $this->Request($xuid . "/title-history");
		}

		# This is a new endpoint for game clips, however the data structure is different, and can be used instead of the existing one
		public function alternative_game_clips (int $xuid) {
			return $this->Request($xuid . "/alternative-game-clips");
		}

		# This is a new endpoint for screenshots, however the data structure is different, and can be used instead of the existing one
		public function alternative_screenshots (int $xuid) {
			return $this->Request($xuid . "/alternative-screenshots");
		}

		# Search the latest Xbox Marketplace
		public function marketplace_search (string $query) {
			return $this->Request("marketplace/search/" . $query);
		}

		# Show product details from the latest Xbox Marketplace. It takes either a Title ID (integer), Legacy Xbox Product ID (looks like a UUID), or the new Big ID (9NBLGGH537BL)
		public function marketplace_show ($id) {
			return $this->Request("marketplace/show/" . $id);
		}

		# Show the latest Games With Gold on the latest Xbox Marketplace
		public function marketplace_games_with_gold () {
			return $this->Request("marketplace/games-with-gold");
		}

		# Show the latest Deals With Gold on the latest Xbox Marketplace
		public function marketplace_deals_with_gold () {
			return $this->Request("marketplace/deals-with-gold");
		}

		# Get the latest Games on the latest Xbox Marketplace
		public function latest_games_in_the_marketplace () {
			return $this->Request("marketplace/latest-games");
		}

		# Get the currently featured Games on the latest Xbox Marketplace
		public function featured_games_in_the_marketplace () {
			return $this->Request("marketplace/featured-games");
		}

		# Get the Games that are coming soon to the latest Xbox Marketplace
		public function games_coming_soon_to_the_marketplace () {
			return $this->Request("marketplace/games-coming-soon");
		}

		# Get the Most Played Games that are in the latest Xbox Marketplace
		public function most_played_games_in_the_marketplace () {
			return $this->Request("marketplace/most-played-games");
		}
	}