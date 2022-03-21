<?php
	namespace xApi;

	interface ApiInterface {
		function Request(string $method, array $data, string $request);
	}