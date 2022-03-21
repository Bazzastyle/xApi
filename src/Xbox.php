<?php
	namespace xApi;

	class Xbox extends Endpoints {
		private $endpoint, $curl;

		public function __construct(string $token, string $language) {
			$this->endpoint = "https://xapi.us/v2/";
			$this->curl = curl_init();

			curl_setopt_array($this->curl, [
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FORBID_REUSE => true,
				CURLOPT_HEADER => true,
				CURLOPT_TIMEOUT => 120,
				CURLOPT_CONNECTTIMEOUT => 10,
				CURLOPT_HTTPHEADER => ["Connection: Keep-Alive", "Keep-Alive: 120", 'X-Auth: ' . $token, 'Accept-Language: ' . $language],
			]);
		}

		public function Request(string $method, array $args = [], string $request = 'GET', bool $limit = false) {
			curl_setopt_array($this->curl, [
				CURLOPT_URL => $this->endpoint . $method,
				CURLOPT_CUSTOMREQUEST => $request
			]);

			if ($request === 'POST') curl_setopt_array($this->curl, [CURLOPT_POSTFIELDS => empty($args) ? null : $args]);
			else curl_setopt_array($this->curl, [CURLOPT_POSTFIELDS => empty($args) ? null : $args]);
			$resultCurl = curl_exec($this->curl);

			$headerSize = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
			$headerStr = substr($resultCurl, 0, $headerSize);
			$bodyStr = substr($resultCurl, $headerSize);
			$headers = $this->headersToArray($headerStr);
			$limit = ["Limit" => trim($headers['X-RateLimit-Limit']), "Remaining" => trim($headers['X-RateLimit-Remaining']), "Reset" => trim($headers['X-RateLimit-Reset'])];

			# stamp in console rate limit request api
			echo '<script>console.log(' . json_encode($limit, JSON_PRETTY_PRINT) . ');</script>';

			if ($headers['X-RateLimit-Remaining'] === 0 || $limit) {
				return $limit;
			}

			if ($bodyStr === false) {
				$arr = [
					"ok" => false,
					"error_code" => curl_errno($this->curl),
					"description" => curl_error($this->curl),
					"curl_error" => true,
				];
				$bodyStr = json_encode($arr);
			}

			$resultJson = json_decode($bodyStr);
			if ($resultJson === null) {
				$arr = [
					"ok" => false,
					"error_code" => json_last_error(),
					"description" => json_last_error_msg(),
					"json_error" => true,
				];
				$resultJson = json_decode(json_encode($arr));
			}

			return $resultJson;
		}

		private function headersToArray($str) {
			$headers = [];
			$headersTmpArray = explode("\r\n", $str);
			for ($i = 0; $i < count($headersTmpArray); ++$i) {
				# we dont care about the two \r\n lines at the end of the headers
				if (strlen($headersTmpArray[$i]) > 0) {
					# the headers start with HTTP status codes, which do not contain a colon so we can filter them out too
					if (strpos($headersTmpArray[$i], ":")) {
						$headerName = substr($headersTmpArray[$i], 0, strpos($headersTmpArray[$i], ":"));
						$headerValue = substr($headersTmpArray[$i], strpos($headersTmpArray[$i], ":")+1);
						$headers[$headerName] = $headerValue;
					}
				}
			}
			return $headers;
		}
	}